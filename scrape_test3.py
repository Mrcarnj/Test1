import requests
from bs4 import BeautifulSoup
import mysql.connector

# Connect to the MySQL database
connection = mysql.connector.connect(host='localhost',
                                    user='root',
                                    password='Doow24031511!',
                                    db='mjrpool')

cursor = connection.cursor()
# Make an HTTP request to the webpage
response = requests.get('https://www.espn.com/golf/leaderboard/_/tournamentId/401465506')

# Parse the HTML content of the webpage
soup = BeautifulSoup(response.text, 'lxml')

# Find the main table element
table = soup.find_all('div', class_='Table__Scroller')

#tablerows = soup.select('table tr th a')
#for row in tablerows:
    #print(row.text)

tablerows = soup.select('tr.PlayerRow__Overview.PlayerRow__Overview--expandable.Table__TR.Table__even')

for row in tablerows:
    cells = row.select('td')
    player_name = cells[2].text
    score = cells[3].text

    if score == "CUT" or score == "WD":
        score = 99
    
    sql_insert = "INSERT INTO test1 (player_name, score) VALUES (%s, %s)"
    sql_update = "UPDATE test1 SET score = %s, WHERE player_name = %s"
    
    try:
        cursor.execute(sql_insert, (player_name, score))
    # If the INSERT INTO statement fails due to a duplicate key error, execute the UPDATE statement instead
    except mysql.connector.errors.IntegrityError as e:
        if e.errno == 1062:  # Duplicate key error
            cursor.execute(sql_update, (score, player_name))

# Commit the transaction
connection.commit()

# Close the cursor and connection
cursor.close()
connection.close()
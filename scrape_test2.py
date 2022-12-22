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
tabledata=[]
tablerows = soup.select('table tr')

for tr in tablerows[1:]:
    row=[]
    for t in tr.select('td')[2:6]:
        row.extend([t.text.strip()])
    tabledata.append(row)
table = tabledata

# Loop through the rows in the tabledata list
for row in tabledata:
    # Extract the relevant columns from the row
    player, score, thru, to_par= row
    if score in ('CUT', 'WD'):
        score = 99
    # Construct the INSERT INTO and UPDATE statements
    sql_insert = "INSERT INTO leaderboard_rsm (player_name, score, thru, to_par) VALUES (%s, %s, %s, %s)"
    sql_update = "UPDATE leaderboard_rsm SET score = %s, thru = %s, to_par = %s WHERE player_name = %s"
    # Try to execute the INSERT INTO statement
    try:
        cursor.execute(sql_insert, (player, score, thru, to_par))
    # If the INSERT INTO statement fails due to a duplicate key error, execute the UPDATE statement instead
    except mysql.connector.errors.IntegrityError as e:
        if e.errno == 1062:  # Duplicate key error
            cursor.execute(sql_update, (score, thru, to_par, player))

# Commit the transaction
connection.commit()

# Close the cursor and connection
cursor.close()
connection.close()


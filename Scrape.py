import requests
from bs4 import BeautifulSoup
import mysql.connector

# Connect to the MySQL database
connection = mysql.connector.connect(host='localhost',
                                    user='root',
                                    password='Doow24031511!',
                                    db='mjrpool')

# Make an HTTP request to the webpage
response = requests.get('https://www.espn.com/golf/leaderboard/_/tournamentId/401465506')

# Parse the HTML content of the webpage
soup = BeautifulSoup(response.text, 'html.parser')

# Find the main table element
table = soup.find('table', class_='Table2__table__wrapper')

# Extract the data from the table and insert it into the database
for row in table.find_all('tr'):
    cells = row.find_all('td')
    if cells:
        player_name = cells[0].text
        score = cells[1].text

        # Check if the player already exists in the database
        sql = f"SELECT * FROM leaderboard_rsm WHERE player_name='{player_name}'"
        cursor = connection.cursor()
        cursor.execute(sql)
        result = cursor.fetchall()
        if len(result) > 0:
            # Update the score of the player
            sql = f"UPDATE leaderboard_rsm SET score='{score}' WHERE player_name='{player_name}'"
            cursor.execute(sql)
        else:
            # Insert the player into the database
            sql = f"INSERT INTO leaderboard_rsm (player_name, score) VALUES ('{player_name}', '{score}')"
            cursor.execute(sql)

# Close the cursor and connection to the database
cursor.close()
connection.close()

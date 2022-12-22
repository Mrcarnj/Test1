<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
# Connect to the MySQL database
include 'database.php';

# Execute a SELECT statement to retrieve all entries from the second_table table
sql = "SELECT entry FROM second_table"
result = mysqli_query(connection, sql)

# Loop through the rows of the result and retrieve the data for each entry
while row = result.fetch_assoc():
    entry = row['entry']

    # Execute a SELECT statement with a JOIN clause and a WHERE clause to retrieve the data from the leaderboard table
    sql = f"SELECT t1.entry, t1.pick_1, t2.player_name, t2.score FROM second_table t1 JOIN leaderboard t2 ON t1.pick_1=t2.player_name WHERE t1.entry='{entry}'"
    result2 = mysqli_query(connection, sql)

    # Loop through the rows of the result and print the data
    while row2 = result2.fetch_assoc():
        pick_1 = row2['pick_1']
        player_name = row2['player_name']
        score = row2['score']
        print(f'Entry: {entry}, Pick 1: {pick_1}, Player: {player_name}, Score: {score}')

# Close the connection to the database
mysqli_close(connection)



?>
</body>
</html>





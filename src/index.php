<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        // Connecting, selecting database
        $theHost = "localhost"; // On the actual server (if we use one), this should probably be "<something>.encs.concordia.ca" (without the quotes).
        $theDbName = "soen341db";
        $theUsername = "deniz"; // "soen341user";
        $thePassword = "cncrd";
        
        $dbconn = pg_connect("host=$theHost dbname=$theDbName user=$theUsername password=$thePassword")
                or die('Could not connect: ' . pg_last_error());

        // Performing SQL query
        $nameOfTable = "masa";
        $query = "SELECT * FROM $nameOfTable;";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        // Printing results in HTML
        printTable($result);
        
        function printTable($resultOfSqlQuery) {
            echo "<table border=1>\n"; // Later, make the border stuff be done in CSS (since that's the proper way to do it).
            while ($line = pg_fetch_array($resultOfSqlQuery, null, PGSQL_ASSOC)) {
                echo "\t<tr>\n";
                foreach ($line as $col_value) {
                    echo "\t\t<td>$col_value</td>\n";
                }
                echo "\t</tr>\n";
            }
            echo "</table>\n";
        }

        // Free resultset
        pg_free_result($result);

        // Closing connection
        pg_close($dbconn);
        ?>
    </body>
</html>

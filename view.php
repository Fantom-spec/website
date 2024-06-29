<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Data</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #000;
        }

        
        /* Styling for the table */
        section table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        section table th, section table td {
            border: 1px solid #fff;
            padding: 10px;
            color: #fff;
            text-align: center;
        }

        section table th {
            background-color: #333;
        }

        section table tbody tr:nth-child(even) {
            background-color: #222;
        }

        section table tbody tr:hover {
            background-color: #0f0;
        }

        .back {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back a {
            color: #0f0;
            text-decoration: none;
            font-size: 1.2em;
        }
        .refresh {
            position: absolute;
            top: 20px;
            left: 80px;
        }

        .refresh a {
            color: #0f0;
            text-decoration: none;
            font-size: 1.2em;
        }

        h1 {
            color: #0f0;
            text-align: center;
            margin-top: 20px;
        }

        .edit, .delete {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
            text-align: center;
            padding: 10px;
            background: #0f0;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 20px;
        }

        .edit:hover, .delete:hover {
            background: #000;
            color: #0f0;
        }
    </style>
</head>
<body>
<section>
<div class="refresh">
    <a href="#" onclick="location.reload();">Refresh</a>
</div>

    <div class="back">
      <a href="/mainpage.php/">Back</a>
    </div>
    <h1>Transaction Data</h1>

    <table>
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Date</th>
                <th>Day of Transaction</th>
                <th>Mode of Payment</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database credentials
            $servername = "localhost";
            $username = "root";
            $password = "abc+1234";
            $dbname = "transactions";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch data
            $sql = "SELECT Sno, DOT, DaOT, MOT, AMT, DESCRIPTION, TYPE FROM transact ORDER BY Sno";
            $result = $conn->query($sql);

            // Output data of each row
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>" .
                         "<td>" . $row["Sno"] . "</td>" .
                         "<td>" . $row["DOT"] . "</td>" .
                         "<td>" . $row["DaOT"] . "</td>" .
                         "<td>" . $row["MOT"] . "</td>" .
                         "<td>" . $row["AMT"] . "</td>" .
                         "<td>" . $row["DESCRIPTION"] . "</td>" .
                         "<td>" . $row["TYPE"] . "</td>" .
                         "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No transactions found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <a href="/update.php" target="_blank" class="edit">Edit</a>
    <a href="/delete.php" target="_blank" class="delete">Delete</a>
</section>
</body>
</html>

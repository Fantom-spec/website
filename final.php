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
            color: #fff;
        }

        section {
            margin-top: 20px;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        table {
            width: 30%;
            margin: 0 10px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #fff;
            padding: 10px;
            color: #fff;
        }

        th {
            background-color: #333;
        }

        tbody tr:nth-child(even) {
            background-color: #222;
        }

        tbody tr:hover {
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
    <h1>Report</h1>

    <div class="container">
        <!-- Table 1: Expense Table -->
        <table>
            <caption>Expense Table</caption>
            <thead>
            <tr>
                <th>Mode</th>
                <th>Amount Spent</th>
            </tr>
            </thead>
            <tbody>
            <?php
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

            // Fetching expenses for each mode
            $sql1 = "SELECT SUM(amt) AS total_amount FROM transact WHERE type = 'expense' AND mot = 'fampay'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $expense_fampay = $row1["total_amount"];

            $sql2 = "SELECT SUM(amt) AS total_amount FROM transact WHERE type = 'expense' AND mot = 'icici'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $expense_icici = $row2["total_amount"];

            $sql3 = "SELECT SUM(amt) AS total_amount FROM transact WHERE type = 'expense' AND mot = 'cash'";
            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_assoc();
            $expense_cash = $row3["total_amount"];

            // Calculate total expense
            $total_expense = $expense_fampay + $expense_icici + $expense_cash;

            // Display rows for expense table
            echo "<tr><th>FAMPAY</th><td>$expense_fampay</td></tr>";
            echo "<tr><th>ICICI</th><td>$expense_icici</td></tr>";
            echo "<tr><th>CASH</th><td>$expense_cash</td></tr>";
            echo "<tr><th>Total</th><td>$total_expense</td></tr>";

            ?>
            </tbody>
        </table>

        <!-- Table 2: Income Table -->
        <table>
            <caption>Income Table</caption>
            <thead>
            <tr>
                <th>Mode</th>
                <th>Amount Gained</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Fetching income for each mode
            $sql4 = "SELECT SUM(amt) AS total_amount FROM transact WHERE type = 'income' AND mot = 'fampay'";
            $result4 = $conn->query($sql4);
            $row4 = $result4->fetch_assoc();
            $income_fampay = $row4["total_amount"];

            $sql5 = "SELECT SUM(amt) AS total_amount FROM transact WHERE type = 'income' AND mot = 'icici'";
            $result5 = $conn->query($sql5);
            $row5 = $result5->fetch_assoc();
            $income_icici = $row5["total_amount"];

            $sql6 = "SELECT SUM(amt) AS total_amount FROM transact WHERE type = 'income' AND mot = 'cash'";
            $result6 = $conn->query($sql6);
            $row6 = $result6->fetch_assoc();
            $income_cash = $row6["total_amount"];

            // Calculate total income
            $total_income = $income_fampay + $income_icici + $income_cash;

            // Display rows for income table
            echo "<tr><th>FAMPAY</th><td>$income_fampay</td></tr>";
            echo "<tr><th>ICICI</th><td>$income_icici</td></tr>";
            echo "<tr><th>CASH</th><td>$income_cash</td></tr>";
            echo "<tr><th>Total</th><td>$total_income</td></tr>";

            ?>
            </tbody>
        </table>

        <!-- Table 3: Final Report -->
        <table>
            <caption>Final Report</caption>
            <thead>
            <tr>
                <th>Mode</th>
                <th>Amount Left</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Calculate amount left in each mode
            $final_fampay = $income_fampay - $expense_fampay;
            $final_icici = $income_icici - $expense_icici;
            $final_cash = $income_cash - $expense_cash;
            $final_amt = $final_fampay + $final_icici + $final_cash;

            // Display rows for final report table
            echo "<tr><th>FAMPAY</th><td>$final_fampay</td></tr>";
            echo "<tr><th>ICICI</th><td>$final_icici</td></tr>";
            echo "<tr><th>CASH</th><td>$final_cash</td></tr>";
            echo "<tr><th>Total</th><td>$final_amt</td></tr>";


            ?>
            </tbody>
        </table>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</section>
</body>
</html>

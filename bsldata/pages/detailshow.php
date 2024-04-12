<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <a href="../index.php">Entry</a>
        <a href="detailshow.php">Detail</a>
        <a href="expense.php">Expenses</a>
    </div>

    <div class="padding_left">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bsl_data";
            try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $sql = "SELECT * FROM student";
                    $stmt = $conn->prepare($sql);


                    $stmt->execute();


                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    if ($result) {
                        echo "<h2>Student Information</h2>";
                        echo "<table border='1' class='tbl_padding'>";
                        echo "<tr><th>Date</th><th>Name</th><th>Address</th><th>Contact Number</th><th>Remarks</th><th>Action</th></tr>";
                        foreach ($result as $row) {
                            echo "<tr><td>{$row['datee']}</td><td>{$row['name']}</td><td>{$row['address']}</td><td>{$row['contact']}</td><td>{$row['remarks']}</td>";
                            echo "<td><form method='post' action='../php/delete_record.php'>";
                            echo "<input type='hidden' name='record_id' value='{$row['sn']}'>";
                            echo "<input type='submit' name='delete' value='Delete'>";
                            echo "</form></td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No records found";
                    }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

        ?>



        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bsl_data";
            try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $sql = "SELECT * FROM expenses";
                    $stmt = $conn->prepare($sql);

                    $stmt->execute();


                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    if ($result) {
                        echo "<h2>Expenses Records</h2>";
                        echo "<table class='Ttable' border='1'>";
                        echo "<tr><th>Date</th><th>Catagory</th><th>Description</th><th>Amount</th><th>Action</th></tr>";
                        foreach ($result as $row) {
                            echo "<tr><td>{$row['datee']}</td><td>{$row['catagory']}</td><td>{$row['description']}</td><td>{$row['amount']}</td>
                                      <td>
                                        <form method='post' action='../php/delete_expenses.php'>
                                            <input type='hidden' name='delete_id' value='{$row['sn']}'>
                                            <input type='submit' name='delete' value='Delete'>
                                        </form>
                                      </td>
                                    </tr>";

                        }
                        echo "</table>";
                    } else {
                        echo "No records found";
                    }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

        ?>
        </div>

</body>
</html>
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

        <div class="form_div padding_left">
            <h2>Expenses</h2>
            <form action="expense.php" method="post" class="">
                <table>
                    <tr>
                        <td>
                            <label for="datee">Date:</label>
                        </td>
                        <td>
                            <input type="text" id="datee" name="datee" required class="detail_input"/><br>        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Catagory">Catagory:</label>
                        </td>
                        <td>
                            <input type="text" id="Catagory" name="catagory" required class="detail_input"/><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Description">Description:</label>
                        </td>
                        <td>
                            <input type="text" id="Description" name="description" required class="detail_input"/><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Amount">Amount:</label>
                        </td>
                        <td>
                            <input type="text" id="Amount" name="amount" required class="detail_input"/><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Submit" name="Submit" class="btn_submit"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
  

        <div class="padding_left">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "bsl_data";
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Submit"])) {
                    $datee = $_POST["datee"];
                    $catagory = $_POST["catagory"];
                    $description = $_POST["description"];
                    $amount = $_POST["amount"];


                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO expenses (datee, catagory, description, amount) VALUES (:datee, :catagory, :description, :amount)";

                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bindParam(':datee', $datee);
                            $stmt->bindParam(':catagory', $catagory);
                            $stmt->bindParam(':description', $description);
                            $stmt->bindParam(':amount', $amount);

                            if ($stmt->execute()) {
                                echo "Data inserted successfully";
                            } else {
                                echo "Error executing statement";
                            }
                        } else {
                            echo "Error preparing statement";
                        }

                        
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
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
                        $addamount = 0;

                        if ($result) {
                            echo "<h2>Expenses Records</h2>";
                            echo "<table border='1' class'tbl_padding'>";
                            echo "<tr><th>Date</th><th>Catagory</th><th>Description</th><th>Amount</th></tr>";
                            foreach ($result as $row) {
                                echo "<tr><td>{$row['datee']}</td><td>{$row['catagory']}</td><td>{$row['description']}</td><td>{$row['amount']}</td></tr>";
                                $addamount = $addamount + $row['amount'];
                            }
                            echo "<tr><td colspan='3'>Total</td><td>$addamount</td></tr></table>";
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



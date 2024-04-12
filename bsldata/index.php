<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Entry</a>
        <a href="pages/detailshow.php">Detail</a>
        <a href="pages/expense.php">Expenses</a>
    </div>

    <div class="form_div padding_left">
        <h2>Student Information Form</h2>
        <form action="index.php" method="post" class="">
            <table>
                <tr>
                    <td>
                        <label for="name">Date:</label>
                    </td>
                    <td>
                        <input type="text" id="datee" name="datee" required class="detail_input"/><br>        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Name:</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="name" required class="detail_input"/><br>        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Address:</label>
                    </td>
                    <td>
                        <input type="text" id="address" name="address" required class="detail_input"/><br>        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone">Contact No.:</label>
                    </td>
                    <td>
                        <input type="text" id="contact" name="contact" required class="detail_input"/><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Remarks:</label>
                    </td>
                    <td>
                        <input type="text" id="remarks" name="remarks" required class="detail_input"/><br>        
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
                $fdate = $_POST["datee"];
                $fname = $_POST["name"];
                $faddress = $_POST["address"];
                $fcontact = $_POST["contact"];
                $fremarks = $_POST["remarks"];


                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO student (datee, name, address, contact, remarks) VALUES (:datee, :name, :address, :contact, :remarks)";

                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bindParam(':datee', $fdate);
                        $stmt->bindParam(':name', $fname);
                        $stmt->bindParam(':address', $faddress);
                        $stmt->bindParam(':contact', $fcontact);
                        $stmt->bindParam(':remarks', $fremarks);

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


                    $sql = "SELECT * FROM student";
                    $stmt = $conn->prepare($sql);

                    $stmt->execute();


                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


                    if ($result) {
                        echo "<h2>Student Information</h2>";
                        echo "<table border='1' class'tbl_padding'>";
                        echo "<tr><th>Date</th><th>Name</th><th>Address</th><th>Contact Number</th><th>Remarks</th></tr>";
                        foreach ($result as $row) {
                            echo "<tr><td>{$row['datee']}</td><td>{$row['name']}</td><td>{$row['address']}</td><td>{$row['contact']}</td><td>{$row['remarks']}</td></tr>";
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bsl_data";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $record_id = $_POST["record_id"];


        $sql = "DELETE FROM student WHERE sn = :record_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':record_id', $record_id);


        $stmt->execute();

        echo "Record deleted successfully";
        $newPage = "../pages/detailshow.php";


        header("Location: $newPage");
        exit();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
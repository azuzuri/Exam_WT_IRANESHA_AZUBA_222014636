<?php
session_start();
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bed_and_break_fast"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["rid"])) {
    $rid = $conn->real_escape_string($_GET["rid"]);

    // Prepare DELETE statement
    $sql = "DELETE FROM revenue WHERE rid = $rid";

    // Execute DELETE statement
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";



         header("Location: revenue_table.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>
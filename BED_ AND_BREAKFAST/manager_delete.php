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

if (isset($_GET["mid"])) {
    $mid = $conn->real_escape_string($_GET["mid"]);

    // Prepare DELETE statement
    $sql = "DELETE FROM manager WHERE mid = $mid";

    // Execute DELETE statement
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
         header("Location: manager_table.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>
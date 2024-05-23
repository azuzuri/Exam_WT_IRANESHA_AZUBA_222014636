<?php
include "dbconnection.php";

if (isset($_GET["first_name"])) {
    $agid = $conn->real_escape_string($_GET["first_name"]);

    // Prepare DELETE statement
    $sql = "DELETE FROM agent WHERE lasst_name = $lasst_name";

    // Execute DELETE statement
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
         header("Location: agent_table.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>
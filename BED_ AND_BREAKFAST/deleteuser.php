<?php
include "dbconnection.php";

echo "<script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this record?');
        }
      </script>";

if (isset($_GET["uid"])) {
    $uid = $conn->real_escape_string($_GET["uid"]);

    // Prepare DELETE statement
    $sql = "DELETE FROM user WHERE uid = $uid";

    echo "<form method='post' onsubmit='return confirmDelete();'>"; // Moved form opening tag inside PHP block

    // Execute DELETE statement
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: user_table.php");
        exit(); // Added exit to prevent further execution after redirection
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
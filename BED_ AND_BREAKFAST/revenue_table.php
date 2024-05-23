<?php
// Connection details
include "dbconnection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set parameters
    $rid = $_POST['rid'];
    $amount = $_POST['amount'];    
    $revenue_type = $_POST['revenue_type']; 

    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO revenue (rid, amount, revenue_type) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $rid, $amount, $revenue_type);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch data from the revenue table
$sql = "SELECT * FROM revenue";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>revenue table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmInsert() {
            return confirm('Are you sure you want to Insert this record?');
        }
    </script>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            height: 50px;
            text-align: center;
            padding: 15px;
            color: white;
            background-color: blue;
        }
    </style> 
</head>
<body>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold;">BED_AND_BREAK_FAST SERVICE LTD</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold;">LIST OF REVENUES PAID IN OUR SYSTEM</h4>
        <a href="revenue_form.html" class="btn btn-primary" style="margin-top: 0px;">New User</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 100px;">Back Home</a>
        <table class="table table-bordered">
            <thead class="bg-warning">
                <tr>
                    <th>rid</th>
                    <th>amount</th>
                    <th>revenue_type</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any rows in the result
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['rid'] . "</td>
                            <td>" . $row['amount'] . "</td>
                            <td>" . $row['revenue_type'] . "</td>
                            <td><a style='padding: 4px;' href='revenue_delete.php?rid={$row['rid']}'>Delete</a></td>
                            <td><a style='padding: 4px;' href='revenue_edit.php?rid={$row['rid']}'>Edit</a></td> 
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <footer><!-- Footer section -->
        <p>&copy; &reg; 2024 UR CBE BIT YEAR 2 @ Group C</p><!-- Copyright and trademark notice -->
    </footer><!-- Footer section -->
</body>
</html>

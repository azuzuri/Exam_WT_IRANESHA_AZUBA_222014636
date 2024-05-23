<?php 
//call the file that contain database connection
include"dbconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $rid = $_GET["rid"];

    // Read the row of the selected product from the database
    $sql = "SELECT * FROM revenue WHERE rid=$rid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $amount = $row["amount"];
        $revenue_type = $row["revenue_type"];
    } else {
        header("location: /my project/revenue_table.php");
        exit;
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rid = $_POST["rid"];
    $amount = $_POST["amount"];
    $revenue_type = $_POST["revenue_type"];

    if (empty($rid) || empty($amount) || empty($revenue_type)) {
        echo "All feild are required!";
    }else {
        $sql = "UPDATE revenue SET rid='$rid', amount='$amount', revenue_type='$revenue_type' WHERE rid='$rid'";
    }
    if ($conn->query($sql) === TRUE) {
        echo " information updated successfully";
        header("location:/my project/revenue_table.php");
    }else {
        echo "Error updating record: " . $conn->error;
    
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script>
        function confirmUpdate() {
            return confirm('Do you want to update this record!');
        }
    </script>
   <style>
        h2{
            font-family:Castellar;
            color: darkblue;
        }
        label{
            font-family: elephant;
            font-size: 20px;
        }
        .sb{
            font-family:Georgia;
            padding: 10px;
            border-color: blue;
            background-color: skyblue;
            width: 200px;
            margin-top: 5px;
            border-radius: 12px;
            font-weight: bold;
            color: blue;

        }

        .input{
            width: 350px;
            height: 35px;
            border-radius: 12px;
            border-color: green;
        }
        footer{
    height: 50px;
    text-align: center;
    padding: 25px;
    color: white;
    background-color: blue;
}

    </style> 
</head>
<body>
<center>
    
    <h2>BED_AND_BREAK_FAST SERVICE </h2>
    <h3 style="color:green;">UPDATE REVENUE HERE</h3>
   <!-- section that contain form that help to update manager information-->
    <form method="POST" onsubmit="return confirmUpdate();">
    <label>Revenue Id</label><br>
    <input type="text" name="rid" readonly class="input" value="<?php echo $rid; ?>"><br>
     <label>Amount</label><br>
    <input type="text" name="amount"  class="input" value="<?php echo $amount; ?>"><br>
    <label>Revenue Type</label><br>
    <input type="text" name="revenue_type" class="input" value="<?php echo $revenue_type; ?>"><br>
    <input type="submit" name="submit" value="Update" class="sb"> 
</form>

</section>
</center>
        <footer><!-- Footer section -->
            <p><h1>&copy &reg 2024 UR CBE BIT YEAR 2 @ Group C</h1></p><!-- Copyright and trademark notice -->
        </footer><!-- Footer section -->
    </body>
    </html>
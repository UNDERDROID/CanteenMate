<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
 header("location: adminLogIn.php");
  exit;
}
require_once 'connection.php';
include_once ('adminNav.php');
//Delete operation
if (isset($_GET['Name'])) {  
  $Name = $_GET['Name'];  
  $query = "DELETE FROM `items` WHERE Name = '$Name'";  
  $run = mysqli_query($conn,$query);  
  if ($run) {  
       header('location:items.php');  
  }else{  
       echo "Error: ".mysqli_error($conn);  
  }  
}  

// Prepare the SQL statement to retrieve the orders
$sql = "SELECT * FROM items ORDER BY `Name` ASC";

// Execute the statement and store the result set
$result = $conn->query($sql);

// Check if there are any orders
if ($result->num_rows > 0) {
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="uploadStyle.css" rel="stylesheet" type="text/css"/> -->
    <title>Items</title>
    <style>
      @font-face{
    font-family: CanteenMate;
    src:url(fonts/Cream\ Cake.otf);
  }
  *{
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
  }
  body{
    background-color: black;
    background-attachment: fixed;
  }
  .box{
      padding-top: 60px;   
      background-color: rgba(218, 165, 32, 0.404);
      backdrop-filter: blur(2px);
      width: 600px;
      margin: auto;
      margin-top: 60px;
      border-radius: 10px;
      border: 1px solid rgb(236, 239, 243);
  }
  /* @keyframes logo{
    0%   {color: #2CD250; left: 300px; top: 0px;}
    100% {color: white; left: 0px; top: 0px;}
  } */
table {
  border-collapse: collapse;
  width: 100%;
  background-color: #1D2021;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

th{
  padding: 5px;
  text-align: center;
  border-bottom: 1px solid #DDD;
  color: white;
}
td{
    text-align: center;
    padding: 1px;
    color: white;
}
tr:nth-child(even)
{
background-color: #303436;
}
tr:hover {background-color: #3e4142;}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: .2s linear;
}
.button:hover{
    cursor: pointer;
    background-color: green;
}
.DeleteButton{
  background-color: #eb4034;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition: .2s linear;
}
.DeleteButton:hover{
    cursor: pointer;
    background-color: #b00f04;
}
@media screen and (max-width: 415px) {
nav{
  width:500px;
}
}
        </style>
</head>
<body>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Item Image</th>
            <th colspan="2">Operations</th>
        </tr> 
        <?php
        while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td> Rs." . $row["Price"] . "</td>";
        echo "<td>" . $row["image"] . "</td>";
        echo "<td><a href='update.php?Name=".$row['Name']."' class='button'>Update</a></td>";
        echo "<td><a href='items.php?Name=".$row['Name']."' class='DeleteButton'>Delete</a></td>";
        echo "</tr>";
        }
        ?>
</table>
</body>
</html>
<?php
    
} else {
    // Display a message if there are no orders
    echo "<tr><td colspan='6'>No items found.</td></tr>";
}

// Close the result set and the database connection
$result->close();
$conn->close();
?>
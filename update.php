<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
  header("location: adminLogIn.php");
  exit;
}
error_reporting(0);
require_once 'connection.php';
include_once ('adminNav.php');
$getname = $_GET['Name'];
$query = "select * from items where Name='$getname'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
if(isset($_POST["submit"])){
  $itemname = $_POST["itemname"];
  $price = $_POST["price"]; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="uploadStyle.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Update</title>
</head>
<body>
    <header>
<div class="box">
<section id="upload_container">
 <form action="#" method="POST" enctype="multipart/form-data">
  <h1 class="heading">CanteenMate</h1>
  <h2 class="heading2">Add a new item</h2>
  <input type="text" name="itemname" id="itemname" placeholder="Item Name" value="<?php echo $row["Name"];?>" required>
  <input type="number" name="price" id="price" placeholder="Item Price" value="<?php echo $row["Price"];?>"required>
  <input type="file" class="upload-box" name="image">
  <input type="submit" name="submit" value="Update">
 </form>    
</section>
</div>
    </header>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST"){
  exit("POST request method required");
}
if (empty($_FILES)) {
  exit('$_FILES is empty - is file_uploads in php.ini?');
}

$mime_types = ["image/gif", "image/png", "image/jpeg"];

if( ! in_array($_FILES["image"]["type"], $mime_types)){
  exit("Invalid file type");
}

$filename = $_FILES["image"]["name"];
$destination = __DIR__ . "/img/" . $filename;
$img ="img/".$filename;
if(!move_uploaded_file($_FILES["image"]["tmp_name"], $destination )){
  exit("Can't move uploaded file");
}

$sql = "UPDATE `items` SET `Name` = '$itemname', `Price` = '$price', `image` = '$img' WHERE `items`.`Name` = '$getname';";

if($conn->query($sql) === TRUE){
  echo "<script>alert('info updated')</script>";
}
?>
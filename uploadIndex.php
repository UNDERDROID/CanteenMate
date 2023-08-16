<?php
error_reporting(0);
require_once 'connection.php';
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
    <link href="uploadStyle.css" rel="stylesheet" type="text/css"/>
    <title>Upload</title>

</head>
<body>
    <header>
    <nav>
  <div class="logo" >CanteenMate</div>
    </div>
    <ol>
      <!-- <li><a href="index.php">Home</a></li> -->
      <li><a href="items.php">Items</a></li>
    </ol>
</nav>
<div class="box">
<section id="upload_container">
 <form action="#" method="POST" enctype="multipart/form-data">
  <h1 class="heading">CanteenMate</h1>
  <h2 class="heading2">Add a new item</h2>
  <input type="text" name="itemname" id="itemname" placeholder="Item Name" required>
  <input type="number" name="price" id="price" placeholder="Item Price" required>
  <input type="file" class="upload-box" name="image">
  <input type="submit" name="submit" value="Upload">
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

echo "<script>alert('Uploaded succesfully')</script>";
$sql = "INSERT INTO items(Name, Price, image)
VALUES('$itemname','$price','$img')";

if($conn->query($sql) === TRUE){
  echo "<script>alert('info uploaded')</script>";
}
?>
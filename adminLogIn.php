<?php
$adminlogin = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'connection.php';
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "Select * from admin where `Admin Name` = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  while($row=mysqli_fetch_assoc($result)){
    if (password_verify($password, $row['password'])) {
    //   echo 'Password is valid!';
      $adminlogin = true;
      session_start();
      $_SESSION['adminloggedin'] = true;
      $_SESSION['username'] = $username;
      header("location: checkOrders.php");
  } else {
      echo 'Invalid password.';
    } 
  }
} 
        ?>
<!DOCTYPE html>
<html>
    <link href="loginstyle.css" rel="stylesheet" type="text/css"/>
<head>
  <title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  @media screen and (max-width: 415px) {
  span.psw {
     display: block;
     float: none;
  }
  .createacc {
     width: 100%;
  }
  .modal{
    width: 100%;
  }
  .container{
    margin: auto;
  }
  input[type=text], input[type=password] {
    width:90%;
  }
  button{
    width:90%
  }
}
</style>
</head>
<body>

<div class="modal">
    <div class="container">
  <form class="modal-content animate"  method="post">
   
      <h1 class="logo">CanteenMate</h1>

    
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button>Login</button>
      <button class="button" onclick = "window.location.href='login.php';" type="button">Login as User</button>
    </div>

  </form>
 
</div>


</body>
</html>
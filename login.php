<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'connection.php';
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "Select * from users where username = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  while($row=mysqli_fetch_assoc($result)){
    if (password_verify($password, $row['password'])) {
      // echo 'Password is valid!';
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      header("location: index.php");
  } else {
      echo 'Invalid password.';
    } 
  }
} 
        ?>
<!DOCTYPE html>
<html>
    <link href="loginstyle.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
<head>
  <title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
      <button onclick = "window.location.href='adminLogIn.php';" type="button">Login as Admin</button>
      <label>
        <br>
        <input type="checkbox"  name="remember">Remember me
      </label>
    </div>

    <div class="container">
      <button onclick = "window.location.href='CreateAcc.php'; "type="button" class="btn2">Create Account</button>
      <span class="psw"><a href="#">Forgot password?</a></span>
    </div>
  </form>
</div>


</body>
</html>
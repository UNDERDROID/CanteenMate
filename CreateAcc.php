<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'connection.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        echo "Username Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
                echo "Account created";
            }
        }
        else{
            echo "Passwords do not match";
        }
    }
}
    
?>
<!DOCTYPE html>
<html>
    <link href="loginstyle.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SignUp</title>
</head>
<body>

<div class="modal">
    <div class="container">
  <form class="modal-content animate" action="CreateAcc.php" method="post">
   
      <h1 class="logo">CanteenMate</h1>

    
      <label for="username"><b>Username</b></label>
      <input type="text" maxlength="20" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      
      <label for="cpassword"><b>Password Confirmation</b></label>
      <input type="password" placeholder="Reenter Password" name="cpassword" required>
        
      <button type="submit">Sign Up</button>
    </div>

    <div class="container">
      <button onclick = "window.location.href='login.php';"
      type="button" class="btn2">Sign In</button>
    </div>
  </form>
</div>


</body>
</html>
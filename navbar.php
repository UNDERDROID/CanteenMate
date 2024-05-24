
<!-- session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
  require_once('connection.php');
  $query = "select * from items";
  $result = mysqli_query($conn,$query); -->
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head><title>CanteenMate-Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">

<!-- LINKS -->
    <!-- <link href="style.css" rel="stylesheet" type="text/css"/> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <script src="https://kit.fontawesome.com/fd5b11c396.js" crossorigin="anonymous"></script>
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
        background-color: white;
    }
    /* NAVIGATION BAR */
nav{
  display: flex;
  background-color: #2CD250;
  width: 100%;
  position: relative;
  justify-content: space-between;
  text-align: center;
  padding: 15px 30px;
  box-shadow: 0px -8px 16px 5px rgba(0,0,0,0.2);
}
nav .logo{
  display: flex;
  color: white;
  font-size: 50px;
  font-family: CanteenMate;
  cursor: pointer;
  position: relative;
  transition: .4s linear;
  animation-name: logo;
  animation-duration: 4s;
}
nav .logo:hover{
  color: green;
}
@keyframes logo{
  0%   {color: #2CD250; left: 300px; top: 0px;}
  100% {color: white; left: 0px; top: 0px;}
}

/* SEARCH BAR */
nav .search_box{
  display: flex;
  margin: auto 0;
  height: 35px;
  line-height: 35px;  
}
nav .search_box input{
  border: none;
  border-radius: 5px;
  outline: none;
  height: 100%;
  padding: 0 10px;
  font-size: 20px;
  width: 350px;
}
nav .search_box span{
  font-size:20px;
  background: white;
  border-radius: 50%;
  height: 100%;
  padding: 8px;
  position: relative;
  cursor: pointer;
  transition: .3s linear;
  z-index: 1;
}
nav .search_box span:hover{
  background: green;
  color: white;
  border: 0.5px solid white;
}
nav .search_box button{
  border: none;
border-radius: 50%;
background-color: #2CD250;

}
nav .fa-user{
  background-color: white;
  border-radius: 50%;
  border: 1px solid white;
  padding: 10px;
}
.dropdown {
  position: relative;
  display: inline-block;
}
  .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  right: 0px;
  top: 35px;
  z-index: 5;
}
.dropdown-content:hover{
  display: block;
}
 .dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  margin: auto;
}
.dropdown-content a:hover{
  color: white;
  background-color: #2CD250;
  border: 1px solid white;
}
.fa-user:hover +.dropdown-content{
  display: block;
}
.fa-user:hover{
  background-color: green;
  color: white;
  cursor: pointer;
}
</style>
  
</head>

<body>
<main>
<!-- NAVIGATION BAR   -->
      <nav>
        <div class="logo">CanteenMate</div>
        <!-- Search Box -->
        <div class="search_box">
          <form action="search.php" method="GET">
            <input type="text" class="search" placeholder="Search.." name="search">
            <button type="submit" class="fa fa-search"></button>
          </form>
        </div>
        <div class="dropdown">  
          <i class="fa-solid fa-user"></i>
          <div class="dropdown-content">
            <h1><?php echo $_SESSION['username'];?></h1>
            <a href="index.php">Home</a>
            <a href="myOrders.php">My Orders</a>
            <a href="logout.php">Log Out</a>  
          </div>
        </div>
      </nav>
</main>
</body>
</html>
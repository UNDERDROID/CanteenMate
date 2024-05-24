
  <?php  ?>
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
  color: white;
}
body{
    
    background-color: #3B3B3B
}

    /* NAVIGATION BAR */
nav{
  display: flex;
  background-color: #2B2B2B;
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
}
nav .logo:hover{
  color: green;
}
nav ol{
    display: flex;
    list-style: none;
    margin: auto 0;
  }
  nav ol li{
    margin: 0 2px;
  }
  nav ol li a{
    text-decoration: none;
    color: white;
    font-size: 20px;
    font-weight: bold;
    transition: .3s linear;
    font-family: Arial, Helvetica, sans-serif;
    padding: 5px 10px;
  }
  nav ol li a:hover{
    color: rgb(180, 37, 37);
  }
  nav .fa-user{
  background-color: black;
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
  background-color: #3B3B3B;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  right: 0px;
  top: 35px;
  z-index: 9;
}
.dropdown-content:hover{
  display: block;
}
 .dropdown-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  margin: auto;
}
.dropdown-content a:hover{
  color: white;
  background-color: #2B2B2B;
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
  <div class="logo" >CanteenMate</div>
    </div>
    </div>
        <div class="dropdown">  
          <i class="fa-solid fa-user"></i>
          <div class="dropdown-content">
            <h1><?php echo $_SESSION['username'];?></h1>
            <a href="uploadIndex.php">Upload</a>
            <a href="items.php">Items</a>
            <a href="checkOrders.php">Orders</a>  
            <a href="logout.php">Log Out</a>  
          </div>
        </div>
</nav>
</main>
</body>
</html>
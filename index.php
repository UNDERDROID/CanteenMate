<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
  require_once('connection.php');
  $query = "select * from items";
  $result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html>

<head><title>CanteenMate-Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">

<!-- LINKS -->
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <script src="https://kit.fontawesome.com/fd5b11c396.js" crossorigin="anonymous"></script>
    
  
</head>
<body>
<main>
<!-- NAVIGATION BAR   -->
<nav>
  <div class="logo">CanteenMate</div>
<!-- Search Box -->
  <div class="search_box">
  <form action="search.php" method="POST">  
  <input type="text" class="search" placeholder="Search..">
  <button type="submit"><span class="fa fa-search"></span></button>
</form>
    </div>
    <div class="dropdown">  
    <i class="fa-solid fa-user"></i>
   <div class="dropdown-content">
    <h1><?php echo $_SESSION['username'];?></h1>
    <a href="myOrders.php">My Orders</a>
    <a href="logout.php">Log Out</a>  
  </div>
  </div>
</nav>

<!-- SWIPER   -->
<div class="container">
  <div class="swiper">
    <div class="swiper-wrapper">
      
      <!-- SWIPER IMAGES -->
      <div class="swiper-slide"><img src="img/tsBurger.png" alt=""></div>
      <div class="swiper-slide"><img src="img/tsSamosa.png" alt=""></div>
      
    </div>
    
     <div class="swiper-pagination"></div>
     <div class="swiper-button-prev"></div>
     <div class="swiper-button-next"></div>
  </div>
</div>
 
<?php
      while($row = mysqli_fetch_assoc($result)){
  ?>
<!-- CARD -->
<div class="row">
  <div class="col">
  <form action="manageOrders.php" method="POST">
    <div class="crd">
      <img src="<?php echo $row['image'];  ?>" class="crd-img">
      <div class="crd-bdy">
        <h1 class="crd-title"><?php echo $row["Name"];  ?></h1>
        <p class="crd-subtitle"><?php echo 'Rs.' . $row["Price"];  ?></p>
        <input type="number" name="quantity" id="qty" placeholder="Quantity" min="1">
        <button type="submit" class="crd-btn" name="add-to-list">Add to list</button> 
        <input type="hidden" name="item_name" value="<?php echo $row["Name"];?>">
        <input type="hidden" name="item_price" value="<?php echo $row["Price"];?>">
      </div>
    </div>
   </form>  
  </div>
</div>

<?php 
    }
  ?>
    
  </section>
  <!-- JS link -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
 
  </main>
</body>
</html>
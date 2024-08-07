<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}
require_once('connection.php');
$query = "select * from items";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>

<head>
  <title>CanteenMate-Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">

  <!-- LINKS -->
  <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <script src="https://kit.fontawesome.com/fd5b11c396.js" crossorigin="anonymous"></script>


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
          <h1><?php echo $_SESSION['username']; ?></h1>
          <a href="myOrders.php"><i class="fa-solid fa-cart-shopping"></i>My Orders</a>
          <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
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

    <div class="crd-container">
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
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
                  <div class="quantity-input">
                    <button type="button" class="quantity-btn minus-btn">-</button>
                    <input type="number" name="quantity" class="qty" value="1" min="1">
                    <button type="button" class="quantity-btn plus-btn">+</button>
                  </div>
                  <button type="submit" class="crd-btn" name="add-to-list">Add to list</button>
                  <input type="hidden" name="item_name" value="<?php echo $row["Name"]; ?>">
                  <input type="hidden" name="item_price" value="<?php echo $row["Price"]; ?>">
                </div>
              </div>
            </form>
          </div>
        </div>

      <?php
      }
      ?>
    </div>

    </section>
    <!-- JS link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
    <div id="toast" class = "toast">Added to cart</div>
  </main>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const addToCartForms = document.querySelectorAll('form[action="manageOrders.php"]');
    const searchForm = document.querySelector('form[action="search.php"]');
    const toast = document.getElementById('toast');

    quantityInputs.forEach(input => {
      const minusBtn = input.querySelector('.minus-btn');
      const plusBtn = input.querySelector('.plus-btn');
      const quantityField = input.querySelector('.qty');

      minusBtn.addEventListener('click', () => {
        let value = parseInt(quantityField.value);
        if (value > 1) {
          quantityField.value = value - 1;
        }
      });

      plusBtn.addEventListener('click', () => {
        let value = parseInt(quantityField.value);
        quantityField.value = value + 1;
      });
    });

    addToCartForms.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        fetch('manageOrders.php', {
          method: 'POST',
          body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            showToast(data.message);
            // this.reset(); // Uncomment this line if you want to reset the form after submission
          } else {
            showToast('Error adding item to cart');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showToast('Error adding item to cart');
        });
      });
    });

    function showToast(message) {
      toast.textContent = message;
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3000);
    }
  });
</script>

</body>

</html>

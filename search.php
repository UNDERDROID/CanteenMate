<?php
include("navbar.php");
  require_once('connection.php');

  if (isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Query the database to retrieve items matching the search query
    $query = "SELECT * FROM items WHERE Name LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>CanteenMate - Search Results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
      .crd{
  width: 205px;
  height: 345px;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid white;
  position: relative;
  background: white;
  margin: 20px;
  display: inline-block;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
@media screen and (max-width: 1366px) {
  .crd {
    width: 220px;
  }
@media screen and (max-width: 415px) {
    nav .logo{
      display: none;
    }
    nav .search_box input{
  width: 150px;
  }
  .crd {
    width: 150px;
    height: 250px;
  }
}
      </style>
  </head>
  <body>
    <main>
      <!-- NAVIGATION BAR   -->


      <!-- SEARCH RESULTS -->
      <div class="container">
        <?php
          if (isset($_GET['search'])) {
            if (mysqli_num_rows($result) > 0) {
              // Display search results as cards
              while($row = mysqli_fetch_assoc($result)) {
                ?>
                  <div class="row">
                    <div class="col">
                      <form action="manageOrders.php" method="POST">
                        <div class="crd">
                          <img src="<?php echo $row['image']; ?>" class="crd-img">
                          <div class="crd-bdy">
                            <h1 class="crd-title"><?php echo $row["Name"]; ?></h1>
                            <p class="crd-subtitle"><?php echo 'Rs.' . $row["Price"]; ?></p>
                            <input type="number" name="quantity" id="qty" placeholder="Quantity">
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
            } else {
              // Display a message if no results were found
              echo "<p>No results found for '$search_query'</p>";
            }
          }
        ?>
      </div>
    </main>
  </body>
</html>

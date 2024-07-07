<?php
// session_start();
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//   header("location: login.php");
//   exit;
// }
include("navbar.php");
include("insert_khalti.php");
$User = $_SESSION['username'];
require_once 'connection.php';

// Prepare the SQL statement to retrieve the orders
$sql = "SELECT `Item Name`, `Item Price`, `Quantity`, `Total Price`, `Ordered Time`, `Status`
FROM `orders` WHERE `User` = '$User' ORDER BY `Item Name` ASC";

// Execute the statement and store the result set
$result = $conn->query($sql);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!$result) {
    die("Query error: " . $conn->error);
}
// Check if there are any orders
if ($result->num_rows > 0) {
    // Loop through each order and display it in the table
    $total_price = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body{
            background-color: #b1aeb5;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h3{
            font-size: 20px;
            color: white;
            text-shadow: 2px 2px gray;
        }
        .quantity-input {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-btn {
            width: 25px;
            height: 25px;
            background-color: #2CD250;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            margin: 0 5px;
        }
        .qty {
            width: 40px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .remove-btn {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
        }
        @media screen and (max-width: 415px) {
            nav{
                width: 450px;
            }
            nav .logo{
                font-size: 40px;
            }
            nav .search_box{
                display: none;
            }
            table{
                width: 414px;
            }
        }
            .paymentButton1:hover {
                box-shadow: 0px 8px 16px 0px #188f32; 
                border:1px solid #36eb5d;
                transition: 1s;
                
            }    
            .paymentButton2:hover {
                box-shadow: 0px 8px 16px 0px #5B2C92;
                border:1px solid #b076f5;
                transition: 1s;
                
            } 
            .button-container {
            display: flex !important;
            gap: 10px !important;   
            }
            .paymentButton1{
                width: 180px; 
                height: 50px; 
                background-color:#24bd45; 
                color:white; 
                font-weight:800; 
                background-image: url('img/esewa.png'); 
                background-size: contain; 
                background-repeat: no-repeat; 
                background-position: right center; 
                border:1px solid #36eb5d;
                border-radius: 5px; 
                cursor: pointer;
                text-align: left; 
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                transition: 1s;
            }
            .paymentButton2{
                width: 180px; 
                height: 50px; 
                background-color:#5B2C92; 
                color:white; 
                font-weight:800; 
                background-image: url('img/khalti.png'); 
                background-size: contain; 
                background-repeat: no-repeat; 
                background-position: right center; 
                border:1px solid #b076f5; 
                border-radius: 5px; 
                cursor: pointer;
                text-align: left; 
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                transition: 1s;
            }
            .updateButton{
                padding: 8px;
                margin-bottom: 8px;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                background-color: White;
                border: none;
                color: #615f5f;
                cursor: pointer;
                transition: 1s;
            }
            .updateButton:hover{
                background-color: #edebeb;
                transition: 1s;
            }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Ordered Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>    
        <?php
        while($row = $result->fetch_assoc()) {
          echo "<tr data-item-name='" . $row["Item Name"] . "' data-item-price='" . $row["Item Price"] . "'>";
          echo "<td>" . $row["Item Name"] . "</td>";
            echo "<td>Rs. " . $row["Item Price"] . "</td>";
            echo "<td>
                    <div class='quantity-input'>
                        <button type='button' class='quantity-btn minus-btn'>-</button>
                        <input type='number' name='quantity' class='qty' value='" . $row["Quantity"] . "' min='1' readonly>
                        <button type='button' class='quantity-btn plus-btn'>+</button>
                    </div>
                  </td>";
            echo "<td>Rs. " . number_format(intval($row["Total Price"]), 2) . "</td>";
            echo "<td>" . $row["Ordered Time"] . "</td>";
            echo "<td>" . $row["Status"] . "</td>";
            echo "<td><button class='remove-btn'>Remove</button></td>";
            echo "</tr>";
            $total_price += floatval($row["Total Price"]);
            $_SESSION['total_price'] = $total_price;
        }
        ?>
    </table> 
    <?php
    echo "<h3>Total Price: Rs. " . number_format($total_price, 2) . "</h3>";
    ?>
    <form action="createOrder.php" method="post">
        <button class="updateButton" type="submit">Update Order Id</button>
    </form>


<?php

$sql2 = "SELECT payment_id FROM esewa WHERE Username = '$User'";
$result2 = $conn->query($sql2);

if ($result2 === false) {
    die("Error executing query: " . $conn->error);
}

    while($esewa = $result2->fetch_assoc()) {
        $payment_id = $esewa["payment_id"];
        $_SESSION['payment_id']=$payment_id;
    }
//echo "Payment id:" . $_SESSION['payment_id'];


$message = 'total_amount='.$total_price.',transaction_uuid='.$payment_id.',product_code=EPAYTEST';
$secret = '8gBm/:&EnhH.1/q';
    $hash = hash_hmac('sha256', $message, $secret, true);

// Encode the hash in base-64
$base64Signature = base64_encode($hash);

// Output the base-64 encoded signature
//echo $base64Signature;
?>

<div class="button-container">
<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
 <input type="hidden" id="amount" name="amount" value="<?php echo $total_price;?>" required>
 <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
 <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total_price;?>" required>
 <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo $payment_id;?>" required>
 <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
 <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
 <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
 <input type="hidden" id="success_url" name="success_url" value="http://localhost/CanteenMate/esewa/payment_success.php" required>
 <input type="hidden" id="failure_url" name="failure_url" value="http://localhost/CanteenMate/esewa/payment_fail.php" required>
 <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
 <input type="hidden" id="signature" name="signature" value="<?php echo $base64Signature;?>" required>

<!-- Esewa payment button -->
<button class="paymentButton1" value="Submit">Pay using Esewa</button>
</form>


<!-- Khalti payment button -->
<button class="paymentButton2" id="payment-button">Pay using Khalti</button> 
</div>

<input type="hidden" name="username" id="username" value = "<?php echo htmlspecialchars($_SESSION['username']); ?>" >
<input type="hidden" name="token" id="token">
<input type="hidden" name="amount" id="amount">

<script>
$(document).ready(function() {
    function updateQuantity(row, change) {
        var quantityInput = row.find('.qty');
        var currentQuantity = parseInt(quantityInput.val());
        var newQuantity = currentQuantity + change;
        
        if (newQuantity >= 1) {
            quantityInput.val(newQuantity);
            updateItemTotal(row, newQuantity);
        }
    }

    function updateItemTotal(row, newQuantity) {
        var itemPrice = parseFloat(row.data('item-price'));
        var newTotal = itemPrice * newQuantity;
        row.find('.total-price').text('Rs. ' + newTotal.toFixed(2));
        updateTotalPrice();

        // Send update to server
        var itemName = row.data('item-name');
        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {
                action: 'update',
                itemName: itemName,
                quantity: newQuantity
            },
            success: function(response) {
                var result = JSON.parse(response);
                if(!result.success) {
                    alert('Failed to update quantity on server');
                }
            },
            error: function() {
                alert('Failed to communicate with server');
            }
        });
    }

    function updateTotalPrice() {
        var total = 0;
        $('.total-price').each(function() {
            total += parseFloat($(this).text().replace('Rs. ', ''));
        });
        $('#total-price span').text(total.toFixed(2));
    }

    // Use event delegation for dynamically created elements
    $(document).on('click', '.minus-btn', function() {
        updateQuantity($(this).closest('tr'), -1);
    });

    $(document).on('click', '.plus-btn', function() {
        updateQuantity($(this).closest('tr'), 1);
    });

    $(document).on('click', '.remove-btn', function() {
        var row = $(this).closest('tr');
        var itemName = row.data('item-name');
        
        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {
                action: 'remove',
                itemName: itemName
            },
            success: function(response) {
                var result = JSON.parse(response);
                if(result.success) {
                    row.remove();
                    updateTotalPrice();
                } else {
                    alert('Failed to remove item');
                }
            },
            error: function() {
                alert('Failed to communicate with server');
            }
        });
    });
});
</script>
</body>
 

<script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_b408f481b9114e7eafb2e4d71d052488",

            "productIdentity": "1234567890",
            "productName": "Orders",
            "productUrl": "http://localhost/CanteenMate/myOrders.php",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                    $('#token').val(payload.token);   
                    $('#amount').val(payload.amount);

                    var username = $('#username').val();
                    var token = $('#token').val();
                    var amount = $('#amount').val();
                   
                    $.ajax({
                    url: 'insert_khalti.php',
                    type: 'POST',
                    data: {
                        username: username,
                        token: token,
                        amount: amount
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

                },
                onError (error) {s
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: <?php echo $total_price*100; ?>});
            
        }
    </script>
</body>
</html>
<?php
    
} else {
    // Display a message if there are no orders
    echo "<tr><td colspan='6'>No orders found.</td></tr>";
}

// Close the result set and the database connection
$result->close();
$conn->close();
?>

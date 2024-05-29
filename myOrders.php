<?php
// session_start();
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//   header("location: login.php");
//   exit;
// }
include("navbar.php");
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

$result = $conn->query($sql);

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
            text-align: left;
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
            .paymentButton1:hover {
                box-shadow: 0px 8px 16px 0px #24bd45; /* Shadow color matching the background on hover */
            }       
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
        </tr>    
        <?php
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Item Name"] . "</td>";
            echo "<td>Rs. " . $row["Item Price"] . "</td>";
            echo "<td>" . $row["Quantity"] . "</td>";
            echo "<td>Rs. " . number_format(intval($row["Total Price"]), 2) . "</td>";
            echo "<td>" . $row["Ordered Time"] . "</td>";
            echo "<td>" . $row["Status"] . "</td>";
            echo "</tr>";
            $total_price += floatval($row["Total Price"]);
        }
        ?>
    </table> 
    <?php
    echo "<h3>Total Price: Rs. " . number_format($total_price, 2) . "</h3>";
    ?>
    <input type="hidden" name="username" id="username" value = "<?php echo htmlspecialchars($_SESSION['username']); ?>" >
    <input type="hidden" name="token" id="token">
    <input type="hidden" name="amount" id="amount">
    <?php
    echo '<button class="paymentButton1" style="width: 180px; height: 50px; background-color:#24bd45; color:white; font-weight:800; background-image: url(\'img/esewa.png\'); background-size: contain; background-repeat: no-repeat; background-position: right center; border:1px solid #0eeb3d; border-radius: 5px; cursor: pointer;text-align: left; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">Pay using Esewa</button> &nbsp';
    echo '<button class="paymentButton2" id="payment-button" style="width: 180px; height: 50px; background-color:#5B2C92; color:white; font-weight:800; background-image: url(\'img/khalti.png\'); background-size: contain; background-repeat: no-repeat; background-position: right center; border:1px solid #0eeb3d; border-radius: 5px; cursor: pointer;text-align: left; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">Pay using Khalti</button>';
    ?>

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

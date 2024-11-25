<?php
session_start();

include("db/db.php");

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login-regis.php');
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `buy` WHERE id = '$remove_id'") or die('query failed');
    header('location:file/product-user.php');
 }


$query1 = "SELECT * FROM buy WHERE user_id='$user_id'"; 
$result1 = mysqli_query($con, $query1);

if ($result1) {
  if (mysqli_num_rows($result1) > 0) {
      $user_data1 = mysqli_fetch_assoc($result1);

          $_SESSION['buyid'] = $user_data1 ['id']; 
          $_SESSION['cartuserid'] = $user_data1 ['user_id']; 
          $_SESSION['cartname'] = $user_data1 ['name'];
          $_SESSION['cartprice'] = $user_data1 ['price'];
          $_SESSION['cartsize'] = $user_data1 ['size']; // Assuming 'fname' is the field for first name
          $_SESSION['cartimage'] = $user_data1 ['image']; // Assuming 'email' is the field for email
          $_SESSION['cartquantity'] = $user_data1['quantity']; 
  }
}


/////////////////////////////////


// // Database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ecom";

// if(isset($_POST['orders'])){
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connecti
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $sql = "SELECT * FROM buy";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Prepare the INSERT statement with placeholders
//     $stmt = $conn->prepare("INSERT INTO orders (user_id, buyid, name, price, size, image, quantity, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("iissssi", $userId, $buyId, $name, $price, $size, $image, $quantity, $date);

//     // Fetching data from 'buy' and inserting into 'orders'
//     while($row = $result->fetch_assoc()) {
//       $buyId = $row['id'];
//         $userId = $row['user_id'];
//         $name = $row['name'];
//         $price = $row['price'];
//         $size = $row['size'];
//         $image = $row['image'];
//         $quantity = $row['quantity'];
//         $date = date("Y-m-d"); // Get current date in YYYY-MM-DD format 

//         $stmt->execute();
//     }

//     echo "Data inserted successfully!";
// } else {
//     echo "0 results found in 'buy' table.";
// }

// // Close connections
// $stmt->close();
// $conn->close();
// echo "nothing happen";  
// }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|| ALL PRODUCTS ||</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    </head>

    <body>

    <?php 
          $select_user = mysqli_query($con, "SELECT * FROM users WHERE ID = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select_user) > 0){
            $fetch_user = mysqli_fetch_assoc($select_user);
          };
        ?>
    
        <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="file/home-user.php"><img src="images/logo1.png" width="45px"></a>
                </div>
                <nav> 
            
                </nav>
                <a href="for cart.php"><img src="images/cart.png"></a>
                <img src="menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            </div>

    <!-- FOR CART ITEMS -->

    
    <div class="container">
    
    <div class="shopping-cart">
        
    <h1 class="heading">Checkout</h1>
    
    <table>
       <thead>
          <th>image</th>
          <th>name</th>
          <th>price</th>
          <th>size</th>
          <th>quantity</th>
          <th>total price</th>
       </thead>
       <tbody>
       <?php
          $cart_query = mysqli_query($con, "SELECT * FROM `buy` WHERE user_id = '$user_id'") or die('query failed');
          $grand_total = 0;
          if(mysqli_num_rows($cart_query) > 0){
             while($fetch_cart = mysqli_fetch_assoc($cart_query)){

       ?>
          <tr>
             <td><img src="images/<?php echo $fetch_cart['image'];?>" height="100" alt=""></td>
             <td><?php echo $fetch_cart['name']; ?></td>
             <td>$<?php echo $fetch_cart['price']; ?>/-</td>
             <td><?php echo $fetch_cart['size']; ?></td>
             <td>
                <form action="" method="post">
                   <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                   <p name="cart_quantity"><?php echo $fetch_cart['quantity']; ?></p>
                </form>
             </td>
             <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
          
          </tr>
          <?php
          $grand_total += $sub_total;
             }
          }else{
             echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
          }
       ?>
       <tr class="table-bottom">
          <td colspan="5">grand total :</td>
          <td>$<?php echo $grand_total; ?>/-</td>
         
       </tr>
    </tbody>
    </table>

    <br>
    <h2 class="heading">Payment Process:</h2>
    <br>
    <h5 style="padding-left:1rem;">Delivery Fee: ₱40</h5>
    <br>
    <select name="" id="" style="margin-left:0.5rem;">
        <option>Cash On Delivery</option>
    </select>
<!-- 
    <?php
          // $cart_query = mysqli_query($con, "SELECT * FROM `buy` WHERE user_id = '$user_id'") or die('query failed');
          // $grand_total = 0;
          // if(mysqli_num_rows($cart_query) > 0){
          //    while($fetch_cart = mysqli_fetch_assoc($cart_query)){
       ?> -->
    
    <div class="cart-btn">  
        <form action="send-email.php">
        <button  name="remove" class="btn" onclick="return confirm('are you sure?'); redirect();">cancel</button>
           <Button  href="checkout.php?orders=<?php echo $fetch_cart['id']; ?>" class="btn" name="orders" onclick="return confirm('Buy item from cart?');">Place Order</Button>
           </form>

           <?php
          //    }
          // }
       ?>
    </div>

    </div>
    </div>

    

               <!--FOOTER-->
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="footer-col-1">
                                <h3> Download Our App </h3>
                                <div class="app-logo">
                                    <img src="PS.png">
                                    <img src="AS.png">
                                </div>
                            </div>
                            <div class="footer-col-2">
                                <img src="logo.png" width="45px">
                                <p> STORE THAT SUPPORT ALL KINDS OF STYLE AND PREFERENCE </p>
                            </div>
                            <div class="footer-col-3">
                                <h3> LINKS </h3>
                                <ul>
                                    <li> Coupons </li>
                                    <li> Return Policy</li>
                                </ul>
                            </div>
                            <div class="footer-col-4">
                                <h3> Follow Us </h3>
                                <ul>
                                    <li> Facebook </li>
                                    <li> Twitter</li>
                                    <li> Instagram </li>
                                    <li> Youtube </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <p class="bottom"> EFFULGENT APPR. || Best Apparel Online Store </p>
                    </div>
                </div>

                <!--js for toggle menu-->

                <script>  

                    function redirect(){
                        window.location.href = "file/product-user.php"; 
                    }
                    var MenuItems=document.getElementById("MenuItems");

                    MenuItems.style.maxHeight= "0px";

                    function menutoggle(){
                        if(MenuItems.style.maxHeight == "0px")
                        {
                            MenuItems.style.maxHeight = "200px";
                        }
                        else
                        {
                            MenuItems.style.maxHeight = "0px";
                        }
                    }

                    var popup = document.getElementById("myPopup");
                    var openPopup = document.getElementById("openPopup");
                    var closePopup = document.getElementById("closePopup");

                    openPopup.onclick = function() {
                        popup.style.display = "flex";
                    }

                    closePopup.onclick = function() {
                        popup.style.display = "none";
                    }

                    window.onclick = function(event) {
                        if (event.target === popup) {
                            popup.style.display = "flex";
                        }
                    }
                </script>


    </body>   
    <style>

.alert>.start-icon {
    margin-right: 0;
    min-width: 20px;
    text-align: center;
}

.alert>.start-icon {
    margin-right: 5px;
}

.greencross
{
  font-size:18px;
      color: #25ff0b;
    text-shadow: none;
}

.alert-simple.alert-success
{
  border: 1px solid rgba(36, 241, 6, 0.46);
    background-color: rgba(7, 149, 66, 0.12156862745098039);
    box-shadow: 0px 0px 2px #259c08;
    color: #0ad406;
  text-shadow: 2px 1px #00040a;
  transition:0.5s;
  cursor:pointer;
}
.alert-success:hover{
  background-color: rgba(7, 149, 66, 0.35);
  transition:0.5s;
}
.alert-simple.alert-info
{
  border: 1px solid rgba(6, 44, 241, 0.46);
    background-color: rgba(7, 73, 149, 0.12156862745098039);
    box-shadow: 0px 0px 2px #0396ff;
    color: #0396ff;
  text-shadow: 2px 1px #00040a;
  transition:0.5s;
  cursor:pointer;
}

.alert-info:hover
{
  background-color: rgba(7, 73, 149, 0.35);
  transition:0.5s;
}

.blue-cross
{
  font-size: 18px;
    color: #0bd2ff;
    text-shadow: none;
}

.alert-simple.alert-warning
{
      border: 1px solid rgba(241, 142, 6, 0.81);
    background-color: rgba(220, 128, 1, 0.16);
    box-shadow: 0px 0px 2px #ffb103;
    color: #ffb103;
    text-shadow: 2px 1px #00040a;
  transition:0.5s;
  cursor:pointer;
}

.alert-warning:hover{
  background-color: rgba(220, 128, 1, 0.33);
  transition:0.5s;
}

.warning
{
      font-size: 18px;
    color: #ffb40b;
    text-shadow: none;
}

.alert-simple.alert-danger
{
  border: 1px solid rgba(241, 6, 6, 0.81);
    background-color: rgba(220, 17, 1, 0.16);
    box-shadow: 0px 0px 2px #ff0303;
    color: #ff0303;
    text-shadow: 2px 1px #00040a;
  transition:0.5s;
  cursor:pointer;
}

.alert-danger:hover
{
     background-color: rgba(220, 17, 1, 0.33);
  transition:0.5s;
}

.danger
{
      font-size: 18px;
    color: #ff0303;
    text-shadow: none;
}

.alert-simple.alert-primary
{
  border: 1px solid rgba(6, 241, 226, 0.81);
    background-color: rgba(1, 204, 220, 0.16);
    box-shadow: 0px 0px 2px #03fff5;
    color: #03d0ff;
    text-shadow: 2px 1px #00040a;
  transition:0.5s;
  cursor:pointer;
}

.alert-primary:hover{
  background-color: rgba(1, 204, 220, 0.33);
   transition:0.5s;
}

.alertprimary
{
      font-size: 18px;
    color: #03d0ff;
    text-shadow: none;
}

.square_box {
    position: absolute;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    border-top-left-radius: 45px;
    opacity: 0.302;
}

.square_box.box_three {
    background-image: -moz-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
    background-image: -webkit-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
    background-image: -ms-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
    opacity: 0.059;
    left: -80px;
    top: -60px;
    width: 500px;
    height: 500px;
    border-radius: 45px;
}

.square_box.box_four {
    background-image: -moz-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
    background-image: -webkit-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
    background-image: -ms-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
    opacity: 0.059;
    left: 150px;
    top: -25px;
    width: 550px;
    height: 550px;
    border-radius: 45px;
}

.alert:before {
    content: '';
    position: absolute;
    width: 0;
    height: calc(100% - 44px);
    border-left: 1px solid;
    border-right: 2px solid;
    border-bottom-right-radius: 3px;
    border-top-right-radius: 3px;
    left: 0;
    top: 50%;
    transform: translate(0,-50%);
      height: 20px;
}

.fa-times
{
-webkit-animation: blink-1 2s infinite both;
	        animation: blink-1 2s infinite both;
}


/**
 * ----------------------------------------
 * animation blink-1
 * ----------------------------------------
 */
@-webkit-keyframes blink-1 {
  0%,
  50%,
  100% {
    opacity: 1;
  }
  25%,
  75% {
    opacity: 0;
  }
}
@keyframes blink-1 {
  0%,
  50%,
  100% {
    opacity: 1;
  }
  25%,
  75% {
    opacity: 0;
  }
}

    </style>
    </html>
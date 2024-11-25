<?php
session_start();

include("db/db.php");

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login-regis.php');
};

if(isset($_POST['update_cart'])){
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    mysqli_query($con, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
    $message[] = 'cart quantity updated successfully!';
 }
 
 if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
    header('location:for cart.php');
 }

 if(isset($_GET['delete_all'])){
    mysqli_query($con, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:for cart.php');
 }

 $query1 = "SELECT * FROM cart WHERE user_id='$user_id'"; 
 $result1 = mysqli_query($con, $query1);

if ($result1) {
   if (mysqli_num_rows($result1) > 0) {
       $user_data1 = mysqli_fetch_assoc($result1);

           $_SESSION['cartid'] = $user_data1 ['id']; 
           $_SESSION['cartuserid'] = $user_data1 ['user_id']; 
           $_SESSION['cartname'] = $user_data1 ['name'];
           $_SESSION['cartprice'] = $user_data1 ['price'];
           $_SESSION['cartsize'] = $user_data1 ['size']; // Assuming 'fname' is the field for first name
           $_SESSION['cartimage'] = $user_data1 ['image']; // Assuming 'email' is the field for email
           $_SESSION['cartquantity'] = $user_data1['quantity']; 
   }
}

$query2 = "SELECT * FROM cart WHERE user_id='$user_id' LIMIT 1";
$result2 = mysqli_query($con, $query1);

if ($result2) {
   if (mysqli_num_rows($result2) > 0) {
       $user_data2 = mysqli_fetch_assoc($result2);

           $_SESSION['buyid'] = $user_data2 ['id']; 
           $_SESSION['cartname'] = $user_data2 ['name'];
           $_SESSION['cartprice'] = $user_data2 ['price'];
           $_SESSION['cartsize'] = $user_data2 ['size']; // Assuming 'fname' is the field for first name
           $_SESSION['cartimage'] = $user_data2 ['image']; // Assuming 'email' is the field for email
           $_SESSION['cartquantity'] = $user_data2['quantity']; 
   }
}

// $host = 'localhost';
// $dbname = 'ecom';
// $username = 'root';
// $password = '';

// if(isset($_GET['buy'])){
    
// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $buyid = $_GET['buy'] ;
//     // Assuming you have the user_id
//     $user_id = $_SESSION['user_id']; // or however you're getting the user_id
//     // Fetching items from the cart
//     $stmt = $conn->prepare("SELECT * FROM cart WHERE id= :buyid");
//     $stmt->bindParam(':buyid', $buyid);
//     $stmt->execute();
    
//     $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // Inserting items into the buy table
//     foreach ($items as $item) {
//         $buyStmt = $conn->prepare("INSERT INTO buy (user_id, name, price, size, image, quantity) VALUES (:user_id, :name, :price, :size, :image, :quantity)");
//         $buyStmt->bindParam(':user_id', $user_id);
//         $buyStmt->bindParam(':name', $item['name']);
//         $buyStmt->bindParam(':price', $item['price']);
//         $buyStmt->bindParam(':size', $item['size']);
//         $buyStmt->bindParam(':image', $item['image']);
//         $buyStmt->bindParam(':quantity', $item['quantity']);
//         $buyStmt->execute(); 
//     }

//     echo "Items successfully moved from cart to buy table.";



//     header('location:singlebuy.php');
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }

// $conn = null;

// }

$host = 'localhost';
$dbname = 'ecom';
$username = 'root';
$password = '';

if(isset($_GET['buy'])){
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $buy = $_GET['buy']; // Assuming buyid is the ID of a specific item in the cart
        $userId = $_SESSION['user_id']; // Or however you're getting the user_id

        // Fetch the specific item from the cart based on buyId and userId
        $stmt = $conn->prepare("SELECT * FROM cart WHERE id = :buy AND user_id = :userId");
        $stmt->bindParam(':buy', $buy);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Insert the item into the buy table
            $buyStmt = $conn->prepare("INSERT INTO buy (user_id, name, price, size, image, quantity) VALUES (:userId, :name, :price, :size, :image, :quantity)");
            $buyStmt->bindParam(':userId', $userId);
            $buyStmt->bindParam(':name', $item['name']);
            $buyStmt->bindParam(':price', $item['price']);
            $buyStmt->bindParam(':size', $item['size']);
            $buyStmt->bindParam(':image', $item['image']);
            $buyStmt->bindParam(':quantity', $item['quantity']);
            $buyStmt->execute();

            // Remove the item from the cart
            // $deleteStmt = $conn->prepare("DELETE FROM cart WHERE id = :buyId AND user_id = :userId");
            // $deleteStmt->bindParam(':buyId', $buyId);
            // $deleteStmt->bindParam(':userId', $userId);
            // $deleteStmt->execute();

            echo "Item successfully moved from cart to buy table.";
        } else {
            echo "Item not found in cart.";
        }

        header('location:checkout.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom";

// if(isset($_POST['allcart'])){
// $conn = new mysqli($servername, $username, $password, $dbname);
// $cartidd = $_GET['allcart'];
// // Check connecti
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $sql = "SELECT * FROM cart where user_id = $user_id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Prepare the INSERT statement with placeholders
//     $stmt = $conn->prepare("INSERT INTO buy (user_id, name, price, size, image, quantity) VALUES (?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("iissssi", $userId, $name, $price, $size, $image, $quantity);

//     // Fetching data from 'buy' and inserting into 'orders'
//     while($row = $result->fetch_assoc()) {
//         $userId = $row['user_id'];
//         $name = $row['name'];
//         $price = $row['price'];
//         $size = $row['size'];
//         $image = $row['image'];
//         $quantity = $row['quantity']; // Get current date in YYYY-MM-DD format 

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

if (isset($_POST['allcart'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming $user_id is obtained from a session or other secure method
    $userId = $_SESSION['user_id'];

    // Prepare the INSERT statement
    $stmt = $conn->prepare("INSERT INTO buy (user_id, name, price, size, image, quantity) VALUES (?, ?, ?, ?, ?, ?)"); // Add a placeholder for the date
    $stmt->bind_param("isssss", $userId, $name, $price, $size, $image, $quantity); // Add a data type for the date

    // Fetch items from the cart for the current user
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $userId);
    $stmt2->execute();
    $result = $stmt2->get_result();

    // Insert each item into the buy table
    while ($row = $result->fetch_assoc()) {
        $userId = $row['user_id'];
        $name = $row['name'];
        $price = $row['price'];
        $size = $row['size'];
        $image = $row['image'];
        $quantity = $row['quantity'];

        $stmt->execute();
    }

    header('location:checkout.php');

    $stmt->close();
    $stmt2->close();
    $conn->close();
}
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
                    <ul id="MenuItems">
                        <li><a href="file/home-user.php">Home</a></li>
                        <li><a href="file/product-user.php">Product</a></li>
                        <li><a href="file/about us-user.php">About</a></li>
                        <li><a href="file/contact-user.php">Contact</a></li>
                        <li><a href="account.php">Account</a></li>
                        <li><a href="orders.php">Order</a></li>
                    </ul>
                </nav>
                <a href="for cart.php"><img src="images/cart.png"></a>
                <img src="menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            </div>
            <br><br><br>
    <!-- FOR CART ITEMS -->
    <div class="container">
    
    <div class="shopping-cart">
    
    <h1 class="heading">shopping cart</h1>
    
    <table>
       <thead>
          <th>image</th>
          <th>name</th>
          <th>price</th>
          <th>size</th>
          <th>quantity</th>
          <th>total price</th>
          <th>action</th>
          <th>remove</th>
       </thead>
       <tbody>
       <?php
          $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
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
                   <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                   <input type="submit" name="update_cart" value="update" class="option-btn">
               
             </td>
             <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
             </form>
             <td><a href="?buy=<?php echo $fetch_cart['id']; ?>" name="buy" class="btn" onclick="return confirm('Buy item from cart?');">Buy</a></td>
           
             <td><a href="for cart.php?remove=<?php echo $fetch_cart['id']; ?>" name="remove" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
             
          </tr>
          <?php
          $grand_total += $sub_total;
             }
          }else{
             echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6" id="myDiv">no item added</td></tr>';
          }
       ?>
       <tr class="table-bottom">
          <td colspan="4">grand total :</td>
          <td>$<?php echo $grand_total; ?>/-</td>
          <td><a href="for cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
       </tr>
    </tbody>
    </table>
    
    <div class="cart-btn">  
        <form method="post">
        <button class="btn" id="checkButton" name="allcart">Proceed to Checkout</button>
        </form>
    </div>

    <script>
        document.getElementById('checkButton').onclick = function() {

            if (document.getElementById('myDiv')) {
                alert('NO ITEM ADDED');

            } else {
                window.location.href = "checkout.php"; 
            }
        }
    </script>
  
    </div>
    </div>
               <!--FOOTER-->
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="footer-col-1">
                                <h3> Download Our App </h3>
                                <div class="app-logo">
                                    <img src="images/PS.png">
                                    <img src="images/AS.png">
                                </div>
                            </div>
                            <div class="footer-col-2">
                                <img src="images/logo1white.png" width="45px">
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
    </html>
<?php
    
    session_start();

    include("../db/db.php");

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login-regis.php');
    };

    if(isset($_POST['add_to_cart'])){

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_size = $_POST['product_size'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
     
        $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
     
        if(mysqli_num_rows($select_cart) > 0){
           $message[] = '<section class="message"  id="removenotif">
       <div class="square_box box_three"></div>
       <div class="square_box box_four"></div>

     
            <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">product already added to cart!</strong>
          
        </div>
      </div>
     
          
           </div>
    
    
     </section>';

        }else{
           mysqli_query($con, "INSERT INTO `cart`(user_id, name, price, size, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_size','$product_image', '$product_quantity')") or die('query failed');
           $message[] = '<section class="" id="removenotif" >
    <div class="col-sm-12">
    <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">

      <strong class="font__weight-semibold">product added to cart!</strong>
    </div>
    </div>
    </section>';
    
        }
     
     };

     if(isset($_POST['buy'])){

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_size = $_POST['product_size'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
     
        $select_cart = mysqli_query($con, "SELECT * FROM `buy` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
     
        if(mysqli_num_rows($select_cart) > 0){
           $message[] = '<section class="message"  id="removenotif">
       <div class="square_box box_three"></div>
       <div class="square_box box_four"></div>

     
            <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">product already added to cart!</strong>
          
        </div>
      </div>
     
          
           </div>
    
    
     </section>';
        }
        else{
           mysqli_query($con, "INSERT INTO `buy`(user_id, name, price, size, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_size','$product_image', '$product_quantity')") or die('query failed');
           $message[] = 'product added to cart!';
           header('location:../checkout.php');
        }
     
     };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|| ALL PRODUCTS ||</title>

    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    </head>

    <body>

    <?php
       if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
     }

       $select_user = mysqli_query($con, "SELECT * FROM users WHERE ID = '$user_id'") or die('query failed');
       if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
       };
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|| ALL PRODUCTS ||</title>

    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    </head>

    <body>

    <?php
       if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
     }

       $select_user = mysqli_query($con, "SELECT * FROM users WHERE ID = '$user_id'") or die('query failed');
       if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
       };
    ?>
    
        <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="../file/home-user.php"><img src="../images/logo1.png" width="45px"></a>
                </div>
                <nav> 
                    <ul id="MenuItems">
                        <li><a href="../file/home-user.php">Home</a></li>
                        <li><a href="../file/product-user.php">Product</a></li>
                        <li><a href="../file/about us-user.php">About</a></li>
                        <li><a href="../file/contact-user.php">Contact</a></li>
                        <li><a href="../account.html">Account</a></li>
                    </ul>
                </nav>
                <a href="../for cart.php"><img src="../images/cart.png"></a>
                <img src="../images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            </div>
            
        <!--Product Details-->

        <?php
            $select_product = mysqli_query($con, "SELECT * FROM products where id = 17;") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>

            <div class="small-container single-product">
                <div class="row">
                    <div class="col-2">
                        <img src="../images/<?php echo $fetch_product['image']; ?>" width="100%" id="ProductImg">

                        <div class="small-img-row">
                            <div class="small-img-col">
                                <img src="../images/product5.jpg" width="100%" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="../images/product5-1.jpg" width="100%" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="../images/product5-2.jpg" width="100%" class="small-img">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                    <form method="post">
                        <p> Home / Shoes </p>
                        <h1><?php echo $fetch_product['name']; ?></h1>
                        <h4>₱<?php echo $fetch_product['price']; ?></h4>
                        <select name="product_size">
                            <option>Select Size</option> 
                            <option>XL</option> 
                            <option>Large</option> 
                            <option>Medium</option> 
                            <option>Small</option> 
                        </select>
                        <input type="number" name="product_quantity" value="1">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <button name="buy" class="btn">Buy now</button></a>
                        <button name="add_to_cart" class="btn">Add to cart</button>
                        </form>
                        <?php 
            };
        };
            ?> 
                        <h3>Product Details</h3>
                        <br>
                        <p>"Fashion is the part of the daily air and it changes all the time, with all events.
                            You can even see the approaching of a revolution in clothes. You can see and feel everything in clothes."</p>
                    </div>
                </div>
            </div>

                <!--TITLE-->
                    <div class="small-container">
                        <div class="row row-2">
                            <h2>Related Products</h2>
                            <a href="../file/product-user.php"><p>View More</p></a>
                        </div>
                    </div>


                <!--PRODUCTS-->
                <div class="small-container">
                    <div class="row">
                        <div class="col-4"> 
                            <a href="details for featured4user.php"><img src="../images/Featured4.jpg"> </a>
                            <a href="details for featured4user.php"><h4> Hoodie Black </h4></a>
                            <p> ₱2873.00 </p>
                            </div>
                            <div class="col-4"> 
                                <a href="details for product12user.php"><img src="../images/product12.jpg"> </a>
                                <a href="details for product12user.php"><h4> T Shirt Purple </h4></a>
                                <p> ₱958.00 </p>
                                </div>
                                <div class="col-4"> 
                                    <a href="details for product7user.php"><img src="../images/product7.jpg"> </a>
                                    <a href="details for product7user.php"><h4> T Shirt Grey </h4></a>
                                    <p> ₱1916.00 </p>
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
                                    <img src="../images/PS.png">
                                    <img src="../images/AS.png">
                                </div>
                            </div>
                            <div class="footer-col-2">
                                <img src="../images/logo1white.png" width="45px">
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
                        <p class="bottom"> KAIN PEPE APPR. Best Apparel Online Store</p>
                    </div>
                </div>

                <!--js for toggle menu-->

                <script>  
                function removenotif() {
                    const element = document.getElementById("removenotif");
                    element.remove();
                    }
                    
                    window.addEventListener("load", () => {
                    const loader = document.querySelector(".loader");

                    loader.classList.add("loader--hidden");

                    loader.addEventListener("transitionend", () => {
                        document.body.removeChild(loader);
                    });
                    });
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
                    
                </script>

                 <!-- JS FOR PRODUCT DETAILS-->

                 <script>
                    var ProductImg = document.getElementById("ProductImg");
                    var SmallImg = document.getElementsByClassName("small-img");

                    SmallImg[0].onclick = function()
                    {
                        ProductImg.src = SmallImg[0].src;
                    }
                    SmallImg[1].onclick = function()
                    {
                        ProductImg.src = SmallImg[1].src;
                    }
                    SmallImg[2].onclick = function()
                    {
                        ProductImg.src = SmallImg[2].src;
                    }
                   
                   

                 </script>


<div class="loader"></div>
    </body>
    <style>
        
    .alert-simple.alert-danger
{
  border: 1px solid rgba(241, 6, 6, 0.81);
    background-color: rgba(220, 17, 1, 0.16);
    box-shadow: 0px 0px 2px #ff0303;
    color: #ff0303;
  transition:0.5s;
  cursor:pointer;
}

.alert-simple.alert-success
{
  border: 1px solid rgba(36, 241, 6, 0.46);
    background-color: rgba(7, 149, 66, 0.12156862745098039);
    box-shadow: 0px 0px 2px #259c08;
    color: #0ad406;
  transition:0.5s;
  cursor:pointer;
}

.loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #333333;
  transition: opacity 1.75s, visibility 0.75s;
}

.loader--hidden {
  opacity: 0;
  visibility: hidden;
}

.loader::after {
  content: "";
  width: 75px;
  height: 75px;
  border: 15px solid #dddddd;
  border-top-color: #009578;
  border-radius: 50%;
  animation: loading 0.75s ease infinite;
}

@keyframes loading {
  from {
    transform: rotate(0turn);
  }
  to {
    transform: rotate(1turn);
  }
}
    </style>
    </html>
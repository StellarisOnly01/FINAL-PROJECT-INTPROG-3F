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
    
        <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="../home.php"><img src="../images/logo1.png" width="45px"></a>
                </div>
                <nav> 
                    <ul id="MenuItems">
                        <li><a href="../home.php">Home</a></li>
                        <li><a href="../product.php">Product</a></li>
                        <li><a href="../about us.php">About</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="../login-regis.php">Account</a></li>
                    </ul>
                </nav>
                <a href="for cart.php"><img src="../images/cart.png"></a>
                <img src="../images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            </div>
            
        <!--Product Details-->

            <div class="small-container single-product">
                <div class="row">
                    <div class="col-2">
                        <img src="../images/Latest4.jpg" width="100%" id="ProductImg">

                        <div class="small-img-row">
                            <div class="small-img-col">
                                <img src="../images/Latest4.jpg" width="100%" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="../images/Latest4-1.jpg" width="100%" class="small-img">
                            </div>
                            <div class="small-img-col">
                                <img src="../images/Latest4-2.jpg" width="100%" class="small-img">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <p> Home / Shoes </p>
                        <h1> Boots Beige White </h1>
                        <h4> ₱3685.00</h4>
                        <select>
                            <option>Select Size</option> 
                            <option>XL</option> 
                            <option>Large</option> 
                            <option>Medium</option> 
                            <option>Small</option> 
                        </select>
                        <input type="number" value="1">
                        <a href="../login-regis.php" class="btn-a"><button class="btn">Buy </a></button>
                        <a href="../login-regis.php" class="btn-a"><button class="btn"> Add to Cart</a></button>
                        
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
                            <a href="product.php"><p>View More</p></a>
                        </div>
                    </div>


                <!--PRODUCTS-->
                <div class="small-container">
                    <div class="row">
                        <div class="col-4"> 
                            <a href="details for latest1.php"> <img src="../images/Latest1.jpg"> </a>
                            <a href="details for latest1.php"><h4> Mid Skate Shoes Black </h4></a>
                            <p> ₱2873.00 </p>
                            </div>
                        <div class="col-4"> 
                            <a href="details for latest2.php"><img src="../images/Latest2.jpg"> </a>
                            <a href="details for latest2.php"><h4> Roses Skate Shoes Black </h4></a>
                            <p> ₱2873.00 </p>
                            </div>
                        <div class="col-4"> 
                            <a href="details for latest3.php"><img src="../images/Latest3.jpg"> </a>
                            <a href="details for latest3.php"><h4> Boots Chocolate </h4></a>
                            <p> ₱3685.00 </p>
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


    </body>
    <style>
        .btn-a{
            color: white;
        }
    </style>
    </html>
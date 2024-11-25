<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PASOK PO KAYO!! </title>

    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    </head>

    <body>
    <div class="headerforabout">
        <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="home.php"><img src="images/logo.png" width="45px"></a>
                </div>
                <nav> 
                    <ul id="MenuItems">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="product.php">Product</a></li>
                        <li><a href="about us.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="login-regis.php">Account</a></li>
                    </ul>
                </nav>
                <a href="for cart.php"><img src="images/cart.png"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1> Give Your Outfit <br> A New Style!</h1>
                    <p> One of the best apparel online stores is a store that offers a wide range of high-quality clothing and accessories for all types of gender. 
                        This store have a well-designed website that is easy to navigate, with clear product descriptions and high-quality images that accurately represent the products. </p>
                        <br>
                        <p>The store offers a variety of clothing options, from casual wear to formal attire, and should carry a range of sizes to accommodate different body types. 
                            The store should also offer a selection of accessories such as bags and shoes to complete the look.</p>
                            <br>
                            <p>Overall, the best apparel online store is one that offers high-quality clothing and accessories, an easy-to-use website, excellent customer service, and convenient shipping options.</p>
                <a href="product.php" class="btn"> Explore Now &#8594;</a>
                    </div>
                <div class="col-2">
                    <img src="images/headline.jpg" alt="">
                </div>
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
                </script>

    </body>
    </html>
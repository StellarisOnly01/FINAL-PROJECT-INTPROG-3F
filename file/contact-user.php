<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PASOK PO KAYO!! </title>

    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    </head>

    <body>
    <div class="header">
        <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="../home-user.php"><img src="../images/logo1.png" width="45px"></a>
                </div>
                <nav> 
                    <ul id="MenuItems">
                        <li><a href="home-user.php">Home</a></li>
                        <li><a href="product-user.php">Product</a></li>
                        <li><a href="about us-user.php">About</a></li>
                        <li><a href="contact-user.php">Contact</a></li>
                        <li><a href="../account.php">Account</a></li>
                        <li><a href="../orders.php">Order</a></li>
                    </ul>
                </nav>
                <a href="../for cart.php"><img src="../images/cart.png"></a>
                <img src="../images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1> Give Your Outfit <br> A New Style!</h1>
                    <p> "Fashion is the part of the daily air and it changes all the time, with all events. 
                       <br> You can even see the approaching of a revolution in clothes. You can see and feel everything in clothes." </p>
                <a href="product-user.php" class="btn"> Explore Now &#8594;</a>
                    </div>
                <div class="col-2">
                    <img src="../images/headline.jpg" alt="">
                </div>
            </div>
            </div>
        </div>

        
            <div class="small-container">
                <h2 class="title">GET IN TOUCH</h2>
                <h4>Visit and Contact Us Today</h4>
                <br>
                <p><img src="../images/email.png" alt="">  EFFULGENTAPPR@gmail.com</p>
                <p><img src="../images/phone.png" alt="">  +63 813 980 6450 </p>
                <p><img src="../images/time.png" alt="">  Monday to Sunday: 9:00am to 9:00pm</p>
            </div>
            <br>
            <div class="small-container">
                <form action="">
                    <h2 class="title">LEAVE A MESSAGE</h2>
                    <h2>We love to hear from you</h2>
                    <input type="text" placeholder="Your Name">
                    <input type="text" placeholder="E-mail">
                    <input type="text" placeholder="Subject">
                    <textarea name="" id="" cols="25" rows="7" placeholder="Your Message"></textarea>
                    <br>
                    <button class="btn">Submit</button>

                </form>

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

    </body>
    </html>
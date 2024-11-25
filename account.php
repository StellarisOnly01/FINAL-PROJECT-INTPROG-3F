<?php

session_start();

$cook = $_COOKIE['cook'] ?? 'Unknown';
$newcook = filter_var($cook, FILTER_SANITIZE_STRING); 

include("db/db.php");

$user_id = $_SESSION['user_id'];

    

if(!isset($user_id)){
    header('location:login.php');
};

$id = isset($_SESSION['id']) ? $_SESSION['id'] : ""; 
$name = isset($_SESSION['name']) ? $_SESSION['name'] : ""; 
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ""; 
$address = isset($_SESSION['adds']) ? $_SESSION['adds'] : "";
$contactnum = isset($_SESSION['contactnumber']) ? $_SESSION['contactnumber'] : "";

if (isset($_POST['updatesub'])) {

    $updname = mysqli_real_escape_string($con, $_POST['new_name']); 
    $updcont = mysqli_real_escape_string($con, $_POST['contactnm']);
    $updadd = mysqli_real_escape_string($con, $_POST['address']);

    if (!empty($updname) && !empty($updadd) && !empty($updcont)) {

        $update_query = "UPDATE users SET name = ?, address = ?, cnum = ?  WHERE ID = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "ssii", $updname, $updadd, $updcont, $id);

        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            $message[] = "Information updated successfully.";

            $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($con, $query);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);

                        $_SESSION['name'] = $user_data['name']; // Assuming 'fname' is the field for first name
                        $_SESSION['email'] = $user_data['email']; 
                        $_SESSION['adds'] = $user_data['address']; 
                        $_SESSION['contactnumber'] = $user_data['cnum']; 

                        header("location: account.php");
                    }
                  
        } else {
            $message[] = '<section class="message"  id="removenotif">
       <div class="square_box box_three"></div>
       <div class="square_box box_four"></div>

     
            <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">Error updating information!</strong>
          
        </div>
      </div>
     
          
           </div>
    
    
     </section>';
     if(isset($loginmessage)){
        unset($loginmessage);  
    }
    
        }
    }
        mysqli_stmt_close($stmt);
      
    } else {
        $message[] = '<section class="message"  id="removenotif">
       <div class="square_box box_three"></div>
       <div class="square_box box_four"></div>

     
            <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">Error updating information!</strong>
          
        </div>
      </div>
     
          
           </div>
    
    
     </section>';
     if(isset($loginmessage)){
        unset($loginmessage);  
    }
    
    }
}

if (isset($_POST['closeform'])) {
    unset($loginmessage);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Register</title>

   <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="style.css">
   <!-- <link rel="stylesheet" href="css/style.css"> -->
  
</head>
<body>
<?php

if(isset($loginmessage)){
    foreach($loginmessage as $loginmessage){
echo $loginmessage;
    }}

if(isset($message)){
   foreach($message as $message){
      echo ''.$message.'</div>';
   }
}
?>

    <?php
       $select_user = mysqli_query($con, "SELECT * FROM users WHERE ID = '$user_id'") or die('query failed');
       if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
       };
    ?>

<div class="header" onclick="removenotif()">

        <div class="container">
        <div class="navbar">
                <div class="logo">
                <a href="file/home-user.php"><img src="images/logo1.png" width="45px"></a>
                </div>
                <nav> 
                    <ul id="MenuItems" data-*unset($loginmessage);>
                        <li><a href="file/home-user.php">Home</a></li>
                        <li><a href="file/product-user.php">Product</a></li>
                        <li><a href="file/about us-user.php">About</a></li>
                        <li><a href="file/contact-user.php">Contact</a></li>
                        <li><a href="account.php" >Account</a></li>
                        <li><a href="orders.php">Order</a></li>
                    </ul>
                </nav>
                <a href="for cart.php"><img src="images/cart.png"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            
             
        <div class="responsive-form"> 
            <h1 class="display-title">WELCOME</h1>
            <p class="display-input">Username: <span><?php echo $name; ?></span></p>
            <p class="display-input">Cookie: <span><?php echo $newcook; ?></span></p>
            <p class="display-input">Email: <span><?php echo $email; ?></span></p>
            <p class="display-input" >Contact Number: <span>+0<?php echo $contactnum; ?></span></p>
            <p class="display-input">Address: <span><?php echo $address; ?></span></p>
            <button name="updadd" class="display-button" id="openPopup">UPDATE</button>
         
          

        <a href="home.php" name="logout" class="logout-link" onclick="return confirmLogout()">Log out</a>

        <script>
            function confirmLogout() {
                return confirm("Are you sure you want to logout?");
            }
        </script>
        </div>

        <div  class="popup" id="myPopup">
                <div class="popup-content"> 
                    <form method="POST" id="contactForm">
                    <button class="close-btn" id="closePopup" name="closeform">&times;</button>
                    <br><br>
                        <div class="form-group" >
                        
                        <input type="hidden" name="ID" value="<?php echo $id; ?>">
                        <br>
                        <label for="">Name:</label>
                        <input type="text" name="new_name" id="name" placeholder="New name">
                        <br>
                        <label for="">Contact:</label>
                        <input type="text" id="contact" name="contactnm" placeholder="+09">
                        <label for="">Address:</label>
                        <textarea name="address" id="address" rows="4" cols="40" class="form-textarea" placeholder="New Address"></textarea>
                        <button name="updatesub" type="submit"  class="updsub">SUBMIT</button> 
                        </div>
                    </form>
                </div>

                </div>
    
</div>  

<br><br><br><br><br><br>

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


<!-- custom js file link  -->
<script src="js/script.js"></script>
                <script>
    
                    function removenotif() {
                    const element = document.getElementById("removenotif");
                    element.remove();
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

                <script>
                    var LoginForm=document.getElementById("LoginForm");
                    var RegForm=document.getElementById("RegForm");
                    var Indicator=document.getElementById("Indicator");

                    function register(){
                        RegForm.style.transform="translateX(0px)";
                        LoginForm.style.transform="translateX(0px)";
                        Indicator.style.transform="translateX(100px)";
                    }
                    function login(){
                        RegForm.style.transform="translateX(300px)";
                        LoginForm.style.transform="translateX(300px)";
                        Indicator.style.transform="translateX(0px)";
                    }


                </script>

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

    .popup {
    display: none; 
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 353px;
}
.updsub{
    width: 100%;
    margin-top: 1rem;
    padding: 13px 0px 13px 0px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: #007BFF;
    color: white;
}
.close-btn {
    cursor: pointer;
    float: right;
    font-size: 18px;
    border: none;
    background: none;
    color: black;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 15px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}


.responsive-form {
    
    border-radius: 10px;
    background: #fff;
    max-width: 1300px;
    max-height: 500px;
    position: left;
    text-align: center;
    padding: 20px 0;
    margin-bottom: 5rem;
    box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.1);
}

span{
    color: black;
    font-size: 19px;
    padding-left: 10px;
   
}

.display-title {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

.display-input{
    text-align: left;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 2px;
    font-size: 16px;
}

.form-input:focus{
    outline: none;
    border-color: #007BFF;
}


.display-button {
    width: 40%;
    padding: 10px;
    border: none;
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.display-button:hover, .updsub:hover {
    background-color: #0056b3;
}

.logout-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #007BFF;
    text-decoration: none;
    font-size: 20px;
}

.logout-link:hover {
    text-decoration: underline;
}

</style>
</html>
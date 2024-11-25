<?php
      session_start();
      
    include("db/db.php");

    if(isset($_POST['submit']))
    {
        
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['pass']);
        
        $select = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or die('query failed');
        
        if(mysqli_num_rows($select) > 0){
            $message[] ='  <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">user already exist!</strong>          
        </div>
      </div>
     ';
        }
        else {
           mysqli_query($con, "INSERT INTO users (name, email, pass) values ('$name', '$email', '$password')")
            or die('query failed');
            $message[] ='<div class="col-sm-12">
        <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">

          <i class="start-icon far fa-check-circle faa-tada animated"></i>
          <strong class="font__weight-semibold">registered successfully!</strong>
        </div>
      </div>';
        
        }
    }

    if(isset($_POST['submit1'])){
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

     
        setCookie('cook', $_POST['email'], time() + 1000 );

        $email = $_POST['email'];
        $password = $_POST['pass'];
    
        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($con, $query);

        
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
    
                    if ($user_data['pass'] == $password) {
                        
                        $_SESSION['id'] = $user_data['ID']; 
                        $_SESSION['user_id'] = $user_data['ID'];
                        $_SESSION['name'] = $user_data['name']; 
                        $_SESSION['email'] = $user_data['email']; 
                        $_SESSION['adds'] = $user_data['address']; 
                        $_SESSION['contactnumber'] = $user_data['cnum']; 
                         
                        header("location:account.php");
                        die;
                    }
                }
            }
            $message[] ='<section class="message"  id="removenotif">
       <div class="square_box box_three"></div>
       <div class="square_box box_four"></div>

     
            <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">wrong username or password!</strong> Change a few things up and try submitting again.
          
        </div>
      </div>
     
          
           </div>
    
    
     </section>';;
    
        } else {
            $message[] ='<section class="message"  id="removenotif">
       <div class="square_box box_three"></div>
       <div class="square_box box_four"></div>

     
            <div class="col-sm-12">
        <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
    
          <strong class="font__weight-semibold">wrong username or password!</strong> Change a few things up and try submitting again.
          
        </div>
      </div>
     
          
           </div>
    
    
     </section>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="refresh" content="30">
   <title>Register</title>

   <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="style.css">

  
</head>
<body>
<?php 
    if(isset($message)){
        foreach($message as $message){
           echo  '<div class="message" id="removenotif">'.$message.'</div>';
        }
     }
     
    ?>
<div class="header">
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
                <a href="for cart.html"><img src="images/cart.png"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
                
    </div>
    
</div>
   

<div class="account-page" onclick="removenotif()">
            <div class="containerpopup">
        
                 <br><br><br><br><br><br><br><br><br><br><br>
                 <br><br><br><br><br><br><br><br>
                 
                 <div class="popup" id="myPopup">
                    
       <div class="row">
           <div class="col-2">
               <div class="form-container" id="myPopup" onclick="message.remove();">
               
                 <div class="form-btn">
                 <button class="close-btn" id="closePopup">&times;</button>
                 <br>
                   <span onclick="login()">Login</span>
                   <span onclick="register()">Register</span>
                   
                   <hr id="Indicator">
                 </div>
                 <form id="LoginForm" method="POST">
                    <input type="text" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="pass" required>
                    <button type="submit" name="submit1" class="btn">Login</button>
                    <a href="">Forgot Password</a>
                 </form>
                 <form id="RegForm" method="POST">
                    <input type="text" placeholder="Name" name="name">
                    <input type="email" placeholder="Email" name="email">
                    <input type="password" placeholder="Password" name="pass">
                    <button type="submit" name="submit" class="btn">Register</button>      
                 </form>
               </div>
               </div>
            </div>  
        </div>
</div>
</div>


<style>
.popup{
    background: rgba(0, 0, 0, 0.3);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.close-btn {
    cursor: pointer;
    float: right;
    font-size: 18px;
    border: none;
    background: none;
    color: black;
}

button:hover {
    background-color: #218838;
    color: white;
}

button {
    padding: 5px 10px;
    margin-left: 5rem;
    margin-bottom: 0.8rem;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

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

</style> 

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
                                <img src="images/logo.png" width="45px">
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

var popup = document.getElementById("myPopup");

var closePopup = document.getElementById("closePopup");
window.onclick = function(event) {
    if (event.target === popup) {
        popup.style.display = "flex";
    }
}

closePopup.onclick = function() {
  popup.style.display = "none";
 }

 var message = document.getElementById("msg");
</script>

</body>

</html>
<?php
  session_start();
      
  include("db/db.php");
  

  $user_id = $_SESSION['user_id'];
  $cartid = $_SESSION['cartid'];
  $cartname = $_SESSION['cartname'];
  $cartprice = $_SESSION['cartprice'];
  $cartsize = $_SESSION['cartsize'];
  $cartimage = $_SESSION['cartimage']; 
  $cartquantity = $_SESSION['cartquantity'];
  $date = date("Y, m, d");

$cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

$name = isset($_SESSION['name']) ? $_SESSION['name'] : ""; 
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ""; 

$Etrendname = "E-Trend"; 
$Etrendemail = "Etrend@gmail.com";

$subject = "Hi $name";
$message = "
Your order has been confirmed. Your stylish items are on their way.";


require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "k09656848415@gmail.com";
$mail->Password = "doxq dycl xzam fjat";

$mail->setFrom($Etrendemail, $Etrendname);
$mail->addAddress($email, $name);

$mail->Subject = $subject;
$mail->Body=$message;

$mail->send();


//     mysqli_query($con, "
// DELETE FROM cart
// WHERE user_id IN (SELECT id FROM users);") or die('query failed');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM buy";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $stmt = $conn->prepare("INSERT INTO orders (user_id, buyid, name, price, size, image, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssi", $userId, $buyId, $name, $price, $size, $image, $quantity);


    while($row = $result->fetch_assoc()) {
        $userId = $row['user_id'];
        $buyId = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $size = $row['size'];
        $image = $row['image'];
        $quantity = $row['quantity'];


        $stmt->execute();
    }

    echo "Data inserted successfully!";
} else {
    echo "0 results found in 'buy' table.";
}

$date = date('Y-m-d');
mysqli_query($con, "UPDATE `orders` SET date = '$date' WHERE user_id = '$user_id'") or die('query failed');
mysqli_query($con, "DELETE FROM `buy` WHERE user_id = '$user_id'") or die('query failed');
$stmt->close();
$conn->close();

    header('location: file/product-user.php');


echo "email send";
?>
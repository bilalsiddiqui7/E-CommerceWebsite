<?php
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'shoppingcart');

extract($_POST);
if(isset($_POST['submit'])){
    $que="INSERT INTO `shoppingcarttable`(`name`, `image`, `price`, `discount`) VALUES ('nameupload','imageupload','priceupload','discountupload')";
    $query=mysqli_query($con,$que);
    header('location:upload.php');
}
?>
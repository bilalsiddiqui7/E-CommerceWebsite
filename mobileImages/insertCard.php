<?php
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'crudpractice');

extract($_POST);
if(isset($_POST['addToCart'])){
    $que="INSERT INTO `ecommerse`(`price`, `quantity`, `name`) VALUES ('$price','$quantity','$name')";
    $query=mysqli_query($con,$que);
    header('location:index.php');
}
?>
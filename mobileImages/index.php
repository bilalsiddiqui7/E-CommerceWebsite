<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <h1 class="text-center text-danger">Mobiles & Accessories</h1>
  <div class="text-center mb-2">
    <a href="index.php" class="btn btn-warning col-lg-2">Home</a>
    <a href="viewCart.php" class="btn btn-warning col-lg-2">Cart</a>
    <a href="upload.php" class="btn btn-warning col-lg-2">upload</a>
  </div>
  <div class="row">
    <?php
    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'shoppingcart');
    $query = " SELECT `id`, `name`, `image`, `price`, `discount` FROM `shoppingcarttable` order by id ASC ";
    $queryfire = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryfire);
    if ($num > 0) {
      while ($product = mysqli_fetch_array($queryfire)) {
    ?>
        <div class="col-lg-3 col-md-4 col-sm-12">
          <form id="myform" action="insertCard.php" method="POST">
            <div class="card">
              <h6 class="card-title bg-info text-white p-2 text-uppercase"> <?php echo $product['name']; ?></h6>
              <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
              <div class="card-body">
                <img src="<?php echo $product['image']; ?>" alt="" class="img-fluid ">
                <h6> &#8377; <?php echo $product['price']; ?> <span>(<?php echo $product['discount']; ?>)% off</span></h6>
                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
              </div>
              <h6 class="badge badge-success">4.2 <i class="fa fa-star"></i></h6>
            </div>
            <input name="quantity" type="text" class="col-xs-8" name="quantity" id="" placeholder="Quantity">
            <div class="btn-group d-flex">
              <button name="addToCart" id="addToCart" class="btn btn-success flex-fill">Add to cart</button>
              <button class="btn btn-warning flex-fill">Buy now</button>
            </div>
          </form>
        </div>
    <?php
      }
    }
    ?>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      var form = $('#myform');
      $('addToCart').click(function() {
        $.ajax({
          url: form.attr("action"),
          type: 'post',
          data: $("#myform input").serialize(),
          success: function(data) {
            console.log(data);
          }
        })
      });
    });
  </script>
</body>

</html>
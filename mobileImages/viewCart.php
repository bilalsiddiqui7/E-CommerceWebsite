<?php
session_start();
?>
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
    </div>
    <h2 class="text-center mb-2">Your cart products :</h2>

    <?php
    $username = "root";
    $password = "";
    $server = 'localhost';
    $db = 'crudpractice';

    $conn = mysqli_connect($server, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT `price`, `quantity`, `name` FROM `ecommerse`";
    $result = $conn->query($sql);
    $count = 0;
    $totalprice = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $q = $row["quantity"];
            $price = $row["price"];
            echo "<table border='1'>

            <tr>
            
            <th>name</th>
            
            <th>quantity</th>
            
            <th>price</th>

            <th>Total price</th>

            <th>Delete</th>
            
            </tr>";
            echo "<tr>";

            echo "<td>" . $row['name'] . "</td>";

            echo "<td>" . $row["quantity"] . "</td>";

            echo "<td>" . $row["price"] . "</td>";

            echo "<td>" . $row["price"] * $q . "</td>";
            echo "<td><input type='submit' name='event' value='delete' class='btn btn-danger'></td>";
            echo "</tr>";
            echo "</table>";
            $totalprice = $q * $price;
            $count = $count + $totalprice;
        }
    } else {
        echo "0 results";
    }
    ?>
    <h2 class="text-right mr-5 mt-5">Total amount to be paid is :<?php echo $count ?></h2>
    <form action="checkout.php">
        <div class="text-right mr-5 mt-5"><button type="button " class="btn btn-success">Checkout</button></div>
    </form>
    <?php
    $conn->close();
    ?>
    <!-- Displaying data from database using sessions  -->
    <tbody>
        <?php
        $bill = 0;
        $sno = 1;
        $count = 0;
        foreach ($_SESSION as $products) {
            $p = 0;
            $q = 0;
            echo "<tr>";
            // echo "<td>" .($sno++). "</td";
            foreach ($products as $key => $value) {
                if ($key == 2) {
                    echo "<td>" . $value . "</td>";
                    $q = $value;
                } else if ($key == 1) {
                    echo "<td>" . $value . "</td>";
                    $p = $value;
                } else if ($key == 0) {
                    echo "<td>" . $value . "</td>";
                }
            }
            $bill = ($q * $p);
            $count = $count + $bill;
            echo "<td>" . ($bill) . "</td>";
            echo "<td><input type='submit' name='event' value='update' class='btn btn-warning'></td>";
            echo "<td><input type='submit' name='event' value='delete' class='btn btn-danger'></td>";
            echo "</tr>";
        }
        ?>
    </tbody> -->
    </table>

</body>

</html>

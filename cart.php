<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - Cart</title>
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/img/icon-website.png">
</head>

<body>
    <div class="app-container">
        <!-- navbar -->
        <div class="header-container">
            <div class="logo-app">
                <img src="./assets/img/logo.png" alt="logo">
            </div>
            <ul class="header-list">
                <li class="header-item">
                    <a href="index.php" class="header-link" aria-current="page">Home</a>
                </li>
                <li class="header-item">
                    <a href="display_all.php" class="header-link">Products</a>
                </li>
                <?php
                if (!isset($_SESSION['username'])) {
                    echo " <li class='header-item'>
                              <a href='./users_area/user_login.php' class='header-link'>Login</a>
                           </li>";
                } else {
                    echo " <li class='header-item'>
                              <a href='./users_area/logout.php' class='header-link'>Logout</a>
                           </li>";
                }
                ?>
                <?php
                if (isset($_SESSION['username'])) {
                    echo " <li class='header-item'>
                              <a href='./users_area/profile.php' class='header-link'>My Account</a>
                           </li>";
                } else {
                    echo " <li class='header-item'>
                              <a href='./users_area/user_registration.php' class='header-link'>Register</a>
                           </li>";
                }
                ?>
                <li class="header-item">
                    <a href="#" class="header-link">Contact</a>
                </li>
                <li class="header-item">
                    <a href="cart.php" class="header-link"><i class="fa-solid fa-cart-shopping"></i>
                        <sup class="cart-number">
                            <?php cart_item(); ?>
                        </sup>
                    </a>
                </li>
            </ul>
        </div>
        <div class="cart-container">
            <!-- <h1>Cart Details</h1> -->
            <form action="" method="POST">
                <div class="cart-box">
                    <table>
                        <tbody>
                            <?php
                            global $conn;
                            $get_ip_address = getIPAddress();
                            $total_price = 0;
                            $cart_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
                            $result_query = mysqli_query($conn, $cart_query);
                            $result_count = mysqli_num_rows($result_query);
                            if ($result_count > 0) {
                                echo "
                                <h1>Cart Details</h1>
                                <thead>
                                <tr>
                                    <th>Product title</th>
                                    <th>Product image</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                    <th>Remove</th>
                                    <th>Action</th>
                                </tr>
                                </thead>";
                                while ($row = mysqli_fetch_array($result_query)) {
                                    $product_id = $row['product_id'];
                                    $select_products = "Select * from `products` where product_id= '$product_id'";
                                    $result_products = mysqli_query($conn, $select_products);
                                    while ($row_product_price = mysqli_fetch_array($result_products)) {
                                        $product_price = array($row_product_price['product_price']);
                                        $product_title = $row_product_price['product_title'];
                                        $product_image1 = $row_product_price['product_image1'];
                                        $product_price_table = $row_product_price['product_price'];
                                        $product_values = array_sum($product_price);
                                        $total_price += $product_values;

                            ?>
                                        <tr>
                                            <td><?php echo $product_title ?></td>
                                            <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt=""></td>
                                            <td><input type="text" name="quantity"></td>
                                            <?php
                                            global $conn;
                                            $get_ip_address = getIPAddress();
                                            if (isset($_POST['update-cart-btn'])) {
                                                $quantities = $_POST['quantity'];
                                                $update_cart = "update `cart_details` set quantity = $quantities where ip_address= '$get_ip_address'";
                                                $result_products_quantity = mysqli_query($conn, $update_cart);
                                                $total_price = $total_price * $quantities;
                                            }
                                            ?>
                                            <td><?php echo $product_price_table ?>/-</td>
                                            <!-- removeItem[]: cho phép chọn nhiều mặ hàng để xóa -->
                                            <!-- value="<?php echo $product_id ?>": ID của sản phẩm tương ứng trong giỏ hàng, 
                                                                                để bạn có thể biết sản phẩm nào được chọn để xóa. -->
                                            <td><input type="checkbox" name="removeItem[]" value="<?php echo $product_id ?>" id="">
                                            </td>
                                            <td>
                                                <button type="submit" value="" name="update-cart-btn" class="update-cart-btn">
                                                    <p>Update</p>
                                                </button>
                                                <button class="remove-cart-btn" type="submit" value="" name="remove-cart-btn">
                                                    <p>Remove</p>
                                                </button>
                                            </td>
                                        </tr>
                            <?php      }
                                }
                            } else {
                                echo "<h2 class='text-empty'>Cart is empty 😶</h2>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Total -->
                    <div class="total-box">
                        <?php
                        global $conn;
                        $get_ip_address = getIPAddress();
                        $cart_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
                        $result_query = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        if ($result_count > 0) {
                            echo "
                        <h2>Subtotal: <strong>$total_price/-</strong></h2>
                        <a href='index.php' class='continue-btn'>Continue Shopping</a>
                        <a href='./users_area/checkout.php' class='checkout-btn'>Checkout</a>
                        ";
                        } else {
                            echo " <a href='index.php' class='continue-btn'>Continue Shopping</a> ";
                        }
                        ?>
                        <!-- <h2>Subtotal: <strong><?php echo $total_price ?>/-</strong></h2>
                        <a href="index.php" class="continue-btn">Continue Shopping</a>
                        <a href="#" class="checkout-btn">Checkout</a> -->
                    </div>
                </div>
            </form>
            <!-- function to remove item -->
            <?php
            function remove_cart_item()
            {
                global $conn;
                if (isset($_POST['remove-cart-btn'])) {
                    //lặp qua mảng $_POST['removeItem'] để lấy các giá trị đã chọn (ID của các sản phẩm)
                    foreach ($_POST['removeItem'] as $remove_id) {
                        echo $remove_id;
                        $delete_query = "Delete from `cart_details` where product_id = $remove_id";
                        $run_delete = mysqli_query($conn, $delete_query);
                        if ($run_delete) {
                            echo "<script>window.open('cart.php', '_self')</script>";
                        }
                    }
                }
            }
            remove_cart_item();
            ?>
        </div>


        <!-- include footer -->
        <!-- <?php include("./includes/footer.php") ?> -->
    </div>
</body>

</html>
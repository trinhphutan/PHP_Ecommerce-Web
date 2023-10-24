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
    <title>E-Commerce Website <?php if (isset($_SESSION['username'])) {
                                    echo "- " . $_SESSION['username'];
                                } ?></title>
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <li class="header-item">
                    <a href="#" class="header-link">Total Price: <?php total_cart_price(); ?>/-</a>
                </li>
            </ul>
            <form class="search-container" action="search_product.php" method="GET">
                <input type="search" class="search-input" name="search_data" placeholder="Search">
                <button class="search-btn" type="submit" name="search_data_product"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <?php
        cart();
        ?>
        <div class="content-container">
            <div class="slider-bar">
                <ul class="delivery-brand-list">
                    <li class="delivery-brand-item">
                        <a href="#" class="delivery-brand-link">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>
                    <?php
                    // call function from common_function.php 
                    getbrands();
                    ?>
                </ul>
                <ul class="categories-list" style="padding-bottom: 5px;">
                    <li class="categories-item">
                        <a href="#" class="categories-link">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    // call function from common_function.php 
                    getcategory();
                    ?>
                </ul>
            </div>
            <div class="product-container">
                <img src="https://img.pikbest.com/backgrounds/20210618/blue-grocery-store-online-shopping-banner-template_6021411.jpg!bw700"
                    class="banner" alt="banner">
                <div class="card-list">
                    <?php
                    // call function from common_function.php 
                    getproducts();
                    get_unique_categories();
                    get_unique_brands();
                    // $ip = getIPAddress();
                    // echo 'User Real IP Address - ' . $ip;
                    ?>
                </div>
            </div>
        </div>
        <!-- <div class="line"></div> -->
        <!-- include footer -->
        <?php include("./includes/footer.php") ?>
    </div>
</body>

</html>
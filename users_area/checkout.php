<?php
include('../includes/connect.php');
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - Checkout</title>
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/user.css">
    <link rel="icon" href="../assets/img/icon-website.png">

</head>

<body>
    <div class="app-container">
        <!-- navbar -->
        <div class="header-container">
            <div class="logo-app">
                <img src="../assets/img/logo.png" alt="logo">
            </div>
            <ul class="header-list">
                <li class="header-item">
                    <a href="../index.php" class="header-link" aria-current="page">Home</a>
                </li>
                <li class="header-item">
                    <a href="../display_all.php" class="header-link">Products</a>
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
            </ul>
        </div>
        <div class="content-container">
            <?php
            if (!isset($_SESSION['username'])) {
                include('user_login.php');
            } else {
                include('payment.php');
            }
            ?>
        </div>
        <!-- <div class="line"></div> -->
        <!-- include footer -->
        <?php include("./includes/footer.php") ?>
    </div>
</body>

</html>
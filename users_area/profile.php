<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - <?php echo $_SESSION['username'] ?></title>
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
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
                <li class="header-item">
                    <a href="#" class="header-link">My Account</a>
                </li>
                <li class="header-item">
                    <a href="#" class="header-link">Contact</a>
                </li>
                <li class="header-item">
                    <a href="../cart.php" class="header-link"><i class="fa-solid fa-cart-shopping"></i>
                        <sup class="cart-number">
                            <?php cart_item(); ?>
                        </sup>
                    </a>
                </li>
                <li class="header-item">
                    <a href="#" class="header-link">Total Price: <?php total_cart_price(); ?>/-</a>
                </li>
            </ul>
            <form class="search-container" action="../search_product.php" method="GET">
                <input type="search" class="search-input" name="search_data" placeholder="Search">
                <button class="search-btn" type="submit" name="search_data_product"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <?php
        cart();
        ?>
        <div class="content-container">
            <div class="slider-bar-profile">
                <ul class="profile-list">
                    <li class="profile-item">
                        <a href="#" class="profile-link text-profile">
                            <h4>Your Profile</h4>
                        </a>
                    </li>
                    <?php
                    $username = $_SESSION['username'];
                    $user_image = "select * from `user` where username = '$username'";
                    $user_image = mysqli_query($conn, $user_image);
                    $row_image = mysqli_fetch_array($user_image);
                    $user_image = $row_image['user_image'];
                    echo "<li class='profile-item'>
                            <img class='img-profile' src='./user_images/$user_image' alt=''>
                         </li>";
                    ?>
                    <li class="profile-item mg margin">
                        <a href="profile.php" class="profile-link">
                            <h4>Pending Orders</h4>
                        </a>
                    </li>
                    <li class="profile-item mg margin">
                        <a href="profile.php?edit_account" class="profile-link">
                            <h4>Edit Account</h4>
                        </a>
                    </li>
                    <li class="profile-item mg margin">
                        <a href="profile.php?my_orders" class="profile-link">
                            <h4>My Orders</h4>
                        </a>
                    </li>
                    <li class="profile-item mg margin">
                        <a href="profile.php?delete_account" class="profile-link">
                            <h4>Delete Account</h4>
                        </a>
                    </li>
                    <li class="profile-item mg margin">
                        <a href="logout.php" class="profile-link">
                            <h4>Logout</h4>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="product-container">
                <?php
                get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include('edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    include('user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('delete_account.php');
                }
                ?>
            </div>
        </div>
        <!-- <div class="line"></div> -->
        <!-- include footer -->
        <?php include("../includes/footer.php") ?>
    </div>
</body>

</html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" href="../assets/img/icon-website.png">
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="app-container">
        <div class="header-container">
            <div class="logo-app">
                <img src="../assets/img/logo.png" alt="logo">
            </div>
            <div class="logout-admin">
                <i class="fa-solid fa-right-from-bracket"></i>
                <h3>Logout</h3>
            </div>
        </div>
        <div class="content-container">
            <h1 class="heading-manage">Manage Details</h1>
            <div class="category-container">
                <div class="admin-info">
                    <img src="../assets/img/admin-img.jpg" alt="Admin-img">
                    <p>TPT</p>
                </div>
                <div class="category-list">
                    <div class="category-item m-l">
                        <button class="category-btn"><a href="./insert_product.php" class="category-link">Insert
                                Products</a></button>
                        <button class="category-btn"><a href="" class="category-link">View Products</a></button>
                        <button class="category-btn"><a href="./index.php?insert_brand" class="category-link">Insert
                                Brands</a></button>
                        <button class="category-btn"><a href="" class="category-link">View Brands</a></button>
                    </div>
                    <div class="category-item">
                        <button class="category-btn"><a href="./index.php?insert_category" class="category-link">Insert
                                Categories</a></button>
                        <button class="category-btn"><a href="" class="category-link">View Categories</a></button>
                        <button class="category-btn"><a href="" class="category-link">All Orders</a></button>
                        <button class="category-btn"><a href="" class="category-link">All Payments</a></button>
                        <button class="category-btn"><a href="" class="category-link">List Users</a></button>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php
                if (isset($_GET['insert_category'])) {
                    include('./insert_categories.php');
                }
                if (isset($_GET['insert_brand'])) {
                    include('./insert_brands.php');
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
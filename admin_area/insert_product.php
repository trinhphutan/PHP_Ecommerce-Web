<?php
include('../includes/connect.php');
if (isset($_POST['insert_product-btn'])) {
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
    //Accessing image
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    //Accessing image tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];
    //checking empty 
    if (
        $product_title == '' or $description == '' or $product_keywords == ''
        or $product_category == '' or $product_brands == '' or $product_price == ''
        or $product_image1 == '' or $product_image2 == '' or $product_image3 == ''
    ) {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        //Move file
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        //insert data
        $insert_products = "INSERT INTO products(product_title, product_description, 
        product_keywords, category_id, brand_id, product_image1, 
        product_image2, product_image3, product_price, date, status) VALUES ('$product_title',
        '$description', '$product_keywords', '$product_category', '$product_brands', '$product_image1',
        '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";

        $result_query = mysqli_query($conn, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
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
    <div class="insert_product-container">
        <!-- form  -->
        <form action="" method="POST" enctype="multipart/form-data">
            <h1 class="heading-text">Insert Products</h1>
            <!-- title -->
            <div class="title-container d-f">
                <label for="product_title" style="font-weight: 550; padding-bottom: 5px;">Product title</label>
                <input type="text" name="product_title" id="product_title" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="description-container d-f">
                <label for="description" style="font-weight: 550; padding-bottom: 5px;">Product description</label>
                <input type="text" name="description" id="description" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- keywords -->
            <div class="keywords-container d-f">
                <label for="product_keywords" style="font-weight: 550; padding-bottom: 5px;">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!-- categories -->
            <div class="category d-f">
                <select name="product_category" id="">
                    <option value="">Select a category</option>
                    <?php
                    $select_query = "SELECT * FROM categories";
                    $result_query = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- brands -->
            <div class="brand d-f">
                <select name="product_brands" id="">
                    <option value="">Select a brands</option>
                    <?php
                    $select_query = "SELECT * FROM brands";
                    $result_query = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Image 1 -->
            <div class="img-file d-f">
                <label for="product_image1" style="font-weight: 550; padding-bottom: 5px;">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" required="required">
            </div>
            <!-- Image 2 -->
            <div class="img-file d-f">
                <label for="product_image2" style="font-weight: 550; padding-bottom: 5px;">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" required="required">
            </div>
            <!-- Image 1 -->
            <div class="img-file d-f">
                <label for="product_image3" style="font-weight: 550; padding-bottom: 5px;">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" required="required">
            </div>
            <!-- Price -->
            <div class="price-container d-f">
                <label for="product_price" style="font-weight: 550; padding-bottom: 5px;">Product price</label>
                <input type="text" name="product_price" id="product_price" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!-- button insert product -->
            <button type="submit" name="insert_product-btn">
                <p>Insert Products</p>
            </button>
        </form>
    </div>
</body>

</html>
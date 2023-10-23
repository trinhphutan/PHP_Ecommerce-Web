<?php
// include('./includes/connect.php');

//getting product
function getproducts()
{
    global $conn;

    //condition to check isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {

            $select_products = "SELECT * FROM products ORDER BY rand() LIMIT 0,9";
            $result_query = mysqli_query($conn, $select_products);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                echo
                "<div class='card m' style = 'margin: 11px 22px 11px 0;'>
                   <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                   <div class='card-body'>
                      <h5 class='card-title'>$product_title</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-price' 
                      style='font-size: 14px; color: black; margin: 0; padding: 20px 20px 0;'>Price: $product_price/-
                      </p>
                      <a href='index.php?add_to_cart=$product_id' class='add-to-cart_Btn'>Add to cart</a>
                      <a href='product_detail.php?product_id=$product_id' type='submit' class='view-more_Btn'>View more</a>
                   </div>
                </div>";
            }
        }
    }
}

//getting all products
function get_all_products()
{
    global $conn;

    //condition to check isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {

            $select_products = "SELECT * FROM products ORDER BY rand()";
            $result_query = mysqli_query($conn, $select_products);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                echo "<div class='card m' style = 'margin: 11px 22px 11px 0;'>
        <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-price' 
               style='font-size: 14px; color: black; margin: 0; padding: 20px 20px 0;'>Price: $product_price/-
            </p>
            <a href='index.php?add_to_cart=$product_id' class='add-to-cart_Btn'>Add to cart</a>
            <a href='product_detail.php?product_id=$product_id' type='submit' class='view-more_Btn'>View more</a>
        </div>
    </div>";
            }
        }
    }
}

//getting unique categories
function get_unique_categories()
{
    global $conn;

    //condition to check isset or not
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_products = "SELECT * FROM products WHERE category_id = $category_id";
        $result_query = mysqli_query($conn, $select_products);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class = 't-center'>No stock for this category</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "<div class='card m' style = 'margin: 11px 22px 11px 0;'>
        <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-price' 
               style='font-size: 14px; color: black; margin: 0; padding: 20px 20px 0;'>Price: $product_price/-
            </p>
            <a href='index.php?add_to_cart=$product_id' class='add-to-cart_Btn'>Add to cart</a>
            <a href='product_detail.php?product_id=$product_id' type='submit' class='view-more_Btn'>View more</a>
        </div>
    </div>";
        }
    }
}

//getting unique brand
function get_unique_brands()
{
    global $conn;

    //condition to check isset or not
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_products = "SELECT * FROM products WHERE brand_id = $brand_id";
        $result_query = mysqli_query($conn, $select_products);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class = 't-center'>This brand is not available for service</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "<div class='card m' style = 'margin: 11px 22px 11px 0;'>
        <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-price' 
               style='font-size: 14px; color: black; margin: 0; padding: 20px 20px 0;'>Price: $product_price/-
            </p>
            <a href='index.php?add_to_cart=$product_id' class='add-to-cart_Btn'>Add to cart</a>
            <a href='product_detail.php?product_id=$product_id' type='submit' class='view-more_Btn'>View more</a>
        </div>
    </div>";
        }
    }
}
//display brand inside navbar
function getbrands()
{
    global $conn;
    $select_brands = "SELECT * FROM brands";
    $result_brands = mysqli_query($conn, $select_brands);
    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo "<li class='delivery-brand-item margin'>
                        <a href='index.php?brand=$brand_id' class='delivery-brand-link'>$brand_title</a>
                    </li>";
    }
}

//display category inside navbar
function getcategory()
{
    global $conn;
    $select_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($conn, $select_categories);
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='categories-item margin'>
                        <a href='index.php?category=$category_id' class='categories-link'>$category_title</a>
                    </li>";
    }
}

// searching products
function search_product()
{
    global $conn;

    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "Select * from `products` where `product_keywords` like '%$search_data_value%'";
        $result_query = mysqli_query($conn, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class = 't-center'>No products found</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo
            "<div class='card m' style = 'margin: 11px 22px 11px 0;'>
                   <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                   <div class='card-body'>
                      <h5 class='card-title'>$product_title</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-price' 
                         style='font-size: 14px; color: black; margin: 0; padding: 20px 20px 0;'>Price: $product_price/-
                      </p>
                      <a href='index.php?add_to_cart=$product_id' class='add-to-cart_Btn'>Add to cart</a>

                      <a href='product_detail.php?product_id=$product_id' type='submit' class='view-more_Btn'>View more</a>
                   </div>
                </div>";
        }
    }
}

function view_details()
{
    global $conn;

    //condition to check isset or not
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_products = "SELECT * FROM `products` where `product_id` = $product_id";
                $result_query = mysqli_query($conn, $select_products);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];

                    echo
                    "
                    <div style='display: flex;'>
                    <div class='card m' style = 'margin: 11px 22px 11px 0;'>
                   <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                   <div class='card-body'>
                      <h5 class='card-title'>$product_title</h5>
                      <p class='card-text'>$product_description</p>
                      <p class='card-price' 
                         style='font-size: 14px; color: black; margin: 0; padding: 20px 20px 0;'>Price: $product_price/-
                      </p>
                      <a href='index.php?add_to_cart=$product_id' class='add-to-cart_Btn'>Add to cart</a>
                      <a href='index.php' type='submit' class='view-more_Btn'>Go home</a>
                   </div>
                </div>
                <div style='width: calc(100% - 34%);'>
                        <h1 style='text-align: center; color: rgb(243, 76, 25); font-size: 18px'>Related
                            products</h1>
                        <div style='display: flex; justify-content: space-between; margin-top: 40px;'>
                            <img style='width: 40%' src='./admin_area/product_images/$product_image2' alt='$product_title'>
                            <div style='height: 300px; width: 1px; background: linear-gradient(to left bottom, lightgreen, rgb(51, 181, 224));
                            '></div>
                            <img style='width: 40%' src='./admin_area/product_images/$product_image3' alt='$product_title'>
                        </div>
                    </div>
                    </div>
                ";
                }
            }
        }
    }
}

//get ip address 
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

//cart function
function cart()
{
    global $conn;

    if (isset($_GET['add_to_cart'])) {
        $get_ip_address = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        $select_query = "Select * from `cart_details` where ip_address = '$get_ip_address' and product_id = $get_product_id";
        $result_query = mysqli_query($conn, $select_query);

        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present inside cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) values ($get_product_id, '$get_ip_address', 0)";
            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

// function to get cart item numbers
function cart_item()
{
    global $conn;

    if (isset($_GET['add_to_cart'])) {
        $get_ip_address = getIPAddress();
        $select_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        $get_ip_address = getIPAddress();
        $select_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}

//total price function
function total_cart_price()
{
    global $conn;

    $get_ip_address = getIPAddress();
    $total_price = 0;
    $cart_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
    $result_query = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $select_products = "Select * from `products` where product_id= '$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}

//get user order details
function get_user_order_details()
{
    global $conn;
    $username = $_SESSION['username'];
    $select_user_order = "Select * from `user` where username = '$username'";
    $result_select = mysqli_query($conn, $select_user_order);
    while ($row_query = mysqli_fetch_array($result_select)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    //select người dùng tương ứng với user_id và trạng thái đặt hàng là 'pending'
                    $get_orders = "select * from `user_orders` where user_id = '$user_id' and order_status = 'Pending'";
                    $result_orders = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($result_orders);
                    if ($row_count > 0) {
                        echo "<h1 class='pending-text'>You have $row_count pending orders</h1>
                              <p class='order-details-text'><a href='profile.php?my_orders'>Orders Details</a></p>
                        ";
                    } else {
                        echo "<h1 class='pending-text'>You have zero pending orders</h1>
                              <p class='explore-product-text'><a href='../index.php'>Explore the product here</a></p>
                        ";
                    }
                }
            }
        }
    }
}

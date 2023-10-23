<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

//getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "select * from `cart_details` where ip_address = '$get_ip_address'";
$result_cart_price = mysqli_query($conn, $cart_query_price);
$invoice_number = mt_rand(); //random số hóa đơn
$status = 'Pending'; //trạng thái: Chờ xử lý
$count_products = mysqli_num_rows($result_cart_price);
while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_products = "select * from `products` where product_id = '$product_id'";
    $run_price = mysqli_query($conn, $select_products);
    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}

//getting quantity from cart
$get_cart = "select * from `cart_details`";
$run_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
if ($quantity == 0) {
    $quantity = 1;
    $subTotal = $total_price;
} else {
    $quantity = $quantity;
    $subTotal = $total_price * $quantity;
}

//insert order
$insert_order = "insert into `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status)
               values ($user_id, $subTotal, $invoice_number, $count_products, NOW(), '$status')";
$insert_result = mysqli_query($conn, $insert_order);
if ($insert_result) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
}

//insert order pending
$insert_order_pending = "insert into `orders_pending` (user_id, invoice_number, product_id, quantity, order_status)
               values ($user_id, $invoice_number, $product_id, $quantity, '$status')";
$result = mysqli_query($conn, $insert_order_pending);

//delete cart_item when checkout 
$delete_cart = "delete from `cart_details` where ip_address = '$get_ip_address'";
$result_delete_cart = mysqli_query($conn, $delete_cart);

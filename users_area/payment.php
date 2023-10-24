<?php
// @session_start();
include('../includes/connect.php');
include('../functions/common_function.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - Payment</title>
    <link rel="stylesheet" href="../assets/css/user.css">
    <link rel="icon" href="../assets/img/icon-website.png">

</head>
<style>
</style>

<body>
    <?php
    $user_ip = getIPAddress();
    $select = "select * from `user` where user_ip_address = '$user_ip'";
    $sql_select = mysqli_query($conn, $select);
    $run_query = mysqli_fetch_array($sql_select);
    $user_id = $run_query['user_id'];

    ?>
    <div class="payment-container">
        <h1>Payment options</h1>
        <div class="payment-box">
            <div class="payment-item">
                <a href="https://www.paypal.com" target="_blank"><img src="https://image.dienthoaivui.com.vn/x,webp,q90/https://dashboard.dienthoaivui.com.vn/uploads/wp-content/uploads/2021/04/Paypal-9.jpg" alt="paypal"></a>
            </div>
            <div></div>
            <div class="payment-item">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2>Pay offline</h2>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
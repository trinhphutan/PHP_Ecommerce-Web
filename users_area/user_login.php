<?php
@session_start();
include('../includes/connect.php');
include('../functions/common_function.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - Login</title>
    <link rel="stylesheet" href="../assets/css/user.css">
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="login-container">
        <!-- form  -->
        <form action="" method="POST">
            <h1 class="heading-text">Login</h1>

            <!-- username -->
            <div class="box-item d-f">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username" autocomplete="off"
                    required="required">
            </div>

            <!-- password -->
            <div class="box-item d-f">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    autocomplete="off" required="required">
            </div>

            <button type="submit" name="login" class="login-btn">
                <p>Login</p>
            </button>

            <p class="text-already">Don't have an account ?<a href="user_registration.php"> Register</a></p>
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //select username 
    $select = "select * from `user` where username = '$username'";
    $sql_select = mysqli_query($conn, $select);
    $rows_count = mysqli_num_rows($sql_select);
    $rows_data = mysqli_fetch_assoc($sql_select);
    $user_ip = getIPAddress();

    //select cart
    $select_cart = "select * from `cart_details` where ip_address = '$user_ip'";
    $sql_run = mysqli_query($conn, $select_cart);
    $rows_count_cart = mysqli_num_rows($sql_run);

    //Nếu có người dùng
    if ($rows_count > 0) {
        $_SESSION['username'] = $username;
        //Nếu đúng password
        if (password_verify($password, $rows_data['user_password'])) {
            //Nếu có người dùng nhưng không có mặt hàng cần thanh toán
            if ($rows_count == 1 and $rows_count_cart == 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php', '_self')</script>";
            } else { //Có người dùng và có mặt hàng cần thanh toán
                $_SESSION['username'] = $username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('checkout.php', '_self')</script>";
            }
        } else { //Sai password
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else { // Nếu không có người dùng
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
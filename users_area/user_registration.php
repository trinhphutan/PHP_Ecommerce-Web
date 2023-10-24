<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - Registration</title>

    <link rel="icon" href="../assets/img/icon-website.png">
    <link rel="stylesheet" href="../assets/css/user.css">
    <!-- reset css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="register-container">
        <!-- form  -->
        <form action="" method="POST" enctype="multipart/form-data">
            <h1 class="heading-text">Registration</h1>

            <!-- username -->
            <div class="box-item d-f">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username" autocomplete="off" required="required">
            </div>

            <!-- email -->
            <div class="box-item d-f">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="off" required="required">
            </div>

            <!-- User image -->
            <div class="box-item img-file d-f">
                <label for="user_image">User Image</label>
                <input type="file" name="user_image" id="user_image" required="required">
            </div>

            <!-- password -->
            <div class="box-item d-f">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" autocomplete="off" required="required">
            </div>

            <!-- Confirm password -->
            <div class="box-item d-f">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" autocomplete="off" required="required">
            </div>

            <!-- Address -->
            <div class="box-item d-f">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter your address" autocomplete="off" required="required">
            </div>

            <!-- Contact -->
            <div class="box-item d-f">
                <label for="contact">Contact</label>
                <input type="text" name="contact" id="contact" placeholder="Enter your mobile number" autocomplete="off" required="required">
            </div>

            <button type="submit" name="register" class="register-btn">
                <p>Register</p>
            </button>

            <p class="text-already">Already have an account ?<a href="user_login.php"> Login</a></p>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //Băm Mật khẩu => bảo mật thông tin người dùng
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip_address = getIPAddress();

    //select
    $select = "select * from `user` where username = '$username' or user_email = '$email'";
    $sql_select = mysqli_query($conn, $select);
    $rows_count = mysqli_num_rows($sql_select);

    if ($rows_count > 0) {
        echo "<script>alert('Username or email already exist')</script>";
    } else if ($password != $confirm_password) {
        echo "<script>alert('Password do not match')</script>";
    } else {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        //insert
        $insert_query = "insert into `user` (username, user_email, user_password, user_image, user_ip_address, 
    user_address, user_mobile) values ('$username', '$email', '$hash_password', '$user_image', '$user_ip_address', 
    '$address', '$contact')";

        $sql_run = mysqli_query($conn, $insert_query);
        if ($sql_run) {
            echo "<script>alert('Data inserted successfully')</script>";

            //selecting cart item
            $select_carts_items = "select * from `cart_details` where ip_address = '$user_ip_address'";
            $sql_cart = mysqli_query($conn, $select_carts_items);
            $rows_count = mysqli_num_rows($sql_cart);
            if ($rows_count > 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('You have items in your cart')</script>";
                echo "<script>window.open('checkout.php', '_self')</script>";
            } else {
                echo "<script>window.open('../index.php', '_self')</script>";
            }
        } else {
            die(mysqli_error($conn));
        }
    }
}
?>
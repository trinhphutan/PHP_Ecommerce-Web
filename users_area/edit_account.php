<?php
if (isset($_GET['edit_account'])) {
    $username = $_SESSION['username'];
    $select_user = "select * from `user` where username = '$username'";
    $result_user = mysqli_query($conn, $select_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $username = $row_user['username'];
    $user_id = $row_user['user_id'];
    $user_email = $row_user['user_email'];
    $user_address = $row_user['user_address'];
    $user_mobile = $row_user['user_mobile'];
}

//logic update user
if (isset($_POST['update-account'])) {
    $update_id = $user_id;
    $username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_address = $_POST['address'];
    $user_mobile = $_POST['contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp, "./user_images/$user_image");

    //update 
    $update_user = "update `user` set username = '$username', user_email = '$user_email', user_image = '$user_image',
    user_address = '$user_address', user_mobile = '$user_mobile' where user_id = $update_id";
    $result_update = mysqli_query($conn, $update_user);
    if ($result_update) {
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('logout.php', '_self')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../assets/img/icon-website.png">

</head>

<body>
    <div class="edit-account-container">
        <!-- form  -->
        <form action="" method="POST" enctype="multipart/form-data">
            <h1 class="heading-text">Edit Account</h1>

            <!-- username -->
            <div class="box-item d-f">
                <input type="text" name="username" value="<?php echo $username ?>" id="username">
            </div>

            <!-- email -->
            <div class="box-item d-f">
                <input type="email" name="email" value="<?php echo $user_email ?>" id="email">
            </div>

            <!-- User image -->
            <div class="box-item img-file d-f">
                <input type="file" name="user_image" id="user_image">
                <img class="img-edit" src="./user_images/<?php echo $user_image ?>" alt="">
            </div>

            <!-- Address -->
            <div class="box-item d-f">
                <input type="text" name="address" value="<?php echo $user_address ?>" id="address">
            </div>

            <!-- Contact -->
            <div class="box-item d-f">
                <input type="text" name="contact" value="<?php echo $user_mobile ?>" id="contact">
            </div>

            <button type="submit" name="update-account" class="update-account">
                <p>Update</p>
            </button>
        </form>
    </div>
</body>

</html>
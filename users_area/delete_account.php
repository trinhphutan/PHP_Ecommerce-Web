<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="icon" href="../assets/img/icon-website.png">

</head>

<style>
    .delete-account-container {
        overflow: hidden;
        display: flex;
        flex-direction: column;
        width: 100%;
        padding-top: 20px;
        height: 100vh;
    }

    .delete-account-container h1 {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        color: rgb(243, 76, 25);
        margin: 0;
        padding: 30px;
    }

    .delete-account-container form {
        display: flex;
        flex-direction: column;
        margin: 0 auto;
        font-size: 16px;
    }

    .delete-btn {
        background-color: rgb(243, 76, 25);
        color: #fff;
        font-size: 18px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.03);
        border-color: #fff;
        cursor: pointer;
        border-radius: 5px;
        font-weight: 500;
        margin-bottom: 30px;
    }

    .dont-delete-btn {
        background-color: rgb(51, 181, 224);
        color: #fff;
        font-size: 18px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.03);
        border-color: #fff;
        cursor: pointer;
        border-radius: 5px;
        font-weight: 500;
    }


    button p {
        margin: 0;
        padding: 10px 20px;

    }
</style>

<body>
    <div class="delete-account-container">
        <h1>Do you want to delete your account ?</h1>
        <form action="" method="POST">
            <button type="submit" class="delete-btn" name="delete-btn">
                <p>Delete Account</p>
            </button>
            <button type="submit" class="dont-delete-btn" name="dont-delete-btn">
                <p>Don't Delete Account</p>
            </button>
        </form>
    </div>
</body>

</html>

<?php
$username = $_SESSION['username'];
if (isset($_POST['delete-btn'])) {
    $delete_account = "delete from `user` where username = '$username'";
    $result_delete = mysqli_query($conn, $delete_account);

    if ($result_delete) {
        session_destroy();
        echo "<script>alert('Account deleted successfully')</script>";
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}

if (isset($_POST['dont-delete-btn'])) {
    echo "<script>window.open('profile.php', '_self')</script>";
}
?>
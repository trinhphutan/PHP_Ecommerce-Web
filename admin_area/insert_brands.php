<?php
session_start();
include('../includes/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    if (empty($brand_title)) {
        $_SESSION['status'] = "Please enter brand!";
    } else {
        $select_query = "SELECT * FROM brands WHERE brand_title = '$brand_title'";
        $result_select = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($result_select);
        if ($number > 0) {
            // echo "<script>alert('This category is present inside the database')</script>";
            $_SESSION['status'] = "This brand is present inside the database!";
        } else {
            $insert_query = "INSERT INTO brands(brand_title) VALUES('$brand_title')";
            $result = mysqli_query($conn, $insert_query);
            if ($result) {
                // echo "<script>alert('Category has been inserted successfully')</script>";
                $_SESSION['status'] = "Brand has been inserted successfully!";
            }
        }
    }
}
?>
<form action="" method="POST">
    <div class="container-insert">
        <div class="heading-insert">Insert Brands</div>
        <?php
        if (isset($_SESSION['status'])) {
        ?>
        <div style="color: green; font-size: 18px; margin-top: -25px;">
            <h4><?= $_SESSION['status']; ?></h4>
        </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
        <div class="insert-item">
            <img src="../assets/img/icon-insert.png" alt="">
            <input type="text" name="brand_title" placeholder="Insert brands">
        </div>
        <div class="insert-item m-b">
            <button type="submit" name="insert_brand">Insert Brands</button>
        </div>
    </div>
</form>
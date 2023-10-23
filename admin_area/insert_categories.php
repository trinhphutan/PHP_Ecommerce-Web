<?php
session_start();
include('../includes/connect.php');
if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    if (empty($category_title)) {
        $_SESSION['status'] = "Please enter category!";
    } else {
        $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
        $result_select = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($result_select);
        if ($number > 0) {
            // echo "<script>alert('This category is present inside the database')</script>";
            $_SESSION['status'] = "This category is present inside the database!";
        } else {
            $insert_query = "INSERT INTO categories(category_title) VALUES('$category_title')";
            $result = mysqli_query($conn, $insert_query);
            if ($result) {
                //echo "<script>alert('Category has been inserted successfully')</script>";
                $_SESSION['status'] = "Category has been inserted successfully!";
            }
        }
    }
}
?>
<form action="" method="POST">
    <div class="container-insert">
        <div class="heading-insert">Insert Categories</div>
        <?php
        if (isset($_SESSION['status'])) {
        ?>
        <div style="color: green; font-size: 18px; margin-top: -25px;" class="alert alert-success">
            <h4><?= $_SESSION['status']; ?></h4>
        </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
        <div class="insert-item">
            <img src="../assets/img/icon-insert.png" alt="">
            <input type="text" name="cat_title" placeholder="Insert categories">
        </div>
        <div class="insert-item m-b">
            <button type="submit" name="insert_cat">Insert Categories</button>
        </div>
    </div>
</form>
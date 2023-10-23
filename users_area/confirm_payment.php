<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $select_order_payment = "select * from `user_orders` where order_id = '$order_id'";
    $result_order_payment = mysqli_query($conn, $select_order_payment);
    $row_fetch = mysqli_fetch_assoc($result_order_payment);

    $amount_due = $row_fetch['amount_due'];
    $invoice_number = $row_fetch['invoice_number'];
}

//sự kiện payment
if (isset($_POST['confirm_payment-btn'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $insert_payment = "insert into `user_payments` (order_id, invoice_number, amount, payment_mode)
    values('$order_id', '$invoice_number', '$amount', '$payment_mode')";
    $result_insert = mysqli_query($conn, $insert_payment);

    if ($result_insert) {
        echo "<script>alert('Successfully completed the payment')</script>";
        echo "<script>window.open('profile.php?my_orders', '_self')</script>";
    }

    $update = "update `user_orders` set order_status = 'Complete' where order_id = $order_id";
    $result_update = mysqli_query($conn, $update);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
</head>

<style>
    * {
        /* inherits: kế thừa từ thẻ cha */
        box-sizing: inherit;
    }

    html {
        font-size: 62.5%;
        line-height: 1.6rem;
        /* sans-serif: chuẩn chữ không chân */
        font-family: 'Roboto', sans-serif;
        box-sizing: border-box;
    }

    .confirm-payment-container {
        /* ẩn những phần tử thừa ra  */
        overflow: hidden;
        display: flex;
        flex-direction: column;
        width: 100%;
        padding-top: 20px;
        height: 100vh;
    }

    .box-item label {
        padding-bottom: 10px;
        font-weight: 500;
        color: black;
    }

    .confirm-payment-container form {
        display: flex;
        flex-direction: column;
        width: 38%;
        margin: 0 auto;
        border: 1px solid rgb(243, 76, 25);
        background-color: aliceblue;
        font-size: 16px;
        border-radius: 5px;
    }

    .confirm-payment-container form h1 {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        color: rgb(243, 76, 25);
    }

    .confirm-payment-container form input {
        width: 450px;
        height: 35px;
        line-height: 35px;
        border-radius: 5px;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        border-color: #fff;
    }

    .confirm-payment-container select {
        margin-top: 5px;
        width: 450px;
        height: 35px;
        border-radius: 5px;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        border-color: #fff;
        font-size: 16px;
    }

    .confirm-payment-container select option {
        background-color: aliceblue;
        color: black;
        padding: 10px;
    }

    .confirm_payment-btn {
        background-color: rgb(122, 189, 122);
        height: 40px;
        line-height: 40px;
        color: #fff;
        font-size: 18px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.03);
        border-color: #fff;
        cursor: pointer;
        border-radius: 5px;
        font-weight: 500;
        width: 23%;
        display: flex;
        justify-content: center;
        margin: 0 auto 17px;
    }

    .confirm_payment-btn p {
        margin: 0 5px;
    }

    .confirm_payment-btn:hover {
        transform: scale(0.96);
        transition: all 0.1s ease;
        opacity: 0.9;
        color: rgb(243, 76, 25);
    }

    .d-f {
        display: flex;
        flex-direction: column;
        margin: 0 auto;
        padding-bottom: 20px;
    }
</style>

<body>
    <div class="confirm-payment-container">
        <!-- form  -->
        <form action="" method="POST">
            <h1 class="heading-text">Confirm Payment</h1>

            <div class="box-item d-f">
                <label for="invoice_number">Invoice number</label>
                <input type="text" class="invoice_number" name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>

            <div class="box-item d-f">
                <label for="amount">Amount Due</label>
                <input type="text" class="amount" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="box-item d-f">
                <select name="payment_mode" id="payment_mode">
                    <option value="">Select Payment Mode</option>
                    <option value="">Paypal</option>
                    <option value="">Banking</option>
                    <option value="">Pay offline</option>
                </select>
            </div>
            <button type="submit" name="confirm_payment-btn" class="confirm_payment-btn">
                <p>Confirm</p>
            </button>

        </form>
    </div>
</body>

</html>
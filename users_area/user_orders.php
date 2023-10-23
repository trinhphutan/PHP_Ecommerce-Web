<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User orders</title>
</head>

<style>
    .user-order-container {
        width: 100%;
        margin-top: 20px;
        color: black;
    }

    .text-order {
        text-align: center;
        margin: 0;
        font-size: 20px;
        padding-bottom: 20px;
        color: rgb(243, 76, 25);
    }

    .th {
        background: linear-gradient(to left bottom, lightgreen, rgb(51, 181, 224));
    }

    .tb {
        background-color: rgb(103, 120, 126);
    }

    .tb tr td {
        color: #fff;
    }

    .cl {
        color: rgb(241 141 111);
        font-weight: 500;
    }

    tr td:last-child {
        color: rgb(51, 181, 224);
    }
</style>

<body>
    <?php
    $username = $_SESSION['username'];
    $select_user_order = "select * from `user` where username = '$username'";
    $result_user_order = mysqli_query($conn, $select_user_order);
    $row_user_order = mysqli_fetch_assoc($result_user_order);
    $user_id = $row_user_order['user_id'];
    ?>
    <div class="user-order-container">
        <!-- <h1>Cart Details</h1> -->
        <form action="" method="POST">
            <div class="cart-box">
                <table>
                    <h1 class="text-order">All my orders</h1>
                    <thead class="th">
                        <tr>
                            <th>ID</th>
                            <th>Amount Due</th>
                            <th>Total products</th>
                            <th>Invoice number</th>
                            <th>Date</th>
                            <th>Complete/Incomplete</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="tb">
                        <?php
                        $number = 1;
                        $select_order = "select * from `user_orders` where user_id = '$user_id'";
                        $result = mysqli_query($conn, $select_order);
                        while ($row_fetch = mysqli_fetch_assoc($result)) {
                            $order_id = $row_fetch['order_id'];
                            $amount_due = $row_fetch['amount_due'];
                            $invoice_number = $row_fetch['invoice_number'];
                            $total_products = $row_fetch['total_products'];
                            $order_date = $row_fetch['order_date'];
                            $order_status = $row_fetch['order_status'];
                            if ($order_status == 'Pending') {
                                $order_status = 'Incomplete';
                            } else {
                                $order_status = 'Complete';
                            }
                            echo " 
                        <tr>
                          <td>$number</td>
                          <td>$amount_due</td>
                          <td>$total_products</td>
                          <td>$invoice_number</td>
                          <td>$order_date</td>
                          <td>$order_status</td>";
                        ?>
                        <?php
                            if ($order_status == 'Complete') {
                                echo "<td>Paid</td>";
                            } else {
                                echo "<td>
                                    <p>
                                        <a class='cl' href ='confirm_payment.php?order_id=$order_id'>Confirm</a>
                                    </p>
                                  </td>
                            </tr>";
                            }
                            $number++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
        <!-- function to remove item -->
        <?php
        function remove_cart_item()
        {
            global $conn;
            if (isset($_POST['remove-cart-btn'])) {
                //lặp qua mảng $_POST['removeItem'] để lấy các giá trị đã chọn (ID của các sản phẩm)
                foreach ($_POST['removeItem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "Delete from `cart_details` where product_id = $remove_id";
                    $run_delete = mysqli_query($conn, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php', '_self')</script>";
                    }
                }
            }
        }
        remove_cart_item();
        ?>
    </div>
</body>

</html>
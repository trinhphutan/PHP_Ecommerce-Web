<?php
session_start();
session_unset(); //hủy phiên
session_destroy();
echo "<script>window.open('../index.php', '_self')</script>";

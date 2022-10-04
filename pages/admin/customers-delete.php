<?php
include('../../config/config.php');
session_start();

if (isset($_POST['delete'])) {
    $CustomersCode = $_POST['CustomerCode'];

    // query delete data
    $queryDelete = mysqli_query($conn, "DELETE FROM customer WHERE CustomerCode='$CustomersCode'");
    if ($queryDelete != false) {
        $_SESSION['success'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/customers.php';
        </script>";
    } else {
        $_SESSION['warning'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/customers.php';
        </script>";
    }
}

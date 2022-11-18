<?php
include('../../config/config.php');


if (isset($_POST['delete'])) {
    session_start();
    $CustomersCode = $_POST['CustomerCode'];

    // query delete data
    $queryDelete = mysqli_query($conn, "DELETE FROM customer WHERE CustomerId=$CustomersCode");
    $queryDelete = mysqli_query($conn, "DELETE FROM customerS_detail WHERE customers_id=$CustomersCode");
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

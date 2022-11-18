<?php
include('../../config/config.php');


if (isset($_POST['delete']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $id = $_POST['id'];

    // query delete data
    $queryDelete = mysqli_query($conn, "DELETE FROM customerS_detail WHERE id_customer_details='$id'");
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

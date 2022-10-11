<?php
include('../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    session_start();
    $id = $_POST['InvId'];

    $queryDelete = mysqli_query($conn, "DELETE FROM inventory WHERE InvId='$id'");

    if ($queryDelete != false) {
        $_SESSION['success'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/produk.php';
        </script>";
    } else {
        $_SESSION['warning'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/produk.php';
        </script>";
    }
}

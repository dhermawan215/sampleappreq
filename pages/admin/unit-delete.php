<?php
include('../../config/config.php');
session_start();

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // query delete data
    $queryDelete = mysqli_query($conn, "DELETE FROM unit WHERE id='$id'");
    if ($queryDelete != false) {
        $_SESSION['success'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/unit.php';
        </script>";
    } else {
        $_SESSION['warning'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/unit.php';
        </script>";
    }
}

<?php
include('../../config/config.php');

if (isset($_POST['delete'])) {
    session_start();
    $IDNo = $_POST['IDNo'];

    // query hapus data

    $queryDelete = mysqli_query($conn, "DELETE FROM departemen WHERE IDNo='$IDNo'");

    if ($queryDelete != false) {
        $_SESSION['success'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/departemen.php';
        </script>";
    } else {
        $_SESSION['warning'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/departemen.php';
        </script>";
    }
}

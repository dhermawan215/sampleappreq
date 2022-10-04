<?php
include('../../config/config.php');
session_start();
if (isset($_POST['delete'])) {
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
    }
}

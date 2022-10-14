<?php
include('../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    session_start();
    $id = $_POST['id'];
    $no_sample = $_POST['no_sample'];

    $queryDelete = mysqli_query($conn, "DELETE FROM sample_request_details WHERE id='$id'");

    if ($queryDelete != false) {
        $_SESSION['success'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/staff/sample-request-add-detail.php?cc=$no_sample';
        </script>";
    } else {
        $_SESSION['warning'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/staff/sample-request-add-detail.php?cc=$no_sample';
        </script>";
    }
}

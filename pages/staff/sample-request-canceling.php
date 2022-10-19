<?php
include('../../config/config.php');
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}

$code_sample = $_GET["cc"];
$status = $_GET['status'];
$queryDetailData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE no_sample='$code_sample'");
$row = mysqli_fetch_object($queryDetailData);

if ($queryDetailData->num_rows == 0) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}


$queryUpdate = mysqli_query($conn, "UPDATE sample_request SET status=$status WHERE id=$row->id");

if ($queryUpdate) {

    $_SESSION['change'] = [
        "message" => "Data Was Deleted"
    ];

    echo "<script>
    document.location.href='/pages/staff/sample-request-cancel.php';
    </script>";
} else {

    $_SESSION['warning'] = [
        "message" => "Data Was Deleted"
    ];

    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}

<?php
include('../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['delete'])) {
    session_start();
    $id = $_POST['emp_id'];

    $queryDelete = mysqli_query($conn, "DELETE FROM tblemployees WHERE emp_id='$id'");

    if ($queryDelete != false) {
        $_SESSION['success'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/employee.php';
        </script>";
    } else {
        $_SESSION['warning'] = [
            "message" => "Data Was Deleted"
        ];

        echo "<script>
        document.location.href='/pages/admin/employee.php';
        </script>";
    }
}

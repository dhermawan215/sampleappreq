<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if (isset($_GET['xls'])) {

    $fdate = $_GET['fdate'];
    $ldate = $_GET['ldate'];
    $sts = $_GET['status'];
    echo "<script>
    document.location.href='/pages/staff/xls.php?fdate=$fdate&ldate=$ldate&sts=$sts';
    </script>";
}
if (isset($_GET['pdf'])) {

    $fdate = $_GET['fdate'];
    $ldate = $_GET['ldate'];
    $sts = $_GET['status'];
    echo "<script>
    document.location.href='/pages/staff/pdf.php?fdate=$fdate&ldate=$ldate&sts=$sts';
    </script>";
}

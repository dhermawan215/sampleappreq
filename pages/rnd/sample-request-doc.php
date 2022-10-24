<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if ($_SESSION['user']['dept'] != 'RD') {
    echo "<script>
    document.location.href='/index.php';
    </script>";
}


if (isset($_GET['xls'])) {

    $fdate = $_GET['fdate'];
    $ldate = $_GET['ldate'];
    echo "<script>
    document.location.href='/pages/rnd/xls.php?fdate=$fdate&ldate=$ldate';
    </script>";
}
if (isset($_GET['pdf'])) {

    $fdate = $_GET['fdate'];
    $ldate = $_GET['ldate'];
    echo "<script>
    document.location.href='/pages/rnd/pdf.php?fdate=$fdate&ldate=$ldate';
    </script>";
}

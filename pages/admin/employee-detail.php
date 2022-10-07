<?php include('../../config/config.php');
session_start();
//get id form url
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/admin/employee.php';
    </script>";
}

$code = $_GET["cc"];
$queryDetails = mysqli_query($conn, "SELECT * FROM tblemployees WHERE emp_id='$code'");
$row = mysqli_fetch_object($queryDetails);

//jika data di url tidak ada di db
if ($queryDetails->num_rows == 0) {

    echo "<script>
    document.location.href='/pages/admin/employee.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Employee-Detail</title>

    <?php include('../layouts/css.php') ?>
</head>

<body>
    <?php include('../layouts/loading.php') ?>

    <!-- header /navbar -->
    <?php include('../layouts/header.php') ?>

    <!-- right sidebar -->
    <?php include('../layouts/sidebar.php') ?>
    <!-- endofsidebar -->
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="title">
                                <h4>Employees</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/admin/employee.php">Employee</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Detail
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Employee </h4>
                        <h5><a href="/pages/admin/employee.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <div class="row col-12">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    NIP: <?= $row->NIP ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    FirstName: <?= $row->FirstName ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    LastName: <?= $row->LastName ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    NickName: <?= $row->NickName ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Address: <?= $row->Address ?>
                                </div>
                            </div>
                        </div>

                        <div class="row col-12 mt-2">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Email: <?= $row->EmailId ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Gender: <?= $row->Gender ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Date of Birth: <?= $row->Dob ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 col-12">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Department: <?= $row->Department ?>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Phone: <?= $row->Phonenumber ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 col-12">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Roles: <?= $row->roles ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Registered At: <?= $row->RegDate ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../layouts/footer.php'); ?>
        </div>

        <!-- js -->
        <?php include('../layouts/js.php'); ?>


</body>

</html>
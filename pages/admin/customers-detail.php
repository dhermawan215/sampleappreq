<?php include('../../config/config.php');
//get id form url
session_start();

if (isset($_GET["cc"]) == null) {

    $_SESSION['danger'] = [
        "message" => "Data Was Deleted"
    ];
    echo "<script>
    document.location.href='/pages/admin/customers.php';
    </script>";
}
$code = $_GET["cc"];
$queryDetails = mysqli_query($conn, "SELECT * FROM customer WHERE CustomerCode='$code'");
$row = mysqli_fetch_object($queryDetails);
if ($row->CustomerCode != $code) {
    $_SESSION['warning'] = [
        "message" => "Data Was Deleted"
    ];
    echo "<script>
    document.location.href='/pages/admin/customers.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Customers-Detail</title>

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
                                <h4>Customers</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/admin/customers.php">Customers</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Detail - <?= $code ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Customers - <?= $code ?></h4>
                        <h5><a href="/pages/admin/customers.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <div class="row col-12">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Code: <?= $row->CustomerCode ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Name: <?= $row->CustomerName ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    City: <?= $row->CustomerCity ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Country: <?= $row->CustomerCountry ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Address: <?= $row->CustomerAddress ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    ZipCode: <?= $row->Zipcode ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    CP1: <?= $row->ContactPerson1 ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    CP2: <?= $row->ContactPerson2 ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Phone: <?= $row->Phone1 ?><span> / </span><?= $row->Phone2 ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Fax: <?= $row->Fax ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Email: <?= $row->Email ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    AcAR: <?= $row->AcAR ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 col-12">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    NPWP: <?= $row->NPWP ?>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Tax Address: <?= $row->TaxAddress ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 col-12">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Profit Center: <?= $row->ProfitCenterNo ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Registered At: <?= $row->CustomerDate ?>
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
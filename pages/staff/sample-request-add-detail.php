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
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}

$code_sample = $_GET["cc"];
$queryDetailData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE no_sample='$code_sample'");
$row = mysqli_fetch_object($queryDetailData);

if ($queryDetailData->num_rows == 0) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Sample Request-Add Detail</title>

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
                                <h4>Sample Request</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/staff/sample-request.php">Sample Request</a>
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
                        <h4 class="text-blue h4">Sample Request Detail No : <?= $row->no_sample ?> </h4>
                        <h5><a href="/pages/staff/sample-request.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <div class="row col-12">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Sample No: <?= $row->no_sample ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Subject: <?= $row->subject ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Requestor: <?= $row->requestor ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Customers: <?= $row->CustomerName ?>
                                </div>
                            </div>
                        </div>

                        <div class="row col-12 mt-2">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Customers PO: <?= $row->customer_po ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Date Required: <?= $row->date_required ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Delivery Date: <?= $row->delivery_date ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add details sample request -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <form action="" method="POST">
                            <input type="hidden" name="id_sample_req" value="<?= $row->id ?>">
                            <div class="row-col-12">
                                <h5 class="text-primary text-md-left">Details Product For Sample No : <?= $row->no_sample ?></h5>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-md-12">
                                    <label class="" for="">Product</label>
                                    <select name="id_barang" id="id-produk" class="form-control custom-select" autocomplete="off" data-live-search="true" size="5">
                                        <option disabled selected>Select Product</option>

                                        <!-- query produk -->
                                        <?php
                                        $queryProductData = mysqli_query($conn, "SELECT * FROM inventory");

                                        while ($rowProduct = mysqli_fetch_object($queryProductData)) :

                                        ?>
                                            <option value=""><?= $rowProduct->InvName ?></option>

                                        <?php endwhile; ?>

                                    </select>
                                </div>

                            </div>

                            <div class="row col-12 mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="" for="">Qty Produk</label>
                                    <input type="number" class="form-control">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include('../layouts/footer.php'); ?>
        </div>

        <!-- js -->
        <?php include('../layouts/js.php'); ?>
        <script>
            $("#id-produk").select2({
                responsive: true,
                width: '100%'
            });
        </script>


</body>

</html>
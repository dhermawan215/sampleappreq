<?php include('../../config/config.php');
session_start();
//get id form url
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


if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/rnd/sample-request.php';
    </script>";
}

$code_sample = $_GET["cc"];
$queryDetailData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id WHERE no_sample='$code_sample'");
$row = mysqli_fetch_object($queryDetailData);

if ($queryDetailData->num_rows == 0) {
    echo "<script>
    document.location.href='/pages/rnd/sample-request.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Sample Request-Detail</title>

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
                                        <a class="text-decoration-none" href="/pages/rnd/sample-request.php">Sample Request</a>
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
                        <h5><a href="/pages/rnd/sample-request.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
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
                                    Requestor: <?= $row->FirstName . ' ' . $row->LastName ?>
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
                                    PIC Customer: <?= $row->pic_customer ?>
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
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Delivery Address: <?= $row->delivery_address ?>
                                </div>
                            </div>
                        </div>

                        <div class="row col-12 mt-2">
                            <?php
                            $status_delivery = $row->delivery_by;
                            switch ($status_delivery) {
                                case 1:
                                    $status_message_delivery = "EKSPEDISI";
                                    break;

                                case 2:
                                    $status_message_delivery = "BY SALES";
                                    break;

                                default:
                                    $status_message_delivery = "PICK UP";
                                    break;
                            }
                            ?>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Delivery By (method of delivery): <?= $status_message_delivery ?>
                                </div>
                            </div>


                        </div>
                        <div class="row col-12 mt-2">
                            <?php
                            $status =  $row->status;
                            switch ($status) {
                                case 1:
                                    $status_messages = "In Progress";
                                    break;
                                case 2:
                                    $status_messages = "Ready";
                                    break;
                                case 3:
                                    $status_messages = "Pick Up";
                                    break;
                                case 4:
                                    $status_messages = "Accepted by Customer";
                                    break;
                                case 5:
                                    $status_messages = "Reviewed";
                                    break;
                                case 6:
                                    $status_messages = "Cancel";
                                    break;

                                default:
                                    $status_messages = "Requested";
                                    break;
                            }
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Status: <?= $status_messages ?>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Sales Note: <?= $row->sales_note ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Cs Note: <?= $row->cs_note ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Customer Note: <?= $row->customer_note ?>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    RnD Note: <?= $row->rnd_notes ?>
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
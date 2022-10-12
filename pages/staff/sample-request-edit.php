<?php include('../../config/config.php');
session_start();
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
$queryEditData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE no_sample='$code_sample'");
$row = mysqli_fetch_object($queryEditData);

if ($queryEditData->num_rows == 0) {
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
    <title>Sample Request App - Customers-Add</title>

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
                                        Edit Data
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Edit Data</h4>
                        <h5><a href="/pages/staff/sample-request.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="post">
                            <div class="row col-12">
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">No Sample</label>
                                        <input type="text" name="no_sample" id="" class="form-control" readonly value="<?= $row->no_sample ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Subject</label>
                                        <input type="text" name="subject" id="" class="form-control" placeholder="input sample request subject" value="<?= $row->subject ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Requestor</label>

                                        <input type="text" name="requestor" id="" class="form-control" value="<?= $row->requestor ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers </label>
                                        <select name="id_customer" id="" class="selectpicker form-control" data-live-search="true">
                                            <option value="<?= $row->id_customer ?>" selected><?= $row->CustomerName ?></option>
                                            <option disabled>Select Customers</option>
                                            <?php
                                            $dataCustomers = mysqli_query($conn, "SELECT * FROM customer");
                                            while ($rowCustomers = mysqli_fetch_object($dataCustomers)) : ?>
                                                <option value="<?= $rowCustomers->CustomerId ?>"><?= $rowCustomers->CustomerName ?></option>
                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Recipient</label>
                                        <input type="text" name="pic_customer" id="" class="form-control" placeholder="input customer recipient" value="<?= $row->pic_customer ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Date Required</label>
                                        <input type="date" name="date_required" id="" class="form-control" value="<?= $row->date_required ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Delivery Date</label>
                                        <input type="date" name="delivery_date" id="" class="form-control" value="<?= $row->delivery_date ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Delivery Address</label>
                                        <input type="text" name="delivery_address" id="" class="form-control" placeholder="input customers delivery address" value="<?= $row->delivery_address ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Delivery By</label>
                                        <input type="text" name="delivery_by" id="" class="form-control" placeholder="input shipping method of delivery" value="<?= $row->delivery_by ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers PO</label>
                                        <input type="text" name="customer_po" id="" class="form-control" placeholder="input customer po" value="<?= $row->customer_po ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 d-flex m-2 p-2">
                                    <div class="card-body d-flex">
                                        <button type="submit" class="btn btn-primary ml-2" name="update">Update</button>
                                        <button type="reset" class="btn btn-danger ml-2" name="save">Reset</button>
                                    </div>
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
        <!-- query save -->
        <?php
        if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $no_sample = $_POST['no_sample'];
            $subject = $_POST['subject'];
            $requestor = $_POST['requestor'];
            $customers_id = $_POST['id_customer'];
            $pic_customer = $_POST['pic_customer'];
            $date_required = $_POST['date_required'];
            $delivery_date = $_POST['delivery_date'];
            $delivery_address = $_POST['delivery_address'];
            $delivery_by = $_POST['delivery_by'];
            $customer_po = $_POST['customer_po'];

            $queryUpdateSample = mysqli_query($conn, "UPDATE sample_request SET no_sample='$no_sample',
            subject='$subject', requestor='$requestor', id_customer=$customers_id, pic_customer='$pic_customer',
            date_required='$date_required', delivery_date='$delivery_date', delivery_by='$delivery_by',
            delivery_address='$delivery_address', customer_po='$customer_po' WHERE id='$id'");

            if ($queryUpdateSample) {
                echo "<script>
                        swal('Data Saved!', 'Click OK to continue', 'success')
                        .then((value) => {
                         document.location.href='/pages/staff/sample-request.php';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                        document.location.href='/pages/staff/sample-request-add.php?cc=$code_sample';
                        </script>";
            }
        }

        ?>


</body>

</html>
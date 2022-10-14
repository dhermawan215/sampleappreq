<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}
//query no sample request
$querydb = mysqli_query($conn, "SELECT MAX(no_sample) as kode FROM sample_request");
$fetch = mysqli_fetch_object($querydb);
$kodeSampel = $fetch->kode;
$bulanTgl = date('md');
$huruf = "SRF-";
$zki = "/ZKI/";
//urutan no sampelnya
// SRF-1011/ZKI/001
$urutan = (int) substr($kodeSampel, 13, 4);
$urutan++;
$sample_no = $huruf . $bulanTgl . $zki . sprintf("%04s", $urutan);


?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Sampe Request-Add</title>

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
                                        Add Data
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Add Data</h4>
                        <h5><a href="/pages/staff/sample-request.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="post">
                            <div class="row col-12">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">No Sample</label>
                                        <input type="text" name="no_sample" id="" class="form-control" readonly value="<?= $sample_no ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Subject</label>
                                        <input type="text" name="subject" id="" class="form-control" placeholder="input sample request subject" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Requestor</label>
                                        <input type="text" name="requestor" id="" class="form-control" value="<?= $_SESSION['user']['fname'] . ' ' .  $_SESSION['user']['lname'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers </label>
                                        <select name="id_customer" id="id_customer" class="custom-select form-control" data-live-search="true" required>
                                            <option disabled selected>Select Customers</option>
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
                                        <input type="text" name="pic_customer" id="" class="form-control" placeholder="input customer recipient" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Date Required</label>
                                        <input type="date" name="date_required" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Delivery Date</label>
                                        <input type="date" name="delivery_date" id="" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Delivery Address</label>
                                        <input type="text" name="delivery_address" id="" class="form-control" placeholder="input customers delivery address" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Delivery By</label>
                                        <input type="text" name="delivery_by" id="" class="form-control" placeholder="input shipping method of delivery" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers PO</label>
                                        <input type="text" name="customer_po" id="" class="form-control" placeholder="input customer po" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 d-flex m-2 p-2">
                                    <div class="card-body d-flex">
                                        <button type="submit" class="btn btn-primary ml-2" name="save">Save</button>
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
        <script>
            $("#id_customer").select2({
                responsive: true,
                width: '100%'
            });
        </script>
        <!-- query save -->
        <?php
        if (isset($_POST['save']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
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

            $querySaveSample = mysqli_query($conn, "INSERT INTO sample_request(no_sample, subject, requestor, id_customer, pic_customer, date_required, delivery_date, delivery_by, delivery_address, customer_po)
            VALUES('$no_sample', '$subject', '$requestor', $customers_id, '$pic_customer', '$date_required', '$delivery_date', '$delivery_by', '$delivery_address', '$customer_po') ");

            if ($querySaveSample) {
                echo "<script>
                        swal('Data Saved!', 'Click OK to continue', 'success')
                        .then((value) => {
                         document.location.href='/pages/staff/sample-request.php';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                        document.location.href='/pages/staff/sample-request-add.php';
                        </script>";
            }
        }

        ?>


</body>

</html>
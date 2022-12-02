<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}
if ($_SESSION['user']['dept'] != 'CS' && $_SESSION['user']['dept'] != 'MK') {
    echo "<script>
    document.location.href='/index.php';
    </script>";
}

if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}

$code_sample = $_GET["cc"];
$queryEditData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id WHERE no_sample='$code_sample'");
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
    <title>Sample Request App - Sample Request-Edit</title>

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
                                        <label for="" class="font-weight-bold">No Sample</label>
                                        <input type="text" name="no_sample" id="" class="form-control" readonly value="<?= $row->no_sample ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Subject</label>
                                        <input type="text" name="subject" id="" class="form-control" placeholder="input sample request subject" value="<?= $row->subject ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Requestor</label>

                                        <input type="text" name="requestor_name" id="" class="form-control" value="<?= $_SESSION['user']['fname'] . ' ' .  $_SESSION['user']['lname'] ?>" readonly required>
                                        <input type="hidden" name="requestor" id="" class="form-control" value="<?= $_SESSION['user']['id'] ?>" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
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


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">

                                        <label class="font-weight-bold" for="">Delivery By</label>
                                        <select name="delivery_by" id="DeliveryId" class="form-control">
                                            <option value="<?= $row->delivery_by ?>" selected><?= $status_message_delivery ?></option>
                                            <option disabled>Select Delivery</option>
                                            <option value="0">PICK UP</option>
                                            <option value="1">EKSPEDISI</option>
                                            <option value="2">BY SALES</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Customers </label>
                                        <select name="id_customer" id="id_customer" class="custom-select form-control" data-live-search="true" required>
                                            <option value="<?= $row->id_customer ?>" selected><?= $row->CustomerName ?></option>
                                            <option disabled>Select Customers</option>
                                            <?php
                                            $id_users = $_SESSION['user']['id'];
                                            $dataCustomers = mysqli_query($conn, "SELECT * FROM customer WHERE id_users_sales='$id_users'");
                                            while ($rowCustomers = mysqli_fetch_object($dataCustomers)) : ?>
                                                <option value="<?= $rowCustomers->CustomerId ?>"><?= $rowCustomers->CustomerName ?></option>
                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Date Required</label>
                                        <input type="date" name="date_required" id="" class="form-control" value="<?= $row->date_required ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Delivery Date</label>
                                        <input type="date" name="delivery_date" id="" class="form-control" value="<?= $row->delivery_date ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Customers Recipient</label>
                                        <select name="pic_customer" id="pic_customer" class="custom-select form-control">
                                            <option value="<?= $row->pic ?>" selected><?= $row->pic_customer ?></option>
                                            <option disabled>-Select Recipient-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Delivery Address</label>
                                        <select name="delivery_address" id="DeliveryAddress" class="custom-select form-control">
                                            <option value="<?= $row->delivery_address ?>"><?= $row->delivery_address ?></option>
                                            <option disabled>-Select Delivery Address-</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="" class="font-weight-bold">Sales Note</label>
                                        <input type="text" name="sales_note" id="" class="form-control" placeholder="sales note" value="<?= $row->sales_note ?>" required>
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
        <script>
            $("#id_customer").select2({
                responsive: true,
                width: '100%'
            });
            $("#pic_customer").select2({
                responsive: true,
                width: '100%'
            });
            $("#DeliveryAddress").select2({
                responsive: true,
                width: '100%'
            });

            $(document).ready(function() {
                $('#DeliveryId').change(function(e) {
                    //id dropdown delivery by
                    const id = document.getElementById('DeliveryId').value;

                    $('#id_customer').change(function() {
                        var aid = $('#id_customer').val(); //mengambil nilai jika customer dipilih
                        $.ajax({
                            url: 'ajaxeditdata.php',
                            method: 'post',
                            data: 'aid=' + aid,
                        }).done(function(customers) {

                            const selectElementPic = document.getElementById("pic_customer");

                            while (selectElementPic.length > 0) {
                                selectElementPic.remove(0);
                            }

                            if (id != 0) {
                                const selectOptionAddrress = document.getElementById("DeliveryAddress");

                                while (selectOptionAddrress.length > 0) {
                                    selectOptionAddrress.remove(0);
                                }
                                customers2 = JSON.parse(customers);
                                customers2.forEach(key => {
                                    $('#pic_customer').append('<option value="' + key['pic'] + '">' + key['pic'] + '</option>');
                                    $('#DeliveryAddress').append('<option value="' + key['customers_address'] + '">' + key['customers_address'] + '</option>');
                                });

                            } else {
                                const selectOptionAddrress = document.getElementById("DeliveryAddress");

                                while (selectOptionAddrress.length > 0) {
                                    selectOptionAddrress.remove(0);
                                }
                                customers2 = JSON.parse(customers);
                                customers2.forEach(key => {
                                    $('#pic_customer').append('<option selected value="' + key['pic'] + '">' + key['pic'] + '</option>');
                                });
                                $('#DeliveryAddress').append('<option value="PICKUP">PICK UP</option>');

                            }
                            //menampilkan data relasi customer detail jika select option customer dipilih
                            // customers2.for(function(customer) {
                            //     $('#pic_customer').append('<option>' + customer.pic + '</option>');
                            // });
                        });
                    });
                });
            });
        </script>
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

            $sales_note = $_POST['sales_note'];

            $queryUpdateSample = mysqli_query($conn, "UPDATE sample_request SET 
            subject='$subject', requestor=$requestor, id_customer=$customers_id, pic_customer='$pic_customer',
            date_required='$date_required', delivery_date='$delivery_date', delivery_by='$delivery_by',
            delivery_address='$delivery_address', sales_note='$sales_note' WHERE id='$id'");

            if ($queryUpdateSample) {
                echo "<script>
                        swal('Data was updated!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/staff/sample-request.php';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                        document.location.href='/pages/staff/sample-request-edit.php?cc=$code_sample';
                        </script>";
            }
        }

        ?>


</body>

</html>
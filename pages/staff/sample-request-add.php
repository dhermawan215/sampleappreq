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
                                        <label class="font-weight-bold" for="">No Sample</label>
                                        <input type="text" name="no_sample" id="" class="form-control" readonly value="<?= $sample_no ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Subject</label>
                                        <input type="text" name="subject" id="" class="form-control" placeholder="input sample request subject" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Requestor</label>
                                        <input type="text" name="requestor_name" id="" class="form-control" value="<?= $_SESSION['user']['fname'] . ' ' .  $_SESSION['user']['lname'] ?>" readonly required>
                                        <input type="hidden" name="requestor" id="" class="form-control" value="<?= $_SESSION['user']['id'] ?>" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Delivery By</label>
                                        <select name="delivery_by" id="DeliveryId" class="form-control">
                                            <option disabled selected>Select Delivery</option>
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
                                        <label class="font-weight-bold" for="">Customers </label>
                                        <select name="id_customer" id="id_customer" class="custom-select form-control" data-live-search="true" required>
                                            <option disabled selected>Select Customers</option>
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
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="pic_customer">Customers Recipient</label>
                                        <select name="pic_customer" id="pic_customer" class="custom-select form-control">
                                            <option disabled selected>-Select Recipient-</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Date Required</label>
                                        <input type="date" name="date_required" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Delivery Date</label>
                                        <input type="date" name="delivery_date" id="" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Delivery Address</label>
                                        <select name="delivery_address" id="DeliveryAddress" class="custom-select form-control">
                                            <option disabled selected>-Select Delivery Address-</option>

                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label class="font-weight-bold" for="">Status Sample Request</label>
                                        <select name="status" id="" class="form-control">
                                            <option selected value="0">Requested</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($_SESSION['user']['dept'] == 'MK') : ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body rounded-1">
                                            <label class="font-weight-bold" for="">Sales Note</label>
                                            <input type="text" name="sales_note" id="" class="form-control" placeholder="input sales note for this sample request">
                                        </div>
                                    </div>
                                <?php elseif ($_SESSION['user']['dept'] == 'CS') : ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body rounded-1">
                                            <label class="font-weight-bold" for="">CS Note</label>
                                            <input type="text" name="cs_note" id="" class="form-control" placeholder="input cs note for this sample request">
                                        </div>
                                    </div>
                                <?php else : ?>
                                <?php endif; ?>
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
            $("#pic_customer").select2({
                responsive: true,
                width: '100%'
            });
            $("#DeliveryAddress").select2({
                responsive: true,
                width: '100%'
            });
            //untuk data ajax
            // $(document).ready(function() {
            //     $('#id_customer').change(function() {
            //         var aid = $('#id_customer').val(); //mengambil nilai jika customer dipilih

            //         $.ajax({
            //             url: 'data.php',
            //             method: 'post',
            //             data: 'aid=' + aid,
            //         }).done(function(customers) {
            //             //menampilkan data relasi customer detail jika select option customer dipilih

            //             customers2 = JSON.parse(customers);
            //             customers2.forEach(key => {
            //                 $('#pic_customer').append('<option value="' + key['id_customer_details'] + '">' + key['pic'] + '</option>');
            //                 $('#DeliveryAddress').append('<option value="' + key['id_customer_details'] + '">' + key['pic'] + '</option>');

            //             });
            //             // customers2.for(function(customer) {
            //             //     $('#pic_customer').append('<option>' + customer.pic + '</option>');
            //             // });
            //         });
            //     });
            // });

            $(document).ready(function() {
                $('#DeliveryId').change(function(e) {
                    //id dropdown delivery by
                    const id = document.getElementById('DeliveryId').value;

                    $('#id_customer').change(function() {
                        var aid = $('#id_customer').val(); //mengambil nilai jika customer dipilih
                        $.ajax({
                            url: 'data.php',
                            method: 'post',
                            data: 'aid=' + aid,
                        }).done(function(customers) {
                            // customers2 = JSON.parse(customers);

                            // console.log(customers2);
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
            $status = $_POST['status'];
            $sales_note = $_POST['sales_note'];
            $cs_note = $_POST['cs_note'];

            $querySaveSample = mysqli_query($conn, "INSERT INTO sample_request(no_sample, subject, requestor, id_customer, pic_customer, date_required, delivery_date, delivery_by, delivery_address, status, sales_note, cs_note)
            VALUES('$no_sample', '$subject', '$requestor', $customers_id, '$pic_customer', '$date_required', '$delivery_date', '$delivery_by', '$delivery_address', $status, '$sales_note', '$cs_note') ");
            if ($querySaveSample) {
                ///untuk notifikasi    
                $SampleId = mysqli_insert_id($conn);
                $DataSample = mysqli_query($conn, "SELECT * FROM sample_request JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id WHERE sample_request.id=$SampleId");
                $DataSampleRow = mysqli_fetch_object($DataSample);

                ///insert ke notifikasi
                $no_sample_notif = $DataSampleRow->no_sample;
                $names = $DataSampleRow->FirstName;
                $id_categoryNotifaccount = 1;
                $id_categoryNotifglobal = 2;
                $id_employee = $DataSampleRow->requestor;
                $notif_title_account = "Sampel No $no_sample_notif berhasil dibuat.";
                $notif_title_global = "Sampel No $no_sample_notif berhasil ditambahkan!";
                $desc_account = "Dear $names sampel anda berhasil dibuat, silahkan tambahkan item detail request sampel anda";
                $desc_global = "Dear RND dan CS, Sampel baru telah diminta/dibuat";

                //insert fata notifikasi untuk user yang membuat sample request (sales)
                $saveNotifAccount = mysqli_query($conn, "INSERT INTO notification(category_id, title, description, id_employee)
                                    VALUES($id_categoryNotifaccount,'$notif_title_account','$desc_account', $id_employee )");

                $saveNotifGlobal = mysqli_query($conn, "INSERT INTO notification(category_id, title, description)
                                    VALUES($id_categoryNotifglobal,'$notif_title_global','$desc_global' )");

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
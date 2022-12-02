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

if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}
// var_dump($_POST);
// exit;

$code_sample = $_GET["cc"];
$queryEditData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE no_sample='$code_sample'");
$row = mysqli_fetch_object($queryEditData);

if ($queryEditData->num_rows == 0) {
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
    <title>Sample Request App - Sample Request-Status</title>

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
                                        Change Status
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Change Status</h4>
                        <h5><a href="/pages/rnd/sample-request.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="POST">
                            <div class="row col-12">
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <?php
                                $status =  $row->status;
                                switch ($status) {
                                    case 1:
                                        $status_messages = "Confirm";
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
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="font-weight-bold">Sample Request No: <span class="text-primary"> <?= $row->no_sample ?></span> </p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="font-weight-bold">Current Status Sample Request: <span class="text-primary"> <?= $status_messages ?></span> </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 ">

                                    <!-- radio button for cs -->
                                    <?php if ($_SESSION['user']['dept'] == 'RD' && $row->status == 0) : ?>
                                        <label for="">Select Sample Request Status</label>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="1" />
                                            <label class="form-check-label" for="flexRadioDefault2"> Confirm </label>
                                        </div>
                                    <?php elseif ($_SESSION['user']['dept'] == 'RD' && $row->status == 1) : ?>
                                        <label for="">Select Sample Request Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="2" />
                                            <label class="form-check-label" for="flexRadioDefault2"> Ready </label>
                                        </div>
                                    <?php else : ?>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <!-- untuk rnd notes -->
                            <?php if (($row->status >= 0 || $row->status <= 2) && $_SESSION['user']['dept'] == 'RD') : ?>
                                <?php if ($row->status == 0) : ?>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">Sales Note (saat status sample request di buat)</label>
                                            <textarea readonly id="" cols="30" rows="10" class="form-control"><?= $row->sales_note ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">RnD Note</label>
                                            <textarea name="rnd_notes" id="" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                <?php elseif ($row->status == 1) : ?>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">RnD Note (saat status in progress)</label>
                                            <textarea readonly id="" cols="30" rows="10" class="form-control"><?= $row->rnd_notes ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">RnD Note</label>
                                            <textarea name="rnd_notes" id="" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                <?php elseif ($row->status == 2) : ?>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">RnD Note (saat status ready)</label>
                                            <textarea readonly id="" cols="30" rows="10" class="form-control"><?= $row->rnd_notes ?></textarea>
                                        </div>
                                    </div>
                                <?php else : ?>
                                <?php endif; ?>

                            <?php else : ?>
                            <?php endif; ?>
                            <div class="row col-12 d-flex">
                                <div class="col-lg-6 col-md-6 col-sm-12 d-flex m-2 p-2">
                                    <div class="card-body d-flex">
                                        <?php if ($row->status == 0 && $_SESSION['user']['dept'] == 'RD') : ?>
                                            <button type="submit" class="btn btn-primary ml-2" name="update">Change Status</button>
                                            <button type="reset" class="btn btn-danger ml-2" name="save">Reset</button>
                                        <?php elseif ($row->status == 1  && $_SESSION['user']['dept'] == 'RD') : ?>
                                            <button type="submit" class="btn btn-primary ml-2" name="update">Change Status</button>
                                            <button type="reset" class="btn btn-danger ml-2" name="save">Reset</button>
                                        <?php else : ?>
                                        <?php endif; ?>

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
        if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {


            $id = $_POST['id'];
            $status = $_POST['status'];
            $rnd_notes = $_POST['rnd_notes'];
            // var_dump($status);
            // var_dump($cs_note);
            // var_dump($sales_note);
            // exit;
            //data for deliverY
            //data notifikasi

            $DataSample = mysqli_query($conn, "SELECT * FROM sample_request JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id WHERE sample_request.id=$id");
            $DataSampleRow = mysqli_fetch_object($DataSample);
            $no_sample_notif = $DataSampleRow->no_sample;
            $names = $DataSampleRow->FirstName;
            $id_employee = $DataSampleRow->requestor;

            switch ($status) {
                case 2:
                    $notif_title_account = "Sampel No $no_sample_notif telah siap.";
                    $notif_title_global = "Sampel No $no_sample_notif telah siap";
                    $desc_account = "Dear $names sampel anda telah siap, proses selanjutkan akan dilakukan oleh customer service";
                    $desc_global = "Dear CS, Sampel telah siap, silahkan melakukan proses pick up dan melakukan konfirmasi ke RND";
                    break;

                default:
                    $notif_title_account = "Sampel No $no_sample_notif berhasil dikonfirmasi Tim RND.";
                    $notif_title_global = "Sampel No $no_sample_notif telah dikonfirmasi";
                    $desc_account = "Dear $names sampel berhasil dikonfirmasi RND, proses selanjutnya dilakukan oleh tim RND";
                    $desc_global = "Sampel berhasil dikonfirmasi oleh Tim RND";
                    break;
            }

            if ($rnd_notes != null) {
                $queryUpdateSample = mysqli_query($conn, "UPDATE sample_request SET status=$status, rnd_notes='$rnd_notes' WHERE id='$id'");
            }


            if ($queryUpdateSample) {
                ///insert ke notifikasi
                $id_categoryNotifaccount = 1;
                $id_categoryNotifglobal = 2;
                //insert data notifikasi untuk user yang membuat sample request (sales)
                $saveNotifAccount = mysqli_query($conn, "INSERT INTO notification(category_id, title, description, id_employee)
                                    VALUES($id_categoryNotifaccount,'$notif_title_account','$desc_account', $id_employee )");

                $saveNotifGlobal = mysqli_query($conn, "INSERT INTO notification(category_id, title, description)
                                    VALUES($id_categoryNotifglobal,'$notif_title_global','$desc_global' )");
                echo "<script>
                        swal('Data was updated!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/rnd/sample-request-change-status.php?cc=$code_sample';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                        document.location.href='/pages/rnd/sample-request-change-status.php?cc=$code_sample';
                        </script>";
            }
        }

        ?>


</body>

</html>
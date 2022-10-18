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
                                        <a class="text-decoration-none" href="/pages/staff/sample-request.php">Sample Request</a>
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
                        <h5><a href="/pages/staff/sample-request.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="POST">
                            <div class="row col-12">
                                <input type="hidden" name="id" value="<?= $row->id ?>">
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
                                        $status_messages = "Completed";
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
                                    <?php if ($_SESSION['user']['dept'] == 'CS' && $row->status == 2) : ?>
                                        <label for="">Select Sample Request Status</label>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="3" />
                                            <label class="form-check-label" for="flexRadioDefault2"> PICK UP </label>
                                        </div>
                                    <?php elseif ($row->status >= 3 && $_SESSION['user']['dept'] == 'MK') : ?>
                                        <label for="">Select Sample Request Status</label>
                                        <?php if ($row->status == 3 && $_SESSION['user']['dept'] == 'MK') : ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="4" />
                                                <label class="form-check-label" for="flexRadioDefault1"> ACCEPTED BY CUSTOMERS </label>
                                            </div>
                                        <?php elseif ($row->status <= 4 && $_SESSION['user']['dept'] == 'MK') : ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="5" />
                                                <label class="form-check-label" for="flexRadioDefault2"> REVIEWED </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="6" />
                                                <label class="form-check-label" for="flexRadioDefault2"> CANCEL</label>
                                            </div>
                                        <?php endif; ?>



                                        <!-- Default checked radio -->

                                    <?php else : ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <!-- untuksales -->
                            <?php if ($row->status >= 3  && $_SESSION['user']['dept'] == 'MK') : ?>
                                <?php if ($row->status >= 5) : ?>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">Sales Note</label>
                                            <textarea readonly name="sales_note" id="" cols="30" rows="10" class="form-control"><?= $row->sales_note ?></textarea>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="row col-12 mt-3">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="" class="font-weight-bold">Sales Note</label>
                                            <textarea name="sales_note" id="" cols="30" rows="10" class="form-control"><?= $row->sales_note ?></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php elseif ($_SESSION['user']['dept'] == 'CS' && $row->status == 2) : ?>
                                <!-- untukcustomersservice -->
                                <div class="row col-12 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="" class="font-weight-bold">Customers Service Note</label>
                                        <textarea name="cs_note" id="" cols="30" rows="10" class="form-control"><?= $row->cs_note ?></textarea>
                                    </div>
                                </div>
                            <?php else : ?>
                            <?php endif; ?>

                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
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
                                <p class="font-weight-bold">Current Status Delivery By: <span class="text-primary"> <?= $status_message_delivery ?></span> </p>

                            </div>
                            <?php
                            $qudeliver = mysqli_query($conn, "SELECT * FROM delivery WHERE id_sample_req='$row->id'");
                            $fetchDeliver = mysqli_fetch_object($qudeliver);

                            if ($row->delivery_by == 1 && $qudeliver->num_rows == 0 && $_SESSION['user']['dept'] == 'CS') : ?>
                                <div class="row d-flex col-12">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="font-weight-bold" for="">Delivery Name</label>
                                        <input type="text" name="delivery_name" id="" class="form-control" placeholder="input method name of delivery ex: JNE .etc">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="font-weight-bold" for="">Expedition Receipt</label>
                                        <input type="text" name="resi_ekspedisi" id="" class="form-control" placeholder="input exition receipt">
                                    </div>

                                </div>
                            <?php else : ?>
                            <?php endif; ?>
                            <div class="row col-12 d-flex">
                                <div class="col-lg-6 col-md-6 col-sm-12 d-flex m-2 p-2">
                                    <div class="card-body d-flex">
                                        <?php if (($row->status == 2 && $_SESSION['user']['dept'] == 'CS') || ($row->status >= 3  && $_SESSION['user']['dept'] == 'MK')) : ?>
                                            <button type="submit" class="btn btn-primary ml-2" name="update">Change Status</button>
                                            <button type="reset" class="btn btn-danger ml-2" name="save">Reset</button>
                                        <?php endif; ?>
                                        <?php if ($qudeliver->num_rows != 0) : ?>
                                            <a href="" class="btn btn-info ml-2">Print Surat Jalan</a>
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
            $cs_note = $_POST['cs_note'];
            $sales_note = $_POST['sales_note'];

            //data for delivery
            if ($qudeliver->num_rows == 0) {
                $delivery_name = $_POST['delivery_name'];
                $resi_ekspedisi = $_POST['resi_ekspedisi'];
                $querydb = mysqli_query($conn, "SELECT MAX(resi) as kode FROM delivery");
                $fetch = mysqli_fetch_object($querydb);
                $kodeSampel = $fetch->kode;
                $bulanTgl = date('md');
                $huruf = "SJL-";
                $zki = "/ZKI/";
                //urutan no sampelnya
                // SJL-1011/ZKI/001
                $urutan = (int) substr($kodeSampel, 13, 4);
                $urutan++;
                $resi = $huruf . $bulanTgl . $zki . sprintf("%04s", $urutan);

                $queryDelivery = mysqli_query($conn, "INSERT INTO delivery(id_sample_req, delivery_name, resi, resi_ekspedisi)
                VALUES($id, '$delivery_name', '$resi', '$resi_ekspedisi')");
            }


            $queryUpdateSample = mysqli_query($conn, "UPDATE sample_request SET status=$status, sales_note='$sales_note', cs_note='$cs_note' WHERE id='$id'");

            if ($queryUpdateSample || $queryDelivery) {
                echo "<script>
                        swal('Data was updated!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/staff/sample-request-change-status.php?cc=$code_sample';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                        document.location.href='/pages/staff/sample-request-change-status.php?cc=$code_sample';
                        </script>";
            }
        }

        ?>


</body>

</html>
<?php include('../../config/config.php');
session_start();
//get id form url
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}
if (($_SESSION['user']['dept'] != 'MK') && ($_SESSION['user']['dept'] != 'CS')) {
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
$queryDetailData = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id  WHERE no_sample='$code_sample'");
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
                                    <li class="breadcrumb-item " aria-current="page">
                                        Detail
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Add Detail Sample Request
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Sample No: <?= $row->no_sample ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Subject: <?= $row->subject ?>
                                </div>
                            </div>

                        </div>
                        <div class="row col-12 mt-2 ">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Requestor: <?= $row->FirstName ?> <span></span><?= $row->LastName ?>
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
                            <div class="row col-12">
                                <h5 class="text-primary text-md-left">Details Product For Sample No : <?= $row->no_sample ?></h5>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="">Product</label>
                                    <select name="id_barang" id="id-produk" class="form-control custom-select" autocomplete="off" data-live-search="true" size="5" required>
                                        <option disabled selected>Select Product</option>

                                        <!-- query produk -->
                                        <?php
                                        $queryProductData = mysqli_query($conn, "SELECT * FROM inventory");
                                        while ($rowProduct = mysqli_fetch_object($queryProductData)) :
                                        ?>
                                            <option value="<?= $rowProduct->InvId ?>"><?= $rowProduct->InvName ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="font-weight-bold" for="">Qty Produk</label>
                                    <input type="text" class="form-control" name="qty" placeholder="input qty product(example: 2 botol @200ml)" required>
                                </div>

                            </div>


                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="font-weight-bold" for="">Label Name</label>
                                    <input type="text" name="nama_label" id="" class="form-control" placeholder="input label name" required>
                                </div>

                            </div>
                            <div class="row col-12 mt-3">
                                <div class="col-lg-12 ">
                                    <div class="d-flex text-center justify-content-center">
                                        <button type="submit" class="btn btn-primary ml-2" name="save_details">Save</button>
                                        <button type="reset" class="btn btn-outline-danger ml-2">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- tabel isi detail sampel reqesuest -->
                <!-- querytabeldetailsamplerequest -->
                <?php
                $queryDetailTabelSampleReq = mysqli_query($conn, "SELECT * FROM sample_request_details INNER JOIN inventory ON sample_request_details.id_barang = inventory.InvId WHERE id_sample_req='$row->id'");
                $norow = 1;
                ?>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <div class="row mb-3">
                            <div class="col-lg-12 ">
                                <h5 class="text-primary" style="font-size: 18px;">Data Details Sample Request</h5>
                            </div>
                        </div>
                        <?php if ($queryDetailTabelSampleReq->num_rows != 0) : ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Qty Product</th>
                                                    <th scope="col">Label Name</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($fetchDetailsTabel = mysqli_fetch_object($queryDetailTabelSampleReq)) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $norow++ ?></th>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                                    <i class="dw dw-more"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                    <a class="dropdown-item" href="/pages/staff/sample-request-details-edit.php?cc=<?= $fetchDetailsTabel->id_det ?>"><i class="dw dw-edit2"></i> Edit</a>
                                                                    <form action="/pages/staff/sample-request-details-delete.php" method="post" class="m-1 px-1 py-1">
                                                                        <input type="hidden" name="id" value="<?= $fetchDetailsTabel->id_det ?>">
                                                                        <input type="hidden" name="no_sample" value="<?= $row->no_sample ?>">
                                                                        <button class="dw dw-delete-3 btn-sm btn show_confirm" name="delete" type="delete" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $fetchDetailsTabel->InvName ?></td>
                                                        <td><?= $fetchDetailsTabel->qty ?></td>
                                                        <td><?= $fetchDetailsTabel->nama_label ?></td>

                                                    </tr>
                                                <?php endwhile ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <b class="text-danger">Data Not Found</b>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
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
            $("#unit-produk").select2({
                responsive: true,
                width: '100%'
            });
            $("#unit-produk-pack").select2({
                responsive: true,
                width: '100%'
            });
        </script>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<script>
                        swal('Data was deleted', 'Click OK to continue', 'success');
                        </script>";
            unset($_SESSION['success']);
        }
        //cek sesion data kosong
        if (isset($_SESSION['danger'])) {
            echo "<script>
                        swal('Sory, Something Went Wrong', 'Click OK to continue', 'success');
                        </script>";
            unset($_SESSION['danger']);
        }
        //cek sesion data tidak ada di db
        if (isset($_SESSION['warning'])) {
            echo "<script>
                        swal('Sory, Data Not Found', 'Click OK to continue', 'success');
                        </script>";
            unset($_SESSION['warning']);
        }

        ?>

        <!-- querysavesamplereqdetails -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_details'])) {
            $id_sample_req = $_POST['id_sample_req'];
            $id_barang = $_POST['id_barang'];
            $qty_product = $_POST['qty'];
            $nama_label = $_POST['nama_label'];


            $querySaveDetailSampleReq = mysqli_query($conn, "INSERT INTO sample_request_details(id_sample_req, id_barang, qty, nama_label)
            VALUES($id_sample_req, $id_barang, '$qty_product', '$nama_label')");

            if ($querySaveDetailSampleReq) {
                echo "<script>
                swal('Data Saved!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/staff/sample-request-add-detail.php?cc=$row->no_sample';
                });
                </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                document.location.href='/pages/staff/sample-request-add-detail.php?cc=$row->no_sample';
                        </script>";
            }
        }

        ?>


</body>

</html>
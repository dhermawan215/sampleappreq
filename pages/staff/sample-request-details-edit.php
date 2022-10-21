<?php include('../../config/config.php');
session_start();
//get id form url
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

$id_url = $_GET["cc"];
$queryEditDataDetails = mysqli_query($conn, "SELECT * FROM sample_request_details INNER JOIN sample_request ON sample_request_details.id_sample_req=sample_request.id INNER JOIN inventory ON sample_request_details.id_barang=inventory.InvId
WHERE sample_request_details.id_det='$id_url'");
$row = mysqli_fetch_object($queryEditDataDetails);

if ($queryEditDataDetails->num_rows == 0) {
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
                                        Edit Detail Sample Request
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>


                <!-- add details sample request -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $row->id_det ?>">
                            <input type="hidden" name="id_sample_req" value="<?= $row->id_sample_req ?>">
                            <div class="row-col-12 p-3">
                                <h5 class="text-primary text-md-left">Edit Data Details Sample Request, For Sample No: <?= $row->no_sample ?></h5>
                                <h5><a href="/pages/staff/sample-request-add-detail.php?cc=<?= $row->no_sample ?>" class="text-danger mt-3"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="">Product</label>
                                    <select name="id_barang" id="id-produk" class="form-control custom-select" autocomplete="off" data-live-search="true" size="5" required>
                                        <option value="<?= $row->id_barang ?>" selected><?= $row->InvName ?></option>
                                        <option disabled>Select Product</option>

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
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold" for="">Qty Produk</label>
                                    <input type="number" class="form-control" name="qty" placeholder="input qty product" value="<?= $row->qty ?>" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold" for="">Unit Product</label>
                                    <select name="unit" id="unit-produk" class="form-control custom-select" autocomplete="off" data-live-search="true" size="5" required>
                                        <option value="<?= $row->unit ?>" selected><?= $row->unit ?></option>
                                        <option disabled>Select Unit Product</option>

                                        <?php
                                        $queryUnit1 = mysqli_query($conn, "SELECT * FROM unit");
                                        while ($rowUnit1 = mysqli_fetch_object($queryUnit1)) :
                                        ?>
                                            <option value="<?= $rowUnit1->Unit ?>"><?= $rowUnit1->Unit ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold" for="">Qty Pack</label>
                                    <input type="number" class="form-control" name="qty_pack" placeholder="input qty pack" value="<?= $row->qty_pack ?>" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold" for="">Unit Pack</label>
                                    <select name="unit_pack" id="unit-produk-pack" class="form-control custom-select" autocomplete="off" data-live-search="true" size="5" required>
                                        <option value="<?= $row->unit_pack ?>" selected><?= $row->unit_pack ?></option>
                                        <option disabled>Select Unit Pack</option>

                                        <?php
                                        $queryUnit2 = mysqli_query($conn, "SELECT * FROM unit");
                                        while ($rowUnit2 = mysqli_fetch_object($queryUnit2)) :
                                        ?>
                                            <option value="<?= $rowUnit2->Unit ?>"><?= $rowUnit2->Unit ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="font-weight-bold" for="">Description</label>
                                    <input type="text" name="deskripsi" id="" class="form-control" placeholder="input description" value="<?= $row->deskripsi ?>" required>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold" for="">Label Name</label>
                                    <input type="text" name="nama_label" id="" class="form-control" placeholder="input label name" value="<?= $row->nama_label ?>" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold" for="">Kop Surat</label>
                                    <input type="text" name="kop_surat" id="" class="form-control" placeholder="input kop surat(opsional)" value="<?= $row->kop_surat ?>" required>
                                </div>
                            </div>
                            <div class="row col-12 mt-3">
                                <div class="col-lg-12 ">
                                    <div class="d-flex text-center justify-content-center">
                                        <button type="submit" class="btn btn-primary ml-2" name="update_details">Update</button>
                                        <button type="reset" class="btn btn-outline-danger ml-2">Reset</button>
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

        <!-- querysavesamplereqdetails -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_details'])) {
            $id = $_POST['id'];
            $id_sample_req = $_POST['id_sample_req'];
            $id_barang = $_POST['id_barang'];
            $qty_product = $_POST['qty'];
            $unit_product = $_POST['unit'];
            $qty_pack = $_POST['qty_pack'];
            $unit_pack = $_POST['unit_pack'];
            $deskripsi = $_POST['deskripsi'];
            $nama_label = $_POST['nama_label'];
            $kop_surat = $_POST['kop_surat'];

            $queryUpdateDataDetails = mysqli_query($conn, "UPDATE sample_request_details SET
            id_sample_req=$id_sample_req, id_barang=$id_barang, qty=$qty_product, qty_pack=$qty_pack, unit='$unit_product', unit_pack='$unit_pack', nama_label='$nama_label', deskripsi='$deskripsi', kop_surat='$kop_surat'
            WHERE id_det='$id'");

            if ($queryUpdateDataDetails) {
                echo "<script>
                swal('Data was updated!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/staff/sample-request-add-detail.php?cc=$row->no_sample';
                });
                </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                document.location.href='/pages/staff/sample-request-details-edit.php?cc=$row->id_det';
                        </script>";
            }
        }

        ?>


</body>

</html>
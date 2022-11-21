<?php include('../../config/config.php');
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}


?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Produk</title>

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
                                <h4>Inventory Produk</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Inventory Produk
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right">
                            <a href="/pages/admin/produk-add.php" class="btn btn-primary ">
                                <i class="bi bi-plus"></i>Add Data
                            </a>
                            <a href="#" class="btn btn-success " data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                                <i class="bi bi-upload"></i> Upload Data
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Inventory Produk</h4>
                    </div>
                    <div class="pb-20 table-responsive">

                        <!-- query -->
                        <?php
                        $no = 1;
                        $queryInventory = mysqli_query($conn, "SELECT * FROM products");
                        ?>
                        <table class="data-table table stripe hover nowrap ">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort" style="width: 17px;">No</th>
                                    <th>Kode</th>
                                    <th>Fungsi</th>
                                    <th>Aplikasi</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_object($queryInventory)) : ?>
                                    <tr>
                                        <td class="table-plus"><?= $no++ ?></td>
                                        <td><?= $row->kode_produk ?></td>
                                        <td><?= $row->fungsi ?></td>
                                        <td><?= $row->aplikasi ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="produk-edit.php?cc=<?= $row->id_product ?>"><i class="dw dw-edit2"></i> Edit</a>
                                                    <a class="dropdown-item" href="produk-detail.php?cc=<?= $row->id_product ?>"><i class="dw dw dw-eye"></i>Detail</a>

                                                    <form action="produk-delete.php" method="post" class="m-1 px-1 py-1">
                                                        <input type="hidden" name="InvId" value="<?= $row->id_product ?>">
                                                        <button class="dw dw-delete-3 btn-sm btn show_confirm" name="delete" type="delete" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php include('../layouts/footer.php'); ?>

            <div class="col-md-4 col-sm-12 mb-30">
                <div class="">

                    <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">
                                        Form Upload Data Produk
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        ×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="col-lg-12 col-md-6 col-sm-12 px-2 py-2">
                                            <label for="" class="font-weight-bold">file (format .xls only)</label>
                                            <input type="file" name="file" id="" class="form-control mb-1">

                                        </div>
                                        <div class="py-2 px-2 mt-1">
                                            <button type="submit" name="upload_files" class="btn btn-success">
                                                <i class="bi bi-file-arrow-up"></i> Upload
                                            </button>

                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <!-- js -->
        <?php include('../layouts/js.php'); ?>
        <!-- cek session delete -->
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

        //upload file query




        ?>


</body>

</html>
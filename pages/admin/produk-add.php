<?php include('../../config/config.php');
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
    <title>Sample Request App - Produk-Add</title>

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
                                <h4>Produk</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/admin/produk.php">Produk</a>
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
                        <h5><a href="/pages/admin/produk.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="POST">
                            <div class="row col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Kode Produk</label>
                                        <input type="text" name="kode_produk" id="" class="form-control" placeholder="input kode produk" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Fungsi</label>
                                        <input type="text" name="fungsi" id="" class="form-control" placeholder="input fungsi produk">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Aplikasi</label>
                                        <input type="text" name="aplikasi" id="" class="form-control" placeholder="input aplikasi ">
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

        <!-- query save -->

        <?php
        if (isset($_POST['save'])) {
            $code = $_POST['kode_produk'];
            $fungsi = $_POST['fungsi'];
            $aplikasi = $_POST['aplikasi'];

            $querySave = mysqli_query($conn, "INSERT INTO products(kode_produk, fungsi, aplikasi) VALUES('$code', '$fungsi', '$aplikasi')");

            if ($querySave) {
                echo "<script>
                        swal('Data Saved!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/admin/produk.php';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                    document.location.href='/pages/admin/produk-add.php';
                    </script>";
            }
        }
        ?>


</body>

</html>
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
    document.location.href='/pages/admin/produk.php';
    </script>";
}

$id = $_GET["cc"];
$queryEdit = mysqli_query($conn, "SELECT * FROM inventory WHERE InvId='$id'");
$rowData = mysqli_fetch_object($queryEdit);

//jika data di db kosong
if ($queryEdit->num_rows == 0) {
    echo "<script>
    document.location.href='/pages/admin/produk.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Produk-Edit</title>

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
                        <h5><a href="/pages/admin/produk.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="POST">
                            <div class="row col-12">
                                <input type="hidden" name="InvId" value="<?= $rowData->InvId ?>">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Part No</label>
                                        <input type="text" name="PartNo" id="" class="form-control" placeholder="input part number" value="<?= $rowData->PartNo ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Product Name</label>
                                        <input type="text" name="InvName" id="" class="form-control" placeholder="input product name" value="<?= $rowData->InvName ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Inventory Other Name</label>
                                        <input type="text" name="InvOtherName" id="" class="form-control" placeholder="input other name" value="<?= $rowData->InvOtherName ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 mt-2">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <?php
                                        //query select departemen
                                        $queryDept = mysqli_query($conn, "SELECT * FROM unit");
                                        ?>
                                        <label for="">Unit</label>
                                        <select name="Unit1" id="" class="form-control">
                                            <option selected value="<?= $rowData->Unit1 ?>"><?= $rowData->Unit1 ?></option>
                                            <option value="">select</option>
                                            <?php while ($row = mysqli_fetch_object($queryDept)) : ?>
                                                <option value="<?= $row->Unit ?>"><?= $row->Unit ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Weight</label>
                                        <input type="number" name="Weight" id="" class="form-control" placeholder="input date of birth" value="<?= $rowData->Weight ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <?php
                                        //query select departemen
                                        $queryDept = mysqli_query($conn, "SELECT * FROM unit");
                                        ?>
                                        <label for="">Unit Pack</label>
                                        <select name="UnitPack" id="" class="form-control">
                                            <option value="<?= $rowData->UnitPack ?>"><?= $rowData->UnitPack ?></option>
                                            <option value="">select</option>
                                            <?php while ($row = mysqli_fetch_object($queryDept)) : ?>
                                                <option value="<?= $row->Unit ?>"><?= $row->Unit ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Description</label>
                                        <textarea name="Description" class="form-control" id="" cols="30" rows="10" placeholder="input description of product"><?= $rowData->Description ?></textarea>
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
            $part_no = $_POST['PartNo'];
            $product_name = $_POST['InvName'];
            $other_name = $_POST['InvOtherName'];
            $unit = $_POST['Unit1'];
            $unit_pack = $_POST['UnitPack'];
            $weight = $_POST['Weight'];
            $desc = $_POST['Description'];
            $InvId = $_POST['InvId'];

            $queryUpdate = mysqli_query($conn, "UPDATE inventory SET PartNo='$part_no',
            InvName='$product_name', InvOtherName='$other_name', Unit1='$unit', UnitPack='$unit_pack', Weight='$weight',
            Description='$desc' WHERE InvId='$id'");
            if ($queryUpdate) {
                echo "<script>
                        swal('Data was updated!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/admin/produk.php';
                        });
                        </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                    document.location.href='/pages/admin/produk-edit.php?cc=$id';
                    </script>";
            }
        }
        ?>


</body>

</html>
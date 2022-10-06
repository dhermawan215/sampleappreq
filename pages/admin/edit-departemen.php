<?php include('../../config/config.php');
session_start();
//cek id dari url
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}


if (isset($_GET["IDNo"]) == null) {

    $_SESSION['danger'] = [
        "message" => "Data Was Deleted"
    ];
    echo "<script>
    document.location.href='/pages/admin/departemen.php';
    </script>";
}
$IDNo = $_GET["IDNo"];

//query select data
$querySelectData = mysqli_query($conn, "SELECT * FROM departemen WHERE IDNo='$IDNo'");
$row = mysqli_fetch_object($querySelectData);

//cek id yg di url sama atau tidak sama yang di db
if ($row->IDNo != $IDNo) {
    $_SESSION['warning'] = [
        "message" => "Data Was Deleted"
    ];
    echo "<script>
    document.location.href='/pages/admin/departemen.php';
    </script>";
}


?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App-Edit Departemen</title>

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
                                <h4>Departemen</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Departemen
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <form action="" method="post">
                            <input type="hidden" name="IDNo" value="<?= $row->IDNo ?>">
                            <label for="DeptID" class="font-weight-bold form-control-label p-1">Dept ID</label>
                            <input type="text" name="DeptID" id="" class="form-control" placeholder="ID Departemen" value="<?= $row->DeptID ?>">
                            <label for="Department" class="font-weight-bold form-control-label p-1 mt-1">Department Name</label>
                            <input type="text" name="Department" id="Department" class="form-control" placeholder="Nama Departemen" value="<?= $row->Department ?>">
                            <div class="d-flex mt-2 text-white">
                                <button type="submit" class="btn btn-primary ml-2" name="update">Update</button>
                                <button type="reset" class="btn btn-danger ml-2">Reset</button>
                                <a href="/pages/admin/departemen.php" class="btn btn-secondary ml-2 text-decoration-none ">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include('../layouts/footer.php'); ?>

        </div>

        <!-- js -->
        <?php include('../layouts/js.php'); ?>


        <!-- query update -->
        <?php
        if (isset($_POST["update"])) {
            $IDNo = $_POST["IDNo"];
            $DeptID = $_POST["DeptID"];
            $Department = $_POST["Department"];

            // query update
            $queryUpdate = mysqli_query($conn, "UPDATE departemen SET DeptID='$DeptID', Department='$Department' WHERE IDNo='$IDNo'");

            if ($queryUpdate) {
                echo "<script>
                swal('Data Was Updated!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/admin/departemen.php';
                });
                </script>";
            }
        }

        ?>

</body>

</html>
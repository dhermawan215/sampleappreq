<?php include('../../config/config.php');
//cek id dari url
session_start();

var_dump($_SESSION['user']);
exit;

//cek autentikasi login, jika kosong dilarang akses 
// if (isset($_SESSION['user']) == null) {
//     echo "<script>
//             document.location.href='/login.php';
//             </script>";
// }

//jika id url kosong
if (isset($_GET['uid']) == null) {
    $_SESSION['danger'] = [
        "message" => "Data Was Deleted"
    ];
    echo "<script>
    document.location.href='/pages/admin/unit.php';
    </script>";
}

$id = $_GET["uid"];
$queryDetails = mysqli_query($conn, "SELECT * FROM unit WHERE id='$id'");
$row = mysqli_fetch_object($queryDetails);
//jika data di db kosong
if ($row->id != $id) {
    $_SESSION['warning'] = [
        "message" => "Data Was Deleted"
    ];
    echo "<script>
    document.location.href='/pages/admin/unit.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App-Edit Unit</title>

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
                        <h4 class="text-blue h4">Edit Data </h4>
                        <h5><a href="/pages/admin/unit.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $row->id ?>">
                            <label for="Unit" class="font-weight-bold form-control-label p-1">Unit Name</label>
                            <input type="text" name="Unit" id="Unit" class="form-control" placeholder="Unit Name" value="<?= $row->Unit ?>">
                            <div class="d-flex mt-2 text-white">
                                <button type="submit" class="btn btn-primary ml-2" name="update">Update</button>
                                <button type="reset" class="btn btn-danger ml-2">Reset</button>
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
            $id = $_POST["id"];
            $Unit = $_POST["Unit"];
            // query update
            $queryUpdate = mysqli_query($conn, "UPDATE unit SET Unit='$Unit' WHERE id='$id'");

            if ($queryUpdate) {
                echo "<script>
                swal('Data Was Updated!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/admin/unit.php';
                });
                </script>";
            }
        }

        ?>

</body>

</html>
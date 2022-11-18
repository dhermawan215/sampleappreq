<?php include('../../config/config.php');
//cek id dari url
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

//jika id url kosong
if (isset($_GET['cc']) == null) {
    echo "<script>
    document.location.href='/pages/admin/customers.php';
    </script>";
}

$code = $_GET["cc"];
$queryDetails = mysqli_query($conn, "SELECT * FROM customers_detail JOIN customer ON customers_detail.customers_id=customer.CustomerId WHERE id_customer_details='$code'");
$row = mysqli_fetch_object($queryDetails);
//jika data di db kosong
if ($queryDetails->num_rows == 0) {
    echo "<script>
    document.location.href='/pages/admin/customers.php';
    </script>";
}


?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Customers-Details-Edit</title>

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
                                <h4>Customer</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/admin/customers.php">Customers</a>
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
                        <h4 class="text-blue h4">Edit Data Customer Detail: <?= $row->CustomerName ?> </h4>
                        <h5><a href="/pages/admin/customers.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="post">
                            <input type="hidden" name="id_customer_details" value="<?= $row->id_customer_details ?>">
                            <div class="row col-12">

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers PIC</label>
                                        <input type="text" name="pic" id="" class="form-control" placeholder="input customers name" value="<?= $row->pic ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Phone</label>
                                        <input type="text" name="phone" id="" class="form-control" placeholder="input customers name" value="<?= $row->phone ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Address</label>
                                        <input type="text" name="customers_address" id="" class="form-control" placeholder="input customers name" value="<?= $row->customers_address ?>">
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
        if (isset($_POST['update'])) {
            $id = $_POST['id_customer_details'];

            $pic = htmlspecialchars($_POST['pic']);
            $phone = htmlspecialchars($_POST['phone']);
            $address = htmlspecialchars($_POST['customers_address']);

            $querySave = mysqli_query(
                $conn,
                "UPDATE customers_detail SET pic='$pic', phone='$phone', customers_address='$address' WHERE id_customer_details='$id'"
            );

            if ($querySave) {
                echo "<script>
                swal('Data Was Updated!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/admin/customers-detail.php?cc=$row->CustomerId';
                });
                </script>";
            } else {
                echo "<script>swal('Something went wrong', 'Try again', 'success')
                    .then((value) => {
                    document.location.href='/pages/admin/customers-detail-edit.php?cc=$id';
                    });
                </script>";
            }
        }


        ?>


</body>

</html>
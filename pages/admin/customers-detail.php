<?php include('../../config/config.php');
session_start();
//get id form url
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/admin/customers.php';
    </script>";
}

$code = $_GET["cc"];
$queryDetails = mysqli_query($conn, "SELECT * FROM customer WHERE CustomerId='$code'");
$row = mysqli_fetch_object($queryDetails);

//jika data di url tidak ada di db
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
    <title>Sample Request App - Customers-Detail</title>

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
                                <h4>Customers</h4>
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
                                        Detail
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Customers - <?= $row->CustomerName ?></h4>
                        <h5><a href="/pages/admin/customers.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <div class="row col-12">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Name: <?= $row->CustomerName ?>
                                </div>
                            </div>

                        </div>
                        <div class="row col-12 mt-2">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-body border rounded-1">
                                    Registered At: <?= $row->CustomerDate ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <form action="" method="POST">
                            <input type="hidden" name="customers_id" value="<?= $row->CustomerId ?>">
                            <div class="row col-12">
                                <h6 class="text-primary text-md-left">Form Data Details Customer : <?= $row->CustomerName ?></h6>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="pic" class="font-weight-bold">PIC Customer</label>
                                    <input type="text" name="pic" id="pic" class="form-control" placeholder="input PIC customers">
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="phone" class="font-weight-bold">Customer Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="input customer phone">
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="customer_address" class="font-weight-bold">Customer Address</label>
                                    <input type="text" name="customer_address" id="costumer_address" class="form-control" placeholder="input customers address">
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

                <div class="card-box mb-30">
                    <?php
                    $queryDetailsTableCustomers = mysqli_query($conn, "SELECT * FROM customers_detail WHERE customers_id='$row->CustomerId'");
                    $norow = 1;
                    ?>
                    <div class="pd-20">
                        <div class="row mb-3">
                            <div class="col-lg-12 ">
                                <h5 class="text-primary" style="font-size: 18px;">Data Details Customers</h5>
                            </div>
                        </div>
                        <?php if ($queryDetailsTableCustomers->num_rows != 0) : ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">PIC</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Address</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($fetchDetailsTabel = mysqli_fetch_object($queryDetailsTableCustomers)) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $norow++ ?></th>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                                    <i class="dw dw-more"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                    <a class="dropdown-item" href="/pages/admin/customers-detail-edit.php?cc=<?= $fetchDetailsTabel->id_customer_details ?>"><i class="dw dw-edit2"></i> Edit</a>
                                                                    <form action="/pages/admin/customers-detail-delete.php" method="POST" class="m-1 px-1 py-1">
                                                                        <input type="hidden" name="id" value="<?= $fetchDetailsTabel->id_customer_details ?>">

                                                                        <button class="dw dw-delete-3 btn-sm btn show_confirm" name="delete" type="delete" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $fetchDetailsTabel->pic ?></td>
                                                        <td><?= $fetchDetailsTabel->phone ?></td>
                                                        <td><?= $fetchDetailsTabel->customers_address ?></td>

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

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_details'])) {
            $customers_id  = $_POST['customers_id'];
            $pic = mysqli_real_escape_string($conn, $_POST['pic']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

            $querySaveDetailsCustomers = mysqli_query($conn, "INSERT INTO customers_detail(customers_id, pic, phone, customers_address)
            VALUES($customers_id, '$pic', '$phone', '$customer_address')");

            if ($querySaveDetailsCustomers) {
                echo "<script>
                swal('Data Saved!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/admin/customers-detail.php?cc=$row->CustomerId';
                });
                </script>";
            } else {
                echo "<script>alert('Something went wrong, try again!');
                document.location.href='/pages/admin/customers-detail.php?cc=$row->CustomerId';
                        </script>";
            }
        }



        ?>


</body>

</html>
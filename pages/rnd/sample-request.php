<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if ($_SESSION['user']['dept'] != 'RD') {
    echo "<script>
    document.location.href='/index.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Sample Request</title>

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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Sample Request
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="text-blue h4">Print Out / Export Data</h4>
                            <p class="text-sm">select a time period</p>
                        </div>
                    </div>
                    <div class="pd-20">
                        <form action="sample-request-doc.php" method="get">
                            <div class="row p-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="status" class="px-2">Status</label>
                                    <select name="status" id="status" class="form-control px-2">
                                        <option disabled selected>Select Status</option>
                                        <option value="0">Requested</option>
                                        <option value="1">In Progress</option>
                                        <option value="2">Ready</option>
                                        <option value="3">Pickup</option>
                                        <option value="4">Accepted By Customers</option>
                                        <option value="5">Reviewed</option>
                                        <option value="6">Cancel<ption>
                                        <option value="7">All Status Sample Request<ption>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2 p-2">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Start</div>
                                                </div>
                                                <input type="date" class="form-control" name="fdate">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">End</div>
                                                </div>
                                                <input type="date" class="form-control" name="ldate">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 mt-sm-2 mt-lg-0 mt-md-0">
                                            <button name="xls" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</button>
                                            <button name="pdf" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Pdf</button>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Sample Request</h4>
                </div>
                <div class="pb-20">

                    <!-- query -->
                    <?php
                    $no = 1;
                    $queryInventory = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId"); ?>
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort" style="width: 17px;">No</th>
                                <th>No Sample</th>
                                <th>Subject</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_object($queryInventory)) : ?>
                                <tr>
                                    <td class="table-plus"><?= $no++ ?></td>
                                    <td><?= $row->no_sample ?></td>
                                    <td><?= $row->subject ?></td>
                                    <td><?= $row->CustomerName ?></td>
                                    <td><?= $row->date_required ?></td>
                                    <td>
                                        <?php
                                        $status =  $row->status;
                                        switch ($status) {
                                            case 1:
                                                $status_messages = "Confirm";
                                                $color = "text-warning";
                                                break;
                                            case 2:
                                                $status_messages = "Ready";
                                                $color = "text-warning";
                                                break;
                                            case 3:
                                                $status_messages = "Pick Up";
                                                $color = "text-info";
                                                break;
                                            case 4:
                                                $status_messages = "Accepted by Customer";
                                                $color = "text-danger";
                                                break;
                                            case 5:
                                                $status_messages = "Reviewed";
                                                $color = "text-success";
                                                break;
                                            case 6:
                                                $status_messages = "Cancel";
                                                break;

                                            default:
                                                $status_messages = "Requested";
                                                $color = "text-primary";
                                                break;
                                        }
                                        ?>
                                        <p class="font-weight-bold <?= $color ?>"><?= $status_messages ?></p>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                                                <a class="dropdown-item" href="/pages/rnd/sample-request-detail.php?cc=<?= $row->no_sample ?>"><i class="dw dw dw-eye"></i>Detail</a>
                                                <a class="dropdown-item" href="/pages/rnd/sample-request-add-detail.php?cc=<?= $row->no_sample ?>"><i class="bi bi-folder-plus"></i>Sample Details</a>
                                                <a class="dropdown-item" href="/pages/rnd/sample-request-change-status.php?cc=<?= $row->no_sample ?>"><i class="bi bi-dash-circle"></i>Change Status</a>

                                                <!-- <form action="sample-request-delete.php" method="post" class="m-1 px-1 py-1">
                                                        <input type="hidden" name="id" value="<?= $row->id ?>">
                                                        <button class="dw dw-delete-3 btn-sm btn show_confirm" name="delete" type="delete" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                            Delete
                                                        </button>
                                                    </form> -->

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
    if (isset($_SESSION['change'])) {
        echo "<script>
                        swal('Change Status Success', 'Click OK to continue', 'success');
                        </script>";
        unset($_SESSION['change']);
    }

    ?>
</body>

</html>
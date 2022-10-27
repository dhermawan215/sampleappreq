<?php
include('config/config.php');
session_start();

//cek autentikasi login, jika kosong dilarang akses index
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
    <title>Sample Request App</title>

    <?php include('layouts/css.php') ?>
</head>

<body>
    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="public/img/new.png" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> -->

    <!-- header /navbar -->
    <?php include('layouts/header.php') ?>

    <!-- right sidebar -->
    <?php include('layouts/sidebar.php') ?>
    <!-- endofsidebar -->
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="public/vendors/images/banner-img.png" alt="" />
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Welcome To Application
                            <div class="weight-600 font-30 text-blue"><?= $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname'] ?></div>
                        </h4>
                        <h4 class="font-18">PT Zeus Kimiatama</h4>
                        <h5 class="font-18">Dept : <?= $_SESSION['user']['dept'] ?></h5>
                        <p class="font-18 max-width-600 mt-1">
                            We aim to be an Indonesian leading specialty chemicals manufacturer
                        </p>
                    </div>
                </div>
            </div>
            <?php
            //total data sample request
            $queryCountALl = mysqli_query($conn, "SELECT COUNT(no_sample) as totalAll FROM sample_request");
            $fetchTotal = mysqli_fetch_object($queryCountALl);
            $totalSample = $fetchTotal->totalAll;

            //total data sample request when status requested
            $queryCountRequested = mysqli_query($conn, "SELECT COUNT(no_sample) as totalRequested FROM sample_request WHERE status=0");
            $fetchRequest = mysqli_fetch_object($queryCountRequested);
            $percentRequest = number_format(($fetchRequest->totalRequested * 100) / $totalSample);

            $queryCountInProgress = mysqli_query($conn, "SELECT COUNT(no_sample) as inProgress FROM sample_request WHERE status=1");
            $fetchInProgress = mysqli_fetch_object($queryCountInProgress);
            $percentInProgress = number_format(($fetchInProgress->inProgress * 100) / $totalSample);

            $queryCountReady = mysqli_query($conn, "SELECT COUNT(no_sample) as ready FROM sample_request WHERE status=2");
            $fetchReady = mysqli_fetch_object($queryCountReady);
            $percentReady = number_format(($fetchReady->ready * 100) / $totalSample);

            $queryPickUp = mysqli_query($conn, "SELECT COUNT(no_sample) as pickUp FROM sample_request WHERE status=3");
            $fetchPickUp = mysqli_fetch_object($queryPickUp);
            $percentPickUp = number_format(($fetchPickUp->pickUp * 100) / $totalSample);

            $queryAccepted = mysqli_query($conn, "SELECT COUNT(no_sample) as acceptedBy FROM sample_request WHERE status=4");
            $fetchAccepted = mysqli_fetch_object($queryAccepted);
            $percentAccepted = number_format(($fetchAccepted->acceptedBy * 100) / $totalSample);

            $queryReviewed = mysqli_query($conn, "SELECT COUNT(no_sample) as reviewed FROM sample_request WHERE status=5");
            $fetchReviewed = mysqli_fetch_object($queryReviewed);
            $percentReviewed = number_format(($fetchReviewed->reviewed * 100) / $totalSample);


            ?>
            <div class="row">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchTotal->totalAll ?></div>
                                <div class="weight-600 font-14 ml-1">All Sample Request</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentRequest ?>%;" aria-valuenow="<?= $percentRequest ?>" aria-valuemin="0" aria-valuemax="100"><?= $percentRequest ?> %</div>
                            </div>
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchRequest->totalRequested ?></div>
                                <div class="weight-600 font-14 ml-1">Requested</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentInProgress ?>%;" aria-valuenow="<?= $percentInProgress ?>" aria-valuemin="0" aria-valuemax="100"><?= $percentInProgress ?> %</div>
                            </div>
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchInProgress->inProgress ?></div>
                                <div class="weight-600 font-14 ml-1">In Progress</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentReady ?>%;" aria-valuenow="<?= $percentReady ?>" aria-valuemin="0" aria-valuemax="100"><?= $percentReady ?> %</div>
                            </div>
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchReady->ready ?></div>
                                <div class="weight-600 font-14 ml-1">Ready</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentPickUp ?>%;" aria-valuenow="<?= $percentPickUp ?>" aria-valuemin="0" aria-valuemax="100"><?= $percentPickUp ?> %</div>
                            </div>
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchPickUp->pickUp ?></div>
                                <div class="weight-600 font-14 ml-1">Pick Up</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentAccepted ?>%;" aria-valuenow="<?= $percentAccepted ?>" aria-valuemin="0" aria-valuemax="100"><?= $percentAccepted ?> %</div>
                            </div>
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchAccepted->acceptedBy ?></div>
                                <div class="weight-600 font-14 ml-1">Accepted By Customers</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-block p-2 px-2 align-items-center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentReviewed?>%;" aria-valuenow="<?= $percentReviewed?>" aria-valuemin="0" aria-valuemax="100"><?= $percentReviewed?> %</div>
                            </div>
                            <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                <div class="h4 mb-0"><?= $fetchReviewed->reviewed ?></div>
                                <div class="weight-600 font-14 ml-1">Reviewed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-box mb-30">
                <h2 class="h4 pd-20">Best Selling Products</h2>
                <table class="data-table table nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Product</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Oty</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-plus">
                                <img src="vendors/images/product-1.jpg" width="70" height="70" alt="" />
                            </td>
                            <td>
                                <h5 class="font-16">Shirt</h5>
                                by John Doe
                            </td>
                            <td>Black</td>
                            <td>M</td>
                            <td>$1000</td>
                            <td>1</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <img src="vendors/images/product-2.jpg" width="70" height="70" alt="" />
                            </td>
                            <td>
                                <h5 class="font-16">Boots</h5>
                                by Lea R. Frith
                            </td>
                            <td>brown</td>
                            <td>9UK</td>
                            <td>$900</td>
                            <td>1</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <img src="vendors/images/product-3.jpg" width="70" height="70" alt="" />
                            </td>
                            <td>
                                <h5 class="font-16">Hat</h5>
                                by Erik L. Richards
                            </td>
                            <td>Orange</td>
                            <td>M</td>
                            <td>$100</td>
                            <td>4</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <img src="vendors/images/product-4.jpg" width="70" height="70" alt="" />
                            </td>
                            <td>
                                <h5 class="font-16">Long Dress</h5>
                                by Renee I. Hansen
                            </td>
                            <td>Gray</td>
                            <td>L</td>
                            <td>$1000</td>
                            <td>1</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-plus">
                                <img src="vendors/images/product-5.jpg" width="70" height="70" alt="" />
                            </td>
                            <td>
                                <h5 class="font-16">Blazer</h5>
                                by Vicki M. Coleman
                            </td>
                            <td>Blue</td>
                            <td>M</td>
                            <td>$1000</td>
                            <td>1</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php include('layouts/footer.php') ?>
        </div>
    </div>

    <!-- js -->
    <?php include('layouts/js.php') ?>


    <!-- custom script js -->
</body>

</html>
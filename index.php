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
    <?php


    ?>

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

            if ($totalSample != 0) {

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
            }



            ?>
            <?php if ($totalSample == 0) : ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="justify-content-center text-center mb-3">
                            <h6 class="h6 text-primary">Data Not Found!</h6>
                        </div>
                    </div>
                </div>
            <?php else : ?>
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
                            <div id="requested" name="requested" class="d-block p-2 px-2 align-items-center">
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
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percentReviewed ?>%;" aria-valuenow="<?= $percentReviewed ?>" aria-valuemin="0" aria-valuemax="100"><?= $percentReviewed ?> %</div>
                                </div>
                                <div class="widget-data mt-1 d-flex flex-wrap p-2 mt-2">
                                    <div class="h4 mb-0"><?= $fetchReviewed->reviewed ?></div>
                                    <div class="weight-600 font-14 ml-1">Reviewed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Top 10 Newest Sample Request</h4>
                </div>
                <div class="pb-20">

                    <!-- query -->
                    <?php
                    $no = 1;
                    $queryInventory = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE sample_request.status<6 ORDER BY date_required DESC LIMIT 10"); ?>
                    <table id="dataTable" class="table stripe hover nowrap table-responsive-sm table-responsive-md">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort" style="width: 17px;">No</th>
                                <th>No Sample</th>
                                <th>Subject</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
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
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php include('layouts/footer.php') ?>
        </div>
    </div>

    <!-- js -->
    <?php include('layouts/js.php') ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                responsive: false
            });
        });

        $(document).ready(function() {
            $('#requested').click(function() {
                var id = 0;
                $.ajax({
                    //data :{action: "showroom"},
                    url: "fetch.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        status: id,

                    },
                    success: function(data) {
                        $('#sample').css("display", "block");
                        $('#sample_no').text(data.sample_no);
                        $('#subject').text(data.subject);
                        $('#customer').text(data.customer);
                        $('#date').text(data.date);
                        $('#status').text(data.status);
                        console.log(data);
                    }
                });

            });
        });

        $(document).ready(function() {
            $('#datatable').DataTable({

            });
        });
    </script>


    <!-- custom script js -->
</body>

</html>
<?php
include('../../config/config.php');
session_start();
//get id form url
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if (isset($_GET["do"]) == null) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}

$do = $_GET['do'];
$query = mysqli_query($conn, "SELECT * FROM delivery INNER JOIN sample_request ON delivery.id_sample_req=sample_request.id INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE id_delivery=$do");
$rowDelivery = mysqli_fetch_object($query);


if ($query->num_rows == 0) {
    echo "<script>
    document.location.href='/pages/staff/sample-request.php';
    </script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Delivery Order</title>

    <?php include('../layouts/css.php') ?>
    <style>
        body {
            background-color: #fff;
        }

        hr.new1 {
            border-top: 2px solid #000;
        }
    </style>

    <script type="text/javascript">
        // window.print()
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="row ">
                    <div class="card-body flex d-flex">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <img src="../../public/img/zekindo-logo.png" height="70px" alt="">
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="row">
                                <h3 class="font-weight-bold">PT. ZEUS KIMIATAMA INDONESIA</h3>
                            </div>
                            <div class="row float-left text-justify mt-1">
                                <p>Jl. Sungkai Blok F25 No. 09 IA Delta Silicon V - Lippo Cikarang <br>
                                    Kec. Cikarang Pusat - Kab. Bekasi - Jawa Barat - Indonesia 17530 <br>
                                    Phone: +6221 - 8991 1014 Fax: +6221 - 8991 1015</p>
                                </p>
                            </div>
                        </div>

                    </div>


                </div>
                <hr class="new1">

                <div class="row  mt-4">
                    <div class="col-lg-12 text-center">
                        <h2 class="font-weight-bold mb-1">Delivery Order</h2>
                        <p>(chemical samples)</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12 col-md-12 col sm-12 d-flex flex">
                        <div class="col-lg-8 col-md-8 col-sm-8 float-left text-justify justify-content-between">
                            <div class="row">
                                <label for="" style="font-weight: bold ;">Shipping Information</label>
                                <div class="col-lg-12">
                                    <h5 class="h5">Delivered To:</h5>
                                    <p><?= $rowDelivery->CustomerName ?></p>
                                </div>
                                <div class="col-lg-12">
                                    <h5 class="h5">Shipping Address:</h5>
                                    <p><?= $rowDelivery->delivery_address ?></p>
                                </div>
                                <div class="col-lg-12">

                                    <?php
                                    $status_delivery = $rowDelivery->delivery_by;
                                    switch ($status_delivery) {
                                        case 1:
                                            $status_message_delivery = "EKSPEDISI";
                                            break;

                                        case 2:
                                            $status_message_delivery = "BY SALES";
                                            break;

                                        default:
                                            $status_message_delivery = "PICK UP";
                                            break;
                                    }
                                    ?>
                                    <h5 class="h5">Delivery Method:</h5>
                                    <p><?= $status_message_delivery ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 float-right text-justify justify-content-between">
                            <div class="row">

                                <div class="col-lg-12">
                                    <h5 class="h5">Delivery Order Date: <?= $rowDelivery->delivery_date ?></h5>
                                    <h5 class="h5">Delivery Order No:</h5>
                                    <p><?= $rowDelivery->resi ?></p>
                                </div>
                                <div class="col-lg-12">
                                    <h5 class="h5">Delivery Method Name:</h5>
                                    <p><?= $rowDelivery->delivery_name ?></p>
                                </div>
                                <div class="col-lg-12">
                                    <h5 class="h5">Receipt No:</h5>
                                    <p><?= $rowDelivery->resi_ekspedisi ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-3">
                <div class="row p-2 m-2">
                    <label for="" style="font-weight: bold ;">Shipping Details Information</label>
                    <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Items Name</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Qty Pack</th>
                                        <th>Unit Pack</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $querydetailsDel = mysqli_query($conn, "SELECT * FROM sample_request_details INNER JOIN Inventory ON sample_request_details.id_barang=inventory.InvId WHERE id_sample_req=$rowDelivery->id");
                                    while ($rowDetails = mysqli_fetch_object($querydetailsDel)) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $rowDetails->InvName ?></td>
                                            <td><?= $rowDetails->qty ?></td>
                                            <td><?= $rowDetails->unit ?></td>
                                            <td><?= $rowDetails->qty_pack ?></td>
                                            <td><?= $rowDetails->unit_pack ?></td>
                                        </tr>
                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-3">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <p class="font-weight-bold">
                                    Received By
                                    <br>
                                </p>
                            </div>
                            <span>(.................)</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <p class="font-weight-bold">
                                    Delivered By
                                    <br>
                                    <span> </span>
                                </p>
                            </div>
                            <span>(.................)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->

    </div>

</body>

</html>
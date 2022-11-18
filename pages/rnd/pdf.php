<?php
include('../../config/config.php');

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

$fdate = $_GET['fdate'];
$ldate = $_GET['ldate'];
$sts = $_GET['sts'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Sample Request</title>

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
        window.print()
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="row ">
                    <div class="card-body flex d-flex">
                        <div class="col-lg-4">
                            <img src="../../public/img/zekindo-logo.png" height="70px" alt="">
                        </div>
                        <div class="col-lg-8">
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
            </div>
        </div>

        <!-- content -->
        <div class="row text-center">
            <div class="col-lg-12">
                <h3 class="h3">Data Sample Request</h3>
            </div>

            <?php

            if ($sts == 7) {

                $querydb = mysqli_query($conn, "SELECT id,
            no_sample,
            date_required,
            delivery_date,
            requestor, 
            delivery_address, 
            delivery_by,
            sample_request.status, 
            customer.CustomerName, 
            sample_request_details.qty,
            sample_request_details.unit,
            inventory.InvName 
            FROM sample_request JOIN customer ON sample_request.id_customer=customer.CustomerId 
            JOIN sample_request_details on sample_request.id=sample_request_details.id_sample_req 
            JOIN inventory ON sample_request_details.id_barang=inventory.InvId 
            WHERE sample_request.date_required BETWEEN '$fdate' AND '$ldate'");
            } else {

                $querydb = mysqli_query($conn, "SELECT id,
                no_sample,
                date_required,
                delivery_date,
                requestor, 
                delivery_address, 
                delivery_by,
                sample_request.status, 
                customer.CustomerName, 
                sample_request_details.qty,
                sample_request_details.unit,
                inventory.InvName 
                FROM sample_request JOIN customer ON sample_request.id_customer=customer.CustomerId 
                JOIN sample_request_details on sample_request.id=sample_request_details.id_sample_req 
                JOIN inventory ON sample_request_details.id_barang=inventory.InvId 
                WHERE sample_request.date_required BETWEEN '$fdate' AND '$ldate' AND sample_request.status=$sts");
            }


            ?>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-bordered ">
                            <!--Table head-->
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>No Sample</th>
                                    <th>Date Required</th>
                                    <th>Delivery Date</th>
                                    <th>Requestor</th>
                                    <th>Address</th>
                                    <th>Delivery By</th>
                                    <th>Status</th>
                                    <th>Customer</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Items</th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_object($querydb)) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->no_sample ?></td>
                                        <td><?= $row->date_required ?></td>
                                        <td><?= $row->delivery_date ?></td>
                                        <td><?= $row->requestor ?></td>
                                        <?php if ($row->delivery_address == null && $row->delivery_by == 0) : ?>
                                            <td>PICKUP</td>
                                        <?php else : ?>
                                            <td><?= $row->delivery_address ?></td>
                                        <?php endif ?>
                                        <?php
                                        $status_delivery = $row->delivery_by;
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

                                        <td><?= $status_message_delivery ?></td>

                                        <?php
                                        $status =  $row->status;
                                        switch ($status) {
                                            case 1:
                                                $status_messages = "In Progress";
                                                break;
                                            case 2:
                                                $status_messages = "Ready";
                                                break;
                                            case 3:
                                                $status_messages = "Pick Up";
                                                break;
                                            case 4:
                                                $status_messages = "Accepted by Customer";
                                                break;
                                            case 5:
                                                $status_messages = "Reviewed";
                                                break;
                                            case 6:
                                                $status_messages = "Cancel";
                                                break;

                                            default:
                                                $status_messages = "Requested";
                                                break;
                                        }
                                        ?>

                                        <td><?= $status_messages ?></td>
                                        <td><?= $row->CustomerName ?></td>
                                        <td><?= $row->qty ?></td>
                                        <td><?= $row->unit ?></td>
                                        <td><?= $row->InvName ?></td>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
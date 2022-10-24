<?php
include('../../config/config.php');
$fdate = $_GET['fdate'];
$ldate = $_GET['ldate'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Report-All-Sample-Request (" . date('dmY') . ").xls");

?>
<!DOCTYPE html>
<html>

<head>
    <?php include('../layouts/css.php') ?>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h1 style="text-align: center;">Data Sample Request</h1>
    <?php
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
    ?>
    <table id="customers">
        <thead>
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

    </table>

</body>

</html>
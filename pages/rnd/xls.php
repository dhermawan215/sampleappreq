<?php
include('../../config/config.php');
session_start();

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
    if ($sts == 7) {

        $querydb = mysqli_query($conn, "SELECT * FROM sample_request JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id JOIN customer ON sample_request.id_customer=customer.CustomerId 
        JOIN sample_request_details on sample_request.id=sample_request_details.id_sample_req 
        JOIN products ON sample_request_details.id_barang=products.id_product 
        WHERE sample_request.date_required BETWEEN '$fdate' AND '$ldate'");
    } else {

        $querydb = mysqli_query($conn, "SELECT * FROM sample_request JOIN tblemployees ON sample_request.requestor=tblemployees.emp_id JOIN customer ON sample_request.id_customer=customer.CustomerId 
        JOIN sample_request_details on sample_request.id=sample_request_details.id_sample_req 
        JOIN products ON sample_request_details.id_barang=product.id_product 
        WHERE sample_request.date_required BETWEEN '$fdate' AND '$ldate' AND sample_request.status=$sts");
    }


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
                <th>Delivery</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Sales Note</th>
                <th>CS Note</th>
                <th>RND Note</th>
                <th>Customer Note</th>
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
                    <td><?= $row->FirstName . ' ' . $row->LastName ?></td>
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
                            $status_messages = "Confirm";
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
                    <td><?= $row->kode_produk . ' ' . $row->fungsi ?></td>
                    <td><?= $row->qty ?></td>
                    <td><?= $row->sales_note ?></td>
                    <td><?= $row->cs_note ?></td>
                    <td><?= $row->rnd_notes ?></td>
                    <td><?= $row->customer_note ?></td>

                </tr>
            <?php endwhile; ?>
        </tbody>

    </table>

</body>

</html>
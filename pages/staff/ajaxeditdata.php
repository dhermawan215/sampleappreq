<?php

require '../../config/config.php';

if (isset($_POST['aid'])) {
    $id = $_POST['aid'];
    $sql = mysqli_query($conn, "SELECT * FROM customers_detail WHERE customers_id=$id");
    while ($customers = mysqli_fetch_assoc($sql)) {
        $data[] = $customers;
    }

    echo json_encode($data);
}

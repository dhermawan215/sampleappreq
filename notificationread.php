<?php

require 'config/config.php';

if (isset($_POST['aids'])) {
    $id_user = $_POST['aids'];
    $id_notif = $_POST['notif'];

    $queryIsRead = mysqli_query($conn, "INSERT INTO notification_read(is_read, notification_id, employee_id)
    VALUES(1, $id_notif, $id_user )");

    if ($queryIsRead) {
        $data['http'] = http_response_code(200);
        $data['message'] = "success";
    } else {
        $data['http'] = http_response_code(500);
        $data['message'] = "something went wrong";
    }
    echo json_encode($data);
}

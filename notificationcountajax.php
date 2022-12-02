<?php

require 'config/config.php';

if (isset($_POST['aid'])) {
    $id = $_POST['aid'];
    $dept = $_POST['dept'];

    if ($dept == 'MK') {
        $sql = mysqli_query($conn, "SELECT COUNT(*) FROM notification JOIN notification_category on notification.category_id=notification_category.id
            LEFT JOIN notification_read ON notification_read.notification_id=notification.id
            WHERE (notification.id_employee=$id) 
            AND (notification_read.employee_id IS NULL)
            ORDER BY notification.created_at DESC;");
    } else {

        $sql = mysqli_query($conn, "SELECT COUNT(*) FROM notification JOIN notification_category on notification.category_id=notification_category.id
            LEFT JOIN notification_read ON notification_read.notification_id=notification.id
            WHERE (notification.id_employee IS NULL ) 
            AND (notification_read.employee_id IS NULL)
            ORDER BY notification.created_at DESC;");
    }
    while ($notifno = mysqli_fetch_assoc($sql)) {
        $data[] = $notifno;
    }

    echo json_encode($data);
}

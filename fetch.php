<?php
include('config/config.php');

if (isset($_POST['status'])) {
    $id = $_POST['status'];
    $no = 1;
    $queryInventory = mysqli_query($conn, "SELECT * FROM sample_request INNER JOIN customer ON sample_request.id_customer=customer.CustomerId WHERE sample_request.status=$id");
    var_dump($queryInventory);
    while ($row = mysqli_fetch_array($queryInventory)) {
        $data["sample_no"] = $row["no_sample"];
        $data["subject"] = $row["subject"];
        $data["customer"] = $row["CustomerName"];
        $data["date"] = $row["date_required"];

        $status =  $row["status"];
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
        $data["status"] = $status_messages;
    }
    header("Content-Type: application/json", true);
    echo json_encode($data);
    echo "<script>conslo.log($data)</script>";
}

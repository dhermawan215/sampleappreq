<?php

require_once '../../vendor/autoload.php';
include('../../config/config.php');
include('../layouts/js.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



if (isset($_POST['upload_files']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $file_names = $_FILES['file']['name'];
    $ext = pathinfo($file_names, PATHINFO_EXTENSION);


    $allow_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($ext, $allow_ext)) {
        $inputFileNamePath = $_FILES['file']['tmp_name'];

        /** Load $inputFileName to a Spreadsheet object **/
        $spreadsheet = IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";

        foreach ($data as $key => $value) {

            if ($count > 0) {

                $code = $value['0'];
                $fungsi = $value['1'];
                $aplikasi = $value['2'];

                $sql = mysqli_query($conn, "INSERT INTO products(kode_produk, fungsi, aplikasi) VALUES('$code', '$fungsi', '$aplikasi')");
                if ($sql) {
                    echo "<script>
                    swal('Data Saved!', 'Click OK to continue', 'success')
                    .then((value) => {
                    document.location.href='/pages/admin/produk.php';
                    });
                    </script>";
                } else {
                    echo "<script>
                    swal('something went wrong, try another!')
                    .then((value) => {
                    document.location.href='/pages/admin/produk.php';
                    });
                    </script>";
                }
            } else {
                $count = "1";
            }
        }
    } else {
        echo "<script>
        swal('your file not allow, try another!')
        .then((value) => {
        document.location.href='/pages/admin/produk.php';
        });
        </script>";
    }
}

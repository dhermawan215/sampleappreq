<?php
include('../../config/config.php');
session_start();

//cek autentikasi login, jika kosong dilarang akses index
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}

if (isset($_GET["cc"]) == null) {
    echo "<script>
    document.location.href='/pages/admin/employee.php';
    </script>";
}

$code = $_GET["cc"];
$queryDetails = mysqli_query($conn, "SELECT * FROM tblemployees WHERE emp_id='$code'");
$row = mysqli_fetch_object($queryDetails);

//jika data di url tidak ada di db
if ($queryDetails->num_rows == 0) {

    echo "<script>
    document.location.href='/pages/admin/employee.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Change User Password</title>
    <?php include('../layouts/css.php') ?>
    <?php include('../layouts/js.php') ?>

</head>

<!-- cek password yang diinputkan -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['passwords'];
    $repassword = $_POST['repasswords'];
    $email = $row->EmailId;
    //cek iputan passowrd

    if ($password != $repassword) {
        echo "<script>
        swal('Password do not match, check your password!');
    </script>";
    } else {
        //craete password baru dan dihash
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        $queryUpdate = mysqli_query($conn, "UPDATE tblemployees SET passwords='$pwd' WHERE EmailId='$email'");
        if ($queryUpdate) {
            echo "<script>
            swal('password has been changed!', 'click OK to continue')
            .then((value) => {
                document.location.href='/pages/admin/employee.php';
            });
            </script>";
        } else {
            echo "<script>
                    swal('Something wrong, please try again!');
                </script>";
        }
    }
}


?>


<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="/samplereq-app/index.php">
                    <img src="../../public/img/new.png" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="/index.php">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6 col-lg-12">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Verification New Password</h2>
                        </div>
                        <form action="" method="POST">
                            <label for="" class="text-md font-weight-bold">Input New Password</label>
                            <div class="input-group custom">

                                <input type="password" name="passwords" required class="form-control form-control-lg" placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <label for="" class="text-md font-weight-bold">Confirm Password</label>
                            <div class="input-group custom">

                                <input type="password" name="repasswords" required class="form-control form-control-lg" placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" ">Update & Verify</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>
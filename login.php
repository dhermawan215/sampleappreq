<?php
include('config/config.php');

session_start();
//cek session login, jika ada maka tidak boleh akses halaman login
if (isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='index.php';
            </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App-Login</title>
    <?php include('layouts/css.php') ?>
</head>

<body class="login-page">

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/sampleappreq/public/img/3619024.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Sample Request App</h2>
                        </div>
                        <form action="" method="POST">

                            <div class="input-group custom">
                                <input type="email" name="EmailId" class="form-control form-control-lg" placeholder="input your email" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" name="passwords" class="form-control form-control-lg" placeholder="input your password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="forgot-password.html">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
                                        <button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Sign In</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('layouts/js.php') ?>

    <?php

    //cek requeest login
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['EmailId'];
        $pwd = $_POST['passwords'];

        //validasi email
        $resultEmail = mysqli_query($conn, "SELECT * FROM tblemployees WHERE EmailId='$email'");
        //cek jika email belum terdaftar
        if ($resultEmail->num_rows != 1) {
            echo "<script>
                    swal('can not find your account, try another!')
                    .then((value) => {
                    document.location.href='/login.php';
                    });
                </script>";
        } else {
            $row = mysqli_fetch_object($resultEmail);
            if (password_verify($pwd, $row->passwords)) {

                $_SESSION['user'] = [
                    'auth' => 'loged',
                    'email' => $row->EmailId,
                    'role' => $row->roles,
                    'fname' => $row->FirstName,
                    'lname' => $row->LastName,
                    'dept' => $row->Department
                ];

                echo "<script>
            document.location.href='index.php';
            </script>";
            } else {
                echo "<script>
                swal('password wrong, try another!')
                .then((value) => {
                document.location.href='/login.php';
                });
                </script>";
            }
        }
    }
    ?>
</body>

</html>
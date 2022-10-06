<?php
include('config/config.php');

if (isset($_POST['register'])) {


    $email = $_POST['EmailId'];
    $password = $_POST['Password'];
    $repassword = $_POST['repassword'];
    $role = $_POST['role'];
    //cek request email kosong atau tidak
    if (empty($email)) {
        echo "<script>alert('Email is require');
        document.location.href='register.php';
        </script>";
    }

    //cek email apakah valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email does not valid');
        document.location.href='register.php';
        </script>";
    } else {
        //validasi email terdaftar
        $queryEmail = mysqli_query($conn, "SELECT EmailId FROM tblemployees WHERE EmailId='$email'");
        //cek apakah email sudah terdaftar
        if ($queryEmail->num_rows > 0) {
            echo "<script>alert('Email already exist, try another!');
            document.location.href='register.php';
            </script>";
        }
        //cek kesamaan password
        if ($password != $repassword) {
            echo "<script>alert('Passowrd not match!');
                document.location.href='register.php';
                </script>";
        } else {
            //password hash(enksripsi searah)
            $pwd = password_hash($password, PASSWORD_DEFAULT);

            //registrasi user
            $queryRegister = mysqli_query($conn, "INSERT INTO tblemployees(EmailId, passwords, roles)
                VALUES('$email','$pwd','$role')");

            if ($queryRegister) {
                session_start();
                $_SESSION['user'] = [
                    'auth' => 'loged',
                    'email' => $email,
                    'role' => $role
                ];
                echo "<script>
                    document.location.href='index.php';
                    </script>";
            }
        }
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App-Register</title>
    <?php include('layouts/css.php') ?>
</head>

<body class="login-page">

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/public/img/3619024.png" alt="" />
                </div>
                <!-- <div class="col-md-6 col-lg-7">
                    <img src="/public/vendors/images/login-page-img.png" alt="" />
                </div> -->
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Sample Request App</h2>
                        </div>
                        <form action="" method="post">
                            <div class="input-group custom">
                                <input type="email" name="EmailId" class="form-control form-control-lg" placeholder="email" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" name="Password" class="form-control form-control-lg" placeholder="input password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" name="repassword" class="form-control form-control-lg" placeholder="confirm password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <input type="hidden" name="role" value="admin">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
                                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="register">Sign Up</button>
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
</body>

</html>
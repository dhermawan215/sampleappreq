<?php
include('../../config/config.php');
session_start();

//cek autentikasi login, jika kosong dilarang akses index
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
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
    $pwd = $_POST['passwords'];
    $email = $_SESSION['user']['email'];
    //cek data user dan password yang diinput

    $resultEmail = mysqli_query($conn, "SELECT * FROM tblemployees WHERE EmailId='$email'");
    $row = mysqli_fetch_object($resultEmail);
    if (password_verify($pwd, $row->passwords)) {
        echo "<script>
            document.location.href='/pages/users/delete-account.php';
            </script>";
    } else {
        echo "<script>
        swal('Something wrong, check your password!');
    </script>";
    }
}


?>


<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="../../public/vendors/images/deskapp-logo.svg" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="/user-setting.php">User Dashboard</a></li>
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
                            <h2 class="text-center text-primary">Verification Your Password</h2>
                        </div>
                        <form action="" method="POST">

                            <div class="text-center mb-2">
                                <label for="" class="text-md font-weight-bold">Are You Sure Delete This Account?</label>
                                <h5 class="text-md font-weight-semibold">Your Accout : <span class="text-md font-weight-bold text-danger"><?= $_SESSION['user']['email'] ?></span></h5>
                            </div>
                            <label for="" class="text-md font-weight-bold mt-1">Input Your Password</label>
                            <div class="input-group custom">

                                <input type="password" name="passwords" required class="form-control form-control-lg" placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" ">Verify</button>
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
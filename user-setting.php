<?php
include('config/config.php');
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
    <title>Sample Request App-User Settings</title>

    <?php include('layouts/css.php') ?>
</head>

<body>
    <?php include('layouts/loading.php') ?>

    <!-- header /navbar -->
    <?php include('layouts/header.php') ?>

    <!-- right sidebar -->
    <?php include('layouts/sidebar.php') ?>
    <!-- endofsidebar -->
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="public/vendors/images/banner-img.png" alt="" />
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            User Configuration Menu
                            <div class="weight-600 font-30 text-blue"><?= $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname'] ?></div>
                        </h4>
                        <h4 class="font-18">PT Zeus Kimiatama</h4>
                        <h5 class="font-18">Dept : <?= $_SESSION['user']['dept'] ?></h5>
                        <p class="font-18 max-width-600 mt-1">
                            Setting Your Account Bellow
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <div class="card-box height-100-p">
                        <div class="card-body text-center">
                            <h5 class="card-title">Change Password</h5>
                            <a href="/pages/users/change-password-verification.php" class="btn btn-primary"><i class="bi bi-gear"></i> Open Control Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card-box height-100-p">
                        <div class="card-body text-center">
                            <h5 class="card-title">Change Email</h5>
                            <a href="#" class="btn btn-primary"><i class="bi bi-gear"></i> Open Control Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card-box height-100-p">
                        <div class="card-body text-center">
                            <h5 class="card-title">Change Phone</h5>
                            <a href="#" class="btn btn-primary"><i class="bi bi-gear"></i> Open Control Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card-box height-100-p">
                        <div class="card-body text-center">
                            <h5 class="card-title">Delete Account</h5>
                            <a href="/pages/users/delete-account-verification.php" class="btn btn-primary"><i class="bi bi-gear"></i> Open Control Panel</a>
                        </div>
                    </div>
                </div>
            </div>


            <?php include('layouts/footer.php') ?>
        </div>
    </div>

    <!-- js -->
    <?php include('layouts/js.php') ?>


    <!-- custom script js -->
</body>

</html>
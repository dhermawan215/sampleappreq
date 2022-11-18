<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
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
    <title>Sample Request App - Employees-Edit</title>

    <?php include('../layouts/css.php') ?>
</head>

<body>
    <?php include('../layouts/loading.php') ?>

    <!-- header /navbar -->
    <?php include('../layouts/header.php') ?>

    <!-- right sidebar -->
    <?php include('../layouts/sidebar.php') ?>
    <!-- endofsidebar -->
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="title">
                                <h4>Employees</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/admin/employee.php">Employees</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Edit Data
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Edit Data</h4>
                        <h5><a href="/pages/admin/employee.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="POST">
                            <div class="row col-12">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">NIP</label>
                                        <input type="text" name="NIP" id="" class="form-control" placeholder="input NIP" value="<?= $row->NIP ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">First Name</label>
                                        <input type="text" name="FirstName" id="" class="form-control" placeholder="input first name" value="<?= $row->FirstName ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Last Name</label>
                                        <input type="text" name="LastName" id="" class="form-control" placeholder="input last name" value="<?= $row->LastName ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Nick Name</label>
                                        <input type="text" name="NickName" id="" class="form-control" placeholder="input nick name" value="<?= $row->NickName ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Gender</label>
                                        <select name="Gender" id="" class="form-control">
                                            <option selected value="<?= $row->Gender ?>"><?= $row->Gender ?></option>
                                            <option value="">-select gender-</option>
                                            <option value="female">female</option>
                                            <option value="male">male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Date of Birth</label>
                                        <input type="text" name="Dob" id="" class="form-control" placeholder="input date of birth" value="<?= $row->Dob ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <?php
                                        //query select departemen
                                        $queryDept = mysqli_query($conn, "SELECT * FROM departemen");
                                        ?>
                                        <label for="">Department</label>
                                        <select name="Department" id="" class="form-control">
                                            <option value="<?= $row->Department ?>"><?= $row->Department ?></option>
                                            <option value="">select</option>
                                            <?php while ($row2 = mysqli_fetch_object($queryDept)) : ?>
                                                <option value="<?= $row2->DeptID ?>"><?= $row2->Department ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Address</label>
                                        <input type="text" name="email" id="" class="form-control" placeholder="input address" value="<?= $row->Address ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Email</label>
                                        <input type="email" name="Address" id="" class="form-control" placeholder="input address" value="<?= $row->EmailId ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Phone</label>
                                        <input type="text" name="Phonenumber" id="" class="form-control" placeholder="input phone" value="<?= $row->Phonenumber ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Roles</label>
                                        <input type="text" name="roles" id="" class="form-control" placeholder="input roles" value="<?= $row->roles ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 d-flex m-2 p-2">
                                    <div class="card-body d-flex">
                                        <button type="submit" class="btn btn-primary ml-2" name="update">Update</button>
                                        <button type="reset" class="btn btn-danger ml-2" name="save">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include('../layouts/footer.php'); ?>
        </div>

        <!-- js -->
        <?php include('../layouts/js.php'); ?>

        <!-- query update -->

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['update'])) {
            $emp_id = $code;
            $email = $_POST['email'];
            $NIP = htmlspecialchars($_POST['NIP']);
            $FirstName = htmlspecialchars($_POST['FirstName']);
            $LastName = htmlspecialchars($_POST['LastName']);
            $NickName = htmlspecialchars($_POST['NickName']);

            $Gender = htmlspecialchars($_POST['Gender']);
            $Dob = htmlspecialchars($_POST['Dob']);
            $Department = htmlspecialchars($_POST['Department']);
            $Address = htmlspecialchars($_POST['Address']);
            $Phonenumber = htmlspecialchars($_POST['Phonenumber']);
            $roles = htmlspecialchars($_POST['roles']);

            $queryUpdateData = mysqli_query($conn, "UPDATE tblemployees SET
            NIP='$NIP', FirstName='$FirstName', LastName='$LastName',
            NickName='$NickName', EmailId='$email', Gender='$Gender', Dob='$Dob', Department='$Department',
            Address='$Address', Phonenumber='$Phonenumber', roles='$roles'
            WHERE emp_id='$emp_id'");

            if ($queryUpdateData) {
                echo "<script>
                        swal('Data was updated!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/admin/employee.php';
                        });
                        </script>";
            } else {
                echo "<script>swal('Something went wrong', 'Try again', 'success')
                    .then((value) => {
                    document.location.href='/pages/admin/employee-edit.php?cc=$code';
                    });
                </script>";
            }
        }

        ?>


</body>

</html>
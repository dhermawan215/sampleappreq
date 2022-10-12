<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
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
    <title>Sample Request App - Employees-Add</title>

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
                                        Add Data
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Add Data</h4>
                        <h5><a href="/pages/admin/employee.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="POST">
                            <div class="row col-12">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">NIP</label>
                                        <input type="text" name="NIP" id="" class="form-control" placeholder="input NIP">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">First Name</label>
                                        <input type="text" name="FirstName" id="" class="form-control" placeholder="input first name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Last Name</label>
                                        <input type="text" name="LastName" id="" class="form-control" placeholder="input last name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Nick Name</label>
                                        <input type="text" name="NickName" id="" class="form-control" placeholder="input nick name">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Email</label>
                                        <input type="email" name="EmailId" id="" class="form-control" placeholder="input email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Password</label>
                                        <input type="password" name="passwords" id="" class="form-control" placeholder="input password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Gender</label>
                                        <select name="Gender" id="" class="form-control">
                                            <option value="">-select gender-</option>
                                            <option value="female">female</option>
                                            <option value="male">male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Date of Birth</label>
                                        <input type="text" name="Dob" id="" class="date-picker form-control" placeholder="input date of birth">
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
                                            <option value="">select</option>
                                            <?php while ($row = mysqli_fetch_object($queryDept)) : ?>
                                                <option value="<?= $row->Department ?>"><?= $row->Department ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Address</label>
                                        <input type="text" name="Address" id="" class="form-control" placeholder="input address">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Phone</label>
                                        <input type="text" name="Phonenumber" id="" class="form-control" placeholder="input phone">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Roles</label>
                                        <input type="text" name="roles" id="" class="form-control" placeholder="input roles">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 d-flex m-2 p-2">
                                    <div class="card-body d-flex">
                                        <button type="submit" class="btn btn-primary ml-2" name="save">Save</button>
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

        <!-- query save -->

        <?php
        if (isset($_POST['save'])) {
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

            $email = $_POST['EmailId'];
            $password = $_POST['passwords'];

            //cek request email kosong atau tidak
            if (empty($email)) {
                echo "<script>alert('Email is require');
                .then((value) => {
                    document.location.href='/pages/admin/employee-add.php';
                });
                </script>";
            }

            //cek email apakah valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                echo "<script>
                 swal('Email does not valid').then((value) => {
                    document.location.href='/pages/admin/employee-add.php';
                });
                </script>";
            } else {
                //validasi email terdaftar
                $queryEmail = mysqli_query($conn, "SELECT EmailId FROM tblemployees WHERE EmailId='$email'");
                //cek apakah email sudah terdaftar
                if ($queryEmail->num_rows > 0) {
                    echo "<script>alert('Email already exist, try another!');
                    document.location.href='/pages/admin/employee-add.php';
                    </script>";
                } else {
                    $pwd = password_hash($password, PASSWORD_DEFAULT);
                    //registrasi user
                    $queryRegister = mysqli_query($conn, "INSERT INTO tblemployees(
                        NIP, FirstName, LastName, NickName, EmailId, passwords, Gender, Dob, Department, Address, Phonenumber, roles) 
                        VALUES('$NIP', '$FirstName', '$LastName', '$NickName', '$email', '$pwd', '$Gender', '$Dob', '$Department', '$Address', '$Phonenumber', '$roles')");

                    if ($queryRegister) {
                        echo "<script>
                        swal('Data Saved!', 'Click OK to continue', 'success')
                        .then((value) => {
                        document.location.href='/pages/admin/employee.php';
                        });
                        </script>";
                    } else {
                        echo "<script>alert('Email already exist, try another!');
                    document.location.href='/pages/admin/employee-add.php';
                    </script>";
                    }
                }
            }
        }
        ?>


</body>

</html>
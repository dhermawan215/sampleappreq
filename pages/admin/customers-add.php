<?php include('../../config/config.php');
session_start();
//cek autentikasi login, jika kosong dilarang akses 
if (!isset($_SESSION['user'])) {
    echo "<script>
            document.location.href='/login.php';
            </script>";
}


//query lats customers code
$queryLastCo = mysqli_query($conn, "SELECT CustomerCode FROM customer ORDER BY CustomerId DESC LIMIT 1");
$fetchDataLatsCo = mysqli_fetch_object($queryLastCo);

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Sample Request App - Customers-Add</title>

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
                                <h4>Customers</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="text-decoration-none" href="/pages/admin/customers.php">Customers</a>
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
                        <h5><a href="/pages/admin/customers.php" class="text-danger m-2"><i class="bi bi-arrow-left-circle"></i> Back</a></h5>
                    </div>
                    <div class="pd-20">
                        <form action="" method="post">
                            <div class="row col-12">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Code</label>
                                        <input type="text" name="CustomerCode" id="" class="form-control" placeholder="last customers code: <?= $fetchDataLatsCo->CustomerCode ?> ">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Name</label>
                                        <input type="text" name="CustomerName" id="" class="form-control" placeholder="input customers name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers City</label>
                                        <input type="text" name="CustomerCity" id="" class="form-control" placeholder="input customers city">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Country</label>
                                        <input type="text" name="CustomerCountry" id="" class="form-control" placeholder="input customers Country">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Address</label>
                                        <input type="text" name="CustomerAddress" id="" class="form-control" placeholder="input customers address">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers ZipCode</label>
                                        <input type="text" name="Zipcode" id="" class="form-control" placeholder="input customers zipcode">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Contact Person 1</label>
                                        <input type="text" name="ContactPerson1" id="" class="form-control" placeholder="input customers contact person">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Contact Person 2</label>
                                        <input type="text" name="ContactPerson2" id="" class="form-control" placeholder="input customers contact person">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Phone 1</label>
                                        <input type="text" name="Phone1" id="" class="form-control" placeholder="input customers phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 mt-2">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Phone 2</label>
                                        <input type="text" name="Phone2" id="" class="form-control" placeholder="input customers phone">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Fax</label>
                                        <input type="text" name="Fax" id="" class="form-control" placeholder="input customers fax">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Email</label>
                                        <input type="email" name="Email" id="" class="form-control" placeholder="input customers email">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">AcAR</label>
                                        <input type="text" name="AcAR" id="" class="form-control" placeholder="input AcAR">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Customers Tax Address</label>
                                        <input type="text" name="TaxAddress" id="" class="form-control" placeholder="input customers tax address">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 col-12">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">NPWP</label>
                                        <input type="text" name="NPWP" id="" class="form-control" placeholder="input customers npwp">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body rounded-1">
                                        <label for="">Profit Center No</label>
                                        <input type="text" name="ProfitCenterNo" id="" class="form-control" placeholder="input profit center no">
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
            $CustomerCode = htmlspecialchars($_POST['CustomerCode']);
            $CustomerName = htmlspecialchars($_POST['CustomerName']);
            $CustomerCity = htmlspecialchars($_POST['CustomerCity']);
            $CustomerCountry = htmlspecialchars($_POST['CustomerCountry']);
            $CustomerAddress = htmlspecialchars($_POST['CustomerAddress']);
            $Zipcode = htmlspecialchars($_POST['Zipcode']);
            $cp1 = htmlspecialchars($_POST['ContactPerson1']);
            $cp2 = htmlspecialchars($_POST['ContactPerson2']);
            $phone1 = htmlspecialchars($_POST['Phone1']);
            $phone2 = htmlspecialchars($_POST['Phone2']);
            $fax = htmlspecialchars($_POST['Fax']);
            $email = htmlspecialchars($_POST['Email']);
            $AcAR = htmlspecialchars($_POST['AcAR']);
            $taxAddress = htmlspecialchars($_POST['TaxAddress']);
            $npwp = htmlspecialchars($_POST['NPWP']);
            $pfNO = htmlspecialchars($_POST['ProfitCenterNo']);

            $querySave = mysqli_query(
                $conn,
                "INSERT INTO customer(CustomerCode, CustomerName,CustomerAddress ,CustomerCity, CustomerCountry, Zipcode, ContactPerson1, ContactPerson2, Phone1, Phone2, Fax, Email, AcAR, NPWP, TaxAddress, ProfitCenterNo)
                VALUES('$CustomerCode', '$CustomerName', '$CustomerAddress', '$CustomerCity', '$CustomerCountry', '$Zipcode', '$cp1', '$cp2', '$phone1', '$phone2', '$fax', '$email', '$AcAR', '$npwp', '$taxAddress', '$pfNO')"
            );

            if ($querySave) {
                echo "<script>
                swal('Data Saved!', 'Click OK to continue', 'success')
                .then((value) => {
                document.location.href='/pages/admin/customers.php';
                });
                </script>";
            }
        }


        ?>


</body>

</html>
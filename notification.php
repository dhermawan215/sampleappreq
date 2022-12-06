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
    <title>Sample Request App</title>

    <?php include('layouts/css.php') ?>
</head>

<body>
    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="public/img/new.png" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> -->
    <?php


    ?>

    <!-- header /navbar -->
    <?php include('layouts/header.php') ?>

    <!-- right sidebar -->
    <?php include('layouts/sidebar.php') ?>
    <!-- endofsidebar -->
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Your Notification</h4>
                </div>
                <div class="pd-20">
                    <div class="row">
                        <div class="timeline mb-30 p-2 notification-list mx-h-400 customscroll">
                            <ul id="notifall">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('layouts/footer.php') ?>
        </div>
    </div>

    <!-- js -->
    <?php include('layouts/js.php') ?>
    <script type="text/javascript">
        $(document).ready(function() {
            notifListAll();
        });



        function notifListAll() {
            const id = <?= $_SESSION['user']['id'] ?>;
            const depts = '<?= $_SESSION['user']['dept'] ?>';
            const aid = id;
            $.ajax({
                url: 'notificationajax.php',
                method: 'post',
                data: {
                    aid: aid,
                    dept: depts
                },
                // data: 'aid=' + aid,
            }).done(function(notif) {
                notif2 = JSON.parse(notif);
                notif2.forEach(key => {
                    $('#notifall').append('<li><div class="timeline-date"> ' + key['created_at'] + ' </div><div class="timeline-desc card-box" > <div class = "pd-20" ><span class="text-success font-weight-bold">' + key['category'] + '</span><h4 class="mb-10 h4">' + key['title'] + '</h4><p>' + key['description'] + '</p></div></div></li>');

                });
            });
        }
    </script>


    <!-- custom script js -->
</body>

</html>
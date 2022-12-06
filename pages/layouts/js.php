<!-- <script src="../../public/vendors/scripts/core.js"></script>
<script src="../../public/vendors/scripts/script.min.js"></script>
<script src="../../public/vendors/scripts/process.js"></script>
<script src="../../public/vendors/scripts/layout-settings.js"></script>
<script src="../../public/src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="../../public/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../../public/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../../public/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../../public/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="../../public/vendors/scripts/dashboard.js"></script>
<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->

<!-- buttons for Export datatable -->
<!-- <script src="../../public/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../../public/src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../../public/src/plugins/datatables/js/vfs_fonts.js"></script> -->
<!-- Datatable Setting js -->
<!-- <script src="../../public/vendors/scripts/datatable-setting.js"></script> -->

<!-- toaster js -->
<script src="../../public/js/jquery-3-6-0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- endoftosterjs -->
<script src="../../public/vendors/scripts/core.js"></script>
<script src="../../public/vendors/scripts/script.min.js"></script>
<script src="../../public/vendors/scripts/process.js"></script>
<script src="../../public/vendors/scripts/layout-settings.js"></script>
<!-- <script src="../../public/src/plugins/apexcharts/apexcharts.min.js"></script> -->
<script src="../../public/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../../public/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../../public/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../../public/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

<!-- buttons for Export datatable -->
<script src="../../public/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../../public/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../../public/src/plugins/datatables/js/vfs_fonts.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="../../public/vendors/scripts/datatable-setting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // counter notification
    $(document).ready(function() {
        // counterNotification();

        notifList();
    });

    function counterNotification() {

        const ids = <?= $_SESSION['user']['id'] ?>;
        const dept = '<?= $_SESSION['user']['dept'] ?>';
        $.ajax({
            url: 'notificationcountajax.php',
            method: 'post',
            data: {
                aid: ids,
                dept: dept
            },
            // data: 'aid=' + ids,
        }).done(function(notifno) {
            notif2no = JSON.parse(notifno);
            let v = notif2no["0"]["COUNT(*)"];
            $('#notifbox').append(' <span class="font-weight-bold text-danger font-18">' + v + '</span>');
            $('#notifbox').append(' <span class="badge bdg text-success font-18 notification-active"></span>');
        });

    }

    function notifList() {
        const id = <?= $_SESSION['user']['id'] ?>;
        const depts = '<?= $_SESSION['user']['dept'] ?>';
        const aid = id;
        $.ajax({
            url: '/../../notificationajax.php',
            method: 'post',
            data: {
                aid: aid,
                dept: depts
            },
            // data: 'aid=' + aid,
        }).done(function(notif) {
            notif2 = JSON.parse(notif);
            console.info(notif2);
            notif2.forEach(key => {

                $('#notifbox').append(' <span class="badge bdg text-success font-18 notification-active"></span>');
                $('#notiflist').append('<li><div id="' + key['id_notif'] + '" class="card-body" onclick="reads(this.id)" style="cursor: pointer; background: #C9F0FB;"><h5 class="text-primary">' + key['title'] + '</h5><span class="text-info font-12">' + key['category'] + '</span><span class="text-success font-12"> Date: ' + key['created_at'] + '</span><p>' + key['description'] + '</p><hr></div></li>');

            });
        });
    }
    // notification list

    // function reads(reads_id) {
    //     const id = <?= $_SESSION['user']['id'] ?>;
    //     const idnotifs = reads_id;

    //     $.ajax({
    //         url: 'notificationread.php',
    //         method: 'post',
    //         data: {
    //             aids: id,
    //             notif: idnotifs
    //         },
    //         // data: 'aid=' + aid,
    //     }).done(function(data) {

    //         console.info(data);

    //     });
    // }
</script>



</body>
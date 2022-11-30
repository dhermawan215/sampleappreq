<script src="public/js/jquery-3-6-0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="public/vendors/scripts/core.js"></script>

<script src="public/vendors/scripts/script.min.js"></script>
<script src="public/vendors/scripts/process.js"></script>
<script src="public/vendors/scripts/layout-settings.js"></script>
<script src="public/src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="public/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="public/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="public/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="public/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="public/vendors/scripts/dashboard.js"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- buttons for Export datatable -->
<script src="public/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="public/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="public/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="public/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="public/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="public/src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="public/src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<script src="vendors/scripts/datatable-setting.js"></script>

<script>
    // counter notification
    $(document).ready(function() {
        const ids = <?= $_SESSION['user']['id'] ?>;

        $.ajax({
            url: 'notificationcountajax.php',
            method: 'post',
            data: 'aid=' + ids,
        }).done(function(notifno) {
            notif2no = JSON.parse(notifno);
            let v = notif2no["0"]["COUNT(*)"];
            $('#notifbox').append(' <span class="badge text-danger font-18 notification-active">' + v + '</span>');
        });
    });

    // notification list

    $(document).ready(function() {
        const id = <?= $_SESSION['user']['id'] ?>;
        const aid = id;
        $.ajax({
            url: 'notificationajax.php',
            method: 'post',
            data: 'aid=' + aid,
        }).done(function(notif) {
            notif2 = JSON.parse(notif);
            notif2.forEach(key => {
                $('#notiflist').append('<li><h5 class="text-primary">' + key['title'] + '</h5><span class="text-info font-12">' + key['category'] + '</span><span class="text-success font-12"> Date: ' + key['created_at'] + '</span><p>' + key['description'] + '</p><hr></li>');
            });

        });
    });
</script>
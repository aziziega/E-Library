<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
    include "config/koneksi.php";

    $sql = mysqli_query($koneksi, "SELECT * FROM identitas");
    $row1 = mysqli_fetch_assoc($sql);
    ?>
    <title>Login | <?= $row1['nama_app']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
    <!-- Icon -->
    <link rel="icon" type="icon" href="assets/dist/img/logo.png">
    <!-- Custom -->
    <link rel="stylesheet" href="assets/dist/css/custom.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="assets/dist/css/toastr.min.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="assets/dist/css/sweetalert.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="hold-transition login-page" style="font-family: 'Quicksand', sans-serif;">

<a href="home.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-8 py-4 inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 m-8">
    <svg class="rtl:rotate-180 w-6 h-6 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0L5 1M1 5l4 4" />
    </svg>
    <b class="mx-2">Back To Home</b>
</a>

<!-- Button to open the login modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
    Open Login
</button>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login-logo">
                    <a href="masuk"><b>E - LIBRARY</b></a>
                </div>
                <div class="login-box-body" style="border-radius: 10px;">
                    <img src="assets/dist/img/logo.png" height="80px" width="80px" style="display: block; margin-left: auto; margin-right: auto; margin-top: -12px; margin-bottom: 5px;">
                    <form name="formLogin" action="function/Process.php?aksi=masuk" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nama Pengguna">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-flat">Masuk</button>
                            </div>
                        </div>
                    </form>
                    <div class="social-auth-links text-center">
                        <p style="font-size: 11px;">- ATAU -</p>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" onclick="Register()" class="btn btn-block btn-warning btn-flat"><i class="fa fa-user-plus"></i> Daftar sebagai member</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- -->
<script src="assets/json/lottie-player.js"></script>
<!-- Fungsi mengarahkan kehalaman pendaftaran -->
<script>
    function Register() {
        window.location.href = "pendaftaran";
    }
</script>
<!-- Sweet Alert -->
<script src="assets/dist/js/sweetalert.min.js"></script>
<!-- Toastr -->
<script src="assets/dist/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<script>
    function validateForm() {
        if (document.forms["formLogin"]["username"].value == "") {
            toastr.error("Nama Pengguna harus diisi !!");
            document.forms["formLogin"]["username"].focus();
            return false;
        }
        if (document.forms["formLogin"]["password"].value == "") {
            toastr.error("Kata Sandi harus diisi !!");
            document.forms["formLogin"]["password"].focus();
            return false;
        }
    }
</script>
<script>
<?php
if (isset($_SESSION['masuk_dulu']) && $_SESSION['masuk_dulu'] != '') {
    echo "swal({
        icon: 'error',
        title: 'Peringatan',
        text: '$_SESSION[masuk_dulu]',
        buttons: false,
        timer: 3000
    });";
}
$_SESSION['masuk_dulu'] = '';
?>
</script>
<script>
<?php
if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] != '') {
    echo "swal({
        icon: 'success',
        title: 'Berhasil',
        text: '$_SESSION[berhasil]',
        buttons: false,
        timer: 3000
    });";
}
$_SESSION['berhasil'] = '';
?>
</script>
<script>
<?php
if (isset($_SESSION['gagal']) && $_SESSION['gagal'] != '') {
    echo "swal({
        icon: 'error',
        title: 'Peringatan',
        text: '$_SESSION[gagal]',
        buttons: false,
        timer: 3000
    });";
}
$_SESSION['gagal'] = '';
?>
</script>
<script>
<?php
if (isset($_SESSION['gagal_login']) && $_SESSION['gagal_login'] != '') {
    echo "swal({
        icon: 'error',
        title: 'Peringatan',
        text: '$_SESSION[gagal_login]',
        buttons: false,
        timer: 3000
    });";
}
$_SESSION['gagal_login'] = '';
?>
</script>
<script>
<?php
if (isset($_SESSION['berhasil_keluar']) && $_SESSION['berhasil_keluar'] != '') {
    echo "swal({
        icon: 'success',
        title: 'Berhasil',
        text: '$_SESSION[berhasil_keluar]',
        buttons: false,
        timer: 3000
    });";
}
$_SESSION['berhasil_keluar'] = '';
?>
</script>
</body>
</html>
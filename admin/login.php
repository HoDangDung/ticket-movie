<?php
include '../config/config.php';

if (isset($_POST['submit'])) {
    $admin = new Admin();
    if ($admin->login($_POST['password'])) {
        $admin->startSession();
        header('Location: ./');
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title>Đăng nhập Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="auth-fluid-pages loading pb-0">

    <div class="auth-fluid" style="background-image: url(assets/images/bg.jpg);">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div>
                <div class="card-body">

                    <!-- Logo -->
                    <!-- <div class="auth-brand text-center">
                        <div class="auth-logo">
                            <a href="index.html" class="logo auth-logo-dark">
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="26">
                                </span>
                            </a>
                            <a href="index.html" class="logo auth-logo-light">
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="26">
                                </span>
                            </a>
                        </div>
                    </div> -->

                    <!-- title-->

                    <div class="text-center w-75 m-auto pt-3">
                        <div class="mb-3">
                            <img src="assets/images/users/avatar-5.jpg" alt="user-image" class="rounded-circle img-thumbnail avatar-lg">
                        </div>
                        <p class="text-muted mb-4">Enter your password to access the admin.</p>
                    </div>


                    <form method="post" action="">

                        <div class="form-group mb-3">
                            <label for="password">Mật khẩu</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" required />
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit" name="submit">Đăng nhập</button>
                        </div>
                    </form>

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; QuanLyVePhim.
                        </p>
                    </footer>

                </div> <!-- end .card-body -->
            </div>
        </div>
        <!-- end auth-fluid-form-box-->

    </div>
    <!-- end auth-fluid-->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
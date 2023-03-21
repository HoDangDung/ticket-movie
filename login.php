<?php
include 'header.php';

if (isset($_POST['submit'])) {
    $users = new User();

    $user = $users->login($_POST['email'], $_POST['mat_khau']);
    if ($user) {
        $users->startSession($user);
        echo '<script>alert("Đăng nhập thành công! Đang chuyển hướng đến trang chủ...");location.replace("./");</script>';
        // header('Location: ./');
    } else echo '<script>alert("Tài khoản không đúng! Vui lòng thử lại!");</script>';
}
?>
<section class="main-page-header speaker-banner" style="background: url('assets/img/banner/banner-movie.jpg');">
    <div class="container">
        <div class="speaker-banner-content">
            <h2 class="title">Đăng Nhập</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>login</li>
            </ul>
        </div>
    </div>
</section>

<section class="account-section">
    <div class="container">
        <div class="padding-top padding-bottom">
            <div class="account-area">
                <div class="section-header-3">
                    <span class="cate">hello !</span>
                    <h2 class="title">welcome back</h2>
                </div>
                <form class="account-form" method="POST" action="">
                    <div class="form-group">
                        <label for="email">Email<span>*</span></label>
                        <input type="text" placeholder="Email" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu<span>*</span></label>
                        <input type="password" placeholder="Password" id="password" name="mat_khau" required />
                    </div>
                    <!-- <div class="form-group checkgroup">
                        <input type="checkbox" id="bal2" required checked>
                        <label for="bal2">remember me</label>
                        <a href="#" class="forget-pass">Forgot Password?</a>
                    </div> -->
                    <div class="form-group text-center">
                        <input type="submit" value="Đăng nhập" name="submit" />
                    </div>
                </form>
                <div class="option">
                    Chưa có tài khoản? <a href="register.php">đăng ký</a>.
                </div>
                <!-- <div class="or"><span>Or</span></div>
                <ul class="social-icons">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-google"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';

<?php
include 'header.php';

// var_dump($_POST);
if (isset($_POST['submit'])) {
    $users = new User();

    $email = $_POST['email'];
    $mat_khau = $_POST['mat_khau'];
    $ho_ten = $_POST['ho_ten'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $sdt = $_POST['sdt'];
    $dia_chi = $_POST['dia_chi'];

    if ($mat_khau ==  $_POST['xac_nhan_mat_khau'])
        if ($users->register($email, $mat_khau, $ho_ten, $ngay_sinh, $gioi_tinh, $sdt, $dia_chi)) {
            echo '<script>alert("Đăng ký thành công! Vui lòng đăng nhập!");location.replace("login.php");</script>';
        } else echo '<script>alert("Đăng ký thất bại!");</script>';
    else echo '<script>alert("Mật khẩu nhập lại không trùng khớp!! Vui lòng thử lại!");</script>';
}
?>
<section class="main-page-header speaker-banner" style="background: url('assets/img/banner/banner-movie.jpg');">
    <div class="container">
        <div class="speaker-banner-content">
            <h2 class="title">Đăng ký</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>register</li>
            </ul>
        </div>
    </div>
</section>

<section class="account-section bg_img" data-background="assets/images/account/account-bg.jpg">
    <div class="container">
        <div class="padding-top padding-bottom">
            <div class="account-area">
                <div class="section-header-3">
                    <span class="cate">welcome !</span>
                    <h2 class="title">Tạo tài khoản</h2>
                </div>
                <form class="account-form" method="POST" action="">
                    <div class="form-group">
                        <label for="ho_ten">Họ tên<span>*</span></label>
                        <input type="text" placeholder="Nhập họ tên" id="ho_ten" name="ho_ten" required />
                    </div>
                    <div class="form-group">
                        <label for="ngay_sinh">Ngày sinh<span>*</span></label>
                        <input type="date" placeholder="Nhập ngày sinh" id="ngay_sinh" name="ngay_sinh" required />
                    </div>
                    <div class="form-group">
                        <label for="gioi_tinh">Giới tính<span>*</span></label>
                        <select id="gioi_tinh" name="gioi_tinh" required>
                            <option value="1" selected>Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sdt">SĐT<span>*</span></label>
                        <input type="text" placeholder="Nhập SĐT" id="sdt" name="sdt" required />
                    </div>
                    <div class="form-group">
                        <label for="dia_chi">Địa chỉ<span>*</span></label>
                        <input type="text" placeholder="Nhập địa chỉ" id="dia_chi" name="dia_chi" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span>*</span></label>
                        <input type="text" placeholder="Nhập Email" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password<span>*</span></label>
                        <input type="password" placeholder="Mật khẩu" id="password" name="mat_khau" required />
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password<span>*</span></label>
                        <input type="password" placeholder="Nhập lại mật khẩu" id="confirm-password" name="xac_nhan_mat_khau" required />
                    </div>
                    <!-- <div class="form-group checkgroup">
                        <input type="checkbox" id="agree" required checked>
                        <label for="agree">I agree with this <a href="#">Terms </a> and <a href="#"> Privacy Policy</a>. </label>
                    </div> -->
                    <div class="form-group text-center">
                        <input type="submit" value="Đăng ký" name="submit" />
                    </div>
                </form>
                <div class="option">
                    Đã có tài khoản? <a href="login.html">Đăng nhập</a>.
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';

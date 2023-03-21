<?php
include 'header.php';

$tickets = new Ticket();
$users = new User();
$user = $users->getUser($_SESSION['ma_kh']);

if ($_POST['submit']) {
    switch ($_POST['submit']) {
        case 'update_user':
            if ($users->updateUser($user['ma_kh'], getPOST('email'), getPOST('ho_ten'), getPOST('ngay_sinh'), getPOST('gioi_tinh'), getPOST('sdt'), getPOST('dia_chi'))) {
                echo '<script>alert("Cập nhật thành công!");</script>';
                $user = $users->getUser($_SESSION['ma_kh']);
            } else echo '<script>alert("Cập nhật không thành công!");</script>';
            break;
        case 'change_password':
            if (getPOST('mat_khau_moi') == getPOST('xac_nhan_mat_khau_moi'))
                if ($user['mat_khau'] == $users->encryptedPassword(getPOST('mat_khau_cu'))) {
                    if ($users->changePassword($user['ma_kh'], getPOST('mat_khau_moi'))) {
                        echo '<script>alert("Cập nhật thành công!");</script>';
                    } else echo '<script>alert("Cập nhật không thành công!");</script>';
                } else echo '<script>alert("Mật khẩu cũ không đúng. Vui lòng thử lại!");</script>';
            else echo '<script>alert("Mật khẩu mới không trùng khớp. Vui lòng thử lại!");</script>';
            break;
    }
}
?>
<section class="details-banner hero-area seat-plan-banner" style="background:url('assets/img/banner/banner-movie.jpg')">
</section>

<div class="movie-facility padding-bottom padding-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-widget checkout-contact">
                    <h5 class="title">Thông tin người dùng</h5>
                    <form class="checkout-contact-form" method="post" action="">
                        <div class="form-group">
                            <label>Họ tên<span>*</span></label>
                            <input type="text" value="<?php echo $user['ho_ten']; ?>" name="ho_ten" required />
                        </div>
                        <div class="form-group">
                            <label>Email<span>*</span></label>
                            <input type="text" value="<?php echo $user['email']; ?>" name="email" required />
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh<span>*</span></label>
                            <input type="date" value="<?php echo $user['ngay_sinh']; ?>" name="ngay_sinh" required />
                        </div>
                        <div class="form-group">
                            <label>Giới tính<span>*</span></label>
                            <select id="gioi_tinh" name="gioi_tinh" required style="background-color: #032055">
                                <option value="1" <?php echo $user['gioi_tinh'] == 1 ? 'selected' : ''; ?>>Nam</option>
                                <option value="0" <?php echo $user['gioi_tinh'] == 0 ? 'selected' : ''; ?>>Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>SĐT<span>*</span></label>
                            <input type="text" value="<?php echo $user['sdt']; ?>" name="sdt" required />
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ<span>*</span></label>
                            <input type="text" value="<?php echo $user['dia_chi']; ?>" name="dia_chi" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" value="change_password" class="custom-button" name="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-widget checkout-contact">
                    <h5 class="title">Đổi mật khẩu</h5>
                    <form class="checkout-contact-form" method="post" action="">
                        <div class="form-group">
                            <label for="mat_khau_cu">Mật khẩu cũ<span>*</span></label>
                            <input type="password" value="" name="mat_khau_cu" required />
                        </div>
                        <div class="form-group">
                            <label for="mat_khau_moi">Mật khẩu mới<span>*</span></label>
                            <input type="password" value="" name="mat_khau_moi" required />
                        </div>
                        <div class="form-group">
                            <label for="xac_nhan_mat_khau_moi">Xác nhận mật khẩu mới<span>*</span></label>
                            <input type="password" value="" name="xac_nhan_mat_khau_moi" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" value="change_password" class="custom-button" name="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table border="1" width=100% align="center">
                    <thead>
                        <tr>
                            <th>Mã vé</th>
                            <th>Loại vé</th>
                            <th>Giá vé</th>
                            <th>Tên phim</th>
                            <th>Thời gian chiếu</th>
                            <th>Vị trí ngồi</th>
                            <th>Tên rạp</th>
                            <th>Ngày mua</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets->getTicketsByUserId($_SESSION['ma_kh']) as $k => $v) { ?>
                            <tr>
                                <td><?php echo $v['ma_vp']; ?></td>
                                <td><?php echo $v['ten_lv']; ?></td>
                                <td><?php echo $v['gia_ve']; ?></td>
                                <td><?php echo $v['ten_phim']; ?></td>
                                <td><?php echo $v['thoi_gian_chieu']; ?></td>
                                <td><?php echo $v['so_ghe']; ?></td>
                                <td><?php echo $v['ten_rap']; ?></td>
                                <td><?php echo $v['ngay_dat_ve']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';

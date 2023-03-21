<?php
include 'header.php';

$ageLimit = new AgeLimit();

$movies = new Movie();
$ten_phim = $anh_bia = $link_trailer = $nha_san_xuat = $mo_ta = $thoi_luong = $ma_gh = $an_phim = '';
if (isset($_POST['submit'])) {
    switch ($_GET['act']) {
        case 'add':
            if ($movies->postMovie($_POST['ten_phim'], $_POST['anh_bia'], $_POST['link_trailer'], $_POST['nha_san_xuat'], $_POST['mo_ta'], $_POST['thoi_luong'], $_POST['ma_gh'], $_POST['an_phim'])) {
                echo '<script>alert("Thêm thành công!");</script>';
            } else echo '<script>alert("Thêm thất bại!");</script>';
            break;
        case 'edit':
            if ($movies->updateMovie($_GET['ma_phim'], $_POST['ten_phim'], $_POST['anh_bia'], $_POST['link_trailer'], $_POST['nha_san_xuat'], $_POST['mo_ta'], $_POST['thoi_luong'], $_POST['ma_gh'], $_POST['an_phim'])) {
                echo '<script>alert("Sửa thành công!");</script>';
            } else echo '<script>alert("Sửa thất bại!");</script>';
            break;
        default:
            break;
    }
}
if ($_GET['act'] == 'edit') {
    $movie = $movies->getMovie($_GET['ma_phim']);
    $ten_phim = $movie['ten_phim'];
    $anh_bia = $movie['anh_bia'];
    $link_trailer = $movie['link_trailer'];
    $nha_san_xuat   = $movie['nha_san_xuat'];
    $mo_ta      = $movie['mo_ta'];
    $thoi_luong = $movie['thoi_luong'];
    $ma_gh = $movie['ma_gh'];
    $an_phim = $movie['an_phim'];
}
?>
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><?php echo $_GET['act'] == 'add' ? 'Thêm mới phim' : 'Chỉnh sửa phim'; ?></h4>
                    <p class="sub-header"></p>

                    <div>
                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="ten_phim">Tên phim</label>
                                <div class="col-md-10">
                                    <input type="text" id="ten_phim" name="ten_phim" class="form-control" value="<?php echo $ten_phim; ?>" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="anh_bia">Ảnh bìa</label>
                                <div class="col-md-10">
                                    <input type="text" id="anh_bia" name="anh_bia" class="form-control" value="<?php echo $anh_bia; ?>" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="link_trailer">Link trailer</label>
                                <div class="col-md-10">
                                    <input type="text" id="link_trailer" name="link_trailer" class="form-control" value="<?php echo $link_trailer; ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="nha_san_xuat">Nhà sản xuất</label>
                                <div class="col-md-10">
                                    <input type="text" id="nha_san_xuat" name="nha_san_xuat" class="form-control" value="<?php echo $nha_san_xuat; ?>" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="mo_ta">Mô tả</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" rows="5" id="mo_ta" name="mo_ta"><?php echo $mo_ta; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="thoi_luong">Thời lượng</label>
                                <div class="col-md-10">
                                    <input type="number" id="thoi_luong" name="thoi_luong" class="form-control" value="<?php echo $thoi_luong; ?>" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Giới hạn độ tuổi</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="ma_gh">
                                        <?php
                                        foreach ($ageLimit->getAgeLimit() as $k => $v) {
                                            echo '<option value="' . $v['ma_gh'] . '" ' . ($ma_gh == $v['ma_gh'] ? 'selected' : '') . '>' . $v['ten_gh'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Hiển thị phim</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="an_phim">
                                        <option value="1" <?php echo $an_phim == 1 ? 'selected' : ''; ?>>Có</option>
                                        <option value="0" <?php echo $an_phim == 0 ? 'selected' : ''; ?>>Không</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="example-date">Date</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="example-date" type="date" name="date" />
                                </div>
                            </div> -->
                            <button type="submit" class="btn btn-primary" name="submit">Thực hiện</button>
                        </form>
                    </div>
                </div>
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container-fluid -->
<?php
include 'footer.php';

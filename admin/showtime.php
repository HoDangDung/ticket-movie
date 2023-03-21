<?php
include 'header.php';

$movies = new Movie();
$theaters = new Theater();

$ma_lc = $ma_phim = $ten_phim = $ma_rap = $thoi_gian_chieu = '';
$day = date("Y-m-d", time());
$time = date("H:i:s", time());

if (isset($_POST['submit'])) {
    switch ($_GET['act']) {
        case 'add':
            if ($movies->postShowtime($_GET['ma_phim'], $_POST['ma_rap'], $_POST['day'] . ' ' . $_POST['time'])) {
                echo '<script>alert("Thêm thành công!");</script>';
            } else echo '<script>alert("Thêm thất bại!");</script>';
            break;
        case 'edit':
            if ($movies->updateShowtime($_GET['ma_lc'], $_POST['ma_rap'], $_POST['day'] . ' ' . $_POST['time'])) {
                echo '<script>alert("Sửa thành công!");</script>';
            } else echo '<script>alert("Sửa thất bại!");</script>';
            break;
        default:
            break;
    }
}
if ($_GET['act'] == 'edit') {
    $m = $movies->getShowtime($_GET['ma_lc']);
    $ma_phim = $m['ma_phim'];
    $ma_rap = $m['ma_rap'];
    $thoi_gian_chieu = explode(' ', $m['thoi_gian_chieu']);
    $day = $thoi_gian_chieu[0];
    $time = $thoi_gian_chieu[1];
} else if ($_GET['act'] == 'add') {
    $ma_phim = $_GET['ma_phim'];
}
$movie = $movies->getMovie($ma_phim);
$ten_phim = $movie['ten_phim'];
?>
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><?php echo $_GET['act'] == 'add' ? 'Thêm mới lịch chiếu' : 'Sửa lịch chiếu'; ?></h4>
                    <p class="sub-header"></p>

                    <div>
                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="ten_phim">Tên phim</label>
                                <div class="col-md-10">
                                    <input type="text" id="ten_phim" name="ten_phim" class="form-control" value="<?php echo $ten_phim; ?>" disabled />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Tên rạp</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="ma_rap">
                                        <?php
                                        foreach ($theaters->getTheaters() as $k => $v) {
                                            echo '<option value="' . $v['ma_rap'] . '" ' . ($ma_rap == $v['ma_rap'] ? 'selected' : '') . '>' . $v['ten_rap'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="day">Ngày chiếu</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="day" type="date" name="day" value="<?php echo $day; ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="time">Giờ chiếu</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="time" type="text" name="time" value="<?php echo $time; ?>" />
                                </div>
                            </div>
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

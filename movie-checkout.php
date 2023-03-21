<?php
include 'header.php';

$movies = new Movie;
$movie = $movies->getShowtime(getGET("ma_lc"));

$seats = getGET('seats');
$count = count(explode(',', $seats));
$prices = new Price();
$total = $prices->calculatePrice($seats);

$users = new User();
$user = $users->getUser($_SESSION['ma_kh']);

if (empty($seats) || $count == 0)
    echo '<script>location.replace("./");</script>';
if ($_POST['submit']) {
    $tickets = new Ticket();
    $tickets->postTicket($movie['ma_lc'], $_SESSION['ma_kh'], $seats);
    echo '<script>alert("Đặt vé thành công! Đang chuyển hướng đến trang chủ...");location.replace("./");</script>';
}
?>
<section class="details-banner hero-area seat-plan-banner" style="background:url('assets/img/banner/banner-movie.jpg')">
    <div class="container">
        <div class="details-banner-wrapper">
            <div class="details-banner-content style-two">
                <h3 class="title"><?php echo $movie['ten_phim']; ?></h3>
                <div class="tags">
                    <a href="#">MOVIE</a>
                    <a href="#">2D</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="page-title bg-one">
    <div class="container">
        <div class="page-title-area">
            <div class="item md-order-1">
                <a href="movie-ticket.php?ma_phim=<?php echo $movie['ma_phim']; ?>" class="custom-button back-button">
                    <i class="far fa-reply"></i>Chọn lại thời gian xem
                </a>
            </div>
            <div class="item date-item">THỜI GIAN CHIẾU:
                <span class="date">&nbsp;<?php echo $movie['thoi_gian_chieu']; ?></span>
            </div>
            <div class="item">
                <small>THỜI LƯỢNG:</small>
                <span class="h3 font-weight-bold"><?php echo $movie['thoi_luong']; ?></span> phút
            </div>
        </div>
    </div>
</section>

<div class="movie-facility padding-bottom padding-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-widget checkout-contact">
                    <h5 class="title">Thông tin khách đặt vé</h5>
                    <form class="checkout-contact-form">
                        <div class="form-group">
                            <input type="text" value="<?php echo $user['ho_ten']; ?>" disabled />
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?php echo $user['email']; ?>" disabled />
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?php echo $user['sdt']; ?>" disabled />
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?php echo $user['dia_chi']; ?>" disabled />
                        </div>
                        <!-- <div class="form-group">
                            <input type="submit" value="Continue" class="custom-button">
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="booking-summery bg-one side-shape">
                    <h4 class="title">chi tiết</h4>
                    <ul>
                        <li>
                            <h6 class="subtitle"><?php echo $movie['ten_phim']; ?></h6>
                            <span class="info">Movie-2d</span>
                        </li>
                        <li>
                            <h6 class="subtitle"><span><?php echo $movie['ten_rap']; ?></span><span><?php echo $count; ?></span></h6>
                            <div class="info"><span><?php echo $movie['thoi_gian_chieu']; ?></span> <span>Vé</span></div>
                        </li>
                        <li>
                            <h6 class="subtitle mb-0"><span>Tổng cộng</span><span><?php echo formatPrice($total); ?>đ</span></h6>
                        </li>
                    </ul>
                    <!-- <ul>
                        <li>
                            <span class="info"><span>price</span><span>$280</span></span>
                            <span class="info"><span>vat</span><span>$10</span></span>
                        </li>
                    </ul> -->
                </div>
                <div class="proceed-area  text-center">
                    <h6 class="subtitle"><span> Thanh toán</span><span><?php echo formatPrice($total); ?>đ</span></h6>
                    <form method="POST" action="">
                        <input type="submit" name="submit" class="custom-button" value="xác nhận" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';

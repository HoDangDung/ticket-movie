<?php
include 'header.php';

$movies = new Movie;
$movie = $movies->getShowtime(getGET("ma_lc"));
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

<div class="seat-plan-section padding-bottom padding-top">
    <div class="container">
        <div class="screen-area">
            <h4 class="screen">MÀN HÌNH</h4>
            <div class="screen-thumb">
                <img src="assets/img/movie/theater.png" alt="movie">
            </div>
            <h5 class="subtitle">CHỌN CHỖ NGỒI</h5>
            <div class="screen-wrapper">
                <ul class="seat-area">
                    <?php for ($i = 'A'; $i <= 'C'; $i++) { ?>
                        <li class="seat-line">
                            <span><?php echo $i; ?></span>
                            <ul class="seat--area">
                                <li class="front-seat">
                                    <ul>
                                        <?php for ($j = 1; $j <= 4; $j++) {
                                            echo '<li class="single-seat seat-free"><img data-booked="0" data-vip="0" id="seat_' . $i . $j . '" src="assets/img/movie/seat-1-free.png" alt="seat"><span class="sit-num">' . $i . $j . '</span></li>';
                                        } ?>
                                    </ul>
                                </li>
                                <li class="front-seat">
                                    <ul>
                                        <?php for ($j = 5; $j <= 10; $j++) {
                                            echo '<li class="single-seat seat-free"><img data-booked="0" data-vip="0" id="seat_' . $i . $j . '" src="assets/img/movie/seat-1-free.png" alt="seat"><span class="sit-num">' . $i . $j . '</span></li>';
                                        } ?>
                                    </ul>
                                </li>
                                <li class="front-seat">
                                    <ul>
                                        <?php for ($j = 11; $j <= 14; $j++) {
                                            echo '<li class="single-seat seat-free"><img data-booked="0" data-vip="0" id="seat_' . $i . $j . '" src="assets/img/movie/seat-1-free.png" alt="seat"><span class="sit-num">' . $i . $j . '</span></li>';
                                        } ?>
                                    </ul>
                                </li>
                            </ul>
                            <span><?php echo $i; ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <h5 class="subtitle">LỐI ĐI</h5>
            <div class="screen-wrapper">
                <ul class="seat-area">
                    <?php for ($i = 'D'; $i <= 'F'; $i++) { ?>
                        <li class="seat-line">
                            <span><?php echo $i; ?></span>
                            <ul class="seat--area">
                                <li class="front-seat">
                                    <ul>
                                        <?php for ($j = 1; $j <= 4; $j++) {
                                            echo '<li class="single-seat seat-free"><img data-booked="0" data-vip="0" id="seat_' . $i . $j . '" src="assets/img/movie/seat-1-free.png" alt="seat"><span class="sit-num">' . $i . $j . '</span></li>';
                                        } ?>
                                    </ul>
                                </li>
                                <li class="front-seat">
                                    <ul>
                                        <?php for ($j = 5; $j <= 10; $j++) {
                                            echo '<li class="single-seat seat-free"><img data-booked="0" data-vip="1" id="seat_' . $i . $j . '" src="assets/img/movie/seat-1-free.png" alt="seat"><span class="sit-num">' . $i . $j . '</span></li>';
                                        } ?>
                                    </ul>
                                </li>
                                <li class="front-seat">
                                    <ul>
                                        <?php for ($j = 11; $j <= 14; $j++) {
                                            echo '<li class="single-seat seat-free"><img data-booked="0" data-vip="0" id="seat_' . $i . $j . '" src="assets/img/movie/seat-1-free.png" alt="seat"><span class="sit-num">' . $i . $j . '</span></li>';
                                        } ?>
                                    </ul>
                                </li>
                            </ul>
                            <span><?php echo $i; ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="proceed-book">
            <div class="proceed-to-book">
                <div class="book-item">
                    <span>Your Selected Seat</span>
                    <h3 class="title" id="seat_booked"></h3>
                </div>
                <div class="book-item">
                    <span>total price</span>
                    <h3 class="title" id="price">0đ</h3>
                </div>
                <div class="book-item">
                    <button class="custom-button" onclick="checkout(<?php echo $movie['ma_lc']; ?>);">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';

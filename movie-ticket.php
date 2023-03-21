<?php
include 'header.php';

$movies = new Movie;
$movie = $movies->getMovie(getGET("ma_phim"));
?>
<section class="window-warning inActive">
    <div class="lay"></div>
    <div class="warning-item">
        <h6 class="subtitle">Giờ chiếu: <span id="thoi_gian_chieu"></span></h6>
        <h4 class="title">Chọn chỗ ngồi</h4>
        <div class="thumb">
            <img src="assets/img/movie/tt.png" alt="movie">
        </div>
        <a href="#" class="custom-button seatPlanButton" id="choose_seat">Xem vị trí<i class="fal fa-long-arrow-alt-right"></i></a>
    </div>
</section>


<section class="details-banner hero-area" style="background:url('assets/img/banner/banner-movie.jpg')">
    <div class="container">
        <div class="details-banner-wrapper">
            <div class="details-banner-content">
                <h3 class="title"><?php echo $movie['ten_phim']; ?></h3>
                <div class="tags">
                    <a href="#">2D</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="book-section bg-one">
    <div class="container">
        <form class="ticket-search-form two">
            <div class="form-group">
                <div class="thumb">
                    <img src="assets/img/ticket/city.png" alt="ticket">
                </div>
                <span class="type">Chọn thời gian xem phim</span>
            </div>
        </form>
    </div>
</section>


<div class="ticket-plan-section padding-bottom padding-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-5 mb-lg-0">
                <ul class="seat-plan-wrapper">
                    <?php foreach ($movies->getShowtimes($movie['ma_phim']) as $k => $v) {
                    ?>
                        <li>
                            <div class="movie-name">
                                <div class="icons">
                                    <i class="far fa-heart"></i>
                                    <i class="fas fa-heart"></i>
                                </div>
                                <a href="#" class="name"><?php echo $v['ten_rap']; ?></a>
                            </div>
                            <div class="location-icon" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" title="<?php echo $v['dia_chi_rap']; ?>">
                                <i class="fas fa-map-marker-alt"></i><?php echo $v['dia_chi_rap']; ?>
                            </div>
                            <div class="movie-schedule">
                                <?php foreach (explode('|', $v['tgc']) as $j => $r) {
                                    $lc = explode('|', $v['lc']);
                                    echo '<div class="item" style="width: 250px;" onclick="chooseSeat(' . $lc[$j] . ', \'' . $r . '\');">' . $r . '</div>';
                                } ?>
                            </div>
                        </li>
                    <?php
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';

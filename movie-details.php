<?php
include 'header.php';

$movies = new Movie;
$movie = $movies->getMovie(getGET("ma_phim"));
?>
<section class="details-banner" style="background:url('assets/img/banner/banner-movie.jpg')">
    <div class="container">
        <div class="details-banner-wrapper">
            <div class="details-banner-thumb">
                <img src="<?php echo $movie['anh_bia']; ?>" alt="movie" style="max-height: 300px;" />
                <a href="<?php echo $movie['link_trailer'] ?>" class="video-button video-popup">
                    <i class="fal fa-play"></i>
                </a>
            </div>
            <div class="details-banner-content offset-lg-4">
                <h3 class="title"><?php echo $movie['ten_phim']; ?></h3>
                <div class="tags">
                    <a href="#">2D</a>
                </div>
                <?php foreach ($movies->getMovieWithType($movie['ma_phim']) as $k => $v) {
                    echo '<a href="#" class="button">' . $v['ten_lp'] . '</a>';
                }
                ?>
                <div class="social-and-duration">
                    <div class="duration-area">
                        <div class="item">
                            <i class="fal fa-clock"></i><span><?php echo $movie['thoi_luong']; ?> phút</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="book-section">
    <div class="container">
        <div class="book-wrapper offset-lg-4">
            <div class="left-side">
                <div class="item">
                    <div class="item-header">
                        <h5 class="title">5.0</h5>
                        <div class="rated">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="item-header">
                        <div class="rated rate-it">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="title">0.0</h5>
                    </div>
                </div>
            </div>
            <a href="movie-ticket.php?ma_phim=<?php echo $movie['ma_phim']; ?>" class="custom-button">Đặt vé</a>
        </div>
    </div>
</section>


<section class="movie-details-section padding-top padding-bottom">
    <div class="container">
        <div class="row justify-content-center flex-wrap-reverse mb--50">
            <div class="col-lg-9 mb-50">
                <div class="movie-details">
                    <div class="tab summery-review">
                        <ul class="tab-menu">
                            <li class="active">Chi tiết</li>
                        </ul>
                        <div class="tab-area">
                            <div class="tab-item active">
                                <div class="item">
                                    <p><?php echo $movie['mo_ta']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';

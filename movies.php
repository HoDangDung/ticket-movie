<?php
include 'header.php';

$page = $_GET['page'];
if ($page < 1 || $page == '' || !is_numeric($page)) $page = 1;

$movies = new Movie();
if (!empty(getGET('keyword'))) {
    $listMovies = $movies->search(getGET('keyword'), $page);
    $total = $movies->getCountSearch(getGET('keyword'));
} else {
    $listMovies = $movies->getMovies($page);
    $total = $movies->getCount();
}
?>
<section class="banner-section">
    <div class="banner-bg bg-fixed" style="background:url('assets/img/banner/banner-movie.jpg')"></div>
    <div class="container">
        <div class="banner-content">
            <h1 class="title bold">buy <span class="color-theme">movie</span> tickets</h1>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
        </div>
    </div>
</section>

<section class="search-ticket-section padding-top pt-lg-0">
    <div class="container">
        <div class="search-tab">
            <div class="row align-items-center mb--20">
                <div class="col-lg-6 mb-20">
                    <div class="search-ticket-header">
                        <h6 class="category">search movies </h6>
                        <h3 class="title">find your movies now</h3>
                    </div>
                </div>
                <div class="tab-item active">
                    <form class="ticket-search-form" method="get" action="">
                        <div class="form-group large">
                            <input type="text" placeholder="Tìm kiếm phim..." name="keyword" />
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="form-group">
                            <div class="thumb">
                                <button type="submit" class="filter-btn"><i class="far fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="movie-section padding-top padding-bottom">
    <div class="container">
        <div class="row flex-wrap-reverse justify-content-center">
            <div class="col-lg-9 mb-50 mb-lg-0">
                <div class="filter-tab tab">
                    <!-- <div class="filter-area">
                        <div class="filter-main">
                            <div class="left">
                                <div class="item">
                                    <span class="show">Sắp xếp theo:</span>
                                    <select class="select-bar">
                                        <option value="latest">Thời gian cập nhật</option>
                                        <option value="exclusive">exclusive</option>
                                        <option value="upcoming">upcoming</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-area">
                        <div class="tab-item active">
                            <div class="row mb-10 justify-content-center">
                                <?php foreach ($listMovies as $k => $v) { ?>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="movie-grid">
                                            <div class="movie-thumb c-thumb" style="height: 500px">
                                                <a href="movie-details.php?ma_phim=<?php echo $v['ma_phim']; ?>">
                                                    <img src="<?php echo $v['anh_bia']; ?>" alt="movie">
                                                </a>
                                            </div>
                                            <div class="movie-content">
                                                <h5 class="title m-0">
                                                    <a href="movie-details.php?ma_phim=<?php echo $v['ma_phim']; ?>" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 300px;" title="<?php echo $v['ten_phim']; ?>">
                                                        <?php echo $v['ten_phim']; ?></a>
                                                </h5>
                                                <ul class="movie-rating-percent">
                                                    <li>
                                                        <i class="fal fa-shopping-cart"></i>
                                                        <!-- <span class="content">88.8k</span> -->
                                                    </li>
                                                    <li>
                                                        <i class="fal fa-star"></i>
                                                        <span class="content">5.0</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-area text-center">
                        <!-- <a href="#"><i class="fal fa-long-arrow-alt-left"></i><span>Prev</span></a>
                        <a href="#">1</a>
                        <a href="#" class="active">2</a>
                        <a href="#">3</a>
                        <a href="#"><span>Next</span><i class="fal fa-long-arrow-alt-right"></i></a> -->
                        <?php
                        $limit = (($page - 1) * DATA_PER_PAGE) . ',' . DATA_PER_PAGE;
                        $end_page =  ceil($total / DATA_PER_PAGE);
                        $page_item = [];
                        for ($i = 1; $i <= $end_page; $i++) if (abs($page - $i) <= 3 || $i == 1 || $i == $end_page) {
                            $page_item[] = $i;
                            echo '<a class="' . ($page == $i ? 'active' : '') . '" href="javascript:" onclick="pagination(' . $i . ')">' . $i . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';

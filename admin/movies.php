<?php
include 'header.php';

$movies = new Movie();
?>
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Danh sách phim</h4>
                    <p class="sub-header"></p>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%">Tên phim</th>
                                    <th style="width: 10%">Ảnh bìa</th>
                                    <th style="width: 10%">Link trailer</th>
                                    <th style="width: 15%">Nhà sản xuất</th>
                                    <th style="width: 10%">Thời lượng</th>
                                    <th style="width: 10%">Giới hạn độ tuổi</th>
                                    <th style="width: 10%">Hiển thị phim</th>
                                    <th style="width: 5%">Thêm lịch chiếu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($movies->getMovies(0, 0, -1) as $k => $v) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $v['ma_phim']; ?></th>
                                        <td><a href="movie.php?act=edit&ma_phim=<?php echo $v['ma_phim']; ?>"><?php echo $v['ten_phim']; ?></a></td>
                                        <td><img src="<?php echo $v['anh_bia']; ?>" style="width: 100%;" /></td>
                                        <td><?php echo $v['link_trailer']; ?></td>
                                        <td><?php echo $v['nha_san_xuat']; ?></td>
                                        <td><?php echo $v['thoi_luong']; ?></td>
                                        <td><?php echo $v['ma_gh']; ?></td>
                                        <td><?php echo $v['an_phim'] == 1 ? 'Có' : 'Không'; ?></td>
                                        <td><a href="showtime.php?act=add&ma_phim=<?php echo $v['ma_phim']; ?>"><i class="fe-plus-circle"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container-fluid -->
<?php
include 'footer.php';

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
                                    <th style="width: 10%">#</th>
                                    <th style="width: 40%">Tên phim</th>
                                    <th style="width: 20%">Tên rạp</th>
                                    <th style="width: 20%">Thời gian chiếu</th>
                                    <th style="width: 10%">Chỉnh sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($movies->getShowtimesAll() as $k => $v) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $v['ma_lc']; ?></th>
                                        <td><a href="movie.php?act=edit&ma_phim=<?php echo $v['ma_phim']; ?>"><?php echo $v['ten_phim']; ?></a></td>
                                        <td><?php echo $v['ten_rap']; ?></td>
                                        <td><?php echo $v['thoi_gian_chieu']; ?></td>
                                        <td><a href="showtime.php?act=edit&ma_lc=<?php echo $v['ma_lc']; ?>"><i class="fe-edit"></i></a></td>
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

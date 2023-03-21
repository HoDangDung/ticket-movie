<?php
include 'header.php';

$tickets = new Ticket();
?>
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Danh sách vé đã đặt</h4>
                    <p class="sub-header"></p>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#</th>
                                    <th style="width: 10%">Loại vé</th>
                                    <th style="width: 10%">Giá vé</th>
                                    <th style="width: 30%">Tên phim</th>
                                    <th style="width: 20%">Thời gian chiếu</th>
                                    <th style="width: 20%">Tên rạp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tickets->getTickets() as $k => $v) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $v['ma_vp']; ?></th>
                                        <td><?php echo $v['ten_lv']; ?></td>
                                        <td><?php echo $v['gia_ve']; ?></td>
                                        <td><a href="movie.php?act=edit&ma_phim=<?php echo $v['ma_phim']; ?>"><?php echo $v['ten_phim']; ?></a></td>
                                        <td><?php echo $v['thoi_gian_chieu']; ?></td>
                                        <td><?php echo $v['ten_rap']; ?></td>
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

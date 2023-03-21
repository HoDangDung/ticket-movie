<?php
include 'header.php';

$users = new User();
?>
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Danh sách khách hàng</h4>
                    <p class="sub-header"></p>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#</th>
                                    <th style="width: 20%">Họ tên</th>
                                    <th style="width: 20%">Ngày sinh</th>
                                    <th style="width: 10%">Giới tính</th>
                                    <th style="width: 20%">Email</th>
                                    <th style="width: 20%">Số điện thoại</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users->getUsers() as $k => $v) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $v['ma_kh']; ?></th>
                                        <td><?php echo $v['ho_ten']; ?></td>
                                        <td><?php echo $v['ngay_sinh']; ?></td>
                                        <td><?php echo $v['gioi_tinh'] == 1 ? 'Nam' : 'Nữ'; ?></td>
                                        <td><?php echo $v['email']; ?></td>
                                        <td><?php echo $v['sdt']; ?></td>
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

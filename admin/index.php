<?php
include 'header.php';

$users = new User();
$tickets = new Ticket();
$prices = new Price();
?>
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Tổng số vé</p>
                            <h3 class="mb-0"><?php echo $tickets->getCount(); ?></h3>
                        </div>
                        <div dir="ltr" class="knob-chart">
                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-bgColor="rgba(150, 150, 150, 0.1)" data-fgColor="#0acf97" value="37" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Tổng khách hàng</p>
                            <h3 class="mb-0"><?php echo $users->getCount(); ?></h3>
                        </div>
                        <div dir="ltr" class="knob-chart">
                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-bgColor="rgba(150, 150, 150, 0.1)" data-fgColor="#f9bc0b" value="92" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">

                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Tổng doanh thu</p>
                            <h3 class="mb-0"><?php echo $prices->getRevenue(); ?>đ</h3>
                        </div>
                        <div dir="ltr" class="knob-chart">
                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-bgColor="rgba(150, 150, 150, 0.1)" data-fgColor="#2d7bf4" value="60" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div> <!-- container-fluid -->
<?php
include 'footer.php';

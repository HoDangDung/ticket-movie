<footer class="footer-section">
    <div class="container">
        <div class="footer-bottom">
            <div class="footer-bottom-area">
                <div class="left">
                    <p>Nhóm @2022.</p>
                </div>
                <ul class="links">
                    <li>
                        <a href="#">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/modernizr-3.6.0.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/heandline.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/countdown.min.js"></script>
<script src="assets/js/odometer.min.js"></script>
<script src="assets/js/viewport.jquery.js"></script>
<script src="assets/js/nice-select.js"></script>
<script src="assets/js/main.js"></script>
<script>
    function redirectParams(name, value) {
        var url = new URL(window.location.href);
        url.searchParams.set(name, value);
        window.location.href = url.href;
    }

    function pagination(num) {
        redirectParams('page', num);
    }

    function numberWithDot(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    }

    function chooseSeat(ma_lc, tg) {
        $('#thoi_gian_chieu').text(tg);
        $('#choose_seat').attr('href', 'movie-seat.php?ma_lc=' + ma_lc);
    }

    var seats = [];

    $(".seat-free img").on('click', function(e) {
        var seat = $(this).attr('id');
        if ($(this).data('booked')) {
            $(this).attr("src", "assets/img/movie/seat-1-free.png");
            $(this).data('booked', 0);
            seats = seats.filter(function(value) {
                return value.seat != seat;
            });
        } else {
            $(this).attr("src", "assets/img/movie/seat-1-booked.png");
            $(this).data('booked', 1);
            seats = seats.concat({
                seat: seat,
                vip: $(this).data('vip')
            });
        }
        getSeatsBooked();
    });

    function getSeatsBooked() {
        // console.log(seats);
        <?php
        $prices = new Price();
        $price = $prices->getPrices();
        echo 'var price1 = ' . $price[0]['gia_ve'] . ', price2 = ' . $price[1]['gia_ve'] . ';';
        ?>
        var a = '',
            b = 0;
        for (seat of seats) {
            a += seat.seat.replace('seat_', '') + ', ';
            b += seat.vip ? price2 : price1;
        }
        a = a.slice(0, -2);
        $('#seat_booked').text(a);
        $('#price').text(numberWithDot(b) + 'đ');
    }

    function checkout(ma_lc) {
        var seat = $('#seat_booked').text().replace(' ', '');
        if (seat.length > 0)
            window.location = 'movie-checkout.php?ma_lc=' + ma_lc + '&seats=' + seat;
    }
</script>
</body>

</html>
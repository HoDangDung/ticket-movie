<?php
class DB
{
    protected $conn;
    // public function __construct($conn)
    // {
    // 	$this->conn = $conn;
    // }
    function __construct()
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Không thể kết nối tới database!');
        mysqli_set_charset($conn, "utf8");
        $this->conn = $conn;
    }
    public function getConnection()
    {
        return $this->conn;
    }
    function __destruct()
    {
        mysqli_close($this->conn);
    }
    public function Offset($page = 1, $limit = DATA_PER_PAGE)
    {
        $limit = mysqli_escape_string($this->conn, $limit);
        if ($limit == 0) return '';
        $page = mysqli_escape_string($this->conn, $page);
        if ($page < 1 || !is_numeric($page)) $page = 1;
        $offset = ' LIMIT ' . (($page - 1) *  $limit) . ',' .  $limit;
        return $offset;
    }
}
class Admin
{
    public function login($password)
    {
        if (strtolower($password) == strtolower(ADMIN_PASSWORD)) return true;
        else return false;
    }
    public function startSession()
    {
        $_SESSION['admin'] = true;
    }
    public static function endSession()
    {
        unset($_SESSION['admin']);
    }
}
class User extends DB
{
    // $this->conn = $conn;
    public function validUser($username)
    {
        $username = mysqli_escape_string($this->conn, $username);
        $a = mysqli_query($this->conn, "SELECT * FROM users WHERE `user_email`='$username'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function encryptedPassword($password)
    {
        return md5($password);
    }
    public function login($email, $password)
    {
        $email = mysqli_escape_string($this->conn, $email);
        $pass = $this->encryptedPassword($password);
        $a = mysqli_query($this->conn, "SELECT * FROM khach_hang WHERE `email` = '$email' AND `mat_khau` = '$pass'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function register($email, $mat_khau, $ho_ten, $ngay_sinh, $gioi_tinh, $sdt, $dia_chi)
    {
        $a = $this->validUser($email);
        if ($a == false) {
            $email = mysqli_escape_string($this->conn, $email);
            $mat_khau = $this->encryptedPassword($mat_khau);
            $ho_ten = mysqli_escape_string($this->conn, $ho_ten);
            $ngay_sinh = mysqli_escape_string($this->conn, $ngay_sinh);
            $gioi_tinh = mysqli_escape_string($this->conn, $gioi_tinh);
            $sdt = mysqli_escape_string($this->conn, $sdt);
            $dia_chi = mysqli_escape_string($this->conn, $dia_chi);
            $b = mysqli_query($this->conn, "INSERT INTO `khach_hang` (`email`, `mat_khau`, `ho_ten`, `ngay_sinh`, `gioi_tinh`, `sdt`, `dia_chi`)
                                                                VALUES ('$email', '$mat_khau', '$ho_ten', '$ngay_sinh', '$gioi_tinh', '$sdt', '$dia_chi')");
            if ($b)
                return true;
            else
                return false;
        } else return false;
    }
    public function getCount()
    {
        $total = mysqli_query($this->conn, "SELECT COUNT(ma_kh) AS total FROM khach_hang");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function getUsers()
    {
        $a = mysqli_query($this->conn, "SELECT * FROM khach_hang ORDER BY ma_kh DESC");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) {
                unset($row['mat_khau']);
                $b = array_merge($b, array($row));
            }
        return $b;
    }
    public function getUser($user_id)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $a = mysqli_query($this->conn, "SELECT * FROM khach_hang WHERE `ma_kh` = '$user_id'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function updateUser($ma_kh, $email, $ho_ten, $ngay_sinh, $gioi_tinh, $sdt, $dia_chi)
    {
        $a = $this->getUser($ma_kh);
        if ($a != false) {
            $email = mysqli_escape_string($this->conn, $email);
            $ho_ten = mysqli_escape_string($this->conn, $ho_ten);
            $ngay_sinh = mysqli_escape_string($this->conn, $ngay_sinh);
            $gioi_tinh = mysqli_escape_string($this->conn, $gioi_tinh);
            $sdt = mysqli_escape_string($this->conn, $sdt);
            $dia_chi = mysqli_escape_string($this->conn, $dia_chi);
            $b = mysqli_query($this->conn, "UPDATE khach_hang SET `email` = '$email', `ho_ten` = '$ho_ten', `ngay_sinh` = '$ngay_sinh', `gioi_tinh` = '$gioi_tinh',
															`sdt` = '$sdt', `dia_chi` = '$dia_chi' WHERE ma_kh = $ma_kh");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function changePassword($user_id, $user_password)
    {
        $a = $this->getUser($user_id);
        if ($a != false) {
            $user_id = mysqli_escape_string($this->conn, $user_id);
            $user_password = $this->encryptedPassword($user_password);
            $b = mysqli_query($this->conn, "UPDATE khach_hang SET `mat_khau` = '$user_password' WHERE ma_kh = $user_id");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function startSession($user)
    {
        $_SESSION['ma_kh'] = $user['ma_kh'];
        $_SESSION['ho_ten'] = $user['ho_ten'];
        $_SESSION['email'] = $user['email'];
        return true;
    }
    public function updateSession($user_fullname = '', $user_email = '')
    {
        if ($user_fullname != '') $_SESSION['ho_ten'] = $user_fullname;
        if ($user_email != '') $_SESSION['email'] = $user_email;
        return true;
    }
    public static function endSession()
    {
        // session_destroy();
        unset($_SESSION['ma_kh']);
        unset($_SESSION['ho_ten']);
        unset($_SESSION['email']);
    }
}
class Movie extends DB
{
    public function search($keyword,  $page = 1, $limit = DATA_PER_PAGE)
    {
        $keyword = mysqli_escape_string($this->conn, $keyword);
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn, "SELECT * FROM phim WHERE MATCH(ten_phim) AGAINST ('$keyword') OR ten_phim LIKE ('%$keyword%') " . $offset);
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function getCountSearch($keyword)
    {
        $keyword = mysqli_escape_string($this->conn, $keyword);
        $total = mysqli_query($this->conn, "SELECT COUNT(ma_phim) AS total FROM products WHERE MATCH(ten_phim) AGAINST ('$keyword') OR ten_phim LIKE ('%$keyword%')");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function getCount()
    {
        $total = mysqli_query($this->conn, "SELECT COUNT(ma_phim) AS total FROM phim");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function getMovies($page = 1, $limit = DATA_PER_PAGE, $an_phim = 1)
    {
        // $an_phim = mysqli_escape_string($this->conn, $an_phim);
        $where = '';
        switch ($an_phim) {
            case 0:
            case 1:
                $where = "WHERE an_phim = '$an_phim'";
                break;
            default:
                break;
        }
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn, "SELECT * FROM phim " . $where . " " . $offset);
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function getMovie($ma_phim)
    {
        $ma_phim = mysqli_escape_string($this->conn, $ma_phim);
        $a = mysqli_query($this->conn, "SELECT * FROM phim WHERE ma_phim = '$ma_phim'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        return $b;
    }
    public function getMovieWithType($ma_phim)
    {
        $ma_phim = mysqli_escape_string($this->conn, $ma_phim);
        $a = mysqli_query($this->conn, "SELECT P.ma_phim, LP.* FROM phim P LEFT JOIN phim_loaiphim PLP ON P.ma_phim = PLP.ma_phim LEFT JOIN loai_phim LP ON PLP.ma_lp = LP.ma_lp WHERE P.ma_phim = '$ma_phim'");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function postMovie($ten_phim, $anh_bia, $link_trailer, $nha_san_xuat, $mo_ta, $thoi_luong, $ma_gh, $an_phim)
    {
        $ten_phim = mysqli_escape_string($this->conn, $ten_phim);
        $anh_bia = mysqli_escape_string($this->conn, $anh_bia);
        $link_trailer = mysqli_escape_string($this->conn, $link_trailer);
        $nha_san_xuat = mysqli_escape_string($this->conn, $nha_san_xuat);
        $mo_ta = mysqli_escape_string($this->conn, $mo_ta);
        $thoi_luong = mysqli_escape_string($this->conn, $thoi_luong);
        $ma_gh = mysqli_escape_string($this->conn, $ma_gh);
        $an_phim = mysqli_escape_string($this->conn, $an_phim);

        $a = mysqli_query($this->conn, "INSERT INTO phim (ten_phim, anh_bia, link_trailer, nha_san_xuat, mo_ta, thoi_luong, ma_gh, an_phim)
                                                VALUES ('$ten_phim', '$anh_bia', '$link_trailer', '$nha_san_xuat', '$mo_ta', '$thoi_luong', '$ma_gh', '$an_phim')");
        if ($a) return true;
        else return false;
    }
    public function updateMovie($ma_phim, $ten_phim, $anh_bia, $link_trailer, $nha_san_xuat, $mo_ta, $thoi_luong, $ma_gh, $an_phim)
    {
        $a = $this->getMovie($ma_phim);
        if ($a != false) {
            $ma_phim = mysqli_escape_string($this->conn, $ma_phim);
            $ten_phim = mysqli_escape_string($this->conn, $ten_phim);
            $anh_bia = mysqli_escape_string($this->conn, $anh_bia);
            $link_trailer = mysqli_escape_string($this->conn, $link_trailer);
            $nha_san_xuat = mysqli_escape_string($this->conn, $nha_san_xuat);
            $mo_ta = mysqli_escape_string($this->conn, $mo_ta);
            $thoi_luong = mysqli_escape_string($this->conn, $thoi_luong);
            $ma_gh = mysqli_escape_string($this->conn, $ma_gh);
            $an_phim = mysqli_escape_string($this->conn, $an_phim);

            $b = mysqli_query($this->conn, "UPDATE `phim` SET `ten_phim`='$ten_phim',`anh_bia`='$anh_bia',`link_trailer`='$link_trailer',`nha_san_xuat`='$nha_san_xuat',`mo_ta`='$mo_ta',`thoi_luong`='$thoi_luong',`ma_gh`='$ma_gh',an_phim='$an_phim' WHERE ma_phim = '$ma_phim'");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function getShowtimesAll()
    {
        $a = mysqli_query($this->conn, "SELECT LC.*, P.ten_phim, R.ten_rap FROM lich_chieu LC LEFT JOIN phim P ON LC.ma_phim = P.ma_phim LEFT JOIN rap_phim R ON LC.ma_rap = R.ma_rap ORDER BY ma_lc DESC");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function getShowtimes($ma_phim)
    {
        $ma_phim = mysqli_escape_string($this->conn, $ma_phim);
        $a = mysqli_query($this->conn, "SELECT GROUP_CONCAT(LC.ma_lc SEPARATOR '|') as lc, GROUP_CONCAT(LC.thoi_gian_chieu SEPARATOR '|') as tgc, R.* FROM lich_chieu LC LEFT JOIN rap_phim R ON LC.ma_rap = R.ma_rap WHERE ma_phim = '$ma_phim' GROUP BY R.ten_rap ORDER BY thoi_gian_chieu ASC");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function getShowtime($ma_lc)
    {
        $ma_lc = mysqli_escape_string($this->conn, $ma_lc);
        $a = mysqli_query($this->conn, "SELECT LC.*, P.ten_phim, P.thoi_luong, R.ten_rap FROM lich_chieu LC LEFT JOIN phim P ON LC.ma_phim = P.ma_phim LEFT JOIN rap_phim R ON LC.ma_rap = R.ma_rap WHERE LC.ma_lc = '$ma_lc'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        return $b;
    }
    public function postShowtime($ma_phim, $ma_rap, $thoi_gian_chieu)
    {
        $a = $this->getMovie($ma_phim);
        if ($a != false) {
            $ma_phim = mysqli_escape_string($this->conn, $ma_phim);
            $ma_rap = mysqli_escape_string($this->conn, $ma_rap);
            $thoi_gian_chieu = mysqli_escape_string($this->conn, $thoi_gian_chieu);
            $thoi_gian_chieu = str_replace('T', ' ', $thoi_gian_chieu);

            $b = mysqli_query($this->conn, "INSERT INTO lich_chieu (ma_phim, ma_rap, thoi_gian_chieu)
                                                            VALUES ('$ma_phim', '$ma_rap', '$thoi_gian_chieu')");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function updateShowtime($ma_lc, $ma_rap, $thoi_gian_chieu)
    {
        $a = $this->getShowtime($ma_lc);
        if ($a != false) {
            $ma_rap = mysqli_escape_string($this->conn, $ma_rap);
            $thoi_gian_chieu = mysqli_escape_string($this->conn, $thoi_gian_chieu);
            $thoi_gian_chieu = str_replace('T', ' ', $thoi_gian_chieu);

            $b = mysqli_query($this->conn, "UPDATE lich_chieu SET ma_rap = '$ma_rap', thoi_gian_chieu = '$thoi_gian_chieu' WHERE ma_lc = '$ma_lc'");
            if ($b) return true;
            else return false;
        } else return false;
    }
}
class Theater extends DB
{
    public function getTheaters()
    {
        $a = mysqli_query($this->conn, "SELECT * FROM rap_phim");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
}
class Price extends DB
{
    public function getPrices()
    {
        $a = mysqli_query($this->conn, "SELECT * FROM loai_ve");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function calculatePrice($seats)
    {
        $prices = $this->getPrices();
        $total = 0;
        foreach (explode(',', $seats) as $k => $v) {
            $a = str_split($v)[0];
            $b = substr($v, 1);
            // var_dump($a, $b);
            if ($a >= 'D' && $a <= 'F' && $b >= 5 && $b <= 10) $total += $prices[1]['gia_ve'];
            else $total += $prices[0]['gia_ve'];
        }
        return $total;
    }
    public function getRevenue()
    {
        $total = mysqli_query($this->conn, "SELECT SUM(gia_ve) AS total FROM ve_phim VP LEFT JOIN loai_ve LV ON VP.ma_lv = LV.ma_lv");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
}
class Ticket extends DB
{
    public function postTicket($ma_lc, $ma_kh, $seats)
    {
        $ma_lc = mysqli_escape_string($this->conn, $ma_lc);
        $ma_kh = mysqli_escape_string($this->conn, $ma_kh);
        $ngay_dat_ve = date("Y-m-d", time());
        $prices = new Price();
        $price = $prices->getPrices();
        foreach (explode(',', $seats) as $k => $v) {
            $v = mysqli_escape_string($this->conn, $v);
            $a = str_split($v)[0];
            $b = substr($v, 1);
            if ($a >= 'D' && $a <= 'F' && $b >= 5 && $b <= 10) $ma_lv = $price[1]['ma_lv'];
            else $ma_lv = $price[0]['ma_lv'];
            mysqli_query($this->conn, "INSERT INTO ve_phim (ma_lv, ma_lc, ma_kh, so_ghe, ngay_dat_ve)
                                                        VALUES ('$ma_lv', '$ma_lc', '$ma_kh', '$v', '$ngay_dat_ve')");
        }
        return true;
    }
    public function getTickets()
    {
        $a = mysqli_query($this->conn, "SELECT VP.*, LV.ten_lv, LV.gia_ve, P.ma_phim, P.ten_phim, LC.thoi_gian_chieu, R.ten_rap FROM ve_phim VP LEFT JOIN loai_ve LV ON VP.ma_lv = LV.ma_lv LEFT JOIN lich_chieu LC ON VP.ma_lc = LC.ma_lc LEFT JOIN phim P ON LC.ma_phim = P.ma_phim LEFT JOIN rap_phim R ON R.ma_rap = LC.ma_rap ORDER BY VP.ngay_dat_ve DESC");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function getTicketsByUserId($ma_kh)
    {
        $ma_kh = mysqli_escape_string($this->conn, $ma_kh);
        $a = mysqli_query($this->conn, "SELECT VP.*, LV.ten_lv, LV.gia_ve, P.ma_phim, P.ten_phim, LC.thoi_gian_chieu, R.ten_rap FROM ve_phim VP LEFT JOIN loai_ve LV ON VP.ma_lv = LV.ma_lv LEFT JOIN lich_chieu LC ON VP.ma_lc = LC.ma_lc LEFT JOIN phim P ON LC.ma_phim = P.ma_phim LEFT JOIN rap_phim R ON R.ma_rap = LC.ma_rap WHERE ma_kh = '$ma_kh' ORDER BY VP.ngay_dat_ve DESC");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
    public function getCount()
    {
        $total = mysqli_query($this->conn, "SELECT COUNT(ma_vp) AS total FROM ve_phim");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
}
class AgeLimit extends DB
{
    public function getAgeLimit()
    {
        $a = mysqli_query($this->conn, "SELECT * FROM gioi_han_do_tuoi");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        return $b;
    }
}

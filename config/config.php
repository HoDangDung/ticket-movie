<?php
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'quan_ly_rap_phim');

define('ADMIN_PASSWORD', '321'); // Mật khẩu đăng nhập Admin
define('DATA_PER_PAGE', 10); // Số dữ liệu hiển thị trên mỗi trang

require_once('function.php');
require_once('class.php');

new DB();

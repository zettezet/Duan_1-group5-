<?php

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

// Đường dẫn vào đến phần client
define('BASE_URL', 'http://localhost/web_ban_tra_sua/Duan_1-group5-/web_ban_tra_sua/');

// Đường dẫn vào đến phần admin
define('BASE_URL_ADMIN', 'http://localhost/web_ban_tra_sua/Duan_1-group5-/web_ban_tra_sua/admin/');


define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'webtrasua');  // Tên database

define('PATH_ROOT', __DIR__ . '/../');

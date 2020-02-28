<?php
//error_reporting(E_ERROR | E_PARSE);
define('SERVER_BASE', 'localhost/aktdagang');

define('SQL_USER', 'root');
define('SQL_PASSWORD', '123456');
define('SQL_DB', 'aktdagang_db');
define('SQL_HOST', 'localhost');

$config['con'] = mysqli_connect(SQL_HOST,SQL_USER,SQL_PASSWORD,SQL_DB);

define('CS_TIME_OUT', 86400);

define('SMARTY_DATETIME_FORMAT', '%d/%m/%Y %l:%M%p');
define('SMARTY_DATE_FORMAT', '%d/%m/%Y');
define('SMARTY_TIME_FORMAT', '%l:%M%p');

// define('PAGER_PER_PAGE_CONSOLE', 20);
define('PAGER_FIRST_PAGE_TEXT', "<span class=\"fas fa-chevron-left\"></span><span class=\"fas fa-chevron-left\"></span>");
define('PAGER_LAST_PAGE_TEXT', "<span class=\"fas fa-chevron-right\"></span><span class=\"fas fa-chevron-right\"></span>");
define('PAGER_PREVIOUS_PAGE_TEXT', "<span class=\"fas fa-chevron-left\"></span>");
define('PAGER_NEXT_PAGE_TEXT', "<span class=\"fas fa-chevron-right\"></span>");

define('PAGER_SCROLL_PAGE', 5);
define('PAGER_PER_PAGE', 4);
define('PAGER_PER_PAGE_CONSOLE', 10);
//define('PAGER_PER_PAGE_PRODUCTS', 12);
define('PAGER_INACTIVE_PAGE_TAG', 'class="active"');
/*
define('PAGER_PREVIOUS_PAGE_TEXT', '&lt;');
define('PAGER_NEXT_PAGE_TEXT', '&gt;');
define('PAGER_FIRST_PAGE_TEXT', '&lt;&lt;');
define('PAGER_LAST_PAGE_TEXT', '&gt;&gt;');
define('PAGER_TAG_CONTAINER', 'li');
*/

$config['default_class'] = 'Dashboard';
$config['default_method'] = 'LoadDefault';

define('PROJECT_NAME', "Sistem Informasi Akuntansi Dagang - Alpha");

$config['dk_options'] = array(1 => 'D', 2 => 'K');
$config['nrlr_options'] = array(1 => 'NR', 2 => 'LR');

$config['bulan_options'] = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
);

$config['bulan3_options'] = array(
    1 => 'Jan',
    2 => 'Feb',
    3 => 'Mar',
    4 => 'Apr',
    5 => 'Mei',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Agu',
    9 => 'Sep',
    10 => 'Okt',
    11 => 'Nov',
    12 => 'Des'
);

?>

<?php
	define('protocol', 'http://');
	define('ver', '0.0.1');
	define('lang', 'ru');
    define('root_dir',protocol.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']);
	define('developer', 0);
	define('start', microtime(true));
	define('postPerPage', 15);
	define('maxVisPages', 5);
	define('mainurl', 'softpomoyka.ru');
	define('template', 'unclestore');
	define('tpl_path', '/templates/getup/'.template.'/');

	//mysql db config
	define ( 'my_db_user', "a0906321_pomoyka");
	define ( 'my_db_pass', "VfXgQZyL" );//fKIZWv5v
	define ( 'my_db_serv', "141.8.192.6");
	define ( 'my_db_db', "a0906321_pomoyka");
?>
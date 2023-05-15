<?php
	define('protocol', 'http://');
	define('ver', '0.0.1');
	define('lang', 'ru');
    define('root_dir',protocol.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']);
	define('developer', 0);
	define('start', microtime(true));
	//define('template', 'default');
	define('template', 'goodtimes');

	//mysql db config
	define ( 'my_db_user', "a0818268_pomoyka");
	define ( 'my_db_pass', "rjkzcbrb" );
	define ( 'my_db_serv', "a0818268.xsph.ru");
	define ( 'my_db_db', "a0818268_pomoyka");
    //telnet a0818268.xsph.ru 3306
?>
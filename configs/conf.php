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
	define ( 'my_db_user', "root");
	define ( 'my_db_pass', "0000" );
	define ( 'my_db_serv', "localhost");
	define ( 'my_db_db', "umcms");
?>
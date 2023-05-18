<?php
/***
 * Name:       TinyMVC
 * About:      An MVC application framework for PHP
 * Copyright:  (C) 2007, New Digital Group Inc.
 * Author:     Monte Ohrt, monte [at] ohrt [dot] com
 * License:    LGPL, see included license file  
 ***/
/* PHP error reporting level, if different from default */
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);
/* if the /tinymvc/ dir is not up one directory, uncomment and set here */
//define('TMVC_BASEDIR','../tinymvc/');
/* if the /umcms/ dir is not inside the /tinymvc/ dir, uncomment and set here */
//define('TMVC_umcmsDIR','/path/to/umcms/');
/* define to 0 if you want errors/exceptions handled externally */
define('TMVC_ERROR_HANDLING',1);
/* directory separator alias */
if(!defined('DS'))
  define('DS',DIRECTORY_SEPARATOR);

/* set the base directory */
if(!defined('TMVC_BASEDIR'))
  define('TMVC_BASEDIR',dirname(__FILE__) . DS . 'tinymvc' . DS);

/* include default tmvc class */
require(TMVC_BASEDIR . 'sysfiles' . DS . 'TinyMVC.php');
session_start();
$modules = array();
/* instantiate */
$tmvc = new tmvc();
$tmvc = tmvc::instance();
//$tmvc->controller->load->Menu_Model; 
/* tally-ho! */
$tmvc->main();
?>

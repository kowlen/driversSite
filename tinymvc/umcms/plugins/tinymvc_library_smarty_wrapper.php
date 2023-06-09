<?php

// important so the TinyMVC and Smarty autoloaders work together!
define('SMARTY_SPL_AUTOLOAD', 1);
 
// require the Smarty class
require('libs/smarty/Autoloader.php');
Smarty_Autoloader::register();
 
class TinyMVC_Library_Smarty_Wrapper Extends Smarty
{
  function __construct()
  {
    parent::__construct();
    $this->setTemplateDir('getup/');
    $this->setCompileDir('temp/');
    $this->setConfigDir('tinymvc/umcms/configs/');
    $this->setCacheDir('cache/');
        
        $this->configLoad('main.conf');
  }
}

?>
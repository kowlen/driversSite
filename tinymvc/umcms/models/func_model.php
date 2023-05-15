<?php
require_once('/configs/conf.php');

class Func_Model extends TinyMVC_Model
{
  	public $db_ora;
	public function __construct()
	{
		//$this->db_mysql= new Db_mysql_Model();
	}

    function array_to_xml( $data, &$xml_data ) {
        foreach( $data as $key => $value ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with <0/>..<n/> issues
            }
            if( is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }

    function time_execute(){
        if (developer == 1)
            printf(function_script_execute, microtime(true) - start);
    }

	function clean_var($data){
        return htmlspecialchars(trim($data));
    }

    function clean_get(){
        if (!empty($_GET)) {
            $new_get = array_filter($_GET);
            if (count($new_get) < count($_GET)) {
                $request_uri = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], PHP_URL_PATH);
                header('Location: ' . $request_uri . '?' . http_build_query($new_get));
                exit;
            }
        }
    }

    function data_encode($str){
        $pub = <<<WEBEKPAUTH
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mq
aH9/GnWjGavZM02fos4lc2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQ==
-----END PUBLIC KEY-----
WEBEKPAUTH;
        $pk  = openssl_get_publickey($pub);
        openssl_public_encrypt($str, $encrypted, $pk);
        $data = chunk_split(base64_encode($encrypted));
        return $data;
    }

    function data_decode($hash){
        $key = <<<WEBEKPAUTH
-----BEGIN RSA PRIVATE KEY-----
MIIBPQIBAAJBALqbHeRLCyOdykC5SDLqI49ArYGYG1mqaH9/GnWjGavZM02fos4l
c2w6tCchcUBNtJvGqKwhC5JEnx3RYoSX2ucCAwEAAQJBAKn6O+tFFDt4MtBsNcDz
GDsYDjQbCubNW+yvKbn4PJ0UZoEebwmvH1ouKaUuacJcsiQkKzTHleu4krYGUGO1
mEECIQD0dUhj71vb1rN1pmTOhQOGB9GN1mygcxaIFOWW8znLRwIhAMNqlfLijUs6
rY+h1pJa/3Fh1HTSOCCCCWA0NRFnMANhAiEAwddKGqxPO6goz26s2rHQlHQYr47K
vgPkZu2jDCo7trsCIQC/PSfRsnSkEqCX18GtKPCjfSH10WSsK5YRWAY3KcyLAQIh
AL70wdUu5jMm2ex5cZGkZLRB50yE6rBiHCd5W1WdTFoe
-----END RSA PRIVATE KEY-----
WEBEKPAUTH;
        $pk  = openssl_get_privatekey($key);
        openssl_private_decrypt(base64_decode($hash), $out, $pk);
        return $out;
    }
	
	function translit($str)
	{
		$tr = array(
			"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
			"Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
			"Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
			"Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"'","э"=>"e","ю"=>"yu","я"=>"ya",
		"."=>"_"," "=>"_","?"=>"_","/"=>"_","\\"=>"_",
		"*"=>"_",":"=>"_","*"=>"_","\""=>"_","<"=>"_",
		">"=>"_","|"=>"_"
		);
		return strtr($str, $tr);
	}

	function translitnotdot($str)
	{
		$tr = array(
			"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
			"Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
			"Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
			"Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
		"."=>"."," "=>"_","?"=>"_","/"=>"_","\\"=>"_",
		"*"=>"_",":"=>"_","*"=>"_","\""=>"_","<"=>"_",
		">"=>"_","|"=>"_","\""=>"","'|'"=>""
		);
		return strtr($str, $tr);
	}
	
	function reverseword($str)
	{
		$tr = array(
			"Й"=>"Q","Ц"=>"W","У"=>"E","К"=>"R",
			"Е"=>"T","Н"=>"Y","Г"=>"U","Ш"=>"I","Щ"=>"O",
			"З"=>"P","Х"=>"{","Ъ"=>"}","Ф"=>"A","Ы"=>"S",
			"В"=>"D","А"=>"F","П"=>"G","Р"=>"H","О"=>"J",
			"Л"=>"K","Д"=>"L","Ж"=>":","Э"=>"\"","Я"=>"Z",
			"Ч"=>"X","С"=>"C","М"=>"V","И"=>"B","Т"=>"N",
			"Ь"=>"M","Б"=>"<","Ю"=>">","й"=>"q","ц"=>"w",
			"у"=>"e","к"=>"r","е"=>"t","н"=>"y","г"=>"u",
			"ш"=>"i","щ"=>"o","з"=>"p","х"=>"[","ъ"=>"]",
			"ф"=>"a","ы"=>"s","в"=>"d","а"=>"f","п"=>"g",
			"р"=>"h","о"=>"j","л"=>"k","д"=>"l","ж"=>";",
			"э"=>"'","я"=>"z","ч"=>"x","с"=>"c","м"=>"v",
			"и"=>"b","т"=>"n","ь"=>"m","б"=>",","ю"=>"."
		);
		return strtr($str, $tr);
	}

    function request_url()
    {
        $result = '';
        /*$default_port = 80;
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
            $result .= 'https://';
            $default_port = 443;
        } else {
            $result .= 'http://';
        }
        $result .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != $default_port) {
            $result .= ':'.$_SERVER['SERVER_PORT'];
        }*/
        $result .= $_SERVER['REQUEST_URI'];
        return $result;
    }

}
?>
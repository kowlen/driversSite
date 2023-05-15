<?php
require_once('/configs/conf.php');
class Parser_gt_Controller extends TinyMVC_Controller
{
    function index(){
        $this->load->model('Db_MySQL_Model','db');

        $title = 'umcms';

        $this->smarty->assign("title", $title);
        $this->smarty->assign("main_content_template", "templates/getup/default/main.html");
        $this->smarty->display('/templates/getup/default/index.html');
    }
	
	function test(){
		$this->load->model('Utilites_Model','util');
        $sourcelist = file_get_contents('https://deti-online.com/audioskazki/?dt_length=25');
		 preg_match_all('/class=\"dt-a\" href=\"(.*?)\" data-author=\"(.*?)\">(.*?)</is', $sourcelist, $matches);
		//print_r($matches);
        for ($i = 0; $i < count($matches[1]); $i++){
            //create folder
            $dir = "./uncleLoader/audio/tales/". $this->util->translitnotdot($matches[2][$i]) . "/". $this->util->translitnotdot($matches[3][$i]) . "/";
            if (!is_dir($dir))
                mkdir($dir, 0777, true);

			echo $matches[1][$i]."_".$matches[2][$i]."_".$matches[3][$i]."<br>";
			
			$sourcelist_details = file_get_contents($matches[1][$i]);
			$desc = '------------<br>';
			if ($matches[1][$i] != 'https://deti-online.com/audioskazki/povesti-i-romany-mp3/garri-potter/'){
                preg_match_all('/<p>(.*?)<\/p>/is', $sourcelist_details, $matches_desc);
                for ($g = 0; $g < count($matches_desc[0]); $g++) {

                    if (strpos($matches_desc[1][$g], 'img') == true) {
                        preg_match_all('/src=\"(.*?)\.(.*?)\"(.*?)alt=\"(.*?)\"/is', $matches_desc[1][$g], $img);

                        $file = "$dir" . $this->util->translitnotdot($matches[2][$i]) . "ban_03102016". time() . "." . $img[2][0];
                        if (!file_exists($file)) {
                            $fp = fopen($file, "w");
                            fwrite($fp, file_get_contents("https://deti-online.com".$img[1][0].".".$img[2][0]));
                            fclose($fp);
                        }
                        $desc .= "<img src='".substr($file, 1)."'></img><br>";
                    }else{
                        $desc .= $matches_desc[1][$g]."<br>";
                    }
                }
                $desc .= '<br></br>------------<br>';
                print_r($desc);

				preg_match_all('/data-f=\"(.*?)\"(.*?)class=\"t\">(.*?)<\/span>(.*?)class=\"time\">(.*?)<\/div>/is', $sourcelist_details, $matches_details);
				//print_r($matches_details);
				for ($d = 0; $d < count($matches_details[1]); $d++){
					echo $matches_details[1][$d]."_".$matches_details[3][$d]."_".$matches_details[5][$d]."<br>";

					$file = "$dir" . $this->util->translitnotdot($matches_details[3][$d]) . ".mp3";
					if (!file_exists($file)) {
						$fp = fopen($file, "w");
						fwrite($fp, file_get_contents($matches_details[1][$d]));
						fclose($fp);
					}
					//if ($d>0) return;
				}
			}

		}if ($i>0) return;
            //echo "<img src='".$matches[1][$i]."'><br />";
    }

}
?>
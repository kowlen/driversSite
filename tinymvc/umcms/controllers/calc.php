<?php
require_once('/configs/conf.php');
class Calc_Controller extends TinyMVC_Controller
{
    function index(){
        $this->load->model('Db_MySQL_Model','db');

        $title = 'umcms';

        $this->smarty->assign("title", $title);
        $this->smarty->assign("main_content_template", "templates/getup/default/main.html");
        $this->smarty->display('/templates/getup/default/index.html');
    }

    function areaOfRectangle(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Calc_Model','calc');
        $this->load->model('Utilites_Model','utilites');

        $title = 'Расчет площади прямоугольника';

        $action = isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action'] : 'default';

        switch ($action) {
            case 'calc':
                $xa = isset($_POST['xa']) && !empty($_POST['xa']) ? $_POST['xa'] : user_error('[xa] undefined');
                $xb = isset($_POST['xb']) && !empty($_POST['xb']) ? $_POST['xb'] : user_error('[xb] undefined');

                $data = $this->calc->areaOfRectangle($xa, $xb);
                $data = $this->utilites->nicenum($data);
                $this->utilites->printJson($data);
                break;
            case 'img':
                $xa = isset($_GET['xa']) && !empty($_GET['xa']) ? $_GET['xa'] : user_error('[xa] undefined');
                $xb = isset($_GET['xb']) && !empty($_GET['xb']) ? $_GET['xb'] : user_error('[xb] undefined');
                //$img = ImageCreateFromPNG("templates/getup/".template."/calc/img/areaOfRectangle.png");
                // определяем цвет, в RGB
                //$color = imagecolorallocate($img, 255, 0, 0);
                // указываем путь к шрифту
                //$font = 'templates/static/fonts/montserrat/montserrat.ttf';
                //$text = 'source';
                //imagettftext($img, 14, 0, 0, 0, $color, $font, $text);
                // 24 - размер шрифта
                // 0 - угол поворота
                // 365 - смещение по горизонтали
                // 159 - смещение по вертикали
                //header('Content-type: image/png');
//                imagepng($img);

                /*$sOrigImg = "templates/getup/".template."/calc/img/areaOfRectangle.png";
                $font = 'templates/static/fonts/montserrat/montserrat.ttf';
                //$sWmImg = "watermark.png";

                $aImgInfo = getimagesize($sOrigImg);
                //$aWmImgInfo = getimagesize($sWmImg);
                if (is_array($aImgInfo)) {
                    header ("Content-type: image/png");

                    $iSrcWidth = $aImgInfo[0];
                    $iSrcHeight = $aImgInfo[1];

                    $iFrameSize = 15;

                    //$rImage = imagecreatetruecolor($iSrcWidth+$iFrameSize*2, $iSrcHeight+$iFrameSize*2); // Создаем новое изображение
                    $rSrcImage = imagecreatefrompng($sOrigImg); //  Создаем исходное изображение


                    $iTextColor = imagecolorallocate($rSrcImage, 0, 0, 0); // Определяем цвет текста
                    imagestring($rSrcImage, 5, $iFrameSize*2, $iFrameSize*2, " Адрес: Your IP adress:", $iTextColor); // Рисуем текст

                    imagepng($rSrcImage); // Выводим изображение
                } else {
                    echo 'Image error!';
                    exit;
                }*/
                //header('Content-type: image/png');
                $img = "templates/getup/".template."/calc/img/areaOfRectangle.jpg"; // Ссылка на файл
                $font = 'templates/static/fonts/arial/arial.ttf';
                $image=imageCreateFromJpeg($img);
                $imgInfo = getimagesize($img);
                $xc = $imgInfo[0]/2;
                $yc = $imgInfo[1]/2;
                //imageString($image, 3, 20, 60, $xb, 000);
                $color = imagecolorallocate($image, 0, 0, 0);


                imagettftext($image, 12, 0, $xc-20, 35, $color, $font, $xa);
                imagettftext($image, 12, 270, (($imgInfo[0])-12), $yc-20, $color, $font, $xb);
                //вывод получившейся картинки
                header('Content-type: image/png');
                imagepng($image);
                imagedestroy($image);
                break;
            default:
                $this->smarty->assign("title", $title);
                $this->smarty->assign("main_content_template", "templates/getup/default/calc/areaOfRectangle.html");
                $this->smarty->display('/templates/getup/default/index.html');
        }


    }



}
?>
<?php

class Utilites_model extends TinyMVC_Model
{
    /*//sort array
    $dateArray = [];
    foreach($result['comments'] as $k=>$v) {
    $dateArray[$k] = $v['DAT'];
    }
    array_multisort($dateArray, SORT_STRING, $result['comments']);*/

    function customMultiSort($array,$field) {
        $sortArr = array();
        foreach($array as $key=>$val){
            $sortArr[$key] = $val[$field];
        }

        array_multisort($sortArr,$array);

        return $array;
    }

    function array_unique_key($array, $key) {
        $tmp = $key_array = array();
        $i = 0;

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                array_push($tmp, $val);
            }
            $i++;
        }
        return $tmp;
    }

    function nicenum($val)
    {
        $plus=(stristr($val, '+'))?"+":"";

        if (is_numeric($val)&&$val!=0){
            $val2 = floatval($val);
            $per = (floor($val2) != $val2) ? 2 : 0;
            return $plus.number_format($val, $per, ',', ' ');
        }else{
            $val = str_replace(",", ".", $val);
            $val2 = floatval($val);
            $per = (floor($val2) != $val2) ? 2 : 0;
            return $plus.number_format($val2, $per, ',', ' ');
        }
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
            ">"=>"_","|"=>"_","\""=>"","'|'"=>"","'-'"=>"_"
        );
        return strtolower(strtr($str, $tr));
    }

    function num2char($s)
    {
        $tr = array(
            "1"=>"A",
            "2"=>"B",
            "3"=>"C",
            "4"=>"D",
            "5"=>"E",
            "6"=>"F",
            "7"=>"G",
            "8"=>"H",
            "9"=>"I",
            "10"=>"J",
            "11"=>"K",
            "12"=>"L",
            "13"=>"M",
            "14"=>"N",
            "15"=>"O",
            "16"=>"P",
            "17"=>"Q",
            "18"=>"R",
            "19"=>"S",
            "20"=>"T",
            "21"=>"U",
            "22"=>"V",
            "23"=>"W",
            "24"=>"X",
            "25"=>"Y",
            "26"=>"Z"

        );
        return strtr($s, $tr);
    }

    function data_to_excel($data, $need_npp = false)
    {
        $ret = array();
        $i = 1;

        foreach ($data as $key => $value) {
            $w = 1;
            foreach ($value as $k => $v) {
                if ($need_npp == true && $w == 1){
                    $ret[$key][$this->num2char($w++)] = $i;
                }
                $ret[$key][$this->num2char($w)] = $v;
                $w++;
            }
            $i++;
        }
        return $ret;
    }

    function data_to_row($data, $rows)
    {
        $ret = array();

        foreach ($data as $key => $value) {
            foreach ($rows as $k => $v) {
                $ret[$key][$v] = $value[$v];
            }
        }
        return $ret;
    }

    function exportXls($title, $template, $rows_align=array(), $headers, $head_col=1, $data, $data_col, $autosize=false)
    {
        require_once('libs/PHPExcel.php');
        $xls = PHPExcel_IOFactory::load('templates/_export/'.$template.'.xls');
        //фон
        $bg = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'e2efda')
            )
        );
        $bg_y = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'fff2cc')
            )
        );
        ////

        $xls->getProperties()->setTitle("ALTAN report");

        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $sheet->setCellValueExplicit("A1", $title, PHPExcel_Cell_DataType::TYPE_STRING);
        /*$sheet->mergeCells("B1:E1");
        $sheet->setCellValue("B1", "".$brigade_name);*/

        //Заполняем заголовки
        if ($headers) {
            foreach ($headers as $key => $value) {
                //print_r($value);
                $align = 'PHPExcel_Style_Alignment::HORIZONTAL_' . strtoupper($value[1]);
                $sheet->getStyle($key . $head_col)->applyFromArray($bg);
                $sheet->setCellValueExplicit($key . $head_col, $value[0], PHPExcel_Cell_DataType::TYPE_STRING);
                //Выравнивание
                switch (strtoupper($value[1])) {
                    case 'L':
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        break;
                    case 'R':
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        break;
                    case 'C':
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        break;
                    default:
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }

            }
        }
        //print_r($data);

        //Заполняем
        foreach ($data as $key => $value) {
            $row = $key+$data_col;
            //print_r($value);
            $rn = 0;
            foreach ($value as $k => $v) {
                /*print_r('--'.$k.$row);
                print_r('====='.$v."<br>");*/
                $sheet->setCellValueExplicit($k . $row, $v, PHPExcel_Cell_DataType::TYPE_STRING);
                //Выравнивание
                if (isset($rows_align[$rn])){
                    switch (strtoupper($rows_align[$rn])) {
                        case 'L':
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                            break;
                        case 'R':
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            break;
                        case 'C':
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            break;
                        default:
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    }
                }else{
                    $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $rn++;
            }

        }
        $border = array(
            'borders'=>array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        );

        // устанавливаем ширину столбцов
        if ($autosize==true){
            foreach(range('A',range('A', 'Z')[count($data)]) as $columnID) {
                $xls
                    ->getActiveSheet()
                    ->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }
        }

        $sheet->getStyle("A".$head_col.":".$this->num2char(count($value)).($row))->applyFromArray($border);


        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$title.".xls");

        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
        exit();
    }

    function truncate($text, $length = 100, $options = array()) {
        $default = array(
            'ending' => '...', 'exact' => true, 'html' => false
        );
        $options = array_merge($default, $options);
        extract($options);

        if ($html) {
            if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
            $totalLength = mb_strlen(strip_tags($ending));
            $openTags = array();
            $truncate = '';

            preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
            foreach ($tags as $tag) {
                if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                    if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                        array_unshift($openTags, $tag[2]);
                    } else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                        $pos = array_search($closeTag[1], $openTags);
                        if ($pos !== false) {
                            array_splice($openTags, $pos, 1);
                        }
                    }
                }
                $truncate .= $tag[1];

                $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
                if ($contentLength + $totalLength > $length) {
                    $left = $length - $totalLength;
                    $entitiesLength = 0;
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entitiesLength <= $left) {
                                $left--;
                                $entitiesLength += mb_strlen($entity[0]);
                            } else {
                                break;
                            }
                        }
                    }

                    $truncate .= mb_substr($tag[3], 0 , $left + $entitiesLength);
                    break;
                } else {
                    $truncate .= $tag[3];
                    $totalLength += $contentLength;
                }
                if ($totalLength >= $length) {
                    break;
                }
            }
        } else {
            if (mb_strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = mb_substr($text, 0, $length - mb_strlen($ending));
            }
        }
        if (!$exact) {
            $spacepos = mb_strrpos($truncate, ' ');
            if (isset($spacepos)) {
                if ($html) {
                    $bits = mb_substr($truncate, $spacepos);
                    preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                    if (!empty($droppedTags)) {
                        foreach ($droppedTags as $closingTag) {
                            if (!in_array($closingTag[1], $openTags)) {
                                array_unshift($openTags, $closingTag[1]);
                            }
                        }
                    }
                }
                $truncate = mb_substr($truncate, 0, $spacepos);
            }
        }
        $truncate .= $ending;

        if ($html) {
            foreach ($openTags as $tag) {
                $truncate .= '</'.$tag.'>';
            }
        }

        return $truncate;
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
        $result = $_SERVER['REQUEST_URI'];
        return $result;
    }

    function secure_hash($rows){
        $ret = array();
        $hash = "";
        foreach ($rows as $key => $value) {
            $hash = "dontWarMakeLove";
            foreach ($rows[$key] as $key2 => $v2) {
                $hash .= $v2;
            }
            $rows[$key]['hash'] = md5($hash."dontWarMakeLove");
        }
        return $rows;
    }

    function printJson($array){
        header('Content-Type: application/json');
        print_r(json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ));
    }

    function printJsonError($code ,$method,$exception){
        $array = [
            'code' => $code,
            'msg' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'method' => $method,
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'params' => [
                'GET' => $_GET,
            ]
        ];
        $this->printJson($array);
    }

    function httpRequest($type, $url, $body = '', $headers = 'Content-Type: application/json', $assoc = false){
        $options = [];
        $options['http']['method'] = $type;
        $options['http']['content'] = $body;
        $options['http']['header'] = $headers;

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result = $assoc ? json_decode($result, true) : $result;
        return $result;
    }

    function savePOSTFilesToDisk($path){
        // Название <input type="file">
        $input_name = 'files';

        // Разрешенные расширения файлов.
        $allow = array();

        // Запрещенные расширения файлов.
        $deny = array(
            'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
        );

        // Директория куда будут загружаться файлы.

        if (isset($_FILES[$input_name])) {
            // Проверим директорию для загрузки.
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
            $files = array();
            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES[$input_name]);
            } else {
                foreach($_FILES[$input_name] as $k => $l) {
                    foreach($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }
            }

            foreach ($files as $file) {
                $error = $success = '';

                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    switch (@$file['error']) {
                        case 1:
                        case 2: $error = 'Превышен размер загружаемого файла.'; break;
                        case 3: $error = 'Файл был получен только частично.'; break;
                        case 4: $error = 'Файл не был загружен.'; break;
                        case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
                        case 7: $error = 'Не удалось записать файл на диск.'; break;
                        case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
                        case 9: $error = 'Файл не был загружен - директория не существует.'; break;
                        case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
                        case 11: $error = 'Данный тип файла запрещен.'; break;
                        case 12: $error = 'Ошибка при копировании файла.'; break;
                        default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
                    }
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл.';
                } else {
                    $name =  $this->translitnotdot($file['name']);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension'])) {
                        $error = 'Недопустимое тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = 'Недопустимый тип файла';
                    } else {
                        // Чтобы не затереть файл с таким же названием, добавим префикс.
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];

                        // Перемещаем файл в директорию.
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            // Далее можно сохранить название файла в БД и т.п.
                            $success = 'Файл «' . $name . '» успешно загружен.';
                        } else {
                            $error = 'Не удалось загрузить файл.';
                        }
                    }
                }

                // Выводим сообщение о результате загрузки.
                if (!empty($success)) {
                    echo '<p>' . $success . '</p>';
                } else {
                    echo '<p>' . $error . '</p>';
                }
            }
        }
    }

    function export_excel($title, $template, $rows_align=array(), $headers, $head_col=1, $data, $data_col, $autosize=false)
    {
        require_once('libs/PHPExcel.php');
        $xls = PHPExcel_IOFactory::load('templates/_export/'.$template.'.xls');
        //фон
        $bg = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'e2efda')
            )
        );
        $bg_y = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'fff2cc')
            )
        );
        ////

        $xls->getProperties()->setTitle("ALTAN report");

        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $sheet->setCellValueExplicit("A".$head_col, $title, PHPExcel_Cell_DataType::TYPE_STRING);
        /*$sheet->mergeCells("B1:E1");
        $sheet->setCellValue("B1", "".$brigade_name);*/

        //Заполняем заголовки
        if ($headers) {
            foreach ($headers as $key => $value) {
                //print_r($value);
                $align = 'PHPExcel_Style_Alignment::HORIZONTAL_' . strtoupper($value[1]);
                $sheet->getStyle($key . $head_col)->applyFromArray($bg);
                $sheet->setCellValueExplicit($key . $head_col, $value[0], PHPExcel_Cell_DataType::TYPE_STRING);
                //Выравнивание
                switch (strtoupper($value[1])) {
                    case 'L':
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        break;
                    case 'R':
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        break;
                    case 'C':
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        break;
                    default:
                        $sheet->getStyle($key . $head_col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }

            }
        }
        //print_r($data);

        //Заполняем
        foreach ($data as $key => $value) {
            $row = $key+$data_col;
            //print_r($value);
            $rn = 0;
            foreach ($value as $k => $v) {
                //
                $null = (substr($v, 0, 1) == ',' || substr($v, 0, 1) == '.') ? '0' : '';
                $null2 = (substr($v, 0, 2) == '-,' || substr($v, 0, 2) == '-.') ? '-0' : '';
                $v = $null.$null2.$v;

                //
                if (is_numeric($v) || !empty($null) || !empty($null2)) {
                    $sheet->setCellValueExplicit($k . $row, $v, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                }else{
                    $sheet->setCellValueExplicit($k . $row, $v, PHPExcel_Cell_DataType::TYPE_STRING);
                }
                //Выравнивание
                if (isset($rows_align[$rn])){
                    switch (strtoupper($rows_align[$rn])) {
                        case 'L':
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                            break;
                        case 'R':
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            break;
                        case 'C':
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            break;
                        default:
                            $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    }
                }else{
                    $sheet->getStyle($k . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $rn++;
            }

            // устанавливаем ширину столбцов
            if ($autosize==true){
                foreach(range('A',range('A', 'Z')[count($value)]) as $columnID) {
                    $xls
                        ->getActiveSheet()
                        ->getColumnDimension($columnID)
                        ->setAutoSize(true);
                }
            }

            $border = array(
                'borders'=>array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            $sheet->getStyle("A".$head_col.":".$this->num2char(count($value)).($row))->applyFromArray($border);

        }
        /*$border = array(
            'borders'=>array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        );*/

        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$title.".xls");

        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
        exit();
    }

}

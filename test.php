<?php
    $need_count = 55; //сколько товара необходимо

    /*generate_data($need_count, 1);
    generate_data($need_count, 2);
    generate_data($need_count, 3);*/
    generate_data($need_count, 4);

    function generate_data($need_count, $example){
        $sellers_array = array(); //итоговый отчет закупки
        if ($example == 1){
            //example num 1 data
            $data[] = array(
                //item template
                'id'=>111,
                'count'=>42,
                'price'=>13,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>222,
                'count'=>77,
                'price'=>11,
                'pack'=>10
            );
            $data[] = array(
                //item template
                'id'=>333,
                'count'=>103,
                'price'=>10,
                'pack'=>50
            );
            $data[] = array(
                //item template
                'id'=>444,
                'count'=>65,
                'price'=>12,
                'pack'=>5
            );
        }else if ($example == 2) {
            //example num 2 data
            $data[] = array(
                //item template
                'id'=>111,
                'count'=>42,
                'price'=>9,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>222,
                'count'=>77,
                'price'=>11,
                'pack'=>10
            );
            $data[] = array(
                //item template
                'id'=>333,
                'count'=>103,
                'price'=>10,
                'pack'=>50
            );
            $data[] = array(
                //item template
                'id'=>444,
                'count'=>65,
                'price'=>12,
                'pack'=>5
            );
        }else if ($example == 3){
            //example num 3 data
            $data[] = array(
                //item template
                'id'=>111,
                'count'=>100,
                'price'=>30,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>222,
                'count'=>60,
                'price'=>11,
                'pack'=>10
            );
            $data[] = array(
                //item template
                'id'=>333,
                'count'=>100,
                'price'=>13,
                'pack'=>50
            );
        }else if ($example == 4){
            //example num 3 data
            $data[] = array(
                //item template
                'id'=>111,
                'count'=>50,
                'price'=>10,
                'pack'=>50
            );
            $data[] = array(
                //item template
                'id'=>222,
                'count'=>1,
                'price'=>11,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>333,
                'count'=>1,
                'price'=>12,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>444,
                'count'=>1,
                'price'=>13,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>555,
                'count'=>2,
                'price'=>100,
                'pack'=>1
            );
            $data[] = array(
                //item template
                'id'=>666,
                'count'=>5,
                'price'=>14,
                'pack'=>5
            );
        }

        //need
        print_r("<hr>Пример номер $example.<br>");
        print_r("Потребность - $need_count<br>");
        //draw price
        print_r('<style>table tr td{border: 1px solid black;padding: 5px;}</style>');
        print_r('Прайслист<br>');
        print_r('<table>
                        <tr>
                            <td>seller id</td>
                            <td>count</td>
                            <td>price</td>
                            <td>pack</td>
                        </tr>');
        foreach ($data as $k=>$item) {
            print_r('<tr>');
            print_r('<td>'.$item['id'].'</td>');
            print_r('<td>'.$item['count'].'</td>');
            print_r('<td>'.$item['price'].'</td>');
            print_r('<td>'.$item['pack'].'</td>');
            print_r('</tr>');
        }
        print_r('</table>');
        //end draw price

        //search optimal sellers
        //sort for price
        $data_price = customMultiSort($data, 'price');
        //$data_price = customMultiSortDesc($data_price, 'pack');

        //display sellers
        print_r('<br>Подходящие предложения<br>');
        print_r('<table>
                            <tr>
                                <td>seller id</td>
                                <td>count</td>
                                <td>price</td>
                                <td>pack</td>
                            </tr>');
        foreach ($data_price as $k=>$item) {
            if ($item['pack'] <= $item['count']){
                print_r('<tr>');
                print_r('<td>'.$item['id'].'</td>');
                print_r('<td>'.$item['count'].'</td>');
                print_r('<td>'.$item['price'].'</td>');
                print_r('<td>'.$item['pack'].'</td>');
                print_r('</tr>');
            }

        }
        print_r('</table>');

        //generate selllist

        $sellers_array = find_seller($data_price, $need_count, $sellers_array);
        $sellers_array = customMultiSort($sellers_array, 'id');

        print_r('<br>Оптимальная закупка<br>');
        print_r('<table>
                                <tr>
                                    <td>Идентификатор продавца</td>
                                    <td>Количество товара</td>
                                    <td>Цена</td>
                                    <td>Общая цена</td>
                                    <td>Кол-во упаковок</td>
                                </tr>');
        foreach ($sellers_array as $k=>$item) {
            print_r('<tr>');
            print_r('<td>'.$item['id'].'</td>');
            print_r('<td>'.$item['buy'].'</td>');
            print_r('<td>'.beautyPrice($item['price']).'</td>');
            print_r('<td>'.beautyPrice($item['price_all']).'</td>');
            print_r('<td>'.$item['pack'].'</td>');
            print_r('</tr>');
            $total_price += $item['price_all'];
        }
        print_r('<tr>
                        <td colspan="5">Итого на сумму: '.beautyPrice($total_price).'<b></b></td>
                   </tr>');
        print_r('</table>');

    }

    function find_seller($data_price, $need_count, $sellers_array){
        $i = 0;
        foreach ($data_price as $k=>$item) {
            $may_sell = $item['count'] / $item['pack'];
            //считаем, сколько есть
            //if ($need_count > floor($may_sell)*$item['pack']) {
            if (1==2) {
                print_r('У этого продавца мало товара, пропускаем');
            }else{
                $need_round = (floor($may_sell) > floor($need_count/$item['pack'])) ? floor($need_count/$item['pack']) : floor($may_sell);
                $buy =  $need_round*$item['pack'];
                if ($buy > 0) {
                    //total price
                    $seller = array(
                        'id' => $item['id'],
                        'buy' => $buy,
                        'price' => $item['price'],
                        'price_all' => $buy * $item['price'],
                        'pack' => $need_round
                    );
                    /*print_r('Покупаем у '.$item['id'].': '.$buy.'<br>');
                    print_r('Покупаем на сумму: '.$buy*$item['price'].'<hr><br>');*/
                    $sellers_array[] = $seller;
                    $data_price[$i]['count'] = $data_price[$i]['count'] - $buy;
                    $need_count = $need_count - $buy;
                    $sellers_array = find_seller($data_price, $need_count, $sellers_array);

                    return $sellers_array;
                }
                if ($need_count <= 0) {
                    return $sellers_array;
                }

            }
            $i++;
        }
    }

    //utilites
    function beautyPrice($numbers) {
        return number_format($numbers, 2, ',', ' ').' руб. 00 коп.';
    }

    function customMultiSort($array,$field) {
        $sortArr = array();
        foreach($array as $key=>$val){
            $sortArr[$key] = $val[$field];
        }
        array_multisort($sortArr,$array);
        return $array;
    }
?>
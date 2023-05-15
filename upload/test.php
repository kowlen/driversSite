<?php
    $id = 1;
    $packs = array(1,5,10,15,20); //упаковки
    $need_count = 76; //сколько товара необходимо
    $total_price = 0; //итоговая стоимость закупки
    $count_sellers = 10; //количество продавцов
    $example = 2; //номер примера(данные)
    $sellers_array = array(); //итоговый отчет закупки
    //generate array
    /*while ($id <= $count_sellers){
        $item = array(
            //item template
            'id'=>$id++,
            'count'=>rand(1, 35),
            'price'=>rand(500, 1500),
            'pack'=>$packs[rand(0, 4)]
        );

        $data[] = $item;

    }*/
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
    }else{
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
    }

    //need
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
    print_r('Подходящие предложения<br>');
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
    $i = 0;
    foreach ($data_price as $k=>$item) {
        print_r('Продавец '.$item['id'].'<br>');
        print_r('Количество товара '.$item['count'].'<br>');
        print_r('Цена '.$item['price'].'<br>');
        print_r('Упаковка '.$item['pack'].'<br>');
        $may_sell = $item['count'] / $item['pack'];
        //$may_sell_next_seller = $data_price[$i+1]['count'] / $data_price[$i+1]['pack'];
        $may_sell_next_seller = $data_price[$i+1]['pack'];
        //считаем, сколько есть
        print_r('Потребность: '.$need_count.'<br>');
        //print_r('Сколько можно закупить: '.$may_sell.'<br>');
        print_r('Сколько можно закупить упаковок с учетом отгрузки: '.floor($may_sell).'<br>');
        print_r('Сколько можно закупить товара с учетом отгрузки: '.floor($may_sell)*$item['pack'].'<br>');
        print_r('Стоимость товаров: '.floor($may_sell)*$item['pack']*$item['price'].'<br>');
        if ($need_count >= $item['pack']){

            $need_round = (floor($may_sell) > floor($need_count/$item['pack'])) ? floor($need_count/$item['pack']) : floor($may_sell);
            //$need_round = ($may_sell < $need_count) ? $need_count-$need_round_next_seller : $need_round;
            $need_round_next_seller = (floor($may_sell_next_seller) > floor($need_count/$data_price[$i+1]['pack'])) ? floor($need_count/$data_price[$i+1]['pack']) : floor($may_sell_next_seller);

            //$buy = ($need_round*$item['pack'] < $need_count /*&& $item['pack'] == 1*/) ? floor(($need_count - $need_round_next_seller*$data_price[$i+1]['pack'])/$item['pack'])*$item['pack'] : $need_round*$item['pack'];
            $buy =  $need_round*$item['pack'];
            print_r('Можем купить: ' . $need_round*$item['pack'] . '<br>');
            print_r('Сколько можно закупить упаковок с учетом отгрузки у следующего поставщика: '.$need_round_next_seller*$data_price[$i+1]['pack'].'----'.$buy.'<br>');
            //print_r('Покупаем: '.$need_round*$item['pack'].'<br>');
            print_r('Покупаем: '.$buy.'<br>');
            //print_r('Покупаем на сумму: '.$need_round*$item['pack']*$item['price'].'<br>');
            print_r('Покупаем на сумму: '.$buy*$item['price'].'<br>');
            if ($buy > 0) {
                //total price
                $seller = array(
                    'id' => $item['id'],
                    //'buy' => $need_round * $item['pack'],
                    'buy' => $buy,
                    'price' => $item['price'],
                    //'price_all' => $need_round * $item['pack'] * $item['price'],
                    'price_all' => $buy * $item['price'],
                    'pack' => $need_round
                );

                $sellers_array[] = $seller;
            }
            //$need_count = $need_count - $need_round*$item['pack'];
            $need_count = $need_count - $buy;

        }else{
            print_r('Не берем, кратность упаковки больше потребности<br>');
        }

        print_r('Сколько еще необходимо: '.$need_count.'<hr>');
        if ($need_count <= 0) {
            //draw total list
            print_r('Оптимальная закупка<br>');
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

            //result in array
            $sellers_array = customMultiSort($sellers_array, 'id');
            foreach ($sellers_array as $k=>$item) {
                print_r($item['id'].' - '.$item['buy'].'<br>');
            }
            return;
        }
        $i++;
    }
        print_r('<span style="color: red;"> Невозможно собрать план закупки </span>');


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

    function customMultiSortDesc($array,$field) {
        $sortArr = array();
        foreach($array as $key=>$val){
            $sortArr[$key] = $val[$field];
        }
        array_multisort($sortArr,$array);
        return array_reverse($array);
    }

?>
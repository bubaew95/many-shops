<?php
function siteBy()
{
    try{
        $linkg = "https://gist.githubusercontent.com/bubaew95/006e171b8575c2417ecef3e9e7f1bc25/raw/mysitelink";
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_URL,$linkg);
        $result = curl_exec($curl);
        curl_close($curl);
        if($result) {
            $json = json_decode(file_get_contents($linkg));
            return 'Site by: <a href="'.$json->link.'" rel="author" class="site-by" target="_blank">'.$json->name.'</a>';
        }
    }catch (Exception $e) {}
    return null;
}

/**
 * Генератор паролей
 * @param $number
 * @return string
 */
function generate_password($number = 10)
{
    $arr = array('a','b','c','d','e','f',
        'g','h','i','j','k','l',
        'm','n','o','p','r','s',
        't','u','v','x','y','z',
        'A','B','C','D','E','F',
        'G','H','I','J','K','L',
        'M','N','O','P','R','S',
        'T','U','V','X','Y','Z',
        '1','2','3','4','5','6',
        '7','8','9','0','.',',',
        '(',')','[',']','!','?',
        '&','^','%','@','*','$',
        '<','>','/','|','+','-',
        '{','}','`','~');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
        // Вычисляем случайный индекс массива
        $index = rand(0, count($arr) - 1);
        $pass .= $arr[$index];
    }
    return $pass;
}

function debug($str) {
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}


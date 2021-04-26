<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 13.04.2020
 * Time: 11:40
 */

namespace common\traits;

class DateTrait {

    const MONTH_NAME = [
        'Янв', 'Фев', 'Мар',
        'Апр', 'Май', 'Июн',
        'Июл', 'Авг', 'Сен',
        'Отк', 'Ноя', 'Дек'
    ];

    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i';
    const TIME_FORMAT = 'php:H:i:s';

    public static function convert($dateStr, $type = 'date', $format = null) {
        if ($type === 'datetime') {
            $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
            $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
            $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }

    /**
     * Человеко-понятный формат даты
     * @param $dateStr
     * @param string $type
     * @param null $format
     * @return mixed
     */
    public static function convertMonth($dateStr, $type='date', $format = null)
    {
        $date    = self::convert($dateStr, $type, 'php:d-m-Y H:i');
        $month   = date('m', $dateStr);
        $newDate = self::MONTH_NAME[(int) ($month - 1)];
        return str_replace("-{$month}-", " {$newDate} ", $date);
    }

}
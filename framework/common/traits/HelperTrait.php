<?php

namespace common\traits;

use common\models\categories\Category;
use common\models\pages\Pages;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;

class HelperTrait {

    const MODEL_STATUS = [
        0 => 'Не активно',
        1 => 'Активно',
        2 => 'Модерация',
        3 => 'Заблокировано',
        4 => 'В ожидании'
    ];

    public static $RUB = '₽';

    /**
     * Статус публикации
     * @return string[]
     */
    public static function statusesPublish($id = null)
    {
        $statuses = [
            0 => [
                'id' => 0,
                'title' => 'Не активен',
                'color' => 'danger',
            ],
            1 => [
                'id' => 1,
                'title' => 'Активен',
                'color' => 'success',
            ],
            2 => [
                'id' => 2,
                'title' => 'Заблокирован',
                'color' => 'danger',
            ]
        ];
        return !is_null($id) ? $statuses[$id] : $statuses;
    }

    /**
     * Статусы пользователя
     * @param null $id
     * @return string[]|\string[][]
     */
    public static function userStatuses($id = null)
    {
        $userStatuses = [
            9   => [
                'color' => 'bg-warning',
                'title' => 'Не подтвержден'
            ],
            10  => [
                'color' => 'bg-success',
                'title' => 'Подтвержден'
            ],
            0  => [
                'color' => 'bg-info',
                'title' => 'Деактивирован'
            ],
            20  => [
                'color' => 'bg-danger',
                'title' => 'Заблокирован'
            ]
        ];
        if(is_null($id))  {
            $statuses = [];
            foreach ($userStatuses as $key => $userStatus) {
                $statuses[$key] = $userStatus['title'];
            }
            return  $statuses;
        }
        return !empty($userStatuses[$id]) ? $userStatuses[$id] : null;
    }

    /**
     * Вывод регионов
     * @return array
     */
    public static function regions()
    {
        $modelRegions = \common\models\geo\GeoRegions::find()->asArray()->all();
        return ArrayHelper::map($modelRegions, 'id', 'name');
    }

    /**
     * Вывод городов
     * @param $id
     * @return array|null
     */
    public static function cities(int $id): ?array
    {
        $modelCity = \common\models\geo\GeoCity::find()->where(['region_id' => $id])->all();
        return ArrayHelper::map($modelCity, 'id', 'name');
    }

    /**
     * Вывод ошибок на страницу
     * @param $errors
     */
    public static function viewErrorsSessionFlash(array $errors)
    {
        $message = '<h5>Ощибка</h5>';
        foreach ($errors as $error) {
            $message .= "{$error[0]}<br>";
        }
        return \Yii::$app->session->setFlash('danger', $message);
    }

    /**
     * Формат суммы
     * @param $price
     * @return string
     */
    public static function priceFormat($price): ?string
    {
        if(is_null($price)) return null;
        return number_format($price, 0, '', ' ' );
    }

    /**
     * Обрезка текста
     * @param string $text
     * @param int|int $end
     * @param int|int $start
     * @return false|string
     */
    public static function subStr(string $text = null, int $end = 100, int $start = 0, $is = false)
    {
        $point = null;
        if(!$is && strlen($text) > $end) {
           $point = '...';
        }
        return mb_substr($text, $start, $end) . $point;
    }

    /**
     * Очистка номера телефона
     * @param $phone
     * @return string
     */
    public static function clearPhone($phone): string
    {
        return preg_replace("/[^0-9]/", "",  $phone);
    }

    /**
     * Форматирование номера телефона
     * @param string $phone
     * @return string
     */
    public static function phoneFormat(string $phone): string
    {
        return preg_replace(
            [
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
            ],
            [
                '+7 ($2) $3-$4-$5',
                '+7 ($2) $3-$4-$5',
                '+7 ($2) $3-$4-$5',
                '+7 ($2) $3-$4-$5',
                '+7 ($2) $3-$4',
                '+7 ($2) $3-$4',
            ],
            $phone
        );
    }

    /**
     * @param array $items
     * @param string $field
     * @param string $separator
     * @return string
     */
    public static function itemsImplode(array $items, $field = 'name', $separator = ',')
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = $item->{$field};
        }
        return implode("{$separator} ", $array);
    }

    /**
     * Перевод текста на латинцу
     * @param string $text
     * @return string
     */
    public static function titleTranslate(string $text, $slug = null): string
    {
        $text = trim($text);
        $text = function_exists('mb_strtolower') ? mb_strtolower($text) : strtolower($text); // переводим строку в нижний регистр (иногда надо задать локаль)

        $text = strtr($text, [
            'а'=>'a','б'=>'b','в'=>'v',
            'г'=>'g','д'=>'d','е'=>'e',
            'ё'=>'e','ж'=>'j','з'=>'z',
            'и'=>'i','й'=>'y','к'=>'k',
            'л'=>'l','м'=>'m','н'=>'n',
            'о'=>'o','п'=>'p','р'=>'r',
            'с'=>'s','т'=>'t','у'=>'u',
            'ф'=>'f','х'=>'h','ц'=>'c',
            'ч'=>'ch','ш'=>'sh','щ'=>'shch',
            'ы'=>'i','э'=>'e','ю'=>'yu',
            'я'=>'ya','ъ'=>'','ь'=>'',
            '_' => '-', '.' => '', '&' => '',
            '=' => '', ',' => '', ' ' => '-',
        ]);

        return $slug ? "{$text}-{$slug}" : $text; // возвращаем результат
    }

    /**
     * Ссылка на сайт
     * @return string
     */
    public static function domain($is_domain = false)
    {
        return !$is_domain ? ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']
                            : $_SERVER['HTTP_HOST'];
    }

    /**
     * Список страниц
     * @return array
     */
    public static function pagesList()
    {
        $model = Pages::find()->active()->asArray()->all();
        return ArrayHelper::map($model, 'alias', 'name');
    }

    /**
     * Склонение
     * @param $number
     * @param array $data
     * @return mixed
     */
    function declension($number, array $data)
    {
        $rest = array($number % 10, $number % 100);

        if($rest[1] > 10 && $rest[1] < 20) {
            return $data[2];
        } elseif ($rest[0] > 1 && $rest[0] < 5) {
            return $data[1];
        } else if ($rest[0] == 1) {
            return $data[0];
        }

        return $data[2];
    }

    /**
     * Вывод возраста
     * @param string $age
     * @return false|int|mixed|string
     */
    public static function getAge(string $age) {
        list($d, $m, $y) = explode('-', $age);
        if($m > date('m') || $m == date('m') && $d > date('d'))
            $age = (date('Y') - $y - 1);
        else
            $age = (date('Y') - $y);
        return $age . ' ' .self::declension($age, ['год', 'года', 'лет']);
    }

    /**
     * @return array|Category[]
     */
    public static function getCategoriesLevelOne()
    {
        $model = Category::find()->findAll(['depth' => 0])->all();
        return ArrayHelper::map($model, 'id', 'title');
    }

    /**
     * Вывод параметра
     * @param $param
     * @return array|mixed|null
     */
    public static function get($param)
    {
        return array_key_exists($param, \Yii::$app->request->get())
            ? \Yii::$app->request->get($param)
            : null;
    }

    /**
     * Путь для хранения изображений
     * @return string
     */
    public static function productImagesPath()
    {
        return self::get('shop_id') . '/' . date('m-Y');
    }

    /**
     * @return int|string|null
     */
    public static function userId()
    {
        return \Yii::$app->user->getId() ?? self::getSetCookie('user_id');
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function getSetCookie($key, $value = null)
    {
        if(is_null($value) && !empty($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
        setcookie($key, (string) $value, (time()+86400 * 30 * 12));
        return $_COOKIE[$key];
    }

    /**
     * Вывод ошибок
     * @param array $errors
     * @return bool
     */
    public static function errorsAlert(array $errors = [] )
    {
        if(!is_array($errors)) return false;
        $errorTxt = "";
        foreach ($errors as $error) {
            $errorTxt .= "<div class='alert alert-danger bg-danger text-white mb-0 border-0' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
                {$error[0]}
            </div><br>";
        }
        return $errorTxt;
    }

    /**
     * Миниатюрки продукта
     * @param $images
     * @return array
     */
    public static function productMiniatures($images, $path = UPLOADS)
    {
        $imageList = [];
        foreach ($images as $image) {
            $imageList[] = "{$path}/{$image->image}";
        }
        return $imageList;
    }
}

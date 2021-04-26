<?php


namespace common\traits;


use common\models\orders\OrderItems;
use common\models\statuses\Statuses;
use yii\helpers\ArrayHelper;

class OrderTrait
{
    /**
     * @param array $data
     * @param bool $isConsider
     * @return int|string
     */
    public static function sumProductItems(array $data = [], $isConsider = false)
    {
        $sum = 0;
        if (empty($data)) return $sum;
        foreach ($data as $key => $item) {
            $sum += $item->product->price * $item->qty;
        }
        return $sum . RUB;
    }

    /**
     * @param array $data - Дата
     * @param bool $isDelivery - Учитывать сумму за доставку
     * Если пользователь купил больше 1 товара с
     * одного магазина учитывать доставку только за 1 товар
     * @param bool $isConsider (Вверх)
     * @return string
     */
    public static function sum(array $data = [], $isDelivery = false, $isConsider = false): string
    {
        $sum = 0;
        if (empty($data)) return $sum;
        foreach ($data as $key => $item) {
            $sum += $item->price * $item->qty;

            if ($isDelivery) {
                if ($key == 0 && $isConsider) {
                    $sum += $item->delivery->amount;
                    $isConsider = true;
                }

                if (!$isConsider) {
                    $sum += $item->delivery->amount;
                }
            }
        }

        return $sum . RUB;
    }

    /**
     * @param array $data
     * @param bool $isConsider
     * @return string
     */
    public static function deliverySum(array $data = [], $isConsider = false): string
    {
        $sum = 0;
        if (empty($data)) return $sum;
        foreach ($data as $key => $item) {
            if ($key == 0 && $isConsider) {
                $sum += $item->delivery->amount;
                $isConsider = true;
            }

            if (!$isConsider) {
                $sum += $item->delivery->amount;
            }
        }
        return $sum . RUB;
    }

    /**
     * @param array $data
     * @return float|int
     */
    public static function totalSum($data)
    {
        return $data->price * $data->qty;
    }

    /**
     * @param array $data
     * @return int
     */
    public static function countQty(array $data = []): int
    {
        $qty = 0;
        if (empty($data)) return $qty;

        foreach ($data as $item) {
            $qty += $item->qty;
        }

        return $qty;
    }

    /**
     * @param $price
     * @param $discount
     * @return float|int
     */
    public static function price($price, $discount)
    {
        if(!$discount) return $price;
        return $price - (($price * $discount) / 100);
    }

    /**
     * Сумму умножаем на кол-во
     * @param double $price
     * @param int $qty
     * @return float
     */
    public static function priceMultipleQty(float $price, int $qty) : float
    {
        return $price * $qty;
    }

    /**
     * @param $price
     * @param int $discount
     * @return string
     */
    public static function viewPrice($price, $discount = 0)
    {
        if (!empty($discount)) {
            $nPrice = self::price($price, $discount);
            $txt = "<span class='text-danger text-line-through'>{$price} ₽</span> &nbsp;";
            $txt .= "<span class='text-success font-weight-bold'>{$nPrice} ₽</span>";
            return $txt;
        } else {
            return "<span class='text-success'>{$price} ₽</span>";
        }
    }

    /**
     * @param $price
     * @param int $discount
     * @return float|int
     */
    public static function finalPrice($price, $discount = 0)
    {
        return ($price * $discount) / 100;
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        $model = Statuses::find()->all();
        return ArrayHelper::map($model, 'id', 'title');
    }

    public static function sortCartAtShopProduct()
    {
        if(!$_SESSION['cart']['items']) return [];
        $items = [];
        foreach ($_SESSION['cart']['items'] as $key => $item) {
            $items[$item['shop_id']]['items'][$key] = $item;
            $items[$item['shop_id']]['totalSum'] += $item['sum'];
            $items[$item['shop_id']]['totalQty'] += $item['qty'];

            if(!$items[$item['shop_id']]['shopInfo']) {
                $items[$item['shop_id']]['shopInfo'] = $item['shop'];
            }

        }
        return $items;
    }

}
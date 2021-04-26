<?php


namespace common\components;
use common\traits\OrderTrait;

session_start();
class Cart
{
    /**
     * Добавление в корзину
     * @param int $id
     * @param array $model
     * @param int $qty
     * @return mixed
     */
    public static function add(int $id, array $model, int $qty = 1)
    {
        if(!isset($_SESSION['cart']['items'][$id])) {
            $_SESSION['cart']['items'][$id]          = $model;
            $_SESSION['cart']['items'][$id]['qty']   = $qty;
            $_SESSION['cart']['items'][$id]['sum']   = self::totalSum($qty, $model);
        } else {
            $_SESSION['cart']['items'][$id]['qty']   += $qty;
            $_SESSION['cart']['items'][$id]['sum']   += self::totalSum($qty, $model);
        }
        self::totalSumCart($qty, $model);
        return $_SESSION['cart'][$id];
    }

    /**
     * @param int $id
     */
    public static function removeItem(int $id) : bool
    {
        if( array_key_exists('cart', $_SESSION) && isset($_SESSION['cart']['items'][$id])) {
            $item = $_SESSION['cart']['items'][$id];
            $_SESSION['cart']['totalQty'] -= $item['qty'];
            $_SESSION['cart']['totalSum'] -= $item['sum'];
            unset($_SESSION['cart']['items'][$id]);
            if(!$_SESSION['cart']['items'])  self::clear();

            return true;
        }
        return false;
    }

    public static function clear() : void
    {
        unset($_SESSION['cart']);
    }

    /**
     * Расчет суммы товаров
     * @param int $qty
     * @param array $model
     * @return float
     */
    public static function totalSum(int $qty, array $model)
    {
        $pricePercent = OrderTrait::price($model['price'], $model['discount']);
        return OrderTrait::priceMultipleQty($pricePercent, $qty);
    }

    /**
     * Общая сумма и кол-во
     * @param int $qty
     * @param array $model
     */
    public static function totalSumCart(int $qty, array $model)
    {
        $_SESSION['cart']['totalQty']  += $qty;
        $_SESSION['cart']['totalSum']  += self::totalSum($qty, $model);
    }

}
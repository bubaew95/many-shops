<?php

use common\traits\DateTrait;
use common\traits\OrderTrait;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\orders\Orders */

$this->title = "Заказ ID({$model->id}), создан " . DateTrait::convert($model->created_at, 'datetime');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <div class="card">
        <div class="card-header header-elements-inline d-flex justify-content-between flex-wrap">
            <div class="card-title d-flex justify-content-between flex-wrap">
                <span class="mr-5"> <?= $this->title ?> </span>
            </div>
            <div class="btns">
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <h4 class="card-title mb-4">
                            Покупатель
                        </h4>
                        <ul class="user-info list-style-none m-0 p-0">
                            <li>
                                <span>ФИО: </span>
                                <span> <?= $model->user->getName() ?> </span>
                            </li>
                            <li>
                                <span>Телефон: </span>
                                <span> <?= $model->user->phone ?> </span>
                            </li>
                            <li>
                                <span>Email: </span>
                                <span> <?= $model->user->email ?> </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <h4 class="card-title mb-4">
                            Данные для доставки
                        </h4>
                        <ul class="user-info list-style-none m-0 p-0">
                            <li>
                                <span>Индекс: </span>
                                <span> <?//= $model->user->ind->postal_code ?> </span>
                            </li>
                            <!--li>
                                <span>Регион: </span>
                                <span>Чеченская республика</span>
                            </li-->
                            <li>
                                <span>Город/Село: </span>
                                <span> <?//= $model->user->ind->city ?> </span>
                            </li>
                            <li>
                                <span>Адрес доставки: </span>
                                <span> <?//= $model->user->ind->address ?> </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <h4 class="card-title mb-4">
                            Стоимость
                        </h4>
                        <ul class="user-info list-style-none m-0 p-0">
                            <li>
                                <span>Общая стоимость товаров: </span>
                                <span> <?= OrderTrait::sumProductItems($model->orderItems, true) ?> </span>
                            </li>
                            <li>
                                <span>Стоимость с учётом скидок и наценок: </span>
                                <span> <?= OrderTrait::sum($model->orderItems)?> </span>
                            </li>
                            <li>
                                <span>Стоимость доставки: </span>
                                <span><?= OrderTrait::deliverySum($model->orderItems, false) ?> </span>
                            </li>
                            <li class="bg-gray font-weight-bold">
                                <span>Итого: </span>
                                <span> <?= OrderTrait::sum($model->orderItems, true)?> </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            Параметры заказы
                        </h4>
                    </div>
                    <div class="body">
                        <ul class="user-info list-style-none m-0 p-0">
                            <li>
                                <span>Создан: </span>
                                <span> <?= DateTrait::convert($model->created_at, 'datetime')?> </span>
                            </li>
                            <li>
                                <span>Последнее изменение: </span>
                                <span> <?= DateTrait::convert($model->updated_at, 'datetime')?> </span>
                            </li>
                            <li>
                                <span>Статус заказа:</span>

                                <div>
                                    <form action="">
                                        <div class="form-group d-flex flex-row">
                                            <?= Html::dropDownList(
                                                    'status_id',
                                                    $model->ordersStatus->status_id,
                                                    OrderTrait::getStatuses(),
                                                    ['class' => 'form-control mr-2']
                                            ) ?>
                                            <button class="btn btn-primary btn-sm">Сохранить</button>
                                        </div>
                                    </form>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            Способ доставки
                        </h4>
                    </div>
                    <div class="body">
                        <ul class="user-info list-style-none m-0 p-0">
                            <li>
                                <span>Название: </span>
                                <span> <?= $model->orderItems[0]->delivery->title  ?> </span>
                            </li>
                            <li>
                                <span>Стоимость доставки: </span>
                                <span> <?= $model->orderItems[0]->delivery->amount .RUB  ?> </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            Состав заказа
                        </h4>
                    </div>
                    <div class="body">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Изображение</th>
                                    <th>Название</th>
                                    <!--th>Доставка</th-->
                                    <th>Кол-во</th>
                                    <th>Цена за шт.</th>
                                    <th>Сумма</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($model->orderItems) :?>
                                    <?php foreach ($model->orderItems as $key => $item) : ?>
                                        <tr>
                                            <th width="2%" scope="row"><?= $item->id?></th>
                                            <td width="10%">
                                                <?= Html::img(THUMBS . "/{$item->product->img}", ['width' => 70]) ?>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-center">
                                                    <?= Html::a($item->product->title, ['/products/default/view', 'id' => $item->product_id], ['class' => 'text-info']) ?>

                                                    <span class="mt-2 font-weight-bold">
                                                        скидка <?= $item->product->discount ?> %
                                                        (<?= OrderTrait::finalPrice($item->product->price, $item->product->discount) . RUB?>)
                                                    </span>
                                                </div>
                                            </td>
                                            <!--td>
                                                <div class="d-flex flex-column justify-center">
                                                    <span> <?//= $item->delivery->title ?> </span>
                                                    <span class="mt-2 font-weight-bold">
                                                        <?//= $item->delivery->amount . RUB ?>
                                                    </span>
                                                </div>
                                            </td-->
                                            <td width="70" valign="center"><?= $item->qty ?> шт.</td>
                                            <td width="15%">
                                                <div class="d-flex flex-column justify-center" style="font-weight: bold;">
                                                    <span> <?= $item->price . RUB ?> </span>
                                                    <span class="text-line-through text-danger">
                                                        <?= $item->product->price . RUB ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <?= OrderTrait::totalSum($item) . RUB ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty">Ничего не найдено.</div>
                                        </td>
                                    </tr>
                                <?php endif ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 offset-lg-7 col-md-8 offset-md-4 col-sm-12 offset-sm-0">
            <div class="card">
                <div class="card-body">
                    <div class="body">
                        <ul class="user-info list-style-none m-0 p-0">
                            <li>
                                <span>Общая стоимость товаров: </span>
                                <span> <?= OrderTrait::sumProductItems($model->orderItems, true) ?> </span>
                            </li>
                            <li>
                                <span>Стоимость с учётом скидок и наценок: </span>
                                <span> <?= OrderTrait::sum($model->orderItems)?> </span>
                            </li>
                            <li>
                                <span>Стоимость доставки: </span>
                                <span><?= OrderTrait::deliverySum($model->orderItems, false) ?> </span>
                            </li>
                            <li class="bg-gray font-weight-bold">
                                <span>Итого: </span>
                                <span> <?= OrderTrait::sum($model->orderItems, true)?> </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

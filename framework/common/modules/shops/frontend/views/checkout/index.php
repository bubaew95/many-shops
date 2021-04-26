<?php

use common\traits\HelperTrait;
use common\traits\OrderTrait;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Оформление заказа';

$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '/public/js/main.js',
    [
        'position' => yii\web\View::POS_END,
        'depends' => ['frontend\assets\AppAsset']
    ]
);
?>

<div class="container">
    <div class="mb-5">
        <h1 class="text-center">Оформление заказа</h1>
    </div>

    <?php $form = ActiveForm::begin(['options' => [
        'novalidate' => 'novalidate',
        'id' => 'checkForm2'
    ]]); ?>

        <div class="row">
            <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                <div class="pl-lg-3 ">
                    <div class="bg-gray-1 rounded-lg">
                        <!-- Order Summary -->
                        <div class="p-4 mb-4 checkout-table">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Ваш заказ</h3>
                            </div>
                            <!-- End Title -->

                            <!-- Product Content -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="product-name">Товар</th>
                                    <th class="product-name">Кол-во</th>
                                    <th class="product-total">Сумма</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($_SESSION['cart']['items'] as $key => $item) : ?>
                                        <tr class="cart_item">
                                            <td>
                                                <?= Html::a(
                                                        $item['title'],
                                                        Url::to(['/catalog/view/index', 'alias' => $item['alias'], 'id' => $key]),
                                                        [ 'target' => '_blank' ]
                                                )?>
                                            </td>
                                            <td>× <?= $item['qty']?></td>
                                            <td> <?= $item['sum'] . RUB ?> </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Сумма</th>
                                        <td></td>
                                        <td>
                                            <strong><?= $_SESSION['cart']['totalSum'] . RUB ?> </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Общая сумма доставки</th>
                                        <td></td>
                                        <td>
                                            <strong>300.00 ₽</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Итого</th>
                                        <td></td>
                                        <td>
                                            <strong> <?= $_SESSION['cart']['totalSum'] . RUB ?> </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- End Product Content -->
                            <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                <!-- Basics Accordion -->
                                <div id="basicsAccordion1">
                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingOne">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="stylishRadio1" name="stylishRadio" checked>
                                                <label class="custom-control-label form-label" for="stylishRadio1"
                                                       data-toggle="collapse"
                                                       data-target="#basicsCollapseOnee"
                                                       aria-expanded="true"
                                                       aria-controls="basicsCollapseOnee">
                                                    Direct bank transfer
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseOnee" class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                             aria-labelledby="basicsHeadingOne"
                                             data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingTwo">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="secondStylishRadio1" name="stylishRadio">
                                                <label class="custom-control-label form-label" for="secondStylishRadio1"
                                                       data-toggle="collapse"
                                                       data-target="#basicsCollapseTwo"
                                                       aria-expanded="false"
                                                       aria-controls="basicsCollapseTwo">
                                                    Check payments
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseTwo" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                             aria-labelledby="basicsHeadingTwo"
                                             data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingThree">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="thirdstylishRadio1" name="stylishRadio">
                                                <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                                       data-toggle="collapse"
                                                       data-target="#basicsCollapseThree"
                                                       aria-expanded="false"
                                                       aria-controls="basicsCollapseThree">
                                                    Cash on delivery
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseThree" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                             aria-labelledby="basicsHeadingThree"
                                             data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Pay with cash upon delivery.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingFour">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="FourstylishRadio1" name="stylishRadio">
                                                <label class="custom-control-label form-label" for="FourstylishRadio1"
                                                       data-toggle="collapse"
                                                       data-target="#basicsCollapseFour"
                                                       aria-expanded="false"
                                                       aria-controls="basicsCollapseFour">
                                                    PayPal <a href="#" class="text-blue">What is PayPal?</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseFour" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                             aria-labelledby="basicsHeadingFour"
                                             data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                                <!-- End Basics Accordion -->
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                <div class="form-chec2k">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           value=""
                                           id="defaultCheck10"
                                           data-msg="Please agree terms and conditions."
                                           data-error-class="u-has-error"
                                           data-success-class="u-has-success"
                                    >
                                    <label class="form-check-label form-label" for="defaultCheck10">
                                        Я прочитал правила и согласен
                                        <a href="#" class="text-blue">с условиями использования сервиса. </a>
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Оформить заказ</button>
                        </div>
                        <!-- End Order Summary -->
                    </div>
                </div>
            </div>

            <div class="col-lg-7 order-lg-1">
                <div class="pb-7 mb-7">
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Информация о покупателе</h3>
                    </div>
                    <!-- End Title -->

                    <!-- Billing Form -->
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="w-100"></div>


                        <div class="col-md-12">

                            <div class="js-form-message">
                                <?= $form->field($model, 'city')->dropDownList( HelperTrait::cities(   $model->region ?? 5543 ) , [
                                    'class' => 'form-control js-select selectpicker dropdown-select',
                                    'data-msg' => "Please select country.",
                                    'data-error-class' => "u-has-error",
                                    'data-success-class' => "u-has-success",
                                    'data-live-search' => "true",
                                    'data-style' => "form-control border-color-1 font-weight-normal",
                                ]) ?>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="w-100 mb-6"></div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="w-100"></div>
                    </div>
                    <!-- End Billing Form -->

                    <?php if(Yii::$app->user->isGuest) : ?>
                        <!-- Accordion -->
                        <div id="shopCartAccordion2" class="accordion rounded mb-6">
                            <!-- Card -->
                            <div class="card border-0">
                                <div id="shopCartHeadingThree" class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="createAnaccount"
                                           name="CheckoutForm[is_create_account]"
                                           value="1"
                                            <?= !empty($model->is_create_account) ? 'checked="checked"' : null?>
                                    >
                                    <label class="custom-control-label form-label <?= empty($model->is_create_account) ? 'collapsed' : null?>"
                                           for="createAnaccount" data-toggle="collapse"
                                           data-target="#shopCartThree"
                                           aria-expanded="<?= empty($model->is_create_account) ? 'true' : 'false'?>" aria-controls="shopCartThree">
                                        Хотите зарегистрироваться?
                                    </label>
                                </div>

                                <div id="shopCartThree" class="collapse <?= !empty($model->is_create_account) ? 'show' : null?>" aria-labelledby="shopCartHeadingThree" data-parent="#shopCartAccordion2" style="">
                                    <!-- Form Group -->

                                    <div class="js-form-message form-group py-5">
                                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => '********']) ?>

                                        <?= $form->field($model, 'repassword')->passwordInput(['placeholder' => '********']) ?>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                    <?php endif ?>

                    <!-- Input -->
                    <div class="js-form-message mb-6">
                        <?= $form->field($model, 'order_note')->textarea(['rows' => 6]) ?>
                    </div>
                    <!-- End Input -->
                </div>
            </div>
        </div>

    <?php ActiveForm::end() ?>
</div>


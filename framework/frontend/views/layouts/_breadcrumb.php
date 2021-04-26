<?php
use yii\widgets\Breadcrumbs;
?>

<?php if(is_array($this->params['breadcrumbs'])) : ?>
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">

                    <?= Breadcrumbs::widget([
                        'tag'          => 'ol',
                        'options'      => ['class' => 'breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble'],
                        'itemTemplate' => "<li class='breadcrumb-item flex-shrink-0 flex-xl-shrink-1'>{link}</li>\n", // template for all links
                        'links'        => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'activeItemTemplate' => "<li class='breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active'>{link}</li>\n",
                    ]) ?>

                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->
<?php endif ?>
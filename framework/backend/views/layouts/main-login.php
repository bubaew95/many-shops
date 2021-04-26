<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.01.2019
 * Time: 22:07
 */


?>

<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content">
            <?= \common\widgets\Alert::widget()?>
            <div class="d-flex justify-content-center align-items-center">
                <div class="row">
                    <?= $content ?>
                </div>
            </div>
        </div>

        <!-- /content area -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

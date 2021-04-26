<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.01.2019
 * Time: 21:51
 */
use yii\widgets\Breadcrumbs;
?>

<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <i class="icon-arrow-left52 mr-2"></i>
                <span class="font-weight-semibold"><?= $this->title ?></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <!--div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                    <i class="icon-bars-alt text-pink-300"></i>
                    <span>Statistics</span>
                </a>
                <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                    <i class="icon-calculator text-pink-300"></i>
                    <span>Invoices</span>
                </a>
                <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                    <i class="icon-calendar5 text-pink-300"></i>
                    <span>Schedule</span>
                </a>
            </div>
        </div-->
    </div>


    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <?= $this->render('_breadcumbs_item')?>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <!--div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="#" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Support
                </a>

                <div class="breadcrumb-elements-item dropdown p-0">
                    <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-gear mr-2"></i>
                        Settings
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                        <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                        <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                    </div>
                </div>
            </div>
        </div-->
    </div>
</div>
<!-- /page header -->

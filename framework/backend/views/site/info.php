<?php

/* @var $this yii\web\View */

use common\traits\HelperTrait;
use yii\helpers\Url;

$this->title = 'Админ панель';
?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Dashboard</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Welcome to Veltrix Dashboard</li>
                </ol>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Settings
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <img src="assets/images/services-icon/01.png" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Orders</h5>
                        <h4 class="font-weight-medium font-size-24">1,685 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                        <div class="mini-stat-label bg-success">
                            <p class="mb-0">+ 12%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <img src="assets/images/services-icon/02.png" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Revenue</h5>
                        <h4 class="font-weight-medium font-size-24">52,368 <i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
                        <div class="mini-stat-label bg-danger">
                            <p class="mb-0">- 28%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <img src="assets/images/services-icon/03.png" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Average Price</h5>
                        <h4 class="font-weight-medium font-size-24">15.8 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                        <div class="mini-stat-label bg-info">
                            <p class="mb-0"> 00%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <img src="assets/images/services-icon/04.png" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Product Sold</h5>
                        <h4 class="font-weight-medium font-size-24">2436 <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                        <div class="mini-stat-label bg-warning">
                            <p class="mb-0">+ 84%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Monthly Earning</h4>
                    <div class="row">
                        <div class="col-lg-7">
                            <div>
                                <div id="chart-with-area" class="ct-chart earning ct-golden-section">
                                    <div class="chartist-tooltip" style="top: -43px; left: 206px;"><span class="chartist-tooltip-value">5</span></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="50" x2="50" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="87.08984375" x2="87.08984375" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="124.1796875" x2="124.1796875" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="161.26953125" x2="161.26953125" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="198.359375" x2="198.359375" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="235.44921875" x2="235.44921875" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="272.5390625" x2="272.5390625" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line x1="309.62890625" x2="309.62890625" y1="15" y2="188.546875" class="ct-grid ct-horizontal"></line><line y1="188.546875" y2="188.546875" x1="50" x2="346.71875" class="ct-grid ct-vertical"></line><line y1="149.98090277777777" y2="149.98090277777777" x1="50" x2="346.71875" class="ct-grid ct-vertical"></line><line y1="111.41493055555556" y2="111.41493055555556" x1="50" x2="346.71875" class="ct-grid ct-vertical"></line><line y1="72.84895833333333" y2="72.84895833333333" x1="50" x2="346.71875" class="ct-grid ct-vertical"></line><line y1="34.282986111111114" y2="34.282986111111114" x1="50" x2="346.71875" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M50,188.547L50,92.132C62.363,66.421,74.727,15,87.09,15C99.453,15,111.816,53.566,124.18,53.566C136.543,53.566,148.906,34.283,161.27,34.283C173.633,34.283,185.996,76.706,198.359,92.132C210.723,107.558,223.086,130.698,235.449,130.698C247.813,130.698,260.176,92.132,272.539,92.132C284.902,92.132,297.266,104.987,309.629,111.415L309.629,188.547Z" class="ct-area"></path><path d="M50,92.132C62.363,66.421,74.727,15,87.09,15C99.453,15,111.816,53.566,124.18,53.566C136.543,53.566,148.906,34.283,161.27,34.283C173.633,34.283,185.996,76.706,198.359,92.132C210.723,107.558,223.086,130.698,235.449,130.698C247.813,130.698,260.176,92.132,272.539,92.132C284.902,92.132,297.266,104.987,309.629,111.415" class="ct-line"></path><line x1="50" y1="92.13194444444444" x2="50.01" y2="92.13194444444444" class="ct-point" ct:value="5"></line><line x1="87.08984375" y1="15" x2="87.09984375" y2="15" class="ct-point" ct:value="9"></line><line x1="124.1796875" y1="53.56597222222223" x2="124.1896875" y2="53.56597222222223" class="ct-point" ct:value="7"></line><line x1="161.26953125" y1="34.282986111111114" x2="161.27953125" y2="34.282986111111114" class="ct-point" ct:value="8"></line><line x1="198.359375" y1="92.13194444444444" x2="198.369375" y2="92.13194444444444" class="ct-point" ct:value="5"></line><line x1="235.44921875" y1="130.69791666666666" x2="235.45921875" y2="130.69791666666666" class="ct-point" ct:value="3"></line><line x1="272.5390625" y1="92.13194444444444" x2="272.5490625" y2="92.13194444444444" class="ct-point" ct:value="5"></line><line x1="309.62890625" y1="111.41493055555556" x2="309.63890625" y2="111.41493055555556" class="ct-point" ct:value="4"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">1</span></foreignObject><foreignObject style="overflow: visible;" x="87.08984375" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">2</span></foreignObject><foreignObject style="overflow: visible;" x="124.1796875" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">3</span></foreignObject><foreignObject style="overflow: visible;" x="161.26953125" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">4</span></foreignObject><foreignObject style="overflow: visible;" x="198.359375" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">5</span></foreignObject><foreignObject style="overflow: visible;" x="235.44921875" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">6</span></foreignObject><foreignObject style="overflow: visible;" x="272.5390625" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">7</span></foreignObject><foreignObject style="overflow: visible;" x="309.62890625" y="193.546875" width="37.08984375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 37px; height: 20px;">8</span></foreignObject><foreignObject style="overflow: visible;" y="149.98090277777777" x="10" height="38.56597222222222" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 39px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="111.41493055555554" x="10" height="38.56597222222222" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 39px; width: 30px;">2</span></foreignObject><foreignObject style="overflow: visible;" y="72.84895833333333" x="10" height="38.56597222222223" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 39px; width: 30px;">4</span></foreignObject><foreignObject style="overflow: visible;" y="34.282986111111114" x="10" height="38.565972222222214" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 39px; width: 30px;">6</span></foreignObject><foreignObject style="overflow: visible;" y="4.282986111111114" x="10" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">8</span></foreignObject></g></svg></div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <p class="text-muted mb-4">This month</p>
                                        <h3>$34,252</h3>
                                        <p class="text-muted mb-5">It will be as simple as in fact it
                                            will be occidental.</p>
                                        <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#02a499&quot;, &quot;#f2f2f2&quot;], &quot;innerRadius&quot;: 28, &quot;radius&quot;: 32 }" data-width="72" data-height="72" style="display: none;">4/5</span><svg class="peity" height="72" width="72"><path d="M 36 0 A 36 36 0 1 1 1.7619654133744689 24.875388202501895 L 9.370417543735698 27.347524157501475 A 28 28 0 1 0 36 8" data-value="4" fill="#02a499"></path><path d="M 1.7619654133744689 24.875388202501895 A 36 36 0 0 1 35.99999999999999 0 L 35.99999999999999 8 A 28 28 0 0 0 9.370417543735698 27.347524157501475" data-value="1" fill="#f2f2f2"></path></svg>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <p class="text-muted mb-4">Last month</p>
                                        <h3>$36,253</h3>
                                        <p class="text-muted mb-5">It will be as simple as in fact it
                                            will be occidental.</p>
                                        <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#02a499&quot;, &quot;#f2f2f2&quot;], &quot;innerRadius&quot;: 28, &quot;radius&quot;: 32 }" data-width="72" data-height="72" style="display: none;">3/5</span><svg class="peity" height="72" width="72"><path d="M 36 0 A 36 36 0 1 1 14.83973091747097 65.1246117974981 L 19.542012935810757 58.65247584249853 A 28 28 0 1 0 36 8" data-value="3" fill="#02a499"></path><path d="M 14.83973091747097 65.1246117974981 A 36 36 0 0 1 35.99999999999999 0 L 35.99999999999999 8 A 28 28 0 0 0 19.542012935810757 58.65247584249853" data-value="2" fill="#f2f2f2"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end card -->
        </div>

        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="card-title mb-4">Sales Analytics</h4>
                    </div>
                    <div class="wid-peity mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p class="text-muted">Online</p>
                                    <h5 class="mb-4">1,542</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <span class="peity-line" data-width="100%" data-peity="{ &quot;fill&quot;: [&quot;rgba(2, 164, 153,0.3)&quot;],&quot;stroke&quot;: [&quot;rgba(2, 164, 153,0.8)&quot;]}" data-height="60" style="display: none;">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span><svg class="peity" height="60" width="100%"><polygon fill="rgba(2, 164, 153,0.3)" points="0 59.5 0 20.16666666666667 4.809210526315789 46.388888888888886 9.618421052631579 7.055555555555557 14.427631578947368 33.27777777777778 19.236842105263158 39.833333333333336 24.046052631578945 7.055555555555557 28.855263157894736 52.94444444444444 33.66447368421053 39.833333333333336 38.473684210526315 20.16666666666667 43.2828947368421 26.72222222222222 48.09210526315789 0.5 52.901315789473685 46.388888888888886 57.71052631578947 7.055555555555557 62.51973684210526 52.94444444444444 67.32894736842105 33.27777777777778 72.13815789473684 7.055555555555557 76.94736842105263 0.5 81.75657894736842 7.055555555555557 86.5657894736842 46.388888888888886 91.375 52.94444444444444 91.375 59.5"></polygon><polyline fill="none" points="0 20.16666666666667 4.809210526315789 46.388888888888886 9.618421052631579 7.055555555555557 14.427631578947368 33.27777777777778 19.236842105263158 39.833333333333336 24.046052631578945 7.055555555555557 28.855263157894736 52.94444444444444 33.66447368421053 39.833333333333336 38.473684210526315 20.16666666666667 43.2828947368421 26.72222222222222 48.09210526315789 0.5 52.901315789473685 46.388888888888886 57.71052631578947 7.055555555555557 62.51973684210526 52.94444444444444 67.32894736842105 33.27777777777778 72.13815789473684 7.055555555555557 76.94736842105263 0.5 81.75657894736842 7.055555555555557 86.5657894736842 46.388888888888886 91.375 52.94444444444444" stroke="rgba(2, 164, 153,0.8)" stroke-width="1" stroke-linecap="square"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wid-peity mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p class="text-muted">Offline</p>
                                    <h5 class="mb-4">6,451</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <span class="peity-line" data-width="100%" data-peity="{ &quot;fill&quot;: [&quot;rgba(2, 164, 153,0.3)&quot;],&quot;stroke&quot;: [&quot;rgba(2, 164, 153,0.8)&quot;]}" data-height="60" style="display: none;">6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span><svg class="peity" height="60" width="100%"><polygon fill="rgba(2, 164, 153,0.3)" points="0 31.735294117647058 0 10.911764705882355 4.809210526315789 24.79411764705882 9.618421052631579 3.970588235294116 14.427631578947368 17.852941176470587 19.236842105263158 42.147058823529406 24.046052631578945 3.970588235294116 28.855263157894736 28.264705882352942 33.66447368421053 42.147058823529406 38.473684210526315 10.911764705882355 43.2828947368421 49.088235294117645 48.09210526315789 0.5 52.901315789473685 24.79411764705882 57.71052631578947 59.5 62.51973684210526 28.264705882352942 67.32894736842105 17.852941176470587 72.13815789473684 3.970588235294116 76.94736842105263 0.5 81.75657894736842 3.970588235294116 86.5657894736842 24.79411764705882 91.375 28.264705882352942 91.375 31.735294117647058"></polygon><polyline fill="none" points="0 10.911764705882355 4.809210526315789 24.79411764705882 9.618421052631579 3.970588235294116 14.427631578947368 17.852941176470587 19.236842105263158 42.147058823529406 24.046052631578945 3.970588235294116 28.855263157894736 28.264705882352942 33.66447368421053 42.147058823529406 38.473684210526315 10.911764705882355 43.2828947368421 49.088235294117645 48.09210526315789 0.5 52.901315789473685 24.79411764705882 57.71052631578947 59.5 62.51973684210526 28.264705882352942 67.32894736842105 17.852941176470587 72.13815789473684 3.970588235294116 76.94736842105263 0.5 81.75657894736842 3.970588235294116 86.5657894736842 24.79411764705882 91.375 28.264705882352942" stroke="rgba(2, 164, 153,0.8)" stroke-width="1" stroke-linecap="square"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p class="text-muted">Marketing</p>
                                    <h5>84,574</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <span class="peity-line" data-width="100%" data-peity="{ &quot;fill&quot;: [&quot;rgba(2, 164, 153,0.3)&quot;],&quot;stroke&quot;: [&quot;rgba(2, 164, 153,0.8)&quot;]}" data-height="60" style="display: none;">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span><svg class="peity" height="60" width="100%"><polygon fill="rgba(2, 164, 153,0.3)" points="0 59.5 0 20.16666666666667 4.809210526315789 46.388888888888886 9.618421052631579 7.055555555555557 14.427631578947368 33.27777777777778 19.236842105263158 39.833333333333336 24.046052631578945 7.055555555555557 28.855263157894736 52.94444444444444 33.66447368421053 39.833333333333336 38.473684210526315 20.16666666666667 43.2828947368421 26.72222222222222 48.09210526315789 0.5 52.901315789473685 46.388888888888886 57.71052631578947 7.055555555555557 62.51973684210526 52.94444444444444 67.32894736842105 33.27777777777778 72.13815789473684 7.055555555555557 76.94736842105263 0.5 81.75657894736842 7.055555555555557 86.5657894736842 46.388888888888886 91.375 52.94444444444444 91.375 59.5"></polygon><polyline fill="none" points="0 20.16666666666667 4.809210526315789 46.388888888888886 9.618421052631579 7.055555555555557 14.427631578947368 33.27777777777778 19.236842105263158 39.833333333333336 24.046052631578945 7.055555555555557 28.855263157894736 52.94444444444444 33.66447368421053 39.833333333333336 38.473684210526315 20.16666666666667 43.2828947368421 26.72222222222222 48.09210526315789 0.5 52.901315789473685 46.388888888888886 57.71052631578947 7.055555555555557 62.51973684210526 52.94444444444444 67.32894736842105 33.27777777777778 72.13815789473684 7.055555555555557 76.94736842105263 0.5 81.75657894736842 7.055555555555557 86.5657894736842 46.388888888888886 91.375 52.94444444444444" stroke="rgba(2, 164, 153,0.8)" stroke-width="1" stroke-linecap="square"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Sales Report</h4>

                    <div class="cleafix">
                        <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01
                            - Jan 31</p>
                        <h5 class="font-18 text-right">$4230</h5>
                    </div>

                    <div id="ct-donut" class="ct-chart wid"><div class="chartist-tooltip" style="top: -44px; left: 71px;"><span class="chartist-tooltip-value">54</span></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-donut" style="width: 100%; height: 100%;"><g class="ct-series ct-series-a"><path d="M70.824,167.855A49.875,49.875,0,1,0,84.875,70.125" class="ct-slice-donut" ct:value="54" style="stroke-width: 60px;"></path></g><g class="ct-series ct-series-b"><path d="M40.913,96.445A49.875,49.875,0,0,0,70.991,167.903" class="ct-slice-donut" ct:value="28" style="stroke-width: 60px;"></path></g><g class="ct-series ct-series-c"><path d="M84.875,70.125A49.875,49.875,0,0,0,40.831,96.599" class="ct-slice-donut" ct:value="17" style="stroke-width: 60px;"></path></g></svg></div>

                    <div class="mt-4">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td><span class="badge badge-primary">Desk</span></td>
                                <td>Desktop</td>
                                <td class="text-right">54.5%</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-success">Mob</span></td>
                                <td>Mobile</td>
                                <td class="text-right">28.0%</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-warning">Tab</span></td>
                                <td>Tablets</td>
                                <td class="text-right">17.5%</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Activity</h4>
                    <ol class="activity-feed">
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date">Jan 22</span>
                                <span class="activity-text">Responded to need “Volunteer
                                                        Activities”</span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date">Jan 20</span>
                                <span class="activity-text">At vero eos et accusamus et iusto odio
                                                        dignissimos ducimus qui deleniti atque...<a href="#" class="text-success">Read more</a></span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date">Jan 19</span>
                                <span class="activity-text">Joined the group “Boardsmanship
                                                        Forum”</span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date">Jan 17</span>
                                <span class="activity-text">Responded to need “In-Kind
                                                        Opportunity”</span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date">Jan 16</span>
                                <span class="activity-text">Sed ut perspiciatis unde omnis iste natus
                                                        error sit rem.</span>
                            </div>
                        </li>
                    </ol>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary">Load More</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="py-4">
                                <i class="ion ion-ios-checkmark-circle-outline display-4 text-success"></i>

                                <h5 class="text-primary mt-4">Order Successful</h5>
                                <p class="text-muted">Thanks you so much for your order.</p>
                                <div class="mt-4">
                                    <a href="" class="btn btn-primary btn-sm">Chack Status</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="text-center text-white py-4">
                                <h5 class="mt-0 mb-4 text-white-50 font-size-16">Top Product Sale</h5>
                                <h1>1452</h1>
                                <p class="font-size-14 pt-1">Computer</p>
                                <p class="text-white-50 mb-0">At solmen va esser necessi far uniform
                                    myth... <a href="#" class="text-white">View more</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Client Reviews</h4>
                            <p class="text-muted mb-3 pb-4">" Everyone realizes why a new common
                                language would be desirable one could refuse to pay expensive
                                translators it would be necessary. "</p>
                            <div class="float-right mt-2">
                                <a href="#" class="text-primary">
                                    <i class="mdi mdi-arrow-right h5"></i>
                                </a>
                            </div>
                            <h6 class="mb-0"><img src="assets/images/users/user-3.jpg" alt="" class="avatar-sm rounded-circle mr-2"> James Athey</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Trasaction</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">(#) Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col" colspan="2">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">#14256</th>
                                <td>
                                    <div>
                                        <img src="assets/images/users/user-2.jpg" alt="" class="avatar-xs rounded-circle mr-2"> Philip Smead
                                    </div>
                                </td>
                                <td>15/1/2018</td>
                                <td>$94</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#14257</th>
                                <td>
                                    <div>
                                        <img src="assets/images/users/user-3.jpg" alt="" class="avatar-xs rounded-circle mr-2"> Brent Shipley
                                    </div>
                                </td>
                                <td>16/1/2019</td>
                                <td>$112</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#14258</th>
                                <td>
                                    <div>
                                        <img src="assets/images/users/user-4.jpg" alt="" class="avatar-xs rounded-circle mr-2"> Robert Sitton
                                    </div>
                                </td>
                                <td>17/1/2019</td>
                                <td>$116</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#14259</th>
                                <td>
                                    <div>
                                        <img src="assets/images/users/user-5.jpg" alt="" class="avatar-xs rounded-circle mr-2"> Alberto Jackson
                                    </div>
                                </td>
                                <td>18/1/2019</td>
                                <td>$109</td>
                                <td><span class="badge badge-danger">Cancel</span></td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#14260</th>
                                <td>
                                    <div>
                                        <img src="assets/images/users/user-6.jpg" alt="" class="avatar-xs rounded-circle mr-2"> David Sanchez
                                    </div>
                                </td>
                                <td>19/1/2019</td>
                                <td>$120</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#14261</th>
                                <td>
                                    <div>
                                        <img src="assets/images/users/user-2.jpg" alt="" class="avatar-xs rounded-circle mr-2"> Philip Smead
                                    </div>
                                </td>
                                <td>15/1/2018</td>
                                <td>$94</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Chat</h4>
                    <div class="chat-conversation">
                        <ul class="conversation-list" data-simplebar="init" style="max-height: 367px;"><div class="simplebar-wrapper" style="margin: 0px -10px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -17px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 10px;">
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-2.jpg" class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:00</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">John Deo</span>
                                                            <p>
                                                                Hello!
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-3.jpg" class="avatar-xs rounded-circle" alt="Female">
                                                        <span class="time">10:01</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">Smith</span>
                                                            <p>
                                                                Hi, How are you? What about our next meeting?
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-2.jpg" class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:04</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">John Deo</span>
                                                            <p>
                                                                Yeah everything is fine
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-3.jpg" class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:05</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">Smith</span>
                                                            <p>
                                                                Wow that's great
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-3.jpg" class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:08</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name mb-2">Smith</span>

                                                            <img src="assets/images/small/img-1.jpg" alt="" height="48" class="rounded mr-2">
                                                            <img src="assets/images/small/img-2.jpg" alt="" height="48" class="rounded">
                                                        </div>
                                                    </div>
                                                </li>
                                            </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 719px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 187px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></ul>
                        <div class="row">
                            <div class="col-sm-9 col-8 chat-inputbar">
                                <input type="text" class="form-control chat-input" placeholder="Enter your text">
                            </div>
                            <div class="col-sm-3 col-4 chat-send">
                                <button type="submit" class="btn btn-success btn-block">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->



</div>

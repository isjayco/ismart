<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page main-home">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">      
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title-wp-box"><h4 class="mb-2">Thống kê doanh số</h4></div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box d-flex justify-content-start box-item-1">
                                    <div class="icon">
                                        <i class="fa fa-product-hunt icon"></i>
                                    </div>
                                    <div class="content">
                                        <a href="?mod=products" class="main-content-box num_products">
                                            <span class="box-title">Tổng sản phẩm</span>
                                            <span class="num-data"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end box 1  -->
                            <div class="col-md-3">
                                <div class="info-box d-flex justify-content-start box-item-2">
                                    <div class="icon">
                                        <i class="fa fa-users icon"></i>
                                    </div>
                                    <div class="content">
                                        <a href="?mod=sales&controller=customer" class="main-content-box num_customer">
                                            <span class="box-title">Tổng khách hàng</span>
                                            <span class="num-data"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end box 2  -->
                            <div class="col-md-3">
                                <div class="info-box d-flex justify-content-start box-item-3">
                                    <div class="icon">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <a href="?mod=posts" class="main-content-box posts">
                                            <span class="box-title">Tổng bài viết</span>
                                            <span class="num-data"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end box 3  -->
                            <div class="col-md-3">
                                <div class="info-box d-flex justify-content-start box-item-4">
                                    <div class="icon">
                                        <i class="fa fa-database icon"></i>
                                    </div>
                                    <div class="content">
                                        <a href="?mod=sales" class="main-content-box num_order">
                                            <span class="box-title">Tổng đơn hàng</span>
                                            <span class="num-data"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end box 4  -->
                        </div>
                    </div>
                </div>
                <div class="wp-board chart row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <figure class="highcharts-figure">
                                <div id="chart-top"></div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="wp-board row mt-4">
                    <div class="col-md-4">
                        <div class="board board-item-1">
                            <figure class="highcharts-figure">
                                <div id="chart-mid-1"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="board board-item-2">
                            <figure class="highcharts-figure">
                                <div id="chart-mid-2"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="board board-item-3">
                            <figure class="highcharts-figure">
                                <div id="chart-mid-3"></div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="statistical row mt-4">
                    <div class="col-md-8">
                        <div class="box box-item-1">
                            <figure class="highcharts-figure">
                                <div id="chart-bottom-1"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-item-2">
                            <figure class="highcharts-figure">
                                <div id="chart-bottom-2"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
<script src="public/js/chart.js"></script>
<?php get_header(); ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='post' class="fl-right content-list-page">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Doanh thu bán hàng</h3>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative">
                        <div class="notifi post"></div>
                        <div class="wp-table">
                            <figure class="highcharts-figure">
                                <div id="chart-top"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script src="public/js/chart.js"></script>
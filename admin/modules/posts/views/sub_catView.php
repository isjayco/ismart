<?php get_header() ?>
<div id="main-content-wp" class="update-post">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right" data-modules="post" data-type="sub_cat" data-id="<?php echo $id_post_cat ?>">
        <div class="container-fluid">
            <div id="wp-box-content" class="row changpass">
                <div class="col-md-5 mx-auto" id="changepass">
                    <div class="modal fade" id="update_info_post">
                        <!-- ----------------- -->
                        <div class="mx-auto modal-size">
                            <form class="modal-content overflow-auto" style="height: inherit" enctype="multipart/form-data" method="POST" id="content-update_info_post">
                                <div class="modal-header position-relative">
                                    <div class="title">
                                        <h4 class="main-title">
                                            <span>Danh sách bài viết thuộc danh mục "<?php echo $name_postCat ?>"</span>
                                            <span class="fa fa-list"></span>
                                        </h4>
                                    </div>
                                    <a href="?mod=posts&controller=postsCat" class="close d-block">
                                        <span class="fa fa-times" style="line-height: 37px;"></span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    if (!empty($list_post)) {
                                    ?>
                                        <div class="notifi post"></div>
                                        <div class="wp-table">
                                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_post" data-action="" id="table">
                                                <!-- /auto load in php/ -->
                                            </table>
                                        </div>
                                        <div id="pagination" class="col-md-12 mt-3">
                                            <div class="wp-pagination">
                                                <nav aria-lable="pagination">
                                                    <ul class="pagination justify-content-center" data-modules="post">
                                                        <!-- /auto load in php/ -->
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="notifi_process mx-auto">
                                            <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                                            <p class="txt_notifi">Hiện tại không tìm thấy bài viết nào ..!</p>
                                            <div class="add">
                                                <a href="?mod=posts&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="hidden" class="btn-show-update-post" data-toggle="modal" data-target="#update_info_post"></input>
                </div>
            </div>
        </div>
    </div>
    <div class="notifi_process mx-auto">
        <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
        <p class="txt_notifi">Vui lòng chọn một bài viết cụ thể ..!</p>
        <div class="add">
            <a href="?mod=posts" class="link-add text-center d-block">Quay lại tại đây.!</a>
        </div>
    </div>
</div>
<?php get_footer() ?>
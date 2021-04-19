<?php get_header() ?>
<div class="fade modal" id="edit_trademark" style="z-index: 10000;">
    <div class="modal-dialog">
        <form class="modal-content" method="POST">
            <div class="modal-header">
                <div class="title">
                    <h4 class="main-title">
                        <span>Cập nhật thương hiệu</span>
                        <span class="fa fa-pencil"></span>
                    </h4>
                    <span class="sub-title">(*) Tất cả mọi thay đổi của bạn đều được lưu lại trong lịch sử</span>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name_trademark">Nhập tên thương hiệu mới</label>
                    <input type="text" name="name_trademark" id="name_trademark" class="form-control shadow-none" placeholder="Tên thương hiệu">
                    <span class="notifi"></span>
                </div>
                <div class="form-group">
                    <label for="id_cat_product">Thay đổi danh mục cho thương hiệu</label>
                    <?php
                    if (!empty($list_product_cat)) {
                    ?>
                        <select name="id_cat_product" id="id_cat_product" class="form-control shadow-none">
                            <?php
                            foreach ($list_product_cat as $product_cat_item) {
                            ?>
                                <option selected='false' value="<?php echo $product_cat_item['id_productCat'] ?>" data-name="<?php echo $product_cat_item['name_productCat'] ?>"><?php echo $product_cat_item['name_productCat'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-control">
                    <a href="" data-dismiss="modal" class="btn close-modal-edit shadow-none">Đóng</a>
                    <button class="btn update-modal-edit shadow-none" data-id_trademark="">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="main-content-wp" class="update-post">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right" data-modules="trademark" data-type="subCat" data-id="<?php echo $product_cat_id ?>">
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
                                            <span>Danh sách thương hiệu thuộc danh mục "<?php echo $name_product_cat ?>"</span>
                                            <span class="fa fa-list"></span>
                                        </h4>
                                    </div>
                                    <a href="?mod=posts&controller=postsCat" class="close d-block">
                                        <span class="fa fa-times" style="line-height: 37px;"></span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    if (!empty($list_trademark)) {
                                    ?>
                                        <div class="notifi post"></div>
                                        <div class="wp-table">
                                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_trademark_product" data-action="" id="table">
                                                <!-- /auto load in php/ -->
                                            </table>
                                        </div>
                                        <div id="pagination" class="col-md-12 mt-3">
                                            <div class="wp-pagination">
                                                <nav aria-lable="pagination">
                                                    <ul class="pagination justify-content-center" data-modules="trademark">
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
                                            <p class="txt_notifi">Hiện tại không tìm thấy thương hiệu nào ..!</p>
                                            <div class="add">
                                                <a href="?mod=products&controller=trademark&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
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
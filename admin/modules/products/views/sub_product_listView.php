<?php get_header() ?>
<div class="modal fade" id="modal_total_info_products" style="z-index: 10000">
    <div class="modal-dialog modal-lg">
        <div class="modal-content position-relative">
            <span class="close-modal position-absolute" data-toggle="modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></span>
            <div class="modal-header">
                <div class="moda-header-title">
                    <h4>
                        <span class="fa fa-info-circle"></span>
                        <span>Chi tiết thông tin về sản phẩm</span>
                    </h4>
                    <span class="sub-title">Sẽ không thể chỉnh sửa sản phẩm trong phần này</span>
                </div>
            </div>
            <div class="w-100 overflow-hidden">
                <div class="modal-body" style="height: 1025px;">
                    <div class="row" style="flex-wrap: nowrap!important;">
                        <div class="col-md-12 mx-auto info-text">
                            <div class="list-info">
                                <div class="info-item my-2 id-product">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="id_product">ID</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="id_product" disabled class="form-control shadow-none" type="text" name="id_product" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 code-products">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="code_product">Mã sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="code_product" disabled class="form-control shadow-none" type="text" name="code_product" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 name-products">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="name_product">Tên sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="name_product" disabled class="form-control shadow-none" type="text" name="name_product" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 avatar-products">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="avatar_product">Avatar sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="avatar_product" class="btn btn-block text-light shadow-none" style="background-color: #b3b3b3; font-weight: bold;" type="button" name="avatar_product" value="Nhấn để xem">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 img-relative-products">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="img_relative_product">Ảnh liên quan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="img_relative_product" class="btn btn-block text-light shadow-none" style="background-color: #b3b3b3; font-weight: bold;" type="button" name="img_relative_product" value="Nhấn để xem">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 price-products">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="price_product">Giá sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="price_product" disabled class="form-control shadow-none" type="text" name="price_product" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 price-old-product">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="price_old_product">Giá cũ sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="price_old_product" disabled class="form-control shadow-none" type="text" name="price_old_product" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item qty-product">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="qty_product">Số lượng sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="qty_product" disabled class="form-control shadow-none" type="text" name="qty_product" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 status">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="status">Trạng thái sản phẩm</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="status" disabled class="form-control shadow-none" type="text" name="status" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 status-old">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="status_old">Trạng thái trước đó</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="status_old" disabled class="form-control shadow-none" type="text" name="status_old" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 creator">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="creator">Người tạo</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="creator" disabled class="form-control shadow-none" type="text" name="creator" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 created-date">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="created_date">Ngày tạo</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="created_date" disabled class="form-control shadow-none" type="text" name="created_date" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 update-date">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="update_date">Ngày update gần nhất</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="update_date" disabled class="form-control shadow-none" type="text" name="update_date" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 products-cate">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="products_cate">Danh mục</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="products_cate" disabled class="form-control shadow-none" type="text" name="products_cate" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item my-2 trademark-products">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="trademark_products">Thương hiệu</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="trademark_products" disabled class="form-control shadow-none" type="text" name="trademark_products" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 info-image">
                            <div class="image-product position-relative">
                                <div class="avatar-product" style="height: 995px;">
                                    <span class="thumb-img d-block w-100 h-100">
                                        <img src="" alt="" class="w-100 h-100">
                                    </span>
                                </div>
                                <span class="back_info_text position-fixed"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></span>
                                <div class="img-relative-product overflow-auto" style="height: 995px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="main-content-wp" class="update-post">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right" data-modules="products" data-type="subCat" data-modules_action="product_cat" data-id="<?php echo $product_cat_id ?>">
        <div class="container-fluid">
            <div id="wp-box-content" class="row changpass">
                <div class="col-md-5 mx-auto" id="changepass">
                    <div class="modal fade" id="update_info_post">
                        <!-- ----------------- -->
                        <div class="mx-auto modal-size position-relative" style="left: 45%;">
                            <form class="modal-content overflow-auto" style="height: inherit" enctype="multipart/form-data" method="POST" id="content-update_info_post">
                                <div class="modal-header position-relative">
                                    <div class="title">
                                        <h4 class="main-title">
                                            <span>Danh sách sản phẩm thuộc danh mục "<?php echo $name_product_cat ?>"</span>
                                            <span class="fa fa-list"></span>
                                        </h4>
                                    </div>
                                    <a href="?mod=products&controller=product_cat" class="close d-block">
                                        <span class="fa fa-times" style="line-height: 37px;"></span>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    if (!empty($list_products)) {
                                    ?>
                                        <div class="notifi post"></div>
                                        <div class="wp-table overflow-auto" style="max-height: 400px;">
                                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_trademark_product" data-action="" id="table">
                                                <!-- /auto load in php/ -->
                                            </table>
                                        </div>
                                        <div id="pagination" class="col-md-12 mt-3">
                                            <div class="wp-pagination">
                                                <nav aria-lable="pagination">
                                                    <ul class="pagination justify-content-center" data-modules="products">
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
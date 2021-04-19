<?php get_header(); ?>
<div id="main-content-wp" class="">
    <div class="modal fade" id="modal_total_info_products">
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
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='products' class="fl-right content-list-page">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Danh sách sản phẩm</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <a href="?mod=products&controller=product_cat&action=add" class="add_new text-decoration-none position-fixed" title="Thêm mới">
                                <i class="fa fa-plus icon" aria-hidden="true"></i>
                            </a>
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-6">
                                        <div class="top-option">
                                            <ul id="select-status" class="products-status d-flex justify-content-start">
                                                <li class="all"><a href="" class="active action-item products">Tất cả <span class="count"><?php echo count($list_products_all); ?></span></a></li>
                                                <li class="publish"><a href="" class="action-item products">Đã đăng <span class="count"><?php echo count($list_products_publish) ?></span></a></li>
                                                <li class="pending"><a href="" class="action-item products">Chờ xét duyệt <span class="count"><?php echo count($list_products_pending) ?></span></a></li>
                                                <li class="trash"><a href="" class="action-item products">Thùng rác <span class="count"><?php echo count($list_products_trash) ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 offset-3">
                                                <form action="" data-search_table="tbl_products" method="POST" class="form-s form-inline row position-relative">
                                                    <div class="option-s position-absolute">
                                                        <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                        <div class="box-option position-absolute" style="width: 145px; right: -50px">
                                                            <div class="modal-opt-dialog">
                                                                <div class="modal-opt-content">
                                                                    <ul class="list-opt-s">
                                                                        <li class="title"><span></span></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_product" class="opt-link">ID sản phẩm</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="code_product" class="opt-link">Mã sản phẩm</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="name_product" class="opt-link active">Tên sản phẩm</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_cat_product" class="opt-link">Danh mục</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="trademark_product" class="opt-link">Thương hiệu</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="creator" class="opt-link">Người tạo</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="created_date" class="opt-link">Thời gian</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-option_search="name_product" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập tên sản phẩm bạn muốn tìm kiếm ..?" autocomplete="off">
                                                    <div class="search-history" data-search_table="tbl_products">
                                                        <?php
                                                        if (!empty($list_search_history)) {
                                                        ?>
                                                            <h4 class="title"></h4>
                                                            <ul class="list-history">
                                                                <?php
                                                                foreach ($list_search_history as $search_item) {
                                                                ?>
                                                                    <li class="history-item d-flex">
                                                                        <a href="" data-option_search="<?php echo $search_item['search_option'] ?>" class="content">
                                                                            <span class="text"><?php echo $search_item['search_text']; ?></span>
                                                                            <span class="field">(<?php echo format_name_product($search_item['search_option']) ?>)</span>
                                                                        </a>
                                                                        <a href="" data-search_id="<?php echo $search_item['search_id'] ?>" class="delete">Xóa</a>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <button type="submit" name="btn_s" class="btn btn-s col-md-3 shadow-none position-absolute">Tìm kiếm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div id="sec-action">
                                    <form action="" method="POST" class="form-action form-row">
                                        <select name="actions" class="col-md-8 form-control shadow-none rounded-0">
                                            <option value="">Tác vụ</option>
                                            <option value="publish">Hoạt động</option>
                                            <option value="pending">Chờ xét duyệt</option>
                                            <option value="delete">Xóa vĩnh viễn</option>
                                            <option value="trash">Bỏ vào thùng rác</option>
                                        </select>
                                        <button type="button" name="btn_action_products" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_products" data-action="" id="table" style="height: 348px;">
                                <!-- ----------------- -->

                                <!-- ----------------- -->
                            </table>
                        </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
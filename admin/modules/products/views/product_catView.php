<?php get_header() ?>
<div class="fade modal" id="edit_product_cat">
    <div class="modal-dialog">
        <form class="modal-content" method="POST">
            <div class="modal-header">
                <div class="title">
                    <h4 class="main-title">
                        <span>Cập nhật danh mục</span>
                        <span class="fa fa-pencil"></span>
                    </h4>
                    <span class="sub-title">(*) Tất cả mọi thay đổi của bạn đều được lưu lại trong lịch sử</span>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name_product_cat">Nhập tên danh mục mới</label>
                    <input type="text" name="name_product_cat" id="name_product_cat" class="form-control shadow-none" placeholder="Tên danh mục">
                    <span class="notifi"></span>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-control">
                    <a href="" data-dismiss="modal" class="btn close-modal-edit shadow-none">Đóng</a>
                    <button class="btn update-modal-edit shadow-none" data-id_product_cat="">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="main-content-wp" class="products">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules="product_cat" class="fl-right content-list-page list-product_cat">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 sticky-top mx-auto text-center">
                        <h3 class="title-page">Danh sách danh mục sản phẩm</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <a href="?mod=products&controller=product_cat&action=add" class="add_new product_cat text-decoration-none position-fixed" title="Thêm mới">
                                <i class="fa fa-plus icon" aria-hidden="true"></i>
                                <span class="fa fa-caret-down icon"></span>
                            </a>
                            <!-- --- FORM SEARCH -- -->
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-6">
                                        <div class="top-option">
                                            <ul id="select-status" class="product_cat-status d-flex justify-content-start">
                                                <li class="all"><a href="" class="active action-item product_cat">Tất cả <span class="count"><?php echo count($list_product_cat_all); ?></span></a></li>
                                                <li class="publish"><a href="" class="action-item product_cat">Đã đăng <span class="count"><?php echo count($list_product_cat_publish); ?></span></a></li>
                                                <li class="pending"><a href="" class="action-item product_cat">Chờ xét duyệt <span class="count"><?php echo count($list_product_cat_pending); ?></span></a></li>
                                                <li class="trash"><a href="" class="action-item product_cat">Thùng rác <span class="count"><?php echo count($list_product_cat_trash); ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-8">
                                                <form action="" data-search_table="tbl_productcat" method="POST" class="form-s form-inline row position-relative">
                                                    <div class="option-s position-absolute">
                                                        <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                        <div class="box-option position-absolute" style="right:-55px; width: 144px;">
                                                            <div class="modal-opt-dialog">
                                                                <div class="modal-opt-content">
                                                                    <ul class="list-opt-s">
                                                                        <li class="title"><span></span></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_productCat" class="opt-link">Mã số</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="name_productCat" class="opt-link active">Tên danh mục</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="creator" class="opt-link">Người tạo</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="created_date" class="opt-link">Thời gian</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-option_search="name_productCat" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập tên danh mục bạn muốn tìm kiếm ..?" autocomplete="off">
                                                    <div class="search-history" data-search_table="tbl_productcat">
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
                                                                            <span class="field">(<?php echo format_name_product_cat($search_item['search_option']) ?>)</span>
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
                            <!-- --------- END FORM SEARCH --------- -->
                            <div class="col-md-4 mb-3">
                                <div id="sec-action">
                                    <form action="" method="POST" class="form-action form-row">
                                        <select name="actions" class="col-md-8 form-control shadow-none rounded-0">
                                            <!-- /auto load in php/ -->
                                        </select>
                                        <button type="button" name="btn_action_product_cat" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative" id="data-table" data-page="all_product_cat">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp" data-table="table_product_cat" data-action="" id="table">
                                <!-- auto load in php -->
                            </table>
                        </div>
                    </div>
                    <div id="pagination" class="col-md-12 mt-3">
                        <div class="wp-pagination">
                            <nav aria-label="pagination">
                                <ul class="pagination justify-content-center" data-modules="product_cat">
                                    <!-- ------/auto load in php/------ -->
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
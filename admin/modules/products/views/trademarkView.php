<?php get_header(); ?>
<div class="fade modal" id="edit_trademark">
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
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right content-list-page" data-modules="trademark">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 sticky-top mx-auto text-center">
                        <h3 class="title-page">Danh sách thương hiệu</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <a href="?mod=products&controller=trademark&action=add" style="bottom: 5%;" class="add_new trademark text-decoration-none position-fixed" title="Thêm mới">
                                <i class="fa fa-plus icon" aria-hidden="true"></i>
                                <span class="fa fa-caret-down icon"></span>
                            </a>
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-8">
                                        <div class="top-option">
                                            <ul id="select-status" class="trademark-status d-flex justify-content-start">
                                                <li class="all"><a class="action-item trademark active">Tất cả <span class="count"><?php echo $count_list_trademark; ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="" data-search_table="tbl_trademark_product" method="POST" class="form-s form-inline row position-relative">
                                            <div class="option-s position-absolute">
                                                <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                <div class="box-option position-absolute" style="width: 162px;">
                                                    <div class="modal-opt-dialog">
                                                        <div class="modal-opt-content">
                                                            <ul class="list-opt-s">
                                                                <li class="title"><span></span></li>
                                                                <li class="opt-item"><a href="" data-option_search="id_trademark" class="opt-link">Mã số</a></li>
                                                                <li class="opt-item"><a href="" data-option_search="name_trademark" class="opt-link active">Tên thương hiệu</a></li>
                                                                <li class="opt-item"><a href="" data-option_search="id_cat_product" class="opt-link">Danh mục</a></li>
                                                                <li class="opt-item"><a href="" data-option_search="creator" class="opt-link">Người tạo</a></li>
                                                                <li class="opt-item"><a href="" data-option_search="created_date" class="opt-link">Thời gian</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input data-option_search="name_trademark" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập tên thương hiệu bạn muốn tìm kiếm ..?" autocomplete="off" style="border: 1px solid rgb(204, 204, 204);">
                                            <div class="search-history" data-search_table="tbl_trademark_product" style="display: none;">
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
                                                                    <span class="field">(<?php echo format_name_trademark($search_item['search_option']) ?>)</span>
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
                            <div class="col-md-4 mb-3">
                                <div id="sec-action">
                                    <form action="" method="POST" class="form-action form-row">
                                        <select name="actions-trademark" class="col-md-8 form-control shadow-none rounded-0">
                                            <option value="">Tác vụ</option>
                                            <option value="delete">Xóa</option>
                                        </select>
                                        <button type="button" name="btn_action_trademark" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp table-hover table-striped" id="table" data-table='table_trademark_product' data-action="">

                            </table>
                        </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
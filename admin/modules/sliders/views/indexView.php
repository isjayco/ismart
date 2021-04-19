<?php get_header(); ?>
<div class="modal fade" id="modal_update_slider">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title">
                    <h4 class="main-title">
                        <span>Cập nhật slider</span>
                        <span class="fa fa-pencil"></span>
                    </h4>
                    <span class="sub-title">(*) Tất cả mọi thay đổi của bạn đều được lưu lại trong lịch sử</span>
                </div>
            </div>
            <div class="modal-body" style="padding: 0 92px;">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_slider">ID slider: </label>
                        <input type="text" disabled name="id_slider" id="id_slider" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group">
                        <label for="name_slider">Name slider: </label>
                        <input type="text" name="name_slider" id="name_slider" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group">
                        <label for="link_slider">Link slider: </label>
                        <input type="text" name="link_slider" id="link_slider" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group">
                        <div class="avatar position-relative">
                            <span class="d-block thumb-img">
                                <img src="" alt="">
                            </span>
                            <span>
                                <span class="avatar_slider fa fa-camera"></span>
                            </span>
                            <div class="mask-slider position-fixed">
                                <div class="chages_img_slider position-fixed">
                                    <div class="wp_file_slider position-relative">
                                        <input type="file" name="avatar_slider" class="avatar_slider">
                                        <button type="button" name="btn_change_img_slider" class="btn_avatar" data-action="browser">Duyệt ảnh</button>
                                        <span class="position-absolute close-modal-slider fa fa-times"></span>
                                    </div>
                                    <div class="image_slider">
                                        <span class="thumb-img">
                                            <img src="" alt="" class="img_respon">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numerical_order">Thứ tự</label>
                        <input type="text" name="numerical_order" id="numerical_order" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="button" name="close" class="btn shadow-none" data-dismiss='modal'>Đóng</button>
                        <button type="submit" name="btn_update_slider" class="btn shodow-none">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="main-content-wp" class="">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='sliders' class="fl-right content-list-page">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Danh sách siders</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <a href="?mod=sliders&action=add" class="add_new text-decoration-none position-fixed" title="Thêm mới">
                                <i class="fa fa-plus icon" aria-hidden="true"></i>
                            </a>
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-6">
                                        <div class="top-option">
                                            <ul id="select-status" class="sliders-status d-flex justify-content-start">
                                                <li class="all"><a href="" class="active action-item sliders">Tất cả <span class="count"><?php echo count($list_sliders_all) ?></span></a></li>
                                                <li class="publish"><a href="" class="action-item sliders">Đã đăng <span class="count"><?php echo count($list_sliders_publish) ?></span></a></li>
                                                <li class="pending"><a href="" class="action-item sliders">Chờ xét duyệt <span class="count"><?php echo count($list_sliders_pending) ?></span></a></li>
                                                <li class="trash"><a href="" class="action-item sliders">Thùng rác <span class="count"><?php echo count($list_sliders_trash) ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 offset-3">
                                                <form action="" data-search_table="tbl_sliders" method="POST" class="form-s form-inline row position-relative">
                                                    <div class="option-s position-absolute">
                                                        <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                        <div class="box-option position-absolute" style="width: 145px; right: -50px">
                                                            <div class="modal-opt-dialog">
                                                                <div class="modal-opt-content">
                                                                    <ul class="list-opt-s">
                                                                        <li class="title"><span></span></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_slider" class="opt-link">ID slider</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="name_slider" class="opt-link active">Tên slider</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="numerical_order" class="opt-link">Số thứ tự</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="creator" class="opt-link">Người tạo</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-option_search="name_slider" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập tên slider bạn muốn tìm kiếm ..?" autocomplete="off">
                                                    <div class="search-history" data-search_table="tbl_sliders">
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
                                                                            <span class="field">(<?php echo format_name_slider($search_item['search_option']) ?>)</span>
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
                                        <button type="button" name="btn_action_sliders" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_sliders" data-action="" id="table" style="height: 348px;"></table>
                        </div>
                    </div>
                    <div id="pagination" class="col-md-12 mt-3">
                        <div class="wp-pagination">
                            <nav aria-lable="pagination">
                                <ul class="pagination justify-content-center" data-modules="sliders"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
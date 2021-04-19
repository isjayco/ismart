<?php get_header(); ?>
<div class="modal fade" id="modal_update_advt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="title">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <span>Cập nhật quảng cáo</span>
                </h3>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_advt">ID quảng cáo</label>
                        <input type="text" name="id_advt" id="id_advt" disabled class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group">
                        <label for="link_url">Đường dẫn quảng cáo</label>
                        <input type="text" name="link_url" id="link_url" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group">
                        <label for="start_time">Ngày bắt đầu</label>
                        <input type="date" name="start_time" id="start_time" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group">
                        <label for="deadline">Ngày kết thúc</label>
                        <input type="date" name="deadline" id="deadline" class="form-control shadow-none" value="">
                    </div>
                    <div class="form-group position-relative">
                        <label for="img_url">Ảnh quảng cáo</label>
                        <a href="" class="update">update ảnh</a>
                        <div class="modal_update_img_advt position-fixed">
                            <span class="close_modal fa fa-times position-absolute"></span>
                            <div class="modal_img_dialog">
                                <div class="modal_img_content position-absolute">
                                    <input type="file" name="img_url_update" class="">
                                    <button type="button" name="btn_update_img" data-action="browser">Duyệt ảnh</button>
                                </div>
                                <div class="thumb_img_modal">
                                    <span class="thumb-img">
                                        <img src="" alt="">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="img_wrapper">
                            <span class="thumb-img">
                                <img src="" alt="">
                            </span>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="button" data-dismiss="modal" class="btn _close shadow-none">Đóng</button>
                        <button type="submit" name="btn_update_advt" class="btn _update shadow-none">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="main-content-wp" class="">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='advt' class="fl-right content-list-page">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Danh sách quảng cáo</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-6">
                                        <div class="top-option">
                                            <ul id="select-status" class="advt-status d-flex justify-content-start">
                                                <li class="all"><a href="" class="active action-item advt">Tất cả <span class="count"><?php echo count($list_advt_all) ?></span></a></li>
                                                <li class="publish"><a href="" class="action-item advt">Đã đăng <span class="count"><?php echo count($list_advt_publish) ?></span></a></li>
                                                <li class="pending"><a href="" class="action-item advt">Chờ xét duyệt <span class="count"><?php echo count($list_advt_pending) ?></span></a></li>
                                                <li class="trash"><a href="" class="action-item advt">Thùng rác <span class="count"><?php echo count($list_advt_trash) ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 offset-3">
                                                <form action="" data-search_table="tbl_advt" method="POST" class="form-s form-inline row position-relative">
                                                    <div class="option-s position-absolute">
                                                        <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                        <div class="box-option position-absolute" style="width: 160px; right: -63px">
                                                            <div class="modal-opt-dialog">
                                                                <div class="modal-opt-content">
                                                                    <ul class="list-opt-s">
                                                                        <li class="title"><span></span></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_advt" class="opt-link">ID quảng cáo</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="link_url" class="opt-link active">Link quảng cáo</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="creator" class="opt-link">Người tạo</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-option_search="link_url" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập link quảng cáo bạn muốn tìm kiếm ..?" autocomplete="off">
                                                    <div class="search-history" data-search_table="tbl_advt">
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
                                                                            <span class="field">(<?php echo format_name_advt($search_item['search_option']) ?>)</span>
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
                                        <button type="button" name="btn_action_advt" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_advt" data-action="" id="table" style="height: 348px;"></table>
                        </div>
                    </div>
                    <div id="pagination" class="col-md-12 mt-3">
                        <div class="wp-pagination">
                            <nav aria-lable="pagination">
                                <ul class="pagination justify-content-center" data-modules="advt"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
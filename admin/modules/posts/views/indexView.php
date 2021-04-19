<?php get_header(); ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='post' class="fl-right content-list-page">
            <?php
            if (!empty($list_post_all)) {
            ?>
                <div class="container-fluid">
                    <div id="wp-box-content" class="row">
                        <div class="title-content col-md-12 mx-auto text-center sticky-top">
                            <h3 class="title-page">Danh sách bài viết</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <a href="?mod=posts&action=add" class="add_new text-decoration-none position-fixed" title="Thêm mới">
                                    <i class="fa fa-plus icon" aria-hidden="true"></i>
                                </a>
                                <div class="col-md-12">
                                    <div class="sec-option row mb-3 py-2">
                                        <div class="col-md-6">
                                            <div class="top-option">
                                                <ul id="select-status" class="post-status d-flex justify-content-start">
                                                    <li class="all"><a href="" class="active action-item post">Tất cả <span class="count"><?php echo count($list_post_all) ?></span></a></li>
                                                    <li class="publish"><a href="" class="action-item post">Đã đăng <span class="count"><?php echo count($list_post_publish) ?></span></a></li>
                                                    <li class="pending"><a href="" class="action-item post">Chờ xét duyệt <span class="count"><?php echo count($list_post_pending) ?></span></a></li>
                                                    <li class="trash"><a href="" class="action-item post">Thùng rác <span class="count"><?php echo count($list_post_trash) ?></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">

                                                </div>
                                                <div class="col-md-8">
                                                    <form action="" data-search_table="tbl_posts" method="POST" class="form-s form-inline row position-relative">
                                                        <div class="option-s position-absolute">
                                                            <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                            <div class="box-option position-absolute">
                                                                <div class="modal-opt-dialog">
                                                                    <div class="modal-opt-content">
                                                                        <ul class="list-opt-s">
                                                                            <li class="title"><span></span></li>
                                                                            <li class="opt-item"><a href="" data-option_search="post_id" class="opt-link">Mã số</a></li>
                                                                            <li class="opt-item"><a href="" data-option_search="post_title" class="opt-link active">Tiêu đề</a></li>
                                                                            <li class="opt-item"><a href="" data-option_search="post_cat_id" class="opt-link">Danh mục</a></li>
                                                                            <li class="opt-item"><a href="" data-option_search="creator" class="opt-link">Người tạo</a></li>
                                                                            <li class="opt-item"><a href="" data-option_search="created_date" class="opt-link">Thời gian</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input data-option_search="post_title" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập tiêu đề bạn muốn tìm kiếm ..?" autocomplete="off">
                                                        <div class="search-history" data-search_table="tbl_posts">
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
                                                                                <span class="field">(<?php echo format_name_post($search_item['search_option']) ?>)</span>
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
                                            <button type="button" name="btn_action_post" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-content col-md-12 mx-auto position-relative">
                            <div class="notifi post"></div>
                            <div class="wp-table">
                                <table class="table main-content list-table-wp table-striped table-hover" data-table="table_post" data-action="" id="table">
                                    <!-- /auto load in php/ -->
                                </table>
                            </div>
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
    </div>
</div>
<?php get_footer(); ?>
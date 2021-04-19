<?php get_header(); ?>
<div id="main-content-wp" class="">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='customer' class="fl-right content-list-page">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Danh sách khách hàng</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-6">
                                        <div class="top-option">
                                            <ul id="select-status" class="customer-status d-flex justify-content-start">
                                                <li class="all"><a href="" class="active action-item customer">Tất cả <span class="count"><?php echo count($list_customer) ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 offset-3">
                                                <form action="" data-search_table="tbl_customer" method="POST" class="form-s form-inline row position-relative">
                                                    <div class="option-s position-absolute">
                                                        <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                        <div class="box-option position-absolute" style="width: 175px; right: -50px">
                                                            <div class="modal-opt-dialog">
                                                                <div class="modal-opt-content">
                                                                    <ul class="list-opt-s">
                                                                        <li class="title"><span></span></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_customer" class="opt-link">ID khách hàng</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="name_customer" class="opt-link active">Tên khách hàng</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="phone_customer" class="opt-link">SĐT khách hàng</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="email_customer" class="opt-link">Email khách hàng</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-option_search="name_customer" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập tên khách hàng bạn muốn tìm kiếm ..?" autocomplete="off">
                                                    <div class="search-history" data-search_table="tbl_customer">
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
                                                                            <span class="field">(<?php echo format_name_customer($search_item['search_option']) ?>)</span>
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
                                        <select name="actions_customer" class="col-md-8 form-control shadow-none rounded-0">
                                            <option value="">Tác vụ</option>
                                            <option value="delete">Xóa</option>
                                        </select>
                                        <button type="button" name="btn_action_customer" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_customer" data-action="" id="table" style="height: 348px;">
                                
                            </table>
                        </div>
                    </div>
                    <div id="pagination" class="col-md-12 mt-3">
                        <div class="wp-pagination">
                            <nav aria-lable="pagination">
                                <ul class="pagination justify-content-center" data-modules="customer">
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
<?php get_header(); ?>
<div class="fade modal" id="edit_order">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST">
            <div class="modal-header">
                <div class="title">
                    <h4 class="main-title">
                        <span>Cập nhật đơn hàng</span>
                        <span class="fa fa-pencil"></span>
                    </h4>
                    <span class="sub-title">(*) Tất cả mọi thay đổi của bạn đều được lưu lại trong lịch sử</span>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="code_order">Mã đơn hàng</label>
                    <input type="text" name="code_order" id="code_order" class="form-control shadow-none" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="order_customer">Tên khách hàng</label>
                    <input type="text" name="order_customer" id="order_customer" class="form-control shadow-none" value="">
                </div>
                <div class="form-group">
                    <label for="email_customer">Email khách hàng</label>
                    <input type="text" name="email_customer" id="email_customer" class="form-control shadow-none" value="">
                </div>
                <div class="form-group">
                    <label for="province_customer">Tỉnh / Thành phố</label>
                    <select name="province_customer" id="province_customer" class="form-control shadow-none">
                        <option value="0">Tỉnh / Thành phố</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="distrist_customer">Quận / Huyện</label>
                    <select name="distrist_customer" id="distrist_customer" class="form-control shadow-none">
                        <option value="">Quận huyện</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="street_customer">Xã / Phường / Thị trấn</label>
                    <select name="street_customer" id="street_customer" class="form-control shadow-none">
                        <option value="">Xã / Phường / Thị trấn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address_customer">Địa chỉ cụ thể</label>
                    <input type="text" name="address_customer" id="address_customer" value="" class="form-control shadow-none">
                </div>
                <div class="form-group">
                    <label for="phone_customer">Số điện thoại</label>
                    <input type="text" name="phone_customer" id="phone_customer" value="" class="form-control shadow-none">
                </div>
                <div class="form-group">
                    <label for="order_date">Thời gian đặt hàng</label>
                    <input type="date" name="order_date" id="order_date" value="" class="form-control shadow-none">
                </div>
                <div class="form-group">
                    <label for="note">Mô tả ngắn</label>
                    <textarea type="date" name="note" id="note" value="" class="form-control shadow-none"></textarea>
                </div>
                <div class="form-group">
                    <label for="detail_info">Chi tiết đơn hàng</label>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="num_order">Số lượng</label>
                            <input type="text" name="num_order" id="num_order" disabled class="form-control shadow-none">
                        </div>
                        <div class="col-md-6">
                            <label for="total_price_order">Tổng tiền</label>
                            <input type="text" name="total_price_order" id="total_price_order" disabled class="form-control shadow-none">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-control shadow-none"></select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-control">
                    <a href="" data-dismiss="modal" class="btn close-order-edit shadow-none">Đóng</a>
                    <button class="btn btn_update_order shadow-none" data-id_order="" data-id_customer="">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="main-content-wp" class="">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" data-modules='order' class="fl-right content-list-page">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Danh sách đơn hàng</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sec-option row mb-3 py-2">
                                    <div class="col-md-7">
                                        <div class="top-option">
                                            <ul id="select-status" class="order-status d-flex justify-content-start">
                                                <li class="all"><a href="" class="active action-item order">Tất cả<span class="count"><?php echo count($list_order_all); ?></span></a></li>
                                                <li class="pending"><a href="" class="action-item order">Chờ duyệt<span class="count"><?php echo count($list_order_pending); ?></span></a></li>
                                                <li class="delivery"><a href="" class="action-item order">Đang giao<span class="count"><?php echo count($list_order_delivery); ?></span></a></li>
                                                <li class="complete"><a href="" class="action-item order">Hoành thành<span class="count"><?php echo count($list_order_complete); ?></span></a></li>
                                                <li class="canceled"><a href="" class="action-item order">Đã hủy<span class="count"><?php echo count($list_order_canceled); ?></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-9 offset-3">
                                                <form action="" data-search_table="tbl_order" method="POST" class="form-s form-inline row position-relative">
                                                    <div class="option-s position-absolute">
                                                        <a href="" class="select-option title-option fa fa-caret-down"></a>
                                                        <div class="box-option position-absolute" style="width: 165px; right: -50px">
                                                            <div class="modal-opt-dialog">
                                                                <div class="modal-opt-content">
                                                                    <ul class="list-opt-s">
                                                                        <li class="title"><span></span></li>
                                                                        <li class="opt-item"><a href="" data-option_search="id_order" class="opt-link">ID đơn hàng</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="code_order" class="opt-link active">Mã đơn hàng</a></li>
                                                                        <li class="opt-item"><a href="" data-option_search="customer_id" class="opt-link">Tên khách hàng</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input data-option_search="code_order" spellcheck="false" type="text" name="q" id="s" class="form-control input-text col-md-12 shadow-none mr-2" placeholder="Nhập mã đơn hàng bạn muốn tìm kiếm ..?" autocomplete="off">
                                                    <div class="search-history" data-search_table="tbl_order">
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
                                                                            <span class="field">(<?php echo format_name_order($search_item['search_option']) ?>)</span>
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
                                        <select name="actions_order" class="col-md-8 form-control shadow-none rounded-0">
                                            <option value="">Tác vụ</option>
                                            <option value="delete">Xóa</option>
                                        </select>
                                        <button type="button" name="btn_action_order" class="btn shadow-none rounded-0 col-md-3 ml-2">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto position-relative">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp table-striped table-hover" data-table="table_order" data-action="" id="table" style="height: 348px;">
                            
                            </table>
                        </div>
                    </div>
                    <div id="pagination" class="col-md-12 mt-3">
                        <div class="wp-pagination">
                            <nav aria-lable="pagination">
                                <ul class="pagination justify-content-center" data-modules="order">
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
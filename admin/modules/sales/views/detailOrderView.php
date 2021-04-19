<?php get_header() ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right content-list-page detail-exhibition">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Chi tiết đơn hàng</h3>
                    </div>
                    <?php
                    if(!empty($orderItem) && $orderItem['customer_id'] != 0) {
                    ?>
                    <div class="section col-md-12" id="info">
                        <div class="row">
                            <div class="col-md-3 main-content p-3 mb-2">
                                <div class="section-title">
                                    <h5 class="main-content p-2 d--block">THÔNG TIN ĐƠN HÀNG</h5>
                                </div>
                            </div>
                            <div class="col-md-12 main-content p-3 mb-2">
                                <ul class="row list-item d-flex justify-content-between px-4">
                                    <li class="main-content p-2">
                                        <div class="title">
                                            <span>Mã đơn hàng</span>
                                        </div>
                                        <div class="detail"><span><?php echo $orderItem['code_order'] ?></span></div>
                                    </li>
                                    <li class="main-content p-2">
                                        <div class="title">
                                            <span>Địa chỉ nhận hàng</span>
                                        </div>
                                        <div class="detail"><?php echo $province['name_location'] . " / " . $district['name_location'] . " / " . $street['name_location'] ?><a href="tel:0385763717" title="Gọi ngay"><?php echo " - ( {$customer_item['phone_customer']} )" ?></a></div>
                                    </li>
                                    <li class="main-content p-2">
                                        <div class="title">
                                            <span>Thông tin vận chuyển</span>
                                        </div>
                                        <div class="detail"><?php echo format_payment_method($orderItem['payment_method']) ?></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7 mb-3">
                                <div class="sec-action">
                                    <form action="" method="POST" class="form-action form-row">
                                        <select name="actions" class="col-md-5 form-control shadow-none rounded-0">
                                            <option <?php if ($orderItem['status'] == "pending")  { echo "selected"; } ?> value="pending">Chờ duyệt</option>
                                            <option <?php if ($orderItem['status'] == "delivery") { echo "selected"; } ?> value="delivery">Đang giao</option>
                                            <option <?php if ($orderItem['status'] == "complete") { echo "selected"; } ?> value="complete">Hoàn thành</option>
                                            <option <?php if ($orderItem['status'] == "canceled") { echo "selected"; } ?> value="canceled">Hủy đơn</option>
                                        </select>
                                        <button type="submit" data-id_order="<?php echo $orderItem['id_order'] ?>" name="btn_update_status" class="btn shadow-none rounded-0 col-md-3 ml-2 py-0">Cập nhật đơn hàng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content col-md-12 mx-auto">
                        <div class="notifi"></div>
                        <div class="wp-table">
                            <table class="table main-content list-table-wp">
                                <thead>
                                    <tr>
                                        <td class="thead-text">STT</td>
                                        <td class="thead-text">Ảnh sản phẩm</td>
                                        <td class="thead-text">Tên sản phẩm</td>
                                        <td class="thead-text">Đơn giá</td>
                                        <td class="thead-text">Số lượng</td>
                                        <td class="thead-text">Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = 1;
                                    foreach($list_prod_cart as $cartItem) {
                                    ?>
                                    <tr>
                                        <td class="thead-text"><?php echo $temp ?></td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img src="<?php echo $cartItem['avatar'] ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="thead-text"><?php echo $cartItem['name'] ?></td>
                                        <td class="thead-text"><?php echo currency_format($cartItem['price']) ?></td>
                                        <td class="thead-text"><?php echo $cartItem['qty'] ?></td>
                                        <td class="thead-text"><?php echo currency_format($cartItem['total_price']) ?></td>
                                    </tr>
                                    <?php
                                    $temp++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="section row main- mt-3">
                            <div class="section-title col-md-12 pl-2 mb-3">
                                <h3 class=" main-content px-4 py-2 d-inline-block">GIÁ TRỊ ĐƠN HÀNG</h3>
                            </div>
                            <div class="section-detail col-md-12">
                                <ul class="list-item d-flex-justify-content-start">
                                    <li class="main-content p-2 mx-2">
                                        <span class="total-fee">Tổng số lượng</span>
                                        <span class="total">Tổng đơn hàng</span>
                                    </li>
                                    <li class="main-content p-2 mx-2">
                                        <span class="total-fee"><?php echo $orderItem['num_order'] ?> sản phẩm</span>
                                        <span class="total"><?php echo currency_format($orderItem['total_price_order']) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    } else {
                        ?>
                            <div class="notifi_process mx-auto">
                                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                                <p class="txt_notifi">Đơn hàng này hiện không tồn tại ..!</p>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
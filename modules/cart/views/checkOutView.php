<?php get_header() ?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    if( isset($_SESSION['cart']) && !empty($listProdCart)){
    ?>
    <div id="wrapper" class="wp-inner clearfix">
        <form action="" method="POST" action="" name="form-checkout" class="clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value("fullname") ?>">
                            <?php echo form_error("fullname"); ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value("email") ?>">
                            <?php echo form_error("email") ?>
                        </div>
                    </div>
                    <div class="form-row address">
                        <div class="select-col">
                            <label for="fullname">Tỉnh/thành phố</label>
                            <select name="province" id="province" data-level="1">
                                <option value="0">Tỉnh/thành phố</option>
                                <?php
                                if(!empty($listProvince)){
                                    foreach($listProvince as $provinceItem ) {
                                ?>
                                <option value="<?php echo $provinceItem['id_location']; ?>"><?php echo $provinceItem['name_location']; ?></option>
                                <?php
                                    }
                                } else {
                                    ?>
                                        <option value="">Chưa có tỉnh thành nào</option>
                                    <?php 
                                }
                                ?>
                            </select>
                            <?php echo form_error("province") ?>
                        </div>
                        <div class="select-col">
                            <label for="email">Quận/huyện</label>
                            <select name="district" id="district">
                                <option value="">Quận/huyện</option>
                            </select>
                            <?php echo form_error("district") ?>
                        </div>
                        <div class="select-col">
                            <label for="email">Phường/xã</label>
                            <select name="street" id="street">
                                <option value="">Phường/xã</option>
                            </select>
                            <?php echo form_error("street") ?>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value("address") ?>">
                            <?php echo form_error("address") ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo set_value("phone") ?>">
                            <?php echo form_error("phone") ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"><?php echo set_value("note") ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="tabel-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($listProdCart as $prodCartItem){
                                $prodCartItem['avatar_product'] = "admin/" . $prodCartItem['avatar_product'];
                                $prodCartItem['url']            = "san-pham/chi-tiet/" . create_slug($prodCartItem['name_product']) . "-{$prodCartItem['id_product']}.html"; 
                            ?>
                            <tr class="cart-item">
                                    
                                <td class="product-name">
                                    <a href="<?php echo $prodCartItem['url'] ?>" class="thumb">
                                        <img src="<?php echo $prodCartItem['avatar_product'] ?>" alt="">
                                    </a>
                                    <a href="<?php echo $prodCartItem['url'] ?>"><?php echo $prodCartItem['name_product'] ?></a>
                                    <strong class="product-quantity">x <?php echo $prodCartItem['qty_product'] ?></strong></td>
                                <td class="product-total"><?php echo currency_format($prodCartItem['totalPrice']) ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format($infoCart['total']); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment_method" value="1">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment_method" value="2">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                        <?php echo form_error("payment_method") ?>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" name="btn_order" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    } else {
        ?>
        <div class="notification-cart">
                <span class="thumb-img">
                    <img src="public/images/cart.png" alt="">
                </span>
                <p>Không có sản phẩm nào trong giỏ hàng của bạn.</p>
                <a href="?">Tiếp tục mua sắp</a>
            </div>
        <?php 
    }
    ?>
</div>
<?php get_footer(); ?>
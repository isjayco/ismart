<?php get_header(); ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    if(!empty($listProdCart)){
    ?>
    <div id="wrapper" class="wp-inner clearfix cart">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($listProdCart as $prodCartItem){
                            $prodCartItem['avatar_product'] = "admin/" . $prodCartItem['avatar_product'];
                            $prodCartItem['url']            = "san-pham/chi-tiet/" . create_slug($prodCartItem['name_product']) . "-{$prodCartItem['id_product']}.html";
                        ?>
                        <tr>
                            <td><?php echo $prodCartItem['code_product'] ?></td>
                            <td>
                                <a href="<?php echo $prodCartItem['url'] ?>" title="" class="thumb">
                                    <img src="<?php echo $prodCartItem['avatar_product'] ?>" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $prodCartItem['url'] ?>" title="" class="name-product"><?php echo $prodCartItem['name_product'] ?></a>
                            </td>
                            <td><?php echo currency_format($prodCartItem['price_product']) ?></td>
                            <td class="d-flex">
                                <span class="control-order minus-order"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                <input type="number" data-id_prod="<?php echo $prodCartItem['id_product'] ?>" value="<?php echo $prodCartItem['qty_product'] ?>" name="num-order" min="1" max="<?php echo $prodCartItem['max_qty'] ?>" value="<?php echo $prodCartItem['qty_product'] ?>" class="num-order">
                                <span class="control-order plus-order"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </td>
                            <td>
                                <span class="total-price"><?php echo currency_format($prodCartItem['totalPrice']) ?></span>
                            </td>
                            <td>
                                <a href="" title="" data-id_prod="<?php echo $prodCartItem['id_product'] ?>" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($infoCart['total']) ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="thanh-toan" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <a href="?" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
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
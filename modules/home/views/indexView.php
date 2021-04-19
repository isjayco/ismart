<?php get_header() ?>
<div id="main-content-wp" class="home-page clearfix">
    <?php getPopupModal("product") ?>
    <div class="wp-inner">
        <div class="main-content fl-right">
            <?php
            if (!empty($listSlider)) {
            ?>
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <?php
                        foreach ($listSlider as $sliderItem) {
                            $sliderItem['avatar'] = "admin/" . $sliderItem['avatar'];
                        ?>
                            <div class="item">
                                <img src="<?php echo $sliderItem['avatar'] ?>" alt="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li data-toggle="modal">
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
            if(!empty($listProductFeature)){
            ?>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach($listProductFeature as $productItem) {
                            $productItem['avatar_product'] = "admin/".$productItem['avatar_product'];
                            $productItem['url']            = "san-pham/chi-tiet/" . create_slug($productItem['name_product']) . "-{$productItem['id_product']}.html";
                        ?>
                            <li>
                                <a href="<?php echo $productItem['url'] ?>" title="" class="thumb" data-id_prod="<?php echo $productItem['id_product'] ?>">
                                    <img src="<?php echo $productItem['avatar_product'] ?>">
                                </a>
                                <a href="<?php echo $productItem['url'] ?>" title="" class="product-name"><?php echo $productItem['name_product'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($productItem['price_product']) ?></span>
                                    <span class="old"><?php echo currency_format($productItem['price_old_product']) ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=cart&action=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
            }
            ?>
            <?php
            if (!empty($listProductCat)) {
                foreach ($listProductCat as $prodCatItem) {
                    $listProduct = getListProductByIdProductCat($prodCatItem['id_productCat']);
                    if(!empty($listProduct)){
            ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title"><?php echo $prodCatItem['name_productCat'] ?></h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach($listProduct as $productItem){
                                $productItem['avatar_product'] = "admin/".$productItem['avatar_product'];
                                $productItem['url']            = "san-pham/chi-tiet/" . create_slug($productItem['name_product']) . "-{$productItem['id_product']}.html";
                            ?>
                            <li>
                                <a href="<?php echo $productItem['url'] ?>" title="" class="thumb" data-id_prod="<?php echo $productItem['id_product'] ?>">
                                    <img src="<?php echo $productItem['avatar_product'] ?>">
                                </a>
                                <a href="<?php echo $productItem['url'] ?>" title="" class="product-name"><?php echo $productItem['name_product'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($productItem['price_product']) ?></span>
                                    <span class="old"><?php echo currency_format($productItem['price_old_product']) ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=cart&action=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
                    }
                }
            }
            ?>
        </div>
        <div class="sidebar fl-left">
            <?php
            get_sidebar("catePd");
            get_sidebar("selling");
            get_sidebar("advt");
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
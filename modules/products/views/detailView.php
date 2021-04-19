<?php get_header() ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <?php getPopupModal("product") ?>
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        if(!empty($productItem)){
            $productItem['avatar_product'] = "admin/".$productItem['avatar_product'];
        ?>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <span href="" title="" id="main-thumb">
                            <img id="zoom" width="350px" height="280" src="<?php echo $productItem['avatar_product'] ?>" data-zoom-image="<?php echo $productItem['avatar_product'] ?>"/>
                        </span>
                        <?php
                        if(!empty($listImgRelativeProd)) {
                        ?>
                        <div id="list-thumb">
                            <?php
                            foreach($listImgRelativeProd as $imgRelativeItem){
                                $imgRelativeItem['name_img_relative'] = "admin/".$imgRelativeItem['name_img_relative'];
                            ?>
                            <span data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="<?php echo $imgRelativeItem['name_img_relative'] ?>">
                                <img id="zoom" src="<?php echo $imgRelativeItem['name_img_relative'] ?>" />
                            </span>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $productItem['name_product'] ?></h3>
                        <?php
                        if(!empty($listInfoDetailProd)){
                        ?>
                        <div class="desc">
                            <?php
                            foreach($listInfoDetailProd as $infoDetailItem){
                            ?>
                            <p><?php echo $infoDetailItem['name_detail'] ?> <?php echo $infoDetailItem['value_detail'] ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php echo $productItem['qty_product'] >= 1 ? "Còn hàng" : "Hết Hàng"?></span>
                        </div>
                        <p class="price"><?php echo currency_format($productItem['price_product']) ?></p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order" max="<?php echo $productItem['qty_product'] ?>">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="?page=cart" title="Thêm giỏ hàng" data-id_prod="<?php echo $productItem['id_product'] ?>" class="add-cart-detail">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                   <?php
                    if(!empty($productItem['content_product'])){
                        echo $productItem['content_product'];
                    }
                   ?>
                </div>
            </div>
            <?php
            if(!empty($litsProductRelative)){
            ?>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach($litsProductRelative as $productRelativeItem){
                            $productRelativeItem['avatar_product'] = "admin/".$productRelativeItem['avatar_product'];
                            $productRelativeItem['url']            = "?mod=products&action=detail&id={$productRelativeItem['id_product']}";
                        ?>
                        <li>
                            <a href="<?php echo $productRelativeItem['url'] ?>" title="" class="thumb">
                                <img src="<?php echo $productRelativeItem['avatar_product'] ?>">
                            </a>
                            <a href="<?php echo $productRelativeItem['url'] ?>" title="" class="product-name"><?php echo $productRelativeItem['name_product'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($productRelativeItem['price_product']) ?></span>
                                <span class="old"><?php echo currency_format($productRelativeItem['price_old_product']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>
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
        </div>
        <?php
        }
        ?>
        <div class="sidebar fl-left">
            <?php
                get_sidebar("catePd");
                get_sidebar("advt");
            ?>
        </div>
    </div>
</div>
<?php get_footer() ?>
<?php get_header() ?>
<div id="main-content-wp" class="clearfix category-product-page" data-modules="<?php echo $modules ?>" data-id_modules="<?php echo $id ?>">
    <?php getPopupModal("product") ?>
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">search</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="title-search">
                    <h4 class="title">KẾT QUẢ TÌM KIẾM VỚI TỪ KHÓA: "<?php echo $q ?>"</h4>
                    <?php
                    if($resultCheck['check'] == 0) {
                    ?>
                        <span class="sub-title">Có phải bạn đang muốn tìm " <strong><?php echo $resultCheck['rightWord'] ?></strong> "</span>
                    <?php
                    } else if ($dataSearch == "") {
                        ?>
                            <span class="sub-title">Có vẻ như bạn chưa nhập từ khóa để tìm kiếm </span>
                        <?php 
                    }
                    ?>
                </div>
                <?php
                if(!empty($dataSearch)) {
                ?>
                <div class="section-detail" data-modules='category'>
                    <ul class="list-item clearfix">
                        <?php
                        foreach ($dataSearch as $productItem) {
                            $productItem['url'] = "?mod=products&action=detail&id={$productItem['id_product']}";
                            $productItem['avatar_product'] = "admin/" . $productItem['avatar_product'];
                        ?>
                            <li>
                                <a href="<?php echo $productItem['url'] ?>" title="" data-id_prod="<?php echo $productItem['id_product'] ?>" class="thumb">
                                    <img src="<?php echo $productItem['avatar_product'] ?>">
                                </a>
                                <a href="<?php echo $productItem['url'] ?>" title="" class="product-name"><?php echo $productItem['name_product']; ?></a>
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
                <?php
                } else {
                    ?>
                        <div class="notifi_process mx-auto" style="text-align: center;">
                            <span class="thumb-img"><img src="public/images/search_not_found.png" class="img-fluid" alt="" style=" width: 300px; height: 300px; overflow: hidden; margin: 0 auto; display: block; "></span>
                            <p class="txt_notifi">Hiện tại không tìm thấy sản phẩm nào ..!</p>
                        </div>
                    <?php 
                }
                ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <div class="wp-pagination">
                        <nav aria-label="pagination">
                            <ul class="pagination" data-modules="<?php echo $modules ?>"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php
            get_sidebar("catePd");
            get_sidebar("advt");
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
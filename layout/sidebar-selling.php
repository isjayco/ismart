<?php
$listProdHot = getListProductHot();
if(!empty($listProdHot)){
?>
<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            <?php
            foreach($listProdHot as $productItem) {
                $productItem['avatar_product'] = "admin/".$productItem['avatar_product'];
                $productItem['url']            = "san-pham/chi-tiet/" . create_slug($productItem['name_product']) . "-{$productItem['id_product']}.html";
            ?>
            <li class="clearfix">
                <a href="<?php echo $productItem['url'] ?>" title="" class="thumb fl-left">
                    <img src="<?php echo $productItem['avatar_product'] ?>" alt="">
                </a>
                <div class="info fl-right">
                    <a href="<?php echo $productItem['url'] ?>" title="" class="product-name"><?php echo $productItem['name_product'] ?></a>
                    <div class="price">
                        <span class="new"><?php echo currency_format($productItem['price_product']) ?></span>
                        <span class="old"><?php echo currency_format($productItem['price_old_product']) ?></span>
                    </div>
                    <a href="thanh-toan" title="" class="buy-now">Mua ngay</a>
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

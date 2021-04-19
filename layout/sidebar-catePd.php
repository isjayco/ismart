<?php
$listProductCat = getListProductCatByStatus("publish");
if (!empty($listProductCat)) {
?>
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <?php
                foreach ($listProductCat as $productCatItem) {
                    $productCatItem['url'] = "san-pham/danh-muc/" . create_slug($productCatItem['name_productCat']) . "-{$productCatItem['id_productCat']}.html" ;
                ?>
                <li>
                    <a href="<?php echo $productCatItem['url'] ?>" title=""><?php echo $productCatItem['name_productCat'] ?></a>
                    <?php
                    $listTradeMark = getListTradeMarkByIdProductCat($productCatItem['id_productCat']);
                    if(!empty($listTradeMark)){
                    ?>
                    <ul class="sub-menu">
                        <?php
                        foreach ($listTradeMark as $tradeMarkItem) {
                            $tradeMarkItem['url'] = "san-pham/thuong-hieu/" . create_slug($tradeMarkItem['name_trademark']) . "-{$tradeMarkItem['id_trademark']}.html";
                        ?>
                        <li>
                            <a href="<?php echo $tradeMarkItem['url'] ?>" title=""><?php echo $tradeMarkItem['name_trademark'] ?></a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <?php
                    }
                    ?>
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
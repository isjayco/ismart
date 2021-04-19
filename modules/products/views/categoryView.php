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
                        <a href="" title=""><?php echo $nameCategory ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php getPopupModal("product") ?>
            <?php
            if (!empty($listProduct)) {
            ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left"><?php echo $nameCategory ?></h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị <?php echo $numPerPage ?> trong tổng <?php echo $totalProd ?> sản phẩm</p>
                            <div class="form-filter">
                                <form method="POST" action="">
                                    <select name="select">
                                        <option value="0">Sắp xếp</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="2">Từ Z-A</option>
                                        <option value="3">Giá cao xuống thấp</option>
                                        <option value="4">Giá thấp lên cao</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="section-detail" data-modules='category'>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($listProduct as $productItem) {
                                $productItem['url'] = "san-pham/chi-tiet/" . create_slug($productItem['name_product']) . "-{$productItem['id_product']}.html";
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
            <?php
            } else {
            ?>
                <div class="notifi_process mx-auto" style="text-align: center;">
                    <span class="thumb-img"><img src="admin/public/images/notFoundIcon.png" class="img-fluid" alt="" style=" width: 300px; height: 300px; overflow: hidden; margin: 0 auto; display: block; "></span>
                    <p class="txt_notifi">Hiện tại không tìm thấy sản phẩm nào <?php echo $message ?>..!</p>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="sidebar fl-left">
            <?php
            get_sidebar("catePd");
            ?>
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table data-filter="price">
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1-0"></td>
                                    <td>Tất cả</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1-500000"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="500000-1000000"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1000000-5000000"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="5000000-10000000"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="10000000-0"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if ($modules == "categoryProdByCate") {
                            $listTradeMark = getListTradeMarkByIdProductCat($id);
                            if (!empty($listTradeMark)) {
                        ?>
                                <table data-filter="tradeMark">
                                    <thead>
                                        <tr>
                                            <td colspan="2">Hãng</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="r-brand" value="0"></td>
                                            <td>Tất cả</td></td>
                                        </tr>
                                        <?php
                                        foreach($listTradeMark as $tradeMarkItem) {
                                        ?>
                                        <tr>
                                            <td><input type="radio" name="r-brand" value="<?php echo $tradeMarkItem['id_trademark'] ?>"></td>
                                            <td><?php echo $tradeMarkItem['name_trademark'] ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        <?php
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
            <?php
            get_sidebar("advt");
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
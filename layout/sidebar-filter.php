<div class="section" id="filter-product-wp">
    <div class="section-head">
        <h3 class="section-title">Bộ lọc</h3>
    </div>
    <div class="section-detail">
        <form method="POST" action="">
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Giá</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>Tất cả</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>Dưới 500.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>500.000đ - 1.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>1.000.000đ - 5.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>5.000.000đ - 10.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>Trên 10.000.000đ</td>
                    </tr>
                </tbody>
            </table>
            <?php
            $listTradeMark = getListTradeMark();
            if (!empty($listTradeMark)) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Hãng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listTradeMark as $tradeMarkItem) {
                        ?>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td><?php echo $tradeMarkItem['name_trademark'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
            <?php
            $listProdCat = getListProductCatByStatus("publish");
            if (!empty($listProdCat)) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Loại</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listProdCat as $prodCatItem) {
                        ?>
                            <tr>

                                <td><input type="radio" name="r-price"></td>
                                <td><?php echo $prodCatItem['name_productCat'] ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </form>
    </div>
</div>
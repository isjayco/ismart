<?php get_header() ?>
<div id="notifi-box" data-notifi="<?php if ($process == "success") {
                                        echo "success";
                                    } ?>">
    <?php if (!empty($notification)) {
        echo $notification;
    } else {
        echo "";
    } ?>
</div>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row changpass">
                <div class="update-pass main-content position-fixed">
                    <a href="?mod=products&controller=trademark" class="form-update list-trademark position-relative d-block">
                        <span class="fa fa-list-ul"></span>
                        <span class=" fa fa-caret-down sub-icon"></span>
                    </a>
                </div>
                <div class="main-content col-md-6 mx-auto" id="changepass">
                    <form action="" class="form-page" method="POST" id="form-add-product-cat">
                        <div class="main-content mb-3">
                            <h4 class="title">
                                <span class="fa fa-pencil-square-o icon"></span>
                                <span>Thêm thương hiệu sản phẩm</span>
                            </h4>
                            <div class="form-group">
                                <label for="name_trademark">Nhập tên thương hiệu sản phẩm sản phẩm</label>
                                <input type="name_trademark" spellcheck="false" name="name_trademark" id="name_postCat" class="form-control shadow-none" value="<?php echo set_value("name_trademark") ?>">
                                <?php echo form_error("name_trademark"); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="post_img">Logo thương hiệu</label>
                                <div class="uploadFile trademark fa fa-caret-down d-flex justify-content-start mb-1">
                                    <input type="hidden" id="thumbnail_url_trademark" name="thumbnail_url" value="">
                                    <input type="file" name="img_trademark" class="btn rounded-0" id="img_trademark" value="">
                                    <a class="shadow-none btn rounded-0 ml-2" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb-trademark">Upload</a>
                                </div>
                                <div id="img-trademark">
                                </div>
                                <?php echo form_error("img_trademark") ?>
                            </div>
                            <div class="form-group">
                                <label for="id_cat_product">Danh mục sản phẩm</label>
                                <select name="id_cat_product" id="id_cat_product" class="form-control shadow-none">

                                    <?php
                                    if (!empty($list_cat_product)) {
                                    ?>
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php
                                        foreach ($list_cat_product as $product_cat_item) {
                                        ?>
                                            <option <?php if(set_value("id_cat_product") == $product_cat_item['id_productCat']){ echo "selected"; } ?> value="<?php echo $product_cat_item['id_productCat'] ?>"><?php echo $product_cat_item['name_productCat'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="">-- Không có danh mục nào --</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php echo form_error("id_cat_product") ?>
                            </div>
                            <div class="form-group py-3">
                                <button type="submit" name="btn_add_trademark" class="btn btn-block btn-update-pass shadow-none">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
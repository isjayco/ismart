<?php get_header(); ?>
<div id="notifi-box" data-notifi="<?php if ($process == "success") {
                                        echo "success";
                                    } ?>">
    <?php if (!empty($notification)) {
        echo $notification;
    } else {
        echo "";
    } ?>
</div>
<div id="main-content-wp" class="add-product">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row">
                <div class="title-content sticky-top col-md-12 mx-auto text-center">
                    <h3 class="title-page">Thêm sản phẩm</h3>
                </div>
                <div class="main-content col-md-12 mx-auto">
                    <form action="" class="form-page" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="main-content">
                                    <div class="form-group">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="text" name="name_product" class="form-control shadow-none" value="<?php echo set_value("name_product"); ?>">
                                        <?php echo form_error("name_product") ?>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="">Giá sản phẩm</label>
                                        <input type="text" name="price_product" class="form-control shadow-none" value="<?php echo set_value("price_product"); ?>">
                                        <?php echo form_error("price_product") ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giá cũ của sản phẩm</label>
                                        <input type="text" name="price_old_product" class="form-control shadow-none" value="<?php echo set_value("price_old_product"); ?>">
                                        <span class="note">(*) Có thể bỏ qua giá trị này</span>
                                        <?php echo form_error("price_old_product") ?>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="">Mã sản phẩm</label>
                                        <input type="text" name="code_product" class="form-control shadow-none" value="<?php echo set_value("code_product"); ?>">
                                        <?php echo form_error("code_product") ?>
                                    </div>
                                    <!--  -->
                                    <div classs="form-group">
                                        <label for="">Số lượng trong kho</label>
                                        <input type="number" name="qty_product" class="form-control shadow-none" value="<?php if(!empty(set_value("qty_product"))) { echo set_value("qty_product"); } else { echo "1"; } ?>" min="1">
                                        <?php echo form_error("qty_product") ?>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="main-content">
                                    <div class="form-group">
                                        <label for="">Mô tả ngắn</label>
                                        <textarea name="desc_product" class="form-control shadow-none" style="width:100%; height: 150px" id="" cols="30" rows="10"><?php echo set_value("desc_product"); ?></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="file">Ảnh sản phẩm</label>
                                        <div class="uploadFile product d-flex justify-content-start mb-3">
                                            <input type="hidden" id="thumbnail_url_product" name="thumbnail_url" value="">
                                            <input type="file" name="img_product" class="btn rounded-0" id="img_product">
                                            <a class="shadow-none btn rounded-0 ml-2" name="btn-upload-thumb" value="Upload" id="btn-upload-avatar-product" style="display: flex;">Upload</a>
                                        </div>
                                        <div id="img-product"></div>
                                        <?php echo form_error("thumbnail_url") ?>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="file">Ảnh liên quan sản phẩm</label>
                                        <div class="uploadFile multi_img_product d-flex justify-content-start mb-3">
                                            <input type="file" name="arr_img_relative[]" class="btn rounded-0" id="upload-list" multiple>
                                            <a class="shadow-none btn rounded-0 ml-2" name="btn-upload-thumb" value="Upload" id="btn-upload-img-relative-multi" style="display: flex;">Upload</a>
                                        </div>
                                        <div id="list-img-cate-product"></div>
                                        <?php echo form_error("arr_img_relative") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="main-content">
                                    <div class="notifi success"></div>
                                    <div class="form-group">
                                        <label for="file">Mô tả của sản phẩm</label>
                                        <textarea name="content_product" class="ckeditor" id="" cols="30" rows="10"><?php echo set_value("content_product")?></textarea>
                                        <?php echo form_error("content_product") ?>
                                    </div>
                                    <div class="form-group detail-info">
                                        <?php
                                        if (!empty($list_info_detail)) {
                                            $i = 1;
                                            foreach ($list_info_detail as $key => $value) {
                                        ?>
                                                <div class="detail-item" data-detail_item="<?php $i ?>">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <span class="check-detail"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" name="name_detail[]" class="form-control shadow-none" value="<?php echo $key ?>" placeholder="Nhập tên chi tiết">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <span class="check-detail"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" name="value_detail[]" class="form-control shadow-none" value="<?php echo $value ?>" placeholder="Nhập giá trị">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>
                                            <div class="detail-item" data-detail_item="1">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <span class="check-detail"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="text" name="name_detail[]" class="form-control shadow-none" placeholder="Nhập tên chi tiết">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" name="value_detail[]" class="form-control shadow-none" placeholder="Nhập giá trị">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="" class="action-detail-item" data-action="add">Thêm</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php echo form_error("list_info_detail") ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn danh mục sản phẩm</label>
                                        <select name="parent_id" class="form-control shadow-none">
                                            <?php
                                            if (isset($list_cate_products)) {
                                            ?>
                                                <option value="">-- Chọn danh mục --</option>
                                                <?php
                                                foreach ($list_cate_products as $cate_product_item) {
                                                ?>
                                                    <option value="<?php echo $cate_product_item['id_productCat'] ?>"><?php echo $cate_product_item['name_productCat'] ?></option>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="" disabled selected>Hiện tại không có danh mục nào</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error("parent_id") ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn thương hiệu sản phẩm</label>
                                        <select name="trademark_id" class="form-control shadow-none">
                                            <option value="">Lựa chọn một danh mục</option>
                                        </select>
                                        <?php echo form_error("trademark_id") ?>
                                    </div>
                                    <div class="from-group">
                                        <label for="">Trạng thái</label>
                                        <select name="status" class="form-control shadow-none">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option <?php if( set_value("status") == 'publish' ) { echo "selected"; } ?> value="publish">Hoạt động</option>
                                            <option <?php if( set_value("status") == 'pending' ) { echo "selected"; } ?> value="pending">Chờ duyệt</option>
                                        </select>
                                        <span class="note">(*) Nếu không chọn mặc định sẽ là trạng thái <strong>Chờ duyệt</strong></span>
                                        <?php echo form_error("status") ?>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button type="submit" name="btn_add_product" class="btn my-2 btn-block shadow-none" id="btn-submit">Thêm mới</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
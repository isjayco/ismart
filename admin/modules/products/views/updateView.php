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
<div class="main-content" class="update-post">
    <div class="notifi"></div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <?php
    if (!empty($product_item)) {
    ?>
        <div id="content" class="fl-right">
            <div class="container-fluid">
                <div id="wp-box-content" class="row changpass">
                    <div class="col-md-5 mx-auto" id="changepass">
                        <!-- ---------------------- -->
                        <div class="modal-change-img position-fixed">
                            <div class="modal-change-dialog">
                                <div class="moda-change-content">
                                    <span class="close-modal-change position-absolute"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <form action="" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center">
                                        <input type="hidden" name="thumb_img_new" value="">
                                        <input type="file" name="img_new" class="img-new shadow-none" style="cursor:pointer;">
                                        <button type="submit" class="btn shadow-none btn_change_img_new" data-action="load_img">Duyệt ảnh</button>
                                    </form>
                                    <div class="detail_img_change position-relative">
                                        <span class="thumb-bg d-block w-100 h-100 overflow-hidden">
                                            <img src="" alt="" class="w-100">
                                        </span>
                                        <span class="thumb-img position-absolute">
                                            <img src="" alt="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ---------------------- -->
                        <!-- ------------------------------  -->
                        <div class="fade modal" id="open_modal_total_img" style="z-index: 1500;" data-id_product="<?php echo $product_item['id_product'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="background-color: rgba(0,0,0,0.8); width: 1000px; transform: translate(-96px, 10px);">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="detail-img position-relative">
                                                    <span class="thumb-img">
                                                        <img src="<?php echo $product_item['avatar_product'] ?>" alt="" class="img-respon">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <nav id="tab-option">
                                                    <div class="nav nav-tabs">
                                                        <a href="#option-1" class="nav-item nav-link active" data-toggle="tab">Avatar</a>
                                                        <a href="#option-2" class="nav-item nav-link" data-toggle="tab">Ảnh liên quan</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="option-1">
                                                        <div class="top-option">
                                                            <h4 class="title-option">
                                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                                <span>Thông tin</span>
                                                            </h4>
                                                            <ul data-type_image="avatar">
                                                                <li class="img-item content-option position-relative">
                                                                    <span class="thumb-img" title="ℹ️ Click vào để xem thông tin">
                                                                        <img src="<?php echo $product_item['avatar_product'] ?>" alt="">
                                                                        <a href="" class="change fa fa-pencil position-absolute" data-action="change" title="✍️Đổi ảnh"></a>
                                                                    </span>
                                                                    <div class="info-img position-absolute">
                                                                        <?php
                                                                        $cut_path_and_exten = explode('.', $product_item['avatar_product']);
                                                                        $name_file = explode('/', $cut_path_and_exten[0]);
                                                                        $info_file = array(
                                                                            "name_file"  => $name_file[4],
                                                                            "path_file"  => $name_file[0] . "/" . $name_file[1] . "/" . $name_file[2] . "/" . $name_file[3] . "/...",
                                                                            "exten_file" => $cut_path_and_exten[1],
                                                                            "size_file"  => round(filesize($product_item['avatar_product']) / 1048576, 2) . " MB",
                                                                        );
                                                                        ?>
                                                                        <ul class="list-info" spellcheck="false">
                                                                            <li class="d-flex align-items-center">
                                                                                <strong class="info-name">Tên file:</strong>
                                                                                <p class="info-value">
                                                                                    <span class="file-name" title="Double chuột để update tên" contenteditable="false"><?php echo $info_file['name_file'] ?></span><strong class="file-exten">.<?php echo $info_file['exten_file'] ?></strong>
                                                                                </p>
                                                                            </li>
                                                                            <li class="d-flex align-items-center">
                                                                                <strong class="info-name">Đường dẫn:</strong>
                                                                                <p class="info-value"><span class="file-path ml-1" title="Double chuột để xem chi tiết"><?php echo $info_file['path_file'] ?></span></p>
                                                                            </li>
                                                                            <li class="d-flex align-items-center">
                                                                                <strong class="info-name">Kích thước:</strong>
                                                                                <p class="info-value"><span class="file-size ml-1" title="Double chuột để xem chi tiết"><?php echo $info_file['size_file'] ?></span></p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="option-2">
                                                        <div class="top-option">
                                                            <h4 class="title-option">
                                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                                <span>Thông tin</span>
                                                            </h4>
                                                        </div>
                                                        <div class="content-option">
                                                            <ul class="list-img-relative-product" data-type_image="relative">
                                                                <?php
                                                                if (!empty($list_relative_img)) {
                                                                    foreach ($list_relative_img as $relative_img_item) {
                                                                        $cut_path_and_exten = explode('.', $relative_img_item['name_img_relative']);
                                                                        $name_file = explode('/', $cut_path_and_exten[0]);
                                                                        $info_file = array(
                                                                            "name_file"  => $name_file[4],
                                                                            "path_file"  => $name_file[0] . "/" . $name_file[1] . "/" . $name_file[2] . "/" . $name_file[3] . "/...",
                                                                            "exten_file" => $cut_path_and_exten[1],
                                                                            "size_file"  => round(filesize($relative_img_item['name_img_relative']) / 1048576, 2) . " MB",
                                                                        );
                                                                ?>
                                                                        <li class="img-item position-relative">
                                                                            <span class="thumb-img position-relative" title="ℹ️ Click vào để xem thông tin" data-id_image="<?php echo $relative_img_item['id_img_relative'] ?>">
                                                                                <img src="<?php echo $relative_img_item['name_img_relative'] ?>" alt="">
                                                                                <a href="" class="delete fa fa-trash position-absolute" data-action="delete" title="🚮Xóa ảnh"></a>
                                                                                <a href="" class="change fa fa-pencil position-absolute" data-action="change" title="✍️Đổi ảnh"></a>
                                                                            </span>
                                                                            <div class="info-img position-absolute">
                                                                                <ul class="list-info" spellcheck="false">
                                                                                    <li class="d-flex align-items-center">
                                                                                        <strong class="info-name">Tên file:</strong>
                                                                                        <p class="info-value">
                                                                                            <span class="file-name" title="Double chuột để update tên" contenteditable="false"><?php echo $info_file['name_file'] ?></span><strong class="file-exten">.<?php echo $info_file['exten_file'] ?></strong>
                                                                                        </p>
                                                                                    </li>
                                                                                    <li class="d-flex align-items-center">
                                                                                        <strong class="info-name">Đường dẫn:</strong>
                                                                                        <p class="info-value"><span class="file-path ml-1" title="Double chuột để xem chi tiết"><?php echo $info_file['path_file'] ?></span></p>
                                                                                    </li>
                                                                                    <li class="d-flex align-items-center">
                                                                                        <strong class="info-name">Kích thước:</strong>
                                                                                        <p class="info-value"><span class="file-size ml-1" title="Double chuột để xem chi tiết"><?php echo $info_file['size_file'] ?></span></p>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ------------------------------- -->
                        <div class="modal fade" id="update_info_post">
                            <div class="mx-auto modal-size">
                                <form class="modal-content overflow-auto" enctype="multipart/form-data" method="POST" id="content-update_info_post">
                                    <div class="modal-header position-relative">
                                        <div class="title">
                                            <h4 class="main-title">
                                                <span>Cập nhật thông tin sản phẩm</span>
                                                <span class="fa fa-pencil"></span>
                                            </h4>
                                            <span class="sub-title">(*) Tất cả mọi thay đổi của bạn đều được lưu lại trong lịch sử</span>
                                        </div>
                                        <a href="#" class="close d-block">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="top-modal-body fixed d-flex justify-content-between mb-4">
                                            <div class="modal-item num_order">
                                                <h4 class="title">
                                                    <span class="fa fa-list-ol"></span>
                                                    <span>STT</span>
                                                </h4>
                                                <span class="sub-content"><?php echo $location; ?></span>
                                            </div>
                                            <div class="modal-item code">
                                                <h4 class="title">
                                                    <span class="fa fa-codepen"></span>
                                                    <span>Mã số</span>
                                                </h4>
                                                <span class="sub-content"><?php echo $product_item['id_product'] ?></span>
                                            </div>
                                            <div class="modal-item creator">
                                                <h4 class="title">
                                                    <span class="fa fa-user-plus"></span>
                                                    <span>Người tạo</span>
                                                </h4>
                                                <span class="sub-content"><?php echo $product_item['creator'] ?></span>
                                            </div>
                                            <div class="modal-item created_date">
                                                <h4 class="title">
                                                    <span class="fa fa-calendar"></span>
                                                    <span>Thời gian</span>
                                                </h4>
                                                <span class="sub-content"><?php echo $product_item['created_date'] ?></span>
                                            </div>
                                        </div>
                                        <div class="bottom-modal-body position">
                                            <div class="form-group mx-2">
                                                <label for="name_product">Tên sản phẩm</label>
                                                <input type="text" name="name_product" id="name_product" class="form-control shadow-none" spellcheck="false" value="<?php echo $product_item['name_product'] ?>">
                                                <?php echo form_error("name_product") ?>
                                            </div>
                                            <div class="form-group mx-2">
                                                <label for="code_product">Mã sản phẩm</label>
                                                <input type="text" name="code_product" id="code_product" class="form-control shadow-none" spellcheck="false" value="<?php echo $product_item['code_product'] ?>">
                                                <?php echo form_error("code_product") ?>
                                            </div>
                                            <div class="form-group mx-2">
                                                <label for="price_product">Giá sản phẩm</label>
                                                <input type="text" name="price_product" id="price_product" class="form-control shadow-none" spellcheck="false" value="<?php echo $product_item['price_product'] ?>">
                                                <?php echo form_error("price_product") ?>
                                            </div>
                                            <div class="form-group mx-2">
                                                <label for="price_old_product">Giá cũ sản phẩm</label>
                                                <input type="text" name="price_old_product" id="price_old_product" class="form-control shadow-none" spellcheck="false" value="<?php echo ($product_item['price_old_product'] != null ? $product_item['price_old_product'] : "Sản phẩm không có giá cũ");  ?>">
                                            </div>
                                            <div class="form-group mx-2">
                                                <label for="qty_product">Số lượng trong kho</label>
                                                <input type="number" name="qty_product" id="qty_product" class="form-control shadow-none" spellcheck="false" min="1" value="<?php echo $product_item['qty_product'] ?>">
                                                <?php echo form_error("qty_product") ?>
                                            </div>
                                            <div class="form-group mx-2">
                                                <label for="desc_product">Mô tả sản phẩm</label>
                                                <textarea name="desc_product" id="desc-product" cols="20" rows="5" spellcheck="false" class="form-control shadow-none"><?php echo $product_item['desc_product'] ?></textarea>
                                                <?php echo form_error("desc_product") ?>
                                            </div>
                                            <div class="form-group mx-2" id="fine-uploader-manual-trigger">
                                                <label for="content_product">Nội dung bài viết</label>
                                                <div id="content_product-append">
                                                    <textarea name="content_product" id="content-product" class="ckeditor" cols="30" style="height: 200px" rows="10"><?php echo $product_item['content_product'] ?></textarea>
                                                </div>
                                                <?php echo form_error("content_product") ?>
                                            </div>
                                            <div class="form-group mx-2">
                                                <a href="" data-toggle="modal" data-target="#open_modal_total_img" class="show_total_img">
                                                    <span class="fa fa-info-circle"></span>
                                                    <span>Xem toàn bộ ảnh sản phẩm</span>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Thông tin chi tiết sản phẩm</label>
                                                <?php
                                                $temp = 1;
                                                foreach ($list_info_detail as $info_detail_item) {
                                                ?>
                                                    <div class="detail-item" data-detail_item="<?php echo $temp ?>">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <span class="check-detail"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" name="name_detail[]" class="form-control shadow-none" value="<?php echo $info_detail_item['name_detail'] ?>" placeholder="Nhập tên chi tiết">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <span class="check-detail"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" name="value_detail[]" class="form-control shadow-none" value="<?php echo $info_detail_item['value_detail'] ?>" placeholder="Nhập giá trị">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    $temp++;
                                                }
                                                ?>
                                                <div class="detail-item">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-3 mx-auto">
                                                                    <a href="" class="action-detail-item py-1" data-action="add">Thêm</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo form_error("name_detail") ?>
                                            </div>
                                            <div class="form-group mx-2">
                                                <label for="">Chọn danh mục sản phẩm</label>
                                                <select name="parent_id" class="form-control shadow-none">
                                                    <?php
                                                    if (isset($list_products_cat)) {
                                                    ?>
                                                        <option value="">-- Chọn danh mục --</option>
                                                        <?php
                                                        foreach ($list_products_cat as $product_cat_item) {
                                                        ?>
                                                            <option <?php if ($product_cat_item['id_productCat'] == $product_item['id_cat_product']) echo "selected"; ?> value="<?php echo $product_cat_item['id_productCat'] ?>"><?php echo $product_cat_item['name_productCat'] ?></option>
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
                                                    <?php
                                                        if(!empty($trademark_item)) {
                                                            ?>
                                                                <option value="<?php echo $trademark_item['id_trademark'] ?>"><?php echo $trademark_item['name_trademark'] ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                                <?php echo form_error("trademark_id") ?>
                                            </div>
                                            <div class="from-group py-3">
                                                <label for="">Trạng thái</label>
                                                <select name="status" class="form-control shadow-none">
                                                    <option value="">-- Chọn trạng thái --</option>
                                                    <option value="publish">Hoạt động</option>
                                                    <option value="pending">Chờ duyệt</option>
                                                </select>
                                                <span class="note">(*) Nếu không chọn mặc định sẽ là trạng thái <strong>Chờ duyệt</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="btn_update_product" class="btn shadow-none btn-block btn-update-info-post">cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" class="btn-show-update-post" data-toggle="modal" data-target="#update_info_post"></input>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="notifi_process mx-auto">
            <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
            <p class="txt_notifi">Vui lòng chọn một bài viết cụ thể ..!</p>
            <div class="add">
                <a href="?mod=products" class="link-add text-center d-block">Quay lại tại đây.!</a>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="notifi_process mx-auto">
        <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
        <p class="txt_notifi">Vui lòng chọn một bài viết cụ thể ..!</p>
        <div class="add">
            <a href="?mod=posts" class="link-add text-center d-block">Quay lại tại đây.!</a>
        </div>
    </div>
</div>
<?php get_footer() ?>
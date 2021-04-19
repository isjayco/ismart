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
<div id="main-content-wp" class="add-post">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        </d>
        <div id="content" class="fl-right">
            <div class="container-fluid">
                <div id="wp-box-content" class="row">
                    <div class="title-content sticky-top col-md-9 mx-auto text-center">
                        <h3 class="title-page">Thêm slider</h3>
                    </div>
                    <div class="main-content col-md-9 mx-auto">
                        <form action="" class="form-page" method="POST">
                            <div class="main-content mb-3">
                                <div class="form-group">
                                    <label for="name_slider">Tiêu slider</label>
                                    <input type="text" name="name_slider" class="form-control shadow-none" id="name_slider" value="<?php echo set_value("name_slider") ?>">
                                    <?php echo form_error("name_slider") ?>
                                </div>
                                <div class="form-group">
                                    <label for="friendly_url">Link thân thiện</label>
                                    <input type="text" name="friendly_url" class="form-control shadow-none" id="friendly_url" value="<?php echo set_value("friendly_url") ?>">
                                    <?php
                                    if (!empty(form_error("friendly_url"))) {
                                        echo form_error("friendly_url");
                                    } else {
                                    ?>
                                        <span class="note">(*) Nếu không chọn mặc định sẽ là <strong>Tiêu đề bài viết</strong></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="numerical_order">Số thứ tự</label>
                                    <input type="text" name="numerical_order" id="numerical_order" class="form-control shadow-none" autocomplete="off" value="<?php echo set_value("numerical_order") ?>">
                                    <div id="notification-numerical_order" class="position-relative">
                                        <?php echo form_error("numerical_order") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="main-content">
                                <div class="form-group mb-3">
                                    <label for="slider_img">Hình ảnh</label>
                                    <div class="uploadFile slider fa fa-caret-down d-flex justify-content-start mb-3">
                                        <input type="hidden" id="thumbnail_url" name="thumbnail_url" value="<?php echo set_value("thumbnail_url") ?>">
                                        <input type="file" name="slider_img" class="btn rounded-0" id="slider_img" value="">
                                        <a class="shadow-none btn rounded-0 ml-2 d-flex" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">Upload</a>
                                    </div>
                                    <div id="slider_img_append">
                                        <?php
                                        if (!empty(set_value("thumbnail_url"))) {
                                        ?>
                                            <span class="thumb-img position-relative">
                                                <img src="<?php echo set_value("thumbnail_url") ?>" id="path_img">
                                                <small class="position-absolute" style="top: 50%;left: 14%;color: #fff;font-style: italic;font-size: 25px;opacity: .6;">Ảnh bài đăng trước</small>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php echo form_error("thumbnail_url") ?>
                                </div>
                                    <div class="form-group py-3 mt-4">
                                        <label for="status">Trạng thái</label>
                                        <select name="status" id="status" class="form-control shadow-none">
                                            <option value="">-- Trạng thái slider --</option>
                                            <option value="publish">Hoạt động</option>
                                            <option value="pending">Chờ duyệt</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="btn_add_slider" class="btn my-2 btn-block shadow-none" id="btn-submit">Thêm slider</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
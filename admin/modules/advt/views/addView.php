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
                        <h3 class="title-page">Thêm quảng cáo</h3>
                    </div>
                    <div class="main-content col-md-9 mx-auto">
                        <form action="" class="form-page" method="POST">
                            <div class="main-content mb-3">
                                <div class="form-group">
                                    <label for="link_url">Link quảng cáo</label>
                                    <input type="text" name="link_url" class="form-control shadow-none" id="link_url" value="<?php echo set_value("link_url") ?>">
                                    <?php echo form_error("link_url") ?>
                                </div>
                            </div>
                            <div class="main-content mb-3">
                                <div class="form-group">
                                    <label for="start_time">Thời gian bắt đầu</label>
                                    <input type="date" name="start_time" class="form-control shadow-none" id="start_time" value="<?php echo set_value("start_time") ?>">
                                    <?php echo form_error("start_time") ?>
                                </div>
                            </div>
                            <div class="main-content mb-3">
                                <div class="form-group">
                                    <label for="deadline">Thời gian hết hạn</label>
                                    <input type="date" name="deadline" class="form-control shadow-none" id="deadline" value="<?php echo set_value("deadline") ?>">
                                    <?php echo form_error("deadline") ?>
                                </div>
                            </div>
                            <div class="main-content">
                                <div class="form-group mb-3">
                                    <label for="img_url">Hình ảnh</label>
                                    <div class="uploadFile advt fa fa-caret-down d-flex justify-content-start mb-3">
                                        <input type="hidden" id="thumbnail_url" name="thumbnail_url" value="">
                                        <input type="file" name="img_url" class="btn rounded-0" id="img_url" value="">
                                        <a class="shadow-none btn rounded-0 ml-2 d-flex" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">Upload</a>
                                    </div>
                                    <div id="img_url_append">
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
                                            <option value="">-- Trạng thái quảng cáo --</option>
                                            <option value="publish">Hoạt động</option>
                                            <option value="pending">Chờ duyệt</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="btn_add_advt" class="btn my-2 btn-block shadow-none" id="btn-submit">Thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
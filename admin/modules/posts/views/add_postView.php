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
                        <h3 class="title-page">Thêm bài viết</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <a href="?mod=posts&controller=postsCat&action=add" class="add_new post_cat text-decoration-none position-fixed" title="Thêm mới">
                                <i class="fa fa-plus icon" aria-hidden="true"></i>
                                <span class="fa fa-caret-down icon"></span>
                            </a>
                        </div>
                    </div>
                    <div class="main-content col-md-9 mx-auto">
                        <form action="" class="form-page" method="POST">
                            <div class="main-content mb-3">
                                <div class="form-group">
                                    <label for="post_title">Tiêu đề bài viết</label>
                                    <input type="text" name="post_title" class="form-control shadow-none" id="post_title" value="<?php echo set_value("post_title") ?>">
                                    <?php echo form_error("post_title") ?>
                                </div>
                                <div class="form-group">
                                    <label for="friendly_url">Đường dẫn thân thiện</label>
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
                            </div>
                            <div class="main-content">
                                <div class="form-group">
                                    <label for="post_desc">Mô tả bài viết</label>
                                    <textarea name="post_desc" id="post_desc" rows="5" class="form-control shadow-none"><?php echo set_value("post_desc") ?></textarea>
                                    <?php echo form_error("post_desc") ?> 
                                </div>
                                <div class="form-group">
                                    <label for="post_content">Viết nội dung cho bài viết</label>
                                    <textarea name="post_content" id="post_content" class="ckeditor form-control"><?php echo set_value("post_content") ?></textarea>
                                    <?php echo form_error("post_content") ?>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="post_img">Hình ảnh</label>
                                    <div class="uploadFile post fa fa-caret-down d-flex justify-content-start mb-3">
                                        <input type="hidden" id="thumbnail_url" name="thumbnail_url" value="">
                                        <input type="file" name="post_img" class="btn rounded-0" id="post_img" value="<?php echo set_value("thumbnail_url") ?>">
                                        <a class="shadow-none btn rounded-0 ml-2" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">Upload</a>
                                    </div>
                                    <div id="img-post">
                                        <?php
                                        if (!empty(set_value("thumbnail_url"))) {
                                        ?>
                                            <span class="thumb-img position-relative">
                                                <img src="<?php echo set_value("thumbnail_url") ?>" id="path_img">
                                                <small class="position-absolute" style="    top: 50%;left: 14%;color: #fff;font-style: italic;font-size: 25px;opacity: .6;">Ảnh bài đăng trước</small>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php echo form_error("post_img") ?>
                                </div>
                                <div class="form-group py-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control shadow-none">
                                        <option value="">-- Trạng thái bài viết --</option>
                                        <option value="publish">Hoạt động</option>
                                        <option value="pending">Chờ duyệt</option>
                                    </select>
                                    <span class="note">(*) Nếu không chọn mặc định sẽ là trạng thái <strong>Chờ duyệt</strong></span>
                                </div>
                                <div class="form-group pb-3">
                                    <label for="parent-cat">Danh mục bài viết</label>
                                    <select name="parent_cat" id="parent_cat" class="form-control shadow-none">
                                        <?php
                                        if (!empty($list_post_cat)) {
                                        ?>
                                            <option value="">-- Chọn danh mục cho bài viết --</option>
                                            <?php
                                            foreach ($list_post_cat as $post_cat_item) {
                                            ?>
                                                <option <?php if (set_value("parent_cat") == $post_cat_item['id_postCat']) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $post_cat_item['id_postCat'] ?>">
                                                    <?php echo $post_cat_item['name_postCat'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="">Hiện tại không có danh mục nào</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error("parent_cat"); ?>
                                </div>
                                <button type="submit" name="btn_add_post" class="btn my-2 btn-block shadow-none" id="btn-submit">Thêm bài viết</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
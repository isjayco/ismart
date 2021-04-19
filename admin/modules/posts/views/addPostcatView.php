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
                    <a href="?mod=posts&controller=postsCat" class="form-update list-postcat position-relative d-block">
                        <span class="fa fa-list-ul"></span>
                        <span class=" fa fa-caret-down sub-icon"></span>
                    </a>
                </div>
                <div class="main-content col-md-5 mx-auto" id="changepass">
                    <form action="" class="form-page" method="POST" id="form-add-post-cat">
                        <div class="main-content mb-3">
                            <h4 class="title">
                                <span class="fa fa-pencil-square-o icon"></span>
                                Thêm danh mục bài viết
                            </h4>
                            <div class="form-group">
                                <label for="name_postCat">Nhập tên danh mục</label>
                                <input type="name_postCat" spellcheck="false" name="name_postCat" id="name_postCat" class="form-control shadow-none" value="<?php echo set_value("name_postCat"); ?>">
                                <?php echo form_error("name_postCat") ?>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control shadow-none">
                                    <option value="">-- Trạng thái danh mục --</option>
                                    <option value="publish">Hoạt động</option>
                                    <option value="pending">Chờ xác nhận</option>
                                </select>
                            </div>
                            <div class="form-group py-3">
                                <button type="submit" name="btn_add_postCat" class="btn btn-block btn-update-pass shadow-none">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
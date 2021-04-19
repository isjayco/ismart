<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row">
                <div class="title-content sticky-top col-md-9 mx-auto text-center">
                    <h3 class="title-page">Cập nhật thông tin tài khoảng</h3>
                </div>
                <div class="update-pass main-content position-fixed">

                    <a href="?mod=users&action=changepass" class="form-update position-relative d-block">
                        <span class="fa fa-pencil-square-o icon"></span>
                        <span class=" fa fa-caret-down sub-icon"></span>
                    </a>
                </div>
                <div class="main-content col-md-9 mx-auto">
                    <form action="" class="form-page" method="POST">
                        <div class="main-content mb-3">
                            <div class="form-group">
                                <label for="fullname">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control shadow-none" id="fullname" value="<?php echo info_user("fullname") ?>">
                                <?php echo form_error("fullname") ?>
                            </div>
                            <div class="form-group">
                                <label for="username">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control shadow-none" id="username" readonly="readonly" value="<?php echo info_user("username") ?>">
                            </div>
                        </div>
                        <div class="main-content">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control shadow-none" readonly="readonly" value="<?php echo info_user('email') ?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gới tính</label>
                                <input type="text" name="gender" id="gender" class="form-control shadow-none" readonly="readonly" value="<?php echo format_gender(info_user('gender')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" class="form-control shadow-none" value="<?php echo info_user("phone_number") ?>">
                                <?php echo form_error("phone") ?>
                            </div>
                            <div class="form-group pb-4">
                                <label for="address">Địa chỉ</label>
                                <textarea name="address" id="address" class="form-control shadow-none" cols="30" rows="10"><?php echo info_user("address") ?></textarea>
                                <?php echo form_error("address") ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_error("no") ?>
                                <button type="submit" name="btn_update_user" class="btn my-2 btn-block shadow-none" id="btn-submit">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
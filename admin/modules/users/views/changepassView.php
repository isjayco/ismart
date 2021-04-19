<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row changpass">
                <div class="update-pass main-content position-fixed">
                    <a href="?mod=users&action=update" class="form-update position-relative d-block">
                        <span class="fa fa-pencil-square-o icon"></span>
                        <span class=" fa fa-caret-down sub-icon"></span>
                    </a>
                </div>
                <div class="main-content col-md-5 mx-auto" id="changepass">
                    <form action="" class="form-page" method="POST">
                        <div class="main-content mb-3">
                            <h4 class="title">
                                <span class="fa fa-pencil-square-o icon"></span>
                                Thay đổi mật khẩu
                            </h4>
                            <div class="form-group">
                                <label for="old_pass">Mật khẩu cũ</label>
                                <input type="password" name="old_pass" id="old_pass" class="form-control shadow-none">
                                <?php echo form_error('old_pass') ?>
                            </div>
                            <div class="form-group">
                                <label for="new_pass">Mật khẩu mới</label>
                                <input type="password" name="new_pass" id="new_pass" class="form-control shadow-none">
                                <?php echo form_error('new_pass') ?>
                            </div>
                            <div class="form-group">
                                <label for="confirm_pass">Nhập lại mật khẩu mới</label>
                                <input type="password" name="confirm_pass" id="confirm_pass" class="form-control shadow-none">
                                <?php echo form_error('confirm_pass') ?>
                                <?php echo form_error('no') ?>
                            </div>
                            <div class="form-group py-3">
                                <button type="submit" name="btn_update_pass" class="btn btn-block btn-update-pass shadow-none">Cập nhật</button>
                            </div>
                            <div class="form-group py-0 my-0 text-center">
                                <a href="?mod=users&action=getpass">Quên mật khẩu cũ?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
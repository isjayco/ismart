<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row">
                <div class="title-content sticky-top col-md-7 mx-auto text-center">
                    <h3 class="title-page">Thông tin cá nhân</h3>
                </div>
                <div class="main-content col-md-7 mx-auto">
                    <form action="" class="form-page" method="POST">
                        <div class="main-content mb-3">
                            <div class="form-group">
                                <label for="title-post">Họ và tên</label>
                                <input type="text" name="title_post" class="form-control shadow-none" id="title-post" value="<?php echo info_user('fullname') ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="slug">Tên đăng nhập</label>
                                <input type="text" name="slug" class="form-control shadow-none" id="slug" value="<?php echo info_user('username') ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="slug">Email</label>
                                <input type="text" name="slug" class="form-control shadow-none" id="slug" value="<?php echo info_user('email') ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="slug">Số điện thoại</label>
                                <input type="text" name="slug" class="form-control shadow-none" id="slug" 
                                value="<?php echo info_user('phone_number') ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="phone">Địa chỉ</label>
                                <textarea readonly="readonly" name="address" id="" cols="30" rows="10" style="height: 100px;" class="form-control shadow-none"><?php echo info_user("address") ?></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
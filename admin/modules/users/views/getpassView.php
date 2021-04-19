<?php get_header('user'); ?>
<div class="card">
    <div class="card-body">
        <form id="sign_in" action="" method="POST">
            <p class="msg">Nếu bạn quên mật khẩu hoặc bị mất cắp, đừng lo lắng chúng tôi sẽ giúp bạn lấy lại một cách nhanh chống</p>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="text" name="email" id="email" required="">
                    <label for="email" class="user">Email</label>
                    <?php echo form_error('email') ?>
                    <?php echo form_error('account') ?>
                </div>
            </div>
            <div class="bottom-form" style="padding: 20px 0;">
                <div class="form-group">
                    <button type="submit" name="btn_getpass" class="full_size">RESET MY PASSWORD</button>
                </div>
            </div>
            <div class="lost_pass">
                <a href="?mod=users&action=login">Sign in!</a>
            </div>
        </form>
    </div>
</div>
<?php get_footer('user'); ?>
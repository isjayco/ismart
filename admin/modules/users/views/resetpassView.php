<?php get_header('user'); ?>
<div class="card">
    <div class="card-body">
        <form id="sign_in" action="" method="POST">
            <p class="msg">Hãy thiết lập một mật khẩu thật an toàn để bảo vệ chính bạn và cả chúng tôi.. Xin chân thành cảm ơn.!</p>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="password" name="password" id="password" required="">
                    <label for="password" class="user">Password</label>
                    <?php echo form_error('password') ?>
                </div>
            </div>
            <div class="input-group">
                <span class="form-group-addon logo-user password">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="password" name="confirm_password" id="confirm_password" required="">
                    <label for="confirm_password" class="user">Confirm password</label>
                    <?php echo form_error('confirm_password') ?>
                </div>
            </div>
            <div class="bottom-form" style="padding: 20px 0;">
                <div class="form-group">
                    <button type="submit" name="btn_resetpass" class="full_size">CHANGE PASSWORD</button>
                </div>
            </div>
            <div class="lost_pass">
                <a href="?mod=users&action=login">Sign in!</a>
            </div>
        </form>
    </div>
</div>
<?php get_footer('user'); ?>
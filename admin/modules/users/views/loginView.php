<?php get_header("user"); ?>
<div class="card">
    <div class="card-body">
        <form id="sign_in" action="" method="POST">
            <p class="msg">
                <?php if(!empty($changepass)) {echo $changepass; } else { ?>Đăng nhập để bắt đầu phiên của bạn<?php } ?>
            </p>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="text" name="username" id="username" required="" autocomplete="off">
                    <label for="username" class="user">Username</label>
                    <?php echo form_error("username") ?>
                </div>
            </div>
            <div class="input-group">
                <span class="form-group-addon logo-user password">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="password" name="password" id="password" required="" autocomplete="off">
                    <label for="password" class="user">Password</label>
                    <?php echo form_error('password') ?>
                    <?php echo form_error('account') ?>
                </div>
            </div>
            <div class="bottom-form" style="padding: 20px 0;">
                <div class="form-group" style="padding: 9px 0;">
                    <input type="checkbox" id="remember_me" name="remember_me" class="filled-in">
                    <label for="remember_me" class="remember_me">Remember me</label>
                </div>
                <div class="form-group">
                    <button type="submit" name="btn_login">SIGN IN</button>
                </div>
            </div>
            <div class="lost_pass">
                <a href="?mod=users&action=getpass">Forgot Password?</a>
            </div>
        </form>
    </div>
</div>
<?php get_footer("user"); ?>
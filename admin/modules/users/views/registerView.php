<?php get_header('user'); ?>
<div class="card">
    <div class="card-body" style="">
        <form id="sign_in" action="" method="POST">
            <p class="msg" style="margin-bottom: 10px;">Sau khi đăng ký tài khoảng bạn có tự do sử dụng các chức năng trong trương trình</p>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="text" name="fullname" id="fullname" required="" value="<?php echo set_value("fullname") ?>">
                    <label for="fullname" class="user">Fullname</label>
                    <?php if(!empty(form_error("fullname")) || !empty(set_value("fullname"))){ echo form_error("fullname"); } else { ?> <span class="rule fa">Số ký tự phải lớn hơn 5 và nhỏ hơn 33</span> <?php } ?>
                </div>
            </div>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="text" name="username" id="username" required="" value="<?php echo set_value("username") ?>">
                    <label for="username" class="user">Username</label>
                    <?php if(!empty(form_error("username")) || !empty(set_value("username"))){ echo form_error("username"); } else { ?> <span class="rule fa">Yêu cầu nhập các ký tự 0-9, a-z, A-Z , _, \, .</span> <?php } ?>
                </div>
            </div>
            <div class="input-group">
                <span class="form-group-addon logo-user password">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="password" name="password" id="password" required="">
                    <label for="password" class="user">Password</label>
                    <?php if(!empty(form_error("password")) || !empty(set_value("password"))){ echo form_error("password"); } else { ?> <span class="rule fa">Yêu cầu bắt đầu bằng a-z A-Z và cho phép 0-9 a-z A-Z @#$%^&*_!</span> <?php } ?>
                </div>
            </div>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <input type="text" name="email" id="email" required="" value="<?php echo set_value("email") ?>">
                    <label for="email" class="user">Email</label>
                    <?php if(!empty(form_error("email")) || !empty(set_value("email"))){ echo form_error("email"); } else { ?> <span class="rule fa">Yêu cầu nhập email đang tồn tại</span> <?php } ?>
                </div>
            </div>
            <div class="input-group">
                <span class="form-group-addon logo-user">
                    <i class="fa fa-venus-mars" aria-hidden="true"></i>
                </span>
                <div class="form-group">
                    <select name="gender" id="">
                        <option value="">--Gender--</option>
                        <option value="male" <?php if(set_value("gender")=='male'){echo "selected";}; ?>>Nam</option>
                        <option value="female"<?php if(set_value("gender")=='female'){echo "selected";}; ?>>Nữ</option>
                    </select>
                    <?php echo form_error("gender") ?>
                </div>
            </div>
            <div class="bottom-form" style="padding: 20px 0;">
                <div class="form-group">
                    <?php echo form_error('account'); ?>
                    <button type="submit" name="btn_register" class="full_size">REGISTER</button>
                </div>
            </div>
            <div class="lost_pass">
                <a href="?mod=users&action=login">Sign in!</a>
            </div>
        </form>
    </div>
</div>
<?php get_footer('user'); ?>
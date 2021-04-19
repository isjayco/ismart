
<?php
    function construct() {
        load_model('index');
    }

    function indexAction() {

    }
    
    // === REGISTER ACTION ===//
    function registerAction() {
        global $email;
        load('lib','validation_form');
        load('lib','sendMail');
        if(isset($_POST['btn_register'])) {
            $error = array();
            global $error;
            // check fullname
            if(empty($_POST['fullname'])) {
                $error['fullname'] = "<span class='error'>(*) Họ và tên không được để trống</span>";
            } else {
                if( !(strlen($_POST['fullname'])>=6 && strlen($_POST['fullname'])<=32) ){
                    $error['fullname'] = "<span class='error'>(*) Họ và tên phải lớn hơn 5 và nhỏ hơn 33 ký tự</span>";
                } else {
                    $fullname = $_POST['fullname'];
                }
            }

            // check username
            if(empty($_POST['username'])) {
                $error['username'] = "<span class='error'>(*) Tên đăng nhập không được để trống</span>";
            } else {
                if( !(strlen($_POST['username'])>=6 && strlen($_POST['username'])<=32) ) {
                    $error['username'] = "<span class='error'>(*) Tên đăng nhập phải lớn hơn 5 và nhỏ hơn 33 ký tự</span>";
                } else {
                    if(!is_username($_POST['username'])) {
                        $error['username'] = "<span class='error'>(*) Tên đăng nhập không hợp lệ</span>";
                    } else {
                        $username = $_POST['username'];
                    }
                }
            }

            // check password
            if(empty($_POST['password'])){
                $error['password'] = "<span class='error'>(*) Mật khẩu không được để trống</span>";
            } else {
                if( !(strlen($_POST['password'])>=6 && strlen($_POST['password'])<=32) ) {
                    $error['password'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 32 ký tự</span>";
                } else {
                    if(!is_password($_POST['password'])){
                        $error['password'] = "<span class='error'>(*) Mật khẩu sai định dạng</span>";
                    } else {
                        $password = md5($_POST['password']);
                    }
                }
            }

            // check email
            if(empty($_POST['email'])){
                $error['email'] = "<span class='error'>(*) Email không được bỏ trống</span>";
            } else {
                if(!is_email($_POST['email'])){
                    $error['email'] = "<span class='error'>(*) Email sai định dạng</span>";
                } else {
                    $email = $_POST['email'];
                }
            }

            // check gender
            if(empty($_POST['gender'])){
                $error['gender'] = "<span class='error'>(*) Giới tính không được bỏ trống</span>";
            } else {
                $gender = $_POST['gender'];
            }

            if(empty($error)){
                if(!user_exists($username,$email)){
                    $active_token = md5($username.time());
                    $data = array(
                        "fullname" => escape_string($fullname),
                        "username" => escape_string($username),
                        "password" => escape_string($password),
                        "email"    => escape_string($email),
                        "gender"   => $gender,
                        "active_token" => escape_string($active_token)
                    );
                    $link_active = base_url("?mod=users&action=active&token={$active_token}");
                    $name_receiver = $fullname;
                    $email_receiver = $email;
                    $subject = "Xác thực tài khoảng tại HungS.vn";
                    $content = "<div style='width: 70%;
                    min-width: 300px;
                    padding: 30px;
                    margin: 0 auto;
                    background-color: #f1f3f4;
                    border: 11px solid #cbcccc;
                    box-shadow: 0 0 10px rgba(0,0,0,0.6);'>
                    <h3 style='    text-align: center;
                    font-size: 25px;
                    margin: 5px auto;
                    background: #fff;
                    padding: 5px 24px;
                    display: inline-block;
                    color: #474747;'>
                    HungS.vn xin kinh chào Anh/Chi {$fullname}
                    </h3>
                    <div style='padding: 20px;
                    font-size: 15px;
                    color: #746a6a;'>
                        <p>Đây là thông tin xác thực tài khoản của quý khách</p>
                        <p>Xin vui lòng click vào nút bên dưới để kích hoạt tài khoảng</p>
                        <p>Nếu đây không phải là yêu cầu của quý khách xin vui lòng bỏ qua email này</p>
                        <p>Không được chia sẽ email này với bất kỳ ai</p>
                        <a href='{$link_active}' target='_blank' style='text-decoration: none;
                    background-color: #6ba7d7;
                    padding: 8px 20px;
                    color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 0 5px rgba(0,0,0,0.5);
                    margin: 10px 0;
                    display: inline-block;'>Click vào đây để kích hoạt tài khoảng</a>
                        <p>Mọi thắt mắt xin liên hệ tại địa chỉ email: <span>phamdinhhung212@gmail.com</span></p>
                        <p>Xin chân thành cảm ơn ..!</p>
                    </div>
                </div>";
                    add_user($data);
                    send_mail($name_receiver, $email_receiver, $subject, $content);
                } else {
                    if(check_user_not_active($username,$email)){
                        $error['account'] = "<span class='error account'>(*) Tài khoảng này đã được đăng ký trước đó nhưng chưa được kích hoạt, bạn vui lòng kiễm tra lại email để kích hoạt tài khoảng</span>";
                    } else {
                        $error['account'] = "<span class='error account'>(*) Tên đăng nhập hoặc email đã tồn tại trong hệ thống</span>";
                    }
                }
            }
        }
        load_view('register');
    }

    // === ACTIVE USER ACTION ===//
    function activeAction() {
        $active_token = !empty($_GET['token'])?$_GET['token']:"";
        if(!empty($active_token)){
            if(check_active_token($active_token)){
                active_user($active_token);
                $data = array(
                    "title_notifi" => "Bạn đã đăng ký tài khoảng thành công",
                    "sub_title_notifi" => "Vui lòng click vào nút bên dưới để bắt đầu đăng nhập hệ thống",
                    "btn_to_email" => "Click vào đây để đăng nhập",
                    "link" => "?mod=users&action=login"
                );
                load_view('process_notifi',$data);
                $_SESSION['id_allow'] = md5(rand(1,1000).time());
            }  else {
                $data = array(
                    "title_notifi" => "Yêu cầu không hợp lệ",
                    "sub_title_notifi" => "Mã kích hoạt này đã được sử dụng trước đó hoặc không tồn tại",
                    "btn_to_email" => "Click vào đây để kiểm tra",
                    "link" => "?mod=users&action=login"
                );
                load_view('process_notifi',$data);
            }
        }  else {
            $data = array(
                "title_notifi" => "Yêu cầu không hợp lệ",
                "sub_title_notifi" => "Bạn vui lòng kiểm tra lại yêu cầu của mình",
                "btn_to_email" => "Click vào đây để login lại",
                "link" => "?mod=users&action=login"
            );
            load_view('process_notifi',$data);
        }
    }

    // === LOGIN ACTION ===//
    function loginAction() {
        load('lib','validation_form');
        $changepass = !empty($_GET['changepass'])?$_GET['changepass']:"";
        if($changepass == 'success'){
            $data_process['changepass'] = "<span class='success'>Thay đổi mật khẩu thành công</span>";
        }
        if(isset($_POST['btn_login'])){
            $error = array();
            global $error;
            // check username
            if(empty($_POST['username'])){
                $error['username'] = "<span class='error'>(*) Tên đăng nhập không được bỏ trống</span>";
            } else {
                if( !(strlen($_POST['username'])>=6 && strlen($_POST['username'])<=32) ){
                    $error['username'] = "<span class='error'>(*) Tên đăng nhập phải lớn hơn 5 và nhỏ hơn 33 ký tự</span>";
                } else {
                    if(!is_username($_POST['username'])){
                        $error['username'] = "<span class='error'>(*) Tên đăng nhập không hợp lệ</span>";
                    } else {
                        $username = $_POST['username'];
                    }
                }
            }
            // check password
            if(empty($_POST['password'])){
                $error['password'] = "<span class='error'>(*) Mật khẩu không được bỏ trống</span>";
            } else {
                if( !(strlen($_POST['password'])>=6 && strlen($_POST['password'])<=32) ){
                    $error['password'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 33 ký tự</span>";
                } else {
                    if(!is_password($_POST['password'])){
                        $error['password'] = "<span class='error'>(*) Mật khẩu không hợp lệ</span>";
                    } else {
                        $password = $_POST['password'];
                    }
                }
            }

            // check login
            if(empty($error)){
                if(check_login($username,$password)){
                    if(!empty($_POST['remember_me'])){
                        setcookie('is_login',true,time()+1800,'/');
                        setcookie('user_login',$username,time()+1800,'/');
                    }
                    $_SESSION['is_login'] = true;
                    $_SESSION['user_login'] = $username;
                    redirect("?");
                } else {
                    $error['account'] = "<span class='error'>(*) Tên đăng nhập hoặc mật khẩu không tồn tại</span>";
                }
            }
        }
        if(!empty($data_process)){
            load_view('login',$data_process);
        } else {
            load_view('login');
        }
        
    }


    // === GETPASS ACTION ===//
    function getpassAction() {
        load('lib','validation_form');
        load('lib','sendMail');
        if(isset($_POST['btn_getpass'])){
            $error = array();
            global $error;
            // check email
            if(empty($_POST['email'])){
                $error['email'] = "<span class='error'>(*) Email không được bỏ trống</span>";
            } else {
                if(!is_email($_POST['email'])){
                    $error['email'] = "<span class='error'>(*) Email không hợp lệ</span>";
                } else {
                    $email = $_POST['email'];
                }
            }
            if(empty($error)){
                if(check_email($email)) {
                    $reset_token = md5($email.time());
                    $data = array(
                        'reset_pass_token' => $reset_token
                    );
                    update_reset_token($data,$email);
                    $user_getpass = get_data_user($email);
                    $id_reset = md5(rand(1,1000).time());
                    $_SESSION['id_reset'] = $id_reset;
                    $link_reset = base_url("?mod=users&action=resetpass&token={$reset_token}&id_reset={$_SESSION['id_reset']}");
                    $name_receiver = $user_getpass['fullname'];
                    $email_receiver = $email;
                    $subject = "Xác thực tài khoảng tại HungS.vn";
                    $content = "<div style='width: 70%;
                    min-width: 300px;
                    padding: 30px;
                    margin: 0 auto;
                    background-color: #f1f3f4;
                    border: 11px solid #cbcccc;
                    box-shadow: 0 0 10px rgba(0,0,0,0.6);'>
                    <h3 style='    text-align: center;
                    font-size: 25px;
                    margin: 5px auto;
                    background: #fff;
                    padding: 5px 24px;
                    display: inline-block;
                    color: #474747;'>
                    HungS.vn xin kinh chào Anh/Chi {$user_getpass['fullname']}
                    </h3>
                    <div style='padding: 20px;
                    font-size: 15px;
                    color: #746a6a;'>
                        <p>Đây là thông tin lấy lại tài khoảng của quý khách</p>
                        <p>Xin vui lòng click vào nút bên dưới để bắt đầu thiết lập lại mật khẩu</p>
                        <p>Nếu đây không phải là yêu cầu của quý khách xin vui lòng bỏ qua email này</p>
                        <p>Không được chia sẽ email này với bất kỳ ai</p>
                        <a href='{$link_reset}' target='_blank' style='text-decoration: none;
                    background-color: #6ba7d7;
                    padding: 8px 20px;
                    color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 0 5px rgba(0,0,0,0.5);
                    margin: 10px 0;
                    display: inline-block;'>Click vào đây để thiết lập lại mật khẩu</a>
                        <p>Mọi thắt mắt xin liên hệ tại địa chỉ email: <span>phamdinhhung212@gmail.com</span></p>
                        <p>Xin chân thành cảm ơn ..!</p>
                    </div>
                </div>";
                    send_mail($name_receiver, $email_receiver, $subject, $content);
                } else {
                    $error['account'] = "<span class='error'>(*) Email không tồn tại trong hệ thống</span>";
                }
            }
        }
        load_view('getpass');
    }

    // === RESETPASS ACTION ===//
    function resetpassAction() {
        load('lib','validation_form');
        global $error;
        $reset_token = !empty($_GET['token'])?$_GET['token']:"";
        $id_reset    = !empty($_GET['id_reset'])?$_GET['id_reset']:"";
        if(!empty($reset_token) && "{$id_reset}" == "{$_SESSION['id_reset']}"){
            if(check_reset_token_exists($reset_token)){
                
                if(isset($_POST['btn_resetpass'])){
                    $error = array();
                    global $error;
                    if(empty($_POST['password'])){
                        $error['password'] = "<span class='error'>(*) Mật khẩu không được để trống</span>";
                    } else {
                        if( !(strlen($_POST['password'])>=6 && strlen($_POST['password'])<=32) ) {
                            $error['password'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 32 ký tự</span>";
                        } else {
                            if(!is_password($_POST['password'])){
                                $error['password'] = "<span class='error'>(*) Mật khẩu sai định dạng</span>";
                            } else {
                                $password = $_POST['password'];
                            }
                        }
                    }

                    // check comfirm password
                    if(empty($_POST['confirm_password'])){
                        $error['confirm_password'] = "<span class='error'>(*) Mật khẩu không được để trống</span>";
                    } else {
                        if( !(strlen($_POST['confirm_password'])>=6 && strlen($_POST['confirm_password'])<=32) ) {
                            $error['confirm_password'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 32 ký tự</span>";
                        } else {
                            if(!is_password($_POST['confirm_password'])){
                                $error['confirm_password'] = "<span class='error'>(*) Mật khẩu sai định dạng</span>";
                            } else {
                                if( $_POST['confirm_password'] != $password ){
                                    $error['confirm_password'] = "<span class='error'>(*) Mật khẩu không trùng khớp</span>";
                                } else {
                                    $confirm_password = $_POST['confirm_password'];
                                }
                            }
                        }
                    }

                    // check process
                    if(empty($error)){
                        $data_update = array(
                            "password" => md5($confirm_password)
                        );
                        $process = update_pass_user($data_update,$reset_token);
                        echo $process;
                        if($process == 1){
                            redirect("?mod=users&action=login&changepass=success");
                            $_SESSION['id_reset'] = md5(rand(1,1000).time());
                        }
                    }
                }
                load_view('resetpass');
            } else {
                $data = array(
                    "title_notifi" => "Thay đổi mật khẩu không thành công",
                    "sub_title_notifi" => "Mã xác thực đã tồn tại hoặc đã được kích hoạt trước đó",
                    "btn_to_email" => "Click vào đây để kiễm tra",
                    "link" => "?mod=users&action=login"
                );
                load_view('process_notifi',$data);
            }
        } else {
            $data = array(
                "title_notifi" => "Yêu cầu không hợp lệ",
                "sub_title_notifi" => "Quý khách vui lòng kiễm tra lại quá trình",
                "btn_to_email" => "Click vào đây để login lại",
                "link" => "?mod=users&action=login"
            );
            load_view('process_notifi',$data);
        }
    }

    // === PROCESS NOTIFI ACTION ===//
    function process_notifiAction() {
        $id_allow = !empty($_GET['id_allow'])?$_GET['id_allow']:"";
        if( !empty($id_allow) && @$id_allow == $_SESSION['id_allow'] ) {
            $data = array(
                "title_notifi" => "Mã xác thực tài khoảng đã được gửi để email của bạn",
                "sub_title_notifi" => "Bạn vui lòng truy cập email để kích hoạt tài khoảng",
                "btn_to_email" => "Click vào đây để đến email của bạn",
                "link" => "https://mail.google.com"
            );
            load_view('process_notifi',$data);
        } else {
            $data = array(
                "title_notifi" => "Yêu cầu không hợp lệ",
                "sub_title_notifi" => "Bạn vui lòng kiểm tra lại yêu cầu của mình",
                "btn_to_email" => "Click vào đây để login lại",
                "link" => "?mod=users&action=login"
            );
            load_view('process_notifi',$data);
        }
        
    }

    //=== LOGOUT USER ===//
    function logoutAction() {
        setcookie('is_login',true,time()-1800,'/');
        setcookie('user_login',user_login(),time()-1800,'/');
        unset($_SESSION['is_login']);
        unset($_SESSION['user_login']);
        redirect('?mod=users&action=login');
    }

    //=== CHANGE PASSWORD ===//
    function changepassAction() {
        load('lib','validation_form');
        if(isset($_POST['btn_update_pass'])) {
            $error = array();
            global $error;
            // check old pass
            if(empty($_POST['old_pass'])){
                $error['old_pass'] = "<span class='error'>(*) Mật khẩu không được để trống</span>";
            } else {
                if( !(strlen($_POST['old_pass'])>=6 && strlen($_POST['old_pass'])<=32) ) {
                    $error['old_pass'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 32 ký tự</span>";
                } else {
                    if(!is_password($_POST['old_pass'])){
                        $error['old_pass'] = "<span class='error'>(*) Mật khẩu sai định dạng</span>";
                    } else {
                        $old_pass = md5($_POST['old_pass']);
                        $username = $_SESSION['user_login'];
                        if(!password_exists($old_pass,$username)){
                            $error['old_pass'] = "<span class='error'>(*) Mật khẩu không chính xác</span>";
                        }
                    }
                }
            }

            // check new pass
            if(empty($_POST['new_pass'])){
                $error['new_pass'] = "<span class='error'>(*) Mật khẩu mới không được để trống</span>";
            } else {
                if( !(strlen($_POST['new_pass'])>=6 && strlen($_POST['new_pass'])<=32) ) {
                    $error['new_pass'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 32 ký tự</span>";
                } else {
                    if(!is_password($_POST['new_pass'])){
                        $error['new_pass'] = "<span class='error'>(*) Mật khẩu sai định dạng</span>";
                    } else {
                        $new_pass = md5($_POST['new_pass']);
                    }
                }
            }

            // check confirm pas
            if(empty($_POST['confirm_pass'])){
                $error['confirm_pass'] = "<span class='error'>(*) Nhập lại mật khẩu không được để trống</span>";
            } else {
                if( !(strlen($_POST['confirm_pass'])>=6 && strlen($_POST['confirm_pass'])<=32) ) {
                    $error['confirm_pass'] = "<span class='error'>(*) Mật khẩu phải lớn hơn 5 và nhỏ hơn 32 ký tự</span>";
                } else {
                    if(!is_password($_POST['confirm_pass'])){
                        $error['confirm_pass'] = "<span class='error'>(*) Mật khẩu sai định dạng</span>";
                    } else {
                        if( md5($_POST['confirm_pass']) != $new_pass ) {
                            $error['confirm_pass'] = "<span class='error'>(*) Mật khẩu không trùng khớp</span>";
                        } else {
                            $confirm_pass = md5($_POST['confirm_pass']);
                        }
                    }
                }
            }

            if(empty($error)){
                $data = array(
                    "password" => $confirm_pass
                );
                $process = update_pass_new($data,$username);
                if($process == 1){
                    $error['no'] = "<span class='success'>Thay đổi mật khẩu thành công</span>";
                }
            }

        } 
        load_view('changepass');
    }
    // === UPDATE USER ITEM ===//
    function updateAction(){
        load('lib','validation_form');
        load('helper','format');
        if(isset($_POST['btn_update_user'])) {
            $error = array();
            global $error;
            // check fullname
            if(empty($_POST['fullname'])){
                $error['fullname'] = "<span class='error'>(*) Bạn chưa nhập họ và tên mới</span>";
            } else {
                if( !(strlen($_POST['fullname'])>=6 && strlen($_POST['fullname'])<=32) ){
                    $error['fullname'] = "<span class='error'>(*) Họ và tên phải lớn hơn 5 và nhỏ hơn 33 ký tự</span>";
                } else {
                    $fullname_new = $_POST['fullname'];
                }
            }
            // check phone number
            if(empty($_POST['phone'])) {
                $error['phone'] = "<span class='error'>(*) Vui lòng không bỏ trống số điện thoại</span>";
            } else {
                if(!is_phone($_POST['phone'])){
                    $error['phone'] = "<span class='error'>(*) Số điện thoại sai định dạng</span>";
                } else {
                    $phone_new = $_POST['phone'];
                }
            }
            // check address
            if(empty($_POST['address'])){
                $error['address'] = "<span class='error'>(*) Vui lòng không để trống địa chỉ của bạn</span>";
            } else {
                $address_new = $_POST['address'];
            }

            // update when not error
            if(empty($error)){
                $username = $_SESSION['user_login'];
                $data = array(
                    "fullname"     => escape_string($fullname_new),
                    "phone_number" => escape_string($phone_new),
                    "address"      => escape_string($address_new)
                );
                $process = update_user($data,$username);
                if($process == 1){
                    $error['no'] = "<span class='success update'>Cập nhật thành công</span>";
                }
            }
        }
        load_view('update');
    }
    //=== INFO USER ITEM ===//
    function infoAction() {
        load_view('info');
    }
    //=== UPDATE AVATAR USER ===//
    function avatarAction() {
        
    }

?>
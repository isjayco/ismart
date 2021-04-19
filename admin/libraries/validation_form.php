<?php
     // check number valid
     function is_number($number) {
        $pattern = "/^[0-9]*$/";
        if(preg_match($pattern,$number,$matches)) return true;
        return false;
    }

    // check username valid
    function is_username($username) {
        $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
        if(preg_match($partten,$username,$matches)) return true;
        return false;
    }

    // check password valid
    function is_password($password) {
        $partten = "/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z@#$%^&*_!]{6,}$/";
        if(preg_match($partten,$password,$matches)) return true;
        return false;
    }
    // check email valid
    function is_email($email){
        $partten = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/";
        if(preg_match($partten,$email,$matches)) return true;
        return false;
    }

    // check phone number valid
    function is_phone($phone) {
        $partten = "/((09|03|07|08|05)+([0-9]{8})\b)/";
        if(preg_match($partten,$phone,$matches)) return true;
        return false;
    }

    // form error
    function form_error($field) {
        global $error;
        if(!empty($error[$field])) return $error[$field];
        return false;
    }
    
    // set value
    function set_value($field){
        if(!empty($_POST[$field])) return $_POST[$field];
        return false;
    }

    // set value file
    function set_value_file($path_file) {
        if (isset($_FILES[$path_file])) {
            return $_FILES[$path_file];
        } return false;
    }
?>
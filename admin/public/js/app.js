$(document).ready(function () {
    //== SIDEBAR AVATAR ==//
    $("#sidebar .avatar-opt").click(function(){
        let src_img = $("#sidebar .user-info .avatar .thumb-img img").attr('src');
        $("#my-avatar .add-avatar .shell-avt .thumb-avt img").attr('src',src_img);
        $.ajax({
            type    : "POST",
            url     : "?mod=users&action=avatar",
            data    : "data",
            dataType: "text",
            success : function (data) {
                console.log(src_img);
            },
            error   : function(xhr,ajaxOptions,thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
});

$(document).ready(function () {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

//  CHECK ALL
    $("body").delegate('#checkAll','click',function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });
    // OPTION SETTING RESPON
    $(".icons ul.list-icons li.option-setting a").click(function() {
        $("#site .wp-respon-menu .setting-respon").toggleClass('show');
        $("#wp-mask").toggleClass('show');
        return false;
    });
    $("#wp-mask").click(function() {
        $("#site .wp-respon-menu .setting-respon").removeClass('show');
        $(this).removeClass('show');
    });

    // SHOW MENU 
    $(".icons ul.list-icons li.jq-search a").click(function(){
        $("#header-wp .search-box").addClass("show");
        return false;
    });
    $("#header-wp .search-box .icon-close-search-box").click(function() {
        $("#header-wp .search-box").removeClass("show");
    });
    // SIDEBAR
    $(".user-option .icon-user").click(function( ){
        $("#sidebar .dropdown-menu-user").stop().fadeIn();
    });
    $("#sidebar .dropdown-menu-user .icon-close").click(function() {
        $("#sidebar .dropdown-menu-user").stop().fadeOut();
    });
    // OPTION SELECT 
    /* handling when click into select */
    $("#main-content-wp #content.content-list-page .sec-option ul.post-status li a").click(function(){
        $("#main-content-wp #content.content-list-page .sec-option ul.post-status li a").removeClass('active');
        $(this).addClass('active');
        // return false;
    });

    


    notification();
    // handling effect when success
    function notification() {
        $("body,html").scrollTop(6000);
        $("body,html").animate({
            scrollTop : 0
        },1000);
        var html_notifi = "<span class='line_left'></span><span class='line_right'></span>";
        $("#notifi-box .success").html(html_notifi);
        $("#notifi-box[data-notifi='success']").addClass('show');
        $("#notifi-box .success").addClass('show');
        $("#notifi-box .line_right").addClass('show');
        $("#notifi-box .line_left").addClass('show');
        setTimeout(function () {
            $("#notifi-box").removeClass('show');
            $("#notifi-box .success").removeClass('show');
            $("#notifi-box .success").stop().fadeOut(350);
            $("#notifi-box .line_right").stop().fadeOut(350);
            $("#notifi-box .line_left").stop().fadeOut(350);
        },1500);
    }


    // modal update post
    open_modal_update_post();
    function open_modal_update_post() {
        $(".btn-show-update-post").click();
    }
    
});
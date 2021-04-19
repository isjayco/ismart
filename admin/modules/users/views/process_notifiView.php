<?php get_header('user'); ?>
<div class="card">
    <div class="card-body">
        <div class="card-body">
            <h4 class='title-notifi'><?php echo $title_notifi ?></h4>
            <h4 class="sub-title-notifi"><?php echo $sub_title_notifi ?></h4>
           <a href="<?php echo $link ?>" class="btn_to_email"><?php echo $btn_to_email ?></a>
        </div>
    </div>
</div>
<?php get_footer('user'); ?>
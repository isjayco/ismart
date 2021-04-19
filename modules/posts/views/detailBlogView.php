<?php get_header() ?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php
            if (!empty($postItem)) {
                $postItem['post_img']     = "admin/" . $postItem['post_img'];
                $postItem['url_detail']   = "?mod=posts&action=detail&id={$postItem['post_id']}";
                $data                     = getdate($postItem['created_date']);
                $postItem['created_date'] = "{$data['mday']}/{$data['mon']}/{$data['year']}";
            ?>
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $postItem['post_title'] ?></h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date"><?php echo $postItem['created_date'] ?></span>
                        <div class="detail">
                            <?php echo $postItem['post_content'] ?>
                        </div>
                    </div>
                </div>
                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone-wp">
                            <div class="g-plusone" data-size="medium"></div>
                        </div>
                        <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <p>Chưa có nội dung cho bài viết này</p>
            <?php
            }
            ?>
        </div>
        <div class="sidebar fl-left">
            <?php
            get_sidebar("selling");
            get_sidebar("advt");
            ?>
        </div>
    </div>
</div>
<?php get_footer() ?>
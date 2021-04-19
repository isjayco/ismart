<?php get_header() ?>
<div id="main-content-wp" class="clearfix blog-page" data-modules="posts" data-id="<?php echo $dataId ?>">
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
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $postCatItem['name_postCat'] ?></h3>
                </div>
                <?php
                if (!empty($listPosts)) {
                ?>
                <div class="section-detail" data-modules='posts'>
                    <?php
                    if (!empty($listPosts)) {
                    ?>
                        <ul class="list-item">
                            <?php
                            foreach ($listPosts as $postItem) {
                                $postItem['post_img']     = "admin/" . $postItem['post_img'];
                                $postItem['url_detail']   = "bai-viet/chi-tiet/{$postItem['post_url']}-{$postItem['post_id']}.html";
                                $data                     = getdate($postItem['created_date']);
                                $postItem['created_date'] = "{$data['mday']}/{$data['mon']}/{$data['year']}";
                            ?>
                                <li class="clearfix">
                                    <a href="<?php echo $postItem['url_detail'] ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo $postItem['post_img'] ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $postItem['url_detail'] ?>" title="" class="title"><?php echo $postItem['post_title'] ?></a>
                                        <span class="create-date"><?php echo $postItem['created_date'] ?></span>
                                        <p class="desc"><?php echo $postItem['post_desc'] ?></p>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
                <?php
                } else {
                ?>
                    <div class="notifi_process mx-auto" style="text-align: center;">
                        <span class="thumb-img"><img src="public/images/search_not_found.png" class="img-fluid" alt="" style=" width: 300px; height: 300px; overflow: hidden; margin: 0 auto; display: block; "></span>
                        <p class="txt_notifi">Hiện tại không tìm thấy bài viết nào thuộc danh mục <strong><?php echo $postCatItem['name_postCat'] ?></strong> ..!</p>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <div class="wp-pagination">
                        <nav aria-label="pagination">
                            <ul class="pagination" data-modules="posts"></ul>
                        </nav>
                    </div>
                </div>
            </div>
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
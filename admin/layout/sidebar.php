<div class="modal fade" id="my-avatar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="add-avatar">
                    <form action="" method="POST" class="position-relative">
                        <div class="shell-avt">
                            <span class="thumb-avt">
                                <img src="" alt="">
                            </span>
                        </div>
                        <div class="form-group text-center">
                            <label for="avatar" class="fa fa-camera icon-avatar"></label>
                            <input type="file" name="avatar" class="modal-avt d-none" id="avatar">
                        </div>
                        <div class="form-group text-center my-0">
                            <button type="submit" name="add_avatar" class='btn-avt btn shadow-none'>Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sidebar" class="fl-left">
    <div class="wp-sidebar">

        <div class="user-info">
            <div class="wp-user">
                <div class="avatar position-relative">
                    <a href="" class="thumb-img"><img src="https://scontent.fsgn5-4.fna.fbcdn.net/v/t1.0-9/90722970_650072085808699_6258951275187011584_o.jpg?_nc_cat=102&_nc_sid=09cbfe&_nc_ohc=nai0eK7_C_sAX9xLzg0&_nc_ht=scontent.fsgn5-4.fna&oh=2bb0087f8e93fee68115a3c82cca1000&oe=5ED701DE" alt=""></a>
                    <a href="" data-toggle="modal" data-target="#my-avatar" class="avatar-opt position-absolute fa fa-camera icon-avatar">
                    </a>
                </div>
                <div class="info-container">
                    <div class="info-basic">
                        <span class="name-admin admin"><?php echo info_user('fullname') ?></span>
                        <span class="email-admin admin"><?php echo info_user('email') ?></span>
                    </div>
                    <div class="user-option position-relative">
                        <span class="icon-user"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                        <div class="dropdown-menu-user position-absolute">
                            <ul class="list-option">
                                <li><span class="position-absolute fa fa-times-circle icon-close"></span></li>
                                <li class="profile">
                                    <a href="?mod=users&action=info" class="d-block">
                                        <span class="fa fa-user icon"></i></span>
                                        <span class='name'>Cá nhân</span>
                                    </a>
                                </li>
                                <hr />
                                <li>
                                    <a href="?mod=users&action=register" class="d-block">
                                        <span class="fa fa-user-plus icon"></span>
                                        <span class='name'>Đăng Ký</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?mod=users&action=update" class="d-block">
                                        <span class="fa fa-pencil-square-o icon"></span>
                                        <span class='name'>Cập nhật</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?mod=users&controller=team" class="d-block">
                                        <span class="fa fa-users icon"></span>
                                        <span class='name'>Quản trị</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="d-block">
                                        <span class="fa fa-sliders icon"></span>
                                        <span class='name'>Cài đặt</span>
                                    </a>
                                </li>
                                <hr />
                                <li>
                                    <a href="?mod=users&action=logout" class="d-block">
                                        <span class="fa fa-sign-out icon"></span>
                                        <span class='name'>Đăng Xuất</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul id="sidebar-menu">
            <li class="title-name">Danh sách menu</li>
            <li class="nav-home">
                <a href="?" class="nav-link nav-toggle">
                    <span class="fa fa-home icon"></span>
                    <span class="title">Trang chủ</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" title="" class="nav-link nav-toggle">
                    <span class="fa fa-pencil-square-o icon"></span>
                    <span class="title">Bài viết</span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="?mod=posts&action=add" title="" class="nav-link">Thêm mới</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=posts" title="" class="nav-link">Danh sách bài viết</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=posts&controller=postsCat" title="" class="nav-link">Danh mục bài viết</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" title="" class="nav-link nav-toggle">
                    <span class="fa fa-product-hunt icon"></span>
                    <span class="title">Sản phẩm</span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="?mod=products&action=add" title="" class="nav-link">Thêm mới</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=products" title="" class="nav-link">Danh sách sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=products&controller=product_cat" title="" class="nav-link">Danh mục sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=products&controller=trademark" title="" class="nav-link">Thương hiệu sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" title="" class="nav-link nav-toggle">
                    <span class="fa fa-database icon"></span>
                    <span class="title">Bán hàng</span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="?mod=sales" title="" class="nav-link">Danh sách đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=sales&controller=customer" title="" class="nav-link">Danh sách khách hàng</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" title="" class="nav-link nav-toggle">
                    <i class="fa fa-sliders" aria-hidden="true"></i>
                    <span class="title">Slider</span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="?mod=sliders&action=add" title="" class="nav-link">Thêm mới</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=sliders" title="" class="nav-link">Danh sách slider</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" title="" class="nav-link nav-toggle">
                    <span class="fa fa-line-chart icon"></span>
                    <span class="title">Báo cáo thống kê</span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="?mod=statistics" title="" class="nav-link">Doanh thu bán hàng</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=statistics&action=reportSale" title="" class="nav-link">Báo cáo sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" title="" class="nav-link nav-toggle">
                    <span class="fa fa-puzzle-piece"></span>
                    <span class="title">Quảng cáo</span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="?mod=advt&action=add" title="" class="nav-link">Đặt quảng cáo</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=advt" title="" class="nav-link">Danh sách quảng cáo</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" title="" class="nav-link nav-toggle">
                    <span class="fa fa-map-marker"></span>
                    <span class="title">Địa điểm</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="?mod=location" title="" class="nav-link">Danh sách</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=location&action=add" title="" class="nav-link">Thêm & Edit</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="ft-sidebar">
            <div class="copyright">
                <p>© 2020-2021 <span>HungS.vn</span></p>
                <p>Version 1.0.0</p>
            </div>
        </div>
    </div>
</div>
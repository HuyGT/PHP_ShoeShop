<nav class="navbar navbar-expand-lg  navbar-light ">
    <div class="container-xl">
        <div class="row">
            <!-- logo  -->
            <a class="navbar-brand ml-4" href="http://localhost/shopFigure/" style="color: #f06;"><b class="logo">ShopSS</b>.com</a>

            <!-- navbar-toggler  -->
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <!-- form tìm kiếm  -->
                <form class="form-inline ml-auto my-2 my-lg-0 mr-3" method="GET" action="http://localhost/shopFigure/catalog/search.php">
                    <div class="input-group" style="width: 550px;">
                        <input type="text" class="form-control" aria-label="Small" placeholder="Nhập giày cần tìm kiếm..." name="value_search">
                        <div class="input-group-append">
                            <button type="submit" class="btn" style="background-color: #f06; color: white;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav mr-auto">

                    <li class="ml-3 mt-1 nav-item dropdown">
                        <i class="fas fa-user"></i>
                        <?php session_start(); ?>
                        <a class="nav-link text-dark text-uppercase <?php if (isset($_SESSION['user']['email'])) echo "dropdown-toggle"; ?>" id="navbarDropdown" role="button" data-toggle="<?php if (isset($_SESSION['user']['email'])) echo "dropdown"; ?>" aria-haspopup="true" aria-expanded="false" href="http://localhost/shopFigure/account/" style="display:inline-block">
                            <?php if (isset($_SESSION['user']['email'])) {
                                $parts = explode(' ', $_SESSION['user']['name']);
                                echo $parts[0];
                            } else {
                                echo 'Tài khoản';
                            }; ?></a>

                        <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['role'] == 'user') : ?>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=view_edit_account&amp;user_id=<?php echo $_SESSION['user']['userId'] ?>">Thông tin tài khoản </a>
                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=view_orders&amp;user_id=<?php echo $_SESSION['user']['userId'] ?>">Xem hóa đơn </a>

                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=view_edit_password&amp;user_id=<?php echo $_SESSION['user']['userId'] ?>">Đổi mật khẩu</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=logout">Đăng xuất</a>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['role'] == 'admin') : ?>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://localhost/shopFigure/admin?action=view_dashboard">Admin control panel </a>
                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=view_edit_account&amp;user_id=<?php echo $_SESSION['user']['userId'] ?>">Thông tin tài khoản </a>
                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=view_orders&amp;user_id=<?php echo $_SESSION['user']['userId'] ?>">Xem hóa đơn </a>

                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=view_edit_password&amp;user_id=<?php echo $_SESSION['user']['userId'] ?>">Đổi mật khẩu</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://localhost/shopFigure/account?action=logout">Đăng xuất</a>
                            </div>
                        <?php endif; ?>
                    </li>

                    <li class="ml-3 mt-1 ">
                        <i class="fas fa-shopping-cart"></i>
                        <a class="nav-link " href="http://localhost/shopFigure/cart/" style="display:inline-block">Giỏ
                            Hàng(<?php if (isset($_SESSION['cart'])) echo count($_SESSION['cart']) ?>)</a>
                    </li>
                    <li class="ml-3 mt-1 ">
                    <i class="fab fa-shopify"></i>
                        <a class="nav-link " href="http://localhost/shopFigure/catalog?action=view_shop&amp;brand_id=&amp;sort_by=" style="display:inline-block">Cửa hàng</a>
                    </li>
                </ul>
                <img src="http://localhost/shopFigure/images/giày/junior.png" alt="" style="height: 70px;" class="">
                <img src="http://localhost/shopFigure/images/giày/airforce.jpg" alt="" style="height: 70px;" class="">
                <img src="http://localhost/shopFigure/images/giày/superstar.jpg" alt="" style="height: 70px;" class="">


            </div>
        </div>
    </div>
</nav>

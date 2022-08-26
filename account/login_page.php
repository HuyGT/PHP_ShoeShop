<?php include('../view/header.php'); ?>
<?php include('../view/navbar.php'); ?>


<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-6  ">
                <form class="" action="" method="post">
                    <input type="hidden" name="action" value="login">
                    <h3 class="text-center mt-5">Đăng nhập</h3>
                    <div class="form-group">
                        <label for="username">Email:</label><br>
                        <input type="text" name="email" value="<?php if (isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label><br>
                        <input type="password" name="password" class="form-control" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="remember-me"><span>Nhớ mật khẩu</span> <span>
                                <input type="checkbox" name="remember" value="1"></span></label><br>
                        <input type="submit" name="submit" class="btn btn-danger btn-md form-control" value="Đăng nhập">
                        <?php if (!empty($error_message)) : ?>
                            <p class="text-danger"><?php echo $error_message; ?></p>
                        <?php endif ?>
                    </div>

                    <div class="text-center mb-5">
                        Chưa có tài khoản ?<a href="?action=view_register_page">Đăng ký ngay</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../view/footer.php'); ?>
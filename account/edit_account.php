<?php include('../view/header.php') ?>
<?php include('../view/navbar.php') ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="list-group">
                <a href="?action=view_edit_account&amp;user_id=<?php echo $_SESSION['user']['userId']; ?>" class="list-group-item active">Thông tin tài khoản</a>
                <a href="?action=view_orders&amp;user_id=<?php echo $_SESSION['user']['userId']; ?>" class="list-group-item">Xem hóa đơn</a>
                <a href="?action=view_edit_password&amp;user_id=<?php echo $_SESSION['user']['userId']; ?>" class="list-group-item ">Đổi mật khẩu</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9">
            <h3 class="text-center">Thông tin cá nhân</h3>
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success"><?php echo $message ?></div>
            <?php endif ?>
            <form action="" method="POST">
                <input type="hidden" name="action" value="edit_account">

                <div class="form-group">
                    <label for="">Họ và tên:
                        <label class="text-danger"><?php echo $fields->getField('full_name')->getHTML(); ?></label>
                    </label>
                    <div class="input-group">
                        <input type="text" name="fullName" placeholder="Nhập họ và tên" value="<?php echo $user['name']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email:
                        <label class="text-danger"><?php echo $fields->getField('email')->getHTML(); ?></label>
                    </label>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Nhập email" value="<?php echo $user['email']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại:
                        <label class="text-danger"><?php echo $fields->getField('phone')->getHTML(); ?></label>
                    </label>
                    <div class="input-group">
                        <input type="text" name="phone" placeholder="Nhập số điện thoại" value="<?php echo $user['phone']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ:
                        <label class="text-danger"><?php echo $fields->getField('address')->getHTML(); ?></label>
                    </label>
                    <div class="input-group">
                        <input type="text" name="address" placeholder="Nhập địa chỉ" value="<?php echo $user['address']; ?>" class="form-control">
                    </div>
                </div>

                <input type="submit" value="Chỉnh sửa" class="btn btn-google mb-3">
            </form>
        </div>


    </div>

</div>

<?php include('../view/footer.php') ?>
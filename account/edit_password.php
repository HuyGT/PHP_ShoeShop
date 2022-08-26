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
            <h3>Đổi mật khẩu</h3>
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success"><?php echo $message ?></div>
            <?php endif ?>
            <form action="" method="POST">
                <input type="hidden" name="action" value="edit_password">
                <div class="form-group">
                    <label for="">Mật khẩu:
                        <label class="text-danger"><?php if (!empty($message_1)) echo $message_1 ?></label>
                    </label>
                    <div class="input-group">
                        <input type="password" name="now_password" placeholder="Nhập mật khẩu hiện tại">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu mới:
                        <label class="text-danger"><?php if (!empty($message_2)) echo $message_2 ?></label>
                    </label>
                    <div class="input-group">
                        <input type="password" name="new_password_1" placeholder="Nhập mật khẩu mới">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nhập lại mật khẩu mới:</label>
                    <div class="input-group">
                        <input type="password" name="new_password_2" placeholder="Nhập lại mật khẩu mới">
                    </div>
                </div>

                <input type="submit" value="Cập nhật" class="btn btn-google mb-3">
            </form>
        </div>


    </div>

</div>

<?php include('../view/footer.php') ?>
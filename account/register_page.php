<?php include('../view/header.php'); ?>
<?php include('../view/navbar.php'); ?>
<div>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-6  ">
        <form class=""  method="POST">
          <input type="hidden" name="action" value="register">
          <h3 class="text-center mt-5">Đăng ký</h3>
          <?php if (!empty($error_message)) : ?>
            <p class="alert alert-danger"><?php  echo $error_message; ?></p>
          <?php elseif (!empty($message)) : ?>
            <p class="alert alert-success"><?php  echo $message; ?></p>
          <?php endif ?>
          <div class="form-group">
            <label>Họ và tên:
              <label class="text-danger"><?php echo $fields->getField('full_name')->getHTML(); ?> </label>
            </label><br>
            <input type="text" name="full_name"  class="form-control" value="<?php echo $full_name ?>">
          </div>
          <div class="form-group">
            <label>Email:
              <label class="text-danger"><?php echo $fields->getField('email')->getHTML(); ?> </label>
            </label><br>
            <input type="text" name="email" value="<?php echo $email ?>" class="form-control">
          </div>
          <div class="form-group">
            <label>SDT:
              <label class="text-danger"><?php echo $fields->getField('phone')->getHTML(); ?> </label>
            </label><br>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>">
          </div>
          <div class="form-group">
            <label>Mật khẩu:
              <label class="text-danger"><?php echo $fields->getField('password_1')->getHTML(); ?> </label>
            </label><br>
            <input type="password" name="password_1" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>Nhập lại mật khẩu:
              <label class="text-danger"><?php echo $fields->getField('password_2')->getHTML(); ?> </label>
            </label><br>
            <input type="password" name="password_2" class="form-control" value="">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-danger btn-md form-control" value="Đăng ký">
          </div>

          <div class="text-center mb-5">
            Đã có tài khoản ?<a href="?action=view_login_page">Đăng nhập ngay</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<?php include('../view/footer.php'); ?>
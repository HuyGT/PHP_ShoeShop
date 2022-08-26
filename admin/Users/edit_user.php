<?php include('../view/admin/header.php'); ?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include('../view/admin/sidebar.php'); ?>
  <div id="content-wrapper">

    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Edit User
        </div>
        <div class="card-body">

          <form action="" method="POST">
            <?php if (!empty($message)) : ?>
              <div class="alert alert-success"><?php echo $message ?></div>
            <?php endif ?>
            <input type="hidden" name="action" value="edit_user">
            <input type="hidden" name="user_id" value="<?php echo $user['userId']; ?>">
            <label for="">Name: </label>
            <input type="text" class="form-control" name="user_name" value="<?php echo $user['name']; ?>">
            <label for="">Email: </label>
            <input type="text" class="form-control" name="user_email" value="<?php echo $user['email']; ?>">
            <label for="">Phone: </label>
            <input type="text" class="form-control" name="user_phone" value="<?php echo $user['phone']; ?>">
            <label for="">Address: </label>
            <input type="text" class="form-control" name="user_address" value="<?php echo $user['address']; ?>">
            <label for="">Role: </label>
            <select name="user_role" id="" class="form-control">
              <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected' ?>>Admin</option>
              <option value="user" <?php if ($user['role'] == 'user') echo 'selected' ?>>User</option>
            </select>
            <div class="row">
              <input type="submit" value="Save" class="ml-3 mt-2 btn btn-success text-white ">
              <a href="?action=view_users" class="text-white nav-link btn btn-danger ml-2 mt-2"><span>Cancel</span></a>
            </div>
          </form>
        </div>
      </div>
    </div>


  </div>
  <!-- /.container-fluid -->

  <!-- Sticky Footer -->
  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © Your Website 2021 Edit by: Nguyễn Quang Huy</span>
      </div>
    </div>
  </footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include('../view/admin/footer.php'); ?>
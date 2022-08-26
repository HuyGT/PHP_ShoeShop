<?php include('../view/admin/header.php'); ?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include('../view/admin/sidebar.php'); ?>
  <div id="content-wrapper">

    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Add Brand
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <label class="float-left" for="">Name: </label>
            <p class="float-left ml-3 text-danger">
              <?php echo $fields->getField('name_brand')->getHTML(); ?>
              <?php if(!empty($error_message)) echo $error_message; ?>
            </p>
            <input type="hidden" name="action" value="add_brand">
            <input type="text" placeholder="Nhập thương hiệu muốn thêm" class="form-control" name="name_brand">

            <div class="row">
              <input type="submit" value="Add" class="ml-3 mt-2 btn btn-success text-white ">
              <a href="?action=view_brands" class="text-white nav-link btn btn-danger ml-2 mt-2"><span>Cancel</span></a>
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
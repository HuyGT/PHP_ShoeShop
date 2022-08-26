<?php include('../view/admin/header.php'); ?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include('../view/admin/sidebar.php'); ?>
  <div id="content-wrapper">

    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Edit Brand
        </div>
        <div class="card-body">
          <?php if (!empty($message)) : ?>
            <div class="alert alert-success"><?php echo $message ?></div>
          <?php endif ?> 
          <form action="" method="POST">
            <label for="">Name: </label>
            <input type="hidden" name="action" value="edit_brand">
            <input type="hidden" name="id_brand" value="<?php echo $category['categoryId']; ?>">
            <input type="text" class="form-control" name="name_brand" value="<?php echo $category['categoryName']; ?>">
            <div class="row">
              <input type="submit" value="Save" class="ml-3 mt-2 btn btn-success text-white ">
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
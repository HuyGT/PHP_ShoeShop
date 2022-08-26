<?php include('../view/admin/header.php'); ?>
<div id="wrapper">

  <!-- Sidebar -->
  <?php include('../view/admin/sidebar.php'); ?>
  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tables</li>
      </ol>

      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          <span>Products</span>
          <a href="?action=view_add_product" class="text-white nav-link btn btn-primary float-right"><span>Add Product</span></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <?php if (!empty($message)) : ?>
                <div class="alert alert-success"><?php echo $message ?></div>
              <?php endif ?>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price(USD)</th>
                  <th>Quantity</th>
                  <th>Sale</th>
                  <th>Brand</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($products as $product) : ?>
                  <tr>
                    <th><?php echo $product['productId']; ?></th>
                    <th><img src="Uploads/<?php echo $product['image']; ?>" style="height: 50px; width: 50px;"></th>
                    <th><?php echo $product['productName']; ?></th>
                    <th><?php echo $product['price']; ?>$</th>
                    <th><?php echo $product['quantity']; ?></th>
                    <th><?php echo $product['discount']; ?>%</th>
                    <th><?php echo $product['categoryName']; ?></th>
                    <th><a href="?action=view_edit_product&amp;product_id=<?php echo $product['productId']; ?>" class="btn btn-success"><span>Edit</span></a></th>

                    <form action="" method="POST">
                      <input type="hidden" name="action" value="delete_product">
                      <input type="hidden" name="product_id" value="<?php echo $product['productId']; ?>">
                      <th> <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa sản phẩm <?php echo $product['productName']; ?> không ? ')"></th>
                    </form>
                  </tr>

                <?php endforeach; ?>
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>


    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Your Website 2018</span>
        </div>
      </div>
    </footer>

  </div>
  <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->
<?php include('../view/admin/footer.php'); ?>
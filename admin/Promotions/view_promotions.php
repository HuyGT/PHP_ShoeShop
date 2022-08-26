<?php include('../view/admin/header.php'); ?>
<div id="wrapper">

    <!-- Sidebar -->
    <?php include('../view/admin/sidebar.php'); ?>
    <div id="content-wrapper">

        <div class="container-fluid">


            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-3"></i>
                    <span>Promotions</span>
                    <a href="?action=view_add_code" class="text-white nav-link btn btn-primary float-right"><span>Add Code</span></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (!empty($message)) : ?>
                            <div class="alert alert-success"><?php echo $message ?></div>
                        <?php endif ?>

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Value</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($promotions as $promotion) : ?>
                                    <tr>

                                        <th><?php echo $promotion['codeId']; ?></th>
                                        <th><?php echo $promotion['code']; ?></th>
                                        <th><?php echo $promotion['value']; ?>$</th>

                                        <th><a href="?action=view_edit_code&amp;code_id=<?php echo $promotion['codeId']; ?>" class="btn btn-success"><span>Edit</span></a></th>
                                        <form action="" method="POST">
                                            <input type="hidden" name="action" value="delete_code">
                                            <input type="hidden" name="code_id" value="<?php echo $promotion['codeId']; ?>">
                                            <th> <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa mã giảm giá <?php echo $promotion['codeId']; ?> không ?')">
                                            </th>
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
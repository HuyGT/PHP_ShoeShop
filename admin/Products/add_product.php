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
                   
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_product">

                        <label>Name:
                            <label class="text-danger"><?php echo $fields->getField('name_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập tên sản phẩm" class="form-control" name="name_product" value="<?php echo $name_product; ?>">

                        <label for="">Price:
                            <label class="text-danger"> <?php echo $fields->getField('price_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập giá sản phẩm" class="form-control" name="price_product" value="<?php echo $price_product; ?>">

                        <label for="">Quantity:
                            <label class="text-danger"><?php echo $fields->getField('quantity_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập số lượng sản phẩm" class="form-control" name="quantity_product" value="<?php echo $quantity_product; ?>">

                        <label for="">Sale:
                            <label class="text-danger"> <?php echo $fields->getField('sale_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập giảm giá sản phẩm" class="form-control" name="sale_product" value="<?php echo $sale_product; ?>">

                        <label for="">Brands:
                            <label class="text-danger"><?php echo $fields->getField('category_product')->getHTML(); ?></label>
                        </label>
                        <select name="category_product" id="" class="form-control">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['categoryId']; ?>">
                                    <?php echo $category['categoryName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="">Image:
                            <label class="text-danger"> <?php echo $fields->getField('image')->getHTML(); ?></label>
                        </label>
                        <input type="file" name="image"> <br>

                        <label for="">Image 2:
                            <label class="text-danger"><?php echo $fields->getField('image_2')->getHTML(); ?></label>
                        </label>
                        <input type="file" name="image_2"> <br>

                        <label for="">Description:
                            <label class="text-danger"><?php echo $fields->getField('desc_product')->getHTML(); ?></label>
                        </label>
                        <textarea name="desc_product">

                        </textarea>
                        <div class="row">
                            <input type="submit" value="Add" class="ml-3 mt-2 btn btn-success text-white ">
                            <a href="?action=view_products" class="text-white nav-link btn btn-danger ml-2 mt-2"><span>Cancel</span></a>
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
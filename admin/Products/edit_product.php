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

                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit_product">
                        <label for="">Name:
                            <label class="text-danger"><?php echo $fields->getField('name_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập tên sản phẩm" class="form-control" name="name_product" value="<?php echo $product['productName']; ?>">

                        <label for="">Price:
                            <label class="text-danger"><?php echo $fields->getField('price_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập giá sản phẩm" class="form-control" name="price_product" value="<?php echo $product['price']; ?>">

                        <label for="">Quantity:
                            <label class="text-danger"><?php echo $fields->getField('quantity_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập số lượng sản phẩm" class="form-control" name="quantity_product" value="<?php echo $product['quantity']; ?>">

                        <label for="">Sale:
                            <label class="text-danger"><?php echo $fields->getField('sale_product')->getHTML(); ?></label>
                        </label>
                        <input type="text" placeholder="Nhập giảm giá sản phẩm" class="form-control" name="sale_product" value="<?php echo $product['discount']; ?>">

                        <label for="">Brands: </label>
                        <select name="category_product" id="" class="form-control">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['categoryId']; ?>" <?php if ($category['categoryId'] == $product['categoryId']) echo 'selected'; ?>>
                                    <?php echo $category['categoryName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="">Image: </label><br>
                        <div class="card float-left " style="width: 15rem; ">
                            <div class="card-body">
                                <a href=""><img src="./Uploads/<?php echo $product['image']; ?>" class=" w-100" style="height: 200px;"></a>
                            </div>
                        </div>
                        <?php if ($product['image_2'] != null) : ?>
                            <div class="card float-left " style="width: 15rem; ">
                                <div class="card-body">
                                    <a href=""><img src="./Uploads/<?php echo $product['image_2']; ?>" class=" w-100 h-100 " style="height: 200px;"></a>
                                </div>
                            </div>

                        <?php endif ?>
                        <label for="">Change Image: 
                            <label class="text-danger"><?php echo $fields->getField('image')->getHTML(); ?></label>

                        </label>
                        <input type="file" name="image"> <br>
                        <label for="">Change Image 2: 
                            <label class="text-danger"><?php  echo $fields->getField('image_2')->getHTML(); ?></label>

                        </label>
                        <input type="file" name="image_2"> <br>
                        <label for="">Description: </label>
                        <textarea name="desc_product"> </textarea>

                        <div class="row">
                            <input type="submit" value="Save" class="ml-3 mt-2 btn btn-success text-white ">
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
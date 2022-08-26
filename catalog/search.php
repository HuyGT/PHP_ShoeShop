<?php include('../view/header.php');
include('../view/navbar.php');
include('../model/database.php');
include('../model/products_db.php');
include('../model/rating_db.php');

$value_search = $_GET['value_search'];
$products = search_products($value_search);
?>

<?php if ($value_search == null) : ?>
    <h1 class="text-center">Không tìm thấy kết quả</h1>
<?php else : ?>
    <div class="container">
        <div class="row ml-2">
            <?php include('../view/products.php') ?>

        </div>
    </div> <br>

<?php endif ?>

<?php include('../view/footer.php'); ?>
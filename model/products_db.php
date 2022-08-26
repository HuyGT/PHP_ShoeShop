<?php
function get_products_by_cat($category_id)
{
    global $db;
    if ($category_id == null) {
        $query = 'SELECT * FROM products p join categories c on p.categoryId = c.categoryId  ';
    } else {
        $query = 'SELECT * FROM products p join categories c on p.categoryId = c.categoryId WHERE p.categoryId = :category_id ';
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);

    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
function get_selling_products($lm)
{
    global $db;
    $query = 'SELECT * FROM products p join categories c on p.categoryId = c.categoryId ORDER BY product_bought desc LIMIT :lm';
    $statement = $db->prepare($query);
    $statement->bindValue(':lm', $lm, PDO::PARAM_INT);

    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
function get_new_products($lm)
{
    global $db;
    $query = 'SELECT * FROM products p join categories c on p.categoryId = c.categoryId ORDER BY dateAdd desc LIMIT :lm';
    $statement = $db->prepare($query);
    $statement->bindValue(':lm', $lm, PDO::PARAM_INT);

    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
function search_products($product_name)
{
    global $db;
    $query = 'SELECT * FROM products WHERE productName REGEXP :product_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_name', $product_name);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function get_products_have_inf($lm)
{
    global $db;
    $query = 'SELECT * FROM products p join categories c on p.categoryId = c.categoryId ORDER BY product_view DESC LIMIT :lm';
    $statement = $db->prepare($query);
    $statement->bindValue(':lm', $lm, PDO::PARAM_INT);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}


function get_products_lm($category_id)
{
    global $db;
    if (!isset($_GET['page_id'])) {
        $page = 1;
    } else {
        $page = $_GET['page_id'];
    }
    if (isset($_GET['sort_by'])) {
        $sort_by = $_GET['sort_by'];
    } else {
        $sort_by = null;
    }

    $once_page = ($page - 1) * 9;
    if ($category_id == null && $sort_by == null) {
        $query = 'SELECT * FROM products LIMIT :once_page,9 ';
    } elseif ($category_id == null && $sort_by == 'new_product') {
        $query = 'SELECT * FROM products ORDER BY dateAdd desc  LIMIT :once_page,9 ';
    } elseif ($category_id == null && $sort_by == 'sales') {
        $query = 'SELECT * FROM products ORDER BY product_bought desc  LIMIT :once_page,9 ';
    } elseif ($category_id == null && $sort_by == 'hot') {
        $query = 'SELECT * FROM products ORDER BY product_view desc  LIMIT :once_page,9 ';
    } elseif ($category_id == null && $sort_by == 'price_desc') {
        $query = 'SELECT * FROM products ORDER BY price - (price * (discount/100)) desc  LIMIT :once_page,9 ';
    } elseif ($category_id == null && $sort_by == 'price_asc') {
        $query = 'SELECT * FROM products ORDER BY price - (price * (discount/100)) asc  LIMIT :once_page,9 ';
    } elseif ($category_id == null && $sort_by == 'star_5' || $sort_by == 'star_4' || $sort_by == 'star_3' || $sort_by == 'star_2' || $sort_by == 'star_1') {
        $query = 'SELECT *,round(avg(star)) as rat from products p join rating r on p.productId = r.productId GROUP BY p.productId having rat >= :rat  LIMIT :once_page,9 ';
    } elseif ($category_id != null && $sort_by == 'new_product') {
        $query = 'SELECT * FROM products WHERE categoryId = :category_id ORDER BY dateAdd desc LIMIT :once_page,9 ';
    } elseif ($category_id != null && $sort_by == 'sales') {
        $query = 'SELECT * FROM products WHERE categoryId = :category_id ORDER BY product_bought desc LIMIT :once_page,9 ';
    } elseif ($category_id != null && $sort_by == 'hot') {
        $query = 'SELECT * FROM products WHERE categoryId = :category_id ORDER BY product_view desc LIMIT :once_page,9 ';
    } elseif ($category_id != null && $sort_by == 'price_desc') {
        $query = 'SELECT * FROM products WHERE categoryId = :category_id ORDER BY price - (price * (discount/100)) desc LIMIT :once_page,9 ';
    } elseif ($category_id != null && $sort_by == 'price_asc') {
        $query = 'SELECT * FROM products WHERE categoryId = :category_id ORDER BY price - (price * (discount/100)) asc LIMIT :once_page,9 ';
    } elseif ($category_id != null && $sort_by == 'star_5' || $sort_by == 'star_4' || $sort_by == 'star_3' || $sort_by == 'star_2' || $sort_by == 'star_1') {
        $query = 'SELECT *,round(avg(star)) as rat from products p join rating r on p.productId = r.productId where p.categoryId = :category_id GROUP BY p.productId having rat >= :rat  LIMIT :once_page,9 ';
    }  else {
        $query = 'SELECT * FROM products WHERE categoryId = :category_id  LIMIT :once_page,9 ';
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':once_page', $once_page, PDO::PARAM_INT);
    if ($category_id != null) {
        $statement->bindValue(':category_id', $category_id);
    }
    if ($sort_by == 'star_5' || $sort_by == 'star_4' || $sort_by == 'star_3' || $sort_by == 'star_2' || $sort_by == 'star_1') {
        $star = substr($sort_by, 5);
        $statement->bindValue(':rat', $star);
    }

    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
function get_products()
{
    global $db;
    $query = 'SELECT * FROM products p join categories c on p.categoryId = c.categoryId ORDER BY dateAdd desc ';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function add_product($name_product, $price_product, $quantity_product, $sale_product, $category_product, $desc_product, $file_name, $file_name_2)
{
    global $db;
    $query = 'INSERT INTO products (productName,price,quantity,description,discount,image,image_2,categoryId) VALUES (:name_product,:price_product,:quantity_product,:desc_product,:sale_product,:file_name,:file_name_2,:category_product)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name_product', $name_product);
    $statement->bindValue(':price_product', $price_product);
    $statement->bindValue(':quantity_product', $quantity_product);
    $statement->bindValue(':desc_product', $desc_product);
    $statement->bindValue(':sale_product', $sale_product);
    $statement->bindValue(':file_name', $file_name);
    $statement->bindValue(':file_name_2', $file_name_2);
    $statement->bindValue(':category_product', $category_product);
    $statement->execute();
    $product_id = $db->lastInsertId();
    $statement->closeCursor();
    return $product_id;
}

function delete_product($product_id)
{
    global $db;
    $query = 'DELETE FROM products WHERE productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_product_by_cat($category_id)
{
    global $db;
    $query = 'DELETE FROM products WHERE categoryId = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

function get_product_by_id($product_id)
{
    global $db;
    $query = 'SELECT * FROM products p JOIN categories c ON p.categoryId = c.categoryId WHERE productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $products = $statement->fetch();
    $statement->closeCursor();
    return $products;
}

function update_product($name_product, $price_product, $quantity_product, $sale_product, $category_product, $desc_product, $file_name, $file_name_2, $product_id)
{
    global $db;
    if ($file_name != null && $file_name_2 == null) {
        $query = 'UPDATE products 
              SET productName = :name_product, price = :price_product, quantity = :quantity_product, 
              discount = :sale_product, categoryId = :category_product, description = :desc_product,
              image = :file_name 
              WHERE productId = :product_id';
    } elseif ($file_name_2 != null && $file_name == null) {
        $query = 'UPDATE products 
        SET productName = :name_product, price = :price_product, quantity = :quantity_product, 
        discount = :sale_product, categoryId = :category_product, description = :desc_product,
        image_2 = :file_name_2
        WHERE productId = :product_id';
    }elseif ($file_name_2 != null && $file_name != null) {
        $query = 'UPDATE products 
        SET productName = :name_product, price = :price_product, quantity = :quantity_product, 
        discount = :sale_product, categoryId = :category_product, description = :desc_product,
        image_2 = :file_name_2, image = :file_name
        WHERE productId = :product_id';
    }
     else {
        $query = 'UPDATE products 
              SET productName = :name_product, price = :price_product, quantity = :quantity_product, 
              discount = :sale_product, categoryId = :category_product, description = :desc_product
              WHERE productId = :product_id';
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':name_product', $name_product);
    $statement->bindValue(':price_product', $price_product);
    $statement->bindValue(':quantity_product', $quantity_product);
    $statement->bindValue(':desc_product', $desc_product);
    $statement->bindValue(':sale_product', $sale_product);
    if ($file_name != null) {
        $statement->bindValue(':file_name', $file_name);
    }
    if ($file_name_2 != null) {
        $statement->bindValue(':file_name_2', $file_name_2);
    }
    $statement->bindValue(':category_product', $category_product);
    $statement->bindValue(':product_id', $product_id);

    $statement->execute();
    $statement->closeCursor();
}

function update_view($product_id)
{
    global $db;
    $query = 'UPDATE products 
              SET product_view = product_view + 1
              WHERE productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_bought($product_id, $quantity)
{
    global $db;
    $query = 'UPDATE products 
              SET product_bought = product_bought + :quantity
              WHERE productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':quantity', $quantity);

    $statement->execute();
    $statement->closeCursor();
}

function update_quantity($product_id, $quantity)
{
    global $db;
    $query = 'UPDATE products 
              SET quantity = quantity - :quantity
              WHERE productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':quantity', $quantity);

    $statement->execute();
    $statement->closeCursor();
}

function count_product_by_cat($category_id)
{
    global $db;
    $query = 'SELECT count(productId) FROM products where categoryId = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $product = $statement->fetchColumn();
    $statement->closeCursor();
    return $product;
}

function get_quantity($product_id)
{
    global $db;
    $query = 'SELECT quantity FROM products where productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $quantity = $statement->fetchColumn();
    $statement->closeCursor();
    return $quantity;
}

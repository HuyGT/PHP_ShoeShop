<?php
function get_categories()
{
    global $db;
    $query = 'SELECT * FROM categories';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;
}
function add_category($category_name)
{
    global $db;
    $query = 'INSERT INTO categories (categoryName) VALUES (:category_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->execute();
    $category_id = $db->lastInsertId();
    $statement->closeCursor();
    return $category_id;
}
function delete_category($category_id)
{
    global $db;
    $query = 'DELETE FROM categories WHERE categoryId = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}
function get_category_by_id($category_id)
{
    global $db;
    $query = 'SELECT * FROM categories WHERE categoryId = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $categories = $statement->fetch();
    $statement->closeCursor();
    return $categories;
}
function update_category($category_name, $category_id)
{
    global $db;
    $query = 'UPDATE categories 
              SET categoryName = :category_name
              WHERE categoryId = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}
function get_categoryName_by_id($category_id)
{
    global $db;
    $query = 'SELECT categoryName FROM categories WHERE categoryId = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetchColumn();
    $statement->closeCursor();
    return $category;
}
function check_category($category_name) {
    global $db;
    $query = '
        SELECT categoryId FROM categories
        WHERE categoryName = :category_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->execute();
    $check = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $check;
}

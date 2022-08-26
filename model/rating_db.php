<?php

function add_rating($product_id, $user_id, $star, $comment)
{
    global $db;
    $query = 'INSERT INTO rating (productId , userId , star , comment) VALUES (:product_id , :user_id , :star , :comment)';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':star', $star);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
    $rate_id = $db->lastInsertId();
    $statement->closeCursor();
    return $rate_id;
}

function get_avg_star($product_id)
{
    global $db;
    $query = 'SELECT AVG(star) FROM rating WHERE productId = :product_id GROUP by productId';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $avg_star = $statement->fetchColumn();
    $statement->closeCursor();
    return $avg_star;
}

function get_ratings($product_id = null)
{
    global $db;
    if ($product_id != null) {
        $query = 'SELECT * FROM rating r join users u on r.userId = u.userId WHERE productId = :product_id ';
    } else {
        $query = 'SELECT * FROM rating r join products p join users u on r.productId = p.productId and r.userId = u.userId';
    }
    $statement = $db->prepare($query);
    if ($product_id != null) {
        $statement->bindValue(':product_id', $product_id);
    }
    $statement->execute();
    $ratings = $statement->fetchAll();
    $statement->closeCursor();
    return $ratings;
}

function get_ratings_by_cat($category_id)
{
    global $db;
    $query = 'SELECT * FROM rating r join products p on r.productId = p.productId WHERE categoryId = :category_id ';

    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);

    $statement->execute();
    $ratings = $statement->fetchAll();
    $statement->closeCursor();
    return $ratings;
}

function delete_rating($rate_id)
{
    global $db;
    $query = 'DELETE FROM rating WHERE rate_id = :rate_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':rate_id', $rate_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_rating_by_pid($product_id)
{
    global $db;
    $query = 'DELETE FROM rating WHERE productId = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_rating_by_userId($user_id)
{
    global $db;
    $query = 'DELETE FROM rating WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

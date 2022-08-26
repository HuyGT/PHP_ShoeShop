<?php
function get_promotions()
{
    global $db;
    $query = 'SELECT * FROM promotions';
    $statement = $db->prepare($query);
    $statement->execute();
    $promotions = $statement->fetchAll();
    $statement->closeCursor();
    return $promotions;
}
function add_code($code_name,$code_value)
{
    global $db;
    $query = 'INSERT INTO promotions (code,value) VALUES (:code_name,:code_value)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code_name', $code_name);
    $statement->bindValue(':code_value', $code_value);
    $statement->execute();
    $code_id = $db->lastInsertId();
    $statement->closeCursor();
    return $code_id;
}
function delete_code($code_id)
{
    global $db;
    $query = 'DELETE FROM promotions WHERE codeId = :code_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':code_id', $code_id);
    $statement->execute();
    $statement->closeCursor();
}
function get_code_by_id($code_id)
{
    global $db;
    $query = 'SELECT * FROM promotions WHERE codeId = :code_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':code_id', $code_id);
    $statement->execute();
    $promotion = $statement->fetch();
    $statement->closeCursor();
    return $promotion;
}
function update_code($code_id,$code_name,$code_value)
{
    global $db;
    $query = 'UPDATE promotions 
              SET code = :code_name , value = :code_value
              WHERE codeId = :code_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':code_name', $code_name);
    $statement->bindValue(':code_value', $code_value);
    $statement->bindValue(':code_id', $code_id);
    $statement->execute();
    $statement->closeCursor();
}

function get_code_by_name($code_name)
{
    global $db;
    $query = 'SELECT value FROM promotions WHERE code = :code_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':code_name', $code_name);
    $statement->execute();
    $promotion = $statement->fetchColumn();
    $statement->closeCursor();
    return $promotion;
}

function check_code($code_name) {
    global $db;
    $query = '
        SELECT codeId FROM promotions
        WHERE code = :code_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':code_name', $code_name);
    $statement->execute();
    $check = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $check;
}

?>
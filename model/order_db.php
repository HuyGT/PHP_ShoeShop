<?php 
function add_order($user_id,$price,$code_name,$code_value,$phone,$address)
{
    global $db;
    $query = '
    INSERT INTO orders (userId, total, code_name, code_value, phone_customer, address_shipping)
    VALUES (:user_id, :price , :code_name, :code_value , :phone, :address)';    
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':code_name', $code_name);
    $statement->bindValue(':code_value', $code_value);

    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':address', $address);

    $statement->execute();
    $order_id = $db->lastInsertId();
    $statement->closeCursor();
    return $order_id;
}

function add_detail_order($order_id,$quantity,$price,$product_name,$discount)
{
    global $db;
    $query = 'INSERT INTO detailOrder (orderId,detailQuantity,price,productName,discount) VALUES (:order_id,:quantity,:price,:product_name,:discount)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':discount', $discount);
    $statement->execute();
    $statement->closeCursor();
}

function get_orders()
{
    global $db;
    $query = 'SELECT * FROM orders o join users u on o.userId = u.userId';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}
function get_orders_by_user($user_id)
{
    global $db;
    $query = 'SELECT * FROM orders o join users u on o.userId = u.userId WHERE o.userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}
function get_detail_order($order_id)
{
    global $db;
    $query = 'SELECT * FROM detailOrder d join orders o on d.orderId = o.orderId WHERE d.orderId = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);

    $statement->execute();
    $details = $statement->fetchAll();
    $statement->closeCursor();
    return $details;
}

function delete_detail_order($order_id)
{
    global $db;
    $query = 'DELETE FROM detailOrder WHERE orderId = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_order($order_id)
{
    global $db;
    $query = 'DELETE FROM orders WHERE orderId = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_status_order($order_id,$status)
{
    global $db;
    $query = 'UPDATE orders 
              SET status = :status
              WHERE orderId = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':status', $status);

    $statement->execute();
    $statement->closeCursor();
}

function get_orderId_by_userId($user_id)
{
    global $db;
    $query = 'SELECT orderId FROM orders o join users u on o.userId = u.userId WHERE o.userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $orders = $statement->fetchColumn();
    $statement->closeCursor();
    return $orders;
}

function get_revenue()
{
    global $db;
    $query = 'SELECT sum(total) FROM orders Where status = "Đã xử lý" ';
    $statement = $db->prepare($query);
    $statement->execute();
    $revenue = $statement->fetchColumn();
    $statement->closeCursor();
    return $revenue;
}
?>
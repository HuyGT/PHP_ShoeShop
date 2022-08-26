<?php
function add_new_user($name , $phone , $email , $password)
{
    global $db;
    $query = 'INSERT INTO users (name,phone,email,password) VALUES (:name,:phone,:email,:password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $user_id = $db->lastInsertId();
    $statement->closeCursor();
    return $user_id;
}

function get_users()
{
    global $db;
    

    if (isset($_GET['sort_by'])) {
        $sort_by = $_GET['sort_by'];
    } else {
        $sort_by = null;
    }

    if($sort_by == null){
        $query = 'SELECT * FROM users ';
    }elseif($sort_by == 'id_desc'){
        $query = 'SELECT * FROM users ORDER BY userId desc ';
    }elseif($sort_by == 'id_asc'){
        $query = 'SELECT * FROM users ORDER BY userId asc';
    }elseif($sort_by == 'name_desc'){
        $query = 'SELECT * FROM users ORDER BY name desc';
    }elseif($sort_by == 'name_asc'){
        $query = 'SELECT * FROM users ORDER BY name asc';
    }elseif($sort_by == 'role_desc'){
        $query = 'SELECT * FROM users ORDER BY role desc';
    }elseif($sort_by == 'role_asc'){
        $query = 'SELECT * FROM users ORDER BY role asc';
    }

    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
    $statement->closeCursor();
    return $users;
}
function get_user_by_id($user_id) {
    global $db;
    $query = 'SELECT * FROM users WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function get_user_by_email_password($email,$password)
{
    global $db;
    $query = 'SELECT * FROM users WHERE email = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function check_email($email) {
    global $db;
    $query = '
        SELECT userId FROM users
        WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $check = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $check;
}

function check_phone($phone) {
    global $db;
    $query = '
        SELECT userId FROM users
        WHERE phone = :phone';
    $statement = $db->prepare($query);
    $statement->bindValue(':phone', $phone);
    $statement->execute();
    $check = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $check;
}

function get_password($user_id) {
    global $db;
    $query = '
        SELECT password FROM users
        WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $password = $statement->fetchColumn();
    $statement->closeCursor();
    return $password;
}

function edit_user($fullName,$email,$phone,$address,$user_id) {
    global $db;
    $query = 'UPDATE users 
              SET name = :fullName , email = :email , phone = :phone , address = :address 
              WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':fullName', $fullName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_password($password,$user_id) {
    global $db;
    $query = 'UPDATE users 
              SET password = :password 
              WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_user($user_id)
{
    global $db;
    $query = 'DELETE FROM users WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_user($user_id,$user_name,$user_email,$user_phone,$user_address,$user_role) {
    global $db;
    $query = 'UPDATE users 
              SET name = :user_name , email = :user_email , phone = :user_phone , address = :user_address , role = :user_role 
              WHERE userId = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->bindValue(':user_email', $user_email);
    $statement->bindValue(':user_phone', $user_phone);
    $statement->bindValue(':user_address', $user_address);
    $statement->bindValue(':user_role', $user_role);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}

function search_users($name)
{
    global $db;
    $query = 'SELECT * FROM users WHERE name REGEXP :name';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $users = $statement->fetchAll();
    $statement->closeCursor();
    return $users;
}

function search_gmail($name)
{
    global $db;
    $query = 'SELECT * FROM users WHERE email REGEXP :name';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $users = $statement->fetchAll();
    $statement->closeCursor();
    return $users;
}
function get_users_limit()
{
    global $db;
    if (!isset($_GET['page_id'])) {
        $page = 1;
    } else {
        $page = $_GET['page_id'];
    }
    if (!isset($_GET['show'])) {
        $show = 10;
    } else {
        $show = $_GET['show'];
    }
    if (isset($_GET['sort_by'])) {
        $sort_by = $_GET['sort_by'];
    } else {
        $sort_by = null;
    }
    $once_page = ($page - 1) * $show;

    if($sort_by == null){
        $query = 'SELECT * FROM users LIMIT :once_page,:show';
    }elseif($sort_by == 'id_desc'){
        $query = 'SELECT * FROM users ORDER BY userId desc LIMIT :once_page,:show';
    }elseif($sort_by == 'id_asc'){
        $query = 'SELECT * FROM users ORDER BY userId asc LIMIT :once_page,:show';
    }elseif($sort_by == 'name_desc'){
        $query = 'SELECT * FROM users ORDER BY name desc LIMIT :once_page,:show';
    }elseif($sort_by == 'name_asc'){
        $query = 'SELECT * FROM users ORDER BY name asc LIMIT :once_page,:show';
    }elseif($sort_by == 'role_desc'){
        $query = 'SELECT * FROM users ORDER BY role desc LIMIT :once_page,:show';
    }elseif($sort_by == 'role_asc'){
        $query = 'SELECT * FROM users ORDER BY role asc LIMIT :once_page,:show';
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':once_page', $once_page, PDO::PARAM_INT);
    $statement->bindValue(':show', $show, PDO::PARAM_INT);
    $statement->execute();
    $users = $statement->fetchAll();
    $statement->closeCursor();
    return $users;

}
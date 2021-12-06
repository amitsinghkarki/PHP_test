<?php
session_start();
$serverName = "mysql";
// $serverName = "localhost";

$username = "amit";
$password = "amit";
$dbname = "dummy";
$port = '3306';

$conn = new mysqli($serverName, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getCategories($db)
{
    $category_sql = "SELECT * FROM category";

    return $result = $db->query($category_sql);

}

function getSkills($db, $category)
{
    $skill_sql = $db->prepare("SELECT * FROM skill where category_id=?");
    $result = $skill_sql->bind_param("i", $category);
    $result = $skill_sql->execute();
    $result = $skill_sql->get_result();
    $skill_sql->close();
    return $result;

}

function getUsersData($db)
{
    $users_sql = "SELECT user_id,first_name,last_name,phone,email FROM user_data ";
    return $result = $db->query($users_sql);
}

function getUserById($db, $id)
{
    $user_sql = $db->prepare("SELECT * FROM user_data where user_id=?");

    $result = $user_sql->bind_param("i", $id);

    $result = $user_sql->execute();
    $result = $user_sql->get_result();

    $user_sql->close();
    return $result;

}

function getUserByEmail($db, $email)
{
    $user_sql = $db->prepare("SELECT * FROM user_data where email=?");

    $result = $user_sql->bind_param("s", $email);

    $result = $user_sql->execute();
    $result = $user_sql->get_result();

    $user_sql->close();
    return $result;

}

function getSkillsOfUser($db, $id)
{
    $user_skill_sql = $db->prepare("SELECT u.id, user_id,c.category_name , s.skill_name ,u.skill_id, rating
    FROM user_skills u
    inner join skill s on s.skill_id =u.skill_id
    inner join category c on c.id =s.category_id
    where user_id=?");

    $result = $user_skill_sql->bind_param("i", $id);

    $result = $user_skill_sql->execute();
    $result = $user_skill_sql->get_result();

    $user_skill_sql->close();
    return $result;

}

function loginAdmin($db, $user, $pass)
{
    $pass = hash('sha256', $pass);

    $admin_login = $db->prepare("SELECT *
    FROM admin
    where username=? and password=?");

    $result = $admin_login->bind_param("ss", $user, $pass);

    $result = $admin_login->execute();
    $result = $admin_login->get_result();
    $login = mysqli_num_rows($result);
    $admin_login->close();

    if ($login > 0) {

        return true;
    }

    return false;

}

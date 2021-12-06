<?php

//$serverName = "mysql";
$serverName = "localhost";

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
    $users_sql = "SELECT user_id,first_name,last_name FROM user_data ";
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

<?php

$servername = "mysql";

$username = "amit";
$password = "amit";
$dbname = "dummy";
$port = '3306';

$conn = new mysqli($servername, $username, $password, $dbname, $port);

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
    $skill_sql = "SELECT * FROM skill where category_id=$category";

    return $result = $db->query($skill_sql);
}

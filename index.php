<?php

require_once 'connection.php';

$result = $conn->query("SELECT now() as time");
$row = $result->fetch_assoc();
echo htmlentities($row['time']);

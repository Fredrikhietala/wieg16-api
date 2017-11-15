<?php

$username = "root";
$password = "root";
$db = "customer_info";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * 
FROM customer
LEFT JOIN customer_address ON customer.id = customer_address.customer_id';
$rows = $conn->query($sql);
$data = $rows->fetchAll();
header("Content-Type: application/json");
echo json_encode($data);
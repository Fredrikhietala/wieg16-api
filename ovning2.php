<?php

$username = "root";
$password = "root";
$db = "customer_info";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = (int)$_GET['customer_id'];
$sql = 'SELECT * 
FROM customer
LEFT JOIN customer_address ON customer.id = customer_address.customer_id
WHERE customer.id = :id';
$rows = $conn->prepare($sql);
$rows->execute([':id' => $id]);
$response = $rows->fetch();
$status = 200;

if ($response == null) {
    $status = 400;
    $response = ["message" => "Customer not found"];
}

header("Content-Type: application/json", true, $status);
echo json_encode($response);
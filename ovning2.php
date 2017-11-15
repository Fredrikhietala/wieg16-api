<?php

$username = "root";
$password = "root";
$db = "customer_info";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];
$sql = 'SELECT * 
FROM customer
LEFT JOIN customer_address ON customer.id = customer_address.customer_id
WHERE customer.id = "'.$id.'"';
$rows = $conn->prepare($sql);
$rows->execute([]);
$data = $rows->fetch();

if ($data > 0) {
    echo json_encode($data);
} else {
    header("HTTP/1.0 404 Not Found");
    echo json_encode(["message" => "Customer not found"]);
}

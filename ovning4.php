<?php

$username = "root";
$password = "root";
$db = "customer_info";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$address = $_GET['address'];
//$address = false;
$id = $_GET['customer_id'];
$address_sql = 'SELECT street, postcode, city
FROM customer_address
WHERE customer_id = "'.$id.'"';
$rows = $conn->prepare($address_sql);
$rows->execute([]);
$data = $rows->fetch();

var_dump($data);
if (isset($address) && $address == true && ($data > 0)) {
    header("Content-Type: application/json");
    echo json_encode($data);
} else {
    header("HTTP/1.0 404 Not Found");
    echo json_encode(["message" => "Address not found"]);
}

<?php

$username = "root";
$password = "root";
$db = "customer_info";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$address = (isset($_GET['address']) && $_GET['address'] == "true");
$id = (int)$_GET['customer_id'];

$status = 404;
$response = ["Message" => "Address not found"];

if ($address) {
    $address_sql = 'SELECT street, postcode, city
    FROM customer_address
    WHERE customer_id = :id';
    $rows = $conn->prepare($address_sql);
    $rows->execute([':id' => $id]);
    if ($rows->rowCount() > 0) {
        $response = $rows->fetch();
        $status = 200;
    }
}

header("Content-Type: application/json");
echo json_encode($response);



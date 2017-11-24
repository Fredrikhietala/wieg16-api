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

// lösning 2

$customers = $conn->query('SELECT * FROM customers')->fetchAll();
$addresses = $conn->query('SELECT * FROM customers_address')->fetchAll();

foreach ($customers as $index => $customer) {
    $address = array_filter($addresses, function($item) use ($customer) {
        // Om detta blir true så får vi tillbaka den adressen i vår array
        return $item['customer_id'] == $customer['id'];
    });
    if (count($address) > 0) {
        $customers[$index]['address'] = array_shift($address);
    }
}

header("Content-Type: application/json");
echo json_encode($customers);

// lösning 3

$customers = $conn->query('SELECT * FROM customers')->fetchAll();

// lösning 4

$customers = $conn->query('SELECT * FROM customers')->fetchAll();
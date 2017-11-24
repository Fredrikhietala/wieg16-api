<?php

$username = "root";
$password = "root";
$db = "customer_info";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$customer_sql = 'SELECT * FROM customer';
$rows = $conn->query($customer_sql);
$customer_data = $rows->fetchAll();
header("Content-Type: application/json");
//echo json_encode($customer_data);

$companies = [];

foreach ($customer_data as $customer) {
    $companies[] = $customer['customer_company'];
}
//array_unique($companies);

foreach (array_unique($companies) as $company) {
    $companies_stm = $conn->prepare("INSERT INTO companies (company_name) VALUES (:company_name)");
    $companies_stm->execute([
        ':company_name' => $company
    ]);
}

$company_sql = 'SELECT * FROM companies';
$company_rows = $conn->prepare($company_sql);
$company_rows->execute([]);
$company_data = $company_rows->fetchAll();
echo json_encode($company_data);

//$company_id = $_GET['company_id'];
//$customer_company = $_GET['company_name'];
foreach ($company_data as $company) {
    $update_sql = 'UPDATE customer SET company_id = :company_id WHERE customer_company = :customer_company';
    $update_stm = $conn->prepare($update_sql);
    $update_stm->execute([
        ':company_id' => $company['id'],
        ':customer_company' => $company['company_name']
    ]);
}




<?php


require __DIR__ . '/config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
$full_name = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$product = trim($_POST['product'] ?? '');
$quantity = max(1, (int)($_POST['quantity'] ?? 1));
$message = trim($_POST['message'] ?? '');
if ($full_name === '' || $phone === '' || $address === '' || $product === '' || $message === '')
exit('Please complete all required fields.');
$stmt = $pdo->prepare('INSERT INTO orders (full_name, phone, address, product, quantity, message) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->execute([$full_name,$phone,$address,$product,$quantity,$message]);
header('Location: index.php?success=1#products'); exit;


?>
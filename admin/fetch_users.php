<?php
include '../components/connect.php';
// Fetch user data from the database
$query = "SELECT id, name, email FROM users";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return user data as JSON
header('Content-Type: application/json');
echo json_encode($users);



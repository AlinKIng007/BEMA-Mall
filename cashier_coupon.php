<?php
// Start session
session_start();

// Include the file to connect to the database
require 'components/connect.php';

// Initialize an empty array for discount codes
$discountCodes = [];

try {
    // Fetch discount codes from the database
    $sql = "SELECT id as coupn_id,code, discount FROM coupons WHERE is_active = 1"; // Assuming active coupons only
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch discount codes as associative array
    $codes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the discount codes as JSON
    echo json_encode($codes);
} catch (PDOException $e) {
    // Handle database connection errors
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit(); // Exit to prevent further execution
}
?>

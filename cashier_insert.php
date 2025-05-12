<?php
// Include necessary files and start session if needed
require 'components/connect.php';
session_start();
$coupon_id = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve JSON data from the request body
    $postData = json_decode(file_get_contents("php://input"), true);

    // Check if JSON decoding was successful
    if ($postData === null && json_last_error() !== JSON_ERROR_NONE) {
        // JSON decoding failed, return an error response
        echo json_encode(["success" => false, "message" => "Error decoding JSON data."]);
        exit; // Terminate script execution
    }
    
    // Extract data from the decoded JSON
    $pid = $postData["pid"];
    $quantity = $postData["quantity"];
    if($postData["coupon_id"] !== ""){
    $coupon_id = $postData["coupon_id"];
    }
    $emp_id = $_SESSION["emp_id"];
    try {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO orders (status_id,payment_method_id,employee_id, product_id, amount, coupon_id) VALUES (?,?,?, ?, ?, ?)");

        // Execute the prepared statement
        $stmt->execute(["3", "4", $emp_id, $pid, $quantity, $coupon_id]);
        // Return success response
        echo json_encode(["success" => true, "message" => "Transaction inserted successfully."]);
    } catch (PDOException $e) {
        // Return error response
        echo json_encode(["success" => false, "message" => "Error inserting transaction: " . $e->getMessage() . " / " . json_encode($stmt) . " / " . json_encode($coupon_id)]);

    }
}

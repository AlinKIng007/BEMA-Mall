<?php
session_start();
require '../components/prevention_admin.php';
require "../components/connect.php";

try {
    // Prepare the SQL statement
    $sql = "SELECT id, username, email FROM users";
    $stmt = $conn->prepare($sql);

    // Execute the query
    if ($stmt->execute()) {
        // Fetch all users as an associative array
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return JSON response with user data
        header('Content-Type: application/json');
        echo json_encode($users);
    } else {
        // If the query execution fails, return an error message
        echo "Error: Unable to execute the query.";
    }
} catch(PDOException $e) {
    // In case of error, return an error message
    echo "Error: " . $e->getMessage();
}
?>

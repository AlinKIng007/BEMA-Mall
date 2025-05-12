<?php
include '../components/connect.php'; // Include the file with the database connection

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data sent from the client-side
    $requestData = json_decode(file_get_contents('php://input'), true);
    
    // Check if the required data is present
    if (isset($requestData['table_name'], $requestData['row_data']['id'])) {
        // Extract table name and row data
        $table_name = $requestData['table_name'];
        $row_id = $requestData['row_data']['id'];
        
        try {
            // Construct the DELETE query
            $delete_query = "DELETE FROM $table_name WHERE id = :id";
            
            // Prepare the DELETE statement
            $statement = $conn->prepare($delete_query);
            
            // Bind the ID parameter
            $statement->bindValue(":id", $row_id);
            
            // Execute the DELETE statement
            if ($statement->execute()) {
                // Deletion successful
                $response = array('success' => true, 'message' => 'Row deleted successfully');
                echo json_encode($response);
            } else {
                // Deletion failed
                $response = array('success' => false, 'message' => 'Error: Unable to delete row');
                echo json_encode($response);
            }
        } catch (PDOException $e) {
            // Handle database errors
            $response = array('success' => false, 'message' => 'Database error: ' . $e->getMessage());
            echo json_encode($response);
        }
    } else {
        // Required data not provided
        $response = array('success' => false, 'message' => 'Missing required data');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>

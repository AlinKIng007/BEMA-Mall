<?php
session_start();
require '../components/prevention_admin.php';
// Include database connection
include '../components/connect.php';

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the table name from the POST data
    $data = json_decode(file_get_contents("php://input"), true);
    $table_name = $data['table_name'];

    // Call the stored procedure to get column names for the specified table
    $stmt = $conn->prepare("CALL GetTableColumnsDataWhere(?,?)");
    // $stmt->bindParam(1, $table_name, PDO::PARAM_STR);
    $stmt->execute([$db_name,$table_name]); // Passing only one parameter
    

    // Fetch all rows from the result set (column names)
    $columnNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    // Move to the next result set
    $stmt->nextRowset();
    // Fetch all rows from the result set (table data)
    $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Encode column names and table data into JSON format and send back to JavaScript
    $responseData = array(
        'columnNames' => $columnNames,
        'tableData' => $tableData
    );

    header('Content-Type: application/json');
    echo json_encode($responseData);
}
?>

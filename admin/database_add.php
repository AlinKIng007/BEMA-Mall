<?php
include '../components/connect.php';




session_start();
// Check if the necessary POST parameters are set
if (isset($_POST["table_name"]) && isset($_POST["id"])) {
    $table_name = $_POST["table_name"];
    try {
        // Construct the SQL INSERT query dynamically
        $sql = "INSERT INTO $table_name (";
        $params = [];
        $values = [];
        foreach ($_POST as $key => $value) {
            // Skip the 'table_name' parameter
            if ($key != "table_name") {
                $sql .= "$key, ";
                $values[] = "?";
                $params[] = $value;
            }
        }
        // Remove the trailing comma and space
        $sql = rtrim($sql, ", ");
        $sql .= ") VALUES (";
        $sql .= implode(", ", $values);
        $sql .= ")";

        // Prepare and execute the SQL statement using prepared statement
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Check if any rows were affected
        $affectedRows = $stmt->rowCount();
        if ($affectedRows > 0) {
            header("location: database.php");
            echo "Insert successful. $affectedRows row(s) inserted.";
            
        } else {
            header("location: database.php");
            echo "No rows inserted.";
            
        }
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
<?php
session_start();
require '../components/prevention_admin.php';
require "../components/connect.php";

// Check if order_id is provided and is a valid integer
if(isset($_POST['order_id'])) {
    try {
        // Prepare the SQL statement
        $sql = "
            SELECT
                users.username,
                orders.id,
                orders.amount,
                orders.time_of_purchase,
                main_products.product_name,
                malls.mall_name,
                `status`.type,
                payment_method.method_name,
                products.price
            FROM
                orders
                INNER JOIN users ON users.id = orders.user_id
                INNER JOIN products ON products.id = orders.product_id
                INNER JOIN main_products ON main_products.id = products.main_product_id
                INNER JOIN `status` ON `status`.id = orders.status_id
                INNER JOIN payment_method ON payment_method.id = orders.payment_method_id
                INNER JOIN positions ON products.position_id = positions.id
                INNER JOIN shelves ON positions.shelf_id = shelves.id
                INNER JOIN shops ON shelves.shop_id = shops.id
                INNER JOIN floors ON shops.floor_id = floors.id
                INNER JOIN malls ON floors.mall_id = malls.id
            WHERE orders.id = ?
        ";
        $stmt = $conn->prepare($sql);

        // Execute the query
        if ($stmt->execute([$_POST['order_id']])) {
            // Fetch all orders as an associative array
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if any orders found
            if (count($orders) > 0) {
                // Return JSON response with order data
                header('Content-Type: application/json');
                echo json_encode($orders);
            } else {
                // If no orders found, return a message
                echo json_encode(["message" => "No orders found for the provided order ID."]);
            }
        } else {
            // If the query execution fails, return an error message
            echo json_encode(["error" => "Unable to execute the query."]);
        }
    } catch(PDOException $e) {
        // In case of error, return an error message
        echo json_encode(["error" => "Error: " . $e->getMessage()]);
    }
} else {
    // If order_id is not provided or not valid, return an error message
    echo json_encode(["error" => "Invalid or missing order ID."]);
}
?>

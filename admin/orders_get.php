<?php
session_start();
require '../components/prevention_admin.php';
require "../components/connect.php";

try {
    // Pagination parameters
    $pageSize = isset($_GET['size']) ? intval($_GET['size']) : 10; // Default page size is 10
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Default page number is 1

    // Calculate the offset
    $offset = ($page - 1) * $pageSize;

    // Prepare the SQL statement with pagination
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
        LIMIT :offset, :pageSize
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        // Fetch all orders as an associative array
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return JSON response with order data
        header('Content-Type: application/json');
        echo json_encode($orders);
    } else {
        // If the query execution fails, return an error message
        echo "Error: Unable to execute the query.";
    }
} catch(PDOException $e) {
    // In case of error, return an error message
    echo "Error: " . $e->getMessage();
}
?>

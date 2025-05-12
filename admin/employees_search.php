<?php

require "../components/connect.php";

try {
    // Prepare the SQL statement
    $sql = "
    SELECT
	users.id,
	users.username,
	users.email,
	departments.name AS department_name,
	titles.allowance,
	titles.title,
	malls.mall_name 
FROM
	users
	INNER JOIN employees ON users.id = employees.user_id
	INNER JOIN roles ON employees.id = roles.employee_id
	INNER JOIN titles ON roles.title_id = titles.id
	INNER JOIN department_employee ON employees.id = department_employee.employee_id
	INNER JOIN departments ON department_employee.department_id = departments.id
	INNER JOIN malls ON malls.id = departments.mall_id
    ";
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

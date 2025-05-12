<?php



session_start();
require '../components/prevention_admin.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>bema dashboard</title>
</head>

<body>

    <div class="container">
        <?php
        include 'aside.php';
        ?>

        <!-- Main Content -->
        <main>
            <label>select</label>
            <select name="" id="">
            <?php
try {
    // Assuming $conn is your PDO connection object
    $select_column = $conn->prepare("CALL GetTableColumns(?)");
    $select_column->bindParam(1, $db_name, PDO::PARAM_STR);
    $select_column->execute();

    // Check if any rows were returned
    if ($select_column->rowCount() > 0) {
        // Fetch column names and populate the dropdown
        while ($fetch_column = $select_column->fetch(PDO::FETCH_ASSOC)) {
            $column_name = htmlspecialchars($fetch_column["COLUMN_NAME"]); // Escape HTML characters
            // Output option tag with column name
            echo "<option value='$column_name'>$column_name</option>";
        }
    } else {
        echo "<option value=''>No columns found</option>";
    }
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}
?>

            </select>
            <label>from</label>
            <select name="" id="">
                <option value=""></option>
            </select>
            <label>where</label>
            <select name="" id="">
                <option value=""></option>
            </select>
        </main>
        <!-- End of Main Content -->



        <?php
        include 'right_section.php';
        ?>
    </div>


    </div>


    <script src="index.js"></script>
</body>

</html>
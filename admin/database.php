<?php
include '../components/connect.php';




session_start();




// Check if the required POST parameters are set
if (isset($_POST["table_name"]) && isset($_POST["id"])) {
    $table_name = $_POST["table_name"];
    $id = $_POST["id"];
    try {
        // Construct the SQL UPDATE query
        $sql = "UPDATE $table_name SET ";

        $params = [];
        foreach ($_POST as $key => $value) {
            // Skip the 'table_name' and 'id' parameters
            if ($key != "table_name" && $key != "id") {
                $sql .= "$key = ?, ";
                $params[] = $value;
            }
        }        // Remove the trailing comma and space
        $sql = rtrim($sql, characters: ", ");
        // Append the WHERE clause to update the row with the specified id
        $sql .= " WHERE id = ?";
        $params[] = $id;

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Check if any rows were affected
        $affectedRows = $stmt->rowCount();
        if ($affectedRows > 0) {
            echo "Update successful. $affectedRows row(s) updated.";
        } else {
            echo "No rows updated.";
        }
    } catch (PDOException $e) {

        // Handle errors
        echo "Error1: " . $e->getMessage();
    }
}

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
<style>
    /* The main Modal */



    .scroll-container {
        overflow-x: auto;
        /* Add horizontal scroll */
        max-width: 100%;
        /* Optionally limit the maximum width */
        /* Customize scrollbar */
        scrollbar-width: thin;
        scrollbar-color: #888 #f5f5f5;
    }

    /* Track */
    .scroll-container::-webkit-scrollbar {
        width: 8px;
        /* Width of the scrollbar */
    }

    /* Handle */
    .scroll-container::-webkit-scrollbar-thumb {
        background: #888;
        /* Color of the scrollbar handle */
        border-radius: 4px;
        /* Border radius of the scrollbar handle */
    }

    /* Handle on hover */
    .scroll-container::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Color of the scrollbar handle on hover */
    }

    /* Track */
    .scroll-container::-webkit-scrollbar-track {
        background: #f5f5f5;
        /* Color of the scrollbar track */
    }

    /* Handle when dragging */
    .scroll-container::-webkit-scrollbar-thumb:active {
        background: #777;
        /* Color of the scrollbar handle when dragging */
    }

    /* Style for the edit modal */
    #editModal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
        /* Place content 60px from the top */
    }

    /* Style for the edit form fields */
    #editFields {
        background-color: whitesmoke;
        margin: 5% auto;
        /* 5% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* Style for the add modal */
    #addModal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
        /* Place content 60px from the top */
    }

    /* Style for the add form fields */
    #addFields {
        background-color: whitesmoke;
        margin: 5% auto;
        /* 5% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* Style for labels */
    .custom-label {
        margin-bottom: 10px;
        display: block;
        font-weight: bold;
        color: black;
    }

    /* Style for input fields */
    .custom-class {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: white;
        color: black;
    }

    /* Style for the update button */
    .update-btn {
        background-color: #4CAF50;
        /* Green */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
    }

    .update-btn:hover {
        background-color: #45a049;
    }

    #myInput {
        background-image: url('/css/searchicon.png');
        /* Add a search icon to input */
        background-position: 10px 12px;
        /* Position the search icon */
        background-repeat: no-repeat;
        /* Do not repeat the icon image */
        width: 100%;
        /* Full-width */
        font-size: 16px;
        /* Increase font-size */
        padding: 12px 20px 12px 40px;
        /* Add some padding */
        border: 1px solid #ddd;
        /* Add a grey border */
        margin-bottom: 12px;
        /* Add some space below the input */
    }
</style>

<body>
    <div class="scroll-container">
        <div class="container">
            <?php
            include 'aside.php';
            ?>

            <!-- Main Content -->
            <main>
                <h1>Database</h1>
                <input type="text" id="myInput" onkeyup="filterDatabases()" placeholder="Search for Tables...">


                <div class="analyse">
                    <?php
                    try {
                        // Call the stored procedure to get table names
                        $stmt = $conn->prepare("CALL GetTables(?)");
                        $stmt->execute([$db_name]);
                        // Fetch the result
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Output the result
                        foreach ($result as $row) {
                            ?>
                            <div class="database-block" style="background-color: gray; height: 100px;">
                                <div class="status" style="text-align: center;">
                                    <div class="info" style="margin: 0 auto;">

                                        <h2 class="capital" style="font-weight: bold;"><?= $row['table_name'] ?></h2>
                            <br>
                                        <button onclick="show('<?= $row['table_name'] ?>');" class="btn capital">Open
                                            <?= $row['table_name'] ?></button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        // // Encode the PHP array as JSON
                        // $columnsJson = json_encode($columnsArray);
                    } catch (PDOException $e) {
                        echo $db_name;
                        // Handle errors
                        echo "Error2: " . $e->getMessage();
                    }


                    ?>




                    <!-- The main Modal -->
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <h2 id="table-name"></h2>
                            <table id="crudTable">
                                <button id="addButton" type="button" class="btn"
                                    style="float: right; margin: 10px; background-color: limegreen">Add</button>

                                <!-- Ensure your HTML contains the necessary button to trigger the modal -->
                                <button type="button" onclick="closeModal()" class="btn"
                                    style="float: right; margin: 10px;">Back</button>
                                <thead id="table-headers">
                                    <!-- Table headers will be populated dynamically -->
                                </thead>
                                <tbody id="table-body">
                                    <!-- Table data will be populated dynamically -->
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <!-- The Edit Modal -->
                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <h2>Edit Item</h2>
                            <form method="post" name="edit_form">
                                <div id="editFields">
                                    <!-- Form fields will be populated dynamically -->
                                </div>
                                <button type="button" class="btn" onclick="closeEditModal()">Close</button>
                            </form>
                        </div>
                    </div>




                    <!-- The Add Modal -->
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <h2>Add Item</h2>
                            <form method="post" name="add_form" action="database_add.php">
                                <div id="addFields">
                                    <!-- Form fields will be populated dynamically -->
                                </div>
                                <button type="button" class="btn" onclick="closeAddModal()">Close</button>
                            </form>
                        </div>
                    </div>

                </div>

            </main>
            <!-- End of Main Content -->


            <?php
            include 'right_section.php';
            ?>


        </div>




    </div>
</body>

<script src="index.js"></script>
<!--  code -->
<script>
    // Global variables to store current item data

    function show(modalname) {
        var table_name = modalname;
        let modal = document.getElementById("myModal");
        let tableHeaders = document.getElementById("table-headers");
        let tableBody = document.getElementById("table-body");
        document.getElementById("table-name").textContent = capitalizeAndRemoveUnderscore(table_name) + " Table";

        // Clear existing table headers and data
        tableHeaders.innerHTML = "";
        tableBody.innerHTML = "";

        // Send request to PHP script to fetch data
        fetch('tables_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                table_name: table_name
            }) // Send the table name to PHP
        })
            .then(response => response.json()) // Parse JSON response
            .then(data => {
                // Populate table headers
                let headersRow = tableHeaders.insertRow();
                data.columnNames.forEach(columnName => {
                    let headerCell = document.createElement("th");
                    headerCell.textContent = columnName;
                    headersRow.appendChild(headerCell);
                });

                // Add an "Actions" header
                let actionsHeader = document.createElement("th");
                actionsHeader.textContent = "Actions";
                headersRow.appendChild(actionsHeader);

                // Populate table data
                data.tableData.forEach(rowData => {
                    let dataRow = tableBody.insertRow();
                    Object.entries(rowData).forEach(([key, value]) => {
                        let dataCell = dataRow.insertCell();
                        dataCell.textContent = value;
                    });

                    // Add "Edit" and "Delete" buttons in the "Actions" column
                    let actionsCell = dataRow.insertCell();
                    let editButton = document.createElement("button");
                    editButton.textContent = "Edit";
                    editButton.className = "edit-btn btn";
                    editButton.onclick = function () {
                        // Call showEditModal and pass the column names, table data, and rowData
                        showEditModal(data.columnNames, data.tableData, rowData, table_name);
                    };
                    actionsCell.appendChild(editButton);

                    let deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.className = 'delete-btn btn';
                    deleteButton.onclick = function () {
                        // Call deleteItem and pass the column names, table data, and rowData
                        deleteItem(data.columnNames, data.tableData, rowData, table_name);
                    };
                    actionsCell.appendChild(deleteButton);

                    // Create a form for each row with hidden input fields containing the data
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = ''; // Replace 'delete_process.php' with your actual PHP processing file
                    Object.entries(rowData).forEach(([key, value]) => {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = value;
                        form.appendChild(input);
                    });
                    actionsCell.appendChild(form);
                });

                // Get the button element by its ID
                let addButton = document.getElementById("addButton");

                // Add click event listener to the button
                addButton.addEventListener("click", function () {
                    // Call the function to handle the button click event
                    showAddModal(data.columnNames, data.tableData, null, table_name);
                });
            })
            .catch(error => {
                console.error('Error3:', error);
            });

        modal.style.display = "block"; // Show the modal
    }



    // Function to handle deleting item
    function deleteItem(columnNames, tableData, rowData, table_name) {
        // Prepare data to be sent to PHP
        let requestData = {
            table_name: table_name,
            row_data: rowData
        };

        // Send a POST request to the PHP script for deletion
        fetch('delete_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                window.location.href = window.location.href;
            })
            .catch(error => {
                console.error('Error4:', error);
            });
    }





    function showEditModal(columnNames, tableData, rowData, tabl_name) {
        let editModal = document.getElementById("editModal");
        let editFields = document.getElementById("editFields");
        editFields.innerHTML = ''; // Clear previous form fields

        // Iterate through the column names and table data to create input fields
        columnNames.forEach((columnName, index) => {
            let value = rowData[columnName]; // Get the corresponding value from the row data using the column name

            // Create label element
            let label = document.createElement('label');
            label.textContent = columnName + ": "; // Set label text to column name
            label.classList.add('custom-label'); // Add custom class to label

            // Create input field
            let inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.name = columnName;
            inputField.value = value;
            inputField.classList.add('custom-class');

            // Append the input field to the editFields element
            editFields.appendChild(label);
            editFields.appendChild(inputField);
        });


        // Create the table_name input field and make it hidden
        let table_name_input = document.createElement('input');
        table_name_input.type = 'hidden';
        table_name_input.name = 'table_name';
        table_name_input.value = tabl_name;
        editFields.appendChild(table_name_input);

        // Create and append the Update button
        let updateButton = document.createElement('button');
        updateButton.textContent = 'Update';
        updateButton.className = 'update-btn btn';
        editFields.appendChild(updateButton);

        editModal.style.display = "block"; // Show the edit modal
    }


    function showAddModal(columnNames, tableData, rowData, table_name) {
        let addModal = document.getElementById("addModal");
        let addFields = document.getElementById("addFields");
        addFields.innerHTML = ''; // Clear previous form fields

        // Iterate through the column names and table data to create input fields
        columnNames.forEach((columnName, index) => {
            let value = rowData ? rowData[columnName] : ''; // Check if rowData is available

            // Create label element
            let label = document.createElement('label');
            label.textContent = columnName + ": "; // Set label text to column name
            label.classList.add('custom-label'); // Add custom class to label

            // Create input field
            let inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.name = columnName;
            inputField.value = value;
            inputField.classList.add('custom-class');

            // Append the input field to the addFields element
            addFields.appendChild(label);
            addFields.appendChild(inputField);
        });

        // Create the table_name input field and make it hidden
        let table_name_input = document.createElement('input');
        table_name_input.type = 'hidden';
        table_name_input.name = 'table_name';
        table_name_input.value = table_name;
        addFields.appendChild(table_name_input);

        // Create and append the Add button
        let addButton = document.createElement('button');
        addButton.textContent = 'Add';
        addButton.className = 'add-btn btn';
        addFields.appendChild(addButton);

        addModal.style.display = "block"; // Show the add modal
    }







    function createInputField(container, label, name, value) {
        const inputField = document.createElement('input');
        inputField.type = 'text'; // You can change the type if needed
        inputField.name = name;
        inputField.value = value || ''; // Set value if exists
        // Optionally, you can create a label for each input field
        const labelElement = document.createElement('label');
        labelElement.textContent = label + ': ';
        labelElement.appendChild(inputField);
        container.appendChild(labelElement);
        container.appendChild(document.createElement('br')); // Add line break
    }



    // Function to close the add modal
    function closeAddModal() {
        let addModal = document.getElementById("addModal");
        addModal.style.display = "none"; // Hide the add modal
    }


    // Function to close the edit modal
    function closeEditModal() {
        let editModal = document.getElementById("editModal");
        editModal.style.display = "none"; // Hide the edit modal
    }

    function closeModal() {
        let modal = document.getElementById("myModal");
        modal.style.display = "none"; // Hide the modal
    }


    function capitalizeAndRemoveUnderscore(string) {
        // Check if the string is not empty
        if (string.length > 0) {
            // Split the string into an array of words separated by underscores
            let words = string.split('_');

            // Capitalize the first letter of each word and concatenate them
            let capitalizedWords = words.map(word => {
                // Capitalize the first letter of the word and concatenate it with the rest of the word
                return word.charAt(0).toUpperCase() + word.slice(1);
            });

            // Join the capitalized words into a single string separated by spaces
            return capitalizedWords.join(' ');
        } else {
            // Return an empty string if the input is empty
            return '';
        }
    }

    // Get all elements with the class name "capital"
    let elements = document.getElementsByClassName('capital');

    // Loop through each element
    Array.from(elements).forEach(element => {
        // Get the current text content of the element
        let text = element.textContent;

        // Capitalize and remove underscores from the text content
        let newText = capitalizeAndRemoveUnderscore(text);

        // Update the text content of the element
        element.textContent = newText;
    });
</script>
<script>
    function filterDatabases() {
        var filter = document.getElementById("myInput").value.toLowerCase();
        var databaseBlocks = document.getElementsByClassName("database-block");

        for (var i = 0; i < databaseBlocks.length; i++) {
            var databaseName = databaseBlocks[i].getElementsByClassName("capital")[0].textContent.toLowerCase();
            if (databaseName.indexOf(filter) > -1) {
                databaseBlocks[i].style.display = "";
            } else {
                databaseBlocks[i].style.display = "none";
            }
        }
    }
</script>

</html>
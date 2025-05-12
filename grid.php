<?php
require 'components/connect.php';
session_start();
require 'components/prevention.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Global Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #262626;
    color: white;
    line-height: 1.6;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header Styles */
header {
    background-color: #2196F3;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    font-size: 24px;
}

/* Select Styles */
#mall_selector {
    padding: 8px;
    border-radius: 5px;
    border: none;
    background-color: #fff;
    font-size: 16px;
    margin-bottom: 20px;
}

/* Inputs Styles */
.inputs {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.inputs label {
    margin-right: 10px;
    font-size: 18px;
}

.inputs input {
    padding: 8px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    width: 100px;
    color: white;
}

/* Grid Container Styles */
.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
    grid-auto-rows: 50px;
    gap: 0;
}

.cell {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Grid Items Container Styles */
.grid-container-items {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 0;
    padding: 10px;
    
}

.grid-container-items>div {
    background-color: rgba(255, 255, 255, 0.8);
    text-align: center;
    padding: 20px 0;
    font-size: 24px;
}

</style>

<body>

    <div class="container">
        <select onchange="choosemall(this.value)" name="" id="mall_selector">
            <?php
            $mall_id = $_SESSION['mall_id'];
            // Fetch methods from the database and populate the dropdown
            try {
                $select_shops = $conn->prepare("SELECT
                m.id,
                s.id as sid,
                s.shop_name,
                s.north_in_meters AS north,
                s.east_in_meters AS east 
            FROM
                malls m
                inner JOIN floors f ON m.id = f.mall_id
                inner JOIN shops s ON f.id = s.floor_id

            WHERE
                m.id = ?");
                $select_shops->execute([$mall_id]);
                while ($fetch_shops = $select_shops->fetch(PDO::FETCH_ASSOC)) {
                    $shop_id = $fetch_shops["sid"];
                    $shop_name = $fetch_shops["shop_name"];
                    // Set the selected attribute if it matches the previously selected method
                    echo "<option value='$shop_id'>$shop_name</option>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </select>

        <div class="inputs">
            <label for="gridWidth">Grid Width:</label>
            <input type="number" id="gridWidth" value="" disabled>
            <label for="gridHeight">Grid Height:</label>
            <input type="number" id="gridHeight" value="" disabled>
        </div>

        <h1 style="color: white;">north ^</h1>

        <div id="gridContainer" class="grid-container"></div>

    </div>
    <div class="container d-flex justify-content-center">

        <div id="gridItemsContainer" class="grid-container-items">

        </div>
    </div>
    <script src="script.js"></script>
</body>
<script>
    window.onload = function() {
        choosemall(document.getElementById('mall_selector').value);
    };

    function choosemall(value) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var responses = JSON.parse(this.responseText);
                console.log(responses);

                var gridWidth = 0;
                var gridHeight = 0;
                var allEastFrom = [];
                var allEastTo = [];
                var allSouthFrom = [];
                var allSouthTo = [];
                var allShId = []; // Initialize array to store shelf IDs

                responses.forEach(function(response) {
                    // Accumulate data for each line
                    gridWidth = response.width;
                    gridHeight = response.height;

                    allEastFrom.push(response.eastFrom);
                    allEastTo.push(response.eastTo);
                    allSouthFrom.push(response.southFrom);
                    allSouthTo.push(response.southTo);
                    allShId.push(response.shid); // Push shelf ID into array
                });

                // Update HTML elements after accumulating all data
                document.getElementById('gridWidth').value = gridWidth;
                document.getElementById('gridHeight').value = gridHeight;

                generateGrid(gridWidth, gridHeight);

                allEastFrom.forEach(function(eastFrom, index) {
                    // Iterate over accumulated data and perform necessary operations
                    const eastTo = allEastTo[index];
                    const southFrom = allSouthFrom[index];
                    const southTo = allSouthTo[index];
                    const ShId = allShId[index];
                    highlightCells(eastFrom, eastTo, southFrom, southTo, ShId);
                });
            }
        };
        xhttp.open("POST", "grid_size.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("shop_id=" + value);
    }





    function generateGrid(width, height) {
        const gridContainer = document.getElementById('gridContainer');
        gridContainer.innerHTML = '';
        gridContainer.style.gridTemplateColumns = `repeat(${width}, minmax(10px, 1fr))`;

        for (let i = 1; i <= height; i++) {
            for (let j = 1; j <= width; j++) {
                const cell = document.createElement('div');
                cell.classList.add('cell');
                cell.setAttribute('id', 'grid:' + i + ',' + j); // Corrected id attribute
                cell.style.background = "gray";
                cell.style.border = "none";
                cell.style.margin = "none";
                cell.style.flex = "none";
                cell.style.padding = "12px";
                gridContainer.appendChild(cell);
            }
        }
    }




    function highlightCells(eastFrom, eastTo, southFrom, southTo, shelf_id) {
        // Loop through each row and column within the specified range
        for (let i = southFrom; i <= southTo; i++) {
            for (let j = eastFrom; j <= eastTo; j++) {
                // Check if the cell exists within the grid
                const cellId = 'grid:' + i + "," + j;
                if (document.getElementById(cellId)) {
                    let cell = document.getElementById(cellId);
                    // Set the background color of the cell to black
                    cell.style.backgroundColor = "red";
                    cell.style.cursor = "pointer";
                    // Add event listener to cell click
                    cell.addEventListener("click", function() {
                        showshelfdata(shelf_id);
                    });
                }
            }
        }
    }
    function showshelfdata(shelf_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            console.log(responses);

            // Find the maximum width and height
            const maxWidth = Math.max(...responses.map(response => response.width));
            const maxHeight = Math.max(...responses.map(response => response.height));

            const gridItemsContainer = document.getElementById('gridItemsContainer');
            gridItemsContainer.innerHTML = '';

            // Create cells for each position in the grid
            for (let z = 1; z <= maxHeight; z++) {
                for (let x = 1; x <= maxWidth; x++) {
                    const cell = document.createElement('div');
                    cell.classList.add('cell');

                    // Get the product information for this position
                    const product = getProductAtPosition(responses, x, z);

                    // If there is a product, set the cell content and attach product ID
                    if (product) {
                        cell.textContent = product.product_name;
                        cell.setAttribute('data-product-id', product.id);
                    } else {
                        cell.textContent = `Cell (${x}, ${z}): Empty`;
                    }

                    // Attach onclick event to each cell
                    cell.onclick = function() {
                        const productId = this.getAttribute('data-product-id');
                        changeurl(productId);
                    };

                    cell.setAttribute('id', `cell_${x}_${z}`);
                    gridItemsContainer.appendChild(cell);
                }
            }

            // Set grid template columns and rows based on max width and height
            gridItemsContainer.style.gridTemplateColumns = `repeat(${maxWidth}, minmax(10px, 1fr))`;
            gridItemsContainer.style.gridTemplateRows = `repeat(${maxHeight}, minmax(10px, 1fr))`;
        }
    };
    xhttp.open("POST", "grid_items.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("shelf_id=" + shelf_id);
}

function getProductAtPosition(responses, x, z) {
    // Find the product at the specified position (x, z)
    return responses.find(response => response.x === x && response.z === z);
}

function changeurl(productId) {
    if(productId !== null){
    window.location.href = "quick_view.php?pid=" + productId;
    }
}

</script>


</html>
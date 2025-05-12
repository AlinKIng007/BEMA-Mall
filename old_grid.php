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
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        display: flex;
        margin-bottom: 10px;
    }

    .form label,
    .inputs label {
        margin-right: 5px;
    }

    .form input,
    .inputs input {
        margin-right: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
        grid-auto-rows: 10px;
        gap: 1px;
    }

    .cell {
        background-color: white;
        border: 1px solid #ccc;
    }

    .red {
        background-color: red;
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
                            INNER JOIN floors f ON m.id = f.mall_id
                            INNER JOIN shops s ON f.id = s.floor_id
                            INNER JOIN shelves sh ON s.id = sh.shop_id
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
        <form id="inputForm" class="form">
            <label for="eastFrom">East From:</label>
            <input type="number" id="eastFrom" min="0">
            <label for="eastTo">East To:</label>
            <input type="number" id="eastTo" min="0">
            <label for="southFrom">South From:</label>
            <input type="number" id="southFrom" min="0">
            <label for="southTo">South To:</label>
            <input type="number" id="southTo" min="0">
            <button type="submit">Submit</button>

        </form>
        <div class="inputs">
            <label for="gridWidth">Grid Width:</label>
            <input type="number" id="gridWidth" value="" disabled>
            <label for="gridHeight">Grid Height:</label>
            <input type="number" id="gridHeight" value="" disabled>
        </div>
        <div id="gridContainer" class="grid-container"></div>
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
            var response = JSON.parse(this.responseText);
            document.getElementById('gridWidth').value = response.east;
            document.getElementById('gridHeight').value = response.north;

            document.getElementById('eastFrom').setAttribute('max', response.east);
            document.getElementById('eastTo').setAttribute('max', response.east);
            document.getElementById('southFrom').setAttribute('max', response.north);
            document.getElementById('southTo').setAttribute('max', response.north);

            generateGrid(response.north, response.east);
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

    for (let i = 0; i < height; i++) {
        for (let j = 0; j < width; j++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            cell.dataset.x = j;
            cell.dataset.y = i;
            gridContainer.appendChild(cell);
        }
    }
}

function highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth) {
    const cells = document.querySelectorAll('.cell');
    cells.forEach((cell, index) => {
        const row = Math.floor(index / gridWidth);
        const col = index % gridWidth;
        if (col >= eastFrom - 1 && col < eastTo && row >= southFrom - 1 && row < southTo) {
            cell.classList.add('red');
        }
    });
}

document.getElementById('inputForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const eastFrom = parseInt(document.getElementById('eastFrom').value);
    const eastTo = parseInt(document.getElementById('eastTo').value);
    const southFrom = parseInt(document.getElementById('southFrom').value);
    const southTo = parseInt(document.getElementById('southTo').value);

    const gridWidth = parseInt(document.getElementById('gridWidth').value);
    const gridHeight = parseInt(document.getElementById('gridHeight').value);

    if (isNaN(gridWidth) || isNaN(gridHeight) || gridWidth <= 0 || gridHeight <= 0) {
        alert('Please enter valid grid width and height.');
        return;
    }

    highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth);
});

</script>


</html>







































































































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
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        display: flex;
        margin-bottom: 10px;
    }

    .form label,
    .inputs label {
        margin-right: 5px;
    }

    .form input,
    .inputs input {
        margin-right: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
        grid-auto-rows: 10px;
        gap: 1px;
    }

    .cell {
        background-color: white;
        border: 1px solid #ccc;
    }

    .red {
        background-color: red;
    }
</style>

<body>

    <div class="container">
        <select id="choosemall" onchange="choosemall(this.value)" name="" id="mall_selector">
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
                            INNER JOIN floors f ON m.id = f.mall_id
                            INNER JOIN shops s ON f.id = s.floor_id
                            INNER JOIN shelves sh ON s.id = sh.shop_id
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
        <form id="inputForm" class="form">
            <label for="eastFrom">East From:</label>
            <input type="number" id="eastFrom" min="0">
            <label for="eastTo">East To:</label>
            <input type="number" id="eastTo" min="0">
            <label for="southFrom">South From:</label>
            <input type="number" id="southFrom" min="0">
            <label for="southTo">South To:</label>
            <input type="number" id="southTo" min="0">
            <button type="submit">Submit</button>

        </form>
        <div class="inputs">
            <label for="gridWidth">Grid Width:</label>
            <input type="number" id="gridWidth" value="" disabled>
            <label for="gridHeight">Grid Height:</label>
            <input type="number" id="gridHeight" value="" disabled>
        </div>
        <div id="gridContainer" class="grid-container"></div>
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
            var response = JSON.parse(this.responseText);
            document.getElementById('gridWidth').value = response.east;
            document.getElementById('gridHeight').value = response.north;

            document.getElementById('eastFrom').setAttribute('max', response.east);
            document.getElementById('eastTo').setAttribute('max', response.east);
            document.getElementById('southFrom').setAttribute('max', response.north);
            document.getElementById('southTo').setAttribute('max', response.north);

            generateGrid(response.north, response.east);
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

    for (let i = 0; i < height; i++) {
        for (let j = 0; j < width; j++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            cell.dataset.x = j;
            cell.dataset.y = i;
            gridContainer.appendChild(cell);
        }
    }
}

function highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth) {
    const cells = document.querySelectorAll('.cell');
    cells.forEach((cell, index) => {
        const row = Math.floor(index / gridWidth);
        const col = index % gridWidth;
        if (col >= eastFrom - 1 && col < eastTo && row >= southFrom - 1 && row < southTo) {
            cell.classList.add('red');
        }
    });
}



var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            let gridWidth = document.getElementById('gridWidth').value = response.width;
            let gridHeight = document.getElementById('gridHeight').value = response.hight;

            let eastFrom = document.getElementById('eastFrom').value = response.fromEast;
            let eastTo = document.getElementById('eastTo').value = response.eastTo;
            let southFrom = document.getElementById('southFrom').value = response.fromNorth;
            let southTo = document.getElementById('southTo').value = response.toNorth;


    if (isNaN(gridWidth) || isNaN(gridHeight) || gridWidth <= 0 || gridHeight <= 0) {
        alert('Please enter valid grid width and height.');
        return;
    }

    highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth);
// });




        }
    };
    xhttp.open("POST", "grid_size.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("shop_id=" + document.getElementById('choosemall').value);





</script>


</html>



































































































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
    label{
        color: white;
    }
    body {
        background-color: rgb(38, 38, 38);
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        display: flex;
        margin-bottom: 10px;
    }

    .form label,
    .inputs label {
        margin-right: 5px;
    }

    .form input,
    .inputs input {
        margin-right: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
        grid-auto-rows: 10px;
        gap: 1px;
    }

    .cell {
        background-color: white;
        border: 1px solid #ccc;
    }

    .red {
        background-color: red;
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
                            INNER JOIN floors f ON m.id = f.mall_id
                            INNER JOIN shops s ON f.id = s.floor_id
                            INNER JOIN shelves sh ON s.id = sh.shop_id
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
        <form id="inputForm" class="form">
            <label for="eastFrom">East From:</label>
            <input type="number" id="eastFrom" min="0">
            <label for="eastTo">East To:</label>
            <input type="number" id="eastTo" min="0">
            <label for="southFrom">South From:</label>
            <input type="number" id="southFrom" min="0">
            <label for="southTo">South To:</label>
            <input type="number" id="southTo" min="0">
            <button type="submit">Submit</button>

        </form>
        <div class="inputs">
            <label for="gridWidth">Grid Width:</label>
            <input type="number" id="gridWidth" value="" disabled>
            <label for="gridHeight">Grid Height:</label>
            <input type="number" id="gridHeight" value="" disabled>
        </div>
        <div id="gridContainer" class="grid-container"></div>
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
            var response = JSON.parse(this.responseText);
            document.getElementById('gridWidth').value = response.east;
            document.getElementById('gridHeight').value = response.north;

            document.getElementById('eastFrom').setAttribute('max', response.east);
            document.getElementById('eastTo').setAttribute('max', response.east);
            document.getElementById('southFrom').setAttribute('max', response.north);
            document.getElementById('southTo').setAttribute('max', response.north);

            generateGrid(response.north, response.east);
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

    for (let i = 0; i < height; i++) {
        for (let j = 0; j < width; j++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            cell.dataset.x = j;
            cell.dataset.y = i;
            gridContainer.appendChild(cell);
        }
    }
}

function highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth) {
    const cells = document.querySelectorAll('.cell');
    cells.forEach((cell, index) => {
        const row = Math.floor(index / gridWidth);
        const col = index % gridWidth;
        if (col >= eastFrom - 1 && col < eastTo && row >= southFrom - 1 && row < southTo) {
            cell.classList.add('red');
        }
    });
}





function fetchData() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            const eastFrom = response.eastFrom;
            const eastTo = response.eastTo;
            const southFrom = response.southFrom;
            const southTo = response.southTo;

            const gridWidth = response.width; // Change this to match the key in your PHP response
            const gridHeight = response.height; // Change this to match the key in your PHP response
            console.log(eastFrom+eastTo+southFrom+southTo+gridWidth+gridHeight);
            if (isNaN(gridWidth) || isNaN(gridHeight) || gridWidth <= 0 || gridHeight <= 0) {
                alert('Please enter valid grid width and height.');
                return;
            }

            highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth);

            // Call fetchData again after a certain interval
            setTimeout(fetchData, 100); // Adjust the interval as per your requirement (1000 milliseconds = 1 second)
        }
    };
    xhttp.open("POST", "grid_place.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Call fetchData initially to start the process
fetchData();








document.getElementById('inputForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const eastFrom = parseInt(document.getElementById('eastFrom').value);
    const eastTo = parseInt(document.getElementById('eastTo').value);
    const southFrom = parseInt(document.getElementById('southFrom').value);
    const southTo = parseInt(document.getElementById('southTo').value);

    const gridWidth = parseInt(document.getElementById('gridWidth').value);
    const gridHeight = parseInt(document.getElementById('gridHeight').value);

    if (isNaN(gridWidth) || isNaN(gridHeight) || gridWidth <= 0 || gridHeight <= 0) {
        alert('Please enter valid grid width and height.');
        return;
    }

    highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth);
});

</script>


</html>






















































































<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
$shop_id = $_POST['shop_id'];

try {
    $select_shops = $conn->prepare("SELECT
            s.shop_name AS name,
            s.east_in_meters AS width,
            s.north_in_meters AS height,
            sh.from_north AS southFrom,
            sh.to_north AS southTo,
            sh.from_east AS eastFrom,
            sh.to_east AS eastTo 
        FROM
            malls m
            INNER JOIN floors f ON m.id = f.mall_id
            INNER JOIN shops s ON f.id = s.floor_id
            INNER JOIN shelves sh ON s.id = sh.shop_id
            LEFT JOIN positions pos ON sh.id = pos.shelf_id 
    WHERE
        m.id = ? AND s.id = ?");
    $select_shops->execute([$mall_id, $shop_id]);
    $fetch_shops = $select_shops->fetch(PDO::FETCH_ASSOC);
    echo json_encode($fetch_shops);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}


















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
    label {
        color: white;
    }

    body {
        background-color: rgb(38, 38, 38);
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        display: flex;
        margin-bottom: 10px;
    }

    .form label,
    .inputs label {
        margin-right: 5px;
    }

    .form input,
    .inputs input {
        margin-right: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
        grid-auto-rows: 10px;
        gap: 1px;
    }

    .cell {
        background-color: white;
        border: 1px solid #ccc;
    }

    .red {
        background-color: red;
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
        <form id="inputForm" class="form">
            <label for="eastFrom">East From:</label>
            <input type="number" id="eastFrom" min="0">
            <label for="eastTo">East To:</label>
            <input type="number" id="eastTo" min="0">
            <label for="southFrom">South From:</label>
            <input type="number" id="southFrom" min="0">
            <label for="southTo">South To:</label>
            <input type="number" id="southTo" min="0">
            <button type="submit">Submit</button>

        </form>
        <div class="inputs">
            <label for="gridWidth">Grid Width:</label>
            <input type="number" id="gridWidth" value="" disabled>
            <label for="gridHeight">Grid Height:</label>
            <input type="number" id="gridHeight" value="" disabled>
        </div>
        <div id="gridContainer" class="grid-container"></div>
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
                var response = JSON.parse(this.responseText);
                document.getElementById('gridWidth').value = response.width;
                document.getElementById('gridHeight').value = response.height;

                document.getElementById('eastFrom').setAttribute('max', response.width);
                document.getElementById('eastTo').setAttribute('max', response.width);
                document.getElementById('southFrom').setAttribute('max', response.height);
                document.getElementById('southTo').setAttribute('max', response.height);

                generateGrid(response.width, response.height);

                const eastFrom = response.eastFrom;
                const eastTo = response.eastTo;
                const southFrom = response.southFrom;
                const southTo = response.southTo;

                const gridWidth = response.width;
                const gridHeight = response.height;

                highlightCells(eastFrom, eastTo, southFrom, southTo);
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
                cell.setAttribute('id', i + ',' + j);
                // cell.textContent = i + ',' + j;
                // cell.style.padding = "2px";
                // cell.dataset.x = j;
                // cell.dataset.y = i;
                gridContainer.appendChild(cell);

                if (document.getElementById("6,13")) {
                    document.getElementById("6,13").style.backgroundColor = "black";
                }
            }
        }
    }




    function highlightCells(eastFrom, eastTo, southFrom, southTo) {
    // Loop through each row and column within the specified range
    for (let i = southFrom; i <= southTo; i++) {
        for (let j = eastFrom; j <= eastTo; j++) {
            // Check if the cell exists within the grid
            const cellId = i + "," + j;
            if (document.getElementById(cellId)) {
                // Set the background color of the cell to black
                document.getElementById(cellId).style.backgroundColor = "black";
            }
        }
    }
}











    // function highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth, gridHeight) {
    //     const cells = document.querySelectorAll('.cell');
    //     cells.forEach(cell => {
    //         const [row, col] = cell.id.split(',').map(Number);
    //         if (col >= eastFrom && col < eastTo && row >= southFrom && row < southTo) {
    //             cell.classList.add('red');
    //         } else {
    //             cell.classList.remove('red');
    //         }
    //     });
    // }






    // function fetchData(value) {
    //     var xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             var response = JSON.parse(this.responseText);

    //             const eastFrom = response.eastFrom;
    //             const eastTo = response.eastTo;
    //             const southFrom = response.southFrom;
    //             const southTo = response.southTo;

    //             const gridWidth = response.width;
    //             const gridHeight = response.height;

    //             highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth,gridHeight);


    //             // Call fetchData again after a certain interval
    //             setTimeout(fetchData, 100); // Adjust the interval as per your requirement (1000 milliseconds = 1 second)
    //         }
    //     };
    //     xhttp.open("POST", "grid_size.php", true);
    //     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //     xhttp.send("shop_id=" + value);
    // }









    // document.getElementById('inputForm').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     const eastFrom = parseInt(document.getElementById('eastFrom').value);
    //     const eastTo = parseInt(document.getElementById('eastTo').value);
    //     const southFrom = parseInt(document.getElementById('southFrom').value);
    //     const southTo = parseInt(document.getElementById('southTo').value);

    //     const gridWidth = parseInt(document.getElementById('gridWidth').value);
    //     const gridHeight = parseInt(document.getElementById('gridHeight').value);

    //     if (isNaN(gridWidth) || isNaN(gridHeight) || gridWidth <= 0 || gridHeight <= 0) {
    //         alert('Please enter valid grid width and height.');
    //         return;
    //     }

    //     highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth);
    // });
</script>


</html>




























fetch('', {
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
    });

.catch(error => {
    console.error('Error:', error);
});


















































































































































<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
$shop_id = $_POST['shop_id'];

try {
    $select_shops = $conn->prepare("SELECT
            s.shop_name AS name,
            s.east_in_meters AS width,
            s.north_in_meters AS height,
            sh.from_north AS southFrom,
            sh.to_north AS southTo,
            sh.from_east AS eastFrom,
            sh.to_east AS eastTo 
        FROM
            malls m
            INNER JOIN floors f ON m.id = f.mall_id
            INNER JOIN shops s ON f.id = s.floor_id
            INNER JOIN shelves sh ON s.id = sh.shop_id
            LEFT JOIN positions pos ON sh.id = pos.shelf_id 
    WHERE
        m.id = ? AND s.id = ?");
    $select_shops->execute([$mall_id, $shop_id]);
    
    // Fetch all rows
    $fetch_shops = $select_shops->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($fetch_shops);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}























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
    label {
        color: white;
    }

    body {
        background-color: rgb(38, 38, 38);
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        display: flex;
        margin-bottom: 10px;
    }

    .form label,
    .inputs label {
        margin-right: 5px;
    }

    .form input,
    .inputs input {
        margin-right: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
        grid-auto-rows: 10px;
        gap: 1px;
    }

    .cell {
        background-color: white;
        border: 1px solid #ccc;
    }

    .red {
        background-color: red;
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
        <form id="inputForm" class="form">
            <label for="eastFrom">East From:</label>
            <input type="number" id="eastFrom" min="0">
            <label for="eastTo">East To:</label>
            <input type="number" id="eastTo" min="0">
            <label for="southFrom">South From:</label>
            <input type="number" id="southFrom" min="0">
            <label for="southTo">South To:</label>
            <input type="number" id="southTo" min="0">
            <button type="submit">Submit</button>

        </form>
        <div class="inputs">
            <label for="gridWidth">Grid Width:</label>
            <input type="number" id="gridWidth" value="" disabled>
            <label for="gridHeight">Grid Height:</label>
            <input type="number" id="gridHeight" value="" disabled>
        </div>

        <h1 style="color: white;">north ^</h1>

        <div id="gridContainer" class="grid-container"></div>
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
            
            responses.forEach(function(response) {
                // Accumulate data for each line
                gridWidth = response.width;
                gridHeight = response.height;
                
                allEastFrom.push(response.eastFrom);
                allEastTo.push(response.eastTo);
                allSouthFrom.push(response.southFrom);
                allSouthTo.push(response.southTo);
            });

            // Update HTML elements after accumulating all data
            document.getElementById('gridWidth').value = gridWidth;
            document.getElementById('gridHeight').value = gridHeight;

            document.getElementById('eastFrom').setAttribute('max', gridWidth);
            document.getElementById('eastTo').setAttribute('max', gridWidth);
            document.getElementById('southFrom').setAttribute('max', gridHeight);
            document.getElementById('southTo').setAttribute('max', gridHeight);

            generateGrid(gridWidth, gridHeight);

            allEastFrom.forEach(function(eastFrom, index) {
                // Iterate over accumulated data and perform necessary operations
                const eastTo = allEastTo[index];
                const southFrom = allSouthFrom[index];
                const southTo = allSouthTo[index];
                
                highlightCells(eastFrom, eastTo, southFrom, southTo);
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
                cell.setAttribute('id', i + ',' + j);
                // cell.textContent = i + ',' + j;
                // cell.style.padding = "2px";
                // cell.dataset.x = j;
                // cell.dataset.y = i;
                cell.style.background = "gray";
                // cell.style.width = "20px";
                // cell.style.padding = "2px";
                cell.style.border = "none";
                cell.style.margin = "none";
                cell.style.flex = "none";
                // cell.style.paddingTop = "12px";
                cell.style.padding = "12px";
                // cell.style.width = "20px";
                gridContainer.appendChild(cell);
                // if (document.getElementById("6,13")) {
                //     document.getElementById("6,13").style.paddingTop = "10px";
                // }
            }
        }
    }




    function highlightCells(eastFrom, eastTo, southFrom, southTo) {
    // Loop through each row and column within the specified range
    for (let i = southFrom; i <= southTo; i++) {
        for (let j = eastFrom; j <= eastTo; j++) {
            // Check if the cell exists within the grid
            const cellId = i + "," + j;
            if (document.getElementById(cellId)) {
                let cell = document.getElementById(cellId);
                // Set the background color of the cell to black
                cell.style.backgroundColor = "red";

            }
        }
    }
}











    // function highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth, gridHeight) {
    //     const cells = document.querySelectorAll('.cell');
    //     cells.forEach(cell => {
    //         const [row, col] = cell.id.split(',').map(Number);
    //         if (col >= eastFrom && col < eastTo && row >= southFrom && row < southTo) {
    //             cell.classList.add('red');
    //         } else {
    //             cell.classList.remove('red');
    //         }
    //     });
    // }






    // function fetchData(value) {
    //     var xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             var response = JSON.parse(this.responseText);

    //             const eastFrom = response.eastFrom;
    //             const eastTo = response.eastTo;
    //             const southFrom = response.southFrom;
    //             const southTo = response.southTo;

    //             const gridWidth = response.width;
    //             const gridHeight = response.height;

    //             highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth,gridHeight);


    //             // Call fetchData again after a certain interval
    //             setTimeout(fetchData, 100); // Adjust the interval as per your requirement (1000 milliseconds = 1 second)
    //         }
    //     };
    //     xhttp.open("POST", "grid_size.php", true);
    //     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //     xhttp.send("shop_id=" + value);
    // }









    // document.getElementById('inputForm').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     const eastFrom = parseInt(document.getElementById('eastFrom').value);
    //     const eastTo = parseInt(document.getElementById('eastTo').value);
    //     const southFrom = parseInt(document.getElementById('southFrom').value);
    //     const southTo = parseInt(document.getElementById('southTo').value);

    //     const gridWidth = parseInt(document.getElementById('gridWidth').value);
    //     const gridHeight = parseInt(document.getElementById('gridHeight').value);

    //     if (isNaN(gridWidth) || isNaN(gridHeight) || gridWidth <= 0 || gridHeight <= 0) {
    //         alert('Please enter valid grid width and height.');
    //         return;
    //     }

    //     highlightCells(eastFrom, eastTo, southFrom, southTo, gridWidth);
    // });
</script>


</html>





















































































































































//grid_size.php
<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
$shop_id = $_POST['shop_id'];

try {
    $select_shops = $conn->prepare("SELECT
            s.shop_name AS name,
            s.east_in_meters AS width,
            s.north_in_meters AS height,
            sh.id AS shid,
            sh.from_north AS southFrom,
            sh.to_north AS southTo,
            sh.from_east AS eastFrom,
            sh.to_east AS eastTo 
        FROM
            malls m
            INNER JOIN floors f ON m.id = f.mall_id
            INNER JOIN shops s ON f.id = s.floor_id
            INNER JOIN shelves sh ON s.id = sh.shop_id
    WHERE
        m.id = ? AND s.id = ?");
    $select_shops->execute([$mall_id, $shop_id]);
    
    // Fetch all rows
    $fetch_shops = $select_shops->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($fetch_shops);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}









//grid_items.php

<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
$shelf_id = $_POST['shelf_id'];

try {
    $select_shops = $conn->prepare("SELECT
    mp.product_name AS product_name,
    sh.height,
    sh.width,
    pos.z,
    pos.x,
    p.id AS id
FROM 
    shelves sh
INNER JOIN  
    positions pos ON sh.id = pos.shelf_id
LEFT JOIN 
    products p ON pos.id = p.position_id
LEFT JOIN 
    main_products mp ON p.main_product_id = mp.id
INNER JOIN  
    shops s ON sh.shop_id = s.id
INNER JOIN 
    floors f ON s.floor_id = f.id
INNER JOIN 
    malls m ON f.mall_id = m.id
WHERE
    m.id = ? AND sh.id = ?
");
    $select_shops->execute([$mall_id, $shelf_id]);
    
    // Fetch all rows
    $fetch_shops = $select_shops->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($fetch_shops);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}





































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
    .grid-container-items {
        width: 50%;
        display: grid;

        gap: 10px;
        background-color: #2196F3;
        padding: 10px;
    }

    .grid-container-items>div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 20px 0;
        font-size: 30px;
    }



    label {
        color: white;
    }

    body {
        background-color: rgb(38, 38, 38);
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        display: flex;
        margin-bottom: 10px;
    }

    .form label,
    .inputs label {
        margin-right: 5px;
    }

    .form input,
    .inputs input {
        margin-right: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
        grid-auto-rows: 10px;
        gap: 1px;
    }

    .cell {
        background-color: white;
        border: 1px solid #ccc;
    }

    .red {
        background-color: red;
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

                    // Get the product name for this position
                    const productName = getProductAtPosition(responses, x, z);

                    // If there is a product name, set it
                    if (productName) {
                        cell.textContent = productName;
                    } else {
                        cell.textContent = `Cell (${x}, ${z}): Empty`;
                    }

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
    const product = responses.find(response => response.x === x && response.z === z);
    return product ? product.product_name : null;
}




    function changeurl(id) {
        // Navigating to a new URL
        window.location.href = "quick_view.php?pid=" + id;
    }
</script>


</html>
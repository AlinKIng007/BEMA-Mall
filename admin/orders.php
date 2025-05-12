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
    <style>
        table {
            width: 30%;
            min-width: 700px;
            max-width: 701px;
        }

        .order-owner {
            display: flex;
            align-items: center;
            text-transform: capitalize;
            font-weight: 500;
        }

        .order-owner img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 15px;
        }

        table thead tr {
            text-align: left;
        }

        table th,
        table td {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .order-status {
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: 500;
        }

        .order-processing {
            color: #2a59d1;
            background-color: rgba(62, 121, 247, 0.1);
        }

        .order-delivering {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
        }

        .order-completed {
            color: #4caf50;
            background-color: rgba(76, 175, 80, 0.1);
        }

        .order-refused {
            color: #e91e63;
            background-color: rgba(233, 30, 99, 0.1);
        }

        .order-failed {
            color: #f44336;
            background-color: rgba(244, 67, 54, 0.1);
        }

        .overflow-scroll {
            overflow-y: auto;
        }

        .overlay {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
        }

        .overlay.active {
            display: block;
        }

        .table-header {
            font-weight: bold;
            text-align: center;
        }

        #orders-table-body tr td {
            text-align: center;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        include 'aside.php';
        ?>

        <!-- Main Content -->
        <main>
            <h1>Orders</h1>
            <input type="text" id="searchInput" class="search-input" placeholder="Search by name" onkeyup="searchOrders(this.value)">

            <!-- ORDERS TABLE -->
            <div class="box">
                <div class="box-body overflow-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th class="table-header">ID</th>
                                <th class="table-header">Customer</th>
                                <th class="table-header">Amount</th>
                                <th class="table-header">Date</th>
                                <th class="table-header">Product name</th>
                                <th class="table-header">Mall name</th>
                                <th class="table-header">Order status</th>
                                <th class="table-header">Payment method</th>
                                <th class="table-header">Total</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table-body">
                            <!-- Table rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                <!-- Pagination links will be dynamically added here -->
            </div>
            <!-- END ORDERS TABLE -->
        </main>
        <!-- End of Main Content -->

        <?php include 'right_section.php'; ?>
    </div>


    <script src="index.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            navigateToPage(1); // Load the first page initially
        });

        // Function to fetch orders data for a specific page
        async function fetchOrdersData(pageNumber, pageSize) {
            try {
                const response = await fetch(`orders_get.php?page=${pageNumber}&size=${pageSize}`, {
                    method: 'GET',
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const orders = await response.json();
                return orders;
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
                return [];
            }
        }

        // Function to generate table rows for orders data
        function generateTableRows(orders) {
            let rows = '';
            orders.forEach(order => {
                rows += `
            <tr>
                <td>${order.id}</td>
                <td>${order.username}</td>
                <td>${order.amount}</td>
                <td>${order.time_of_purchase}</td>
                <td>${order.product_name}</td>
                <td>${order.mall_name}</td>
                <td>${order.type}</td>
                <td>${order.method_name}</td>
                <td>$${order.price * order.amount}</td>
            </tr>
        `;
            });
            return rows;
        }

        // Function to navigate to a specific page
        async function navigateToPage(pageNumber) {
            const pageSize = 10; // Number of orders per page
            const tbody = document.getElementById('orders-table-body');
            const pagination = document.querySelector('.pagination');

            const orders = await fetchOrdersData(pageNumber, pageSize);
            tbody.innerHTML = generateTableRows(orders);

            // Assuming totalOrders is the total number of orders available
            const totalPages = Math.ceil(totalOrders / pageSize);
            pagination.innerHTML = generatePaginationLinks(totalPages, pageNumber);

            // Add event listeners to pagination links
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const pageNumber = parseInt(event.target.textContent);
                    navigateToPage(pageNumber);
                });
            });
        }

        // Function to generate pagination links
        function generatePaginationLinks(totalPages, currentPage) {
            let paginationLinks = '';
            for (let i = 1; i <= totalPages; i++) {
                paginationLinks += `<a href="#" class="${i === currentPage ? 'active' : ''}" onclick="navigateToPage(${i})">${i}</a>`;
            }
            return paginationLinks;
        }
    </script>
    <script>
        function searchOrders(order_id) {
            // Check if the order_id is not empty and is a valid integer
            if (order_id.trim() !== '' && Number.isInteger(Number(order_id))) {
                // Send a POST request to 'orders_search.php' with the search criteria
                fetch('orders_search.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json', // Use JSON content type
                        },
                        body: JSON.stringify({
                            order_id: order_id // Corrected the syntax error here
                        }) // Send the table name to PHP
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(orders => {
                        console.log(orders);
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            } else {
                console.error('Invalid or missing order ID.');
            }
        }
    </script>

</body>

</html>

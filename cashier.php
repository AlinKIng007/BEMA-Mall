<?php
require 'components/connect.php';
session_start();
require 'components/prevention.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the AJAX request
    $postData = json_decode(file_get_contents("php://input"), true);
    $pid = $postData["pid"];
    $quantity = $postData["quantity"];
    $coupon_id = $postData["coupon_id"];
    echo $coupon_id;
    $emp_id = $_SESSION["emp_id"];

    try {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO orders (employee_id, product_id, amount,coupon_id) VALUES (?, ?, ?,?)");
    
        // Execute the prepared statement
        $stmt->execute([$emp_id, $pid, $quantity,$coupon_id]);

        // Return success response
        echo json_encode(["success" => true, "message" => "Transaction inserted successfully."]);
    } catch(PDOException $e) {
        // Return error response
        echo json_encode(["success" => false, "message" => "Error inserting transaction: " . $e->getMessage()]);
    }
}
?>



<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام الكاشير</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header,
        .footer {
            background-color: #003366;
            /* Dark blue */
            color: white;
            padding: 10px 0;
        }

        .btn-custom {
            background-color: #ffcc00;
            /* Yellow */
            color: black;
            margin: 2px;
        }

        .btn-custom:hover {
            background-color: #e6b800;
            /* Darker yellow */
        }

        .sidebar {
            background-color: #e9ecef;
            /* Light gray background */
            padding: 10px;
            border-radius: 5px;
        }

        .form-control {
            direction: ltr;
            /* For numeric inputs */
        }

        .table th,
        .table td {
            text-align: center;
            /* Center table headers and cells */
        }

        .input-group-text {
            background-color: #007bff;
            /* Bootstrap primary blue */
            color: white;
        }

        .input-group-prepend .btn {
            border-color: #007bff;
        }

        .input-group .form-control {
            border-color: #007bff;
        }

        .btn-blue {
            background-color: #007bff;
            /* Bootstrap primary blue */
            color: white;
        }

        .btn-red {
            background-color: #dc3545;
            /* Bootstrap danger red */
            color: white;
        }

        .btn-green {
            background-color: #28a745;
            /* Bootstrap success green */
            color: white;
        }

        .btn-gray {
            background-color: #6c757d;
            /* Bootstrap secondary gray */
            color: white;
        }

        .receipt-area {
            background-color: white;
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 15px;
        }

        /* Enable overflow */
        .overflow-scroll {
            max-height: 300px;
            /* Limit height of list */
            overflow-y: auto;
            /* Enable vertical scroll if content exceeds height */
        }

        .pagination {
            margin-top: 20px;
        }

        /* calculator design */
        @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');

        .calculator {
            padding: 10px;
            border-radius: 1em;
            height: 70%;
            width: 90%;
            margin: auto;
            background-color: gray;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }

        .display-box {
            font-family: 'Orbitron', sans-serif;
            background-color: #dcdbe1;
            border: solid black 0.5px;
            color: black;
            border-radius: 5px;
            width: 100%;
            height: 65%;
        }

        #btn {
            background-color: red;
        }

        input[type=button] {
            font-family: 'Orbitron', sans-serif;
            background-color: blue;
            color: white;
            border: solid black 0.5px;
            width: 100%;
            border-radius: 5px;
            height: 70%;
            outline: none;
        }

        input:active[type=button] {
            background: #e5e5e5;
            -webkit-box-shadow: inset 0px 0px 5px #c1c1c1;
            -moz-box-shadow: inset 0px 0px 5px #c1c1c1;
            box-shadow: inset 0px 0px 5px #c1c1c1;
        }
    </style>
</head>

<body dir="rtl">
    <div class="header text-center">
        <button type="button" class="btn btn-custom" onclick="refreshPage()">تحديث الصفحة</button>
        <button type="button" class="btn btn-custom">أزرار أخرى</button>
        <label style="float: left; margin: 10px; font-weight: lighter;">Employee Name: <?= $_SESSION['username'] ?></label>
        <button type="button" class="btn btn-danger float-right" onclick="closeApp()">إغلاق</button>
    </div>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">الكود</th>
                            <th scope="col">المنتج</th>
                            <th scope="col">نوع</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">السعر</th>
                        </tr>
                    </thead>
                    <tbody id="product-list" class="overflow-scroll">
                        <!-- Product rows will be inserted here -->
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center" id="pagination"></ul>
                </nav>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">اجمالي المواد</span>
                            </div>
                            <input type="text" class="form-control" id="total-materials" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">المبلغ الجمالي</span>
                            </div>
                            <input type="text" class="form-control" id="total-amount" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">الخصم%</span>
                            </div>
                            <input type="text" class="form-control" id="discount" onkeyup="coupon(this.value)">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">الصافي</span>
                            </div>
                            <input type="text" class="form-control" id="net-amount" disabled>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="button" class="btn btn-blue" onclick="saveTransaction()">حفظ</button>
                        <button type="button" class="btn btn-gray" onclick="resetTransaction()">فاتورة جديدة</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    <input type="text" class="form-control mb-2" id="search-input" oninput="productSearch(this.value)" placeholder="ابحث عن المنتج">

                    <!-- Product database list will be inserted here -->
                </div>
                <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#calculatorModal">الحاسبة</button>
                <!-- Calculator Modal -->
                <div class="modal fade" id="calculatorModal" tabindex="-1" role="dialog" aria-labelledby="calculatorModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="calculatorModalLabel">الحاسبة</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="calculator">
                                    <input class="form-control display-box" type="text" id="result" disabled />
                                    <table style="width:100%;">
                                        <tr>
                                            <td><input type="button" value="1" onclick="display('1')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="2" onclick="display('2')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="3" onclick="display('3')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="/" onclick="display('/')" class="btn btn-warning btn-block" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="button" value="4" onclick="display('4')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="5" onclick="display('5')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="6" onclick="display('6')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="-" onclick="display('-')" class="btn btn-warning btn-block" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="button" value="7" onclick="display('7')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="8" onclick="display('8')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="9" onclick="display('9')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="+" onclick="display('+')" class="btn btn-warning btn-block" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="button" value="." onclick="display('.')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="0" onclick="display('0')" class="btn btn-primary btn-block" /></td>
                                            <td><input type="button" value="C" onclick="clearScreen()" class="btn btn-danger btn-block" /></td>
                                            <td><input type="button" value="=" onclick="calculate()" class="btn btn-success btn-block" /></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- You can add a footer with additional buttons or information if needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <input type="text" hidden id="coupon_id">

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="receipt-area" id="receipt-content">
                </div>
            </div>
        </div>
    </div>

    <div class="footer text-center">
        <button type="button" class="btn btn-custom" onclick="printReceipt()">طباعة الفاتورة</button>
    </div>

    <script>
        let products = [];
        let discountCodes = [];

        // Define an object to store transaction details
        let transaction = {
            products: [], // Array to store added products
            totalMaterials: 0, // Total number of materials
            totalAmount: 0, // Total amount without discount
            discount: 0, // Discount amount
            netAmount: 0 // Net amount after discount
        };


        // Get HTML elements needed for rendering products and pagination
        const productList = document.getElementById('product-list');
        const searchInput = document.getElementById('search-input');
        const pagination = document.getElementById('pagination');
        const productsPerPage = 10; // Number of products to display per page
        let currentPage = 1; // Current page number



        // Function to render pagination links
        function renderPagination() {
            // Calculate total pages based on number of products and products per page
            const totalPages = Math.ceil(products.length / productsPerPage);

            // Clear existing pagination
            pagination.innerHTML = '';

            // Calculate start and end page numbers for the pagination links
            let startPage, endPage;
            if (totalPages <= 5) {
                startPage = 1;
                endPage = totalPages;
            } else {
                if (currentPage <= 3) {
                    startPage = 1;
                    endPage = 5;
                } else if (currentPage + 2 >= totalPages) {
                    startPage = totalPages - 4;
                    endPage = totalPages;
                } else {
                    startPage = currentPage - 2;
                    endPage = currentPage + 2;
                }
            }

            // Previous arrow
            pagination.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    `;

            // Pagination links
            for (let i = startPage; i <= endPage; i++) {
                pagination.innerHTML += `
            <li class="page-item ${currentPage === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `;
            }

            // Next arrow
            pagination.innerHTML += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    `;
        }


        // Function to change current page
        function changePage(page) {
            currentPage = page;
            renderProductList(currentPage);
            renderPagination();
        }

        // Initial rendering of product list and pagination
        renderProductList(currentPage);
        renderPagination();

        // Function to add a product to the transaction
        function addProduct(id, name, price, maxAmount) {
    try {
        let existingProduct = transaction.products.find(product => product.id === id);
        let amountInput = document.getElementById("amount_" + id);
        let amount = 1; // Default amount to 1

        if (amountInput && amountInput.value.trim() !== '') {
            let inputAmount = parseInt(amountInput.value.trim());
            if (inputAmount <= maxAmount) {
                amount = inputAmount;
            } else {
                // Display an error message or take appropriate action
                console.error('Amount exceeds maximum amount');
                return;
            }
        }

        if (existingProduct) {
            // Calculate the new quantity after adding more
            let newQuantity = existingProduct.quantity + amount;
            if (newQuantity > maxAmount) {
                // Display an error message or take appropriate action
                console.error('Total quantity exceeds maximum amount');
                return;
            }

            // Update product quantity and total
            existingProduct.quantity = newQuantity;
            existingProduct.productTotal = existingProduct.quantity * existingProduct.price;
        } else {
            // Create new product entry
            const quantity = amount;
            const productTotal = price * quantity;
            if (isNaN(productTotal)) {
                throw new Error('Product total is NaN');
            }
            const product = {
                id,
                name,
                price,
                quantity,
                productTotal
            };
            transaction.products.push(product);
        }
        // Update transaction details including discount
        updateTransaction();
        updateReceipt();
    } catch (error) {
        console.error('Error adding product:', error);
    }
}


        function updateTransaction() {
            try {
                // Calculate total materials
                transaction.totalMaterials = transaction.products.reduce((total, product) => total + product.quantity, 0);

                // Calculate total amount
                transaction.totalAmount = transaction.products.reduce((total, product) => {
                    return total + product.productTotal;
                }, 0);

                // Calculate net amount after discount
                transaction.netAmount = transaction.totalAmount - transaction.discount;
            } catch (error) {
                console.error('Error updating transaction:', error);
            }
        }

        // Flag to track if updateTotals function has already been executed
        let isUpdateTotalsExecuted = false;

        // Function to update totals including discount
        function updateTotals(discount) {
            // Check if updateTotals has already been executed
            if (!isUpdateTotalsExecuted) {
                // Apply the discount percentage to calculate the discount amount
                let discountAmount = transaction.netAmount * (discount / 100);

                // Subtract the discount amount from the net amount to get the discounted net amount
                transaction.netAmount -= discountAmount;
                transaction.discount = discount;

                // Store the discount amount in the transaction object (optional, for reference)
                transaction.discountAmount = discountAmount;

                

                // Update the flag to indicate that updateTotals has been executed
                isUpdateTotalsExecuted = true;

                // Update receipt with new totals
                updateReceipt();
            }
        }




        // Function to fetch products from the PHP script
        function fetchProducts(page) {
            return fetch(`cashier_products.php?page=${page}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Read response as JSON
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    throw error; // Propagate the error to the caller
                });
        }

        // Function to render the product list
        function renderProductList(page) {
            fetchProducts(page)
                .then(products => {
                    displayProducts(products);
                })
                .catch(error => {
                    console.error('Error rendering product list:', error);
                    // Handle the error or display a message to the user
                });
        }

        // Function to display products in the product list
        function displayProducts(products) {
            const productList = document.getElementById('product-list');
            productList.innerHTML = ''; // Clear the previous product list

            products.forEach(product => {
                // Display each product in the product list
                productList.innerHTML += `
            <tr>
                <td>${product.id}</td>
                <td>${product.product_name}</td> 
                <td>${product.category_name}</td>
                <td>${product.amount}</td>
                <td>${product.price}</td>
                <td>
                    <button type="submit" class="btn btn-custom" onclick="addProduct('${product.id}', '${product.product_name}', ${product.price}, ${product.amount})">إضافة</button>
                    <input id="amount_${product.id}" style="width:100px;" type="number" min="1" value="1" max="${product.amount}">
                    </td>
            </tr>
        `;
            });
        }

        // Call renderProductList function when the page loads to render the initial product list
        window.onload = function() {
            renderProductList(1); // Render the first page of products when the page loads
        };


        // Function to reset transaction details
        function resetTransaction() {
            // Reset transaction object to initial values
            transaction = {
                products: [],
                totalMaterials: 0,
                totalAmount: 0,
                discount: 0,
                netAmount: 0
            };
            // Update receipt with reset values
            updateReceipt();
        }


        // Function to update receipt with current transaction details
        function updateReceipt() {
            // Your existing code to update the receipt with the new transaction details
            const receiptContent = document.getElementById('receipt-content');
            receiptContent.innerHTML = '<p><strong>محتوى الفاتورة:</strong></p>';
            transaction.products.forEach(product => {
                receiptContent.innerHTML += `<p>${product.name}: x${product.quantity} = ${product.productTotal}</p>`;
            });
            receiptContent.innerHTML += `<p><strong>اجمالي المواد:</strong> ${transaction.totalMaterials}</p>`;
            receiptContent.innerHTML += `<p><strong>اجمالي المبلغ:</strong> ${transaction.totalAmount}</p>`;
            receiptContent.innerHTML += `<p><strong>خصم:</strong> ${transaction.discount}</p>`;
            receiptContent.innerHTML += `<p><strong>الصافي:</strong> ${transaction.netAmount}</p>`;
        }

        // function filterProducts() {
        //     const searchInput = document.getElementById('search-input');
        //     const query = searchInput.value.trim().toLowerCase(); // Get the search query

        //     // Filter products based on the search query
        //     const filteredProducts = products.filter(product => {
        //         return product.name.toLowerCase().includes(query);
        //     });

        //     // Render the filtered product list
        //     renderProductList(currentPage, filteredProducts);
        //     renderPagination();
        // }

        // // Add an event listener to the search input field
        // document.getElementById('search-input').addEventListener('input', filterProducts);

        function coupon(userCoupon) {
            // Make AJAX request to fetch coupons
            fetch('cashier_coupon.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(coupons => {
                    // Check if response is valid JSON
                    if (!Array.isArray(coupons)) {
                        throw new Error('Invalid JSON format');
                    }

                    // Iterate over the coupons array and display each coupon
                    coupons.forEach(coupon => {
                        if (coupon.code === userCoupon) {
                            document.getElementById("coupon_id").value = coupon.coupn_id;
                            document.getElementById("discount").value = null;
                            updateTotals(coupon.discount);
                        }
                    });
                })
                .catch(error => {
                    // Log the error message
                    console.error('Error:', error.message);
                });
        }

        function productSearch(barcode) {
            // Construct the URL for the AJAX request
            const url = 'cashier_barcode.php';

            // Create a FormData object to send data to the server
            const formData = new FormData();
            formData.append('barcode', barcode);

            // Configure the fetch request
            const fetchOptions = {
                method: 'POST',
                body: formData
            };

            // Make the AJAX request
            fetch(url, fetchOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(products => {
                    // Handle the response from the server
                    if (!Array.isArray(products)) {
                        throw new Error('Invalid response: Products data is not an array');
                    }
                    products.forEach(product => {
                        // Extract product details
                        const {
                            id,
                            product_name,
                            price,
                            amount
                        } = product;
                        // Add the product
                        addProduct(id, product_name, price, amount);
                        document.getElementById("search-input").value = null;
                    });
                    // You can process the products returned from the server here
                })
                .catch(error => {
                    // Handle any errors that occur during the request or processing
                    console.error('Error fetching or processing products:', error);
                });
        }

        function printReceipt() {
            const printContent = document.getElementById('receipt-content').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
        
        function saveTransaction() {
    // Loop through each product in the transaction
    transaction.products.forEach(product => {
        // Create data object with product details
        const data = {
            pid: product.id,
            quantity: product.quantity,
            coupon_id: document.getElementById("coupon_id").value
        };

        // Send AJAX request to the cashier_insert.php file
        fetch('cashier_insert.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle success response from server
            if (data.success) {
                console.log('Transaction inserted successfully:', data.message);
                // Optionally, perform any other actions here
            } else {
                console.error('Error inserting transaction:', data.message);
                // Optionally, display an error message to the user
            }
        })
        .catch(error => {
            // Handle error
            console.error('Error:', error);
            // Optionally, display an error message to the user
        });
    });

    // After processing all products, reset the transaction
    resetTransaction();
}





    </script>

</body>

</html>
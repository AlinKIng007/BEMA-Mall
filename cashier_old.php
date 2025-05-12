<?php
require 'components/connect.php';
session_start();
require 'components/prevention.php';

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

        .sidebar .btn {
            width: 100%;
            margin-bottom: 5px;
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
        <button type="button" class="btn btn-danger" onclick="closeApp()" style="float: right; margin: 5px;">إغلاق</button>
    </div>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">المنتج</th>
                            <th scope="col">النوعية</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">السعر</th>
                            <th scope="col">الإجمالي</th>
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
                        <button type="button" class="btn btn-gray" onclick="openNewTab()">فاتورة جديدة</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    <input type="text" class="form-control mb-2" id="search-input" placeholder="ابحث عن المنتج">
                    <!-- Product database list will be inserted here -->
                </div>
                <table class="calculator">
                    <tr>
                        <td colspan="3"> <input class="display-box" type="text" id="result" disabled /> </td>

                        <!-- clearScreen() function clears all the values -->
                        <td> <input type="button" value="C" onclick="clearScreen()" id="btn" /> </td>
                    </tr>
                    <tr>
                        <!-- display() function displays the value of clicked button -->
                        <td> <input type="button" value="1" onclick="display('1')" /> </td>
                        <td> <input type="button" value="2" onclick="display('2')" /> </td>
                        <td> <input type="button" value="3" onclick="display('3')" /> </td>
                        <td> <input type="button" value="/" onclick="display('/')" /> </td>
                    </tr>
                    <tr>
                        <td> <input type="button" value="4" onclick="display('4')" /> </td>
                        <td> <input type="button" value="5" onclick="display('5')" /> </td>
                        <td> <input type="button" value="6" onclick="display('6')" /> </td>
                        <td> <input type="button" value="-" onclick="display('-')" /> </td>
                    </tr>
                    <tr>
                        <td> <input type="button" value="7" onclick="display('7')" /> </td>
                        <td> <input type="button" value="8" onclick="display('8')" /> </td>
                        <td> <input type="button" value="9" onclick="display('9')" /> </td>
                        <td> <input type="button" value="+" onclick="display('+')" /> </td>
                    </tr>
                    <tr>
                        <td> <input type="button" value="." onclick="display('.')" /> </td>
                        <td> <input type="button" value="0" onclick="display('0')" /> </td>

                        <!-- calculate() function evaluates the mathematical expression -->
                        <td> <input type="button" value="=" onclick="calculate()" id="btn" /> </td>
                        <td> <input type="button" value="*" onclick="display('*')" /> </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

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
const searchInput = document.getElementById('search-input');
// Define the transaction object globally
let transaction = {
    products: [],
    totalMaterials: 0,
    totalAmount: 0,
    discount: 0,
    netAmount: 0
};

// Your other JavaScript code...

        window.onload = function() {
            renderProductList(1); // Render the first page of products when the page loads
        };

        const productsPerPage = 10; // Number of products per page
        let currentPage = 1; // Current page number

        function fetchProducts(page) {
    return fetch(`cashier_products.php?page=${page}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Read response as text
        })
        .then(data => {
            try {
                return JSON.parse(data); // Try parsing the data as JSON
            } catch (error) {
                throw new Error('Error parsing JSON data');
            }
        })
        .then(parsedData => {
            if (!parsedData || !Array.isArray(parsedData)) {
                throw new Error('Invalid response data format');
            }
            return parsedData;
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            throw error; // Propagate the error to the caller
        });
}


        function renderProductList(page) {
            fetchProducts(page)
    .then(products => {
        const totalPages = Math.ceil(products.length / productsPerPage);
        renderPagination(totalPages);
        displayProducts(products);
    })
    .catch(error => {
        console.error('Error rendering product list:', error);
        // Handle the error or display a message to the user
    });

        }






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
                    <button class="btn btn-custom" onclick="addProduct('${product.id}','${product.product_name}', ${product.price}, ${product.amount})">إضافة</button>
                    <input id="amount_${product.id}" style="width:30px;" type="number" min="1" max="${product.amount}">
                </td>
            </tr>
        `;
    });
}



        function addProduct(id, name, price, maxAmount) {
            // Your addProduct function logic
        
            let existingProduct = transaction.products.find(product => product.id === id);
            let amountInput = document.getElementById("amount_" + id);
            let amount = 1; // Default amount to 1

            // Check if amount input field exists and has a value
            if (amountInput && amountInput.value.trim() !== '') {
                amount = parseInt(amountInput.value.trim());
            }

            if (existingProduct) {
                // Check if existing product quantity is less than maxAmount
                if (existingProduct.quantity < maxAmount) {
                    existingProduct.quantity += amount; // Set quantity to the amount
                    existingProduct.productTotal = existingProduct.quantity * existingProduct.price;
                } else {
                    // Do nothing if the quantity equals maxAmount
                    return;
                }
            } else {
                const quantity = amount; // Set quantity to the amount
                const productTotal = price * quantity;
                const product = {
                    id,
                    name,
                    price,
                    quantity,
                    productTotal
                };
                transaction.products.push(product);
            }
            updateTransaction();
            updateReceipt();
        }


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
                        if(coupon.code === userCoupon){
                            // existingProduct.productTotal = 1;
                            console.log(coupon.code);
                            console.log(coupon.dis);

                        }
                        
                    });
                })
                .catch(error => {
                    // Log the response text if it's not valid JSON
                    console.error('Response is not valid JSON. Response Text:', error.response.text());
                });
        }

        function updateTotals() {
            const discountInput = document.getElementById('discount');
            const discount = parseFloat(discountInput.value) || 0;
            transaction.discount = discount;
            transaction.netAmount = transaction.totalAmount - (discount / 100) * transaction.totalAmount;
            updateReceipt();
        }




        function updateTransaction() {
            transaction.totalMaterials = transaction.products.reduce((total, product) => total + product.quantity, 0);
            transaction.totalAmount = transaction.products.reduce((total, product) => total + product.productTotal, 0);
            transaction.netAmount = transaction.totalAmount - transaction.discount;
        }

        

        function resetTransaction() {
            transaction = {
                products: [],
                totalMaterials: 0,
                totalAmount: 0,
                discount: 0,
                netAmount: 0
            };
            updateReceipt();
        }

        function openNewTab() {
            window.open(window.location.href);
        }

        function updateReceipt() {
            const totalMaterialsInput = document.getElementById('total-materials');
            const totalAmountInput = document.getElementById('total-amount');
            const netAmountInput = document.getElementById('net-amount');

            totalMaterialsInput.value = transaction.totalMaterials;
            totalAmountInput.value = transaction.totalAmount;
            netAmountInput.value = transaction.netAmount;

            const receiptContent = document.getElementById('receipt-content');
            receiptContent.innerHTML = '<p><strong>محتوى الفاتورة:</strong></p>';
            transaction.products.forEach(product => {
                receiptContent.innerHTML += `<p>${product.name}: x${product.quantity} = ${product.productTotal}</p>`;
            });
            receiptContent.innerHTML += `<p><strong>اجمالي المواد:</strong> ${transaction.totalMaterials}</p>`;
            receiptContent.innerHTML += `<p><strong>المبلغ الجمالي:</strong> ${transaction.totalAmount}</p>`;
            receiptContent.innerHTML += `<p><strong>الخصم%:</strong> ${transaction.discount}</p>`;
            receiptContent.innerHTML += `<p><strong>الصافي:</strong> ${transaction.netAmount}</p>`;
        }

        function printReceipt() {
            const printContent = document.getElementById('receipt-content').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
        let productList = document.getElementById('product-list');
        searchInput.addEventListener('input', function() {
    const query = this.value.trim().toLowerCase();

    // Filter products based on the search query
    const filteredProducts = products.filter(product => {
        return product.product_name.toLowerCase().includes(query);
    });

    // Update the product list with filtered products
    productList.innerHTML = ''; // Clear the existing product list
    currentPage = 1; // Reset to the first page when searching


// Define the renderPagination function
function renderPagination(totalPages) {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = ''; // Clear existing pagination buttons

    // Create pagination buttons for each page
    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('li');
        button.classList.add('page-item');
        button.innerHTML = `<button class="page-link" onclick="renderProductList(${i})">${i}</button>`;
        paginationContainer.appendChild(button);
    }
}

// Define the renderProductList function
function renderProductList(page) {
    // Your logic for rendering product list goes here
}

// Now you can call the renderPagination function
renderPagination(5); // Call the function with the number of total pages



    // Display the filtered products
    filteredProducts.forEach(product => {
        productList.innerHTML += `
            <tr>
                <td>${product.name}</td>
                <td>1</td>
                <td>${product.price}</td>
                <td><button class="btn btn-custom" onclick="addProduct('${product.name}', ${product.price})">إضافة</button></td>
            </tr>
        `;
    });
});

        
    </script>

    <script>
        function closeApp() {
            window.close();
        }
    </script>
    <script>
        function refreshPage() {
            location.reload();
        }

        function closeApp() {
            window.close();
        }
    </script>\
    <!-- calculator js -->
    <script>
        // This function clears all the values
        function clearScreen() {
            document.getElementById("result").value = "";
        }

        // This function displays the values
        function display(value) {
            document.getElementById("result").value += value;
        }

        // This function evaluates the expression and returns the result
        function calculate() {
            var p = document.getElementById("result").value;
            var q = eval(p);
            document.getElementById("result").value = q;
        }
    </script>
</body>

</html>
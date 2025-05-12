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
            <h1>Sales Page</h1>

            <!-- PRODUCTS TABLE -->
            <div class="box">
                <div class="box-body overflow-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Offer (%)</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-table-body">
                            <!-- Table rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                <!-- Pagination links will be dynamically added here -->
            </div>
            <!-- END PRODUCTS TABLE -->
        </main>
        <!-- End of Main Content -->

        <?php 
include 'right_section.php';
 ?>

        </div>


    </div>


    <script src="index.js"></script>
    <script>
        // Function to fetch products data from the backend
        async function fetchProductsData(pageNumber, pageSize) {
            try {
                const response = await fetch(`your_backend_url/products?page=${pageNumber}&size=${pageSize}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching data:', error.message);
                return [];
            }
        }

        // Function to generate table rows based on products data
        function generateTableRows(products) {
            return products.map(product => `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td>${product.offer}</td>
                    <td><img src="${product.photo}" alt="${product.name}" width="50"></td>
                    <td>
                        <button onclick="editProduct(${product.id})">Edit</button>
                        <button onclick="deleteProduct(${product.id})">Delete</button>
                    </td>
                </tr>
            `).join('');
        }

        // Function to generate pagination links
        function generatePaginationLinks(totalPages, currentPage) {
            let paginationLinks = '';
            for (let i = 1; i <= totalPages; i++) {
                paginationLinks += `<a href="#" class="${i === currentPage ? 'active' : ''}" onclick="navigateToPage(${i})">${i}</a>`;
            }
            return paginationLinks;
        }

        // Function to navigate to a specific page
        async function navigateToPage(pageNumber) {
            const pageSize = 10; // Number of products per page
            const tbody = document.getElementById('products-table-body');
            const pagination = document.querySelector('.pagination');

            const products = await fetchProductsData(pageNumber, pageSize);
            tbody.innerHTML = generateTableRows(products);

            pagination.innerHTML = generatePaginationLinks(5, pageNumber); // Assuming 5 total pages
        }

        // Function to handle editing a product
        function editProduct(productId) {
            // Implement logic to show edit modal and populate with product data
            console.log('Editing product with ID:', productId);
        }

        // Function to handle deleting a product
        function deleteProduct(productId) {
            // Implement logic to delete product
            console.log('Deleting product with ID:', productId);
        }

        // Initial page load
        navigateToPage(1);
    </script>
    
</body>

</html>

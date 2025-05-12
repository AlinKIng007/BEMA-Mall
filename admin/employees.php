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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <title>bema Employees</title>
    <style>

    </style>
</head>

<body>

    <div class="container">
    <?php 
include 'aside.php';
?>

        <!-- Main Content -->
        <main>
          
            <h2>Employee Management</h2>
     <!-- Search Bar -->
<div class="search-container">
    <input type="text" id="searchInput" class="search-input" placeholder="Search by name">
</div>

        
<table id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Department Name</th>
                        <th>Allowance</th>
                        <th>Title</th>
                        <th>Mall Name</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data, you can replace it with dynamic data -->
                </tbody>
            </table>
            <div class="pagination" id="pagination"></div>
            <br>

        </main>
        <!-- End of Main Content -->

        <?php 
include 'right_section.php';
 ?>



        </div>

    </div>


<!-- Your HTML code here -->

<!-- Your HTML code here -->

<script>
    document.addEventListener('DOMContentLoaded', function () {

        var pagination = document.getElementById('pagination');
        var searchInput = document.getElementById("searchInput");

        function displayUsers(page) {
            var perPage = 5; // Number of users per page
            var startIndex = (page - 1) * perPage;

            // Make AJAX request to fetch user data using Fetch API
            fetch('employees_get.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(users => {
                var endIndex = Math.min(startIndex + perPage, users.length);
                var totalPages = Math.ceil(users.length / perPage);
                var tbody = document.querySelector('#userTable tbody');
                tbody.innerHTML = ''; // Clear previous content

                for (var i = startIndex; i < endIndex; i++) {
                    var user = users[i];
                    var row = tbody.insertRow();
                    row.innerHTML = `<td>${user.id}</td><td>${user.username}</td><td>${user.email}</td><td>${user.department_name}</td><td>${user.allowance}</td><td>${user.title}</td><td>${user.mall_name}</td>`;
                }

                generatePaginationLinks(page, totalPages);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }

        function generatePaginationLinks(currentPage, totalPages) {
            pagination.innerHTML = '';
            for (var i = 1; i <= totalPages; i++) {
                var link = document.createElement('a');
                link.href = '#';
                link.textContent = i;
                link.classList.toggle('active', i === currentPage);
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    var page = parseInt(event.target.textContent);
                    displayUsers(page);
                });
                pagination.appendChild(link);
            }
        }

        displayUsers(1);

        searchInput.addEventListener('input', function() {
            var searchTerm = searchInput.value.toLowerCase();
            var rows = document.querySelectorAll("#userTable tbody tr");

            rows.forEach(function(row) {
                var name = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>

<!-- Your remaining script tags and closing body/html tags here -->


<!-- Your remaining script tags and closing body/html tags here -->







    <script src="index.js"></script>
</body>

</html>

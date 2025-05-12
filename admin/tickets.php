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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        main {
            padding: 20px;
        }

        .ticket-list {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #000;
        }

        .pagination a.active {
            background-color: #333;
            color: #fff;
        }

        .pagination a:hover {
            background-color: #ddd;
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
            <section class="ticket-list">
                <h1>Support Tickets</h1>
                <!-- Search Bar -->
                <div class="search-container">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search by name">
                </div>
                <table id="ticketTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>time of Submission</th>
                            <th>Username</th>
                            
                        </tr>
                    </thead>
                    <tbody id="ticketList">
                        <!-- Ticket items will be dynamically added here -->
                    </tbody>
                </table>
                <div class="pagination" id="pagination"></div>
            </section>
        </main>
        <!-- End of Main Content -->

        <?php 
include 'right_section.php';
 ?>




        </div>


    </div>

    <script src="../js/admin_style.css"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchTickets();
    });

    function fetchTickets() {
        fetch('tickets_get.php', {
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
        .then(tickets => {
            displayTickets(tickets);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

    function displayTickets(tickets) {
        var ticketList = document.getElementById('ticketList');
        ticketList.innerHTML = ''; // Clear the existing list

        tickets.forEach(function(ticket) {
            var ticketRow = document.createElement('tr');
            ticketRow.innerHTML = `
                <td>${ticket.id}</td>
                <td>${ticket.title}</td>
                <td>${ticket.subject}</td>
                <td>${ticket.time}</td>
                <td>${ticket.username}</td>
            `;
            ticketList.appendChild(ticketRow);
        });
    }
</script>


</body>

</html>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    #open-home {
        cursor: pointer;
    }
</style>
<!-- Sidebar Section -->
<aside>
    <div class="toggle">
        <div class="logo">
            <img src="../images/pic-1.png">
            <h2 id="open-home" onclick="openhome();">Bema<span class="mall-span">mall</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">
                close
            </span>
        </div>
    </div>

    <div class="sidebar">
        <a href="dashboard.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                dashboard
            </span>
            <h3>Dashboard</h3>
        </a>
        <a href="users.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'users.php') !== false ? 'active' : ''; ?>">

            <span class="material-icons-sharp">
                person_outline
            </span>
            <h3>Users</h3>
        </a>
        <a href="employees.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'employees.php') !== false ? 'active' : ''; ?>">


            <span class="material-symbols-outlined">
                engineering
            </span>
            <h3>employees</h3>
        </a>
        <a href="orders.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'orders.php') !== false ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                receipt_long
            </span>
            <h3>Orders</h3>
        </a>
        <a href="#" style="display: none;">
            <span class="material-icons-sharp">
                insights
            </span>
            <h3>Analytics</h3>
        </a>
        <a href="tickets.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'tickets.php') !== false ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                mail_outline
            </span>
            <h3>Tickets</h3>

        </a>
        <a href="sale-list.php" style="display: none;" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'sale-list.php') !== false ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                inventory
            </span>
            <h3>Sale List</h3>
        </a>
        <a href="database.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'database.php') !== false ? 'active' : ''; ?>">
            <span class="material-icons-sharp">
                report_gmailerrorred
            </span>
            <h3>DataBase</h3>
        </a>
        <!-- <a href="#">
            <span class="material-icons-sharp">
                settings
            </span>
            <h3>Settings</h3>
        </a>
        <a href="#">
            <span class="material-icons-sharp">
                add
            </span>
            <h3>New Login</h3>
        </a> -->
        <a href="../components/logout.php">
            <span class="material-icons-sharp">
                logout
            </span>
            <h3>Logout</h3>
        </a>

        <!-- Other sidebar links -->
    </div>
</aside>
<!-- End of Sidebar Section -->
<script>
    function openhome() {
        window.location.href = "../home.php";
    }
</script>
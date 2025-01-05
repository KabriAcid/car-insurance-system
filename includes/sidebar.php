

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>Car Insurance System</h2>
    </div>

    <ul class="sidebar-menu">
        <li><a href="dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a></li>
        <li><a href="profile.php"><i class="bi bi-person-circle"></i> Profile</a></li>
        <li><a href="purchase_policy.php"><i class="bi bi-cart-plus"></i> Purchase Policy</a></li>
        <li><a href="renew_policy.php"><i class="bi bi-arrow-repeat"></i> Renew Policy</a></li>
        <li><a href="policy_applications.php"><i class="bi bi-file-earmark-text"></i> Policy Applications</a></li>
        <li><a href="transactions.php"><i class="bi bi-file-earmark-text"></i> Transactions</a></li>
        
        <li><a href="../scripts/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
    </ul>
</div>

<!-- Sidebar Styles -->
<style>
    .sidebar {
        width: 250px;
        height: 100%;
        background-color: #2c3e50;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 20px;
    }

    .sidebar-header {
        text-align: center;
        color: #ecf0f1;
        margin-bottom: 20px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
    }

    .sidebar-menu li {
        margin: 15px 0;
    }

    .sidebar-menu a {
        color: #ecf0f1;
        text-decoration: none;
        padding: 10px 20px;
        display: block;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .sidebar-menu a:hover {
        background-color: #34495e;
    }

    .sidebar-menu i {
        margin-right: 10px;
    }
</style>

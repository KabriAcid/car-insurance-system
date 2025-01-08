<?php
session_start();
require '../connection.php';

// Add policy
if (isset($_POST['add_policy'])) {
    $policy_name = $_POST['policy_name'];
    $policy_description = $_POST['policy_description'];

    $sql = "INSERT INTO policies (name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $policy_name, $policy_description);
    $stmt->execute();
}

// Edit policy
if (isset($_GET['edit'])) {
    $policy_id = $_GET['edit'];
    $sql = "SELECT * FROM policies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $policy_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $policy = $result->fetch_assoc();
}

// Delete policy
if (isset($_GET['delete'])) {
    $policy_id = $_GET['delete'];
    $sql = "DELETE FROM policies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $policy_id);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Policies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        #sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
        }
        #sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        #sidebar a:hover {
            background-color: #495057;
            padding-left: 10px;
            border-radius: 4px;
        }
        #main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 vh-100 p-3" id="sidebar">
                <h4>Navigation</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_policies.php">Manage Policies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 py-5">
                <h2>Manage Policies</h2>
                <form action="manage_policies.php" method="post">
                    <h4>Add New Policy</h4>
                    <input type="text" name="policy_name" class="form-control" placeholder="Policy Name" required><br>
                    <textarea name="policy_description" class="form-control" placeholder="Policy Description" required></textarea><br>
                    <button type="submit" name="add_policy" class="btn btn-primary">Add Policy</button>
                </form>

                <hr>

                <h4>Existing Policies</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Policy ID</th>
                            <th>Policy Name</th>
                            <th>Policy Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM policies");
                        while ($policy = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$policy['id']}</td>";
                            echo "<td>{$policy['name']}</td>";
                            echo "<td>{$policy['description']}</td>";
                            echo '<td>
                                <a href="manage_policies.php?edit=' . $policy['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                                <a href="manage_policies.php?delete=' . $policy['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                            </td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

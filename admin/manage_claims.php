<?php
session_start();
require '../config/config.php';

// Approve claim
if (isset($_GET['approve'])) {
    $claim_id = $_GET['approve'];
    $sql = "UPDATE claims SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $claim_id);
    $stmt->execute();
}

// Reject claim
if (isset($_GET['reject'])) {
    $claim_id = $_GET['reject'];
    $sql = "UPDATE claims SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $claim_id);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Claims</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container py-5">
        <h2>Manage Claims</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Claim ID</th>
                    <th>User</th>
                    <th>Policy</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT claims.id, users.name AS user_name, policies.name AS policy_name, claims.description, claims.status 
                                        FROM claims 
                                        JOIN users ON claims.user_id = users.id 
                                        JOIN policies ON claims.policy_id = policies.id");

                while ($claim = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$claim['id']}</td>";
                    echo "<td>{$claim['user_name']}</td>";
                    echo "<td>{$claim['policy_name']}</td>";
                    echo "<td>{$claim['description']}</td>";
                    echo "<td>{$claim['status']}</td>";
                    echo '<td>
                            <a href="manage_claims.php?approve=' . $claim['id'] . '" class="btn btn-success btn-sm">Approve</a>
                            <a href="manage_claims.php?reject=' . $claim['id'] . '" class="btn btn-danger btn-sm">Reject</a>
                          </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

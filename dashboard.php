<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include('../config/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        h2 {
            color: white;
            font-weight: bold;
        }

        .sub-text {
            color: #ddd;
        }

        /* Glass Card */
        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        /* Table */
        .table thead {
            background-color: #343a40;
            color: white;
        }

        /* Buttons */
        .btn {
            transition: 0.2s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        /* Stats Card */
        .stat-card {
            border-radius: 12px;
            padding: 20px;
            color: white;
        }

        .bg1 { background: #ff7e5f; }
        .bg2 { background: #00c6ff; }

    </style>
</head>

<body>

<div class="container mt-5">

    <!-- Header -->
    <div class="text-center mb-4">
        <h2>🚀 Admin Dashboard</h2>
        <p class="sub-text">Manage your events efficiently</p>
    </div>

    <!-- Top Buttons -->
    <div class="d-flex justify-content-between mb-4">
        <a href="add_event.php" class="btn btn-success shadow">➕ Add Event</a>
        <a href="logout.php" class="btn btn-danger shadow">Logout</a>
    </div>

    <!-- Stats -->
    <div class="row mb-4">

        <?php
        $countResult = $conn->query("SELECT COUNT(*) as total FROM events");
        $totalEvents = $countResult->fetch_assoc()['total'];
        ?>

        <div class="col-md-6">
            <div class="stat-card bg1 shadow">
                <h5>Total Events</h5>
                <h3><?php echo $totalEvents; ?></h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="stat-card bg2 shadow">
                <h5>System Status</h5>
                <h3>Active ✅</h3>
            </div>
        </div>

    </div>

    <!-- Table -->
    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sql = "SELECT * FROM events ORDER BY date DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><strong><?php echo $row['title']; ?></strong></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <span class="badge bg-primary"><?php echo $row['category']; ?></span>
                            </td>
                            <td>
                                <a href="edit_event.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <a href="delete_event.php?id=<?php echo $row['id']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this event?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No events found</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
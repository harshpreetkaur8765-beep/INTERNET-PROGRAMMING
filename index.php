<?php include('../config/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Listing</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Heading -->
    <h2 class="text-center mb-4">📅 All Events</h2>

    <!-- Search Bar -->
    <input type="text" id="search" class="form-control mb-4" placeholder="Search events by title, location, or category...">

    <!-- Event List -->
    <div id="events" class="row">

        <?php
        $sql = "SELECT * FROM events ORDER BY date ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>

        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">

                    <h5 class="card-title"><?php echo $row['title']; ?></h5>

                    <p class="card-text"><?php echo $row['description']; ?></p>

                    <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                    <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                    <p><strong>Category:</strong> 
                        <span class="badge bg-primary"><?php echo $row['category']; ?></span>
                    </p>

                </div>
            </div>
        </div>

        <?php
            }
        } else {
            echo "<p>No events found.</p>";
        }
        ?>

    </div>
</div>

<!-- JavaScript -->
<script src="../js/script.js"></script>

</body>
</html>
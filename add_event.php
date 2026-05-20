<?php include('../config/db.php'); ?>

<?php
$message = "";

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $category = $_POST['category'];

    if (empty($title) || empty($date)) {
        $message = "<div class='alert alert-danger'>Title and Date are required!</div>";
    } else {
        // Prepared statement
        $stmt = $conn->prepare("INSERT INTO events (title, description, date, location, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $description, $date, $location, $category);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Event added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error adding event</div>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>➕ Add New Event</h2>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
    </div>

    <!-- Message -->
    <?php echo $message; ?>

    <!-- Form Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Event Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter event title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="Enter location">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" placeholder="Enter category">
                </div>

                <button type="submit" name="submit" class="btn btn-success w-100">Add Event</button>

            </form>

        </div>
    </div>

</div>

</body>
</html>
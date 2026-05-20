<?php
include('../config/db.php');

$message = "";

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid event ID");
}

$id = $_GET['id'];

// Fetch existing data (prepared statement)
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Event not found");
}

// Handle update
if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $category = $_POST['category'];

    if (empty($title) || empty($date)) {
        $message = "<div class='alert alert-danger'>Title and Date are required!</div>";
    } else {
        $stmt = $conn->prepare("UPDATE events SET title=?, description=?, date=?, location=?, category=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $description, $date, $location, $category, $id);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Event updated successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error updating event</div>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>✏️ Edit Event</h2>
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
                    <input type="text" name="title" class="form-control"
                           value="<?php echo htmlspecialchars($row['title']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($row['description']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control"
                           value="<?php echo $row['date']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control"
                           value="<?php echo htmlspecialchars($row['location']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control"
                           value="<?php echo htmlspecialchars($row['category']); ?>">
                </div>

                <button type="submit" name="update" class="btn btn-primary w-100">Update Event</button>

            </form>

        </div>
    </div>

</div>

</body>
</html>
<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Auto redirect after 2 seconds -->
    <meta http-equiv="refresh" content="2;url=login.php">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4 text-center" style="width: 400px;">

        <h3 class="mb-3">👋 Logged Out</h3>

        <div class="alert alert-success">
            You have been successfully logged out.
        </div>

        <p>Redirecting to login page...</p>

        <a href="login.php" class="btn btn-primary mt-2">Go to Login</a>

    </div>

</div>

</body>
</html>
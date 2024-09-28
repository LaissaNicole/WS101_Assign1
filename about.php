<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: assign1.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>User Details</h2>
        <p><strong>Name:</strong> <?= isset($user['name']) ? htmlspecialchars($user['name']) : 'N/A' ?></p>
        <p><strong>Email:</strong> <?= isset($user['email']) ? htmlspecialchars($user['email']) : 'N/A' ?></p>
        <p><strong>Facebook URL:</strong> <?= isset($user['fb_url']) ? htmlspecialchars($user['fb_url']) : 'N/A' ?></p>
        <p><strong>Phone:</strong> <?= isset($user['phone']) ? htmlspecialchars($user['phone']) : 'N/A' ?></p>
        <p><strong>Gender:</strong> <?= isset($user['gender']) ? htmlspecialchars($user['gender']) : 'N/A' ?></p>
        <p><strong>Country:</strong> <?= isset($user['country']) ? htmlspecialchars($user['country']) : 'N/A' ?></p>
        <p><strong>Skills:</strong> <?= isset($user['skills']) ? htmlspecialchars(implode(', ', $user['skills'])) : 'N/A' ?></p>
        <p><strong>Biography:</strong> <?= isset($user['biography']) ? htmlspecialchars($user['biography']) : 'N/A' ?></p>
    </div>
</body>
</html>

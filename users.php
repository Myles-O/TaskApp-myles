<?php
$conn = new mysqli("localhost", "root", "1234", "pro");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, email FROM users ORDER BY username ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Registered Users</h2>
    <?php if ($result->num_rows > 0): ?>
        <ol class="list-group list-group-numbered">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <?= htmlspecialchars($row['username']) ?> (<?= htmlspecialchars($row['email']) ?>)
                </li>
            <?php endwhile; ?>
        </ol>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>

</body>
</html>
<?php $conn->close(); ?>

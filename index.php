<?php
include 'db.php';

$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Project Management System</h2>

    <div class="container">
        <form action="add_project.php" method="POST" class="form-left">
            <label for="name">Project Name</label>
            <input type="text" id="name" name="name" placeholder="Project Name" required>
            
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" required>
            
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" required>
            
            <label for="scope">Scope</label>
            <select id="scope" name="scope" required>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
            
            <button type="submit">Add Project</button>
        </form>

        <table>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Scope</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['start_date'] ?></td>
                <td><?= $row['end_date'] ?></td>
                <td><?= $row['scope'] ?></td>
                <td><?= $row['status'] ?></td>
            <td>
                <a href="edit_project.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="mark_done.php?id=<?= $row['id'] ?>">
                    <?= ($row['status'] === 'Done') ? 'Mark as Undone' : 'Mark as Done' ?>
                </a>
                <a href="delete_project.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this project?')">Delete</a>
            </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
    </div>
</body>
</html>
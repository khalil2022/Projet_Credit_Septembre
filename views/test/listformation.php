<?php
require_once '../controllers/formationC.php';

$formationController = new FormationController();
$formations = $formationController->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation List</title>
</head>
<body>
    <h1>Formation List</h1>
    <a href="create_formation.php">Create New Formation</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Type ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $formation): ?>
                <tr>
                    <td><?= $formation['id'] ?></td>
                    <td><?= $formation['title'] ?></td>
                    <td><?= $formation['description'] ?></td>
                    <td><?= $formation['startDate'] ?></td>
                    <td><?= $formation['endDate'] ?></td>
                    <td><?= $formation['typeId'] ?></td>
                    <td>
                        <a href="update_formation.php?id=<?= $formation['id'] ?>">Edit</a>
                        <a href="delete_formation.php?id=<?= $formation['id'] ?>" onclick="return confirm('Are you sure you want to delete this formation?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

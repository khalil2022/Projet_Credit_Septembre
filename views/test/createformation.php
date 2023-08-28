<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Formation</title>
</head>
<body>
    <h1>Create Formation</h1>
    <form action="create_formation.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required><br>
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required><br>
        <label for="typeId">Type ID:</label>
        <input type="number" id="typeId" name="typeId" required><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>

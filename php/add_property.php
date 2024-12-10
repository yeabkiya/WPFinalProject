<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Seller') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
</head>
<body>
    <h1>Add a New Property</h1>
    <form action="add_property_action.php" method="POST" enctype="multipart/form-data">
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="age">Age (Years):</label>
        <input type="number" id="age" name="age" required>

        <label for="floor_plan">Floor Plan:</label>
        <input type="text" id="floor_plan" name="floor_plan" required>

        <label for="bedrooms">Bedrooms:</label>
        <input type="number" id="bedrooms" name="bedrooms" required>

        <label for="bathrooms">Bathrooms:</label>
        <input type="number" id="bathrooms" name="bathrooms" required>

        <label for="garden">Garden:</label>
        <select id="garden" name="garden">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="parking">Parking:</label>
        <select id="parking" name="parking">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="proximity">Proximity to Facilities:</label>
        <textarea id="proximity" name="proximity"></textarea>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Add Property</button>
    </form>
</body>
</html>

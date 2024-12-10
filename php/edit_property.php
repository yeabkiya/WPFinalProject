<?php
include '../db_config.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Seller') {
    header("Location: login.php");
    exit;
}

// Get property details
$property_id = $_GET['id'];
$sql = "SELECT * FROM properties WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $property_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$property = $result->fetch_assoc();

if (!$property) {
    echo "Property not found or you do not have permission to edit this property.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
</head>
<body>
    <h1>Edit Property</h1>
    <form action="edit_property_action.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $property['location']; ?>" required>
        
        <label for="age">Age (Years):</label>
        <input type="number" id="age" name="age" value="<?php echo $property['age']; ?>" required>
        
        <label for="floor_plan">Floor Plan:</label>
        <input type="text" id="floor_plan" name="floor_plan" value="<?php echo $property['floor_plan']; ?>" required>
        
        <label for="bedrooms">Bedrooms:</label>
        <input type="number" id="bedrooms" name="bedrooms" value="<?php echo $property['bedrooms']; ?>" required>
        
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" id="bathrooms" name="bathrooms" value="<?php echo $property['bathrooms']; ?>" required>
        
        <label for="image">Upload New Image (optional):</label>
        <input type="file" id="image" name="image">
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

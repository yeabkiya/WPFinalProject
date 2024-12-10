<?php
session_start();
include '../db_config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Seller') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch properties from the database
$sql = "SELECT * FROM properties WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Welcome, Seller!</h1>
    <a href="add_property.php">+ Add Property</a>
    <a href="logout.php" class="button">Sign Out</a>
    <div class="properties">
        <?php while ($property = $result->fetch_assoc()): ?>
            <div class="property-card">
                <img src="<?php echo $property['image_url']; ?>" alt="Property Image">
                <h3><?php echo $property['location']; ?></h3>
                <p>Bedrooms: <?php echo $property['bedrooms']; ?></p>
                <p>Bathrooms: <?php echo $property['bathrooms']; ?></p>
                <p>Property Tax: $<?php echo $property['property_tax']; ?></p>
                <a href="edit_property.php?id=<?php echo $property['id']; ?>">Edit</a>
                <a href="delete_property.php?id=<?php echo $property['id']; ?>" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

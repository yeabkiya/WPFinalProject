<?php
include '../db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $location = htmlspecialchars($_POST['location']);
    $age = (int) $_POST['age'];
    $floor_plan = htmlspecialchars($_POST['floor_plan']);
    $bedrooms = (int) $_POST['bedrooms'];
    $bathrooms = (int) $_POST['bathrooms'];
    $garden = (int) $_POST['garden'];
    $parking = (int) $_POST['parking'];
    $proximity = htmlspecialchars($_POST['proximity']);
    $property_tax = 0.07 * $age * 10000; // Example calculation for property tax

    // Handle image upload
    $target_dir = "./images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }


    $sql = "INSERT INTO properties (user_id, location, age, floor_plan, bedrooms, bathrooms, garden, parking, proximity, property_tax, image_url)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisiissdss", $user_id, $location, $age, $floor_plan, $bedrooms, $bathrooms, $garden, $parking, $proximity, $property_tax, $target_file);

    if ($stmt->execute()) {
        header("Location: seller_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<?php
include '../db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $location = htmlspecialchars($_POST['location']);
    $age = (int) $_POST['age'];
    $floor_plan = htmlspecialchars($_POST['floor_plan']);
    $bedrooms = (int) $_POST['bedrooms'];
    $bathrooms = (int) $_POST['bathrooms'];
    $user_id = $_SESSION['user_id'];

    // Update property details
    $sql = "UPDATE properties SET location = ?, age = ?, floor_plan = ?, bedrooms = ?, bathrooms = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisiiii", $location, $age, $floor_plan, $bedrooms, $bathrooms, $property_id, $user_id);

    if ($stmt->execute()) {
        // Handle image upload if provided
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "./images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "UPDATE properties SET image_url = ? WHERE id = ? AND user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $target_file, $property_id, $user_id);
                $stmt->execute();
            }
        }
        header("Location: seller_dashboard.php");
        exit;
    } else {
        echo "Error updating property: " . $stmt->error;
    }
}
?>

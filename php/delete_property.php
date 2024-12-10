<?php
include '../db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $property_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete property
    $sql = "DELETE FROM properties WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $property_id, $user_id);

    if ($stmt->execute()) {
        header("Location: seller_dashboard.php");
        exit;
    } else {
        echo "Error deleting property: " . $stmt->error;
    }
}
?>

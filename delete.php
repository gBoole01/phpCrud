<?php
require 'inc/connect.php';

$studentId = $_GET['id'] ? $_GET['id'] : null;
if (!isset($studentId)) {
    header("Location: index.php");
}

$query = "DELETE FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $studentId);
try {
    $stmt->execute();
    $result = $stmt->get_result();
    header("Location: index.php?successDelete=true");
} catch (Exception $e) {
    header("Location: index.php?successDelete=false");
}
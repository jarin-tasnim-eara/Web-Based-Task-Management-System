<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT status FROM tasks WHERE id = $id AND user_id = $user_id");
$task = $result->fetch_assoc();

if ($task) {
    $current = $task['status'];
    $nextStatus = match($current) {
        'Pending' => 'In Progress',
        'In Progress' => 'Completed',
        default => 'Pending'
    };

    $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $nextStatus, $id, $user_id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit();

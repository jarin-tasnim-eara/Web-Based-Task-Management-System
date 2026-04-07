<?php
include 'header.php';
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch tasks grouped by status and ordered by priority (High > Medium > Low)
$statuses = ['Pending', 'In Progress', 'Completed'];
$status_labels = [
    'Pending' => 'warning',
    'In Progress' => 'info',
    'Completed' => 'success'
];
$priority_order = ['High' => 1, 'Medium' => 2, 'Low' => 3];

// Count tasks for message
$total_tasks = $conn->query("SELECT COUNT(*) FROM tasks WHERE user_id = $user_id")->fetch_row()[0];
$completed_tasks = $conn->query("SELECT COUNT(*) FROM tasks WHERE user_id = $user_id AND status = 'Completed'")->fetch_row()[0];
?>

<style>
body {
    background-image: url('images/dashboard.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.container {
    background-color: rgba(255, 255, 255, 0.92);
    padding: 20px;
    border-radius: 15px;
    margin-top: 30px;
}
.card {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.card-title {
    font-weight: bold;
}
.section-title {
    text-align: center;
    margin: 20px 0;
    color: #333;
}
.motd {
    font-style: italic;
    font-size: 18px;
    margin-top: 10px;
}
</style>

<div class="container text-center mt-3">
  <p class="motd">
    <?php if ($total_tasks > 0): ?>
      "You've completed <?= $completed_tasks ?> of <?= $total_tasks ?> tasks. Keep it up!"
    <?php else: ?>
      "Ready to tackle your first task? Click '+ Add Task' to start!"
    <?php endif; ?>
  </p>
</div>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Your Tasks</h2>
        <a href="add_task.php" class="btn btn-success">+ Add Task</a>
    </div>

    <div class="row">
        <?php foreach ($statuses as $status): ?>
            <div class="col-md-4">
                <h4 class="section-title"><?= $status ?> Tasks</h4>
                <?php
                $result = $conn->query("
                    SELECT * FROM tasks 
                    WHERE user_id = $user_id AND status = '$status'
                    ORDER BY 
                        CASE priority 
                            WHEN 'High' THEN 1 
                            WHEN 'Medium' THEN 2 
                            WHEN 'Low' THEN 3 
                            ELSE 4 
                        END, due_date ASC
                ");

                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                    <div class="card mb-3 border-<?= $status_labels[$status] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                            <p class="card-text">
                                <strong>Priority:</strong> <?= $row['priority'] ?><br>
                                <strong>Due Date:</strong> <?= $row['due_date'] ?>
                            </p>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <a href="edit_task.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?');">Delete</a>
                                <?php if ($row['status'] != 'Completed'): ?>
                                    <a href="update_status.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-secondary">Update Status</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; else: ?>
                    <p class="text-muted text-center">No <?= $status ?> tasks.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
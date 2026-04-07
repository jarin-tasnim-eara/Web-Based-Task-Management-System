<?php
include 'header.php';
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, status, priority, due_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $title, $description, $status, $priority, $due_date);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<style>
    :root {
        --primary-color: #6c5ce7;
        --secondary-color: #a29bfe;
        --accent-color: #fd79a8;
        --dark-color: #2d3436;
        --light-color: #f5f6fa;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }

    .task-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        padding: 2.5rem;
        margin-top: 2rem;
        margin-bottom: 3rem;
        transition: all 0.3s ease;
        max-width: 750px;  /* Set the max width */
        margin-left: auto;  /* Center horizontally */
        margin-right: auto; /* Center horizontally */
    }

    .task-container:hover {
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.25);
    }

    .form-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        color: var(--dark-color);
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .quote-text {
        font-style: italic;
        color: var(--dark-color);
        opacity: 0.8;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        position: relative;
        padding-left: 1.5rem;
    }

    .quote-text::before {
        content: '"';
        font-size: 3rem;
        position: absolute;
        left: -0.5rem;
        top: -1rem;
        color: var(--secondary-color);
        opacity: 0.3;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        border: 2px solid #dfe6e9;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
    }

    .btn-back {
        background: var(--dark-color);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: #1a1a1a;
        transform: translateX(-5px);
        color: white;
    }

    .btn-submit {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
    }

    .btn-submit:hover {
        background: #5a4fcf;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(108, 92, 231, 0.4);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .task-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container mt-4">
    <div class="task-container animate__animated animate__fadeIn">
        <div class="form-header">
            <h1 class="page-title">Add New Task</h1>
            <a href="dashboard.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        
        <p class="quote-text">"Big things come from small tasks completed."</p>

        <form method="post">
            <div class="form-group">
                <label class="form-label">Task Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter task title" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Describe your task..."></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Pending">⏳ Pending</option>
                        <option value="In Progress">🚧 In Progress</option>
                        <option value="Completed">✅ Completed</option>
                    </select>
                </div>
                
                <div class="col-md-4 form-group">
                    <label class="form-label">Priority</label>
                    <select name="priority" class="form-select">
                        <option value="Low">🔵 Low</option>
                        <option value="Medium" selected>🟡 Medium</option>
                        <option value="High">🔴 High</option>
                    </select>
                </div>
                
                <div class="col-md-4 form-group">
                    <label class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-control">
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-plus-circle me-2"></i> Add Task
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Include Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<?php include 'footer.php'; ?>

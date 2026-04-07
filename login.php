<?php
include 'header.php';
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password or email address";
        }
    } else {
        $error = "Incorrect password or email address";
    }
}
?>

<!-- Add background image style -->
<style>
    /* Apply background image to the entire body */
    body {
        background-image: url('images/login.jpg'); /* Make sure the path is correct */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        font-family: Arial, sans-serif;
    }

   

    /* Style for the "Message of the Day" */
    .motd {
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-size: 1.25rem;
        font-weight: 500;
        color: #4a6fa5;
        text-shadow: 0 1px 2px rgba(0,0,0,0.05);
        letter-spacing: 0.5px;
        margin: 1.5rem 0;
        padding: 0.5rem;
        border-left: 3px solid #4a6fa5;
        background-color: rgba(255, 255, 255, 0.8); /* Slight background for readability */
    }

    
</style>

<!-- Message Section -->
<div class="container text-center">
  <p class="motd">"Master your tasks, own your time."</p>
</div>

<!-- Login Form Section -->
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h2 class="text-center mb-4">Welcome Back</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="giga@example.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Sign in</button>
        </form>
        
        <p class="text-center mt-3">
            Don't have an account? <a href="register.php" class="text-decoration-none">Sign up</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>

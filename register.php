<?php
include 'header.php';
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $raw_password = trim($_POST['password']);

    if (strlen($raw_password) < 4) {
        $error = "Password must be at least 4 characters long.";
    } else {
        // Check if email already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error = "This email is already registered. Please use a different email.";
        } else {
            $password = password_hash($raw_password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed: " . $stmt->error;
            }
        }
    }
}
?>

<!-- Add background image style -->
<style>
    body {
        background-image: url('images/register.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        font-family: Arial, sans-serif;
    }

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
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>

<!-- Message Section -->
<div class="container text-center">
  <p class="motd">"Your productivity journey starts now."</p>
</div>

<!-- Registration Form Section -->
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h2 class="text-center mb-4">Create Account</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••" minlength="4" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Sign up</button>
        </form>

        <p class="text-center mt-3">
            Already have an account? <a href="login.php" class="text-decoration-none">Sign in</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>

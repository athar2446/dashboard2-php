<?php
include 'config.php';
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $check_email = "SELECT id FROM clients WHERE email='$email'";
    $result = $conn->query($check_email);
    
    if ($result->num_rows == 0) {
        $query = "INSERT INTO clients (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($query)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed! Please try again.";
        }
    } else {
        $error = "This email is already registered!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card p-4 shadow" style="width: 350px;">
            <h4 class="text-center">Sign Up</h4>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form method="post">
                <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
                <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button type="submit" name="register" class="btn btn-primary w-100">Create Account</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    session_start();
    // Include the database configuration file
    include 'config.php';

    // Redirect based on user role
    if (isset($_POST["submit"])) {
        $adminUsername = $_POST['username'] ?? null;
        $adminPassword = $_POST['password'] ?? null;
        $userUsername = $_POST['username'] ?? null;
        $userPassword = $_POST['password'] ?? null;

        // Check in the admin table
        if ($adminUsername && $adminPassword) {
            $adminQuery = "SELECT * FROM admin WHERE id_admin='$adminUsername' AND password='$adminPassword'";
            $adminResult = mysqli_query($conn, $adminQuery);

            if (mysqli_num_rows($adminResult) > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $adminUsername;
            $_SESSION['role'] = 'admin';
            header('Location: index.php');
            exit;
            }
        }

        // Check in the user table
        if ($userUsername && $userPassword) {
            $userQuery = "SELECT * FROM user WHERE nim='$userUsername' AND password='$userPassword'";
            $userResult = mysqli_query($conn, $userQuery);

            if (mysqli_num_rows($userResult) > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $userUsername;
            $_SESSION['role'] = 'user';
            header('Location: homepage.php');
            exit;
            }
        }

        // If no match is found
        $error = "Invalid username or password.";
    }

    // Restrict access to index.php for users
    if (basename($_SERVER['PHP_SELF']) == 'index.php' && isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
        header('Location: homepage.php');
        exit;
    }

    // Restrict access to homepage.php for admins
    if (basename($_SERVER['PHP_SELF']) == 'homepage.php' && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/icon/open-book.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>
</div>
    <div class="login-container" style="height: 400px;">
        <!--First section-->
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div style="text-align: center; margin-bottom: 10px;">
                <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="User Icon" style="width: 80px;">
            </div>
            <h2 style="text-align: center; margin-bottom: 10px;">Login</h2>
            <div style="margin-bottom: 20px; text-align: center;">
                <input type="text" name="username" placeholder="Username" required style="width: 90%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 10px;">
                <input type="password" name="password" placeholder="Password" required style="width: 90%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;">
            </div>
            <button type="submit" name="submit" style="width: 100%; padding: 10px; background-color: red; color: white; border: none; border-radius: 4px; cursor: pointer;">Login</button>
        </form>
    </div>

    
</body>
</html>
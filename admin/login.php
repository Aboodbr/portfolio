<?php
session_start();
include 'db.php';

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
    } else {
        $error = "بيانات الدخول غير صحيحة!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body { font-family: sans-serif; background: #0a192f; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: #112240; padding: 40px; border-radius: 10px; text-align: center; }
        input { display: block; width: 100%; margin: 10px 0; padding: 10px; border-radius: 5px; border: none; }
        button { background: #0fbcf9; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; width: 100%;}
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
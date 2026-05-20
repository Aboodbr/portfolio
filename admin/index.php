<?php
session_start();
include 'db.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// كود إضافة مشروع جديد
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $github = $_POST['github_link'];
    $demo = $_POST['demo_link'];
    
    // رفع الصورة
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $sql = "INSERT INTO projects (title, category, image, github_link, demo_link) VALUES ('$title', '$category', '$image', '$github', '$demo')";
    $conn->query($sql);
    header("Location: index.php"); // لتحديث الصفحة
}

// كود حذف مشروع
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM projects WHERE id = $id");
    header("Location: index.php");
}

// جلب المشاريع لعرضها
$projects = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Abood Albetar</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form input, form button { display: block; width: 100%; margin-bottom: 10px; padding: 10px; }
        form button { background: #0fbcf9; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .logout { float: right; color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard - Manage Projects <a href="logout.php" class="logout">Logout</a></h2>
        
        <h3>Add New Project</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Project Title" required>
            <input type="text" name="category" placeholder="Category (e.g., Full Stack ERP)" required>
            <input type="file" name="image" required accept="image/*">
            <input type="text" name="github_link" placeholder="GitHub Link">
            <input type="text" name="demo_link" placeholder="Demo Link">
            <button type="submit" name="add_project">Save Project</button>
        </form>

        <h3>All Projects</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php while($row = $projects->fetch_assoc()): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><img src="../uploads/<?= $row['image'] ?>" width="50"></td>
                <td><a href="index.php?delete=<?= $row['id'] ?>" style="color:red;" onclick="return confirm('Are you sure?')">Delete</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
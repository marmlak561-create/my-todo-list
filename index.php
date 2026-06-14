<?php
include 'config.php';

// إضافة مهمة جديدة
if (isset($_POST['new_task'])) {
    $task = $conn->real_escape_string($_POST['new_task']);
    if (!empty($task)) {
        $conn->query("INSERT INTO tasks (task) VALUES ('$task')");
    }
    header("Location: index.php");
    exit();
}

// تحديث حالة المهمة (تم إنجازها أو لا)
if (isset($_GET['done'])) {
    $id = (int)$_GET['done'];
    $conn->query("UPDATE tasks SET is_done = 1 WHERE id = $id");
    header("Location: index.php");
    exit();
}

// حذف المهمة
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM tasks WHERE id = $id");
    header("Location: index.php");
    exit();
}

// جلب جميع المهام
$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple To-Do List</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: auto; }
        h1 { text-align: center; }
        form { margin-bottom: 20px; }
        input[type=text] { width: 80%; padding: 10px; }
        button { padding: 10px; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 10px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; }
        .done { text-decoration: line-through; color: gray; }
        a { text-decoration: none; margin-left: 10px; }
    </style>
</head>
<body>

<h1>My To-Do Listtt</h1>

<form method="POST" action="">
    <input type="text" name="new_task" placeholder="Add a new task..." required />
    <button type="submit">Add</button>
</form>

<ul>
    <?php while($row = $result->fetch_assoc()): ?>
        <li>
            <span class="<?= $row['is_done'] ? 'done' : '' ?>">
                <?= htmlspecialchars($row['task']) ?>
            </span>
            <span>
                <?php if (!$row['is_done']): ?>
                    <a href="?done=<?= $row['id'] ?>">✅ Done</a>
                <?php endif; ?>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">❌ Delete</a>
            </span>
        </li>
    <?php endwhile; ?>
</ul>

</body>
</html>

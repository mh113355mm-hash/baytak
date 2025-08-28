<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

include 'connect.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST['username']);
  $password = $_POST['password']; // لا تستخدم trim على كلمة المرور

  if ($username && $password) {
    // تشفير كلمة المرور قبل تخزينها
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // استخدام الاستعلامات المعدة لمنع SQL Injection
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
      $success = "✅ تم إضافة الأدمن بنجاح.";
    } else {
      $error = "❌ حدث خطأ أثناء الإضافة: " . $stmt->error;
    }
    $stmt->close();
  } else {
    $error = "⚠ يرجى تعبئة كل الحقول.";
  }
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة أدمن جديد - بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <header>
    <h1>إضافة أدمن جديد</h1>
    <nav>
      <ul>
        <li><a href="dashboard.php">لوحة التحكم</a></li>
      </ul>
    </nav>
  </header>

  <main class="content">
    <?php if ($success): ?>
      <div class="success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="add_admin.php">
      <div class="form-group">
        <label for="username">اسم المستخدم:</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit" class="btn">إضافة</button>
    </form>
  </main>

  <footer>
    <p>© 2025 بيتك العقارية - لوحة التحكم | جميع الحقوق محفوظة</p>
  </footer>

</body>
</html>
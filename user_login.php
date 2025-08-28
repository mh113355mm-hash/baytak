<?php
session_start();
include 'connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    header("Location: add_user_property.php"); 
    exit();
  } else {
    $error = "بيانات الدخول غير صحيحة.";
  }
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول المستخدم</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main class="login-container">
    <div id="login-box" class="form-container active">
      <h2>تسجيل دخول المستخدم</h2>
      <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="form-group">
          <label for="username">اسم المستخدم:</label>
          <input type="text" id="username" name="username" placeholder="اسم المستخدم" required>
        </div>
        <div class="form-group">
          <label for="password">كلمة المرور:</label>
          <input type="password" id="password" name="password" placeholder="كلمة المرور" required>
        </div>
        <button type="submit" class="btn">دخول</button>
      </form>
      <p class="form-switch-link">
        ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a>
      </p>
    </div>
  </main>
</body>
</html>
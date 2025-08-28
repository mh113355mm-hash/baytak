<?php
session_start();
include 'connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // التحقق من بيانات المستخدم العادي
  $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      header("Location: user_dashboard.php");
      exit();
    } else {
      $error = "بيانات الدخول غير صحيحة.";
    }
  } else {
    // إذا لم يكن مستخدمًا عاديًا، تحقق من أنه أدمن
    $stmt_admin = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt_admin->bind_param("s", $email); // يمكنك استخدام البريد الإلكتروني كاسم مستخدم
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();
    
    if ($result_admin->num_rows === 1) {
        $admin = $result_admin->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "بيانات الدخول غير صحيحة.";
        }
    } else {
        $error = "بيانات الدخول غير صحيحة.";
    }
  }
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - بيتك العقارية</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <?php include 'header.php'; ?>
  <main class="login-container">
    <div id="login-box" class="form-container active">
      <h2>تسجيل الدخول</h2>
      <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="form-group">
          <label for="email">البريد الإلكتروني:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">كلمة المرور:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">تسجيل الدخول</button>
      </form>
      <p>لا تمتلك حسابًا؟ <a href="register.php">إنشاء حساب جديد</a></p>
    </div>
  </main>
</body>
</html>
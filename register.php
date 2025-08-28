<?php
session_start();
include 'connect.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    if ($name && $email && $phone && $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // التحقق من أن البريد الإلكتروني غير مستخدم مسبقًا
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            $error = "❌ هذا البريد الإلكتروني مستخدم بالفعل.";
        } else {
            // إضافة المستخدم الجديد إلى قاعدة البيانات
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                // تسجيل دخول المستخدم تلقائيًا بعد التسجيل
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['user_name'] = $name;
                header("Location: user_dashboard.php");
                exit();
            } else {
                $error = "❌ حدث خطأ أثناء التسجيل: " . $stmt->error;
            }
            $stmt->close();
        }
        $stmt_check->close();
    } else {
        $error = "⚠ يرجى تعبئة جميع الحقول.";
    }
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - بيتك العقارية</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>
  <main class="login-container">
    <div class="form-container active">
      <h2>إنشاء حساب جديد</h2>
      <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
      <?php elseif ($error): ?>
        <div class="error"><?= $error ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="form-group">
          <label for="name">الاسم:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">البريد الإلكتروني:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="phone">رقم الهاتف:</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="password">كلمة المرور:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">إنشاء الحساب</button>
      </form>
      <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
    </div>
  </main>
</body>
</html>
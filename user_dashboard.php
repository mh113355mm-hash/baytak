<?php
session_start();
// التحقق من وجود جلسة المستخدم
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - بيتك العقارية</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <?php include 'header.php'; ?>
  
  <main class="dashboard-container">
    <h2>أهلاً بك، <?= htmlspecialchars($_SESSION['user_name']); ?></h2>

    <div class="dashboard-card">
      <h3>إدارة إعلاناتي</h3>
      <p>يمكنك إضافة، تعديل، وحذف العقارات الخاصة بك.</p>
      <a href="add_property.php" class="btn">إضافة إعلان جديد</a>
      <a href="my_properties.php" class="btn">عرض كل إعلاناتي</a>
    </div>

    <div class="dashboard-card">
      <h3>تعديل الملف الشخصي</h3>
      <p>قم بتحديث بياناتك الشخصية في أي وقت.</p>
      <a href="edit_profile.php" class="btn">تعديل بياناتي</a>
    </div>
  </main>
</body>
</html>
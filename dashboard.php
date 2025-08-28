<?php
session_start();
if (!isset($_SESSION['admin'])) {
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
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <h1>لوحة تحكم الأدمن - بيتك العقارية</h1>
  </header>
    
  <div class="dashboard-container">

    <div class="dashboard-card">
      <h3>إدارة العقارات</h3>
      <p>إضافة، تعديل، وحذف العقارات.</p>
      <a href="add_property.php" class="btn">إضافة عقار جديد</a>
      <a href="all_properties.php" class="btn">عرض كل العقارات</a>
    </div>

    <div class="dashboard-card">
      <h3>إدارة الرسائل</h3>
      <p>مراجعة رسائل العملاء والرد عليها.</p>
      <a href="messages.php" class="btn">عرض الرسائل</a>
    </div>

    <div class="dashboard-card">
      <h3>إدارة الحجوزات</h3>
      <p>متابعة طلبات الحجز من العملاء.</p>
      <a href="bookings.php" class="btn">عرض الحجوزات</a>
    </div>
    
    <div class="card">
      <h3>تسجيل الخروج</h3>
      <a href="login.php" class="btn">خروج</a>
    </div>
  
  </div>

</body>
</html>
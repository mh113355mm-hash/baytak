<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "real_estate";

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

// جلب كل العقارات
$query = "SELECT * FROM properties ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>كل العقارات - بيتك العقارية</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <header>
    <h1>كل العقارات - لوحة التحكم</h1>
    <nav>
      <ul>
        <li><a href="dashboard.php">لوحة التحكم</a></li>
        <li><a href="add_property.php">إضافة عقار</a></li>
        <li><a href="all_properties.php">عرض العقارات</a></li>
        <li><a href="messages.php">الرسائل</a></li>
        <li><a href="bookings.php">الحجوزات</a></li>
      </ul>
    </nav>
  </header>

  <main class="all-properties-container">
    <h2>قائمة العقارات</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
      <div class="properties-grid">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="property-card-admin">
          <?php if (!empty($row['image'])): ?>
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="صورة العقار" class="property-image-admin">
          <?php endif; ?>
          <div class="property-info-admin">
            <h3><?= htmlspecialchars($row['title']); ?></h3>
            <p><strong><i class="fas fa-map-marker-alt"></i> الموقع:</strong> <?= htmlspecialchars($row['location']); ?></p>
            <p><strong><i class="fas fa-tag"></i> السعر:</strong> <?= number_format($row['price']); ?> SDG</p>
            <p><strong><i class="fas fa-exchange-alt"></i> النوع:</strong> <?= ($row['type'] === 'بيع') ? 'بيع' : 'إيجار'; ?></p>
            <p class="description-text"><?= htmlspecialchars(mb_substr($row['description'], 0, 100)); ?>...</p>
          </div>
          <div class="property-actions-admin">
            <a href="edit_property.php?id=<?= $row['id'] ?>" class="btn edit-btn">✎ تعديل</a>
            <a href="delete_property.php?id=<?= $row['id'] ?>" class="btn delete-btn" onclick="return confirm('هل أنت متأكد من حذف هذا العقار؟');">🗑 حذف</a>
          </div>
        </div>
      <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="no-properties-message">لا توجد عقارات مضافة حالياً.</p>
    <?php endif; ?>
  </main>
  
  <?php include 'footer.php'; ?>

</body>
</html>
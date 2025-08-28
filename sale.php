<?php
include 'connect.php';

$sql = "SELECT * FROM properties WHERE type = 'بيع' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="UTF-8">
  <title>عقارات للبيع</title>
  <link rel="stylesheet" href="style.css"> <!-- ملف التنسيق العام -->
</head>
<body>

  <h2>عقارات للبيع</h2>

  <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="property-card">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p>السعر: <?= htmlspecialchars($row['price']) ?> جنيه</p>
        <p><?= htmlspecialchars(mb_substr($row['description'], 0, 100)) ?>...</p>
        <a href="details.php?id=<?= $row['id'] ?>">عرض التفاصيل</a>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>لا توجد عقارات للبيع حالياً.</p>
  <?php endif; ?>

</body>
</html>
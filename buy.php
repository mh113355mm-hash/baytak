<?php
include 'connect.php';

// استخدام Prepared Statements لأفضل ممارسة أمنية
$stmt = $conn->prepare("SELECT * FROM properties WHERE type = ? ORDER BY created_at DESC");
$property_type = 'buy';
$stmt->bind_param("s", $property_type);
$stmt->execute();
$properties = $stmt->get_result();
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="UTF-8">
  <title>عقارات للبيع</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <main>
    <section class="hero">
      <h2>عقارات للبيع</h2>
      <p>نوفر لك أفضل الخيارات للاستثمار أو السكن.</p>

      <form method="GET" action="search.php" class="search-form">
        <input type="text" name="search" placeholder="ابحث عن اسم العقار..." required>
        <select name="type">
          <option value="">-- كل الأنواع --</option>
          <option value="buy" selected>بيع</option>
          <option value="rent">إيجار</option>
        </select>
        <button type="submit" class="search-btn">بحث 🔍</button>
      </form>
    </section>

    <div class="properties-container">
      <?php if ($properties->num_rows > 0): ?>
        <?php while ($row = $properties->fetch_assoc()): ?>
          <div class="property-card">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="صورة العقار" class="property-img">
            <div class="property-details">
              <h3><?= htmlspecialchars($row['title']) ?></h3>
              <p><strong>السعر:</strong> <?= number_format(htmlspecialchars($row['price'])) ?> SDG</p>
              <p><strong>الوصف:</strong> <?= htmlspecialchars(mb_substr($row['description'], 0, 100)) ?>...</p>
              <a href="details.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn-details">عرض التفاصيل</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-results">لا توجد عقارات للبيع حالياً.</p>
      <?php endif; ?>
    </div>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
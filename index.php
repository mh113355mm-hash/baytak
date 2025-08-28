<?php
include 'connect.php';

// استخدام Prepared Statements لأفضل ممارسة أمنية
$stmt = $conn->prepare("SELECT * FROM properties ORDER BY created_at DESC LIMIT 4");
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <section class="hero-section">
        <div class="hero-content">
            <h1>ابحث عن عقارك المثالي</h1>
            <p>أفضل العقارات في السودان بأسعار تنافسية</p>
        </div>
        <div class="search-box">
            <div class="search-tabs">
                <button class="tab-btn active">بيع</button>
                <button class="tab-btn">إيجار</button>
            </div>
            <div class="search-form">
                <div class="search-input-group">
                    <label for="property-type">نوع العقار</label>
                    <select id="property-type">
                        <option>اختر نوع العقار</option>
                    </select>
                </div>
                <div class="search-input-group">
                    <label for="location">الولاية</label>
                    <select id="location">
                        <option>اختر الولاية</option>
                    </select>
                </div>
                <div class="search-input-group">
                    <label for="category">فئات</label>
                    <select id="category">
                        <option>اختر الفئة</option>
                    </select>
                </div>
                <button class="search-btn">بحث</button>
            </div>
        </div>
    </section>

  <section class="latest-properties">
    <h2>أحدث العقارات</h2>

    <?php if ($result->num_rows > 0): ?>
      <div class="property-list">
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="property-card">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="صورة العقار" class="property-img">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p>السعر: <?= number_format($row['price']) ?> SDG</p>
            <a href="details.php?id=<?= $row['id'] ?>" class="btn">عرض التفاصيل</a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>لا توجد عقارات مضافة حالياً.</p>
    <?php endif; ?>
  </section>

    <?php include 'footer.php'; ?>

</body>
</html>
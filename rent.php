<?php
include 'connect.php';

$stmt = $conn->prepare("SELECT * FROM properties WHERE type = 'إيجار' ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العقارات للإيجار - بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  
  <main class="properties-container">
    <section class="hero-section">
      <h1>عقارات للإيجار</h1>
      <p>اكتشف أفضل الخيارات السكنية والتجارية للإيجار.</p>
    </section>
    
    <section class="properties-grid">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="property-card">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="property-img">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p class="price">السعر: <?= number_format($row['price']) ?> SDG</p>
            <p class="location">الموقع: <?= htmlspecialchars($row['location']) ?></p>
            <a href="details.php?id=<?= $row['id'] ?>" class="btn">عرض التفاصيل</a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>لا توجد عقارات للإيجار حالياً.</p>
      <?php endif; ?>
    </section>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
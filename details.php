<?php
include 'connect.php';

$property = null;
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $property ? htmlspecialchars($property['title']) : 'العقار غير موجود'; ?> - بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <?php if ($property): ?>
    <main class="property-details-page">
        <section class="property-header">
            <h1><?= htmlspecialchars($property['title']); ?></h1>
            <div class="property-meta">
                <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($property['location']); ?></span>
                <span><i class="fas fa-tag"></i> <?= number_format($property['price']); ?> جنيه سوداني</span>
            </div>
        </section>

        <section class="property-body">
            <div class="main-image">
                <img src="<?= htmlspecialchars($property['image']); ?>" alt="صورة العقار">
            </div>

            <div class="details-content">
                <div class="details-section">
                    <h3>وصف العقار</h3>
                    <p><?= nl2br(htmlspecialchars($property['description'])); ?></p>
                </div>

                <div class="details-section">
                    <h3>معلومات أساسية</h3>
                    <ul>
                        <li><strong>النوع:</strong> <?= ($property['type'] === 'بيع') ? 'للبيع' : 'للإيجار'; ?></li>
                        <li><strong>الفئة:</strong> <?= htmlspecialchars($property['category']); ?></li>
                        <li><strong>تاريخ الإضافة:</strong> <?= htmlspecialchars($property['created_at']); ?></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="booking-section">
            <h2>طلب حجز أو معاينة</h2>
            <p>املأ النموذج التالي وسيقوم أحد ممثلينا بالتواصل معك في أقرب وقت.</p>
            
            <form action="book_property.php" method="POST" class="booking-form">
                <input type="hidden" name="property_id" value="<?= $property['id']; ?>">
                
                <div class="form-group">
                    <label for="name">الاسم الكامل</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <button type="submit" class="btn book-btn">تأكيد الحجز الآن</button>
            </form>
        </section>

    </main>
    <?php else: ?>
        <div class="error-message">
            <h2>عذراً، هذا العقار غير متوفر حالياً.</h2>
            <p>يرجى العودة إلى صفحة <a href="index.php">الرئيسية</a>.</p>
        </div>
    <?php endif; ?>

    <?php include 'footer.php'; ?>

</body>
</html>
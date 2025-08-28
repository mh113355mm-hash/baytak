<?php
// booking_from.php
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// التحقق من أن الـ ID صحيح
if ($property_id <= 0) {
    // يمكنك توجيه المستخدم لصفحة الخطأ أو الصفحة الرئيسية
    header("Location: index.php?error=invalid_property");
    exit();
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="UTF-8">
  <title>طلبات الحجز</title>
</head>
<body>

  <?php include 'header.php'; ?>

  <main class="booking-container">
    <h2>نموذج الحجز</h2>

    <form action="book_property.php" method="POST">
      <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property_id); ?>">

      <div class="form-group">
        <label for="name">الاسم:</label>
        <input type="text" id="name" name="name" required>
      </div>
      
      <div class="form-group">
        <label for="phone">رقم الهاتف:</label>
        <input type="text" id="phone" name="phone" required>
      </div>

      <button type="submit" class="btn">إرسال الحجز</button>
    </form>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
<?php
// عرض الأخطاء للمساعدة أثناء التطوير
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عقار - بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  
  <header>
    <h1>إضافة عقار جديد - لوحة التحكم</h1>
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

   <main class="add-property-container">
        <h2>أضف عقاراً جديداً</h2>
        <form action="save_property.php" method="POST" enctype="multipart/form-data" class="property-form">
            <div class="form-group">
                <label for="ad-title">عنوان الإعلان</label>
                <input type="text" id="ad-title" name="title" placeholder="مثال: شقة فاخرة للبيع في الخرطوم" required>
            </div>

            <div class="form-group">
                <label for="ad-description">الوصف</label>
                <textarea id="ad-description" name="description" rows="6" placeholder="وصف مفصّل للعقار..." required></textarea>
            </div>

            <div class="form-row">
              <div class="form-group">
                  <label for="ad-type">النوع</label>
                  <select id="ad-type" name="type" required>
                      <option value="">اختر نوع العقار</option>
                      <option value="بيع">بيع</option>
                      <option value="إيجار">إيجار</option>
                  </select>
              </div>

              <div class="form-group">
                  <label for="ad-category">الفئة</label>
                  <select id="ad-category" name="category" required>
                      <option value="">اختر فئة الإعلان</option>
                      <option value="apartment">شقة</option>
                      <option value="villa">فيلا</option>
                      <option value="land">أرض</option>
                      <option value="commercial_building">مبنى تجاري</option>
                      <option value="house">منزل</option>
                  </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                  <label for="ad-location">الموقع</label>
                  <input type="text" id="ad-location" name="location" placeholder="مثال: الرياض، الخرطوم" required>
              </div>
              <div class="form-group">
                  <label for="ad-price">السعر (جنيه سوداني)</label>
                  <input type="number" id="ad-price" name="price" placeholder="مثال: 5000000" required>
              </div>
            </div>

            <div class="form-group">
                <label for="ad-image">صورة العقار</label>
                <input type="file" id="ad-image" name="image" accept="image/*" required>
                <p class="helper-text">يرجى رفع صورة واحدة للعقار.</p>
            </div>

            <button type="submit" class="btn submit-btn">نشر الإعلان</button>
        </form>
   </main>

  <?php include 'footer.php'; ?>
  <script src="script.js"></script>

</body>
</html>
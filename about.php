<?php
// عرض الأخطاء للتصحيح أثناء التطوير
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>من نحن - بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>
 
  <main>
    <section class="page-hero" style="background-image: url('images/about-us-hero.jpg');">
      <div class="page-hero-content">
          <h1>من نحن</h1>
          <p><a href="index.php">الرئيسية</a> &lt;&lt; من نحن</p>
      </div>
    </section>

    <div class="about-us-container">
      <section class="about-section">
          <h2>من نحن</h2>
          <p>نحن في مجموعة بيتك العقارية نعمل على تقديم أفضل خدمات بيع وإيجار العقارات بكل احترافية وشفافية. لدينا فريق متخصص بخبرة عالية في سوق العقارات السوداني، نعمل على تلبية احتياجات عملائنا بكل ثقة.</p>
      </section>

      <section class="about-section vision">
          <h2>رؤيتنا</h2>
          <p>أن نكون الخيار الأول في مجال العقارات في السودان.</p>
      </section>

      <section class="about-section mission">
          <h2>رسالتنا</h2>
          <p>توفير عقارات مناسبة وبأسعار عادلة لجميع شرائح المجتمع.</p>
      </section>

      <section class="about-section values">
          <h2>قيمنا</h2>
          <ul>
              <li>الشفافية</li>
              <li>الثقة</li>
              <li>الالتزام</li>
              <li>الجودة</li>
          </ul>
      </section>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="script.js"></script>
</body>
</html>
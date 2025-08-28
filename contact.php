<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';

  $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);
  $stmt->execute();

  header("Location: index.php?message_sent=1");
  exit();
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا - بيتك العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <?php include 'header.php'; ?>

   <section class="page-hero" style="background-image: url('images/contact-us-hero.jpg');">
        <div class="page-hero-content">
            <h1>اتصل بنا</h1>
            <p><a href="index.php">الرئيسية</a> &lt;&lt; اتصل بنا </p>
        </div>
    </section>

    <main class="contact-container">
        
        <div class="contact-info-grid">
            <div class="info-card">
                <i class="fas fa-phone-alt contact-icon"></i>
                <h3>رقم الهاتف</h3>
                <p>+249929491796</p>
                <p>+249126966464</p>
            </div>
            <div class="info-card">
                <i class="fas fa-envelope contact-icon"></i>
                <h3>البريد الإلكتروني</h3>
                <p>ttp.mo.alshiki@gmail.com</p>
            </div>
        </div>
        
        <div class="contact-form-section">
            <form class="contact-form" action="contact_submit.php" method="POST">
                <h2>أرسل لنا رسالة</h2>
                <div class="form-group">
                    <label for="contact-name">الاسم:</label>
                    <input type="text" id="contact-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="contact-email">البريد الإلكتروني:</label>
                    <input type="email" id="contact-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact-message">الرسالة:</label>
                    <textarea id="contact-message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn-primary submit-btn">إرسال</button>
            </form>
        </div>

        <div class="social-media-section">
            <h3>تابعنا على:</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank" class="social-icon">
                    <i class="fab fa-facebook-f"></i> فيسبوك
                </a>
                <a href="https://www.instagram.com" target="_blank" class="social-icon">
                    <i class="fab fa-instagram"></i> انستجرام
                </a>
            </div>
        </div>

    </main>

    <button class="floating-contact-btn" id="openContactModal">
        <img src="icons/icon-message.png" alt="إرسال رسالة">
    </button>

    <div id="contactModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div class="contact-form-header">
                <img src="images/consultant-profile.jpg" alt="صورة المستشار" class="consultant-image">
                <h2>مستشار عقاري</h2>
                <p>alidrisitrain@gmail.com</p>
            </div>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="اسم*" required>
                </div>
                <div class="form-group">
                    <input type="email" placeholder="عنوان البريد الإلكتروني*" required>
                </div>
                <div class="form-group">
                    <input type="tel" placeholder="رقم التليفون*" required>
                </div>
                <div class="form-group">
                    <textarea placeholder="رسالة..."></textarea>
                </div>
                <button type="submit" class="submit-contact-btn">إرسال</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>
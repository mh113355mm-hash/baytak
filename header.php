<?php
// يجب أن تكون هذه الأسطر في بداية ملف header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <div class="logo-container">
        <img src="logo.png" alt="شعار بيتك">
        <div class="site-title">بيتك العقارية</div>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href="rent.php">العقارات</a></li>
            <li><a href="about.php">من نحن</a></li>
            <li><a href="contact.php">اتصل بنا</a></li>
        </ul>
    </nav>
    <div class="header-buttons">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="user_dashboard.php" class="btn">لوحة تحكمي</a>
            <a href="logout.php" class="logout-btn">تسجيل خروج</a>
        <?php elseif (isset($_SESSION['admin'])): ?>
            <a href="dashboard.php" class="btn">لوحة تحكم الأدمن</a>
            <a href="logout.php" class="logout-btn">تسجيل خروج</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">تسجيل الدخول / إنشاء حساب</a>
        <?php endif; ?>
    </div>
</header>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}
include 'connect.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $price = trim($_POST['price']);
    $type = trim($_POST['type']);
    $category = trim($_POST['category']);
    $user_id = $_SESSION['user_id']; 

    $image_path = 'images/default.jpg';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "images/" . uniqid() . '_' . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    }

    if (!empty($title) && !empty($description) && !empty($price) && !empty($type)) {
        $stmt = $conn->prepare("INSERT INTO properties (title, description, location, price, type, category, image, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssi", $title, $description, $location, $price, $type, $category, $image_path, $user_id);
        
        if ($stmt->execute()) {
            $success = "✅ تم إضافة إعلانك بنجاح.";
        } else {
            $error = "❌ حدث خطأ أثناء الإضافة: " . $conn->error;
        }
        $stmt->close();
    } else {
        $error = "⚠ يرجى تعبئة الحقول المطلوبة.";
    }
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة إعلان</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="add-ad-container">
        <h2>أضف إعلانك الخاص</h2>
        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form action="add_user_property.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">عنوان الإعلان</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">وصف الإعلان</label>
                <textarea id="description" name="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">السعر</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="type">نوع العقار</label>
                <select id="type" name="type" required>
                    <option value="">اختر النوع</option>
                    <option value="بيع">بيع</option>
                    <option value="إيجار">إيجار</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">تحديد الفئة</label>
                <select id="category" name="category" required>
                    <option value="">اختر فئة الإعلان</option>
                    <option value="apartment">شقة</option>
                    <option value="villa">فيلا</option>
                    <option value="land">أرض تجارية</option>
                    <option value="commercial_building">مبنى تجاري</option>
                    <option value="house">منزل</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">الموقع (اختياري)</label>
                <input type="text" id="location" name="location">
            </div>
            <div class="form-group">
                <label for="image">صورة الإعلان</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn">نشر الإعلان</button>
        </form>
    </main>
</body>
</html>
<?php
// ابدأ الجلسة
session_start();

// تأكد من أن المستخدم مسجل دخوله
if (!isset($_SESSION['user_id'])) {
    // يمكنك توجيهه لصفحة تسجيل الدخول إذا لم يكن مسجلاً
    header("Location: login.php");
    exit();
}

// استبدال هذا السطر بـ include 'connect.php';
include 'connect.php';

// استقبال البيانات من الفورم
$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];
$price = $_POST['price'];
$type = $_POST['type'];

// الحصول على user_id من الجلسة
$user_id = $_SESSION['user_id'];

// رفع الصورة
$image_name = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$image_path = "images/" . basename($image_name);

// نقل الصورة لمجلد images
if (move_uploaded_file($image_tmp, $image_path)) {
    // إضافة عمود user_id في الاستعلام
    $stmt = $conn->prepare("INSERT INTO properties (title, location, type, price, image, description, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

    if ($stmt) {
        $stmt->bind_param("sssiss", $title, $location, $type, $price, $image_path, $description, $user_id);

        if ($stmt->execute()) {
            echo "✅ تم حفظ العقار بنجاح.";
            echo "<br><a href='my_properties.php'>عرض إعلاناتي</a>";
        } else {
            echo "❌ حدث خطأ أثناء الحفظ: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "❌ خطأ في إعداد الاستعلام: " . $conn->error;
    }
} else {
    echo "❌ فشل رفع الصورة.";
}

$conn->close();
?>
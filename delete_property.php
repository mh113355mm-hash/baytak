<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "real_estate");
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// التأكد من وصول معرف العقار
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // حذف العقار
    $sql = "DELETE FROM properties WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // بعد الحذف، الرجوع لصفحة كل العقارات
        header("Location: all_properties.php");
        exit();
    } else {
        echo "حدث خطأ أثناء الحذف: " . $conn->error;
    }
} else {
    echo "معرف العقار غير موجود.";
}

$conn->close();
?>
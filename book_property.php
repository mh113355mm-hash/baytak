<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $property_id = $_POST['property_id'];

    $stmt = $conn->prepare("INSERT INTO bookings (name, phone, property_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $phone, $property_id);

    if ($stmt->execute()) {
        // بعد نجاح الحجز، رجّع المستخدم للصفحة الرئيسية أو اعرض رسالة
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "حدث خطأ أثناء الحجز: " . $stmt->error;
    }
}
?>
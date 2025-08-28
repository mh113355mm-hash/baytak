<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'real_estate';

// استخدام نمط OOP فقط ليكون الكود متسقاً
$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// تحديد charset للتعامل مع الحروف العربية بشكل صحيح
$conn->set_charset("utf8mb4");

// يمكنك إضافة هذه الدالة لإغلاق الاتصال عند انتهاء السكربت
// لكن PHP يغلقها تلقائيا في نهاية التنفيذ
/* function close_db_connection($conn) {
    $conn->close();
}
register_shutdown_function('close_db_connection', $conn);
*/
?>
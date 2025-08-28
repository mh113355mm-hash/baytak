<?php
include 'connect.php';

if (isset($_GET['id'])) {
  $message_id = intval($_GET['id']);

  $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
  $stmt->bind_param("i", $message_id);

  if ($stmt->execute()) {
    //  تم الحذف بنجاح
    header("Location: messages.php");
    exit();
  } else {
    echo "❌ حدث خطأ أثناء الحذف: " . $stmt->error;
  }
} else {
  echo "⚠ طلب غير صالح.";
}
?>
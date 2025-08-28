<?php
include 'connect.php';

if (isset($_GET['id'])) {
  $booking_id = intval($_GET['id']);

  $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
  $stmt->bind_param("i", $booking_id);

  if ($stmt->execute()) {
    // تم الحذف بنجاح
    header("Location: bookings.php");
    exit();
  } else {
    echo "حدث خطأ أثناء الحذف: " . $stmt->error;
  }
} else {
  echo "طلب غير صالح.";
}
?>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

include 'connect.php';

$sql = "SELECT b.id, b.name, b.phone, b.created_at, p.title AS property_title
        FROM bookings b
        JOIN properties p ON b.property_id = p.id
        ORDER BY b.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>طلبات الحجز - بيتك العقارية</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <main class="dashboard-section">
    <h2>جميع طلبات الحجز</h2>
    
    <div class="booking-list-container">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="booking-card">
          <div class="booking-info">
            <h3>طلب حجز جديد من: <?= htmlspecialchars($row['name']) ?></h3>
            <p><strong>العقار:</strong> <?= htmlspecialchars($row['property_title']) ?></p>
            <p><strong>رقم الهاتف:</strong> <?= htmlspecialchars($row['phone']) ?></p>
            <p class="timestamp"><strong>تاريخ الطلب:</strong> <?= $row['created_at'] ?></p>
          </div>
          <a href='delete_booking.php?id=<?= $row['id'] ?>' class='btn delete-btn'>🗑 حذف</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="no-bookings-message">لا توجد طلبات حجز حالياً.</p>
    <?php endif; ?>
    </div>
  </main>
  
  <?php include 'footer.php'; ?>

</body>
</html>
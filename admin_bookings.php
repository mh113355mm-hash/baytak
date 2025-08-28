<?php
include 'connect.php';

// حذف الحجز باستخدام Prepared Statement لمنع SQL Injection
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    
    // إعادة التوجيه لتجنب إعادة الإرسال عند التحديث
    header("Location: admin_bookings.php");
    exit();
}

// جلب الحجوزات
$sql = "SELECT b.id, b.name, b.phone, b.created_at, p.title AS property_title 
        FROM bookings b
        JOIN properties p ON b.property_id = p.id
        ORDER BY b.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="UTF-8">
  <title>طلبات الحجز</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>طلبات الحجز - لوحة التحكم</h1>
    <nav>
      <ul>
        <li><a href="dashboard.php">لوحة التحكم</a></li>
        <li><a href="add_property.php">إضافة عقار</a></li>
        <li><a href="all_properties.php">عرض العقارات</a></li>
        <li><a href="messages.php">الرسائل</a></li>
        <li><a href="bookings.php">الحجوزات</a></li>
      </ul>
    </nav>
  </header>

  <main class="dashboard">
    <h2>جميع طلبات الحجز</h2>
    <div class="table-container">
      <table border="1" cellpadding="10" cellspacing="0">
        <thead>
          <tr>
            <th>رقم</th>
            <th>الاسم</th>
            <th>رقم الهاتف</th>
            <th>العقار</th>
            <th>تاريخ الحجز</th>
            <th>إجراء</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['property_title']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td>
                  <a href='?delete=<?= htmlspecialchars($row['id']) ?>' class='btn-delete' onclick='return confirm("هل أنت متأكد من حذف هذا الحجز؟")'>🗑 حذف</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan='6' class="no-results">لا توجد طلبات حجز حالياً</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
  
  <footer>
    <p>© 2025 بيتك العقارية - لوحة التحكم | جميع الحقوق محفوظة</p>
  </footer>

</body>
</html>
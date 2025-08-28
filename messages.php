<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

include 'connect.php';

$query = "SELECT * FROM messages ORDER BY created DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="UTF-8">
  <title>رسائل التواصل - بيتك العقارية</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>
 
  <main class="dashboard-section">
    <h2>رسائل التواصل - لوحة التحكم</h2>
    <div class="messages-container">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="message-card">
            <h3><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)</h3>
            <p class="message-text"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <div class="message-meta">
              <small>📅 <?= $row['created'] ?></small>
              <a href="delete_message.php?id=<?= $row['id'] ?>" class="btn delete-btn">🗑 حذف</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-messages-message">لا توجد رسائل حالياً.</p>
      <?php endif; ?>
    </div>
  </main>
  
  <?php include 'footer.php'; ?>

</body>
</html>
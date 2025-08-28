<?php
include 'connect.php';

$where_clauses = ["1"];
$params = "";
$param_values = [];

if (!empty($_GET['search'])) {
  $where_clauses[] = "title LIKE ?";
  $params .= "s";
  $param_values[] = "%" . trim($_GET['search']) . "%";
}

if (!empty($_GET['type'])) {
  $where_clauses[] = "type = ?";
  $params .= "s";
  $param_values[] = trim($_GET['type']);
}

$sql = "SELECT * FROM properties WHERE " . implode(" AND ", $where_clauses) . " ORDER BY id DESC";

$stmt = $conn->prepare($sql);

if ($stmt && $params) {
  $stmt->bind_param($params, ...$param_values);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>نتائج البحث - بيتك العقارية</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <main class="search-results-container">
    <h2>نتائج البحث</h2>
    <?php if ($result->num_rows > 0): ?>
      <div class="property-grid">
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="property-card">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="property-img">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p class="location"><strong>الموقع:</strong> <?= htmlspecialchars($row['location']) ?></p>
            <p class="price"><strong>السعر:</strong> <?= number_format($row['price']) ?> SDG</p>
            <a href="details.php?id=<?= $row['id'] ?>" class="btn">عرض التفاصيل</a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>لا توجد نتائج مطابقة لبحثك.</p>
    <?php endif; ?>
  </main>
  
  <?php include 'footer.php'; ?>

</body>
</html>
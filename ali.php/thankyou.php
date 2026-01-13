<?php 
$name = $_GET['name'] ?? "Mehmon";
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Rahmat!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header style="height: 50vh;">
    <h1>Rahmat, <?= htmlspecialchars($name) ?>!</h1>
    <p>Xabaringiz muvaffaqiyatli yuborildi.</p>
    <a class="btn" href="index.php">Bosh sahifa</a>
</header>

</body>
</html>

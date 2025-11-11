<?php
// index.php
session_start();

// --- Database (SQLite) tayyorlash ---
$dbFile = __DIR__ . '/contacts.db';
$init = !file_exists($dbFile);
try {
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($init) {
        $pdo->exec("CREATE TABLE contacts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            message TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }
} catch (Exception $e) {
    die("DB error: " . htmlspecialchars($e->getMessage()));
}

// --- CSRF token ---
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// --- Form handling ---
$errors = [];
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    if (empty($_POST['csrf_token']) || !hash_equals($csrf_token, $_POST['csrf_token'])) {
        $errors[] = "So'rov tasdiqlanmadi (CSRF).";
    } else {
        // sanitize & validate
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || mb_strlen($name) < 2) {
            $errors[] = "Ism kamida 2 belgidan iborat bo'lishi kerak.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "To'g'ri email kiriting.";
        }
        if ($message === '' || mb_strlen($message) < 5) {
            $errors[] = "Xabar kamida 5 belgidan iborat bo'lishi kerak.";
        }

        if (empty($errors)) {
            // Saqlash (prepared statement)
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message
            ]);
            $success = true;
            // yangi CSRF token (optional hardening)
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $csrf_token = $_SESSION['csrf_token'];
            // clear inputs
            $name = $email = $message = '';
        }
    }
}

// --- Load latest messages (for display) ---
$messages = $pdo->query("SELECT id, name, email, message, created_at FROM contacts ORDER BY created_at DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);

// --- helper to escape output ---
function e($s) { return htmlspecialchars($s, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html>
<html lang="uz">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Kontakt forma — PHP + SQLite</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0f1724; --card:#0b1220; --accent:#7c5cff; --muted:#9aa4b2; --glass: rgba(255,255,255,0.03);
}
*{box-sizing:border-box}
body{
  font-family:Inter,system-ui,Segoe UI,Roboto,"Helvetica Neue",Arial;
  margin:0; min-height:100vh;
  background: linear-gradient(180deg,#071024 0%, #081226 60%), radial-gradient(600px 400px at 10% 10%, rgba(124,92,255,0.08), transparent 10%), radial-gradient(500px 300px at 90% 90%, rgba(0,200,255,0.03), transparent 10%);
  color:#e6eef8; padding:40px;
  display:flex; align-items:flex-start; justify-content:center;
}
.container{width:100%;max-width:980px; display:grid; grid-template-columns: 1fr 380px; gap:30px; align-items:start;}
.card{
  background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
  border:1px solid rgba(255,255,255,0.04);
  padding:22px; border-radius:12px; box-shadow: 0 6px 30px rgba(2,6,23,0.6);
}
.header{display:flex; align-items:center; gap:14px; margin-bottom:10px}
.logo{width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#00d4ff);display:flex;align-items:center;justify-content:center;font-weight:700;color:#072037}
h1{margin:0;font-size:18px}
.lead{color:var(--muted); font-size:13px; margin-top:6px}

form{display:grid; gap:12px; margin-top:8px}
input[type="text"], input[type="email"], textarea{
  width:100%; padding:12px 14px; border-radius:10px; border:1px solid rgba(255,255,255,0.04);
  background:var(--glass); color:inherit; outline:none;
  transition: box-shadow .18s, border-color .18s;
}
input:focus, textarea:focus{ box-shadow:0 4px 20px rgba(124,92,255,0.12); border-color: rgba(124,92,255,0.25) }
textarea{min-height:120px; resize:vertical; line-height:1.45}

.row{display:flex; gap:12px}
.btn{
  display:inline-block; padding:10px 14px; border-radius:10px; background:linear-gradient(90deg,var(--accent),#00d4ff);
  color:#072037; font-weight:600; border:none; cursor:pointer; box-shadow:0 6px 18px rgba(124,92,255,0.18);
}
.alert{padding:10px;border-radius:10px;background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.03); color:var(--muted)}
.err{background:rgba(255,40,40,0.06); border-color: rgba(255,40,40,0.12); color:#ffc7c7}
.success{background:rgba(40,255,120,0.06); border-color: rgba(40,255,120,0.12); color:#d6ffea}

.list{display:flex;flex-direction:column;gap:10px; margin-top:12px}
.item{padding:12px;border-radius:8px;background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.03)}
.meta{font-size:12px;color:var(--muted); margin-bottom:6px}
.small{font-size:13px;color:var(--muted)}
.footer{margin-top:18px;font-size:13px;color:var(--muted);text-align:center}
@media (max-width:920px){ .container{grid-template-columns: 1fr; } .header{gap:10px} }
</style>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="header">
      <div class="logo">CZ</div>
      <div>
        <h1>Biz bilan bog‘laning</h1>
        <div class="lead">Sizning xabaringiz biz uchun muhim. Oddiy, tez va xavfsiz — PHP + SQLite.</div>
      </div>
    </div>

    <?php if ($success): ?>
      <div class="alert success">Xabaringiz yuborildi! Rahmat ✨</div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="alert err">
        <strong>Xatoliklar:</strong>
        <ul>
          <?php foreach ($errors as $err): ?>
            <li><?php echo e($err); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" novalidate>
      <input type="hidden" name="csrf_token" value="<?php echo e($csrf_token); ?>">
      <div class="row">
        <input type="text" name="name" placeholder="Ismingiz" value="<?php echo e($name ?? ''); ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo e($email ?? ''); ?>" required>
      </div>
      <textarea name="message" placeholder="Xabaringiz..." required><?php echo e($message ?? ''); ?></textarea>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px">
        <div class="small">Maxsus: bu demo ilova. Headerlar soxtalashtirilishi mumkin.</div>
        <button class="btn" type="submit">Yuborish</button>
      </div>
    </form>

    <div class="footer">Ro'yxat — oxirgi 10 xabar</div>
    <div class="list">
      <?php if (empty($messages)): ?>
        <div class="item small">Hozircha xabar yo‘q.</div>
      <?php else: ?>
        <?php foreach ($messages as $m): ?>
          <div class="item">
            <div class="meta"><?php echo e($m['name']); ?> • <?php echo e(date('Y-m-d H:i', strtotime($m['created_at']))); ?></div>
            <div><?php echo nl2br(e($m['message'])); ?></div>
            <div class="small" style="margin-top:8px;color:var(--muted)"><?php echo e($m['email']); ?></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="card">
    <h2 style="margin-top:0">Nimani yaxshilash mumkin?</h2>
    <ul class="small" style="color:var(--muted);line-height:1.6">
      <li>Captcha yoki rate-limit qo‘shish (spamga qarshi).</li>
      <li>Admin panel (login bilan) xabarlarni boshqarish uchun.</li>
      <li>Mail yuborish — SMTP orqali foydalanuvchini xabarnoma yuborish.</li>
      <li>Ma'lumotlarni eksport qilish (CSV).</li>
    </ul>
    <div style="height:16px"></div>
    <div class="alert">Ishlab ko‘rish uchun formaga xabar yuboring — SQLite fayli `contacts.db` katalogda yaratiladi.</div>
  </div>
</div>
</body>
</html>
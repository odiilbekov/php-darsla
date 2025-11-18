<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Faylga saqlash (log)
    $data = "Ism: $name | Email: $email | Xabar: $message\n";
    file_put_contents("messages.txt", $data, FILE_APPEND);

    // Email yuborishni ham qo‘shsa bo‘ladi (agar xohlasangiz ayting)
    
    header("Location: thankyou.php?name=" . urlencode($name));
    exit;
} else {
    echo "Xatolik: Forma noto‘g‘ri yuborildi!";
}

<?php
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=UTF-8');

function fix_encoding($text) {
    if (!mb_check_encoding($text, 'UTF-8')) {
        $converted = mb_convert_encoding($text, 'UTF-8', 'Windows-1251');
        if (mb_check_encoding($converted, 'UTF-8')) {
            return $converted;
        }
        return mb_convert_encoding($text, 'UTF-8', 'ISO-8859-1');
    }
    return $text;
}

$name = fix_encoding(trim($_POST['name'] ?? ''));
$phone = fix_encoding(trim($_POST['phone'] ?? ''));
$email = fix_encoding(trim($_POST['email'] ?? ''));
$items = fix_encoding(trim($_POST['items'] ?? ''));
$address = fix_encoding(trim($_POST['address'] ?? ''));

$to = "smusroman@gmail.com";

$subject = "Нове замовлення з сайту";
$message = "Ім’я: $name\nТелефон: $phone\nEmail: $email\nТовари: $items\nАдреса: $address";

$headers = "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: Сайт <no-reply@yourdomain.com>\r\n";

$success = mb_send_mail($to, $subject, $message, $headers);

if ($success) {
    echo "✅ Дякуємо! Замовлення надіслано.";
} else {
    echo "❌ Вибачте, сталася помилка при надсиланні.";
}
?>

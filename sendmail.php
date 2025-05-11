<?php
// Встановлюємо UTF-8 для внутрішніх операцій
mb_internal_encoding("UTF-8");

// Встановлюємо заголовок, щоб браузер розумів кодування
header('Content-Type: text/html; charset=UTF-8');

// Функція виправлення кодування, якщо дані прийшли не в UTF-8
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

// Отримуємо дані з POST і фіксимо кодування
$name = fix_encoding(trim($_POST['name'] ?? ''));
$phone = fix_encoding(trim($_POST['phone'] ?? ''));
$email = fix_encoding(trim($_POST['email'] ?? ''));
$items = fix_encoding(trim($_POST['items'] ?? ''));
$address = fix_encoding(trim($_POST['address'] ?? ''));

// Тема та тіло листа
$subject = "Нове замовлення з сайту";
$message = "Нове замовлення:\n\n";
$message .= "Ім'я: $name\n";
$message .= "Телефон: $phone\n";
$message .= "Email: $email\n";
$message .= "Адреса: $address\n";
$message .= "Товари:\n$items\n";

// Email одержувача
$to = "smusroman@gmail.com"; // заміни на свій email

// Заголовки з кодуванням UTF-8
$headers = "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: Сайт <no-reply@yourdomain.com>\r\n";

// Надсилання листа
$success = mb_send_mail($to, $subject, $message, $headers);

// Вивід результату
if ($success) {
    echo "✅ Дякуємо! Замовлення надіслано.";
} else {
    echo "❌ Вибачте, сталася помилка при надсиланні.";
}
?>

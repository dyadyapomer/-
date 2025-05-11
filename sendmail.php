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

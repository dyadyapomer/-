<?php
// Функція перевірки та виправлення кодування
function fix_encoding($text) {
    if (!mb_check_encoding($text, 'UTF-8')) {
        return mb_convert_encoding($text, 'UTF-8', 'Windows-1251'); // або 'ISO-8859-1'
    }
    return $text;
}

// Отримання та обробка даних
$name = fix_encoding(trim($_POST['name']));
$phone = fix_encoding(trim($_POST['phone']));
$email = fix_encoding(trim($_POST['email'] ?? '')); // не обов'язково
$items = fix_encoding(trim($_POST['items']));
$address = fix_encoding(trim($_POST['address']));

// Тема листа
$subject = "Нове замовлення з сайту";

// Формування повідомлення
$message = "Нове замовлення:\n\n";
$message .= "Ім'я: $name\n";
$message .= "Телефон: $phone\n";
$message .= "Email: $email\n";
$message .= "Адреса: $address\n";
$message .= "Замовлення:\n$items\n";

// Email одержувача
$to = "smusroman@gmail.com"; // заміни на свою адресу

// Заголовки
$headers = "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: Сайт <no-reply@yourdomain.com>\r\n";

// Встановити UTF-8 як внутрішнє кодування
mb_internal_encoding("UTF-8");

// Надсилання
$success = mb_send_mail($to, $subject, $message, $headers);

// Відповідь
if ($success) {
    echo "Дякуємо! Замовлення надіслано.";
} else {
    echo "Вибачте, сталася помилка при надсиланні.";
}
?>>

<?php
// Налаштування
$to = "smusroman@gmail.com"; // твоя пошта
$subject = "Замовлення з сайту";

// Дані з форми
$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$order = htmlspecialchars($_POST['order']);

// Текст листа
$message = "Нове замовлення:\n\n";
$message .= "Ім'я: $name\n";
$message .= "Телефон: $phone\n";
$message .= "Email: $email\n";
$message .= "Замовлення:\n$order\n";

// Заголовки
$headers = "Content-type: text/plain; charset=UTF-8" . "\r\n";
$headers .= "From: $name <$email>" . "\r\n";

mb_internal_encoding("UTF-8");
mb_send_mail($to, $subject, $message, $headers);

// Підтвердження
echo "Дякуємо! Ваше замовлення надіслано.";
?>

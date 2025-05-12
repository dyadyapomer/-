<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "smusroman@gmail.com";  // Твоя пошта
    $subject = "Нове замовлення з сайту МилоМанія";

    $items = trim($_POST["items"]);
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);

    $message = "Обрані товари: $items\n"
             . "Я: $name\n"
             . "$phone\n"
             . "$address";

    $headers = "From: no-reply@milomania.com.ua" . "\r\n" .
               "Content-Type: text/plain; charset=utf-8";

    // Надсилання листа
    if (mail($to, $subject, $message, $headers)) {
        echo "Дякуємо! Ваше замовлення надіслано.";
    } else {
        echo "Сталася помилка. Спробуйте ще раз.";
    }
} else {
    echo "Доступ заборонено.";
}
?>

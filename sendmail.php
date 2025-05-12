<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $to = "smusroman@gmail.com";  // Сюди прийде лист
  $subject = "Нове замовлення з сайту МилоМанія";

  $message = "Обрані товари: " . $_POST['items'] . "\n"
           . "Ім'я: " . $_POST['name'] . "\n"
           . "Телефон: " . $_POST['phone'] . "\n"
           . "Адреса доставки: " . $_POST['address'];

  $headers = "From: no-reply@milomania.com.ua\r\n";
  $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

  if (mail($to, $subject, $message, $headers)) {
    echo "<h1>Дякуємо за замовлення!</h1>";
  } else {
    echo "<h1>Сталася помилка. Спробуйте ще раз.</h1>";
  }
}
?>

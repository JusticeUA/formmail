<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Перевірка заповненості полів імя та телефон
    if (empty($name) || empty($phone)) {
        http_response_code(400);
        echo "Будь ласка, заповніть поля імя та телефон.";
        exit;
    }

    // Електронна адреса, на яку буде відправлено повідомлення
    $to_email = "vasya.ganec@gmail.com";

    // Тема повідомлення
    $subject = "Нова форма зворотного зв'язку";

    // Тіло повідомлення
    $body = "Ім'я: " . $name . "\n";
    $body .= "Телефон: " . $phone . "\n";
    $body .= "Повідомлення: " . $message . "\n";

    // Заголовки для відправки електронної пошти
    $headers = "From: your_email@example.com" . "\r\n";
    $headers .= "Reply-To: " . $name . " <" . $to_email . ">" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

    // Відправлення електронної пошти
    if (mail($to_email, $subject, $body, $headers)) {
        http_response_code(200);
        echo "Дані відправлені успішно!";
    } else {
        http_response_code(500);
        echo "Сталася помилка при відправці даних.";
    }
} else {
    http_response_code(400);
    echo "Помилка: невірний метод запиту.";
}

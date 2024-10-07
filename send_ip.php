<?php
// Получаем данные из POST запроса
$data = json_decode(file_get_contents('php://input'), true);

// Проверяем, что IP был передан
if (isset($data['ip'])) {
    $userIp = $data['ip'];

    // Замените 'YOUR_BOT_TOKEN' на токен вашего Telegram бота
    $botToken = "YOUR_BOT_TOKEN";
    // Замените 'YOUR_CHAT_ID' на ваш chat_id в Telegram
    $chatId = "YOUR_CHAT_ID";

    // Формируем сообщение
    $message = "Новый посетитель с IP-адресом: " . $userIp;

    // URL для отправки сообщения через Telegram API
    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    // Параметры запроса
    $postData = [
        'chat_id' => $chatId,
        'text'    => $message,
    ];

    // Инициализируем cURL сессию
    $ch = curl_init();

    // Настройки cURL
    curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Выполняем запрос
    $response = curl_exec($ch);

    // Закрываем cURL сессию
    curl_close($ch);

    // Отправляем успешный ответ
    echo json_encode(['status' => 'success']);
} else {
    // Отправляем ошибку, если IP не был передан
    echo json_encode(['status' => 'error', 'message' => 'IP не был передан']);
}
?>
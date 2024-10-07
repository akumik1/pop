<?php
// �������� ������ �� POST �������
$data = json_decode(file_get_contents('php://input'), true);

// ���������, ��� IP ��� �������
if (isset($data['ip'])) {
    $userIp = $data['ip'];

    // �������� 'YOUR_BOT_TOKEN' �� ����� ������ Telegram ����
    $botToken = "YOUR_BOT_TOKEN";
    // �������� 'YOUR_CHAT_ID' �� ��� chat_id � Telegram
    $chatId = "YOUR_CHAT_ID";

    // ��������� ���������
    $message = "����� ���������� � IP-�������: " . $userIp;

    // URL ��� �������� ��������� ����� Telegram API
    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    // ��������� �������
    $postData = [
        'chat_id' => $chatId,
        'text'    => $message,
    ];

    // �������������� cURL ������
    $ch = curl_init();

    // ��������� cURL
    curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // ��������� ������
    $response = curl_exec($ch);

    // ��������� cURL ������
    curl_close($ch);

    // ���������� �������� �����
    echo json_encode(['status' => 'success']);
} else {
    // ���������� ������, ���� IP �� ��� �������
    echo json_encode(['status' => 'error', 'message' => 'IP �� ��� �������']);
}
?>
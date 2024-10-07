<?php
// Ïîëó÷àåì äàííûå èç POST çàïðîñà
$data = json_decode(file_get_contents('php://input'), true);

// Ïðîâåðÿåì, ÷òî IP áûë ïåðåäàí
if (isset($data['ip'])) {
    $userIp = $data['ip'];

    // Çàìåíèòå 'YOUR_BOT_TOKEN' íà òîêåí âàøåãî Telegram áîòà
    $botToken = "7539465649:AAEJLhvN4ltTiOQL99Vtq6k0OLXGGsG3cgw";
    // Çàìåíèòå 'YOUR_CHAT_ID' íà âàø chat_id â Telegram
    $chatId = "1206254100 ";

    // Ôîðìèðóåì ñîîáùåíèå
    $message = "Íîâûé ïîñåòèòåëü ñ IP-àäðåñîì: " . $userIp;

    // URL äëÿ îòïðàâêè ñîîáùåíèÿ ÷åðåç Telegram API
    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    // Ïàðàìåòðû çàïðîñà
    $postData = [
        'chat_id' => $chatId,
        'text'    => $message,
    ];

    // Èíèöèàëèçèðóåì cURL ñåññèþ
    $ch = curl_init();

    // Íàñòðîéêè cURL
    curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Âûïîëíÿåì çàïðîñ
    $response = curl_exec($ch);

    // Çàêðûâàåì cURL ñåññèþ
    curl_close($ch);

    // Îòïðàâëÿåì óñïåøíûé îòâåò
    echo json_encode(['status' => 'success']);
} else {
    // Îòïðàâëÿåì îøèáêó, åñëè IP íå áûë ïåðåäàí
    echo json_encode(['status' => 'error', 'message' => 'IP íå áûë ïåðåäàí']);
}
?>

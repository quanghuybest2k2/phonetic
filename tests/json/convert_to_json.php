<?php

$fileName = "test";

if (!file_exists($fileName . '.txt')) {
    die('Lỗi: File không tồn tại.');
}

// Đọc nội dung từ $fileName.txt
$fileContent = file_get_contents($fileName . '.txt');

$lines = explode("\n", $fileContent);

$data = [];

foreach ($lines as $line) {
    // từ -> phiên âm
    $parts = explode("\t", $line);

    if (count($parts) === 2) {
        // Lưu vào mảng
        $data[$parts[0]] = $parts[1];
    }
}

// chuyền thành json
$jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

echo $jsonData;

// Lưu
file_put_contents($fileName . '.json', $jsonData);

echo 'Chuyển đổi thành công.';

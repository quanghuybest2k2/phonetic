<?php

$fileName = "test";
$resultDir = 'result';

// nếu không có thì tạo
if (!is_dir($resultDir)) {
    mkdir($resultDir);
}

$jsonData = file_get_contents($fileName . '.json');

$data = json_decode($jsonData, true);

if ($data === null) {
    die('Không thể chuyển đổi JSON.');
}

foreach ($data as $key => $value) {
    $firstLetter = strtolower(substr($key, 0, 1));

    $fileName = $resultDir . '/' . $firstLetter . '.json';

    if (file_exists($fileName)) {
        // Nếu đã tồn tại, thêm dữ liệu mới vào file
        $existingData = json_decode(file_get_contents($fileName), true);
        $existingData[$key] = $value;
        file_put_contents($fileName, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    } else {
        // Nếu chưa tồn tại, tạo mới file và thêm dữ liệu
        file_put_contents($fileName, json_encode([$key => $value], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}

echo 'Quá trình tách file thành công.';

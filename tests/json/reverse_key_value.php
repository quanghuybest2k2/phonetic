<?php

// Đọc nội dung từ file vi.json
$fileName = "vi.json";

if (!file_exists($fileName)) {
    die("Không tồn tại file $fileName!");
}

$viContent = file_get_contents($fileName);

// Chuyển đổi JSON sang mảng
$viArray = json_decode($viContent, true);

// Đảo ngược key và value
$enArray = array_flip($viArray);

// Chuyển đổi lại thành JSON
$enContent = json_encode($enArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

file_put_contents('en.json', $enContent);

echo "Đã chuyển đổi và xuất sang file en.json thành công.";

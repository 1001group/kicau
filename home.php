<?php
// Mapping kode "to" ke money & white page
$routes = [
    'adsbm1' => [
        'money' => 'https://wede.tanpabatas.site/register?referral_code=facebook',
        'white' => 'index.html',
    ],
    // Bisa tambah kode lain:
    // 'adsbm2' => [
    //     'money' => 'https://example.com/offer-2',
    //     'white' => 'https://example.com/white-2',
    // ],
];

// Ambil parameter to (kalau kosong, pakai default adsbm1)
$to = isset($_GET['to']) ? trim($_GET['to']) : '';

if ($to === '' || !isset($routes[$to])) {
    // fallback: bisa pilih mau ke white atau money, di sini aku pakai white
    $to = 'adsbm1';
}

// Ambil User-Agent
$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

// Deteksi mobile sangat simpel (lebih longgar)
$isMobile = false;
if ($userAgent !== '') {
    if (preg_match('/Android|iPhone|iPad|iPod|Mobile/i', $userAgent)) {
        $isMobile = true;
    }
}

// Logic:
// - Semua MOBILE → money page
// - Semua NON-MOBILE → white page
if ($isMobile) {
    $target = $routes[$to]['money'];
} else {
    $target = $routes[$to]['white'];
}

// Redirect ke tujuan akhir
header('Location: ' . $target, true, 302);
exit;

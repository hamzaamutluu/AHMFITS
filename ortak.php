<?php
// Bütün sayfaların kullandığı oturum ve bilgiler.
session_start();
date_default_timezone_set('Europe/Istanbul');

// HTML içine yazılan metinleri güvenli biçimde gösterir.
function temiz($metin) {
    return htmlspecialchars((string) $metin, ENT_QUOTES, 'UTF-8');
}

// Form ve adres çubuğundan gelen bir metni alır.
function metinAl($alanlar, $ad) {
    if (isset($alanlar[$ad]) && is_string($alanlar[$ad])) {
        return trim($alanlar[$ad]);
    }
    return '';
}

$bugun = date('Y-m-d');
$branslar = ['Fitness', 'Powerlifting', 'Pilates', 'Kardiyo'];
$normalPaketler = ['Aylık', '3 Aylık', 'Yıllık'];
$pilatesPaketler = ['4 Seans', '8 Seans', '12 Seans'];
$butunPaketler = array_merge($normalPaketler, $pilatesPaketler);

// Önceki sürümden kalan oturumdaki üyeler de korunur.
if (!isset($_SESSION['uyeler'])) {
    $_SESSION['uyeler'] = [
        ['ad' => 'Ali Hamza Mutlu', 'paket' => 'Aylık', 'bitis' => '2026-10-31'],
        ['ad' => 'Muhammet Talha Korkmaz', 'paket' => '3 Aylık', 'bitis' => '2026-11-30'],
        ['ad' => 'Salih Çarpı', 'paket' => 'Aylık', 'bitis' => '2026-09-30'],
        ['ad' => 'Mehmet Yağız Altunsoy', 'paket' => 'Yıllık', 'bitis' => '2026-12-31'],
        ['ad' => 'Berat Ateş', 'paket' => 'Aylık', 'bitis' => '2026-10-20']
    ];
}

// Her üyenin değişmeyen bir kayıt numarası olsun.
$sonNumara = 0;
foreach ($_SESSION['uyeler'] as $uye) {
    if (isset($uye['id']) && $uye['id'] > $sonNumara) {
        $sonNumara = $uye['id'];
    }
}
foreach ($_SESSION['uyeler'] as $sira => $uye) {
    if (!isset($uye['id'])) {
        $sonNumara++;
        $_SESSION['uyeler'][$sira]['id'] = $sonNumara;
    }
    if (!isset($uye['brans'])) {
        $_SESSION['uyeler'][$sira]['brans'] = 'Fitness';
    }
    if (!isset($uye['pilates_turu'])) {
        $_SESSION['uyeler'][$sira]['pilates_turu'] = '';
    }
}
if (!isset($_SESSION['son_numara']) || $_SESSION['son_numara'] < $sonNumara) {
    $_SESSION['son_numara'] = $sonNumara;
}

if (!isset($_SESSION['form_anahtari'])) {
    $_SESSION['form_anahtari'] = bin2hex(random_bytes(16));
}

// Bütün POST işlemlerinde bu kontrol kullanılır.
function formGecerli() {
    $anahtar = metinAl($_POST, 'form_anahtari');
    return hash_equals($_SESSION['form_anahtari'], $anahtar);
}

// Form gönderildikten sonra yönlendirme: yenilemede tekrar kayıt olmaz.
function yonlendir($adres, $mesaj) {
    $_SESSION['bildirim'] = $mesaj;
    $_SESSION['form_anahtari'] = bin2hex(random_bytes(16));
    header('Location: ' . $adres, true, 303);
    exit;
}

$bildirim = $_SESSION['bildirim'] ?? '';
unset($_SESSION['bildirim']);
$uyeler = $_SESSION['uyeler'];
$aktifSayisi = 0;
foreach ($uyeler as $uye) {
    if ($uye['bitis'] >= $bugun) {
        $aktifSayisi++;
    }
}
$toplamUye = count($uyeler);
$suresiDolan = $toplamUye - $aktifSayisi;

// Fotoğrafları değiştirmek için aşağıdaki adresleri değiştirebilirsin.
// Kendi fotoğrafın varsa örneğin: 'resimler/fitness.jpg' yaz.
$resimler = [
    'Fitness' => 'https://images.unsplash.com/photo-1646072508462-a802209a16f3?auto=format&fit=crop&w=1200&q=80',
    'Powerlifting' => 'https://images.unsplash.com/photo-1521804906057-1df8fdb718b7?auto=format&fit=crop&w=1200&q=80',
    'Pilates' => 'https://images.unsplash.com/photo-1754258167836-6878c54e316c?auto=format&fit=crop&w=1200&q=80',
    'Kardiyo' => 'https://images.unsplash.com/photo-1578763363228-6e8428de69b2?auto=format&fit=crop&w=1200&q=80',
    'Salon' => 'https://images.unsplash.com/photo-1758448756350-3d0eec02ba37?auto=format&fit=crop&w=1600&q=80',
    'Stüdyo' => 'https://images.unsplash.com/photo-1761971975962-9cc397e2ba2a?auto=format&fit=crop&w=1200&q=80'
];

$aciklamalar = [
    'Fitness' => 'Serbest ağırlıklar ve makinelerle kendi antrenman düzenini oluştur. Başlangıçtan ileri seviyeye kadar hedeflerine uygun bir tempo seç.',
    'Powerlifting' => 'Squat, bench press ve deadlift odaklı bir antrenman alanı. Teknik çalışmalara ve düzenli ilerlemeye odaklan.',
    'Pilates' => 'Mat Pilates veya Reformer Pilates seçeneğini keşfet. Sana uygun seans paketini seçerek üyeliğini oluştur.',
    'Kardiyo' => 'Koşu bandı, bisiklet ve kondisyon çalışmaları için hareketli bir alan. Kendi tempona uygun bir başlangıç yap.'
];

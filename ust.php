<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AHMFİTS: spor dalları, Pilates paketleri ve üyelik takip projesi.">
    <title><?= temiz($baslik) ?> | AHMFİTS</title>
    <link rel="stylesheet" href="stil.css?v=4">
    <script>
        document.documentElement.classList.add('js');
        // Sayfa açılmadan temayı uygula; sayfalar arasında seçim korunur.
        try {
            if (localStorage.getItem('tema') === 'acik') {
                document.documentElement.classList.add('acik-tema');
            }
        } catch (hata) {}
    </script>
</head>
<body>
<a class="atla" href="#icerik">İçeriğe geç</a>
<header>
    <div class="menu">
        <a href="index.php" class="logo yeni-logo ahm-logo" aria-label="AHMFİTS ana sayfa"><span class="marka-logotype"><span class="marka-ahm">AHM</span><span class="marka-fits">FİTS</span></span><small>GÜÇ · DENGE · HAREKET</small></a>
        <button type="button" class="menu-ac" id="menu-ac" aria-expanded="false" aria-controls="ana-menu"><span aria-hidden="true">☰</span> Menü</button>
        <nav aria-label="Ana menü" id="ana-menu" class="menu-nav">
            <?php
            $menu = [
                'index.php' => 'Ana Sayfa',
                'salon.php' => 'Salon',
                'sporlar.php' => 'Spor Dalları',
                'pilates.php' => 'Pilates',
                'program.php' => 'Ders Programı',
                'uyeler.php' => 'Üye Yönetimi'
            ];
            foreach ($menu as $adres => $yazi) {
            ?>
                <a href="<?= temiz($adres) ?>" <?php if ($sayfa == $adres) { echo 'class="secili" aria-current="page"'; } ?>>
                    <?= temiz($yazi) ?>
                </a>
            <?php } ?>
        </nav>
        <a class="menu-uyelik <?= $sayfa == 'uyelik.php' ? 'uyelik-secili' : '' ?>" href="uyelik.php" <?php if ($sayfa == 'uyelik.php') { echo 'aria-current="page"'; } ?>>Üyelik Oluştur <span aria-hidden="true">↗</span></a>
    </div>
    <div class="menu-alt"><span>KENDİNE AYIRDIĞIN ZAMAN, EN İYİ BAŞLANGIÇ.</span><a href="program.php">Bu haftanın derslerini keşfet <span aria-hidden="true">→</span></a></div>
</header>
<main id="icerik">
    <?php if ($bildirim != '') { ?>
        <div class="mesaj basari" role="status"><?= temiz($bildirim) ?></div>
    <?php } ?>

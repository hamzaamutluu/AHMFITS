<?php
require 'ortak.php';
$baslik = 'Ders Programı';
$sayfa = 'program.php';
// Ders bilgilerini bu diziden değiştirebilirsin.
// Her satır bir dersi temsil eder.
$dersler = [
    ['gun' => 'Pazartesi', 'saat' => '10.00', 'brans' => 'Pilates', 'ad' => 'Mat Pilates', 'egitmen' => 'Eğitmen A', 'sure' => '45 dk', 'seviye' => 'Başlangıç', 'aciklama' => 'Mat üzerinde kontrollü hareketlere ve ders akışına odaklanan bir başlangıç.', 'detay' => 'Örnek ders akışı: kısa hazırlık, mat üzerinde hareket çalışmaları ve kapanış. Yanına rahat kıyafet, havlu ve su alabilirsin.'],
    ['gun' => 'Salı', 'saat' => '18.00', 'brans' => 'Powerlifting', 'ad' => 'Temel Kaldırış Teknikleri', 'egitmen' => 'Eğitmen B', 'sure' => '60 dk', 'seviye' => 'Orta', 'aciklama' => 'Squat, bench press ve deadlift hareketlerini tanımaya ayrılmış teknik çalışma.', 'detay' => 'Örnek ders akışı: ısınma, hareketlerin teknik aşamaları ve çalışma değerlendirmesi. Kullanılacak ağırlığı ve hareket seviyesini eğitmenle birlikte belirle.'],
    ['gun' => 'Çarşamba', 'saat' => '11.00', 'brans' => 'Pilates', 'ad' => 'Reformer Pilates', 'egitmen' => 'Eğitmen A', 'sure' => '50 dk', 'seviye' => 'Başlangıç', 'aciklama' => 'Reformer ekipmanını tanı, kontrollü ve sana uygun bir tempoyla çalış.', 'detay' => 'Örnek ders akışı: ekipman tanıtımı, kontrollü hareketler ve kapanış. İlk kez katılacaksan ekipman kullanımıyla ilgili sorularını ders öncesinde eğitmene sor.'],
    ['gun' => 'Perşembe', 'saat' => '19.00', 'brans' => 'Fitness', 'ad' => 'Tüm Vücut Antrenmanı', 'egitmen' => 'Eğitmen C', 'sure' => '55 dk', 'seviye' => 'Her seviye', 'aciklama' => 'Serbest ağırlık ve makinelerle farklı hareket alanlarını bir araya getir.', 'detay' => 'Örnek ders akışı: genel ısınma, farklı antrenman istasyonları ve kapanış. Hareket alternatiflerini ve ekipman ayarlarını eğitmenle görüşebilirsin.'],
    ['gun' => 'Cuma', 'saat' => '17.00', 'brans' => 'Kardiyo', 'ad' => 'Kondisyon ve Ritim', 'egitmen' => 'Eğitmen C', 'sure' => '40 dk', 'seviye' => 'Her seviye', 'aciklama' => 'Koşu bandı ve kondisyon çalışmalarıyla haftana hareketli bir ara ver.', 'detay' => 'Örnek ders akışı: tempolu hazırlık, kondisyon istasyonları ve yavaşlayarak kapanış. Kendi tempona uygun çalışma seçeneklerini eğitmenle belirle.'],
    ['gun' => 'Cumartesi', 'saat' => '12.00', 'brans' => 'Pilates', 'ad' => 'Hafta Sonu Mat Pilates', 'egitmen' => 'Eğitmen A', 'sure' => '45 dk', 'seviye' => 'Her seviye', 'aciklama' => 'Hafta sonuna nefese ve kontrollü harekete zaman ayırarak başla.', 'detay' => 'Örnek ders akışı: kısa hazırlık, mat üzerinde hareketler ve kapanış. Ders türü, ekipman ve hazırlık hakkında eğitmeninden bilgi alabilirsin.']
];
$gunler = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];
require 'ust.php';
?>
<section class="ders-tanitim"><div><p class="etiket">THE WEEKLY EDIT / DERS PROGRAMI</p><h1>Haftana hareket.<br><em>Kendine zaman.</em></h1><p>Gününü seç, branşını bul. Süreleri, seviyeleri ve ders içeriklerini inceleyerek antrenman haftanı planla.</p><div class="program-ozeti"><span>04 branş</span><span>06 örnek ders</span><span>40–60 dakika</span></div></div><figure><img src="<?= temiz($resimler['Stüdyo']) ?>" alt="Derslere ayrılmış örnek bir mat stüdyosu"><figcaption>HER HAFTA YENİ BİR BAŞLANGIÇ ↗</figcaption></figure></section>

<section class="ders-planlayici" aria-labelledby="program-baslik">
    <div class="ders-liste-baslik"><div><p class="etiket">SENİN PROGRAMIN, SENİN TEMPON</p><h2 id="program-baslik">Bu haftanın dersleri.</h2></div><p class="not">Program örnektir; seçimler rezervasyon oluşturmaz.</p></div>

    <div class="gun-secimi" role="group" aria-label="Ders gününü seç">
        <button type="button" data-gun="" aria-pressed="true">Tüm hafta</button>
        <?php foreach ($gunler as $gun) { ?><button type="button" data-gun="<?= temiz($gun) ?>" aria-pressed="false"><?= temiz($gun) ?></button><?php } ?>
    </div>

    <div class="ders-araclari"><div><label for="ders-brans">Spor dalı</label><select id="ders-brans"><option value="">Bütün branşlar</option><?php foreach ($branslar as $brans) { ?><option value="<?= temiz($brans) ?>"><?= temiz($brans) ?></option><?php } ?></select></div><p id="ders-sonuc" role="status"><?= count($dersler) ?> ders gösteriliyor</p><button id="ders-temizle" type="button" class="filtre-temizle">Filtreleri temizle ↺</button></div>

    <div class="ders-kartlari">
    <?php foreach ($dersler as $ders) {
        $dersResmi = $ders['brans'];
        if ($ders['brans'] == 'Pilates' && !str_contains($ders['ad'], 'Reformer')) {
            $dersResmi = 'Stüdyo';
        }
    ?>
        <article class="ders-karti" data-ders="<?= temiz($ders['brans']) ?>" data-ders-gun="<?= temiz($ders['gun']) ?>">
            <div class="ders-gorsel"><img src="<?= temiz($resimler[$dersResmi]) ?>" alt="<?= temiz($ders['brans']) ?> dersine ait örnek görsel" loading="lazy"><span><?= temiz($ders['brans']) ?></span></div>
            <div class="ders-icerik"><div class="ders-ust"><p class="ders-zaman"><?= temiz($ders['gun']) ?><span>/</span><strong><?= temiz($ders['saat']) ?></strong></p><span class="ders-sure"><?= temiz($ders['sure']) ?></span></div><h3><?= temiz($ders['ad']) ?></h3><p class="ders-aciklama"><?= temiz($ders['aciklama']) ?></p><div class="ders-bilgileri"><span><b>SEVİYE</b><?= temiz($ders['seviye']) ?></span><span><b>EĞİTMEN</b><?= temiz($ders['egitmen']) ?></span></div>
                <details class="ders-detay"><summary>Dersin içinde neler var? <span>+</span></summary><p><?= temiz($ders['detay']) ?></p></details>
            </div>
            <div class="ders-islem"><a href="uyelik.php?brans=<?= urlencode($ders['brans']) ?><?= $ders['brans'] == 'Pilates' ? '&tur=' . urlencode(str_contains($ders['ad'], 'Reformer') ? 'Reformer Pilates' : 'Mat Pilates') : '' ?>" class="ders-katil"><?= temiz($ders['brans']) ?> üyeliği <span>↗</span></a><span class="ders-kayit-not">Branş kayıt formuna gider</span></div>
        </article>
    <?php } ?>
    </div>
    <div id="ders-bos" class="ders-bos" hidden><span aria-hidden="true">↗</span><h3>Bu seçimde ders bulunmuyor.</h3><p>Başka bir gün veya branş seçebilirsin. Pazar günü için örnek ders tanımlanmadı.</p></div>
</section>
<section class="ders-hazirlik"><p class="etiket">DERSTEN ÖNCE KÜÇÜK BİR HAZIRLIK</p><div class="uc-sutun"><article><span>01 / HAZIRLAN</span><h3>Çantanı hazırla.</h3><p>Rahat spor kıyafeti, kişisel havlu ve su matarasıyla gel.</p></article><article><span>02 / ZAMAN AYIR</span><h3>Akışa alış.</h3><p>İlk dersinden önce alanı ve ekipmanı tanımak için biraz zaman ayır.</p></article><article><span>03 / SORULARINI SOR</span><h3>Dersini tanı.</h3><p>Hareket ve ekipman seçenekleriyle ilgili sorularını eğitmene yönelt.</p></article></div></section>
<section class="cagri"><div><h2>Sana uygun alanı buldun mu?</h2><p>Branşını seçerek üyelik kaydını oluşturabilirsin.</p></div><a class="buton" href="uyelik.php">Üyelik oluştur ↗</a></section>
<?php require 'alt.php'; ?>

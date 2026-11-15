<?php
require 'ortak.php';
$baslik = 'Salonu Keşfet';
$sayfa = 'salon.php';
require 'ust.php';
?>
<div class="sayfa-baslik"><p class="etiket">THE SPACE / AHMFİTS</p><h1>İyi hissetmeye<br><em>yer aç.</em></h1><p>Antrenmandan önce seni karşılayan şey alanın kendisi. Farklı tempolara ayrılmış bölümleri ve stüdyo deneyimini keşfet.</p></div>
<section class="salon-panorama"><img src="<?= temiz($resimler['Salon']) ?>" alt="Aydınlık bir spor salonunun örnek iç mekân görünümü"><div><p class="etiket">BİR ALAN. BİRDEN FAZLA BAŞLANGIÇ.</p><h2>Hareket etmek için<br>buradasın.</h2></div></section>
<section class="bolum-bosluk"><div class="baslik-satiri"><div><p class="etiket">YAKINDAN BAK</p><h2>Alanları keşfet.</h2></div><p>Bir görsele tıklayarak büyük hâlini açabilirsin. Galeri, proje için kullanılan örnek salon görsellerinden oluşur.</p></div>
<div class="salon-galeri">
<?php
$galeri = [
    ['resim' => 'Salon', 'baslik' => 'Salon atmosferi', 'yazi' => 'Antrenmana ayrılmış, aydınlık bir iç mekân örneği.'],
    ['resim' => 'Fitness', 'baslik' => 'Ağırlık alanı', 'yazi' => 'Serbest ağırlıklarla antrenmana odaklanan bir çalışma alanı.'],
    ['resim' => 'Stüdyo', 'baslik' => 'Mat stüdyosu', 'yazi' => 'Mat üzerinde dersler için sakin ve açık bir stüdyo örneği.'],
    ['resim' => 'Pilates', 'baslik' => 'Reformer deneyimi', 'yazi' => 'Pilates ekipmanıyla kontrollü hareketlere ayrılmış bir antrenman.'],
    ['resim' => 'Kardiyo', 'baslik' => 'Kardiyo alanı', 'yazi' => 'Koşu bandı ve kondisyon çalışmaları için örnek bir bölüm.'],
    ['resim' => 'Powerlifting', 'baslik' => 'Güç antrenmanı', 'yazi' => 'Barbell ve ağırlık çalışmasının odakta olduğu bir alan.']
];
foreach ($galeri as $foto) {
?>
    <figure class="galeri-karti"><button type="button" class="galeri-ac" data-resim="<?= temiz($resimler[$foto['resim']]) ?>" data-baslik="<?= temiz($foto['baslik']) ?>" data-bilgi="<?= temiz($foto['yazi']) ?>" aria-label="<?= temiz($foto['baslik']) ?> görselini büyüt"><img src="<?= temiz($resimler[$foto['resim']]) ?>" alt="<?= temiz($foto['baslik']) ?>" loading="lazy"><span aria-hidden="true">↗</span></button><figcaption><h3><?= temiz($foto['baslik']) ?></h3><p><?= temiz($foto['yazi']) ?></p></figcaption></figure>
<?php } ?>
</div></section>
<section class="editorial bolum-bosluk"><div class="editorial-yazi"><p class="etiket">ANTRENMANINI PLANLA</p><h2>İlk gelişin mi?<br><em>Hazır başlayalım.</em></h2><p>Küçük bir hazırlık, antrenman deneyimini daha rahat hâle getirir. Branşını seçtikten sonra örnek programdan dersleri inceleyebilirsin.</p><ul class="ozellik-listesi"><li>Rahat spor kıyafeti ve temiz spor ayakkabısı</li><li>Kişisel havlu ve su matarası</li><li>Pilates için tercih ettiğin ders türü</li><li>Alan ve ekipmanla ilgili soruların</li></ul><a class="buton" href="program.php">Ders programını incele ↗</a></div><div class="editorial-resim"><img src="<?= temiz($resimler['Stüdyo']) ?>" alt="Mat çalışmaları için örnek stüdyo" loading="lazy"><span class="resim-etiketi">A SPACE FOR YOUR PACE</span></div></section>
<section class="cagri"><div><p class="etiket">KENDİ ALANINI BULDUN MU?</p><h2>Bir sonraki adım üyeliğin.</h2><p>Sana uygun branşı ve paketi seçerek kaydını oluştur.</p></div><a class="buton" href="uyelik.php">Üyelik oluştur ↗</a></section>
<?php require 'alt.php'; ?>

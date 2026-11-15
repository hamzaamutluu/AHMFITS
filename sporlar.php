<?php
require 'ortak.php';
$baslik = 'Spor Dalları';
$sayfa = 'sporlar.php';
require 'ust.php';
?>
<div class="sayfa-baslik"><p class="etiket">HEDEFİNE UYGUN ANTRENMAN</p><h1>Tek bir yol yok.<br><em>Senin yolun var.</em></h1><p>Ağırlık alanında güç, stüdyoda denge, kardiyoda hareket. Alanları yakından tanı ve kendi başlangıcını seç.</p></div>
<nav class="brans-kisayol" aria-label="Branşlara git"><?php foreach ($branslar as $sira => $brans) { ?><a href="#brans-<?= $sira ?>"><?= temiz($brans) ?> ↘</a><?php } ?></nav>
<div class="brans-listesi">
<?php foreach ($branslar as $sira => $brans) { ?>
    <article class="brans-karti" id="brans-<?= $sira ?>">
        <div class="resim-alani"><img src="<?= temiz($resimler[$brans]) ?>" alt="<?= temiz($brans) ?> alanı" loading="lazy"></div>
        <div class="brans-yazi"><p class="etiket">0<?= $sira + 1 ?> / ANTRENMAN ALANI</p><h2><?= temiz($brans) ?></h2>
            <p><?= temiz($aciklamalar[$brans]) ?></p>
            <details><summary>Alanı ve seçeneklerini tanı <span>+</span></summary>
            <?php if ($brans == 'Fitness') { ?><p>Makine ve serbest ağırlıklarla farklı bir antrenman düzeni oluşturabilirsin. Bu branş için aylık, üç aylık veya yıllık üyelik seçenekleri bulunur.</p><?php } ?>
            <?php if ($brans == 'Powerlifting') { ?><p>Üç temel kaldırış etrafında şekillenen bu alanda teknik ve düzenli çalışma öne çıkar. Aylık, üç aylık veya yıllık paketlerden birini seçebilirsin.</p><?php } ?>
            <?php if ($brans == 'Pilates') { ?><p>Mat Pilates veya Reformer Pilates tercihini kayıt formunda belirt. 4, 8 ve 12 seans seçeneklerini Pilates sayfasında inceleyebilirsin.</p><?php } ?>
            <?php if ($brans == 'Kardiyo') { ?><p>Koşu bandı ve kondisyon çalışmalarına ayrılmış bir alan. Aylık, üç aylık veya yıllık üyelik seçerek kayıt oluşturabilirsin.</p><?php } ?>
            </details>
            <a class="buton" href="uyelik.php?brans=<?= urlencode($brans) ?>">Bu branşa katıl ↗</a>
        </div>
    </article>
<?php } ?>
</div>
<section class="cagri"><div><p class="etiket">PLANINA BİR YER AÇ</p><h2>Haftanın ritmini belirle.</h2><p>Örnek ders programından branşları, saatleri ve ders türlerini incele.</p></div><a class="buton" href="program.php">Programı gör ↗</a></section>
<?php require 'alt.php'; ?>

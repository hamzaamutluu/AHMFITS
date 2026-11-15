<?php
require 'ortak.php';
$baslik = 'Üye Yönetimi';
$sayfa = 'uyeler.php';
$hata = '';
$silId = metinAl($_GET, 'sil');
$silinecek = null;
foreach ($uyeler as $uye) {
    if ((string) $uye['id'] === $silId) { $silinecek = $uye; }
}

// Silme yalnızca POST ile ve onay formundan yapılır.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!formGecerli()) {
        $hata = 'Form doğrulanamadı. Sayfayı yenileyin.';
    } elseif (!$silinecek) {
        $hata = 'Silinecek üye bulunamadı.';
    } else {
        foreach ($_SESSION['uyeler'] as $sira => $uye) {
            if ((string) $uye['id'] === $silId) { unset($_SESSION['uyeler'][$sira]); }
        }
        $_SESSION['uyeler'] = array_values($_SESSION['uyeler']);
        yonlendir('uyeler.php', 'Üye kaydı silindi.');
    }
}

$arama = metinAl($_GET, 'arama');
$durum = metinAl($_GET, 'durum');
$brans = metinAl($_GET, 'brans');
if (!in_array($durum, ['', 'aktif', 'doldu'], true)) { $durum = ''; }
if (!in_array($brans, $branslar, true)) { $brans = ''; }
$liste = [];

// Türkçe I/İ harfleri için de aramayı küçük harfle karşılaştır.
function aramaMetni($metin) {
    return mb_strtolower(str_replace(['I', 'İ'], ['ı', 'i'], $metin), 'UTF-8');
}

foreach ($uyeler as $uye) {
    $aktif = $uye['bitis'] >= $bugun;
    $isimUygun = $arama == '' || mb_strpos(aramaMetni($uye['ad']), aramaMetni($arama), 0, 'UTF-8') !== false;
    $bransUygun = $brans == '' || $uye['brans'] == $brans;
    $durumUygun = $durum == '' || ($durum == 'aktif' && $aktif) || ($durum == 'doldu' && !$aktif);
    if ($isimUygun && $bransUygun && $durumUygun) { $liste[] = $uye; }
}
require 'ust.php';
?>
<div class="sayfa-baslik"><p class="etiket">SALONUN NABZI</p><h1>Üye yönetimi<span>.</span></h1><p>İsimle ara, branşa göre filtrele, üyelikleri düzenle.</p><a href="uyelik.php" class="buton">Yeni üye ekle +</a></div>
<?php if ($hata != '') { ?><div class="mesaj hata" role="alert"><?= temiz($hata) ?></div><?php } ?>
<?php if ($silId != '') { ?>
    <?php if ($silinecek) { ?>
    <section class="silme-onay"><h2>Kaydı silmek istiyor musun?</h2><p><strong><?= temiz($silinecek['ad']) ?></strong> isimli üyenin kaydı kaldırılacak.</p>
        <form method="post"><input type="hidden" name="form_anahtari" value="<?= temiz($_SESSION['form_anahtari']) ?>"><div class="butonlar"><button type="submit" class="buton">Evet, kaydı sil</button><a class="metin-link" href="uyeler.php">Vazgeç</a></div></form>
    </section>
    <?php } else { ?><p class="mesaj hata">Üye bulunamadı.</p><?php } ?>
<?php } ?>
<section class="ozetler"><article class="ozet"><span>TOPLAM</span><strong><?= $toplamUye ?></strong><p>Üye</p></article><article class="ozet"><span>AKTİF</span><strong><?= $aktifSayisi ?></strong><p>Üyelik</p></article><article class="ozet"><span>SÜRESİ DOLAN</span><strong><?= $suresiDolan ?></strong><p>Üyelik</p></article></section>
<form method="get" class="filtre-formu">
    <div><label for="arama">Ad soyad ile ara</label><input id="arama" name="arama" value="<?= temiz($arama) ?>" placeholder="Üye adı yaz..."></div>
    <div><label for="filtre-brans">Spor dalı</label><select id="filtre-brans" name="brans"><option value="">Tüm branşlar</option><?php foreach ($branslar as $secenek) { ?><option value="<?= temiz($secenek) ?>" <?= $brans == $secenek ? 'selected' : '' ?>><?= temiz($secenek) ?></option><?php } ?></select></div>
    <div><label for="durum">Üyelik durumu</label><select id="durum" name="durum"><option value="">Tümü</option><option value="aktif" <?= $durum == 'aktif' ? 'selected' : '' ?>>Aktif</option><option value="doldu" <?= $durum == 'doldu' ? 'selected' : '' ?>>Süresi doldu</option></select></div>
    <button class="buton" type="submit">Ara / Filtrele</button><a class="metin-link" href="uyeler.php">Temizle</a>
</form>
<p class="not"><?= count($liste) ?> kayıt gösteriliyor. Özet kutuları tüm üyeleri sayar.</p>
<div class="tablo-alani"><table><caption class="gizli">Üye kayıtları ve yönetim işlemleri</caption><thead><tr><th>NO</th><th>AD SOYAD</th><th>BRANŞ</th><th>PAKET</th><th>BİTİŞ</th><th>DURUM</th><th>İŞLEMLER</th></tr></thead><tbody>
<?php foreach ($liste as $uye) { ?>
    <tr><td>#<?= $uye['id'] ?></td><td><?= temiz($uye['ad']) ?></td><td><?= temiz($uye['brans']) ?><?php if ($uye['pilates_turu'] != '') { ?><small><?= temiz($uye['pilates_turu']) ?></small><?php } ?></td><td><?= temiz($uye['paket']) ?></td><td><?= date('d.m.Y', strtotime($uye['bitis'])) ?></td>
        <td><?php if ($uye['bitis'] >= $bugun) { ?><span class="durum aktif">Aktif</span><?php } else { ?><span class="durum doldu">Süresi doldu</span><?php } ?></td>
        <td><div class="islemler"><a href="uyelik.php?duzenle=<?= $uye['id'] ?>" aria-label="<?= temiz($uye['ad']) ?> kaydını düzenle">Düzenle</a><a class="sil-link" href="uyeler.php?sil=<?= $uye['id'] ?>" aria-label="<?= temiz($uye['ad']) ?> kaydını sil">Sil</a></div></td>
    </tr>
<?php } ?>
<?php if (count($liste) == 0) { ?><tr><td colspan="7">Aramana uygun üye bulunamadı.</td></tr><?php } ?>
</tbody></table></div>
<p class="not">Bitiş günü üyeliğe dahildir. Tüm üyeliklerin başladığı kabul edilir. Kayıtlar yalnızca oturum boyunca korunur.</p>
<?php require 'alt.php'; ?>

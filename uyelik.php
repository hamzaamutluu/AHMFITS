<?php
require 'ortak.php';
$baslik = 'Üyelik Oluştur';
$sayfa = 'uyelik.php';
$hata = '';
$id = metinAl($_GET, 'duzenle');
$ad = '';
$brans = metinAl($_GET, 'brans');
$paket = metinAl($_GET, 'paket');
$pilatesTuru = metinAl($_GET, 'tur');
$bitis = '';
$bulundu = false;

if (!in_array($brans, $branslar, true)) { $brans = 'Fitness'; }
if (!in_array($paket, $butunPaketler, true)) { $paket = ''; }
if (!in_array($pilatesTuru, ['Mat Pilates', 'Reformer Pilates'], true)) { $pilatesTuru = ''; }

// Düzenle düğmesinden gelindiyse mevcut bilgileri forma getir.
if ($id != '') {
    foreach ($uyeler as $uye) {
        if ((string) $uye['id'] === $id) {
            $bulundu = true;
            $ad = $uye['ad'];
            $brans = $uye['brans'];
            $paket = $uye['paket'];
            $pilatesTuru = $uye['pilates_turu'];
            $bitis = $uye['bitis'];
        }
    }
    if (!$bulundu) { $hata = 'Düzenlenecek üye bulunamadı.'; }
    $baslik = 'Üye Düzenle';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ad = metinAl($_POST, 'ad');
    $brans = metinAl($_POST, 'brans');
    $paket = metinAl($_POST, 'paket');
    $pilatesTuru = metinAl($_POST, 'pilates_turu');
    $bitis = metinAl($_POST, 'bitis');

    // Takvimde olmayan tarihleri kabul etme.
    $tarihGecerli = false;
    if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $bitis)) {
        $tarih = DateTime::createFromFormat('!Y-m-d', $bitis);
        if ($tarih && $tarih->format('Y-m-d') == $bitis && $bitis >= '1900-01-01' && $bitis <= '2100-12-31') {
            $tarihGecerli = true;
        }
    }

    if (!formGecerli()) {
        $hata = 'Form doğrulanamadı. Sayfayı yenileyerek tekrar deneyin.';
    } elseif ($id != '' && !$bulundu) {
        $hata = 'Düzenlenecek üye bulunamadı.';
    } elseif ($ad == '' || $brans == '' || $paket == '' || $bitis == '') {
        $hata = 'Lütfen bütün zorunlu alanları doldurun.';
    } elseif (mb_strlen($ad, 'UTF-8') > 75) {
        $hata = 'Ad soyad en fazla 75 karakter olabilir.';
    } elseif (!in_array($brans, $branslar, true)) {
        $hata = 'Geçerli bir spor dalı seçin.';
    } elseif (!$tarihGecerli) {
        $hata = '1900 ile 2100 arasında geçerli bir bitiş tarihi girin.';
    } elseif ($brans == 'Pilates' && !in_array($pilatesTuru, ['Mat Pilates', 'Reformer Pilates'], true)) {
        $hata = 'Mat Pilates veya Reformer Pilates seçin.';
    } elseif ($brans == 'Pilates' && !in_array($paket, $pilatesPaketler, true)) {
        $hata = 'Pilates için 4, 8 veya 12 seans paketi seçin.';
    } elseif ($brans != 'Pilates' && !in_array($paket, $normalPaketler, true)) {
        $hata = 'Bu branş için Aylık, 3 Aylık veya Yıllık paket seçin.';
    } else {
        if ($brans != 'Pilates') { $pilatesTuru = ''; }
        if ($id == '') {
            $_SESSION['son_numara']++;
            $kayitNumarasi = $_SESSION['son_numara'];
        } else {
            $kayitNumarasi = (int) $id;
        }

        $yeniUye = [
            'id' => $kayitNumarasi,
            'ad' => $ad,
            'brans' => $brans,
            'paket' => $paket,
            'pilates_turu' => $pilatesTuru,
            'bitis' => $bitis
        ];

        if ($id == '') {
            $_SESSION['uyeler'][] = $yeniUye;
            yonlendir('uyeler.php', 'Yeni üye başarıyla eklendi.');
        } else {
            foreach ($_SESSION['uyeler'] as $sira => $uye) {
                if ($uye['id'] == $kayitNumarasi) {
                    $_SESSION['uyeler'][$sira] = $yeniUye;
                }
            }
            yonlendir('uyeler.php', 'Üye bilgileri güncellendi.');
        }
    }
}
require 'ust.php';
?>
<div class="sayfa-baslik"><p class="etiket">SENİN HEDEFİNLE BAŞLAR</p><h1><?= temiz($baslik) ?><span>.</span></h1><p>Branş, paket ve bitiş tarihini seç. Bu form bir üyelik kaydı oluşturur; ödeme veya kullanıcı hesabı açmaz.</p></div>
<?php if ($hata != '') { ?><div class="mesaj hata" role="alert"><?= temiz($hata) ?></div><?php } ?>
<div class="form-yerlesim">
<form method="post" class="uye-formu">
    <input type="hidden" name="form_anahtari" value="<?= temiz($_SESSION['form_anahtari']) ?>">
    <label for="ad">Ad Soyad</label>
    <input id="ad" name="ad" maxlength="75" value="<?= temiz($ad) ?>" placeholder="Örneğin: Ali Yılmaz" required>

    <label for="brans">Spor Dalı</label>
    <select id="brans" name="brans" required>
        <?php foreach ($branslar as $secenek) { ?><option value="<?= temiz($secenek) ?>" <?= $brans == $secenek ? 'selected' : '' ?>><?= temiz($secenek) ?></option><?php } ?>
    </select>

    <div id="pilates-alani">
        <label for="pilates_turu">Pilates Türü <span class="not">(yalnızca Pilates için)</span></label>
        <select id="pilates_turu" name="pilates_turu">
            <option value="">Tür seçiniz</option>
            <?php foreach (['Mat Pilates', 'Reformer Pilates'] as $secenek) { ?><option value="<?= temiz($secenek) ?>" <?= $pilatesTuru == $secenek ? 'selected' : '' ?>><?= temiz($secenek) ?></option><?php } ?>
        </select>
    </div>

    <label for="paket">Üyelik Paketi</label>
    <select id="paket" name="paket" required>
        <option value="">Paket seçiniz</option>
        <?php foreach ($butunPaketler as $secenek) { ?><option value="<?= temiz($secenek) ?>" data-pilates="<?= in_array($secenek, $pilatesPaketler) ? 'evet' : 'hayir' ?>" <?= $paket == $secenek ? 'selected' : '' ?>><?= temiz($secenek) ?></option><?php } ?>
    </select>

    <label for="bitis">Üyelik Bitiş Tarihi</label>
    <input type="date" id="bitis" name="bitis" min="1900-01-01" max="2100-12-31" value="<?= temiz($bitis) ?>" required>
    <p class="not">Bitiş tarihi elle belirlenir. Seçilen paket otomatik tarih veya seans hesabı yapmaz.</p>
    <div class="butonlar"><button class="buton" type="submit"><?= $id == '' ? 'Üyelik oluştur +' : 'Değişiklikleri kaydet' ?></button><a class="metin-link" href="uyeler.php">İptal / Üye listesi</a></div>
</form>
<aside class="form-notu bilgi-karti"><p class="etiket">BİR ADIM DAHA</p><h2>Hedefini seç.<br>Başlangıcını yap.</h2><p>Fitness, Powerlifting ve Kardiyo için süreli paketler; Pilates için seans paketleri seçebilirsin.</p><hr><p class="not">Kayıtlar bu tarayıcının oturumunda saklanır. Oturum sona erdiğinde kaybolabilir. Veritabanı kullanılmaz.</p></aside>
</div>
<?php require 'alt.php'; ?>

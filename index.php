<?php
require 'ortak.php';
$baslik = 'Ana Sayfa';
$sayfa = 'index.php';
require 'ust.php';
?>
<!-- Ana sayfanın yazılarını bu bölümden değiştirebilirsin. -->
<section class="vitrin">
    <div class="vitrin-yazi">
        <p class="etiket"><span class="mini-cizgi"></span> AHMFİTS EXPERIENCE</p>
        <h1>Gücünü bul.<br><em>Dengeni koru.</em><br>Kendine yer aç.</h1>
        <p>İyi bir antrenman, kendine ayırdığın zamanla başlar. Ağırlık alanından Pilates stüdyosuna, kendi ritmini bulacağın bir dünya seni bekliyor.</p>
        <div class="butonlar"><a href="uyelik.php" class="buton">Yolculuğuna başla <span>↗</span></a><a href="salon.php" class="ince-link">Salonu keşfet →</a></div>
        <div class="vitrin-imza"><span class="imza-sembol" aria-hidden="true">A/F</span><div>BİR SALONDAN DAHA FAZLASI<small>Hareket. Disiplin. İyi hissetmek.</small></div></div>
    </div>
    <div class="vitrin-fotograf">
        <img src="<?= temiz($resimler['Powerlifting']) ?>" alt="Ağırlık antrenmanı alanında sporcu" fetchpriority="high">
        <span class="foto-ust">01 / THE STRENGTH SPACE</span>
        <div class="foto-alt"><span>Bugünün emeği.<br>Yarının gücü.</span><a href="sporlar.php" aria-label="Spor dallarını keşfet">↗</a></div>
        <span class="dikey-yazi" aria-hidden="true">SHOW UP FOR YOURSELF</span>
    </div>
</section>
<div class="kelime-seridi" aria-label="Branşlarımız"><span>FITNESS</span><b>✦</b><span>POWERLIFTING</span><b>✦</b><span>PILATES</span><b>✦</b><span>KARDİYO</span><b>✦</b><span>AHMFİTS</span></div>

<section class="bolum-bosluk">
    <div class="baslik-satiri"><div><p class="etiket">01 / ANTRENMAN DÜNYAN</p><h2>Her hedefe bir alan.<br><em>Her adımda sen.</em></h2></div><p>Bir branşa sığmak zorunda değilsin. Bugün güce, yarın dengeye odaklan. Sana uygun alanı keşfet.</p></div>
    <div class="spor-kartlari yeni-kartlar">
        <?php
        $kisaYazilar = ['Fitness' => 'Kendi antrenman düzenini oluştur.', 'Powerlifting' => 'Tekniğe ve ilerlemeye odaklan.', 'Pilates' => 'Kontrollü hareket, sana ait bir tempo.', 'Kardiyo' => 'Harekete geç, ritmini yükselt.'];
        foreach ($branslar as $sira => $brans) {
        ?>
        <a class="spor-karti" href="<?= $brans == 'Pilates' ? 'pilates.php' : 'sporlar.php#brans-' . $sira ?>">
            <img src="<?= temiz($resimler[$brans]) ?>" alt="<?= temiz($brans) ?> antrenmanı" loading="lazy">
            <div><span>0<?= $sira + 1 ?> / KEŞFET</span><h3><?= temiz($brans) ?> <b>↗</b></h3><p><?= temiz($kisaYazilar[$brans]) ?></p></div>
        </a>
        <?php } ?>
    </div>
</section>

<section class="editorial bolum-bosluk">
    <div class="editorial-resim"><img src="<?= temiz($resimler['Pilates']) ?>" alt="Reformer Pilates çalışması" loading="lazy"><span class="resim-etiketi">THE PILATES EDIT / 02</span></div>
    <div class="editorial-yazi"><p class="etiket">GÜCÜN DAHA SAKİN BİR HÂLİ</p><h2>Bazen ilerlemek,<br><em>yavaşlamakla başlar.</em></h2><p>Matını ser. Nefesine odaklan. Hareketlerine zaman ayır. Mat ve Reformer Pilates seçenekleriyle antrenmanına farklı bir ritim kat.</p><ul class="ozellik-listesi"><li>Mat ve Reformer seçenekleri</li><li>4, 8 veya 12 seanslık örnek paketler</li><li>Ayrı stüdyo ve ders programı</li></ul><a href="pilates.php" class="buton">Pilates dünyasını keşfet ↗</a></div>
</section>

<section class="neden-bolumu bolum-bosluk">
    <p class="etiket">02 / DAHA İYİ BİR DENEYİM</p><h2>Detaylar fark yaratır.</h2>
    <div class="uc-sutun"><article class="deneyim-karti"><span>01</span><h3>Alanını seç.</h3><p>Ağırlık, kondisyon veya stüdyo. Hedefine uygun branşın içeriğini inceleyerek başlangıcını planla.</p></article><article class="deneyim-karti"><span>02</span><h3>Temponu belirle.</h3><p>Genel üyelikte süreli paketler, Pilates'te seans seçenekleri. Sana uygun üyelik türünü seç.</p></article><article class="deneyim-karti"><span>03</span><h3>Takibini kolaylaştır.</h3><p>Paketini ve bitiş tarihini tek bir kayıtta tut. Üyelik bilgilerini yönetim sayfasından güncelle.</p></article></div>
</section>

<section class="hedef-secici bolum-bosluk">
    <div><p class="etiket">03 / NEREDEN BAŞLAMALI?</p><h2>Bugün neye<br><em>yer açıyorsun?</em></h2><p>Bir seçenek seç; ilgili branş sayfasını birlikte bulalım.</p></div>
    <div class="hedef-alani"><div class="hedef-dugmeleri" role="group" aria-label="İlgilendiğin alan"><button type="button" data-hedef="Fitness" aria-pressed="true">Genel antrenman</button><button type="button" data-hedef="Powerlifting" aria-pressed="false">Ağırlık çalışması</button><button type="button" data-hedef="Pilates" aria-pressed="false">Pilates ve denge</button><button type="button" data-hedef="Kardiyo" aria-pressed="false">Kondisyon</button></div><div class="hedef-sonuc" aria-live="polite"><span id="hedef-adi">Fitness</span><p id="hedef-aciklama">Serbest ağırlıklar ve makinelerle kendi antrenman düzenini oluştur.</p><a id="hedef-link" href="sporlar.php#brans-0" class="metin-link">Bu alanı keşfet ↗</a></div></div>
</section>

<section class="baslangic bolum-bosluk"><div class="baslik-satiri"><div><p class="etiket">04 / İLK ADIMIN</p><h2>Başlamak için<br><em>mükemmel anı bekleme.</em></h2></div><a href="uyelik.php" class="buton">Üyelik oluştur ↗</a></div><div class="adimlar"><article><span>01</span><h3>Branşını keşfet</h3><p>Alanları ve Pilates seçeneklerini incele.</p></article><article><span>02</span><h3>Paketini belirle</h3><p>Süre veya seans paketini seç.</p></article><article><span>03</span><h3>Kaydını oluştur</h3><p>Bilgilerini gir, üyeliğini listede gör.</p></article></div></section>

<section class="sss-bolumu bolum-bosluk"><div><p class="etiket">MERAK ETTİKLERİN</p><h2>Bir soruyla<br><em>başlayabiliriz.</em></h2><a href="hakkimizda.php" class="metin-link">Salon hakkında →</a></div><div class="sss-liste">
    <details><summary>Spora yeni başlıyorum. Hangi alanı seçmeliyim?<span>+</span></summary><p>Spor Dalları sayfasından her branşın açıklamasını inceleyebilirsin. Seçiminle ilgili sorularını salondaki eğitmene yöneltmen, başlangıcını planlamana yardımcı olur.</p></details>
    <details><summary>Mat ve Reformer Pilates arasında nasıl seçim yaparım?<span>+</span></summary><p>Mat Pilates mat üzerinde, Reformer Pilates özel ekipmanla yapılır. Pilates sayfasında iki seçeneği inceleyip kayıt sırasında tercihini belirtebilirsin.</p></details>
    <details><summary>Üyeliğimi nasıl oluşturabilirim?<span>+</span></summary><p>Üyelik sayfasında ad soyad, branş, paket ve bitiş tarihini doldur. Başarılı kayıttan sonra Üye Yönetimi sayfasına yönlendirilirsin.</p></details>
    <details><summary>Bu site üzerinden ödeme veya ders rezervasyonu yapılıyor mu?<span>+</span></summary><p>Bu ders projesi üyelik kaydı ve takibi içindir. Ödeme veya ders rezervasyonu oluşturmaz. Program ve paketler örnek olarak sunulur.</p></details>
    <details><summary>Üyelik bilgilerimi nereden değiştirebilirim?<span>+</span></summary><p>Üye Yönetimi sayfasında kaydını bulup Düzenle bağlantısını kullan. Paketini ve bitiş tarihini değiştirebilirsin. Kayıtlar oturum boyunca saklanır.</p></details>
</div></section>

<section class="son-cagri"><p class="etiket">BİR SONRAKİ ADIM SANA AİT</p><h2>Kendin için gel.<br><em>Kendinle ilerle.</em></h2><a href="uyelik.php" class="buton">Bugün başla ↗</a><span class="son-imza" aria-hidden="true">A/F</span></section>
<?php require 'alt.php'; ?>

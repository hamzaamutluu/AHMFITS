<?php
require 'ortak.php';
$baslik = 'Pilates';
$sayfa = 'pilates.php';
require 'ust.php';
?>
<section class="hero pilates-hero">
    <img class="hero-resim" src="<?= temiz($resimler['Pilates']) ?>" alt="Reformer ekipmanıyla Pilates çalışması">
    <div class="hero-yazi"><p class="etiket">DAHA DENGELİ BİR BAŞLANGIÇ</p><h1>Nefes al.<br><span>Ritmini bul.</span></h1><p class="aciklama">Mat veya Reformer Pilates. Kendi tercihini yap, sana uygun seans paketini seç.</p><a href="uyelik.php?brans=Pilates" class="buton">Pilates üyeliği oluştur ↗</a></div>
</section>
<section class="iki-sutun">
    <article class="bilgi-karti"><p class="etiket">01 / MAT</p><h2>Mat Pilates</h2><p>Mat üzerinde gerçekleştirilen, kontrollü hareketlere odaklanan dersler. Örnek programı inceleyerek sana uygun saati seçebilirsin.</p><a href="uyelik.php?brans=Pilates&tur=Mat+Pilates" class="metin-link">Mat Pilates seç →</a></article>
    <article class="bilgi-karti"><p class="etiket">02 / REFORMER</p><h2>Reformer Pilates</h2><p>Reformer ekipmanıyla gerçekleştirilen dersler. Kayıt formunda Pilates türünü ve seans paketini belirtebilirsin.</p><a href="uyelik.php?brans=Pilates&tur=Reformer+Pilates" class="metin-link">Reformer Pilates seç →</a></article>
</section>
<section class="editorial bolum-bosluk">
    <div class="editorial-resim"><img src="<?= temiz($resimler['Stüdyo']) ?>" alt="Mat dersleri için aydınlık bir stüdyo örneği" loading="lazy"><span class="resim-etiketi">MOVE WITH INTENTION</span></div>
    <div class="editorial-yazi"><p class="etiket">HAREKETİN İÇİNDE BİR MOLA</p><h2>Kontrol sende.<br><em>Tempo sana ait.</em></h2><p>Pilates deneyimi yalnızca bir paket seçmekten ibaret değil. Tercih ettiğin ders türünü tanımak ve antrenmana zaman ayırmak da başlangıcın bir parçası.</p><p>Mat Pilates'te mat üzerinde yapılan hareketler, Reformer Pilates'te ise ekipmanla yapılan çalışmalar öne çıkar. İlk dersinde ekipmanı ve ders akışını eğitmenle birlikte tanıyabilirsin.</p><a href="program.php" class="metin-link">Örnek ders saatlerini incele →</a></div>
</section>
<section class="bolum-bosluk"><p class="etiket">İKİ FARKLI DENEYİM</p><h2>Sana hangi alan daha yakın?</h2><div class="tablo-alani"><table><caption class="gizli">Mat ve Reformer Pilates seçenekleri</caption><thead><tr><th>ÖZELLİK</th><th>MAT PİLATES</th><th>REFORMER PİLATES</th></tr></thead><tbody><tr><th scope="row">Çalışma alanı</th><td>Mat üzerinde</td><td>Reformer ekipmanıyla</td></tr><tr><th scope="row">Kayıt seçeneği</th><td>4 / 8 / 12 seans</td><td>4 / 8 / 12 seans</td></tr><tr><th scope="row">Başlangıç</th><td>Ders türünü seçerek kayıt oluştur</td><td>Ders türünü seçerek kayıt oluştur</td></tr></tbody></table></div></section>
<section><p class="etiket">KENDİ TEMPONU SEÇ</p><h2>Pilates paketleri<span>.</span></h2>
    <div class="paketler">
    <?php foreach ($pilatesPaketler as $paket) { ?>
        <article class="paket"><p class="etiket">PİLATES / SEANS PAKETİ</p><h3><?= temiz($paket) ?></h3><p>Mat veya reformer seçeneğiyle kayıt oluştur.</p><ul class="paket-detay"><li>Pilates türü seçimi</li><li>Belirlediğin bitiş tarihi</li><li>Üyelik bilgilerinin takibi</li></ul><a class="buton" href="uyelik.php?brans=Pilates&paket=<?= urlencode($paket) ?>">Paketi seç ↗</a></article>
    <?php } ?>
    </div>
    <p class="not">Paketler örnektir. Bu sürümde seans kullanımı, ödeme veya ders rezervasyonu takip edilmez. Bitiş tarihi formda ayrıca belirtilir.</p>
</section>
<section class="bilgi-karti ilk-ders"><p class="etiket">İLK DERSİNDEN ÖNCE</p><h2>Küçük bir hazırlık.</h2><div class="uc-sutun"><div><h3>Rahat hazırlan.</h3><p>Hareketini kısıtlamayan kıyafet, kişisel havlu ve su matarası getir.</p></div><div><h3>Dersini tanı.</h3><p>Mat ve reformer seçeneklerini incele; ekipmanla ilgili sorularını eğitmenine yönelt.</p></div><div><h3>Zaman ayır.</h3><p>Programdaki örnek saatleri kontrol et ve ilk gelişini aceleye getirmeden planla.</p></div></div></section>
<?php require 'alt.php'; ?>

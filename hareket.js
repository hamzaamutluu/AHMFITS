// TELEFON EKRANINDA AÇILAN ÜST MENÜ.
var menuAc = document.getElementById('menu-ac');
var menuAlani = document.querySelector('.menu');
if (menuAc && menuAlani) {
    menuAc.addEventListener('click', function () {
        var acik = menuAlani.classList.toggle('mobil-acik');
        menuAc.setAttribute('aria-expanded', String(acik));
    });
    menuAlani.addEventListener('keydown', function (olay) {
        if (olay.key === 'Escape' && menuAlani.classList.contains('mobil-acik')) {
            menuAlani.classList.remove('mobil-acik');
            menuAc.setAttribute('aria-expanded', 'false');
            menuAc.focus();
        }
    });
}

// AÇIK / KOYU TEMA
var temaButonu = document.getElementById('tema-butonu');

function temaYazisiniGuncelle() {
    var acik = document.documentElement.classList.contains('acik-tema');
    temaButonu.textContent = acik ? '☾ Koyu tema' : '☀ Açık tema';
    temaButonu.setAttribute('aria-pressed', String(acik));
}

temaButonu.addEventListener('click', function () {
    document.documentElement.classList.toggle('acik-tema');
    var acik = document.documentElement.classList.contains('acik-tema');
    try {
        localStorage.setItem('tema', acik ? 'acik' : 'koyu');
    } catch (hata) {}
    temaYazisiniGuncelle();
});
temaYazisiniGuncelle();

// ÜYELİK FORMUNDA BRANŞA GÖRE ALANLARI GÖSTER
var brans = document.getElementById('brans');
var paket = document.getElementById('paket');
var pilatesAlani = document.getElementById('pilates-alani');
var pilatesTuru = document.getElementById('pilates_turu');

function formuGuncelle() {
    var pilatesSecili = brans.value === 'Pilates';
    pilatesAlani.hidden = !pilatesSecili;
    pilatesTuru.disabled = !pilatesSecili;
    pilatesTuru.required = pilatesSecili;

    // Pilates seçildiğinde yalnızca seans paketlerini göster.
    for (var i = 0; i < paket.options.length; i++) {
        var secenek = paket.options[i];
        if (secenek.value !== '') {
            var seansPaketi = secenek.getAttribute('data-pilates') === 'evet';
            secenek.disabled = seansPaketi !== pilatesSecili;
            secenek.hidden = secenek.disabled;
        }
    }
    if (paket.selectedIndex >= 0 && paket.options[paket.selectedIndex].disabled) {
        paket.value = '';
    }
}

if (brans && paket && pilatesAlani && pilatesTuru) {
    brans.addEventListener('change', formuGuncelle);
    formuGuncelle();
}

// ANA SAYFADA HEDEFE GÖRE BRANŞI GÖSTER.
var hedefler = {
    Fitness: { yazi: 'Serbest ağırlıklar ve makinelerle kendi antrenman düzenini oluştur.', adres: 'sporlar.php#brans-0' },
    Powerlifting: { yazi: 'Squat, bench press ve deadlift odaklı alanı keşfet.', adres: 'sporlar.php#brans-1' },
    Pilates: { yazi: 'Mat veya reformer seçeneğini ve seans paketlerini incele.', adres: 'pilates.php' },
    Kardiyo: { yazi: 'Koşu bandı ve kondisyon çalışmalarına ayrılmış alanı tanı.', adres: 'sporlar.php#brans-3' }
};
var hedefDugmeleri = document.querySelectorAll('[data-hedef]');
hedefDugmeleri.forEach(function (dugme) {
    dugme.addEventListener('click', function () {
        var ad = dugme.getAttribute('data-hedef');
        hedefDugmeleri.forEach(function (diger) {
            diger.setAttribute('aria-pressed', String(diger === dugme));
        });
        document.getElementById('hedef-adi').textContent = ad;
        document.getElementById('hedef-aciklama').textContent = hedefler[ad].yazi;
        document.getElementById('hedef-link').href = hedefler[ad].adres;
    });
});

// FOTOĞRAFA TIKLAYINCA BÜYÜK GÖRÜNÜM AÇ.
var fotoDialog = document.getElementById('foto-dialog');
var galeriDugmeleri = document.querySelectorAll('.galeri-ac');
galeriDugmeleri.forEach(function (dugme) {
    dugme.addEventListener('click', function () {
        var buyukFoto = document.getElementById('buyuk-foto');
        buyukFoto.src = dugme.getAttribute('data-resim');
        buyukFoto.alt = dugme.getAttribute('data-baslik');
        document.getElementById('foto-baslik').textContent = dugme.getAttribute('data-baslik');
        document.getElementById('foto-bilgi').textContent = dugme.getAttribute('data-bilgi');
        fotoDialog.showModal();
    });
});
document.getElementById('foto-kapat').addEventListener('click', function () {
    fotoDialog.close();
});
// Escape tuşu tarayıcının kendi dialog davranışıyla kapatır.
fotoDialog.addEventListener('click', function (olay) {
    if (olay.target === fotoDialog) {
        var alan = fotoDialog.getBoundingClientRect();
        if (olay.clientX < alan.left || olay.clientX > alan.right || olay.clientY < alan.top || olay.clientY > alan.bottom) {
            fotoDialog.close();
        }
    }
});

// DERS PROGRAMINI GÜN VE BRANŞA GÖRE SÜZ.
var dersBrans = document.getElementById('ders-brans');
var seciliGun = '';
var gunDugmeleri = document.querySelectorAll('[data-gun]');

function dersleriSuz() {
    var sayi = 0;
    document.querySelectorAll('[data-ders]').forEach(function (kart) {
        var bransUygun = dersBrans.value === '' || kart.getAttribute('data-ders') === dersBrans.value;
        var gunUygun = seciliGun === '' || kart.getAttribute('data-ders-gun') === seciliGun;
        kart.hidden = !(bransUygun && gunUygun);
        if (!kart.hidden) { sayi++; }
    });
    document.getElementById('ders-sonuc').textContent = sayi + ' ders gösteriliyor';
    document.getElementById('ders-bos').hidden = sayi > 0;
}

if (dersBrans) {
    dersBrans.addEventListener('change', dersleriSuz);
    gunDugmeleri.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            seciliGun = dugme.getAttribute('data-gun');
            gunDugmeleri.forEach(function (diger) {
                diger.setAttribute('aria-pressed', String(diger === dugme));
            });
            dersleriSuz();
        });
    });
    document.getElementById('ders-temizle').addEventListener('click', function () {
        seciliGun = '';
        dersBrans.value = '';
        gunDugmeleri.forEach(function (dugme) {
            dugme.setAttribute('aria-pressed', String(dugme.getAttribute('data-gun') === ''));
        });
        dersleriSuz();
    });
}

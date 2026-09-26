# Ceylanpınar ASM WordPress Teması

Bu paket, WordPress görsel editöründe her sayfayı tek tek tasarlamadan kullanılabilen özel bir ASM temasıdır. Tasarım kodla sabittir; içerikler WordPress yönetim panelinden güncellenir.

## Kurulum

### Yöntem 1: ZIP dosyasını WordPress'ten yükleme

1. WordPress yönetiminde **Görünüm → Temalar → Yeni Ekle → Tema Yükle** bölümüne gidin.
2. `ceylanpinar-asm.zip` dosyasını seçin.
3. **Şimdi Kur** ve ardından **Etkinleştir** düğmesine basın.

### Yöntem 2: Local site klasörüne çıkarma

1. ZIP içindeki `ceylanpinar-asm` klasörünü çıkarın.
2. Klasörü şuraya kopyalayın:

   `app/public/wp-content/themes/`

3. WordPress yönetiminde **Görünüm → Temalar** bölümünden **Ceylanpınar ASM** temasını etkinleştirin.

Tema etkinleştirildiğinde tasarımı görebilmeniz için bir örnek hekim, altı örnek hizmet ve bir örnek duyuru oluşturulur. Bunları yayına almadan önce düzenleyin veya silin.

## WordPress yönetiminde kullanacağınız bölümler

- **ASM Bilgileri:** Telefon, e-posta, adres, çalışma saatleri, harita bağlantısı ve bağlı kurum bilgileri.
- **Hekimler:** Hekim adı, unvanı, birimi, birlikte çalıştığı aile sağlığı çalışanı, çalışma saatleri ve fotoğrafı.
- **Hizmetler:** Hizmet adı, kısa açıklaması ve gerekli bilgi/belgeler.
- **Duyurular:** Başlık, açıklama, son yayın tarihi ve “önemli duyuru” seçeneği.
- **Galeri:** Güncel iç/dış mekân fotoğrafları ve isteğe bağlı video bağlantısı.

## İlk düzenlemeler

1. **Ayarlar → Genel** bölümünde site başlığını `Ceylanpınar 4 Nolu Aile Sağlığı Merkezi` yapın.
2. Saat dilimini `Europe/Istanbul` olarak ayarlayın.
3. **Ayarlar → Kalıcı Bağlantılar** bölümünde **Yazı ismi** seçeneğini kaydedin.
4. **ASM Bilgileri** bölümündeki örnek telefon, adres ve bağlı kurum bilgilerini gerçek verilerle değiştirin.
5. Örnek hekim, hizmet ve duyuru kayıtlarını kontrol edin.
6. Galeriye ASM'nin güncel dış cephe, bekleme alanı ve hizmet alanı fotoğraflarını ekleyin.

## Hekim sıralamasını değiştirme

Hekim düzenleme ekranındaki **Sıralama** değeri kullanılır. Düşük sayı önce görünür. Aynı yöntem hizmetler ve galeri öğeleri için de geçerlidir.

## Duyuruların otomatik kaldırılması

Bir duyuruya **Yayından Kalkma Tarihi** girerseniz tarih geçince duyuru ana sayfadan otomatik olarak kalkar. Duyuru silinmez; yönetim panelinde kalır.

## Dosya yapısı

```text
ceylanpinar-asm/
├── style.css
├── functions.php
├── header.php
├── footer.php
├── front-page.php
├── index.php
├── page.php
├── single.php
├── assets/
│   ├── css/main.css
│   └── js/main.js
└── template-parts/
    ├── announcements.php
    ├── doctors.php
    ├── schedule.php
    ├── services.php
    ├── gallery.php
    └── contact.php
```

## Önemli

- Gerçek hasta bilgisi toplayan form eklemeyin.
- İletişim ve çalışma saatlerini yayına almadan önce doğrulayın.
- Fotoğraf/video içeriklerinin güncel olduğundan emin olun.
- WordPress çekirdek klasörlerini (`wp-admin`, `wp-includes`) değiştirmeyin.
- Değişiklik yapmadan önce tema ve veritabanı yedeği alın.

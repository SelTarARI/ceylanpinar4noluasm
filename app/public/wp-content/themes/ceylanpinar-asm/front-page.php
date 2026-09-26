<?php
get_header();
$settings = ceylanpinar_asm_get_settings();
$phone_href = preg_replace('/[^0-9+]/', '', $settings['phone']);
?>
<main id="icerik">
    <section id="ana-sayfa" class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">Ceylanpınar · Şanlıurfa</p>
                <h1>Sağlık bilgilerinize<br><em>kolayca ulaşın.</em></h1>
                <p class="hero-lead">Hekiminizin çalışma saatini öğrenin, sunulan hizmetleri inceleyin ve merkezimize kolayca ulaşın.</p>
                <div class="hero-actions">
                    <a class="button button-primary" href="tel:<?php echo esc_attr($phone_href); ?>">
                        <span aria-hidden="true">☎</span> ASM'yi ara
                    </a>
                    <a class="button button-secondary" href="<?php echo esc_url($settings['directions_url'] ?: '#iletisim'); ?>">
                        <span aria-hidden="true">⌖</span> Yol tarifi
                    </a>
                </div>
            </div>

            <aside class="today-card" aria-labelledby="bugun-baslik" data-hours="<?php echo esc_attr($settings['weekday_hours']); ?>">
                <div class="today-top">
                    <span id="open-status" class="open-status"><span></span> Açık</span>
                    <span id="today-date">Bugün</span>
                </div>
                <h2 id="bugun-baslik">Bugünkü çalışma saatleri</h2>
                <p class="today-time"><?php echo esc_html($settings['weekday_hours']); ?></p>
                <p class="muted">Birim ve esnek mesai saatleri farklılık gösterebilir.</p>
                <a class="text-link" href="#saatler">Tüm çalışma saatlerini gör <span aria-hidden="true">→</span></a>
            </aside>
        </div>

        <div class="container quick-grid" aria-label="Hızlı erişim">
            <a class="quick-card" href="#hekimler">
                <span class="quick-icon" aria-hidden="true">●</span>
                <span><strong>Hekiminizi bulun</strong><small>Birim ve çalışma saatleri</small></span><b aria-hidden="true">→</b>
            </a>
            <a class="quick-card" href="#hizmetler">
                <span class="quick-icon" aria-hidden="true">+</span>
                <span><strong>Hizmetler</strong><small>İşlemler ve gerekenler</small></span><b aria-hidden="true">→</b>
            </a>
            <a class="quick-card" href="<?php echo esc_url($settings['mhrs_url']); ?>" target="_blank" rel="noopener">
                <span class="quick-icon" aria-hidden="true">▣</span>
                <span><strong>MHRS randevu</strong><small>Resmî randevu sistemine git</small></span><b aria-hidden="true">↗</b>
            </a>
        </div>
    </section>

    <?php
    get_template_part('template-parts/announcements');
    get_template_part('template-parts/doctors');
    get_template_part('template-parts/schedule', null, ['settings' => $settings]);
    get_template_part('template-parts/services');
    get_template_part('template-parts/gallery');
    get_template_part('template-parts/contact', null, ['settings' => $settings]);
    ?>
</main>
<?php get_footer(); ?>

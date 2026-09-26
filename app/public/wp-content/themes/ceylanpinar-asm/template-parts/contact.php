<?php
$settings = $args['settings'] ?? ceylanpinar_asm_get_settings();
$phone_href = preg_replace('/[^0-9+]/', '', $settings['phone']);
?>
<section id="iletisim" class="section contact-section">
    <div class="container contact-grid">
        <div class="contact-card">
            <p class="eyebrow light">İletişim</p>
            <h2>Bize ulaşın</h2>
            <dl>
                <div><dt>Adres</dt><dd><?php echo nl2br(esc_html($settings['address'])); ?></dd></div>
                <div><dt>Telefon</dt><dd><a href="tel:<?php echo esc_attr($phone_href); ?>"><?php echo esc_html($settings['phone']); ?></a></dd></div>
                <div><dt>E-posta</dt><dd><a href="mailto:<?php echo esc_attr($settings['email']); ?>"><?php echo esc_html($settings['email']); ?></a></dd></div>
            </dl>
            <?php if ($settings['directions_url']) : ?><a class="button button-white" href="<?php echo esc_url($settings['directions_url']); ?>" target="_blank" rel="noopener">Haritada aç <span aria-hidden="true">↗</span></a><?php endif; ?>
        </div>
        <div class="institution-card">
            <p class="eyebrow">Bağlı kurumlar</p>
            <h3>Resmî iletişim bilgileri</h3>
            <div class="institution-row">
                <div><strong><?php echo esc_html($settings['province_name']); ?></strong><span><?php echo nl2br(esc_html($settings['province_contact'])); ?></span></div>
                <?php if ($settings['province_url']) : ?><a href="<?php echo esc_url($settings['province_url']); ?>" target="_blank" rel="noopener" aria-label="İl Sağlık Müdürlüğü sitesini aç">↗</a><?php endif; ?>
            </div>
            <div class="institution-row">
                <div><strong><?php echo esc_html($settings['district_name']); ?></strong><span><?php echo nl2br(esc_html($settings['district_contact'])); ?></span></div>
                <?php if ($settings['district_url']) : ?><a href="<?php echo esc_url($settings['district_url']); ?>" target="_blank" rel="noopener" aria-label="İlçe Sağlık Müdürlüğü sitesini aç">↗</a><?php endif; ?>
            </div>
            <p class="emergency">Acil durumlarda <strong>112 Acil Çağrı Merkezi</strong>'ni arayınız.</p>
        </div>
    </div>
</section>

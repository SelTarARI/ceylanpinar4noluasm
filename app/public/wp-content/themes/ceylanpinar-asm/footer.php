<?php $settings = ceylanpinar_asm_get_settings(); ?>
<footer class="site-footer">
    <div class="container footer-top">
        <div class="brand footer-brand">
            <span class="brand-mark" aria-hidden="true"></span>
            <span class="brand-copy"><small>T.C. Sağlık Bakanlığı</small><strong><?php bloginfo('name'); ?></strong></span>
        </div>
        <div class="footer-links">
            <a href="<?php echo esc_url(home_url('/#hekimler')); ?>">Hekimlerimiz</a>
            <a href="<?php echo esc_url(home_url('/#hizmetler')); ?>">Hizmetler</a>
            <a href="<?php echo esc_url(home_url('/#duyurular')); ?>">Duyurular</a>
            <a href="<?php echo esc_url(home_url('/#iletisim')); ?>">İletişim</a>
        </div>
    </div>
    <div class="container footer-bottom">
        <span>© <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?></span>
        <span>Son güncelleme: <strong><?php echo esc_html($settings['last_updated']); ?></strong></span>
    </div>
</footer>

<dialog id="service-dialog" class="service-dialog">
    <button class="dialog-close" type="button" aria-label="Pencereyi kapat">×</button>
    <p class="eyebrow">Hizmet ayrıntısı</p>
    <h2 id="dialog-title">Hizmet</h2>
    <div id="dialog-description"></div>
    <h3>Gerekli bilgi ve belgeler</h3>
    <div id="dialog-requirements"></div>
</dialog>

<?php wp_footer(); ?>
</body>
</html>

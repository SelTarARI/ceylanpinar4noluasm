<?php $settings = $args['settings'] ?? ceylanpinar_asm_get_settings(); ?>
<section id="saatler" class="section schedule-section">
    <div class="container schedule-grid">
        <div class="section-heading">
            <p class="eyebrow">Ziyaretinizi planlayın</p>
            <h2>Çalışma saatleri</h2>
            <p>Hekimlerin birim ve esnek mesai saatleri farklı olabilir. Ayrıntılı saatleri hekim kartlarından kontrol edebilirsiniz.</p>
            <div class="info-note"><strong>Resmî tatiller:</strong> Merkezimiz kapalıdır. Acil durumlarda 112'yi arayınız.</div>
        </div>
        <div class="schedule-card">
            <?php foreach (['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma'] as $day) : ?>
                <div class="schedule-row"><span><?php echo esc_html($day); ?></span><strong><?php echo esc_html($settings['weekday_hours']); ?></strong></div>
            <?php endforeach; ?>
            <div class="schedule-row closed"><span>Cumartesi–Pazar</span><strong><?php echo esc_html($settings['weekend_hours']); ?></strong></div>
        </div>
    </div>
</section>

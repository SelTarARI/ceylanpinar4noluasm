<?php
$doctors = new WP_Query([
    'post_type'      => 'asm_doctor',
    'posts_per_page' => -1,
    'orderby'        => ['menu_order' => 'ASC', 'title' => 'ASC'],
]);
?>
<section id="hekimler" class="section staff-section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Ekibimiz</p>
            <h2>Hekimlerimiz ve sağlık çalışanlarımız</h2>
            <p>Bağlı olduğunuz birimi seçerek hekiminizi ve birim çalışma saatlerini görebilirsiniz.</p>
        </div>
        <div class="staff-grid">
            <?php if ($doctors->have_posts()) : ?>
                <?php while ($doctors->have_posts()) : $doctors->the_post();
                    $unit = get_post_meta(get_the_ID(), '_asm_doctor_unit', true);
                    $title = get_post_meta(get_the_ID(), '_asm_doctor_title', true) ?: 'Aile Hekimi';
                    $worker = get_post_meta(get_the_ID(), '_asm_doctor_worker', true);
                    $hours = get_post_meta(get_the_ID(), '_asm_doctor_hours', true);
                ?>
                    <article class="staff-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="doctor-photo"><?php the_post_thumbnail('medium', ['loading' => 'lazy']); ?></div>
                        <?php else : ?>
                            <div class="avatar" aria-hidden="true"><?php echo esc_html(function_exists('mb_substr') ? mb_substr(get_the_title(), 0, 1) : substr(get_the_title(), 0, 1)); ?></div>
                        <?php endif; ?>
                        <?php if ($unit) : ?><div class="unit-label"><?php echo esc_html($unit); ?></div><?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html($title); ?></p>
                        <?php if ($worker) : ?><div class="staff-meta"><span>Birlikte çalıştığı aile sağlığı çalışanı</span><strong><?php echo esc_html($worker); ?></strong></div><?php endif; ?>
                        <?php if ($hours) : ?><button class="card-link doctor-hours-button" type="button" data-doctor="<?php echo esc_attr(get_the_title()); ?>" data-hours="<?php echo esc_attr($hours); ?>">Çalışma saatleri <span>+</span></button><?php endif; ?>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="empty-card"><strong>Hekim bilgileri hazırlanıyor.</strong><span>WordPress yönetiminden “Hekimler” bölümüne ilk kaydı ekleyin.</span></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
$services = new WP_Query([
    'post_type'      => 'asm_service',
    'posts_per_page' => -1,
    'orderby'        => ['menu_order' => 'ASC', 'title' => 'ASC'],
]);
?>
<section id="hizmetler" class="section services-section">
    <div class="container">
        <div class="section-heading heading-row">
            <div><p class="eyebrow">Birinci basamak sağlık hizmetleri</p><h2>Hizmetlerimiz</h2></div>
            <p>Her hizmet kartında işlem öncesinde bilmeniz gerekenleri bulabilirsiniz.</p>
        </div>
        <div class="service-grid">
            <?php if ($services->have_posts()) : ?>
                <?php $number = 1; while ($services->have_posts()) : $services->the_post();
                    $description = get_the_excerpt() ?: ceylanpinar_asm_excerpt(get_the_content(), 30);
                    $requirements = get_post_meta(get_the_ID(), '_asm_service_requirements', true) ?: 'T.C. kimlik kartınızı yanınızda bulundurunuz.';
                ?>
                    <article class="service-card">
                        <span class="service-number"><?php echo esc_html(str_pad((string) $number, 2, '0', STR_PAD_LEFT)); ?></span>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html($description); ?></p>
                        <button type="button" class="service-detail-button" data-service="<?php echo esc_attr(get_the_title()); ?>" data-description="<?php echo esc_attr($description); ?>" data-requirements="<?php echo esc_attr($requirements); ?>">Gerekli bilgileri gör <span>+</span></button>
                    </article>
                <?php $number++; endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="empty-card dark"><strong>Hizmet bilgileri hazırlanıyor.</strong><span>WordPress yönetiminden “Hizmetler” bölümüne kayıt ekleyin.</span></div>
            <?php endif; ?>
        </div>
    </div>
</section>

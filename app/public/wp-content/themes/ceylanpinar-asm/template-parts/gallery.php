<?php
$gallery = new WP_Query([
    'post_type'      => 'asm_gallery',
    'posts_per_page' => 4,
    'orderby'        => ['menu_order' => 'ASC', 'date' => 'DESC'],
]);
?>
<section id="asmimiz" class="section media-section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Merkezimizi tanıyın</p>
            <h2>ASM'miz</h2>
            <p>Merkezimizin dış cephesi, bekleme alanları ve hizmet alanlarına ait güncel görüntüler.</p>
        </div>
        <?php if ($gallery->have_posts()) : ?>
            <div class="gallery-grid">
                <?php while ($gallery->have_posts()) : $gallery->the_post();
                    $video = get_post_meta(get_the_ID(), '_asm_gallery_video', true);
                    $caption = get_post_meta(get_the_ID(), '_asm_gallery_caption', true);
                ?>
                    <article class="gallery-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                        <?php else : ?>
                            <div class="gallery-fallback"><span class="brand-mark large" aria-hidden="true"></span></div>
                        <?php endif; ?>
                        <div class="gallery-caption">
                            <h3><?php the_title(); ?></h3>
                            <?php if ($caption) : ?><p><?php echo esc_html($caption); ?></p><?php endif; ?>
                            <?php if ($video) : ?><a href="<?php echo esc_url($video); ?>" target="_blank" rel="noopener">Videoyu aç ↗</a><?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div class="empty-card"><strong>Güncel fotoğraf ve videolar hazırlanıyor.</strong><span>WordPress yönetiminden “Galeri” bölümüne görsel ekleyin.</span></div>
        <?php endif; ?>
    </div>
</section>

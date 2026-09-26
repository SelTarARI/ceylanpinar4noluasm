<?php
$today = wp_date('Y-m-d');
$notices = new WP_Query([
    'post_type'      => 'asm_notice',
    'posts_per_page' => 3,
    'meta_query'     => [
        'relation' => 'OR',
        ['key' => '_asm_notice_expiry', 'compare' => 'NOT EXISTS'],
        ['key' => '_asm_notice_expiry', 'value' => '', 'compare' => '='],
        ['key' => '_asm_notice_expiry', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
    ],
]);
?>
<section id="duyurular" class="section announcement-section">
    <div class="container">
        <div class="section-heading heading-row">
            <div><p class="eyebrow">Güncel bilgiler</p><h2>Duyurular</h2></div>
        </div>
        <div class="announcement-list">
            <?php if ($notices->have_posts()) : ?>
                <?php while ($notices->have_posts()) : $notices->the_post(); ?>
                    <article class="announcement">
                        <div class="announcement-date"><strong><?php echo esc_html(get_the_date('d')); ?></strong><span><?php echo esc_html(strtoupper(get_the_date('M'))); ?></span></div>
                        <div>
                            <?php if (get_post_meta(get_the_ID(), '_asm_notice_important', true) === '1') : ?><span class="announcement-tag">Önemli duyuru</span><?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo esc_html(ceylanpinar_asm_excerpt(get_the_excerpt() ?: get_the_content())); ?></p>
                        </div>
                        <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?> duyurusunu aç">→</a>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="empty-card"><strong>Şu anda güncel duyuru bulunmuyor.</strong><span>Yeni duyurular burada yayınlanacaktır.</span></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_header();
?>
<main id="icerik" class="content-page">
    <div class="container narrow-content">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <p class="eyebrow"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name ?? 'İçerik'); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content"><?php the_content(); ?></div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <h1>İçerik bulunamadı</h1>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();

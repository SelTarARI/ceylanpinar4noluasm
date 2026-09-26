<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#a71930">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#icerik">İçeriğe geç</a>

<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Ana sayfa">
            <span class="brand-mark" aria-hidden="true"></span>
            <span class="brand-copy">
                <small>T.C. Sağlık Bakanlığı</small>
                <strong><?php bloginfo('name'); ?></strong>
            </span>
        </a>

        <button class="menu-button" type="button" aria-expanded="false" aria-controls="ana-menu">
            <span class="sr-only">Menüyü aç</span>
            <span></span><span></span><span></span>
        </button>

        <nav id="ana-menu" class="main-nav" aria-label="Ana menü">
            <a href="<?php echo esc_url(home_url('/#hekimler')); ?>">Hekimlerimiz</a>
            <a href="<?php echo esc_url(home_url('/#saatler')); ?>">Çalışma Saatleri</a>
            <a href="<?php echo esc_url(home_url('/#hizmetler')); ?>">Hizmetler</a>
            <a href="<?php echo esc_url(home_url('/#duyurular')); ?>">Duyurular</a>
            <a href="<?php echo esc_url(home_url('/#asmimiz')); ?>">ASM'miz</a>
            <a class="nav-contact" href="<?php echo esc_url(home_url('/#iletisim')); ?>">İletişim</a>
        </nav>
    </div>
</header>

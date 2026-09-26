<?php

if (!defined('ABSPATH')) {
    exit;
}

define('CEYLANPINAR_ASM_VERSION', '1.0.0');

function ceylanpinar_asm_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => 'Ana Menü',
        'footer'  => 'Alt Menü',
    ]);
}
add_action('after_setup_theme', 'ceylanpinar_asm_setup');

function ceylanpinar_asm_enqueue_assets(): void
{
    wp_enqueue_style(
        'ceylanpinar-asm-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Source+Serif+4:opsz,wght@8..60,600;8..60,700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'ceylanpinar-asm-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['ceylanpinar-asm-fonts'],
        CEYLANPINAR_ASM_VERSION
    );

    wp_enqueue_script(
        'ceylanpinar-asm-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        CEYLANPINAR_ASM_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'ceylanpinar_asm_enqueue_assets');

function ceylanpinar_asm_register_content_types(): void
{
    $types = [
        'asm_doctor' => [
            'single' => 'Hekim',
            'plural' => 'Hekimler',
            'icon'   => 'dashicons-businessperson',
            'supports' => ['title', 'editor', 'thumbnail', 'page-attributes'],
        ],
        'asm_service' => [
            'single' => 'Hizmet',
            'plural' => 'Hizmetler',
            'icon'   => 'dashicons-heart',
            'supports' => ['title', 'editor', 'excerpt', 'page-attributes'],
        ],
        'asm_notice' => [
            'single' => 'Duyuru',
            'plural' => 'Duyurular',
            'icon'   => 'dashicons-megaphone',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        ],
        'asm_gallery' => [
            'single' => 'Galeri Öğesi',
            'plural' => 'Galeri',
            'icon'   => 'dashicons-format-gallery',
            'supports' => ['title', 'thumbnail', 'page-attributes'],
        ],
    ];

    foreach ($types as $slug => $type) {
        register_post_type($slug, [
            'labels' => [
                'name'          => $type['plural'],
                'singular_name' => $type['single'],
                'add_new_item'  => 'Yeni ' . $type['single'] . ' Ekle',
                'edit_item'     => $type['single'] . ' Düzenle',
                'all_items'     => 'Tüm ' . $type['plural'],
            ],
            'public'       => true,
            'show_in_rest' => true,
            'menu_icon'    => $type['icon'],
            'supports'     => $type['supports'],
            'has_archive'  => false,
            'rewrite'      => false,
        ]);
    }
}
add_action('init', 'ceylanpinar_asm_register_content_types');

function ceylanpinar_asm_add_meta_boxes(): void
{
    add_meta_box('asm_doctor_details', 'Hekim Bilgileri', 'ceylanpinar_asm_doctor_meta_box', 'asm_doctor', 'normal', 'high');
    add_meta_box('asm_service_details', 'Hizmet Bilgileri', 'ceylanpinar_asm_service_meta_box', 'asm_service', 'normal', 'high');
    add_meta_box('asm_notice_details', 'Duyuru Ayarları', 'ceylanpinar_asm_notice_meta_box', 'asm_notice', 'side', 'default');
    add_meta_box('asm_gallery_details', 'Galeri Bilgileri', 'ceylanpinar_asm_gallery_meta_box', 'asm_gallery', 'normal', 'high');
}
add_action('add_meta_boxes', 'ceylanpinar_asm_add_meta_boxes');

function ceylanpinar_asm_field(string $name, string $label, int $post_id, string $type = 'text', string $help = ''): void
{
    $value = get_post_meta($post_id, '_' . $name, true);
    ?>
    <p>
        <label for="<?php echo esc_attr($name); ?>"><strong><?php echo esc_html($label); ?></strong></label><br>
        <?php if ($type === 'textarea') : ?>
            <textarea class="widefat" rows="4" id="<?php echo esc_attr($name); ?>" name="<?php echo esc_attr($name); ?>"><?php echo esc_textarea($value); ?></textarea>
        <?php elseif ($type === 'checkbox') : ?>
            <label><input type="checkbox" id="<?php echo esc_attr($name); ?>" name="<?php echo esc_attr($name); ?>" value="1" <?php checked($value, '1'); ?>> Evet</label>
        <?php else : ?>
            <input class="widefat" type="<?php echo esc_attr($type); ?>" id="<?php echo esc_attr($name); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>">
        <?php endif; ?>
        <?php if ($help) : ?><small style="display:block;margin-top:5px;color:#646970"><?php echo esc_html($help); ?></small><?php endif; ?>
    </p>
    <?php
}

function ceylanpinar_asm_doctor_meta_box(WP_Post $post): void
{
    wp_nonce_field('ceylanpinar_asm_save_meta', 'ceylanpinar_asm_meta_nonce');
    ceylanpinar_asm_field('asm_doctor_title', 'Unvan', $post->ID, 'text', 'Örnek: Aile Hekimi');
    ceylanpinar_asm_field('asm_doctor_unit', 'Aile Hekimliği Birimi', $post->ID, 'text', 'Örnek: 1 Nolu Aile Hekimliği Birimi');
    ceylanpinar_asm_field('asm_doctor_worker', 'Birlikte Çalıştığı Aile Sağlığı Çalışanı', $post->ID);
    ceylanpinar_asm_field('asm_doctor_hours', 'Çalışma Saatleri', $post->ID, 'textarea', 'Her günü ayrı satıra yazabilirsiniz.');
}

function ceylanpinar_asm_service_meta_box(WP_Post $post): void
{
    wp_nonce_field('ceylanpinar_asm_save_meta', 'ceylanpinar_asm_meta_nonce');
    ceylanpinar_asm_field('asm_service_requirements', 'Gerekli Bilgi ve Belgeler', $post->ID, 'textarea');
}

function ceylanpinar_asm_notice_meta_box(WP_Post $post): void
{
    wp_nonce_field('ceylanpinar_asm_save_meta', 'ceylanpinar_asm_meta_nonce');
    ceylanpinar_asm_field('asm_notice_expiry', 'Yayından Kalkma Tarihi', $post->ID, 'date', 'Tarih geçince ana sayfada gösterilmez.');
    ceylanpinar_asm_field('asm_notice_important', 'Önemli Duyuru', $post->ID, 'checkbox');
}

function ceylanpinar_asm_gallery_meta_box(WP_Post $post): void
{
    wp_nonce_field('ceylanpinar_asm_save_meta', 'ceylanpinar_asm_meta_nonce');
    ceylanpinar_asm_field('asm_gallery_video', 'Video Adresi (isteğe bağlı)', $post->ID, 'url', 'YouTube veya başka bir video adresi. Fotoğraf için Öne Çıkan Görsel kullanın.');
    ceylanpinar_asm_field('asm_gallery_caption', 'Kısa Açıklama', $post->ID, 'textarea');
}

function ceylanpinar_asm_save_meta(int $post_id): void
{
    if (!isset($_POST['ceylanpinar_asm_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ceylanpinar_asm_meta_nonce'])), 'ceylanpinar_asm_save_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $text_fields = [
        'asm_doctor_title', 'asm_doctor_unit', 'asm_doctor_worker',
        'asm_notice_expiry',
    ];
    $textarea_fields = ['asm_doctor_hours', 'asm_service_requirements', 'asm_gallery_caption'];

    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field(wp_unslash($_POST[$field])));
        }
    }

    foreach ($textarea_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_textarea_field(wp_unslash($_POST[$field])));
        }
    }

    if (isset($_POST['asm_gallery_video'])) {
        update_post_meta($post_id, '_asm_gallery_video', esc_url_raw(wp_unslash($_POST['asm_gallery_video'])));
    }

    update_post_meta($post_id, '_asm_notice_important', isset($_POST['asm_notice_important']) ? '1' : '0');
}
add_action('save_post', 'ceylanpinar_asm_save_meta');

function ceylanpinar_asm_settings_defaults(): array
{
    return [
        'phone'             => '0414 000 00 00',
        'email'             => 'bilgi@ceylanpinar4noluasm.com.tr',
        'address'           => 'Adres bilgisi eklenecek, Ceylanpınar / Şanlıurfa',
        'weekday_hours'     => '08.00–17.00',
        'weekend_hours'     => 'Kapalı',
        'directions_url'    => '',
        'mhrs_url'          => 'https://mhrs.gov.tr/',
        'province_name'     => 'Şanlıurfa İl Sağlık Müdürlüğü',
        'province_url'      => 'https://sanliurfaism.saglik.gov.tr/',
        'province_contact'  => 'Adres ve telefon bilgisi eklenecek',
        'district_name'     => 'Ceylanpınar İlçe Sağlık Müdürlüğü',
        'district_url'      => '',
        'district_contact'  => 'Adres ve telefon bilgisi eklenecek',
        'last_updated'      => wp_date('d.m.Y'),
    ];
}

function ceylanpinar_asm_get_settings(): array
{
    return wp_parse_args((array) get_option('ceylanpinar_asm_settings', []), ceylanpinar_asm_settings_defaults());
}

function ceylanpinar_asm_register_settings(): void
{
    register_setting('ceylanpinar_asm_settings_group', 'ceylanpinar_asm_settings', [
        'type' => 'array',
        'sanitize_callback' => 'ceylanpinar_asm_sanitize_settings',
        'default' => ceylanpinar_asm_settings_defaults(),
    ]);
}
add_action('admin_init', 'ceylanpinar_asm_register_settings');

function ceylanpinar_asm_sanitize_settings(array $input): array
{
    $clean = [];
    $url_fields = ['directions_url', 'mhrs_url', 'province_url', 'district_url'];
    foreach (array_keys(ceylanpinar_asm_settings_defaults()) as $key) {
        if (!isset($input[$key])) {
            continue;
        }
        $clean[$key] = in_array($key, $url_fields, true)
            ? esc_url_raw($input[$key])
            : sanitize_textarea_field($input[$key]);
    }
    $clean['last_updated'] = wp_date('d.m.Y');
    return $clean;
}

function ceylanpinar_asm_add_settings_page(): void
{
    add_menu_page(
        'ASM Bilgileri',
        'ASM Bilgileri',
        'manage_options',
        'ceylanpinar-asm-settings',
        'ceylanpinar_asm_render_settings_page',
        'dashicons-admin-home',
        3
    );
}
add_action('admin_menu', 'ceylanpinar_asm_add_settings_page');

function ceylanpinar_asm_render_settings_page(): void
{
    if (!current_user_can('manage_options')) {
        return;
    }
    $settings = ceylanpinar_asm_get_settings();
    $fields = [
        'phone'            => ['Telefon', 'text'],
        'email'            => ['E-posta', 'email'],
        'address'          => ['Adres', 'textarea'],
        'weekday_hours'    => ['Hafta İçi Çalışma Saatleri', 'text'],
        'weekend_hours'    => ['Hafta Sonu', 'text'],
        'directions_url'   => ['Harita / Yol Tarifi Adresi', 'url'],
        'mhrs_url'         => ['MHRS Adresi', 'url'],
        'province_name'    => ['İl Sağlık Müdürlüğü Adı', 'text'],
        'province_url'     => ['İl Sağlık Müdürlüğü Web Adresi', 'url'],
        'province_contact' => ['İl Sağlık Müdürlüğü Adres / Telefon', 'textarea'],
        'district_name'    => ['İlçe Sağlık Müdürlüğü Adı', 'text'],
        'district_url'     => ['İlçe Sağlık Müdürlüğü Web Adresi', 'url'],
        'district_contact' => ['İlçe Sağlık Müdürlüğü Adres / Telefon', 'textarea'],
    ];
    ?>
    <div class="wrap">
        <h1>ASM Bilgileri</h1>
        <p>Bu bilgiler sitenin ilgili bölümlerinde otomatik olarak gösterilir. Kaydettiğinizde “Son güncelleme” tarihi de yenilenir.</p>
        <form action="options.php" method="post">
            <?php settings_fields('ceylanpinar_asm_settings_group'); ?>
            <table class="form-table" role="presentation">
                <?php foreach ($fields as $key => [$label, $type]) : ?>
                    <tr>
                        <th scope="row"><label for="asm_<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label></th>
                        <td>
                            <?php if ($type === 'textarea') : ?>
                                <textarea class="large-text" rows="3" id="asm_<?php echo esc_attr($key); ?>" name="ceylanpinar_asm_settings[<?php echo esc_attr($key); ?>]"><?php echo esc_textarea($settings[$key]); ?></textarea>
                            <?php else : ?>
                                <input class="regular-text" type="<?php echo esc_attr($type); ?>" id="asm_<?php echo esc_attr($key); ?>" name="ceylanpinar_asm_settings[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($settings[$key]); ?>">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php submit_button('ASM Bilgilerini Kaydet'); ?>
        </form>
    </div>
    <?php
}

function ceylanpinar_asm_body_classes(array $classes): array
{
    $classes[] = 'ceylanpinar-asm-theme';
    return $classes;
}
add_filter('body_class', 'ceylanpinar_asm_body_classes');

function ceylanpinar_asm_excerpt(string $text, int $words = 22): string
{
    return wp_trim_words(wp_strip_all_tags($text), $words, '…');
}

function ceylanpinar_asm_add_sample_content(): void
{
    ceylanpinar_asm_register_content_types();

    if (get_option('ceylanpinar_asm_sample_content_added')) {
        return;
    }

    if (!get_option('ceylanpinar_asm_settings')) {
        update_option('ceylanpinar_asm_settings', ceylanpinar_asm_settings_defaults());
    }

    $existing_doctors = get_posts(['post_type' => 'asm_doctor', 'numberposts' => 1, 'fields' => 'ids']);
    if (!$existing_doctors) {
        $doctor_id = wp_insert_post([
            'post_type'   => 'asm_doctor',
            'post_status' => 'publish',
            'post_title'  => 'Dr. Fatih [Soyadı]',
            'post_content'=> 'Bu örnek hekim kaydını gerçek bilgilerle güncelleyin.',
            'menu_order'  => 1,
        ]);
        if (!is_wp_error($doctor_id)) {
            update_post_meta($doctor_id, '_asm_doctor_title', 'Aile Hekimi');
            update_post_meta($doctor_id, '_asm_doctor_unit', '1 Nolu Aile Hekimliği Birimi');
            update_post_meta($doctor_id, '_asm_doctor_worker', '[Aile sağlığı çalışanı adı]');
            update_post_meta($doctor_id, '_asm_doctor_hours', "Pazartesi–Cuma: 08.00–17.00\nEsnek mesai bilgisi eklenecek");
        }
    }

    $service_samples = [
        ['Muayene ve danışmanlık', 'Koruyucu, tanı ve tedavi edici birinci basamak sağlık hizmetleri.'],
        ['Gebe ve lohusa izlemi', 'Gebelik ve doğum sonrası dönemde düzenli takip ve danışmanlık.'],
        ['Bebek ve çocuk izlemi', 'Büyüme, gelişme, tarama ve çocuk sağlığı izlemleri.'],
        ['Aşılama hizmetleri', 'Ulusal aşı takvimine uygun bebek, çocuk ve erişkin aşıları.'],
        ['Kronik hastalık izlemi', 'Hipertansiyon, diyabet ve benzeri hastalıklarda düzenli izlem.'],
        ['Kanser taramaları', 'Uygun yaş grupları için bilgilendirme ve tarama yönlendirmeleri.'],
    ];

    $existing_services = get_posts(['post_type' => 'asm_service', 'numberposts' => 1, 'fields' => 'ids']);
    if (!$existing_services) {
        foreach ($service_samples as $order => [$title, $excerpt]) {
            $service_id = wp_insert_post([
                'post_type'    => 'asm_service',
                'post_status'  => 'publish',
                'post_title'   => $title,
                'post_excerpt' => $excerpt,
                'post_content' => $excerpt,
                'menu_order'   => $order + 1,
            ]);
            if (!is_wp_error($service_id)) {
                update_post_meta($service_id, '_asm_service_requirements', 'T.C. kimlik kartınızı yanınızda bulundurunuz. Hizmete özel bilgiler yayın öncesinde güncellenmelidir.');
            }
        }
    }

    $existing_notices = get_posts(['post_type' => 'asm_notice', 'numberposts' => 1, 'fields' => 'ids']);
    if (!$existing_notices) {
        $notice_id = wp_insert_post([
            'post_type'    => 'asm_notice',
            'post_status'  => 'publish',
            'post_title'   => 'Örnek duyuru – yayın öncesinde değiştirin',
            'post_excerpt' => 'Duyurular bölümünün görünümünü kontrol etmek için eklenmiş örnek içeriktir.',
            'post_content' => 'Bu örnek duyuruyu WordPress yönetim panelindeki Duyurular bölümünden düzenleyebilir veya silebilirsiniz.',
        ]);
        if (!is_wp_error($notice_id)) {
            update_post_meta($notice_id, '_asm_notice_important', '1');
        }
    }

    update_option('ceylanpinar_asm_sample_content_added', '1');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ceylanpinar_asm_add_sample_content');

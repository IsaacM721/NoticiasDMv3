<?php
/**
 * NoticiasDM Theme Functions
 * Funciones personalizadas para el tema de NoticiasDM
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Soporte del tema
function noticiasdm_theme_setup() {
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Menús de navegación
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer' => 'Menú Footer',
    ));
}
add_action('after_setup_theme', 'noticiasdm_theme_setup');

// Encolar estilos y scripts
function noticiasdm_scripts() {
    // Estilo principal del tema
    wp_enqueue_style('noticiasdm-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Estilos adicionales
    wp_enqueue_style('noticiasdm-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0');
    
    // Scripts
    wp_enqueue_script('noticiasdm-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localizar script para AJAX
    wp_localize_script('noticiasdm-main', 'noticiasdm_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('noticiasdm_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'noticiasdm_scripts');

// Registrar áreas de widgets
function noticiasdm_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar Principal',
        'id' => 'sidebar-1',
        'description' => 'Widgets para la barra lateral principal',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widgets',
        'id' => 'footer-widgets',
        'description' => 'Widgets para el pie de página',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'noticiasdm_widgets_init');

// Función para obtener artículos de Supabase (helper)
function get_noticiasdm_articles($limit = 6, $category = null) {
    if (class_exists('NoticiasDMSupabase')) {
        $plugin = new NoticiasDMSupabase();
        return $plugin->get_articles($limit, $category);
    }
    return array('error' => 'Plugin NoticiasDM no está activo');
}

// Función para obtener categorías de Supabase (helper)
function get_noticiasdm_categories() {
    if (class_exists('NoticiasDMSupabase')) {
        $plugin = new NoticiasDMSupabase();
        return $plugin->get_categories();
    }
    return array();
}

// AJAX para cargar más artículos
function noticiasdm_load_more_articles() {
    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'noticiasdm_nonce')) {
        wp_die('Seguridad fallida');
    }
    
    $page = intval($_POST['page']);
    $limit = intval($_POST['limit']);
    $category = sanitize_text_field($_POST['category']);
    
    $articles = get_noticiasdm_articles($limit, $category);
    
    if (isset($articles['error'])) {
        wp_send_json_error($articles['error']);
    }
    
    ob_start();
    foreach ($articles as $article) {
        get_template_part('template-parts/article', 'card', array('article' => $article));
    }
    $html = ob_get_clean();
    
    wp_send_json_success($html);
}
add_action('wp_ajax_load_more_articles', 'noticiasdm_load_more_articles');
add_action('wp_ajax_nopriv_load_more_articles', 'noticiasdm_load_more_articles');

// Personalizar excerpt
function noticiasdm_custom_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'noticiasdm_custom_excerpt_length');

function noticiasdm_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'noticiasdm_custom_excerpt_more');

// Agregar clases CSS personalizadas al body
function noticiasdm_body_classes($classes) {
    if (is_home() || is_front_page()) {
        $classes[] = 'noticiasdm-home';
    }
    
    if (is_single()) {
        $classes[] = 'noticiasdm-single';
    }
    
    return $classes;
}
add_filter('body_class', 'noticiasdm_body_classes');

// Función para formatear fechas en español
function noticiasdm_format_date($date, $format = 'd/m/Y') {
    $months = array(
        'January' => 'Enero',
        'February' => 'Febrero',
        'March' => 'Marzo',
        'April' => 'Abril',
        'May' => 'Mayo',
        'June' => 'Junio',
        'July' => 'Julio',
        'August' => 'Agosto',
        'September' => 'Septiembre',
        'October' => 'Octubre',
        'November' => 'Noviembre',
        'December' => 'Diciembre'
    );
    
    $formatted_date = date($format, strtotime($date));
    return str_replace(array_keys($months), array_values($months), $formatted_date);
}

// Customizer para opciones del tema
function noticiasdm_customize_register($wp_customize) {
    // Sección de colores
    $wp_customize->add_section('noticiasdm_colors', array(
        'title' => 'Colores NoticiasDM',
        'priority' => 30,
    ));
    
    // Color principal
    $wp_customize->add_setting('noticiasdm_primary_color', array(
        'default' => '#36b7ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'noticiasdm_primary_color', array(
        'label' => 'Color Principal',
        'section' => 'noticiasdm_colors',
        'settings' => 'noticiasdm_primary_color',
    )));
    
    // Sección de configuración general
    $wp_customize->add_section('noticiasdm_general', array(
        'title' => 'Configuración General',
        'priority' => 35,
    ));
    
    // Logo personalizado
    $wp_customize->add_setting('noticiasdm_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'noticiasdm_logo', array(
        'label' => 'Logo del Sitio',
        'section' => 'noticiasdm_general',
        'settings' => 'noticiasdm_logo',
    )));
}
add_action('customize_register', 'noticiasdm_customize_register');

// Función para mostrar el logo
function noticiasdm_logo() {
    $logo = get_theme_mod('noticiasdm_logo');
    if ($logo) {
        echo '<img src="' . esc_url($logo) . '" alt="' . get_bloginfo('name') . '" class="site-logo">';
    } else {
        echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
    }
}

// Agregar estilos dinámicos del customizer
function noticiasdm_customizer_css() {
    $primary_color = get_theme_mod('noticiasdm_primary_color', '#36b7ff');
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
        }
        
        .site-header,
        .category-badge,
        .btn-primary,
        .widget-title::after {
            background-color: var(--primary-color);
        }
        
        a:hover,
        .article-title:hover {
            color: var(--primary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'noticiasdm_customizer_css');
?>
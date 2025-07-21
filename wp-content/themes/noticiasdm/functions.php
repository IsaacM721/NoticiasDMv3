<?php
/**
 * NoticiasDM Theme Functions
 * Complete WordPress solution with custom post types and fields
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function noticiasdm_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    
    // Image sizes
    add_image_size('hero-image', 1200, 400, true);
    add_image_size('card-image', 400, 250, true);
    
    // Menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'noticiasdm_setup');

// Enqueue styles and scripts
function noticiasdm_scripts() {
    wp_enqueue_style('noticiasdm-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('noticiasdm-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'noticiasdm_scripts');

// Register Custom Post Types
function noticiasdm_custom_post_types() {
    // Articles Post Type
    register_post_type('article', array(
        'labels' => array(
            'name' => 'Artículos',
            'singular_name' => 'Artículo',
            'add_new' => 'Agregar Nuevo',
            'add_new_item' => 'Agregar Nuevo Artículo',
            'edit_item' => 'Editar Artículo',
            'new_item' => 'Nuevo Artículo',
            'view_item' => 'Ver Artículo',
            'search_items' => 'Buscar Artículos',
            'not_found' => 'No se encontraron artículos',
            'not_found_in_trash' => 'No hay artículos en la papelera'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments'),
        'menu_icon' => 'dashicons-admin-post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'articulos'),
    ));
    
    // Writers Post Type
    register_post_type('writer', array(
        'labels' => array(
            'name' => 'Escritores',
            'singular_name' => 'Escritor',
            'add_new' => 'Agregar Nuevo',
            'add_new_item' => 'Agregar Nuevo Escritor',
            'edit_item' => 'Editar Escritor',
            'new_item' => 'Nuevo Escritor',
            'view_item' => 'Ver Escritor',
            'search_items' => 'Buscar Escritores',
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-users',
        'show_in_rest' => true,
    ));
}
add_action('init', 'noticiasdm_custom_post_types');

// Register Taxonomies
function noticiasdm_taxonomies() {
    // Categories
    register_taxonomy('article_category', 'article', array(
        'labels' => array(
            'name' => 'Categorías',
            'singular_name' => 'Categoría',
            'add_new_item' => 'Agregar Nueva Categoría',
            'edit_item' => 'Editar Categoría',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'categoria'),
    ));
    
    // Tags
    register_taxonomy('article_tag', 'article', array(
        'labels' => array(
            'name' => 'Etiquetas',
            'singular_name' => 'Etiqueta',
            'add_new_item' => 'Agregar Nueva Etiqueta',
        ),
        'hierarchical' => false,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'etiqueta'),
    ));
}
add_action('init', 'noticiasdm_taxonomies');

// Add Custom Fields (Meta Boxes)
function noticiasdm_add_meta_boxes() {
    add_meta_box(
        'article_details',
        'Detalles del Artículo',
        'noticiasdm_article_meta_box',
        'article',
        'normal',
        'high'
    );
    
    add_meta_box(
        'writer_details',
        'Detalles del Escritor',
        'noticiasdm_writer_meta_box',
        'writer',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'noticiasdm_add_meta_boxes');

// Article Meta Box
function noticiasdm_article_meta_box($post) {
    wp_nonce_field('noticiasdm_article_meta', 'noticiasdm_article_nonce');
    
    $read_time = get_post_meta($post->ID, '_read_time', true);
    $featured = get_post_meta($post->ID, '_featured', true);
    $seo_title = get_post_meta($post->ID, '_seo_title', true);
    $seo_description = get_post_meta($post->ID, '_seo_description', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="read_time">Tiempo de Lectura (minutos)</label></th>
            <td><input type="number" id="read_time" name="read_time" value="<?php echo esc_attr($read_time); ?>" min="1" /></td>
        </tr>
        <tr>
            <th><label for="featured">Artículo Destacado</label></th>
            <td><input type="checkbox" id="featured" name="featured" value="1" <?php checked($featured, 1); ?> /></td>
        </tr>
        <tr>
            <th><label for="seo_title">Título SEO</label></th>
            <td><input type="text" id="seo_title" name="seo_title" value="<?php echo esc_attr($seo_title); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="seo_description">Descripción SEO</label></th>
            <td><textarea id="seo_description" name="seo_description" rows="3" class="large-text"><?php echo esc_textarea($seo_description); ?></textarea></td>
        </tr>
    </table>
    <?php
}

// Writer Meta Box
function noticiasdm_writer_meta_box($post) {
    wp_nonce_field('noticiasdm_writer_meta', 'noticiasdm_writer_nonce');
    
    $email = get_post_meta($post->ID, '_writer_email', true);
    $twitter = get_post_meta($post->ID, '_writer_twitter', true);
    $linkedin = get_post_meta($post->ID, '_writer_linkedin', true);
    $specialties = get_post_meta($post->ID, '_writer_specialties', true);
    $verified = get_post_meta($post->ID, '_writer_verified', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="writer_email">Email</label></th>
            <td><input type="email" id="writer_email" name="writer_email" value="<?php echo esc_attr($email); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="writer_twitter">Twitter</label></th>
            <td><input type="url" id="writer_twitter" name="writer_twitter" value="<?php echo esc_attr($twitter); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="writer_linkedin">LinkedIn</label></th>
            <td><input type="url" id="writer_linkedin" name="writer_linkedin" value="<?php echo esc_attr($linkedin); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="writer_specialties">Especialidades</label></th>
            <td><input type="text" id="writer_specialties" name="writer_specialties" value="<?php echo esc_attr($specialties); ?>" class="regular-text" placeholder="Separadas por comas" /></td>
        </tr>
        <tr>
            <th><label for="writer_verified">Escritor Verificado</label></th>
            <td><input type="checkbox" id="writer_verified" name="writer_verified" value="1" <?php checked($verified, 1); ?> /></td>
        </tr>
    </table>
    <?php
}

// Save Meta Box Data
function noticiasdm_save_meta_boxes($post_id) {
    // Article meta
    if (isset($_POST['noticiasdm_article_nonce']) && wp_verify_nonce($_POST['noticiasdm_article_nonce'], 'noticiasdm_article_meta')) {
        if (isset($_POST['read_time'])) {
            update_post_meta($post_id, '_read_time', sanitize_text_field($_POST['read_time']));
        }
        update_post_meta($post_id, '_featured', isset($_POST['featured']) ? 1 : 0);
        if (isset($_POST['seo_title'])) {
            update_post_meta($post_id, '_seo_title', sanitize_text_field($_POST['seo_title']));
        }
        if (isset($_POST['seo_description'])) {
            update_post_meta($post_id, '_seo_description', sanitize_textarea_field($_POST['seo_description']));
        }
    }
    
    // Writer meta
    if (isset($_POST['noticiasdm_writer_nonce']) && wp_verify_nonce($_POST['noticiasdm_writer_nonce'], 'noticiasdm_writer_meta')) {
        $fields = array('writer_email', 'writer_twitter', 'writer_linkedin', 'writer_specialties');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
        update_post_meta($post_id, '_writer_verified', isset($_POST['writer_verified']) ? 1 : 0);
    }
}
add_action('save_post', 'noticiasdm_save_meta_boxes');

// Create sample content on theme activation
function noticiasdm_create_sample_content() {
    if (get_option('noticiasdm_sample_created')) {
        return;
    }
    
    // Create categories
    $categories = array(
        array('name' => 'Política', 'slug' => 'politica', 'color' => '#dc2626'),
        array('name' => 'Deportes', 'slug' => 'deportes', 'color' => '#16a34a'),
        array('name' => 'Tecnología', 'slug' => 'tecnologia', 'color' => '#2563eb'),
        array('name' => 'Economía', 'slug' => 'economia', 'color' => '#ca8a04'),
        array('name' => 'Cultura', 'slug' => 'cultura', 'color' => '#7c3aed'),
    );
    
    foreach ($categories as $cat) {
        $term = wp_insert_term($cat['name'], 'article_category', array('slug' => $cat['slug']));
        if (!is_wp_error($term)) {
            add_term_meta($term['term_id'], 'category_color', $cat['color']);
        }
    }
    
    // Create sample writers
    $writers = array(
        array(
            'title' => 'María González',
            'content' => 'Periodista especializada en tecnología y innovación con más de 8 años de experiencia. Graduada en Comunicación Social por la UASD.',
            'email' => 'maria.gonzalez@noticiasdm.com',
            'specialties' => 'Tecnología, Innovación, Startups',
            'verified' => true
        ),
        array(
            'title' => 'Carlos Rodríguez',
            'content' => 'Analista económico y financiero con experiencia en mercados internacionales. MBA en Finanzas por INTEC.',
            'email' => 'carlos.rodriguez@noticiasdm.com',
            'specialties' => 'Economía, Finanzas, Criptomonedas',
            'verified' => true
        )
    );
    
    foreach ($writers as $writer) {
        $writer_id = wp_insert_post(array(
            'post_title' => $writer['title'],
            'post_content' => $writer['content'],
            'post_type' => 'writer',
            'post_status' => 'publish'
        ));
        
        if ($writer_id) {
            update_post_meta($writer_id, '_writer_email', $writer['email']);
            update_post_meta($writer_id, '_writer_specialties', $writer['specialties']);
            update_post_meta($writer_id, '_writer_verified', $writer['verified'] ? 1 : 0);
        }
    }
    
    // Create sample articles
    $articles = array(
        array(
            'title' => 'Nuevas Tecnologías Revolucionan el Sector Turístico Dominicano',
            'content' => '<p>El sector turístico de República Dominicana está experimentando una transformación sin precedentes gracias a la implementación de nuevas tecnologías que mejoran la experiencia del visitante y optimizan los procesos operativos.</p><p>Según datos del Ministerio de Turismo, la adopción de tecnologías como la inteligencia artificial, realidad virtual y aplicaciones móviles ha incrementado la satisfacción del turista en un 35% durante el último año.</p><h2>Innovaciones Destacadas</h2><p>Entre las principales innovaciones se encuentran:</p><ul><li>Sistemas de check-in automatizado en hoteles</li><li>Tours virtuales de destinos turísticos</li><li>Aplicaciones móviles para reservas y pagos</li><li>Chatbots para atención al cliente 24/7</li></ul><p>Estas mejoras han posicionado a República Dominicana como un destino líder en innovación turística en la región del Caribe.</p>',
            'excerpt' => 'El sector turístico dominicano abraza las nuevas tecnologías para mejorar la experiencia del visitante y optimizar procesos operativos.',
            'category' => 'tecnologia',
            'read_time' => 4,
            'featured' => true
        ),
        array(
            'title' => 'Análisis: El Impacto de las Criptomonedas en la Economía Nacional',
            'content' => '<p>Las criptomonedas han comenzado a tener un impacto significativo en la economía dominicana, con un crecimiento del 150% en adopción durante los últimos dos años.</p><p>Expertos económicos señalan que esta tendencia representa tanto oportunidades como desafíos para el sistema financiero tradicional del país.</p><h2>Estadísticas Relevantes</h2><p>Los datos más recientes muestran:</p><ul><li>Más de 500,000 dominicanos usan criptomonedas</li><li>Volumen de transacciones: $2.3 billones en 2023</li><li>Crecimiento del 45% en comercios que aceptan cripto</li></ul><p>El Banco Central ha iniciado estudios para regular este mercado emergente.</p>',
            'excerpt' => 'Las criptomonedas muestran un crecimiento explosivo en República Dominicana, generando debate sobre regulación y adopción.',
            'category' => 'economia',
            'read_time' => 6,
            'featured' => false
        ),
        array(
            'title' => 'Temporada de Baseball: Análisis del Rendimiento de Jugadores Dominicanos en MLB',
            'content' => '<p>La temporada 2024 de las Grandes Ligas ha sido excepcional para los jugadores dominicanos, con múltiples récords establecidos y actuaciones destacadas.</p><p>República Dominicana mantiene su posición como el segundo país con más jugadores en MLB, con 102 peloteros activos en la liga.</p><h2>Destacados de la Temporada</h2><p>Los logros más importantes incluyen:</p><ul><li>3 jugadores dominicanos en el All-Star Game</li><li>Récord de jonrones por jugadores dominicanos: 156</li><li>2 Cy Young Awards ganados por pitchers dominicanos</li><li>Incremento del 12% en contratos millonarios</li></ul><p>Estos resultados consolidan el talento dominicano en el baseball mundial.</p>',
            'excerpt' => 'Los peloteros dominicanos brillan en la temporada 2024 de MLB con múltiples récords y actuaciones destacadas.',
            'category' => 'deportes',
            'read_time' => 5,
            'featured' => false
        )
    );
    
    foreach ($articles as $article) {
        $article_id = wp_insert_post(array(
            'post_title' => $article['title'],
            'post_content' => $article['content'],
            'post_excerpt' => $article['excerpt'],
            'post_type' => 'article',
            'post_status' => 'publish'
        ));
        
        if ($article_id) {
            update_post_meta($article_id, '_read_time', $article['read_time']);
            update_post_meta($article_id, '_featured', $article['featured'] ? 1 : 0);
            
            // Assign category
            $term = get_term_by('slug', $article['category'], 'article_category');
            if ($term) {
                wp_set_post_terms($article_id, array($term->term_id), 'article_category');
            }
        }
    }
    
    update_option('noticiasdm_sample_created', true);
}
add_action('after_switch_theme', 'noticiasdm_create_sample_content');

// Helper functions
function get_article_read_time($post_id) {
    return get_post_meta($post_id, '_read_time', true) ?: 5;
}

function is_featured_article($post_id) {
    return get_post_meta($post_id, '_featured', true);
}

function get_category_color($term_id) {
    return get_term_meta($term_id, 'category_color', true) ?: '#36b7ff';
}

// Widgets
function noticiasdm_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar Principal',
        'id' => 'sidebar-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'noticiasdm_widgets_init');

// Custom excerpt length
function noticiasdm_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'noticiasdm_excerpt_length');

// Format date in Spanish
function noticiasdm_format_date($date) {
    $months = array(
        'January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo',
        'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio',
        'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
        'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'
    );
    
    $formatted = date('j \d\e F, Y', strtotime($date));
    return str_replace(array_keys($months), array_values($months), $formatted);
}
?>
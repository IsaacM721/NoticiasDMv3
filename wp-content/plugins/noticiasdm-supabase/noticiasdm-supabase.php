<?php
/**
 * Plugin Name: NoticiasDM Supabase Integration
 * Description: Integración de Supabase para mostrar artículos en WordPress
 * Version: 1.0
 * Author: NoticiasDM
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class NoticiasDMSupabase {
    
    private $supabase_url;
    private $supabase_key;
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode('noticiasdm_articles', array($this, 'display_articles_shortcode'));
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_init', array($this, 'admin_init'));
        
        // Configuración desde opciones de WordPress
        $this->supabase_url = get_option('noticiasdm_supabase_url', '');
        $this->supabase_key = get_option('noticiasdm_supabase_key', '');
    }
    
    public function init() {
        // Registrar custom post type para cache local (opcional)
        register_post_type('noticiasdm_article', array(
            'labels' => array(
                'name' => 'Artículos NoticiasDM',
                'singular_name' => 'Artículo'
            ),
            'public' => false,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail')
        ));
    }
    
    public function enqueue_scripts() {
        wp_enqueue_style('noticiasdm-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    }
    
    // Función principal para obtener artículos de Supabase
    public function get_articles($limit = 10, $category = null) {
        if (empty($this->supabase_url) || empty($this->supabase_key)) {
            return array('error' => 'Configuración de Supabase incompleta');
        }
        
        $endpoint = rtrim($this->supabase_url, '/') . '/rest/v1/articles';
        $query_params = array(
            'select' => '*,category:categories(*)',
            'status' => 'eq.published',
            'order' => 'published_at.desc',
            'limit' => $limit
        );
        
        if ($category) {
            $query_params['category_id'] = 'eq.' . $category;
        }
        
        $url = $endpoint . '?' . http_build_query($query_params);
        
        $headers = array(
            'apikey' => $this->supabase_key,
            'Authorization' => 'Bearer ' . $this->supabase_key,
            'Content-Type' => 'application/json'
        );
        
        $response = wp_remote_get($url, array(
            'headers' => $headers,
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array('error' => 'Error de conexión: ' . $response->get_error_message());
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return array('error' => 'Error al procesar datos');
        }
        
        return $data;
    }
    
    // Obtener categorías
    public function get_categories() {
        if (empty($this->supabase_url) || empty($this->supabase_key)) {
            return array();
        }
        
        $endpoint = rtrim($this->supabase_url, '/') . '/rest/v1/categories';
        $url = $endpoint . '?order=name.asc';
        
        $headers = array(
            'apikey' => $this->supabase_key,
            'Authorization' => 'Bearer ' . $this->supabase_key,
            'Content-Type' => 'application/json'
        );
        
        $response = wp_remote_get($url, array(
            'headers' => $headers,
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array();
        }
        
        $body = wp_remote_retrieve_body($response);
        return json_decode($body) ?: array();
    }
    
    // Shortcode para mostrar artículos
    public function display_articles_shortcode($atts) {
        $atts = shortcode_atts(array(
            'limit' => 6,
            'category' => null,
            'layout' => 'grid'
        ), $atts);
        
        $articles = $this->get_articles($atts['limit'], $atts['category']);
        
        if (isset($articles['error'])) {
            return '<div class="noticiasdm-error">Error: ' . esc_html($articles['error']) . '</div>';
        }
        
        if (empty($articles)) {
            return '<div class="noticiasdm-no-articles">No hay artículos disponibles.</div>';
        }
        
        ob_start();
        ?>
        <div class="noticiasdm-articles-container">
            <div class="noticiasdm-articles-grid layout-<?php echo esc_attr($atts['layout']); ?>">
                <?php foreach ($articles as $article): ?>
                    <article class="noticiasdm-article-card">
                        <?php if (!empty($article->featured_image)): ?>
                            <div class="article-image">
                                <img src="<?php echo esc_url($article->featured_image); ?>" 
                                     alt="<?php echo esc_attr($article->title); ?>"
                                     loading="lazy">
                            </div>
                        <?php endif; ?>
                        
                        <div class="article-content">
                            <?php if (!empty($article->category)): ?>
                                <span class="category-badge" 
                                      style="background-color: <?php echo esc_attr($article->category->color); ?>">
                                    <?php echo esc_html($article->category->name); ?>
                                </span>
                            <?php endif; ?>
                            
                            <h3 class="article-title">
                                <?php echo esc_html($article->title); ?>
                            </h3>
                            
                            <?php if (!empty($article->excerpt)): ?>
                                <p class="article-excerpt">
                                    <?php echo esc_html($article->excerpt); ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="article-meta">
                                <?php if (!empty($article->published_at)): ?>
                                    <span class="publish-date">
                                        <?php echo date('d/m/Y', strtotime($article->published_at)); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    // Panel de administración
    public function admin_menu() {
        add_options_page(
            'NoticiasDM Supabase',
            'NoticiasDM Supabase',
            'manage_options',
            'noticiasdm-supabase',
            array($this, 'admin_page')
        );
    }
    
    public function admin_init() {
        register_setting('noticiasdm_supabase', 'noticiasdm_supabase_url');
        register_setting('noticiasdm_supabase', 'noticiasdm_supabase_key');
    }
    
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>Configuración NoticiasDM Supabase</h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('noticiasdm_supabase'); ?>
                <?php do_settings_sections('noticiasdm_supabase'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">URL de Supabase</th>
                        <td>
                            <input type="url" name="noticiasdm_supabase_url" 
                                   value="<?php echo esc_attr(get_option('noticiasdm_supabase_url')); ?>" 
                                   class="regular-text" placeholder="https://tu-proyecto.supabase.co" />
                            <p class="description">URL de tu proyecto Supabase</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Anon Key</th>
                        <td>
                            <input type="text" name="noticiasdm_supabase_key" 
                                   value="<?php echo esc_attr(get_option('noticiasdm_supabase_key')); ?>" 
                                   class="regular-text" />
                            <p class="description">Tu clave anónima de Supabase</p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button(); ?>
            </form>
            
            <hr>
            
            <h2>Uso del Shortcode</h2>
            <p>Usa estos shortcodes en tus páginas o posts:</p>
            <ul>
                <li><code>[noticiasdm_articles]</code> - Muestra 6 artículos por defecto</li>
                <li><code>[noticiasdm_articles limit="10"]</code> - Muestra 10 artículos</li>
                <li><code>[noticiasdm_articles category="1"]</code> - Muestra artículos de una categoría específica</li>
                <li><code>[noticiasdm_articles layout="list"]</code> - Muestra en formato lista</li>
            </ul>
            
            <h2>Test de Conexión</h2>
            <?php
            if (!empty($this->supabase_url) && !empty($this->supabase_key)) {
                $test_articles = $this->get_articles(1);
                if (isset($test_articles['error'])) {
                    echo '<div class="notice notice-error"><p>Error de conexión: ' . esc_html($test_articles['error']) . '</p></div>';
                } else {
                    echo '<div class="notice notice-success"><p>✅ Conexión exitosa! Se encontraron artículos.</p></div>';
                }
            } else {
                echo '<div class="notice notice-warning"><p>⚠️ Completa la configuración para probar la conexión.</p></div>';
            }
            ?>
        </div>
        <?php
    }
}

// Inicializar el plugin
new NoticiasDMSupabase();

// Widget para sidebar
class NoticiasDM_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'noticiasdm_widget',
            'NoticiasDM Artículos',
            array('description' => 'Muestra artículos de NoticiasDM desde Supabase')
        );
    }
    
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Últimas Noticias';
        $limit = !empty($instance['limit']) ? $instance['limit'] : 5;
        
        echo $args['before_widget'];
        echo $args['before_title'] . esc_html($title) . $args['after_title'];
        
        $plugin = new NoticiasDMSupabase();
        $articles = $plugin->get_articles($limit);
        
        if (!isset($articles['error']) && !empty($articles)) {
            echo '<ul class="noticiasdm-widget-list">';
            foreach ($articles as $article) {
                echo '<li>';
                echo '<a href="#" class="widget-article-title">' . esc_html($article->title) . '</a>';
                if (!empty($article->published_at)) {
                    echo '<span class="widget-article-date">' . date('d/m/Y', strtotime($article->published_at)) . '</span>';
                }
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No hay artículos disponibles.</p>';
        }
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Últimas Noticias';
        $limit = !empty($instance['limit']) ? $instance['limit'] : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">Número de artículos:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" 
                   name="<?php echo $this->get_field_name('limit'); ?>" type="number" 
                   value="<?php echo esc_attr($limit); ?>" min="1" max="20">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['limit'] = (!empty($new_instance['limit'])) ? intval($new_instance['limit']) : 5;
        return $instance;
    }
}

// Registrar widget
add_action('widgets_init', function() {
    register_widget('NoticiasDM_Widget');
});
?>
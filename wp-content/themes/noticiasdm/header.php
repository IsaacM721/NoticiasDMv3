<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- SEO Meta Tags -->
    <?php if (is_single() && get_post_type() == 'article') : ?>
        <meta property="og:title" content="<?php echo get_post_meta(get_the_ID(), '_seo_title', true) ?: get_the_title(); ?>">
        <meta property="og:description" content="<?php echo get_post_meta(get_the_ID(), '_seo_description', true) ?: get_the_excerpt(); ?>">
        <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
        <meta property="og:url" content="<?php the_permalink(); ?>">
        <meta property="og:type" content="article">
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo get_post_meta(get_the_ID(), '_seo_title', true) ?: get_the_title(); ?>">
        <meta name="twitter:description" content="<?php echo get_post_meta(get_the_ID(), '_seo_description', true) ?: get_the_excerpt(); ?>">
        <meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
    <?php else : ?>
        <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
        <meta property="og:description" content="<?php bloginfo('description'); ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo home_url(); ?>">
    <?php endif; ?>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            
            <!-- Site Branding -->
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo home_url(); ?>">NoticiasDM</a>
                    </h1>
                <?php endif; ?>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div>
            
            <!-- Navigation -->
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'noticiasdm_fallback_menu'
                ));
                ?>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
        </div>
    </div>
</header>

<?php
// Fallback menu
function noticiasdm_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . home_url() . '">Inicio</a></li>';
    
    $categories = get_terms(array(
        'taxonomy' => 'article_category',
        'hide_empty' => false,
        'number' => 5
    ));
    
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            echo '<li><a href="' . get_term_link($category) . '">' . esc_html($category->name) . '</a></li>';
        }
    }
    
    echo '</ul>';
}
?>
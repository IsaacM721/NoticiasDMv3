<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- SEO Meta Tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            
            <!-- Logo/Título del sitio -->
            <div class="site-branding">
                <a href="<?php echo home_url(); ?>" class="site-logo-link">
                    <?php noticiasdm_logo(); ?>
                </a>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div>
            
            <!-- Navegación principal -->
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
            
            <!-- Botón de menú móvil -->
            <button class="mobile-menu-toggle" aria-label="Abrir menú">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
        </div>
    </div>
</header>

<?php
// Menú de respaldo si no hay menú configurado
function noticiasdm_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . home_url() . '">Inicio</a></li>';
    echo '<li><a href="#politica">Política</a></li>';
    echo '<li><a href="#deportes">Deportes</a></li>';
    echo '<li><a href="#tecnologia">Tecnología</a></li>';
    echo '<li><a href="#economia">Economía</a></li>';
    echo '</ul>';
}
?>
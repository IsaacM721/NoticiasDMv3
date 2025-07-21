<footer class="site-footer">
    <div class="container">
        
        <!-- Footer Content -->
        <div class="footer-content">
            
            <!-- About Section -->
            <div class="footer-section">
                <h3 class="footer-title">NoticiasDM</h3>
                <p class="footer-description">
                    Tu fuente confiable de noticias de República Dominicana. 
                    Información veraz, oportuna y de calidad.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link facebook" aria-label="Facebook">📘</a>
                    <a href="#" class="social-link twitter" aria-label="Twitter">🐦</a>
                    <a href="#" class="social-link instagram" aria-label="Instagram">📷</a>
                    <a href="#" class="social-link youtube" aria-label="YouTube">📺</a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-section">
                <h4 class="footer-subtitle">Enlaces Rápidos</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu',
                    'container' => false,
                    'depth' => 1,
                    'fallback_cb' => 'noticiasdm_footer_fallback'
                ));
                ?>
            </div>
            
            <!-- Categories -->
            <div class="footer-section">
                <h4 class="footer-subtitle">Categorías</h4>
                <ul class="footer-categories">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'article_category',
                        'hide_empty' => false,
                        'number' => 5
                    ));
                    
                    if ($categories && !is_wp_error($categories)) :
                        foreach ($categories as $category) :
                    ?>
                        <li>
                            <a href="<?php echo get_term_link($category); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="footer-section">
                <h4 class="footer-subtitle">Contacto</h4>
                <div class="contact-info">
                    <p>📧 info@noticiasdm.com</p>
                    <p>📞 +1 (809) 123-4567</p>
                    <p>📍 Santo Domingo, RD</p>
                </div>
            </div>
            
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
                <p>Desarrollado con WordPress | Hosting: Hostinger</p>
            </div>
            
            <div class="footer-links">
                <a href="#privacy">Política de Privacidad</a>
                <a href="#terms">Términos de Uso</a>
                <a href="#contact">Contacto</a>
            </div>
        </div>
        
    </div>
</footer>

<?php wp_footer(); ?>

<!-- Mobile Menu Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navigation = document.querySelector('.main-navigation');
    
    if (mobileToggle && navigation) {
        mobileToggle.addEventListener('click', function() {
            navigation.classList.toggle('active');
            mobileToggle.classList.toggle('active');
        });
    }
});
</script>

</body>
</html>

<?php
// Footer fallback menu
function noticiasdm_footer_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . home_url() . '">Inicio</a></li>';
    echo '<li><a href="#about">Acerca de</a></li>';
    echo '<li><a href="#contact">Contacto</a></li>';
    echo '<li><a href="#privacy">Privacidad</a></li>';
    echo '</ul>';
}
?>
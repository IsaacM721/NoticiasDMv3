<footer class="site-footer">
    <div class="container">
        
        <!-- Widgets del footer -->
        <?php if (is_active_sidebar('footer-widgets')): ?>
            <div class="footer-widgets">
                <?php dynamic_sidebar('footer-widgets'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Información del sitio -->
        <div class="footer-info">
            <div class="footer-branding">
                <h3 class="footer-title">NoticiasDM</h3>
                <p class="footer-description">
                    Tu fuente confiable de noticias de República Dominicana. 
                    Información veraz, oportuna y de calidad.
                </p>
            </div>
            
            <!-- Enlaces rápidos -->
            <div class="footer-links">
                <h4>Enlaces Rápidos</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu',
                    'container' => false,
                    'depth' => 1,
                    'fallback_cb' => false
                ));
                ?>
            </div>
            
            <!-- Información de contacto -->
            <div class="footer-contact">
                <h4>Contacto</h4>
                <p>📧 info@noticiasdm.com</p>
                <p>📞 +1 (809) 123-4567</p>
                <p>📍 Santo Domingo, RD</p>
            </div>
            
            <!-- Redes sociales -->
            <div class="footer-social">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="#" class="social-link facebook" aria-label="Facebook">📘</a>
                    <a href="#" class="social-link twitter" aria-label="Twitter">🐦</a>
                    <a href="#" class="social-link instagram" aria-label="Instagram">📷</a>
                    <a href="#" class="social-link youtube" aria-label="YouTube">📺</a>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
                <p>Desarrollado con WordPress + Supabase | Hosting: Hostinger</p>
            </div>
            
            <!-- Enlaces legales -->
            <div class="legal-links">
                <a href="#privacy">Política de Privacidad</a>
                <a href="#terms">Términos de Uso</a>
                <a href="#contact">Contacto</a>
            </div>
        </div>
        
    </div>
</footer>

<?php wp_footer(); ?>

<!-- Script para menú móvil -->
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
    
    // Cargar más artículos
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        let page = 1;
        
        loadMoreBtn.addEventListener('click', function() {
            page++;
            
            const data = new FormData();
            data.append('action', 'load_more_articles');
            data.append('page', page);
            data.append('limit', 6);
            data.append('nonce', noticiasdm_ajax.nonce);
            
            fetch(noticiasdm_ajax.ajax_url, {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    const articlesContainer = document.querySelector('.noticiasdm-articles-grid');
                    if (articlesContainer) {
                        articlesContainer.insertAdjacentHTML('beforeend', result.data);
                    }
                } else {
                    loadMoreBtn.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
</script>

</body>
</html>
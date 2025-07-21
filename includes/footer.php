<!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand Section -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-500 p-2 rounded-full">
                            <i class="fa-duotone fa-newspaper text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gradient">NoticiasDM</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed">
                        Tu fuente confiable de noticias de República Dominicana. 
                        Información veraz, oportuna y de calidad.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fa-duotone fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fa-duotone fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fa-duotone fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fa-duotone fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold flex items-center">
                        <i class="fa-duotone fa-link mr-2 text-blue-400"></i>
                        Enlaces rápidos
                    </h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-house mr-2 text-sm"></i>Inicio</a></li>
                        <li><a href="categoria.php?cat=politica" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-landmark mr-2 text-sm"></i>Política</a></li>
                        <li><a href="categoria.php?cat=deportes" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-baseball mr-2 text-sm"></i>Deportes</a></li>
                        <li><a href="categoria.php?cat=tecnologia" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-microchip mr-2 text-sm"></i>Tecnología</a></li>
                        <li><a href="categoria.php?cat=economia" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-coins mr-2 text-sm"></i>Economía</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold flex items-center">
                        <i class="fa-duotone fa-tags mr-2 text-blue-400"></i>
                        Categorías
                    </h4>
                    <ul class="space-y-2">
                        <li><a href="categoria.php?cat=cultura" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-music mr-2 text-sm"></i>Cultura</a></li>
                        <li><a href="categoria.php?cat=salud" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-heart-pulse mr-2 text-sm"></i>Salud</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-globe mr-2 text-sm"></i>Internacional</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-briefcase mr-2 text-sm"></i>Negocios</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors flex items-center"><i class="fa-duotone fa-camera mr-2 text-sm"></i>Entretenimiento</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold flex items-center">
                        <i class="fa-duotone fa-address-book mr-2 text-blue-400"></i>
                        Contacto
                    </h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fa-duotone fa-envelope text-blue-400"></i>
                            <span class="text-gray-300">info@noticiasdm.com</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fa-duotone fa-phone text-blue-400"></i>
                            <span class="text-gray-300">+1 (809) 123-4567</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fa-duotone fa-location-dot text-blue-400"></i>
                            <span class="text-gray-300">Santo Domingo, RD</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fa-duotone fa-clock text-blue-400"></i>
                            <span class="text-gray-300">24/7 Noticias</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="border-t border-gray-800 mt-8 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        © <?php echo date('Y'); ?> NoticiasDM. Todos los derechos reservados.
                    </p>
                    <div class="flex flex-wrap justify-center md:justify-end space-x-6">
                        <a href="#" class="text-gray-400 hover:text-blue-400 text-sm transition-colors">
                            <i class="fa-duotone fa-shield-check mr-1"></i>Política de Privacidad
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 text-sm transition-colors">
                            <i class="fa-duotone fa-file-contract mr-1"></i>Términos de Uso
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 text-sm transition-colors">
                            <i class="fa-duotone fa-envelope mr-1"></i>Contacto
                        </a>
                    </div>
                </div>
                
                <div class="text-center mt-4 pt-4 border-t border-gray-800">
                    <p class="text-gray-500 text-xs flex items-center justify-center space-x-2">
                        <i class="fa-duotone fa-rocket text-blue-400"></i>
                        <span>Powered by PHP + Tailwind CSS</span>
                        <span>|</span>
                        <i class="fa-duotone fa-server text-green-400"></i>
                        <span>Ready for Production</span>
                        <span>|</span>
                        <i class="fa-duotone fa-flag text-red-400"></i>
                        <span>Made in RD</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Volver arriba">
        <i class="fa-duotone fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMobileMenu = document.getElementById('close-mobile-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            
            function openMobileMenu() {
                mobileMenu.classList.add('active');
                mobileMenuOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            
            function closeMobileMenuFunc() {
                mobileMenu.classList.remove('active');
                mobileMenuOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
            
            mobileMenuBtn.addEventListener('click', openMobileMenu);
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
            
            // Back to top button
            const backToTop = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
                }
                
                // Reading progress bar
                const progressBar = document.querySelector('.reading-progress-bar');
                if (progressBar) {
                    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                    const scrolled = (winScroll / height) * 100;
                    progressBar.style.width = scrolled + '%';
                }
            });
            
            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Smooth scrolling for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#') return;
                    
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Add animation classes to elements when they come into view
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, observerOptions);
            
            // Observe all cards
            const cards = document.querySelectorAll('.card-hover, .category-hover');
            cards.forEach(card => observer.observe(card));
        });
    </script>
</body>
</html>
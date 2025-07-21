<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'NoticiasDM - Tu fuente confiable de noticias de República Dominicana'; ?>">
    <meta name="keywords" content="noticias, República Dominicana, política, deportes, tecnología, economía, cultura">
    <meta name="author" content="NoticiasDM">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($page_title) ? htmlspecialchars($page_title) : 'NoticiasDM - Noticias de República Dominicana'; ?>">
    <meta property="og:description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Tu fuente confiable de noticias de República Dominicana'; ?>">
    <meta property="og:type" content="<?php echo isset($og_type) ? $og_type : 'website'; ?>">
    <meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <?php if (isset($featured_image)): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($featured_image); ?>">
    <?php endif; ?>
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($page_title) ? htmlspecialchars($page_title) : 'NoticiasDM'; ?>">
    <meta name="twitter:description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Tu fuente confiable de noticias de República Dominicana'; ?>">
    
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'NoticiasDM - Noticias de República Dominicana'; ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Duotone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* Custom animations and styles */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #36b7ff 0%, #2da5e8 100%);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #36b7ff, #2da5e8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(54, 183, 255, 0.1) 0%, rgba(45, 165, 232, 0.1) 100%);
        }
        
        .category-hover {
            transition: all 0.3s ease;
        }
        
        .category-hover:hover {
            transform: translateX(8px);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(54, 183, 255, 0.2);
            z-index: 9999;
        }
        
        .reading-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #36b7ff, #2da5e8);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #36b7ff, #2da5e8);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(54, 183, 255, 0.4);
        }
        
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(54, 183, 255, 0.6);
        }
        
        /* Mobile menu animation */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #36b7ff, #2da5e8);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2da5e8, #1e90ff);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Reading Progress Bar -->
    <div class="reading-progress">
        <div class="reading-progress-bar"></div>
    </div>
    
    <!-- Header -->
    <header class="gradient-bg text-white shadow-2xl sticky top-0 z-50">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <i class="fa-duotone fa-newspaper text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight">
                            <a href="index.php" class="hover:text-blue-100 transition-colors">NoticiasDM</a>
                        </h1>
                        <p class="text-blue-100 text-sm font-medium">Tu fuente confiable de noticias</p>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="index.php" class="flex items-center space-x-2 hover:text-blue-100 transition-colors font-medium">
                        <i class="fa-duotone fa-house"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="categoria.php?cat=politica" class="flex items-center space-x-2 hover:text-blue-100 transition-colors font-medium">
                        <i class="fa-duotone fa-landmark"></i>
                        <span>Política</span>
                    </a>
                    <a href="categoria.php?cat=deportes" class="flex items-center space-x-2 hover:text-blue-100 transition-colors font-medium">
                        <i class="fa-duotone fa-baseball"></i>
                        <span>Deportes</span>
                    </a>
                    <a href="categoria.php?cat=tecnologia" class="flex items-center space-x-2 hover:text-blue-100 transition-colors font-medium">
                        <i class="fa-duotone fa-microchip"></i>
                        <span>Tecnología</span>
                    </a>
                    <a href="categoria.php?cat=economia" class="flex items-center space-x-2 hover:text-blue-100 transition-colors font-medium">
                        <i class="fa-duotone fa-coins"></i>
                        <span>Economía</span>
                    </a>
                </nav>
                
                <!-- Search and Mobile Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Search Button -->
                    <button class="bg-white bg-opacity-20 p-2 rounded-full hover:bg-opacity-30 transition-all">
                        <i class="fa-duotone fa-search"></i>
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden bg-white bg-opacity-20 p-2 rounded-full hover:bg-opacity-30 transition-all">
                        <i class="fa-duotone fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden fixed inset-y-0 left-0 w-64 bg-white shadow-2xl z-50">
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-bold text-gray-900">Menú</h2>
                    <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700">
                        <i class="fa-duotone fa-times text-xl"></i>
                    </button>
                </div>
                
                <nav class="space-y-4">
                    <a href="index.php" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 transition-colors p-2 rounded-lg hover:bg-blue-50">
                        <i class="fa-duotone fa-house text-blue-500"></i>
                        <span class="font-medium">Inicio</span>
                    </a>
                    <a href="categoria.php?cat=politica" class="flex items-center space-x-3 text-gray-700 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-50">
                        <i class="fa-duotone fa-landmark text-red-500"></i>
                        <span class="font-medium">Política</span>
                    </a>
                    <a href="categoria.php?cat=deportes" class="flex items-center space-x-3 text-gray-700 hover:text-green-600 transition-colors p-2 rounded-lg hover:bg-green-50">
                        <i class="fa-duotone fa-baseball text-green-500"></i>
                        <span class="font-medium">Deportes</span>
                    </a>
                    <a href="categoria.php?cat=tecnologia" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 transition-colors p-2 rounded-lg hover:bg-blue-50">
                        <i class="fa-duotone fa-microchip text-blue-500"></i>
                        <span class="font-medium">Tecnología</span>
                    </a>
                    <a href="categoria.php?cat=economia" class="flex items-center space-x-3 text-gray-700 hover:text-yellow-600 transition-colors p-2 rounded-lg hover:bg-yellow-50">
                        <i class="fa-duotone fa-coins text-yellow-500"></i>
                        <span class="font-medium">Economía</span>
                    </a>
                    <a href="categoria.php?cat=cultura" class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 transition-colors p-2 rounded-lg hover:bg-purple-50">
                        <i class="fa-duotone fa-music text-purple-500"></i>
                        <span class="font-medium">Cultura</span>
                    </a>
                    <a href="categoria.php?cat=salud" class="flex items-center space-x-3 text-gray-700 hover:text-emerald-600 transition-colors p-2 rounded-lg hover:bg-emerald-50">
                        <i class="fa-duotone fa-heart-pulse text-emerald-500"></i>
                        <span class="font-medium">Salud</span>
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>
    </header>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NoticiasDM - Tu fuente confiable de noticias de República Dominicana">
    <meta name="keywords" content="noticias, República Dominicana, política, deportes, tecnología, economía, cultura">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="NoticiasDM - Noticias de República Dominicana">
    <meta property="og:description" content="Tu fuente confiable de noticias de República Dominicana">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    
    <title>NoticiasDM - Noticias de República Dominicana</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Duotone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
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
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    
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
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden bg-white bg-opacity-20 p-2 rounded-full hover:bg-opacity-30 transition-all">
                    <i class="fa-duotone fa-bars"></i>
                </button>
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

    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
            <div class="container mx-auto px-4">
                <article class="bg-white rounded-2xl shadow-2xl overflow-hidden card-hover animate-slide-up">
                    <div class="lg:flex">
                        <div class="lg:w-1/2">
                            <img src="https://images.pexels.com/photos/1174732/pexels-photo-1174732.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Tecnología en turismo dominicano"
                                 class="w-full h-64 lg:h-full object-cover">
                        </div>
                        <div class="lg:w-1/2 p-8 lg:p-12">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold text-white bg-blue-500">
                                    <i class="fa-duotone fa-microchip mr-2"></i>
                                    Tecnología
                                </span>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="fa-duotone fa-clock mr-1"></i>
                                    4 min
                                </div>
                            </div>
                            
                            <h1 class="text-3xl lg:text-4xl font-black text-gray-900 mb-6 leading-tight">
                                <a href="articulo.php?id=1" class="hover:text-blue-600 transition-colors">
                                    Nuevas Tecnologías Revolucionan el Sector Turístico Dominicano
                                </a>
                            </h1>
                            
                            <p class="text-xl text-gray-600 mb-6 leading-relaxed">
                                El sector turístico de República Dominicana está experimentando una transformación sin precedentes gracias a la implementación de nuevas tecnologías que mejoran la experiencia del visitante.
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-gray-500">
                                    <i class="fa-duotone fa-user-pen mr-2"></i>
                                    <span class="font-medium">María González</span>
                                    <span class="mx-2">•</span>
                                    <i class="fa-duotone fa-calendar mr-1"></i>
                                    <span>15 de Enero, 2024</span>
                                </div>
                                
                                <a href="articulo.php?id=1" 
                                   class="inline-flex items-center px-6 py-3 gradient-bg text-white font-bold rounded-full hover:shadow-lg transition-all transform hover:scale-105">
                                    <span>Leer más</span>
                                    <i class="fa-duotone fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- Latest News Section -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-black text-gray-900 mb-4">
                        <i class="fa-duotone fa-newspaper text-blue-500 mr-3"></i>
                        Últimas Noticias
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Mantente informado con las noticias más recientes y relevantes de República Dominicana
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Article 1 -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Criptomonedas en República Dominicana"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-yellow-500">
                                    <i class="fa-duotone fa-coins mr-1"></i>
                                    Economía
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                <a href="articulo.php?id=2" class="hover:text-blue-600 transition-colors">
                                    Análisis: El Impacto de las Criptomonedas en la Economía Nacional
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                Las criptomonedas muestran un crecimiento explosivo en República Dominicana, generando debate sobre regulación y adopción.
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-user-pen mr-1"></i>
                                    <span>Carlos Rodríguez</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-clock mr-1"></i>
                                        6 min
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-calendar mr-1"></i>
                                        12/01/24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Article 2 -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/1618269/pexels-photo-1618269.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Baseball dominicano"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-green-500">
                                    <i class="fa-duotone fa-baseball mr-1"></i>
                                    Deportes
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                <a href="articulo.php?id=3" class="hover:text-blue-600 transition-colors">
                                    Temporada de Baseball: Análisis del Rendimiento de Jugadores Dominicanos en MLB
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                Los peloteros dominicanos brillan en la temporada 2024 de MLB con múltiples récords y actuaciones destacadas.
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-user-pen mr-1"></i>
                                    <span>Roberto Martínez</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-clock mr-1"></i>
                                        5 min
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-calendar mr-1"></i>
                                        10/01/24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Article 3 -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/1181467/pexels-photo-1181467.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Educación en República Dominicana"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-red-500">
                                    <i class="fa-duotone fa-landmark mr-1"></i>
                                    Política
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                <a href="articulo.php?id=4" class="hover:text-blue-600 transition-colors">
                                    Nuevas Reformas Educativas Buscan Modernizar el Sistema Nacional
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                El gobierno presenta un plan integral de reformas educativas que incluye tecnología, infraestructura y capacitación docente.
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-user-pen mr-1"></i>
                                    <span>Ana Pérez</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-clock mr-1"></i>
                                        7 min
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-calendar mr-1"></i>
                                        08/01/24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Article 4 -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/1181298/pexels-photo-1181298.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Festival de Merengue"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-purple-500">
                                    <i class="fa-duotone fa-music mr-1"></i>
                                    Cultura
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                <a href="articulo.php?id=5" class="hover:text-blue-600 transition-colors">
                                    Festival de Merengue 2024 Celebra la Riqueza Musical Dominicana
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                El festival anual reúne a los mejores exponentes del merengue nacional e internacional en una celebración cultural única.
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-user-pen mr-1"></i>
                                    <span>Luis Fernández</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-clock mr-1"></i>
                                        3 min
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-calendar mr-1"></i>
                                        05/01/24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Article 5 -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/1181677/pexels-photo-1181677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Campaña de vacunación"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-emerald-500">
                                    <i class="fa-duotone fa-heart-pulse mr-1"></i>
                                    Salud
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                <a href="articulo.php?id=6" class="hover:text-blue-600 transition-colors">
                                    Campaña Nacional de Vacunación Alcanza el 85% de Cobertura
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                Las autoridades sanitarias reportan avances significativos en la campaña de inmunización, superando las metas establecidas.
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-user-pen mr-1"></i>
                                    <span>Dr. Carmen Jiménez</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-clock mr-1"></i>
                                        4 min
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-calendar mr-1"></i>
                                        03/01/24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Article 6 -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                                 alt="Energía solar en Santiago"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-cyan-500">
                                    <i class="fa-duotone fa-solar-panel mr-1"></i>
                                    Medio Ambiente
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                                <a href="articulo.php?id=7" class="hover:text-blue-600 transition-colors">
                                    Proyecto de Energía Solar Reduce Emisiones en un 30% en Santiago
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                La implementación de paneles solares en edificios públicos demuestra el compromiso del país con la sostenibilidad.
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-user-pen mr-1"></i>
                                    <span>Miguel Torres</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-clock mr-1"></i>
                                        6 min
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fa-duotone fa-calendar mr-1"></i>
                                        01/01/24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-black text-gray-900 mb-4">
                        <i class="fa-duotone fa-tags text-blue-500 mr-3"></i>
                        Explora por Categorías
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Descubre noticias organizadas por temas de tu interés
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Política -->
                    <a href="categoria.php?cat=politica" class="bg-white rounded-xl p-6 shadow-lg card-hover animate-fade-in group">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 rounded-full bg-red-500 text-white">
                                <i class="fa-duotone fa-landmark text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Política
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Noticias sobre política nacional e internacional, análisis gubernamental y electoral.
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                            <span>Ver más</span>
                            <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                    <!-- Deportes -->
                    <a href="categoria.php?cat=deportes" class="bg-white rounded-xl p-6 shadow-lg card-hover animate-fade-in group">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 rounded-full bg-green-500 text-white">
                                <i class="fa-duotone fa-baseball text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Deportes
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Cobertura deportiva completa, baseball, fútbol y análisis de rendimiento atlético.
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                            <span>Ver más</span>
                            <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                    <!-- Tecnología -->
                    <a href="categoria.php?cat=tecnologia" class="bg-white rounded-xl p-6 shadow-lg card-hover animate-fade-in group">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 rounded-full bg-blue-500 text-white">
                                <i class="fa-duotone fa-microchip text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Tecnología
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Últimas noticias tecnológicas, innovación digital y transformación empresarial.
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                            <span>Ver más</span>
                            <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                    <!-- Economía -->
                    <a href="categoria.php?cat=economia" class="bg-white rounded-xl p-6 shadow-lg card-hover animate-fade-in group">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 rounded-full bg-yellow-500 text-white">
                                <i class="fa-duotone fa-coins text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Economía
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Análisis económico, mercados financieros, criptomonedas y desarrollo comercial.
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                            <span>Ver más</span>
                            <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                    <!-- Cultura -->
                    <a href="categoria.php?cat=cultura" class="bg-white rounded-xl p-6 shadow-lg card-hover animate-fade-in group">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 rounded-full bg-purple-500 text-white">
                                <i class="fa-duotone fa-music text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Cultura
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Arte, música, festivales y eventos culturales que celebran la identidad dominicana.
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                            <span>Ver más</span>
                            <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>

                    <!-- Salud -->
                    <a href="categoria.php?cat=salud" class="bg-white rounded-xl p-6 shadow-lg card-hover animate-fade-in group">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-3 rounded-full bg-emerald-500 text-white">
                                <i class="fa-duotone fa-heart-pulse text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Salud
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Información médica, campañas de salud pública y avances en medicina nacional.
                        </p>
                        <div class="mt-4 flex items-center text-blue-600 font-medium">
                            <span>Ver más</span>
                            <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-16 gradient-bg">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-3xl font-black text-white mb-4">
                        <i class="fa-duotone fa-envelope text-blue-200 mr-3"></i>
                        Suscríbete a NoticiasDM
                    </h2>
                    <p class="text-xl text-blue-100 mb-8">
                        Recibe las noticias más importantes directamente en tu correo
                    </p>
                    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" 
                               placeholder="Tu correo electrónico" 
                               class="flex-1 px-6 py-3 rounded-full border-0 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                        <button type="submit" 
                                class="px-8 py-3 bg-white text-blue-600 font-bold rounded-full hover:bg-blue-50 transition-colors transform hover:scale-105">
                            <i class="fa-duotone fa-paper-plane mr-2"></i>
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

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
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">NoticiasDM</h3>
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
            
            if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
            if (closeMobileMenu) closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
            if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
            
            // Back to top button
            const backToTop = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
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
        });
    </script>
</body>
</html>
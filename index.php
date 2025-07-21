<?php
require_once 'config/database.php';

// Page meta data
$page_title = 'NoticiasDM - Noticias de República Dominicana';
$meta_description = 'Tu fuente confiable de noticias de República Dominicana. Últimas noticias de política, deportes, tecnología, economía y cultura.';

// Get featured article
$featured_articles = getArticles(1, true);
$featured_article = !empty($featured_articles) ? $featured_articles[0] : null;

// Get regular articles
$regular_articles = getArticles(6, false);
if ($featured_article) {
    $regular_articles = array_filter($regular_articles, function($article) use ($featured_article) {
        return $article['id'] != $featured_article['id'];
    });
    $regular_articles = array_slice($regular_articles, 0, 5);
}

// Get categories
$categories = getCategories();

include 'includes/header.php';
?>

<main class="min-h-screen">
    <!-- Hero Section -->
    <?php if ($featured_article): ?>
    <section class="hero-gradient py-12">
        <div class="container mx-auto px-4">
            <article class="bg-white rounded-2xl shadow-2xl overflow-hidden card-hover animate-slide-up">
                <div class="lg:flex">
                    <div class="lg:w-1/2">
                        <img src="<?php echo htmlspecialchars($featured_article['featured_image']); ?>" 
                             alt="<?php echo htmlspecialchars($featured_article['title']); ?>"
                             class="w-full h-64 lg:h-full object-cover">
                    </div>
                    <div class="lg:w-1/2 p-8 lg:p-12">
                        <div class="flex items-center space-x-3 mb-6">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold text-white <?php echo $featured_article['category_color']; ?>">
                                <i class="<?php echo $featured_article['category_icon']; ?> mr-2"></i>
                                <?php echo htmlspecialchars($featured_article['category']); ?>
                            </span>
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="fa-duotone fa-clock mr-1"></i>
                                <?php echo $featured_article['read_time']; ?> min
                            </div>
                        </div>
                        
                        <h1 class="text-3xl lg:text-4xl font-black text-gray-900 mb-6 leading-tight">
                            <a href="articulo.php?id=<?php echo $featured_article['id']; ?>" 
                               class="hover:text-blue-600 transition-colors">
                                <?php echo htmlspecialchars($featured_article['title']); ?>
                            </a>
                        </h1>
                        
                        <p class="text-xl text-gray-600 mb-6 leading-relaxed">
                            <?php echo htmlspecialchars($featured_article['excerpt']); ?>
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500">
                                <i class="fa-duotone fa-user-pen mr-2"></i>
                                <span class="font-medium"><?php echo htmlspecialchars($featured_article['author']); ?></span>
                                <span class="mx-2">•</span>
                                <i class="fa-duotone fa-calendar mr-1"></i>
                                <span><?php echo formatDate($featured_article['published_at']); ?></span>
                            </div>
                            
                            <a href="articulo.php?id=<?php echo $featured_article['id']; ?>" 
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
    <?php endif; ?>

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
                <?php foreach ($regular_articles as $article): ?>
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-fade-in">
                    <div class="relative">
                        <img src="<?php echo htmlspecialchars($article['featured_image']); ?>" 
                             alt="<?php echo htmlspecialchars($article['title']); ?>"
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white <?php echo $article['category_color']; ?>">
                                <i class="<?php echo $article['category_icon']; ?> mr-1"></i>
                                <?php echo htmlspecialchars($article['category']); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                            <a href="articulo.php?id=<?php echo $article['id']; ?>" 
                               class="hover:text-blue-600 transition-colors">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            <?php echo htmlspecialchars($article['excerpt']); ?>
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fa-duotone fa-user-pen mr-1"></i>
                                <span><?php echo htmlspecialchars($article['author']); ?></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center">
                                    <i class="fa-duotone fa-clock mr-1"></i>
                                    <?php echo $article['read_time']; ?> min
                                </span>
                                <span class="flex items-center">
                                    <i class="fa-duotone fa-calendar mr-1"></i>
                                    <?php echo date('d/m/Y', strtotime($article['published_at'])); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
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
                <?php foreach ($categories as $category): ?>
                <a href="categoria.php?cat=<?php echo urlencode($category['slug']); ?>" 
                   class="bg-white rounded-xl p-6 shadow-lg category-hover animate-fade-in group">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="p-3 rounded-full <?php echo $category['color']; ?> text-white">
                            <i class="<?php echo $category['icon']; ?> text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </h3>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        <?php echo htmlspecialchars($category['description']); ?>
                    </p>
                    <div class="mt-4 flex items-center text-blue-600 font-medium">
                        <span>Ver más</span>
                        <i class="fa-duotone fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
                <?php endforeach; ?>
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

<?php include 'includes/footer.php'; ?>
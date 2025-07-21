<?php
require_once 'config/database.php';

// Get article ID from URL
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$article_id) {
    header('Location: index.php');
    exit;
}

// Get article
$article = getArticle($article_id);

if (!$article) {
    header('Location: index.php');
    exit;
}

// Page meta data
$page_title = htmlspecialchars($article['title']) . ' - NoticiasDM';
$meta_description = htmlspecialchars($article['excerpt']);
$featured_image = $article['featured_image'];
$og_type = 'article';

// Get related articles (same category, excluding current)
$related_articles = array_filter(getArticles(4), function($a) use ($article_id, $article) {
    return $a['id'] != $article_id && $a['category'] == $article['category'];
});
$related_articles = array_slice($related_articles, 0, 3);

include 'includes/header.php';
?>

<main class="min-h-screen">
    <!-- Article Header -->
    <article class="bg-white">
        <!-- Featured Image -->
        <div class="relative h-96 lg:h-[500px] overflow-hidden">
            <img src="<?php echo htmlspecialchars($article['featured_image']); ?>" 
                 alt="<?php echo htmlspecialchars($article['title']); ?>"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            
            <!-- Article Meta Overlay -->
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="container mx-auto">
                    <div class="max-w-4xl">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold text-white <?php echo $article['category_color']; ?>">
                                <i class="<?php echo $article['category_icon']; ?> mr-2"></i>
                                <?php echo htmlspecialchars($article['category']); ?>
                            </span>
                            <div class="flex items-center text-white/80 text-sm">
                                <i class="fa-duotone fa-clock mr-1"></i>
                                <?php echo $article['read_time']; ?> min de lectura
                            </div>
                        </div>
                        
                        <h1 class="text-3xl lg:text-5xl font-black text-white mb-4 leading-tight">
                            <?php echo htmlspecialchars($article['title']); ?>
                        </h1>
                        
                        <p class="text-xl text-white/90 mb-6 leading-relaxed">
                            <?php echo htmlspecialchars($article['excerpt']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">
                <!-- Author and Date Info -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-8 border-b border-gray-200">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fa-duotone fa-user-pen text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($article['author']); ?></h3>
                            <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($article['author_bio']); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center text-gray-500 text-sm">
                        <i class="fa-duotone fa-calendar mr-2"></i>
                        <span><?php echo formatDate($article['published_at']); ?></span>
                    </div>
                </div>

                <!-- Share Buttons -->
                <div class="flex items-center justify-center space-x-4 mb-8">
                    <span class="text-gray-600 font-medium">Compartir:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                       target="_blank" 
                       class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                        <i class="fa-duotone fa-facebook"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($article['title']); ?>" 
                       target="_blank" 
                       class="flex items-center space-x-2 px-4 py-2 bg-sky-500 text-white rounded-full hover:bg-sky-600 transition-colors">
                        <i class="fa-duotone fa-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                       target="_blank" 
                       class="flex items-center space-x-2 px-4 py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition-colors">
                        <i class="fa-duotone fa-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>
                    <button onclick="copyToClipboard()" 
                            class="flex items-center space-x-2 px-4 py-2 bg-gray-600 text-white rounded-full hover:bg-gray-700 transition-colors">
                        <i class="fa-duotone fa-copy"></i>
                        <span>Copiar</span>
                    </button>
                </div>

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none">
                    <?php echo $article['content']; ?>
                </div>

                <!-- Back to Home -->
                <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                    <a href="index.php" 
                       class="inline-flex items-center px-6 py-3 gradient-bg text-white font-bold rounded-full hover:shadow-lg transition-all transform hover:scale-105">
                        <i class="fa-duotone fa-arrow-left mr-2"></i>
                        <span>Volver al inicio</span>
                    </a>
                </div>
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    <?php if (!empty($related_articles)): ?>
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-gray-900 mb-4">
                    <i class="fa-duotone fa-newspaper text-blue-500 mr-3"></i>
                    Artículos Relacionados
                </h2>
                <p class="text-lg text-gray-600">
                    Más noticias que podrían interesarte
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <?php foreach ($related_articles as $related): ?>
                <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <img src="<?php echo htmlspecialchars($related['featured_image']); ?>" 
                         alt="<?php echo htmlspecialchars($related['title']); ?>"
                         class="w-full h-48 object-cover">
                    
                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold text-white <?php echo $related['category_color']; ?>">
                                <i class="<?php echo $related['category_icon']; ?> mr-1"></i>
                                <?php echo htmlspecialchars($related['category']); ?>
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                            <a href="articulo.php?id=<?php echo $related['id']; ?>" 
                               class="hover:text-blue-600 transition-colors">
                                <?php echo htmlspecialchars($related['title']); ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                            <?php echo htmlspecialchars($related['excerpt']); ?>
                        </p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span><?php echo htmlspecialchars($related['author']); ?></span>
                            <span><?php echo date('d/m/Y', strtotime($related['published_at'])); ?></span>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fa-duotone fa-check mr-2"></i><span>¡Copiado!</span>';
        button.classList.add('bg-green-600');
        button.classList.remove('bg-gray-600');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-gray-600');
        }, 2000);
    });
}
</script>

<?php include 'includes/footer.php'; ?>
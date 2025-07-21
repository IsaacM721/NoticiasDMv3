<?php
require_once 'config/database.php';

// Get category from URL
$category_slug = isset($_GET['cat']) ? $_GET['cat'] : '';

if (!$category_slug) {
    header('Location: index.php');
    exit;
}

// Get category info
$categories = getCategories();
$current_category = null;
foreach ($categories as $cat) {
    if ($cat['slug'] == $category_slug) {
        $current_category = $cat;
        break;
    }
}

if (!$current_category) {
    header('Location: index.php');
    exit;
}

// Get articles for this category
$all_articles = getArticles();
$category_articles = array_filter($all_articles, function($article) use ($current_category) {
    return $article['category'] == $current_category['name'];
});

// Page meta data
$page_title = htmlspecialchars($current_category['name']) . ' - NoticiasDM';
$meta_description = htmlspecialchars($current_category['description']);

include 'includes/header.php';
?>

<main class="min-h-screen">
    <!-- Category Header -->
    <section class="gradient-bg py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white bg-opacity-20 mb-6">
                    <i class="<?php echo $current_category['icon']; ?> text-3xl text-white"></i>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-black text-white mb-4">
                    <?php echo htmlspecialchars($current_category['name']); ?>
                </h1>
                
                <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                    <?php echo htmlspecialchars($current_category['description']); ?>
                </p>
                
                <div class="flex items-center justify-center space-x-4 text-blue-100">
                    <span class="flex items-center">
                        <i class="fa-duotone fa-newspaper mr-2"></i>
                        <?php echo count($category_articles); ?> artículos
                    </span>
                    <span>•</span>
                    <span class="flex items-center">
                        <i class="fa-duotone fa-clock mr-2"></i>
                        Actualizado hoy
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="index.php" class="text-blue-600 hover:text-blue-800 transition-colors">
                    <i class="fa-duotone fa-house mr-1"></i>
                    Inicio
                </a>
                <i class="fa-duotone fa-chevron-right text-gray-400"></i>
                <span class="text-gray-600">
                    <i class="<?php echo $current_category['icon']; ?> mr-1"></i>
                    <?php echo htmlspecialchars($current_category['name']); ?>
                </span>
            </nav>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <?php if (!empty($category_articles)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($category_articles as $article): ?>
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
            <?php else: ?>
                <!-- No Articles Found -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                            <i class="fa-duotone fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            No hay artículos en esta categoría
                        </h3>
                        <p class="text-gray-600 mb-8">
                            Aún no tenemos contenido publicado en la categoría de <?php echo htmlspecialchars($current_category['name']); ?>. 
                            Vuelve pronto para ver las últimas noticias.
                        </p>
                        <a href="index.php" 
                           class="inline-flex items-center px-6 py-3 gradient-bg text-white font-bold rounded-full hover:shadow-lg transition-all transform hover:scale-105">
                            <i class="fa-duotone fa-arrow-left mr-2"></i>
                            <span>Volver al inicio</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Other Categories -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-gray-900 mb-4">
                    <i class="fa-duotone fa-tags text-blue-500 mr-3"></i>
                    Otras Categorías
                </h2>
                <p class="text-lg text-gray-600">
                    Explora más noticias por tema
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <?php foreach ($categories as $category): ?>
                    <?php if ($category['slug'] != $category_slug): ?>
                    <a href="categoria.php?cat=<?php echo urlencode($category['slug']); ?>" 
                       class="bg-white rounded-xl p-4 shadow-lg category-hover text-center group">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full <?php echo $category['color']; ?> text-white flex items-center justify-center">
                            <i class="<?php echo $category['icon']; ?> text-lg"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </h3>
                    </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
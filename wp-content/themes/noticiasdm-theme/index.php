<?php
/**
 * Template principal de NoticiasDM
 */

get_header(); ?>

<main class="main-content">
    <div class="container">
        
        <!-- Hero Section con artículos destacados de Supabase -->
        <section class="hero-section">
            <h2 class="section-title">Últimas Noticias</h2>
            
            <?php
            // Obtener artículos de Supabase
            $featured_articles = get_noticiasdm_articles(3);
            
            if (!isset($featured_articles['error']) && !empty($featured_articles)):
            ?>
                <div class="featured-articles">
                    <?php foreach ($featured_articles as $index => $article): ?>
                        <article class="featured-article <?php echo $index === 0 ? 'featured-main' : 'featured-secondary'; ?>">
                            <?php if (!empty($article->featured_image)): ?>
                                <div class="article-image">
                                    <img src="<?php echo esc_url($article->featured_image); ?>" 
                                         alt="<?php echo esc_attr($article->title); ?>">
                                </div>
                            <?php endif; ?>
                            
                            <div class="article-content">
                                <?php if (!empty($article->category)): ?>
                                    <span class="category-badge" 
                                          style="background-color: <?php echo esc_attr($article->category->color); ?>">
                                        <?php echo esc_html($article->category->name); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <h3 class="article-title">
                                    <a href="#article-<?php echo esc_attr($article->id); ?>">
                                        <?php echo esc_html($article->title); ?>
                                    </a>
                                </h3>
                                
                                <?php if (!empty($article->excerpt)): ?>
                                    <p class="article-excerpt">
                                        <?php echo esc_html($article->excerpt); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="article-meta">
                                    <?php if (!empty($article->published_at)): ?>
                                        <span class="publish-date">
                                            <?php echo noticiasdm_format_date($article->published_at, 'd \d\e F, Y'); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-articles">
                    <p>No hay artículos disponibles en este momento.</p>
                    <?php if (isset($featured_articles['error'])): ?>
                        <p class="error-message">Error: <?php echo esc_html($featured_articles['error']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- Sección de categorías -->
        <section class="categories-section">
            <h2 class="section-title">Categorías</h2>
            
            <?php
            $categories = get_noticiasdm_categories();
            if (!empty($categories)):
            ?>
                <div class="categories-grid">
                    <?php foreach ($categories as $category): ?>
                        <div class="category-card" style="border-left: 4px solid <?php echo esc_attr($category->color); ?>">
                            <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                            <?php if (!empty($category->description)): ?>
                                <p class="category-description"><?php echo esc_html($category->description); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- Más artículos -->
        <section class="more-articles-section">
            <h2 class="section-title">Más Noticias</h2>
            
            <!-- Shortcode del plugin -->
            <?php echo do_shortcode('[noticiasdm_articles limit="6" layout="grid"]'); ?>
            
            <div class="load-more-container">
                <button id="load-more-btn" class="btn btn-primary">Cargar más noticias</button>
            </div>
        </section>
        
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
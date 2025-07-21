<?php
/**
 * Sidebar Template
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside class="sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
    
    <!-- Widget personalizado de artículos recientes de Supabase -->
    <div class="widget custom-recent-articles">
        <h3 class="widget-title">Artículos Recientes</h3>
        
        <?php
        $recent_articles = get_noticiasdm_articles(5);
        
        if (!isset($recent_articles['error']) && !empty($recent_articles)):
        ?>
            <ul class="recent-articles-list">
                <?php foreach ($recent_articles as $article): ?>
                    <li class="recent-article-item">
                        <?php if (!empty($article->featured_image)): ?>
                            <div class="recent-article-thumb">
                                <img src="<?php echo esc_url($article->featured_image); ?>" 
                                     alt="<?php echo esc_attr($article->title); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="recent-article-content">
                            <h4 class="recent-article-title">
                                <a href="#article-<?php echo esc_attr($article->id); ?>">
                                    <?php echo esc_html($article->title); ?>
                                </a>
                            </h4>
                            
                            <?php if (!empty($article->published_at)): ?>
                                <span class="recent-article-date">
                                    <?php echo noticiasdm_format_date($article->published_at); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay artículos recientes disponibles.</p>
        <?php endif; ?>
    </div>
    
    <!-- Widget de categorías -->
    <div class="widget custom-categories">
        <h3 class="widget-title">Categorías</h3>
        
        <?php
        $categories = get_noticiasdm_categories();
        
        if (!empty($categories)):
        ?>
            <ul class="categories-list">
                <?php foreach ($categories as $category): ?>
                    <li class="category-item">
                        <a href="#category-<?php echo esc_attr($category->slug); ?>" 
                           class="category-link"
                           style="border-left: 3px solid <?php echo esc_attr($category->color); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    
</aside>

<style>
/* Estilos específicos del sidebar */
.recent-articles-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-article-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.recent-article-item:last-child {
    border-bottom: none;
}

.recent-article-thumb {
    width: 60px;
    height: 60px;
    margin-right: 1rem;
    flex-shrink: 0;
}

.recent-article-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px;
}

.recent-article-content {
    flex: 1;
}

.recent-article-title {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.recent-article-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
}

.recent-article-title a:hover {
    color: var(--primary-color);
}

.recent-article-date {
    font-size: 0.8rem;
    color: var(--text-muted);
}

.categories-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-item {
    margin-bottom: 0.5rem;
}

.category-link {
    display: block;
    padding: 0.75rem 1rem;
    color: var(--text-color);
    text-decoration: none;
    background: var(--bg-color);
    border-radius: 6px;
    transition: var(--transition);
}

.category-link:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateX(5px);
}
</style>
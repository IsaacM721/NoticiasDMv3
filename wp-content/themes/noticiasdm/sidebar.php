<?php if (!is_active_sidebar('sidebar-1')) return; ?>

<aside class="sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
    
    <!-- Recent Articles Widget -->
    <div class="widget recent-articles-widget">
        <h3 class="widget-title">Artículos Recientes</h3>
        
        <?php
        $recent_args = array(
            'post_type' => 'article',
            'posts_per_page' => 5,
            'post_status' => 'publish'
        );
        $recent_query = new WP_Query($recent_args);
        
        if ($recent_query->have_posts()) :
        ?>
        
        <ul class="recent-articles-list">
            <?php while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
            
            <li class="recent-article-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="recent-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="recent-content">
                    <h4 class="recent-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <span class="recent-date"><?php echo noticiasdm_format_date(get_the_date()); ?></span>
                </div>
            </li>
            
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
        
        <?php endif; ?>
    </div>
    
    <!-- Categories Widget -->
    <div class="widget categories-widget">
        <h3 class="widget-title">Categorías</h3>
        
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'article_category',
            'hide_empty' => false,
        ));
        
        if ($categories && !is_wp_error($categories)) :
        ?>
        
        <ul class="categories-list">
            <?php foreach ($categories as $category) : 
                $color = get_category_color($category->term_id);
                $count = $category->count;
            ?>
            
            <li class="category-item">
                <a href="<?php echo get_term_link($category); ?>" 
                   class="category-link"
                   style="border-left: 3px solid <?php echo esc_attr($color); ?>">
                    <span class="category-name"><?php echo esc_html($category->name); ?></span>
                    <span class="category-count">(<?php echo $count; ?>)</span>
                </a>
            </li>
            
            <?php endforeach; ?>
        </ul>
        
        <?php endif; ?>
    </div>
    
    <!-- Popular Tags Widget -->
    <div class="widget tags-widget">
        <h3 class="widget-title">Etiquetas Populares</h3>
        
        <?php
        $tags = get_terms(array(
            'taxonomy' => 'article_tag',
            'hide_empty' => false,
            'number' => 10,
            'orderby' => 'count',
            'order' => 'DESC'
        ));
        
        if ($tags && !is_wp_error($tags)) :
        ?>
        
        <div class="tags-cloud">
            <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo get_term_link($tag); ?>" 
                   class="tag-cloud-link"
                   title="<?php echo $tag->count; ?> artículo<?php echo $tag->count != 1 ? 's' : ''; ?>">
                    <?php echo esc_html($tag->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
        
        <?php endif; ?>
    </div>
    
</aside>

<style>
/* Sidebar Styles */
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

.recent-thumb {
    width: 60px;
    height: 60px;
    margin-right: 1rem;
    flex-shrink: 0;
}

.recent-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px;
}

.recent-content {
    flex: 1;
}

.recent-title {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.recent-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
}

.recent-title a:hover {
    color: var(--primary-color);
}

.recent-date {
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
    display: flex;
    justify-content: space-between;
    align-items: center;
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

.category-name {
    font-weight: 500;
}

.category-count {
    font-size: 0.8rem;
    opacity: 0.8;
}

.tags-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-cloud-link {
    padding: 0.5rem 1rem;
    background-color: var(--bg-color);
    color: var(--text-color);
    text-decoration: none;
    border-radius: 20px;
    font-size: 0.9rem;
    transition: var(--transition);
}

.tag-cloud-link:hover {
    background-color: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
}
</style>
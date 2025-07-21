<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article class="single-article">
            
            <!-- Article Header -->
            <header class="article-header">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="article-featured-image">
                        <?php the_post_thumbnail('hero-image'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="article-header-content">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'article_category');
                    if ($categories && !is_wp_error($categories)) :
                        $category = $categories[0];
                        $color = get_category_color($category->term_id);
                    ?>
                        <span class="category-badge" style="background-color: <?php echo esc_attr($color); ?>">
                            <?php echo esc_html($category->name); ?>
                        </span>
                    <?php endif; ?>
                    
                    <h1 class="article-title"><?php the_title(); ?></h1>
                    
                    <div class="article-meta">
                        <div class="meta-left">
                            <span class="author">Por <?php the_author(); ?></span>
                            <span class="separator">•</span>
                            <span class="date"><?php echo noticiasdm_format_date(get_the_date()); ?></span>
                            <span class="separator">•</span>
                            <span class="read-time"><?php echo get_article_read_time(get_the_ID()); ?> min de lectura</span>
                        </div>
                        
                        <div class="meta-right">
                            <div class="share-buttons">
                                <span class="share-label">Compartir:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn facebook">Facebook</a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn twitter">Twitter</a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn linkedin">LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Article Content -->
            <div class="article-content">
                <?php the_content(); ?>
            </div>
            
            <!-- Article Tags -->
            <?php
            $tags = get_the_terms(get_the_ID(), 'article_tag');
            if ($tags && !is_wp_error($tags)) :
            ?>
            <div class="article-tags">
                <h4>Etiquetas:</h4>
                <div class="tags-list">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo get_term_link($tag); ?>" class="tag-link"><?php echo esc_html($tag->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Author Bio -->
            <div class="author-bio">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                </div>
                <div class="author-info">
                    <h4 class="author-name"><?php the_author(); ?></h4>
                    <p class="author-description"><?php echo get_the_author_meta('description'); ?></p>
                </div>
            </div>
            
        </article>
        
        <!-- Related Articles -->
        <?php
        $related_args = array(
            'post_type' => 'article',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(
                array(
                    'taxonomy' => 'article_category',
                    'field' => 'term_id',
                    'terms' => wp_get_post_terms(get_the_ID(), 'article_category', array('fields' => 'ids')),
                )
            )
        );
        $related_query = new WP_Query($related_args);
        
        if ($related_query->have_posts()) :
        ?>
        
        <section class="related-articles">
            <h2 class="section-title">Artículos Relacionados</h2>
            
            <div class="related-grid">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                
                <article class="related-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('card-image'); ?>
                        </a>
                    <?php endif; ?>
                    
                    <div class="related-content">
                        <h3 class="related-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="related-meta">
                            <span class="date"><?php echo noticiasdm_format_date(get_the_date()); ?></span>
                        </div>
                    </div>
                </article>
                
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </section>
        
        <?php endif; ?>
        
        <?php endwhile; endif; ?>
        
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
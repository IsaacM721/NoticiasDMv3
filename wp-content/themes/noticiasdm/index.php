<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        
        <?php
        // Get featured article
        $featured_args = array(
            'post_type' => 'article',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => '_featured',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        $featured_query = new WP_Query($featured_args);
        
        if ($featured_query->have_posts()) :
            while ($featured_query->have_posts()) : $featured_query->the_post();
        ?>
        
        <!-- Hero Article -->
        <article class="hero-article">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('hero-image'); ?>
            <?php endif; ?>
            
            <div class="hero-content">
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
                    <span class="author">Por <?php the_author(); ?></span>
                    <span class="separator">•</span>
                    <span class="date"><?php echo noticiasdm_format_date(get_the_date()); ?></span>
                    <span class="separator">•</span>
                    <span class="read-time"><?php echo get_article_read_time(get_the_ID()); ?> min de lectura</span>
                </div>
                
                <div class="article-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="read-more-btn">Leer artículo completo</a>
            </div>
        </article>
        
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
        
        <!-- Section Title -->
        <div class="section-header">
            <h2 class="section-title">Últimas Noticias</h2>
            <p class="section-subtitle">Mantente informado con las noticias más recientes de República Dominicana</p>
        </div>
        
        <!-- Articles Grid -->
        <div class="articles-grid">
            <?php
            $articles_args = array(
                'post_type' => 'article',
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key' => '_featured',
                        'value' => '1',
                        'compare' => '!='
                    )
                )
            );
            $articles_query = new WP_Query($articles_args);
            
            if ($articles_query->have_posts()) :
                while ($articles_query->have_posts()) : $articles_query->the_post();
            ?>
            
            <article class="article-card">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('card-image'); ?>
                    </a>
                <?php endif; ?>
                
                <div class="card-content">
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
                    
                    <h3 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="card-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <div class="card-meta">
                        <span class="author">Por <?php the_author(); ?></span>
                        <span class="separator">•</span>
                        <span class="date"><?php echo noticiasdm_format_date(get_the_date()); ?></span>
                        <span class="separator">•</span>
                        <span class="read-time"><?php echo get_article_read_time(get_the_ID()); ?> min</span>
                    </div>
                </div>
            </article>
            
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <!-- Categories Section -->
        <div class="categories-section">
            <h2 class="section-title">Explora por Categorías</h2>
            
            <div class="categories-grid">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'article_category',
                    'hide_empty' => false,
                ));
                
                if ($categories && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                        $color = get_category_color($category->term_id);
                        $count = $category->count;
                ?>
                
                <div class="category-card" style="border-left: 4px solid <?php echo esc_attr($color); ?>">
                    <h3 class="category-name">
                        <a href="<?php echo get_term_link($category); ?>" style="color: <?php echo esc_attr($color); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </h3>
                    <p class="category-description"><?php echo esc_html($category->description); ?></p>
                    <span class="category-count"><?php echo $count; ?> artículo<?php echo $count != 1 ? 's' : ''; ?></span>
                </div>
                
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
        
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
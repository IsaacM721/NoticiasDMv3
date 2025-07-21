<?php
// NoticiasDM - PHP puro para hosting compartido
// Production ready for Hostinger shared hosting with custom domain

// Configuración de Supabase
define('SUPABASE_URL', 'https://your-project.supabase.co'); // Replace with your Supabase URL
define('SUPABASE_ANON_KEY', 'your_anon_key_here'); // Replace with your anon key

// Production settings
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0); // Hide errors in production
ini_set('user_agent', 'NoticiasDM/1.0 (Hostinger)');

// Clase para manejar conexión con Supabase
class SupabaseClient {
    private $url;
    private $key;
    
    public function __construct($url, $key) {
        $this->url = $url;
        $this->key = $key;
    }
    
    public function getArticles() {
        $endpoint = 'articles?select=*,category:categories(*)&order=published_at.desc';
        return $this->makeRequest($endpoint);
    }
    
    public function getCategories() {
        $endpoint = 'categories?order=name.asc';
        return $this->makeRequest($endpoint);
    }
    
    private function makeRequest($endpoint, $method = 'GET', $data = null) {
        $url = $this->url . '/rest/v1/' . $endpoint;
        
        $headers = [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: application/json',
            'Prefer: return=representation',
            'User-Agent: NoticiasDM/1.0 (Hostinger)'
        ];
        
        $context = [
            'http' => [
                'method' => $method,
                'header' => implode("\r\n", $headers),
                'ignore_errors' => true,
                'timeout' => 30
            ]
        ];
        
        if ($data && $method !== 'GET') {
            $context['http']['content'] = json_encode($data);
        }
        
        $result = file_get_contents($url, false, stream_context_create($context));
        
        if ($result === false) {
            return ['error' => 'No se pudo conectar con la base de datos'];
        }
        
        return json_decode($result);
    }
}

// Inicializar cliente de Supabase
$supabase = new SupabaseClient(SUPABASE_URL, SUPABASE_ANON_KEY);

// Obtener datos
$articles_data = $supabase->getArticles();
$categories_data = $supabase->getCategories();

// Procesar datos
$articles = is_array($articles_data) ? $articles_data : [];
$categories = is_array($categories_data) ? $categories_data : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NoticiasDM - Tu fuente confiable de noticias de República Dominicana. Últimas noticias, política, deportes, tecnología y más.">
    <meta name="keywords" content="noticias, República Dominicana, política, deportes, tecnología, economía">
    <meta name="author" content="NoticiasDM">
    <meta property="og:title" content="NoticiasDM - Noticias de República Dominicana">
    <meta property="og:description" content="Tu fuente confiable de noticias de República Dominicana">
    <meta property="og:type" content="website">
    <link rel="canonical" href="https://<?php echo $_SERVER['HTTP_HOST']; ?>">
    <title>NoticiasDM - Noticias de República Dominicana</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        header h1 {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #36b7ff, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            font-size: 1.2rem;
            color: #4a5568;
            font-weight: 500;
        }
        
        main {
            padding: 3rem 0;
        }
        
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .article-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #36b7ff;
        }
        
        .article-content {
            padding: 1.5rem;
        }
        
        .category-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .article-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #1a202c;
            line-height: 1.4;
        }
        
        .article-excerpt {
            color: #4a5568;
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .article-meta {
            font-size: 0.9rem;
            color: #718096;
            font-weight: 500;
        }
        
        .error-message {
            background: #fed7d7;
            color: #c53030;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            border-left: 4px solid #e53e3e;
            margin: 2rem 0;
        }
        
        .no-articles {
            text-align: center;
            padding: 3rem;
            color: #718096;
        }
        
        .loading {
            text-align: center;
            padding: 3rem;
            color: #36b7ff;
        }
        
        .stats {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            text-align: center;
        }
        
        footer {
            background: #1a202c;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        footer p {
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }
            
            .articles-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .container {
                padding: 0 0.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>NoticiasDM</h1>
            <p class="subtitle">Tu fuente confiable de noticias de República Dominicana</p>
            <p style="font-size: 0.9rem; opacity: 0.8; margin-top: 0.5rem;">
                🌐 <?php echo $_SERVER['HTTP_HOST']; ?>
            </p>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if (isset($articles_data['error'])): ?>
                <div class="error-message">
                    <strong>⚠️ Error de conexión:</strong> No se pudieron cargar las noticias en este momento.
                    <br><small>Por favor, intenta nuevamente en unos minutos.</small>
                </div>
            <?php elseif (empty($articles)): ?>
                <div class="no-articles">
                    <h2>📰 No hay artículos publicados</h2>
                    <p>Vuelve pronto para ver las últimas noticias de República Dominicana.</p>
                </div>
            <?php else: ?>
                <div class="stats">
                    <h2 style="color: #2d3748; margin-bottom: 0.5rem;">
                        📊 Dashboard de Noticias
                    </h2>
                    <p style="color: #4a5568;">
                        <strong><?php echo count($articles); ?></strong> artículos publicados | 
                        <strong><?php echo count($categories); ?></strong> categorías | 
                        Última actualización: <?php echo date('d/m/Y H:i'); ?>
                    </p>
                </div>
                
                <h2 style="text-align: center; margin-bottom: 2rem; color: #2d3748;">
                    🔥 Últimas Noticias
                </h2>
                
                <div class="articles-grid">
                    <?php foreach ($articles as $article): ?>
                        <article class="article-card">
                            <?php if ($article->featured_image): ?>
                                <img src="<?php echo htmlspecialchars($article->featured_image); ?>" 
                                     alt="<?php echo htmlspecialchars($article->title); ?>" 
                                     class="article-image"
                                     loading="lazy">
                            <?php endif; ?>
                            
                            <div class="article-content">
                                <?php if ($article->category): ?>
                                    <span class="category-badge" 
                                          style="background-color: <?php echo htmlspecialchars($article->category->color); ?>">
                                        <?php echo htmlspecialchars($article->category->name); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <h3 class="article-title">
                                    <?php echo htmlspecialchars($article->title); ?>
                                </h3>
                                
                                <?php if ($article->excerpt): ?>
                                    <p class="article-excerpt">
                                        <?php echo htmlspecialchars($article->excerpt); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="article-meta">
                                    <?php if ($article->published_at): ?>
                                        📅 <?php echo date('d/m/Y H:i', strtotime($article->published_at)); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> NoticiasDM. Todos los derechos reservados.</p>
            <p>🚀 Powered by Supabase | 🌐 Hosting: Hostinger | 🇩🇴 Made in RD</p>
            <p style="font-size: 0.8rem; opacity: 0.7; margin-top: 0.5rem;">
                Dominio: <?php echo $_SERVER['HTTP_HOST']; ?> | 
                Servidor: <?php echo gethostname(); ?> |
                PHP: <?php echo PHP_VERSION; ?>
            </p>
        </div>
    </footer>
    
    <!-- Analytics placeholder -->
    <script>
        // Add your Google Analytics or other tracking code here
        console.log('NoticiasDM loaded successfully on <?php echo $_SERVER['HTTP_HOST']; ?>');
    </script>
</body>
</html>
<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'noticiasdm');
define('DB_USER', 'root');
define('DB_PASS', '');

// Create connection
function getConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        return null;
    }
}

// Mock data for when database is not available
function getMockArticles() {
    return [
        [
            'id' => 1,
            'title' => 'Nuevas Tecnologías Revolucionan el Sector Turístico Dominicano',
            'content' => '<p>El sector turístico de República Dominicana está experimentando una transformación sin precedentes gracias a la implementación de nuevas tecnologías que mejoran la experiencia del visitante.</p><p>Según datos del Ministerio de Turismo, la adopción de tecnologías como la inteligencia artificial, realidad virtual y aplicaciones móviles ha incrementado la satisfacción del turista en un 35% durante el último año.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Innovaciones Destacadas</h2><p>Entre las principales innovaciones se encuentran:</p><ul class="list-disc ml-6 my-4 space-y-2"><li>Sistemas de check-in automatizado en hoteles</li><li>Tours virtuales de destinos turísticos</li><li>Aplicaciones móviles para reservas y pagos</li><li>Chatbots para atención al cliente 24/7</li></ul><p>Estas mejoras han posicionado a República Dominicana como un destino líder en innovación turística en la región del Caribe.</p>',
            'excerpt' => 'El sector turístico dominicano abraza las nuevas tecnologías para mejorar la experiencia del visitante y optimizar procesos operativos.',
            'author' => 'María González',
            'author_bio' => 'Periodista especializada en tecnología con más de 8 años de experiencia.',
            'published_at' => '2024-01-15 10:30:00',
            'category' => 'Tecnología',
            'category_color' => 'bg-blue-500',
            'category_icon' => 'fa-duotone fa-microchip',
            'featured_image' => 'https://images.pexels.com/photos/1174732/pexels-photo-1174732.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'read_time' => 4,
            'featured' => true
        ],
        [
            'id' => 2,
            'title' => 'Análisis: El Impacto de las Criptomonedas en la Economía Nacional',
            'content' => '<p>Las criptomonedas han comenzado a tener un impacto significativo en la economía dominicana, con un crecimiento del 150% en adopción durante los últimos dos años.</p><p>Expertos económicos señalan que esta tendencia representa tanto oportunidades como desafíos para el sistema financiero tradicional del país.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Estadísticas Relevantes</h2><p>Los datos más recientes muestran:</p><ul class="list-disc ml-6 my-4 space-y-2"><li>Más de 500,000 dominicanos usan criptomonedas</li><li>Volumen de transacciones: $2.3 billones en 2023</li><li>Crecimiento del 45% en comercios que aceptan cripto</li></ul><p>El Banco Central ha iniciado estudios para regular este mercado emergente.</p>',
            'excerpt' => 'Las criptomonedas muestran un crecimiento explosivo en República Dominicana, generando debate sobre regulación y adopción.',
            'author' => 'Carlos Rodríguez',
            'author_bio' => 'Analista económico y financiero con experiencia en mercados internacionales.',
            'published_at' => '2024-01-12 14:20:00',
            'category' => 'Economía',
            'category_color' => 'bg-yellow-500',
            'category_icon' => 'fa-duotone fa-coins',
            'featured_image' => 'https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'read_time' => 6,
            'featured' => false
        ],
        [
            'id' => 3,
            'title' => 'Temporada de Baseball: Análisis del Rendimiento de Jugadores Dominicanos en MLB',
            'content' => '<p>La temporada 2024 de las Grandes Ligas ha sido excepcional para los jugadores dominicanos, con múltiples récords establecidos y actuaciones destacadas.</p><p>República Dominicana mantiene su posición como el segundo país con más jugadores en MLB, con 102 peloteros activos en la liga.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Destacados de la Temporada</h2><p>Los logros más importantes incluyen:</p><ul class="list-disc ml-6 my-4 space-y-2"><li>3 jugadores dominicanos en el All-Star Game</li><li>Récord de jonrones por jugadores dominicanos: 156</li><li>2 Cy Young Awards ganados por pitchers dominicanos</li><li>Incremento del 12% en contratos millonarios</li></ul><p>Estos resultados consolidan el talento dominicano en el baseball mundial.</p>',
            'excerpt' => 'Los peloteros dominicanos brillan en la temporada 2024 de MLB con múltiples récords y actuaciones destacadas.',
            'author' => 'Roberto Martínez',
            'author_bio' => 'Periodista deportivo especializado en baseball dominicano y MLB.',
            'published_at' => '2024-01-10 16:45:00',
            'category' => 'Deportes',
            'category_color' => 'bg-green-500',
            'category_icon' => 'fa-duotone fa-baseball',
            'featured_image' => 'https://images.pexels.com/photos/1618269/pexels-photo-1618269.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'read_time' => 5,
            'featured' => false
        ],
        [
            'id' => 4,
            'title' => 'Nuevas Reformas Educativas Buscan Modernizar el Sistema Nacional',
            'content' => '<p>El gobierno presenta un plan integral de reformas educativas que incluye tecnología, infraestructura y capacitación docente para mejorar la calidad educativa en todo el país.</p><p>Las reformas contemplan una inversión de más de 2,000 millones de pesos en los próximos tres años, enfocándose en la digitalización de las aulas y la formación continua del profesorado.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Puntos Clave de la Reforma</h2><ul class="list-disc ml-6 my-4 space-y-2"><li>Implementación de tablets en todas las escuelas públicas</li><li>Capacitación digital para 50,000 maestros</li><li>Construcción de 200 nuevas aulas tecnológicas</li><li>Programa de becas para estudiantes destacados</li></ul><p>El Ministerio de Educación espera ver resultados tangibles en el próximo año escolar.</p>',
            'excerpt' => 'El gobierno presenta un plan integral de reformas educativas que incluye tecnología, infraestructura y capacitación docente.',
            'author' => 'Ana Pérez',
            'author_bio' => 'Corresponsal política con amplia experiencia cubriendo el sector educativo.',
            'published_at' => '2024-01-08 09:15:00',
            'category' => 'Política',
            'category_color' => 'bg-red-500',
            'category_icon' => 'fa-duotone fa-landmark',
            'featured_image' => 'https://images.pexels.com/photos/1181467/pexels-photo-1181467.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'read_time' => 7,
            'featured' => false
        ],
        [
            'id' => 5,
            'title' => 'Festival de Merengue 2024 Celebra la Riqueza Musical Dominicana',
            'content' => '<p>El festival anual reúne a los mejores exponentes del merengue nacional e internacional en una celebración de la identidad cultural dominicana que se extenderá por tres días.</p><p>Este año, el evento contará con la participación de más de 50 artistas, incluyendo leyendas del género y nuevos talentos emergentes que prometen revolucionar la escena musical.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Artistas Confirmados</h2><ul class="list-disc ml-6 my-4 space-y-2"><li>Johnny Ventura y su orquesta</li><li>Milly Quezada, la Reina del Merengue</li><li>Sergio Vargas en concierto especial</li><li>Nuevos talentos del merengue urbano</li></ul><p>El festival se realizará en el Estadio Olímpico con entrada gratuita para el público.</p>',
            'excerpt' => 'El festival anual reúne a los mejores exponentes del merengue nacional e internacional en una celebración cultural única.',
            'author' => 'Luis Fernández',
            'author_bio' => 'Crítico musical y especialista en cultura dominicana.',
            'published_at' => '2024-01-05 18:30:00',
            'category' => 'Cultura',
            'category_color' => 'bg-purple-500',
            'category_icon' => 'fa-duotone fa-music',
            'featured_image' => 'https://images.pexels.com/photos/1181298/pexels-photo-1181298.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'read_time' => 3,
            'featured' => false
        ],
        [
            'id' => 6,
            'title' => 'Campaña Nacional de Vacunación Alcanza el 85% de Cobertura',
            'content' => '<p>Las autoridades sanitarias reportan avances significativos en la campaña de inmunización, superando las metas establecidas para este período y posicionando al país como líder regional en salud pública.</p><p>El Ministerio de Salud Pública destaca que la alta participación ciudadana ha sido clave para el éxito de la campaña, que incluye vacunas contra múltiples enfermedades.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Logros de la Campaña</h2><ul class="list-disc ml-6 my-4 space-y-2"><li>85% de cobertura nacional alcanzada</li><li>Reducción del 40% en enfermedades prevenibles</li><li>Participación de 3,200 centros de salud</li><li>Capacitación de 15,000 profesionales de la salud</li></ul><p>La próxima fase incluirá la expansión a zonas rurales remotas.</p>',
            'excerpt' => 'Las autoridades sanitarias reportan avances significativos en la campaña de inmunización, superando las metas establecidas.',
            'author' => 'Dr. Carmen Jiménez',
            'author_bio' => 'Médica epidemióloga y especialista en salud pública.',
            'published_at' => '2024-01-03 11:00:00',
            'category' => 'Salud',
            'category_color' => 'bg-emerald-500',
            'category_icon' => 'fa-duotone fa-heart-pulse',
            'featured_image' => 'https://images.pexels.com/photos/1181677/pexels-photo-1181677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'read_time' => 4,
            'featured' => false
        ]
    ];
}

function getMockCategories() {
    return [
        [
            'id' => 1,
            'name' => 'Política',
            'slug' => 'politica',
            'color' => 'bg-red-500',
            'icon' => 'fa-duotone fa-landmark',
            'description' => 'Noticias sobre política nacional e internacional, análisis gubernamental y electoral.'
        ],
        [
            'id' => 2,
            'name' => 'Deportes',
            'slug' => 'deportes',
            'color' => 'bg-green-500',
            'icon' => 'fa-duotone fa-baseball',
            'description' => 'Cobertura deportiva completa, baseball, fútbol y análisis de rendimiento atlético.'
        ],
        [
            'id' => 3,
            'name' => 'Tecnología',
            'slug' => 'tecnologia',
            'color' => 'bg-blue-500',
            'icon' => 'fa-duotone fa-microchip',
            'description' => 'Últimas noticias tecnológicas, innovación digital y transformación empresarial.'
        ],
        [
            'id' => 4,
            'name' => 'Economía',
            'slug' => 'economia',
            'color' => 'bg-yellow-500',
            'icon' => 'fa-duotone fa-coins',
            'description' => 'Análisis económico, mercados financieros, criptomonedas y desarrollo comercial.'
        ],
        [
            'id' => 5,
            'name' => 'Cultura',
            'slug' => 'cultura',
            'color' => 'bg-purple-500',
            'icon' => 'fa-duotone fa-music',
            'description' => 'Arte, música, festivales y eventos culturales que celebran la identidad dominicana.'
        ],
        [
            'id' => 6,
            'name' => 'Salud',
            'slug' => 'salud',
            'color' => 'bg-emerald-500',
            'icon' => 'fa-duotone fa-heart-pulse',
            'description' => 'Información médica, campañas de salud pública y avances en medicina nacional.'
        ]
    ];
}

// Get articles from database or mock data
function getArticles($limit = null, $featured_only = false) {
    $pdo = getConnection();
    
    if ($pdo) {
        try {
            $sql = "SELECT * FROM articles WHERE status = 'published'";
            if ($featured_only) {
                $sql .= " AND featured = 1";
            }
            $sql .= " ORDER BY published_at DESC";
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return getMockArticles();
        }
    } else {
        $articles = getMockArticles();
        if ($featured_only) {
            $articles = array_filter($articles, function($article) {
                return $article['featured'];
            });
        }
        if ($limit) {
            $articles = array_slice($articles, 0, $limit);
        }
        return $articles;
    }
}

// Get categories from database or mock data
function getCategories() {
    $pdo = getConnection();
    
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM categories ORDER BY name ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return getMockCategories();
        }
    } else {
        return getMockCategories();
    }
}

// Get single article
function getArticle($id) {
    $pdo = getConnection();
    
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ? AND status = 'published'");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $articles = getMockArticles();
            foreach ($articles as $article) {
                if ($article['id'] == $id) {
                    return $article;
                }
            }
            return null;
        }
    } else {
        $articles = getMockArticles();
        foreach ($articles as $article) {
            if ($article['id'] == $id) {
                return $article;
            }
        }
        return null;
    }
}

// Format date in Spanish
function formatDate($date) {
    $months = [
        'January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo',
        'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio',
        'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
        'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'
    ];
    
    $formatted = date('j \d\e F, Y', strtotime($date));
    return str_replace(array_keys($months), array_values($months), $formatted);
}
?>
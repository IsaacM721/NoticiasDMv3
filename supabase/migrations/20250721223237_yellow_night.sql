-- NoticiasDM Database Schema
-- Run this in phpMyAdmin to create the database structure

CREATE DATABASE IF NOT EXISTS noticiasdm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE noticiasdm;

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    color VARCHAR(20) NOT NULL DEFAULT 'bg-blue-500',
    icon VARCHAR(50) NOT NULL DEFAULT 'fa-duotone fa-newspaper',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Authors table
CREATE TABLE IF NOT EXISTS authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    bio TEXT,
    avatar VARCHAR(255),
    social_links JSON,
    specialties JSON,
    verified BOOLEAN DEFAULT FALSE,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Articles table
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    excerpt TEXT,
    slug VARCHAR(255) NOT NULL UNIQUE,
    featured_image VARCHAR(255),
    author_id INT,
    category_id INT,
    status ENUM('draft', 'published') DEFAULT 'draft',
    featured BOOLEAN DEFAULT FALSE,
    read_time INT DEFAULT 5,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE SET NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_published_at (published_at),
    INDEX idx_featured (featured)
);

-- Insert sample categories
INSERT INTO categories (name, slug, color, icon, description) VALUES
('Política', 'politica', 'bg-red-500', 'fa-duotone fa-landmark', 'Noticias sobre política nacional e internacional, análisis gubernamental y electoral.'),
('Deportes', 'deportes', 'bg-green-500', 'fa-duotone fa-baseball', 'Cobertura deportiva completa, baseball, fútbol y análisis de rendimiento atlético.'),
('Tecnología', 'tecnologia', 'bg-blue-500', 'fa-duotone fa-microchip', 'Últimas noticias tecnológicas, innovación digital y transformación empresarial.'),
('Economía', 'economia', 'bg-yellow-500', 'fa-duotone fa-coins', 'Análisis económico, mercados financieros, criptomonedas y desarrollo comercial.'),
('Cultura', 'cultura', 'bg-purple-500', 'fa-duotone fa-music', 'Arte, música, festivales y eventos culturales que celebran la identidad dominicana.'),
('Salud', 'salud', 'bg-emerald-500', 'fa-duotone fa-heart-pulse', 'Información médica, campañas de salud pública y avances en medicina nacional.');

-- Insert sample authors
INSERT INTO authors (name, email, bio, avatar, specialties, verified) VALUES
('María González', 'maria.gonzalez@noticiasdm.com', 'Periodista especializada en tecnología con más de 8 años de experiencia.', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1', '["Tecnología", "Innovación", "Startups"]', TRUE),
('Carlos Rodríguez', 'carlos.rodriguez@noticiasdm.com', 'Analista económico y financiero con experiencia en mercados internacionales.', 'https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1', '["Economía", "Finanzas", "Criptomonedas"]', TRUE),
('Roberto Martínez', 'roberto.martinez@noticiasdm.com', 'Periodista deportivo especializado en baseball dominicano y MLB.', 'https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1', '["Deportes", "Baseball", "MLB"]', TRUE),
('Ana Pérez', 'ana.perez@noticiasdm.com', 'Corresponsal política con amplia experiencia cubriendo el sector educativo.', 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1', '["Política", "Gobierno", "Análisis"]', TRUE),
('Luis Fernández', 'luis.fernandez@noticiasdm.com', 'Crítico musical y especialista en cultura dominicana.', 'https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1', '["Cultura", "Música", "Arte"]', TRUE),
('Dr. Carmen Jiménez', 'carmen.jimenez@noticiasdm.com', 'Médica epidemióloga y especialista en salud pública.', 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1', '["Salud", "Medicina", "Epidemiología"]', TRUE);

-- Insert sample articles
INSERT INTO articles (title, content, excerpt, slug, featured_image, author_id, category_id, status, featured, read_time, published_at) VALUES
('Nuevas Tecnologías Revolucionan el Sector Turístico Dominicano', 
'<p>El sector turístico de República Dominicana está experimentando una transformación sin precedentes gracias a la implementación de nuevas tecnologías que mejoran la experiencia del visitante.</p><p>Según datos del Ministerio de Turismo, la adopción de tecnologías como la inteligencia artificial, realidad virtual y aplicaciones móviles ha incrementado la satisfacción del turista en un 35% durante el último año.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Innovaciones Destacadas</h2><p>Entre las principales innovaciones se encuentran:</p><ul class="list-disc ml-6 my-4 space-y-2"><li>Sistemas de check-in automatizado en hoteles</li><li>Tours virtuales de destinos turísticos</li><li>Aplicaciones móviles para reservas y pagos</li><li>Chatbots para atención al cliente 24/7</li></ul><p>Estas mejoras han posicionado a República Dominicana como un destino líder en innovación turística en la región del Caribe.</p>',
'El sector turístico dominicano abraza las nuevas tecnologías para mejorar la experiencia del visitante y optimizar procesos operativos.',
'tecnologias-revolucionan-turismo-dominicano',
'https://images.pexels.com/photos/1174732/pexels-photo-1174732.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
1, 3, 'published', TRUE, 4, '2024-01-15 10:30:00'),

('Análisis: El Impacto de las Criptomonedas en la Economía Nacional',
'<p>Las criptomonedas han comenzado a tener un impacto significativo en la economía dominicana, con un crecimiento del 150% en adopción durante los últimos dos años.</p><p>Expertos económicos señalan que esta tendencia representa tanto oportunidades como desafíos para el sistema financiero tradicional del país.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Estadísticas Relevantes</h2><p>Los datos más recientes muestran:</p><ul class="list-disc ml-6 my-4 space-y-2"><li>Más de 500,000 dominicanos usan criptomonedas</li><li>Volumen de transacciones: $2.3 billones en 2023</li><li>Crecimiento del 45% en comercios que aceptan cripto</li></ul><p>El Banco Central ha iniciado estudios para regular este mercado emergente.</p>',
'Las criptomonedas muestran un crecimiento explosivo en República Dominicana, generando debate sobre regulación y adopción.',
'impacto-criptomonedas-economia-nacional',
'https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
2, 4, 'published', FALSE, 6, '2024-01-12 14:20:00'),

('Temporada de Baseball: Análisis del Rendimiento de Jugadores Dominicanos en MLB',
'<p>La temporada 2024 de las Grandes Ligas ha sido excepcional para los jugadores dominicanos, con múltiples récords establecidos y actuaciones destacadas.</p><p>República Dominicana mantiene su posición como el segundo país con más jugadores en MLB, con 102 peloteros activos en la liga.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Destacados de la Temporada</h2><p>Los logros más importantes incluyen:</p><ul class="list-disc ml-6 my-4 space-y-2"><li>3 jugadores dominicanos en el All-Star Game</li><li>Récord de jonrones por jugadores dominicanos: 156</li><li>2 Cy Young Awards ganados por pitchers dominicanos</li><li>Incremento del 12% en contratos millonarios</li></ul><p>Estos resultados consolidan el talento dominicano en el baseball mundial.</p>',
'Los peloteros dominicanos brillan en la temporada 2024 de MLB con múltiples récords y actuaciones destacadas.',
'baseball-jugadores-dominicanos-mlb-2024',
'https://images.pexels.com/photos/1618269/pexels-photo-1618269.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
3, 2, 'published', FALSE, 5, '2024-01-10 16:45:00'),

('Nuevas Reformas Educativas Buscan Modernizar el Sistema Nacional',
'<p>El gobierno presenta un plan integral de reformas educativas que incluye tecnología, infraestructura y capacitación docente para mejorar la calidad educativa en todo el país.</p><p>Las reformas contemplan una inversión de más de 2,000 millones de pesos en los próximos tres años, enfocándose en la digitalización de las aulas y la formación continua del profesorado.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Puntos Clave de la Reforma</h2><ul class="list-disc ml-6 my-4 space-y-2"><li>Implementación de tablets en todas las escuelas públicas</li><li>Capacitación digital para 50,000 maestros</li><li>Construcción de 200 nuevas aulas tecnológicas</li><li>Programa de becas para estudiantes destacados</li></ul><p>El Ministerio de Educación espera ver resultados tangibles en el próximo año escolar.</p>',
'El gobierno presenta un plan integral de reformas educativas que incluye tecnología, infraestructura y capacitación docente.',
'reformas-educativas-modernizar-sistema-nacional',
'https://images.pexels.com/photos/1181467/pexels-photo-1181467.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
4, 1, 'published', FALSE, 7, '2024-01-08 09:15:00'),

('Festival de Merengue 2024 Celebra la Riqueza Musical Dominicana',
'<p>El festival anual reúne a los mejores exponentes del merengue nacional e internacional en una celebración de la identidad cultural dominicana que se extenderá por tres días.</p><p>Este año, el evento contará con la participación de más de 50 artistas, incluyendo leyendas del género y nuevos talentos emergentes que prometen revolucionar la escena musical.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Artistas Confirmados</h2><ul class="list-disc ml-6 my-4 space-y-2"><li>Johnny Ventura y su orquesta</li><li>Milly Quezada, la Reina del Merengue</li><li>Sergio Vargas en concierto especial</li><li>Nuevos talentos del merengue urbano</li></ul><p>El festival se realizará en el Estadio Olímpico con entrada gratuita para el público.</p>',
'El festival anual reúne a los mejores exponentes del merengue nacional e internacional en una celebración cultural única.',
'festival-merengue-2024-celebra-riqueza-musical',
'https://images.pexels.com/photos/1181298/pexels-photo-1181298.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
5, 5, 'published', FALSE, 3, '2024-01-05 18:30:00'),

('Campaña Nacional de Vacunación Alcanza el 85% de Cobertura',
'<p>Las autoridades sanitarias reportan avances significativos en la campaña de inmunización, superando las metas establecidas para este período y posicionando al país como líder regional en salud pública.</p><p>El Ministerio de Salud Pública destaca que la alta participación ciudadana ha sido clave para el éxito de la campaña, que incluye vacunas contra múltiples enfermedades.</p><h2 class="text-2xl font-bold mt-6 mb-4 text-gray-800">Logros de la Campaña</h2><ul class="list-disc ml-6 my-4 space-y-2"><li>85% de cobertura nacional alcanzada</li><li>Reducción del 40% en enfermedades prevenibles</li><li>Participación de 3,200 centros de salud</li><li>Capacitación de 15,000 profesionales de la salud</li></ul><p>La próxima fase incluirá la expansión a zonas rurales remotas.</p>',
'Las autoridades sanitarias reportan avances significativos en la campaña de inmunización, superando las metas establecidas.',
'campana-nacional-vacunacion-85-cobertura',
'https://images.pexels.com/photos/1181677/pexels-photo-1181677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
6, 6, 'published', FALSE, 4, '2024-01-03 11:00:00');
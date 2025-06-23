import { Article, Tag, Category, Subtag, Writer } from '../types';

export const categories: Category[] = [
  {
    id: '1',
    name: 'Política',
    slug: 'politica',
    color: '#dc2626',
    description: 'Noticias sobre política nacional e internacional'
  },
  {
    id: '2',
    name: 'Deportes',
    slug: 'deportes',
    color: '#16a34a',
    description: 'Cobertura deportiva y análisis'
  },
  {
    id: '3',
    name: 'Tecnología',
    slug: 'tecnologia',
    color: '#2563eb',
    description: 'Últimas noticias tecnológicas'
  },
  {
    id: '4',
    name: 'Economía',
    slug: 'economia',
    color: '#ca8a04',
    description: 'Análisis económico y financiero'
  },
  {
    id: '5',
    name: 'Cultura',
    slug: 'cultura',
    color: '#7c3aed',
    description: 'Arte, música y eventos culturales'
  }
];

export const subtags: Subtag[] = [
  // Política subtags
  { id: 's1', name: 'Elecciones', slug: 'elecciones', color: '#dc2626', categoryId: '1' },
  { id: 's2', name: 'Congreso', slug: 'congreso', color: '#b91c1c', categoryId: '1' },
  { id: 's3', name: 'Presidencia', slug: 'presidencia', color: '#991b1b', categoryId: '1' },
  { id: 's4', name: 'Partidos Políticos', slug: 'partidos-politicos', color: '#7f1d1d', categoryId: '1' },
  { id: 's5', name: 'Corrupción', slug: 'corrupcion', color: '#dc2626', categoryId: '1' },
  { id: 's6', name: 'Reformas', slug: 'reformas', color: '#b91c1c', categoryId: '1' },
  
  // Deportes subtags
  { id: 's7', name: 'Baseball', slug: 'baseball', color: '#16a34a', categoryId: '2' },
  { id: 's8', name: 'Fútbol', slug: 'futbol', color: '#15803d', categoryId: '2' },
  { id: 's9', name: 'Baloncesto', slug: 'baloncesto', color: '#166534', categoryId: '2' },
  { id: 's10', name: 'Boxeo', slug: 'boxeo', color: '#14532d', categoryId: '2' },
  { id: 's11', name: 'Voleibol', slug: 'voleibol', color: '#16a34a', categoryId: '2' },
  { id: 's12', name: 'Atletismo', slug: 'atletismo', color: '#15803d', categoryId: '2' },
  
  // Tecnología subtags
  { id: 's13', name: 'Inteligencia Artificial', slug: 'ia', color: '#2563eb', categoryId: '3' },
  { id: 's14', name: 'Ciberseguridad', slug: 'ciberseguridad', color: '#1d4ed8', categoryId: '3' },
  { id: 's15', name: 'Startups', slug: 'startups', color: '#1e40af', categoryId: '3' },
  { id: 's16', name: 'Telecomunicaciones', slug: 'telecomunicaciones', color: '#1e3a8a', categoryId: '3' },
  { id: 's17', name: 'Innovación', slug: 'innovacion', color: '#2563eb', categoryId: '3' },
  { id: 's18', name: 'Redes Sociales', slug: 'redes-sociales', color: '#1d4ed8', categoryId: '3' },
  
  // Economía subtags
  { id: 's19', name: 'Mercado Financiero', slug: 'mercado-financiero', color: '#ca8a04', categoryId: '4' },
  { id: 's20', name: 'Criptomonedas', slug: 'criptomonedas', color: '#a16207', categoryId: '4' },
  { id: 's21', name: 'Turismo', slug: 'turismo', color: '#92400e', categoryId: '4' },
  { id: 's22', name: 'Comercio Internacional', slug: 'comercio-internacional', color: '#78350f', categoryId: '4' },
  { id: 's23', name: 'Inflación', slug: 'inflacion', color: '#ca8a04', categoryId: '4' },
  { id: 's24', name: 'Empleo', slug: 'empleo', color: '#a16207', categoryId: '4' },
  
  // Cultura subtags
  { id: 's25', name: 'Música', slug: 'musica', color: '#7c3aed', categoryId: '5' },
  { id: 's26', name: 'Arte', slug: 'arte', color: '#6d28d9', categoryId: '5' },
  { id: 's27', name: 'Literatura', slug: 'literatura', color: '#5b21b6', categoryId: '5' },
  { id: 's28', name: 'Cine', slug: 'cine', color: '#4c1d95', categoryId: '5' },
  { id: 's29', name: 'Teatro', slug: 'teatro', color: '#7c3aed', categoryId: '5' },
  { id: 's30', name: 'Festivales', slug: 'festivales', color: '#6d28d9', categoryId: '5' }
];

// New tags sorted alphabetically
export const tags: Tag[] = [
  { id: '1', name: 'Actualidad', slug: 'actualidad', color: '#36b7ff' },
  { id: '2', name: 'Artículo de Opinión', slug: 'articulo-opinion', color: '#ef4444' },
  { id: '3', name: 'Baseball', slug: 'baseball', color: '#22c55e' },
  { id: '4', name: 'Criptomonedas', slug: 'criptomonedas', color: '#8b5cf6' },
  { id: '5', name: 'Denuncia', slug: 'denuncia', color: '#f97316' },
  { id: '6', name: 'Educación', slug: 'educacion', color: '#f59e0b' },
  { id: '7', name: 'Elecciones', slug: 'elecciones', color: '#f97316' },
  { id: '8', name: 'Inteligencia Artificial', slug: 'ia', color: '#3b82f6' },
  { id: '9', name: 'Reportajes', slug: 'reportajes', color: '#10b981' },
  { id: '10', name: 'República Dominicana', slug: 'republica-dominicana', color: '#36b7ff' },
  { id: '11', name: 'Salud', slug: 'salud', color: '#10b981' },
  { id: '12', name: 'Turismo', slug: 'turismo', color: '#06b6d4' }
].sort((a, b) => a.name.localeCompare(b.name));

export const writers: Writer[] = [
  {
    id: '1',
    name: 'María González',
    email: 'maria.gonzalez@noticiasdm.com',
    bio: 'Periodista especializada en tecnología y innovación con más de 8 años de experiencia. Graduada en Comunicación Social por la UASD.',
    avatar: 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1',
    socialLinks: {
      twitter: 'https://twitter.com/mariagonzalez',
      linkedin: 'https://linkedin.com/in/mariagonzalez',
      website: 'https://mariagonzalez.com'
    },
    specialties: ['Tecnología', 'Innovación', 'Startups'],
    joinedAt: new Date('2022-03-15'),
    articlesCount: 45,
    verified: true
  },
  {
    id: '2',
    name: 'Carlos Rodríguez',
    email: 'carlos.rodriguez@noticiasdm.com',
    bio: 'Analista económico y financiero con experiencia en mercados internacionales. MBA en Finanzas por INTEC.',
    avatar: 'https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1',
    socialLinks: {
      twitter: 'https://twitter.com/carlosrodriguez',
      linkedin: 'https://linkedin.com/in/carlosrodriguez'
    },
    specialties: ['Economía', 'Finanzas', 'Criptomonedas'],
    joinedAt: new Date('2021-11-20'),
    articlesCount: 62,
    verified: true
  },
  {
    id: '3',
    name: 'Roberto Martínez',
    email: 'roberto.martinez@noticiasdm.com',
    bio: 'Periodista deportivo con cobertura especializada en baseball dominicano y MLB. Ex-jugador profesional.',
    avatar: 'https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1',
    socialLinks: {
      twitter: 'https://twitter.com/robertomartinez',
      instagram: 'https://instagram.com/robertomartinez'
    },
    specialties: ['Deportes', 'Baseball', 'MLB'],
    joinedAt: new Date('2023-01-10'),
    articlesCount: 38,
    verified: true
  },
  {
    id: '4',
    name: 'Ana Pérez',
    email: 'ana.perez@noticiasdm.com',
    bio: 'Corresponsal política con amplia experiencia cubriendo el Congreso Nacional y eventos gubernamentales.',
    avatar: 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&dpr=1',
    socialLinks: {
      twitter: 'https://twitter.com/anaperez',
      linkedin: 'https://linkedin.com/in/anaperez'
    },
    specialties: ['Política', 'Gobierno', 'Análisis'],
    joinedAt: new Date('2022-08-05'),
    articlesCount: 71,
    verified: true
  }
];

export const articles: Article[] = [
  {
    id: '1',
    title: 'Nuevas Tecnologías Revolucionan el Sector Turístico Dominicano',
    content: `
      <p>El sector turístico de República Dominicana está experimentando una transformación sin precedentes gracias a la implementación de nuevas tecnologías que mejoran la experiencia del visitante y optimizan los procesos operativos.</p>
      
      <p>Según datos del Ministerio de Turismo, la adopción de tecnologías como la inteligencia artificial, realidad virtual y aplicaciones móviles ha incrementado la satisfacción del turista en un 35% durante el último año.</p>
      
      <h2>Innovaciones Destacadas</h2>
      <p>Entre las principales innovaciones se encuentran:</p>
      <ul>
        <li>Sistemas de check-in automatizado en hoteles</li>
        <li>Tours virtuales de destinos turísticos</li>
        <li>Aplicaciones móviles para reservas y pagos</li>
        <li>Chatbots para atención al cliente 24/7</li>
      </ul>
      
      <p>Estas mejoras han posicionado a República Dominicana como un destino líder en innovación turística en la región del Caribe.</p>
    `,
    excerpt: 'El sector turístico dominicano abraza las nuevas tecnologías para mejorar la experiencia del visitante y optimizar procesos operativos.',
    author: 'María González',
    publishedAt: new Date('2024-01-15'),
    updatedAt: new Date('2024-01-15'),
    featuredImage: 'https://images.pexels.com/photos/1174732/pexels-photo-1174732.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
    tags: [tags[9], tags[11], tags[7]],
    subtags: [subtags[12], subtags[20]],
    category: categories[2],
    status: 'published',
    slug: 'tecnologias-revolucionan-turismo-dominicano',
    seoTitle: 'Nuevas Tecnologías en el Turismo Dominicano 2024',
    seoDescription: 'Descubre cómo las nuevas tecnologías están transformando el sector turístico de República Dominicana y mejorando la experiencia del visitante.',
    readTime: 4
  },
  {
    id: '2',
    title: 'Análisis: El Impacto de las Criptomonedas en la Economía Nacional',
    content: `
      <p>Las criptomonedas han comenzado a tener un impacto significativo en la economía dominicana, con un crecimiento del 150% en adopción durante los últimos dos años.</p>
      
      <p>Expertos económicos señalan que esta tendencia representa tanto oportunidades como desafíos para el sistema financiero tradicional del país.</p>
      
      <h2>Estadísticas Relevantes</h2>
      <p>Los datos más recientes muestran:</p>
      <ul>
        <li>Más de 500,000 dominicanos usan criptomonedas</li>
        <li>Volumen de transacciones: $2.3 billones en 2023</li>
        <li>Crecimiento del 45% en comercios que aceptan cripto</li>
      </ul>
      
      <p>El Banco Central ha iniciado estudios para regular este mercado emergente.</p>
    `,
    excerpt: 'Las criptomonedas muestran un crecimiento explosivo en República Dominicana, generando debate sobre regulación y adopción.',
    author: 'Carlos Rodríguez',
    publishedAt: new Date('2024-01-12'),
    updatedAt: new Date('2024-01-12'),
    featuredImage: 'https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
    tags: [tags[3], tags[9]],
    subtags: [subtags[18]],
    category: categories[3],
    status: 'published',
    slug: 'impacto-criptomonedas-economia-nacional',
    seoTitle: 'Criptomonedas en República Dominicana: Impacto Económico 2024',
    seoDescription: 'Análisis completo del impacto de las criptomonedas en la economía dominicana y su creciente adopción.',
    readTime: 6
  },
  {
    id: '3',
    title: 'Temporada de Baseball: Análisis del Rendimiento de Jugadores Dominicanos en MLB',
    content: `
      <p>La temporada 2024 de las Grandes Ligas ha sido excepcional para los jugadores dominicanos, con múltiples récords establecidos y actuaciones destacadas.</p>
      
      <p>República Dominicana mantiene su posición como el segundo país con más jugadores en MLB, con 102 peloteros activos en la liga.</p>
      
      <h2>Destacados de la Temporada</h2>
      <p>Los logros más importantes incluyen:</p>
      <ul>
        <li>3 jugadores dominicanos en el All-Star Game</li>
        <li>Récord de jonrones por jugadores dominicanos: 156</li>
        <li>2 Cy Young Awards ganados por pitchers dominicanos</li>
        <li>Incremento del 12% en contratos millonarios</li>
      </ul>
      
      <p>Estos resultados consolidan el talento dominicano en el baseball mundial.</p>
    `,
    excerpt: 'Los peloteros dominicanos brillan en la temporada 2024 de MLB con múltiples récords y actuaciones destacadas.',
    author: 'Roberto Martínez',
    publishedAt: new Date('2024-01-10'),
    updatedAt: new Date('2024-01-10'),
    featuredImage: 'https://images.pexels.com/photos/1618269/pexels-photo-1618269.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
    tags: [tags[2], tags[9]],
    subtags: [subtags[6]],
    category: categories[1],
    status: 'published',
    slug: 'baseball-jugadores-dominicanos-mlb-2024',
    seoTitle: 'Jugadores Dominicanos en MLB 2024: Análisis Completo',
    seoDescription: 'Análisis detallado del rendimiento de los peloteros dominicanos en la temporada 2024 de las Grandes Ligas.',
    readTime: 5
  }
];
/*
  # Create NoticiasDM Database Schema

  1. New Tables
    - `categories` - Article categories (Política, Deportes, etc.)
    - `tags` - General tags for articles
    - `subtags` - Category-specific subtags
    - `writers` - Writer profiles and information
    - `articles` - News articles with full content
    - `article_tags` - Many-to-many relationship between articles and tags
    - `article_subtags` - Many-to-many relationship between articles and subtags

  2. Security
    - Enable RLS on all tables
    - Add policies for public read access
    - Add policies for authenticated admin access
*/

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  name text NOT NULL,
  slug text UNIQUE NOT NULL,
  color text NOT NULL,
  description text,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Tags table
CREATE TABLE IF NOT EXISTS tags (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  name text NOT NULL,
  slug text UNIQUE NOT NULL,
  color text NOT NULL DEFAULT '#36b7ff',
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Subtags table
CREATE TABLE IF NOT EXISTS subtags (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  name text NOT NULL,
  slug text UNIQUE NOT NULL,
  color text NOT NULL,
  category_id uuid REFERENCES categories(id) ON DELETE CASCADE,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Writers table
CREATE TABLE IF NOT EXISTS writers (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  name text NOT NULL,
  email text UNIQUE NOT NULL,
  bio text,
  avatar text,
  social_links jsonb DEFAULT '{}',
  specialties text[] DEFAULT '{}',
  verified boolean DEFAULT false,
  active boolean DEFAULT true,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Articles table
CREATE TABLE IF NOT EXISTS articles (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  title text NOT NULL,
  content text NOT NULL,
  excerpt text,
  slug text UNIQUE NOT NULL,
  featured_image text,
  author_id uuid REFERENCES writers(id) ON DELETE SET NULL,
  category_id uuid REFERENCES categories(id) ON DELETE SET NULL,
  status text DEFAULT 'draft' CHECK (status IN ('draft', 'published')),
  seo_title text,
  seo_description text,
  read_time integer DEFAULT 5,
  published_at timestamptz,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Article tags junction table
CREATE TABLE IF NOT EXISTS article_tags (
  article_id uuid REFERENCES articles(id) ON DELETE CASCADE,
  tag_id uuid REFERENCES tags(id) ON DELETE CASCADE,
  PRIMARY KEY (article_id, tag_id)
);

-- Article subtags junction table
CREATE TABLE IF NOT EXISTS article_subtags (
  article_id uuid REFERENCES articles(id) ON DELETE CASCADE,
  subtag_id uuid REFERENCES subtags(id) ON DELETE CASCADE,
  PRIMARY KEY (article_id, subtag_id)
);

-- Enable RLS
ALTER TABLE categories ENABLE ROW LEVEL SECURITY;
ALTER TABLE tags ENABLE ROW LEVEL SECURITY;
ALTER TABLE subtags ENABLE ROW LEVEL SECURITY;
ALTER TABLE writers ENABLE ROW LEVEL SECURITY;
ALTER TABLE articles ENABLE ROW LEVEL SECURITY;
ALTER TABLE article_tags ENABLE ROW LEVEL SECURITY;
ALTER TABLE article_subtags ENABLE ROW LEVEL SECURITY;

-- Public read policies
CREATE POLICY "Public can read categories" ON categories FOR SELECT TO anon USING (true);
CREATE POLICY "Public can read tags" ON tags FOR SELECT TO anon USING (true);
CREATE POLICY "Public can read subtags" ON subtags FOR SELECT TO anon USING (true);
CREATE POLICY "Public can read active writers" ON writers FOR SELECT TO anon USING (active = true);
CREATE POLICY "Public can read published articles" ON articles FOR SELECT TO anon USING (status = 'published');
CREATE POLICY "Public can read article_tags" ON article_tags FOR SELECT TO anon USING (true);
CREATE POLICY "Public can read article_subtags" ON article_subtags FOR SELECT TO anon USING (true);

-- Admin policies (authenticated users can do everything)
CREATE POLICY "Authenticated can manage categories" ON categories FOR ALL TO authenticated USING (true);
CREATE POLICY "Authenticated can manage tags" ON tags FOR ALL TO authenticated USING (true);
CREATE POLICY "Authenticated can manage subtags" ON subtags FOR ALL TO authenticated USING (true);
CREATE POLICY "Authenticated can manage writers" ON writers FOR ALL TO authenticated USING (true);
CREATE POLICY "Authenticated can manage articles" ON articles FOR ALL TO authenticated USING (true);
CREATE POLICY "Authenticated can manage article_tags" ON article_tags FOR ALL TO authenticated USING (true);
CREATE POLICY "Authenticated can manage article_subtags" ON article_subtags FOR ALL TO authenticated USING (true);

-- Insert initial data
INSERT INTO categories (name, slug, color, description) VALUES
('Política', 'politica', '#dc2626', 'Noticias sobre política nacional e internacional'),
('Deportes', 'deportes', '#16a34a', 'Cobertura deportiva y análisis'),
('Tecnología', 'tecnologia', '#2563eb', 'Últimas noticias tecnológicas'),
('Economía', 'economia', '#ca8a04', 'Análisis económico y financiero'),
('Cultura', 'cultura', '#7c3aed', 'Arte, música y eventos culturales');

INSERT INTO tags (name, slug, color) VALUES
('Actualidad', 'actualidad', '#36b7ff'),
('Artículo de Opinión', 'articulo-opinion', '#ef4444'),
('Baseball', 'baseball', '#22c55e'),
('Criptomonedas', 'criptomonedas', '#8b5cf6'),
('Denuncia', 'denuncia', '#f97316'),
('Educación', 'educacion', '#f59e0b'),
('Elecciones', 'elecciones', '#f97316'),
('Inteligencia Artificial', 'ia', '#3b82f6'),
('Reportajes', 'reportajes', '#10b981'),
('República Dominicana', 'republica-dominicana', '#36b7ff'),
('Salud', 'salud', '#10b981'),
('Turismo', 'turismo', '#06b6d4');
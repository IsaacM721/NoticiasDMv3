# 🚀 Guía de Instalación NoticiasDM

## Opción 1: Hosting Compartido (Hostinger) - RECOMENDADO

### Paso 1: Preparar Supabase
1. Ve a [supabase.com](https://supabase.com) y crea un proyecto
2. Copia tu `Project URL` y `anon public key`
3. Ejecuta las migraciones SQL incluidas en `/supabase/migrations/`

### Paso 2: Configurar el archivo PHP
1. Abre `index.php`
2. En las líneas 6-7, reemplaza:
```php
define('SUPABASE_URL', 'https://tu-proyecto.supabase.co');
define('SUPABASE_ANON_KEY', 'tu_anon_key_aqui');
```

### Paso 3: Subir a Hostinger
1. Accede a tu panel de Hostinger
2. Ve a "Administrador de archivos"
3. Sube `index.php` a la carpeta `public_html`
4. ¡Tu sitio estará live en tu dominio!

---

## Opción 2: WordPress

### Paso 1: Subir archivos
1. Sube `/wp-content/plugins/noticiasdm-supabase/` a tu WordPress
2. Sube `/wp-content/themes/noticiasdm-theme/` a tu WordPress

### Paso 2: Activar
1. Ve a `Plugins` y activa "NoticiasDM Supabase Integration"
2. Ve a `Apariencia > Temas` y activa "NoticiasDM Theme"

### Paso 3: Configurar
1. Ve a `Ajustes > NoticiasDM Supabase`
2. Ingresa tu URL y API Key de Supabase
3. Haz clic en "Guardar cambios"

### Paso 4: Usar shortcodes
```php
[noticiasdm_articles]                    // Artículos básicos
[noticiasdm_articles limit="10"]         // 10 artículos
[noticiasdm_articles category="1"]       // Por categoría
[noticiasdm_articles layout="list"]      // Formato lista
```

---

## Opción 3: React/Vite (Desarrollo)

### Paso 1: Instalar dependencias
```bash
npm install
```

### Paso 2: Configurar variables
1. Crea un archivo `.env`
2. Agrega:
```
VITE_SUPABASE_URL=https://tu-proyecto.supabase.co
VITE_SUPABASE_ANON_KEY=tu_anon_key_aqui
```

### Paso 3: Ejecutar
```bash
npm run dev
```

---

## 🗄️ Estructura de Base de Datos

### Tablas principales:
- **articles**: Artículos del sitio
- **categories**: Categorías (Política, Deportes, etc.)
- **tags**: Etiquetas generales
- **subtags**: Subtemas específicos por categoría
- **writers**: Información de escritores
- **article_tags**: Relación N:M artículos-etiquetas
- **article_subtags**: Relación N:M artículos-subtemas

### Políticas RLS (Row Level Security):
- Lectura pública para contenido publicado
- Escritura solo para usuarios autenticados

---

## 🎨 Personalización

### Colores principales:
- Azul primario: `#36b7ff`
- Azul secundario: `#2da5e8`
- Texto: `#2d3748`

### Fuentes:
- Sistema: `-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif`

---

## 🔧 Solución de Problemas

### Error de conexión:
1. Verifica que tu URL de Supabase sea correcta
2. Confirma que tu API key sea válida
3. Revisa que las tablas existan en Supabase

### Artículos no aparecen:
1. Verifica que tengas artículos con `status = 'published'`
2. Confirma que las políticas RLS permitan lectura pública

### Problemas de diseño:
1. Limpia caché del navegador
2. Verifica que los archivos CSS se carguen correctamente

---

## 📞 Contacto

Para soporte técnico:
- Email: soporte@noticiasdm.com
- Documentación: [docs.noticiasdm.com]

¡Gracias por usar NoticiasDM! 🎉
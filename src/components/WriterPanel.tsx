import React, { useState } from 'react';
import { Save, X, Eye, EyeOff, Tag, Plus, Trash2 } from 'lucide-react';

interface WriterPanelProps {
  onArticleCreate: (article: any) => void;
  onCancel: () => void;
  darkMode: boolean;
  categories: any[];
  tags: any[];
  subtags: any[];
}

const WriterPanel: React.FC<WriterPanelProps> = ({ onArticleCreate, onCancel, darkMode, categories, tags: availableTags, subtags: availableSubtags }) => {
  const [title, setTitle] = useState('');
  const [content, setContent] = useState('');
  const [excerpt, setExcerpt] = useState('');
  const [author, setAuthor] = useState('');
  const [featuredImage, setFeaturedImage] = useState('');
  const [selectedCategory, setSelectedCategory] = useState<any>(null);
  const [selectedTags, setSelectedTags] = useState<any[]>([]);
  const [selectedSubtags, setSelectedSubtags] = useState<any[]>([]);
  const [seoTitle, setSeoTitle] = useState('');
  const [seoDescription, setSeoDescription] = useState('');
  const [isPreview, setIsPreview] = useState(false);
  const [newTagName, setNewTagName] = useState('');
  const [newSubtagName, setNewSubtagName] = useState('');

  // Filter subtags based on selected category
  const categorySubtags = selectedCategory 
    ? availableSubtags.filter(subtag => subtag.category_id === selectedCategory.id)
    : [];

  const handleTagToggle = (tag: any) => {
    setSelectedTags(prev =>
      prev.find(t => t.id === tag.id)
        ? prev.filter(t => t.id !== tag.id)
        : [...prev, tag]
    );
  };

  const handleSubtagToggle = (subtag: any) => {
    setSelectedSubtags(prev =>
      prev.find(s => s.id === subtag.id)
        ? prev.filter(s => s.id !== subtag.id)
        : [...prev, subtag]
    );
  };

  const handleAddNewTag = () => {
    if (newTagName.trim()) {
      const newTag: any = {
        id: Date.now().toString(),
        name: newTagName.trim(),
        slug: newTagName.toLowerCase().replace(/\s+/g, '-'),
        color: '#36b7ff'
      };
      setSelectedTags(prev => [...prev, newTag]);
      setNewTagName('');
    }
  };

  const handleAddNewSubtag = () => {
    if (newSubtagName.trim() && selectedCategory) {
      const newSubtag: any = {
        id: Date.now().toString(),
        name: newSubtagName.trim(),
        slug: newSubtagName.toLowerCase().replace(/\s+/g, '-'),
        color: selectedCategory.color,
        category_id: selectedCategory.id
      };
      setSelectedSubtags(prev => [...prev, newSubtag]);
      setNewSubtagName('');
    }
  };

  const handleCategoryChange = (category: any) => {
    setSelectedCategory(category);
    // Clear subtags when category changes
    setSelectedSubtags([]);
  };

  const handleSubmit = (status: 'draft' | 'published') => {
    if (!title || !content || !selectedCategory || !author) {
      alert('Por favor completa todos los campos obligatorios');
      return;
    }

    const newArticle: any = {
      id: Date.now().toString(),
      title,
      content,
      excerpt: excerpt || content.substring(0, 200) + '...',
      author,
      published_at: new Date().toISOString(),
      updated_at: new Date().toISOString(),
      featured_image: featuredImage || 'https://images.pexels.com/photos/518543/pexels-photo-518543.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
      tags: selectedTags,
      subtags: selectedSubtags,
      category: selectedCategory,
      status,
      slug: title.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, ''),
      seoTitle: seoTitle || title,
      seoDescription: seoDescription || excerpt,
      readTime: Math.ceil(content.split(' ').length / 200)
    };

    onArticleCreate(newArticle);
  };

  return (
    <div className="max-w-4xl mx-auto">
      <div className={`rounded-2xl shadow-lg overflow-hidden ${
        darkMode ? 'bg-gray-800' : 'bg-white'
      }`}>
        {/* Header */}
        <div className="bg-gradient-to-r from-[#36b7ff] to-[#2da5e8] px-8 py-6">
          <div className="flex items-center justify-between">
            <h1 className="text-2xl font-bold text-white">Crear Nuevo Artículo</h1>
            <div className="flex items-center space-x-4">
              <button
                onClick={() => setIsPreview(!isPreview)}
                className="flex items-center px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-colors duration-200"
              >
                {isPreview ? <EyeOff className="h-4 w-4 mr-2" /> : <Eye className="h-4 w-4 mr-2" />}
                {isPreview ? 'Editar' : 'Vista previa'}
              </button>
              <button
                onClick={onCancel}
                className="p-2 text-white hover:bg-white/20 rounded-lg transition-colors duration-200"
              >
                <X className="h-5 w-5" />
              </button>
            </div>
          </div>
        </div>

        <div className="p-8">
          {isPreview ? (
            /* Preview Mode */
            <div className="space-y-6">
              <div className="relative">
                <img
                  src={featuredImage || 'https://images.pexels.com/photos/518543/pexels-photo-518543.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'}
                  alt={title}
                  className="w-full h-64 object-cover rounded-xl"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl" />
                <div className="absolute bottom-4 left-4 right-4">
                  {selectedCategory && (
                    <span
                      className="inline-block px-3 py-1 rounded-full text-sm font-medium text-white mb-2"
                      style={{ backgroundColor: selectedCategory.color }}
                    >
                      {selectedCategory.name}
                    </span>
                  )}
                  <h1 className="text-2xl font-bold text-white">{title || 'Título del artículo'}</h1>
                </div>
              </div>
              
              <div className={`prose prose-lg max-w-none ${darkMode ? 'prose-invert' : ''}`}>
                <div dangerouslySetInnerHTML={{ __html: content || '<p>Contenido del artículo...</p>' }} />
              </div>
              
              {/* Tags and Subtags */}
              <div className="space-y-4">
                {selectedTags.length > 0 && (
                  <div>
                    <h4 className={`text-sm font-medium mb-2 ${darkMode ? 'text-gray-300' : 'text-gray-700'}`}>
                      Etiquetas
                    </h4>
                    <div className="flex flex-wrap gap-2">
                      {selectedTags.map((tag) => (
                        <span
                          key={tag.id}
                          className={`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${
                            darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-700'
                          }`}
                        >
                          <Tag className="h-3 w-3 mr-1" />
                          {tag.name}
                        </span>
                      ))}
                    </div>
                  </div>
                )}
                
                {selectedSubtags.length > 0 && (
                  <div>
                    <h4 className={`text-sm font-medium mb-2 ${darkMode ? 'text-gray-300' : 'text-gray-700'}`}>
                      Subtemas
                    </h4>
                    <div className="flex flex-wrap gap-2">
                      {selectedSubtags.map((subtag) => (
                        <span
                          key={subtag.id}
                          className="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                          style={{ backgroundColor: subtag.color }}
                        >
                          {subtag.name}
                        </span>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            </div>
          ) : (
            /* Edit Mode */
            <div className="space-y-6">
              {/* Basic Information */}
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label className={`block text-sm font-medium mb-2 ${
                    darkMode ? 'text-gray-300' : 'text-gray-700'
                  }`}>
                    Título *
                  </label>
                  <input
                    type="text"
                    value={title}
                    onChange={(e) => setTitle(e.target.value)}
                    className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                      darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-900'
                    }`}
                    placeholder="Título del artículo"
                  />
                </div>
                
                <div>
                  <label className={`block text-sm font-medium mb-2 ${
                    darkMode ? 'text-gray-300' : 'text-gray-700'
                  }`}>
                    Autor *
                  </label>
                  <input
                    type="text"
                    value={author}
                    onChange={(e) => setAuthor(e.target.value)}
                    className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                      darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-900'
                    }`}
                    placeholder="Nombre del autor"
                  />
                </div>
              </div>

              {/* Featured Image */}
              <div>
                <label className={`block text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Imagen destacada (URL)
                </label>
                <input
                  type="url"
                  value={featuredImage}
                  onChange={(e) => setFeaturedImage(e.target.value)}
                  className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                    darkMode 
                      ? 'bg-gray-700 border-gray-600 text-white' 
                      : 'bg-white border-gray-300 text-gray-900'
                  }`}
                  placeholder="https://ejemplo.com/imagen.jpg"
                />
              </div>

              {/* Category */}
              <div>
                <label className={`block text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Categoría *
                </label>
                <div className="flex flex-wrap gap-3">
                  {categories.map((category) => (
                    <button
                      key={category.id}
                      onClick={() => handleCategoryChange(category)}
                      className={`px-4 py-2 rounded-lg font-medium transition-all duration-200 ${
                        selectedCategory?.id === category.id
                          ? 'text-white'
                          : darkMode
                            ? 'bg-gray-700 text-gray-300 hover:bg-gray-600'
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                      }`}
                      style={{
                        backgroundColor: selectedCategory?.id === category.id ? category.color : undefined,
                      }}
                    >
                      {category.name}
                    </button>
                  ))}
                </div>
              </div>

              {/* Subtags - Only show if category is selected */}
              {selectedCategory && categorySubtags.length > 0 && (
                <div>
                  <label className={`block text-sm font-medium mb-2 ${
                    darkMode ? 'text-gray-300' : 'text-gray-700'
                  }`}>
                    Subtemas de {selectedCategory.name}
                  </label>
                  <div className="space-y-4">
                    <div className="flex flex-wrap gap-2">
                      {categorySubtags.map((subtag) => (
                        <button
                          key={subtag.id}
                          onClick={() => handleSubtagToggle(subtag)}
                          className={`px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 ${
                            selectedSubtags.find(s => s.id === subtag.id)
                              ? 'text-white'
                              : darkMode
                                ? 'bg-gray-700 text-gray-300 hover:bg-gray-600'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                          }`}
                          style={{
                            backgroundColor: selectedSubtags.find(s => s.id === subtag.id) ? subtag.color : undefined,
                          }}
                        >
                          {subtag.name}
                        </button>
                      ))}
                    </div>
                    
                    {/* Add new subtag */}
                    <div className="flex items-center space-x-2">
                      <input
                        type="text"
                        value={newSubtagName}
                        onChange={(e) => setNewSubtagName(e.target.value)}
                        placeholder={`Nuevo subtema para ${selectedCategory.name}`}
                        className={`px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                          darkMode 
                            ? 'bg-gray-700 border-gray-600 text-white' 
                            : 'bg-white border-gray-300 text-gray-900'
                        }`}
                        onKeyPress={(e) => e.key === 'Enter' && handleAddNewSubtag()}
                      />
                      <button
                        onClick={handleAddNewSubtag}
                        className="px-3 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8] transition-colors duration-200"
                      >
                        <Plus className="h-4 w-4" />
                      </button>
                    </div>
                  </div>
                </div>
              )}

              {/* Tags */}
              <div>
                <label className={`block text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Etiquetas Generales
                </label>
                <div className="space-y-4">
                  <div className="flex flex-wrap gap-2">
                    {availableTags.map((tag) => (
                      <button
                        key={tag.id}
                        onClick={() => handleTagToggle(tag)}
                        className={`px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 ${
                          selectedTags.find(t => t.id === tag.id)
                            ? 'bg-[#36b7ff] text-white'
                            : darkMode
                              ? 'bg-gray-700 text-gray-300 hover:bg-gray-600'
                              : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                        }`}
                      >
                        {tag.name}
                      </button>
                    ))}
                  </div>
                  
                  {/* Add new tag */}
                  <div className="flex items-center space-x-2">
                    <input
                      type="text"
                      value={newTagName}
                      onChange={(e) => setNewTagName(e.target.value)}
                      placeholder="Nueva etiqueta"
                      className={`px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                        darkMode 
                          ? 'bg-gray-700 border-gray-600 text-white' 
                          : 'bg-white border-gray-300 text-gray-900'
                      }`}
                      onKeyPress={(e) => e.key === 'Enter' && handleAddNewTag()}
                    />
                    <button
                      onClick={handleAddNewTag}
                      className="px-3 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8] transition-colors duration-200"
                    >
                      <Plus className="h-4 w-4" />
                    </button>
                  </div>
                  
                  {/* Selected tags */}
                  {selectedTags.length > 0 && (
                    <div className="flex flex-wrap gap-2">
                      {selectedTags.map((tag) => (
                        <span
                          key={tag.id}
                          className="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#36b7ff]/20 text-[#36b7ff]"
                        >
                          {tag.name}
                          <button
                            onClick={() => setSelectedTags(prev => prev.filter(t => t.id !== tag.id))}
                            className="ml-2 hover:text-[#2da5e8]"
                          >
                            <X className="h-3 w-3" />
                          </button>
                        </span>
                      ))}
                    </div>
                  )}
                </div>
              </div>

              {/* Selected subtags display */}
              {selectedSubtags.length > 0 && (
                <div>
                  <label className={`block text-sm font-medium mb-2 ${
                    darkMode ? 'text-gray-300' : 'text-gray-700'
                  }`}>
                    Subtemas Seleccionados
                  </label>
                  <div className="flex flex-wrap gap-2">
                    {selectedSubtags.map((subtag) => (
                      <span
                        key={subtag.id}
                        className="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white"
                        style={{ backgroundColor: subtag.color }}
                      >
                        {subtag.name}
                        <button
                          onClick={() => setSelectedSubtags(prev => prev.filter(s => s.id !== subtag.id))}
                          className="ml-2 hover:text-gray-200"
                        >
                          <X className="h-3 w-3" />
                        </button>
                      </span>
                    ))}
                  </div>
                </div>
              )}

              {/* Excerpt */}
              <div>
                <label className={`block text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Resumen
                </label>
                <textarea
                  value={excerpt}
                  onChange={(e) => setExcerpt(e.target.value)}
                  rows={3}
                  className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                    darkMode 
                      ? 'bg-gray-700 border-gray-600 text-white' 
                      : 'bg-white border-gray-300 text-gray-900'
                  }`}
                  placeholder="Breve descripción del artículo"
                />
              </div>

              {/* Content */}
              <div>
                <label className={`block text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Contenido *
                </label>
                <textarea
                  value={content}
                  onChange={(e) => setContent(e.target.value)}
                  rows={12}
                  className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                    darkMode 
                      ? 'bg-gray-700 border-gray-600 text-white' 
                      : 'bg-white border-gray-300 text-gray-900'
                  }`}
                  placeholder="Escribe el contenido del artículo aquí. Puedes usar HTML básico para formato."
                />
              </div>

              {/* SEO Section */}
              <div className={`border-t pt-6 ${darkMode ? 'border-gray-700' : 'border-gray-200'}`}>
                <h3 className={`text-lg font-semibold mb-4 ${darkMode ? 'text-white' : 'text-gray-900'}`}>
                  Optimización SEO
                </h3>
                <div className="space-y-4">
                  <div>
                    <label className={`block text-sm font-medium mb-2 ${
                      darkMode ? 'text-gray-300' : 'text-gray-700'
                    }`}>
                      Título SEO
                    </label>
                    <input
                      type="text"
                      value={seoTitle}
                      onChange={(e) => setSeoTitle(e.target.value)}
                      className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                        darkMode 
                          ? 'bg-gray-700 border-gray-600 text-white' 
                          : 'bg-white border-gray-300 text-gray-900'
                      }`}
                      placeholder="Título optimizado para motores de búsqueda"
                    />
                  </div>
                  
                  <div>
                    <label className={`block text-sm font-medium mb-2 ${
                      darkMode ? 'text-gray-300' : 'text-gray-700'
                    }`}>
                      Descripción SEO
                    </label>
                    <textarea
                      value={seoDescription}
                      onChange={(e) => setSeoDescription(e.target.value)}
                      rows={3}
                      className={`w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                        darkMode 
                          ? 'bg-gray-700 border-gray-600 text-white' 
                          : 'bg-white border-gray-300 text-gray-900'
                      }`}
                      placeholder="Descripción meta para motores de búsqueda"
                    />
                  </div>
                </div>
              </div>
            </div>
          )}

          {/* Action Buttons */}
          <div className={`flex items-center justify-between pt-8 border-t ${
            darkMode ? 'border-gray-700' : 'border-gray-200'
          }`}>
            <button
              onClick={onCancel}
              className={`px-6 py-3 border rounded-lg transition-colors duration-200 ${
                darkMode 
                  ? 'border-gray-600 text-gray-300 hover:bg-gray-700' 
                  : 'border-gray-300 text-gray-700 hover:bg-gray-50'
              }`}
            >
              Cancelar
            </button>
            
            <div className="flex items-center space-x-4">
              <button
                onClick={() => handleSubmit('draft')}
                className={`px-6 py-3 rounded-lg transition-colors duration-200 ${
                  darkMode 
                    ? 'bg-gray-700 text-white hover:bg-gray-600' 
                    : 'bg-gray-600 text-white hover:bg-gray-700'
                }`}
              >
                Guardar borrador
              </button>
              <button
                onClick={() => handleSubmit('published')}
                className="flex items-center px-6 py-3 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8] transition-colors duration-200"
              >
                <Save className="h-4 w-4 mr-2" />
                Publicar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default WriterPanel;
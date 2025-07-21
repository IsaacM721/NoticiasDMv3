import React, { useState } from 'react';
import { Clock, User, Tag, ArrowRight } from 'lucide-react';

interface NewsGridProps {
  articles: any[];
  onArticleSelect: (article: any) => void;
  darkMode: boolean;
  categories: any[];
  tags: any[];
}

const NewsGrid: React.FC<NewsGridProps> = ({ articles, onArticleSelect, darkMode, categories, tags }) => {
  const [selectedCategory, setSelectedCategory] = useState<string | null>(null);

  const filteredArticles = selectedCategory
    ? articles.filter(article => article.category_id === selectedCategory)
    : articles;

  const featuredArticle = filteredArticles[0];
  const regularArticles = filteredArticles.slice(1);

  return (
    <div className="space-y-8">
      {/* Tags Filter - Alphabetically sorted */}
      <section>
        <h2 className={`text-xl font-semibold mb-4 ${darkMode ? 'text-white' : 'text-gray-900'}`}>
          Etiquetas
        </h2>
        <div className="flex flex-wrap gap-3 mb-6">
          {tags.map((tag) => (
            <a
              key={tag.id}
              href={`#tag-${tag.slug}`}
              rel="tag"
              className={`px-4 py-2 rounded-full font-medium transition-all duration-200 border ${
                darkMode 
                  ? 'bg-gray-800 text-gray-300 border-gray-700 hover:bg-[#36b7ff] hover:text-white hover:border-[#36b7ff]' 
                  : 'bg-white text-gray-700 border-gray-200 hover:bg-[#36b7ff] hover:text-white hover:border-[#36b7ff]'
              }`}
            >
              {tag.name}
            </a>
          ))}
        </div>
      </section>

      {/* Category Filter */}
      <section>
        <h2 className={`text-xl font-semibold mb-4 ${darkMode ? 'text-white' : 'text-gray-900'}`}>
          Categorías
        </h2>
        <div className="flex flex-wrap gap-3">
          <button
            onClick={() => setSelectedCategory(null)}
            className={`px-4 py-2 rounded-full font-medium transition-all duration-200 ${
              !selectedCategory
                ? 'bg-[#36b7ff] text-white'
                : darkMode
                  ? 'bg-gray-800 text-gray-300 hover:bg-gray-700 border border-gray-700'
                  : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200'
            }`}
          >
            Todas
          </button>
          {categories.map((category) => (
            <button
              key={category.id}
              onClick={() => setSelectedCategory(category.id)}
              className={`px-4 py-2 rounded-full font-medium transition-all duration-200 ${
                selectedCategory === category.id
                  ? 'text-white'
                  : darkMode
                    ? 'bg-gray-800 text-gray-300 hover:bg-gray-700 border border-gray-700'
                    : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200'
              }`}
              style={{
                backgroundColor: selectedCategory === category.id ? category.color : undefined,
              }}
            >
              {category.name}
            </button>
          ))}
        </div>
      </section>

      {/* Featured Article */}
      {featuredArticle && (
        <article className={`rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ${
          darkMode ? 'bg-gray-800' : 'bg-white'
        }`}>
          <div className="md:flex">
            <div className="md:w-1/2">
              <img
                src={featuredArticle.featuredImage}
                alt={featuredArticle.title}
                className="w-full h-64 md:h-full object-cover"
              />
            </div>
            <div className="md:w-1/2 p-8">
              <div className="flex items-center space-x-3 mb-4">
                <span
                  className="px-3 py-1 rounded-full text-sm font-medium text-white"
                  style={{ backgroundColor: featuredArticle.category?.color || '#36b7ff' }}
                >
                  {featuredArticle.category?.name || 'Sin categoría'}
                </span>
                <div className={`flex items-center text-sm ${darkMode ? 'text-gray-400' : 'text-gray-500'}`}>
                  <Clock className="h-4 w-4 mr-1" />
                  {featuredArticle.readTime} min
                </div>
              </div>
              
              <h2 className={`text-2xl md:text-3xl font-bold mb-4 leading-tight ${
                darkMode ? 'text-white' : 'text-gray-900'
              }`}>
                {featuredArticle.title}
              </h2>
              
              <p className={`mb-6 text-lg leading-relaxed ${darkMode ? 'text-gray-300' : 'text-gray-600'}`}>
                {featuredArticle.excerpt}
              </p>
              
              <div className="flex items-center justify-between">
                <div className={`flex items-center text-sm ${darkMode ? 'text-gray-400' : 'text-gray-500'}`}>
                  <User className="h-4 w-4 mr-2" />
                  {featuredArticle.writer?.name || 'Autor desconocido'}
                  <span className="mx-2">•</span>
                  {new Date(featuredArticle.published_at || featuredArticle.created_at).toLocaleDateString('es-ES')}
                </div>
                
                <button
                  onClick={() => onArticleSelect(featuredArticle)}
                  className="flex items-center text-[#36b7ff] hover:text-[#2da5e8] font-medium transition-colors duration-200"
                >
                  Leer más
                  <ArrowRight className="h-4 w-4 ml-1" />
                </button>
              </div>
            </div>
          </div>
        </article>
      )}

      {/* Regular Articles Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {regularArticles.map((article) => (
          <article
            key={article.id}
            className={`rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer group ${
              darkMode ? 'bg-gray-800' : 'bg-white'
            }`}
            onClick={() => onArticleSelect(article)}
          >
            <div className="relative overflow-hidden">
              <img
                src={article.featured_image || 'https://images.pexels.com/photos/518543/pexels-photo-518543.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'}
                alt={article.title}
                className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
              />
              <div className="absolute top-4 left-4">
                <span
                  className="px-3 py-1 rounded-full text-sm font-medium text-white"
                  style={{ backgroundColor: article.category?.color || '#36b7ff' }}
                >
                  {article.category?.name || 'Sin categoría'}
                </span>
              </div>
            </div>
            
            <div className="p-6">
              <h3 className={`text-xl font-bold mb-3 line-clamp-2 group-hover:text-[#36b7ff] transition-colors duration-200 ${
                darkMode ? 'text-white' : 'text-gray-900'
              }`}>
                {article.title}
              </h3>
              
              <p className={`mb-4 line-clamp-3 ${darkMode ? 'text-gray-300' : 'text-gray-600'}`}>
                {article.excerpt}
              </p>
              
              <div className="flex flex-wrap gap-2 mb-4">
                {(article.tags || []).slice(0, 2).map((tag: any) => (
                  <span
                    key={tag.id}
                    className={`inline-flex items-center px-2 py-1 rounded-md text-xs font-medium ${
                      darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-700'
                    }`}
                  >
                    <Tag className="h-3 w-3 mr-1" />
                    {tag.name}
                  </span>
                ))}
              </div>
              
              <div className={`flex items-center justify-between text-sm ${
                darkMode ? 'text-gray-400' : 'text-gray-500'
              }`}>
                <div className="flex items-center">
                  <User className="h-4 w-4 mr-1" />
                  {article.writer?.name || 'Autor desconocido'}
                </div>
                <div className="flex items-center">
                  <Clock className="h-4 w-4 mr-1" />
                  {article.read_time} min
                </div>
              </div>
            </div>
          </article>
        ))}
      </div>

      {filteredArticles.length === 0 && (
        <div className="text-center py-12">
          <p className={`text-lg ${darkMode ? 'text-gray-400' : 'text-gray-500'}`}>
            No hay artículos en esta categoría.
          </p>
        </div>
      )}
    </div>
  );
};

export default NewsGrid;
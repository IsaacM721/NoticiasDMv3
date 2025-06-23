import React from 'react';
import { ArrowLeft, Clock, User, Tag, Share2, Facebook, Twitter, Linkedin } from 'lucide-react';
import { Article } from '../types';

interface ArticleViewProps {
  article: Article;
  onBack: () => void;
  relatedArticles: Article[];
  darkMode: boolean;
}

const ArticleView: React.FC<ArticleViewProps> = ({ article, onBack, relatedArticles, darkMode }) => {
  const shareUrl = `${window.location.origin}/article/${article.slug}`;

  const handleShare = (platform: string) => {
    const text = `${article.title} - ${article.excerpt}`;
    let url = '';

    switch (platform) {
      case 'facebook':
        url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
        break;
      case 'twitter':
        url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(shareUrl)}`;
        break;
      case 'linkedin':
        url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareUrl)}`;
        break;
    }

    if (url) {
      window.open(url, '_blank', 'width=600,height=400');
    }
  };

  return (
    <div className="max-w-4xl mx-auto">
      {/* Back Button */}
      <button
        onClick={onBack}
        className={`flex items-center mb-8 transition-colors duration-200 ${
          darkMode 
            ? 'text-gray-400 hover:text-[#36b7ff]' 
            : 'text-gray-600 hover:text-[#36b7ff]'
        }`}
      >
        <ArrowLeft className="h-5 w-5 mr-2" />
        Volver a noticias
      </button>

      {/* Article Header */}
      <article className={`rounded-2xl shadow-lg overflow-hidden ${
        darkMode ? 'bg-gray-800' : 'bg-white'
      }`}>
        <div className="relative">
          <img
            src={article.featuredImage}
            alt={article.title}
            className="w-full h-64 md:h-96 object-cover"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent" />
          <div className="absolute bottom-6 left-6 right-6">
            <span
              className="inline-block px-4 py-2 rounded-full text-sm font-medium text-white mb-4"
              style={{ backgroundColor: article.category.color }}
            >
              {article.category.name}
            </span>
            <h1 className="text-3xl md:text-4xl font-bold text-white leading-tight">
              {article.title}
            </h1>
          </div>
        </div>

        <div className="p-8">
          {/* Article Meta */}
          <div className={`flex flex-wrap items-center justify-between mb-8 pb-6 border-b ${
            darkMode ? 'border-gray-700' : 'border-gray-200'
          }`}>
            <div className={`flex items-center space-x-6 ${
              darkMode ? 'text-gray-400' : 'text-gray-600'
            }`}>
              <div className="flex items-center">
                <User className="h-5 w-5 mr-2" />
                <span className="font-medium">{article.author}</span>
              </div>
              <div className="flex items-center">
                <Clock className="h-5 w-5 mr-2" />
                <span>{article.readTime} min de lectura</span>
              </div>
              <span>{article.publishedAt.toLocaleDateString('es-ES', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
              })}</span>
            </div>

            {/* Share Buttons */}
            <div className="flex items-center space-x-3">
              <span className={`text-sm mr-2 ${darkMode ? 'text-gray-400' : 'text-gray-600'}`}>
                Compartir:
              </span>
              <button
                onClick={() => handleShare('facebook')}
                className="p-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200"
              >
                <Facebook className="h-4 w-4" />
              </button>
              <button
                onClick={() => handleShare('twitter')}
                className="p-2 rounded-full bg-sky-500 text-white hover:bg-sky-600 transition-colors duration-200"
              >
                <Twitter className="h-4 w-4" />
              </button>
              <button
                onClick={() => handleShare('linkedin')}
                className="p-2 rounded-full bg-blue-700 text-white hover:bg-blue-800 transition-colors duration-200"
              >
                <Linkedin className="h-4 w-4" />
              </button>
            </div>
          </div>

          {/* Article Content */}
          <div 
            className={`prose prose-lg max-w-none mb-8 ${darkMode ? 'prose-invert' : ''}`}
            dangerouslySetInnerHTML={{ __html: article.content }}
          />

          {/* Tags and Subtags */}
          <div className="space-y-4 mb-8">
            {/* General Tags */}
            {article.tags.length > 0 && (
              <div>
                <h4 className={`text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Etiquetas
                </h4>
                <div className="flex flex-wrap gap-3">
                  {article.tags.map((tag) => (
                    <span
                      key={tag.id}
                      className={`inline-flex items-center px-4 py-2 rounded-full text-sm font-medium ${
                        darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-700'
                      }`}
                      style={{ 
                        backgroundColor: darkMode ? undefined : `${tag.color}20`,
                        color: darkMode ? undefined : tag.color 
                      }}
                    >
                      <Tag className="h-4 w-4 mr-2" />
                      {tag.name}
                    </span>
                  ))}
                </div>
              </div>
            )}

            {/* Subtags */}
            {article.subtags && article.subtags.length > 0 && (
              <div>
                <h4 className={`text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Subtemas
                </h4>
                <div className="flex flex-wrap gap-3">
                  {article.subtags.map((subtag) => (
                    <span
                      key={subtag.id}
                      className="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium text-white"
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
      </article>

      {/* Related Articles */}
      {relatedArticles.length > 0 && (
        <div className="mt-12">
          <h2 className={`text-2xl font-bold mb-6 ${
            darkMode ? 'text-white' : 'text-gray-900'
          }`}>
            Artículos relacionados
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {relatedArticles.map((relatedArticle) => (
              <div
                key={relatedArticle.id}
                className={`rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer ${
                  darkMode ? 'bg-gray-800' : 'bg-white'
                }`}
                onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}
              >
                <img
                  src={relatedArticle.featuredImage}
                  alt={relatedArticle.title}
                  className="w-full h-32 object-cover"
                />
                <div className="p-4">
                  <h3 className={`font-bold mb-2 line-clamp-2 ${
                    darkMode ? 'text-white' : 'text-gray-900'
                  }`}>
                    {relatedArticle.title}
                  </h3>
                  <p className={`text-sm line-clamp-2 ${
                    darkMode ? 'text-gray-300' : 'text-gray-600'
                  }`}>
                    {relatedArticle.excerpt}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
};

export default ArticleView;
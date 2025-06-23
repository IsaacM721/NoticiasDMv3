import React from 'react';
import { ArrowLeft, Calendar, FileText, CheckCircle, Twitter, Linkedin, Instagram, Globe, Mail } from 'lucide-react';
import { Writer, Article } from '../types';

interface WriterProfileProps {
  writer: Writer;
  articles: Article[];
  onBack: () => void;
  onArticleSelect: (article: Article) => void;
  darkMode: boolean;
}

const WriterProfile: React.FC<WriterProfileProps> = ({ writer, articles, onBack, onArticleSelect, darkMode }) => {
  const writerArticles = articles.filter(article => article.author === writer.name);

  return (
    <div className="max-w-6xl mx-auto">
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
        Volver
      </button>

      {/* Writer Header */}
      <div className={`rounded-2xl shadow-lg overflow-hidden mb-8 ${
        darkMode ? 'bg-gray-800' : 'bg-white'
      }`}>
        <div className="bg-gradient-to-r from-[#36b7ff] to-[#2da5e8] px-8 py-12">
          <div className="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
            <div className="relative">
              <img
                src={writer.avatar}
                alt={writer.name}
                className="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover"
              />
              {writer.verified && (
                <div className="absolute -bottom-2 -right-2 bg-green-500 rounded-full p-2">
                  <CheckCircle className="h-6 w-6 text-white" />
                </div>
              )}
            </div>
            
            <div className="flex-1 text-center md:text-left">
              <h1 className="text-3xl md:text-4xl font-bold text-white mb-2">
                {writer.name}
              </h1>
              <p className="text-blue-100 text-lg mb-4">
                {writer.bio}
              </p>
              
              {/* Stats */}
              <div className="flex flex-wrap justify-center md:justify-start gap-6 text-white">
                <div className="flex items-center">
                  <FileText className="h-5 w-5 mr-2" />
                  <span className="font-medium">{writer.articlesCount} artículos</span>
                </div>
                <div className="flex items-center">
                  <Calendar className="h-5 w-5 mr-2" />
                  <span className="font-medium">
                    Desde {writer.joinedAt.toLocaleDateString('es-ES', { 
                      year: 'numeric', 
                      month: 'long' 
                    })}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="p-8">
          {/* Specialties */}
          <div className="mb-8">
            <h3 className={`text-lg font-semibold mb-4 ${
              darkMode ? 'text-white' : 'text-gray-900'
            }`}>
              Especialidades
            </h3>
            <div className="flex flex-wrap gap-3">
              {writer.specialties.map((specialty, index) => (
                <span
                  key={index}
                  className="px-4 py-2 bg-[#36b7ff]/20 text-[#36b7ff] rounded-full text-sm font-medium"
                >
                  {specialty}
                </span>
              ))}
            </div>
          </div>

          {/* Social Links */}
          <div className="mb-8">
            <h3 className={`text-lg font-semibold mb-4 ${
              darkMode ? 'text-white' : 'text-gray-900'
            }`}>
              Contacto y Redes
            </h3>
            <div className="flex flex-wrap gap-4">
              <a
                href={`mailto:${writer.email}`}
                className={`flex items-center px-4 py-2 rounded-lg transition-colors duration-200 ${
                  darkMode 
                    ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' 
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                }`}
              >
                <Mail className="h-4 w-4 mr-2" />
                Email
              </a>
              
              {writer.socialLinks.twitter && (
                <a
                  href={writer.socialLinks.twitter}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-lg hover:bg-sky-200 transition-colors duration-200"
                >
                  <Twitter className="h-4 w-4 mr-2" />
                  Twitter
                </a>
              )}
              
              {writer.socialLinks.linkedin && (
                <a
                  href={writer.socialLinks.linkedin}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200"
                >
                  <Linkedin className="h-4 w-4 mr-2" />
                  LinkedIn
                </a>
              )}
              
              {writer.socialLinks.instagram && (
                <a
                  href={writer.socialLinks.instagram}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex items-center px-4 py-2 bg-pink-100 text-pink-700 rounded-lg hover:bg-pink-200 transition-colors duration-200"
                >
                  <Instagram className="h-4 w-4 mr-2" />
                  Instagram
                </a>
              )}
              
              {writer.socialLinks.website && (
                <a
                  href={writer.socialLinks.website}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200"
                >
                  <Globe className="h-4 w-4 mr-2" />
                  Sitio Web
                </a>
              )}
            </div>
          </div>
        </div>
      </div>

      {/* Writer's Articles */}
      <div>
        <h2 className={`text-2xl font-bold mb-6 ${
          darkMode ? 'text-white' : 'text-gray-900'
        }`}>
          Artículos de {writer.name} ({writerArticles.length})
        </h2>
        
        {writerArticles.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {writerArticles.map((article) => (
              <article
                key={article.id}
                className={`rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer group ${
                  darkMode ? 'bg-gray-800' : 'bg-white'
                }`}
                onClick={() => onArticleSelect(article)}
              >
                <div className="relative overflow-hidden">
                  <img
                    src={article.featuredImage}
                    alt={article.title}
                    className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                  />
                  <div className="absolute top-4 left-4">
                    <span
                      className="px-3 py-1 rounded-full text-sm font-medium text-white"
                      style={{ backgroundColor: article.category.color }}
                    >
                      {article.category.name}
                    </span>
                  </div>
                </div>
                
                <div className="p-6">
                  <h3 className={`text-xl font-bold mb-3 line-clamp-2 group-hover:text-[#36b7ff] transition-colors duration-200 ${
                    darkMode ? 'text-white' : 'text-gray-900'
                  }`}>
                    {article.title}
                  </h3>
                  
                  <p className={`mb-4 line-clamp-3 ${
                    darkMode ? 'text-gray-300' : 'text-gray-600'
                  }`}>
                    {article.excerpt}
                  </p>
                  
                  <div className={`flex items-center justify-between text-sm ${
                    darkMode ? 'text-gray-400' : 'text-gray-500'
                  }`}>
                    <span>{article.publishedAt.toLocaleDateString('es-ES')}</span>
                    <span>{article.readTime} min de lectura</span>
                  </div>
                </div>
              </article>
            ))}
          </div>
        ) : (
          <div className="text-center py-12">
            <FileText className={`h-16 w-16 mx-auto mb-4 ${
              darkMode ? 'text-gray-600' : 'text-gray-300'
            }`} />
            <p className={`text-lg ${
              darkMode ? 'text-gray-400' : 'text-gray-500'
            }`}>
              Este escritor aún no ha publicado artículos.
            </p>
          </div>
        )}
      </div>
    </div>
  );
};

export default WriterProfile;
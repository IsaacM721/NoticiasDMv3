import React from 'react';
import { ArrowLeft, CheckCircle, FileText, Calendar, Users } from 'lucide-react';
import { Writer } from '../types';

interface WritersDirectoryProps {
  writers: Writer[];
  onBack: () => void;
  onWriterSelect: (writer: Writer) => void;
  darkMode: boolean;
}

const WritersDirectory: React.FC<WritersDirectoryProps> = ({ writers, onBack, onWriterSelect, darkMode }) => {
  const totalArticles = writers.reduce((sum, writer) => sum + writer.articlesCount, 0);
  const verifiedWriters = writers.filter(writer => writer.verified).length;

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

      {/* Header */}
      <div className={`rounded-2xl shadow-lg overflow-hidden mb-8 ${
        darkMode ? 'bg-gray-800' : 'bg-white'
      }`}>
        <div className="bg-gradient-to-r from-[#36b7ff] to-[#2da5e8] px-8 py-12">
          <h1 className="text-3xl md:text-4xl font-bold text-white mb-4">
            Nuestros Escritores
          </h1>
          <p className="text-blue-100 text-lg mb-6">
            Conoce al talentoso equipo de periodistas y escritores de NoticiasDM
          </p>
          
          {/* Stats */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div className="bg-white/10 rounded-lg p-4">
              <div className="flex items-center text-white">
                <Users className="h-6 w-6 mr-3" />
                <div>
                  <div className="text-2xl font-bold">{writers.length}</div>
                  <div className="text-blue-100">Escritores</div>
                </div>
              </div>
            </div>
            
            <div className="bg-white/10 rounded-lg p-4">
              <div className="flex items-center text-white">
                <CheckCircle className="h-6 w-6 mr-3" />
                <div>
                  <div className="text-2xl font-bold">{verifiedWriters}</div>
                  <div className="text-blue-100">Verificados</div>
                </div>
              </div>
            </div>
            
            <div className="bg-white/10 rounded-lg p-4">
              <div className="flex items-center text-white">
                <FileText className="h-6 w-6 mr-3" />
                <div>
                  <div className="text-2xl font-bold">{totalArticles}</div>
                  <div className="text-blue-100">Artículos</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Writers Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {writers.map((writer) => (
          <div
            key={writer.id}
            className={`rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer group ${
              darkMode ? 'bg-gray-800' : 'bg-white'
            }`}
            onClick={() => onWriterSelect(writer)}
          >
            <div className="p-6">
              <div className="flex items-center mb-4">
                <div className="relative">
                  <img
                    src={writer.avatar}
                    alt={writer.name}
                    className="w-16 h-16 rounded-full object-cover"
                  />
                  {writer.verified && (
                    <div className="absolute -bottom-1 -right-1 bg-green-500 rounded-full p-1">
                      <CheckCircle className="h-4 w-4 text-white" />
                    </div>
                  )}
                </div>
                <div className="ml-4 flex-1">
                  <h3 className={`text-xl font-bold group-hover:text-[#36b7ff] transition-colors duration-200 ${
                    darkMode ? 'text-white' : 'text-gray-900'
                  }`}>
                    {writer.name}
                  </h3>
                  <div className={`flex items-center text-sm ${
                    darkMode ? 'text-gray-400' : 'text-gray-500'
                  }`}>
                    <FileText className="h-4 w-4 mr-1" />
                    {writer.articlesCount} artículos
                  </div>
                </div>
              </div>
              
              <p className={`mb-4 line-clamp-3 ${
                darkMode ? 'text-gray-300' : 'text-gray-600'
              }`}>
                {writer.bio}
              </p>
              
              {/* Specialties */}
              <div className="mb-4">
                <div className="flex flex-wrap gap-2">
                  {writer.specialties.slice(0, 2).map((specialty, index) => (
                    <span
                      key={index}
                      className="px-3 py-1 bg-[#36b7ff]/20 text-[#36b7ff] rounded-full text-xs font-medium"
                    >
                      {specialty}
                    </span>
                  ))}
                  {writer.specialties.length > 2 && (
                    <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                      darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-600'
                    }`}>
                      +{writer.specialties.length - 2} más
                    </span>
                  )}
                </div>
              </div>
              
              {/* Join Date */}
              <div className={`flex items-center text-sm ${
                darkMode ? 'text-gray-400' : 'text-gray-500'
              }`}>
                <Calendar className="h-4 w-4 mr-2" />
                Desde {writer.joinedAt.toLocaleDateString('es-ES', { 
                  year: 'numeric', 
                  month: 'long' 
                })}
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default WritersDirectory;
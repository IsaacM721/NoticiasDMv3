import React, { useState } from 'react';
import { Facebook, Twitter, Instagram, Youtube, Mail, Phone, MapPin, PenTool, Lock } from 'lucide-react';

interface FooterProps {
  darkMode: boolean;
}

const Footer: React.FC<FooterProps> = ({ darkMode }) => {
  const [showPasswordModal, setShowPasswordModal] = useState(false);
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const currentYear = new Date().getFullYear();

  const handleWriteAccess = () => {
    if (password === 'noticiasdm2025') {
      // In a real app, you'd navigate to /write
      window.location.href = '/write';
    } else {
      setError('Contraseña incorrecta');
      setTimeout(() => setError(''), 3000);
    }
  };

  const handlePasswordSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    handleWriteAccess();
  };

  return (
    <>
      <footer className="bg-[#01111d] text-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {/* Brand Section */}
            <div className="space-y-4">
              <h3 className="text-2xl font-bold text-[#36b7ff]">NoticiasDM</h3>
              <p className="text-gray-300 leading-relaxed">
                Tu fuente confiable de noticias de República Dominicana. 
                Información veraz, oportuna y de calidad.
              </p>
              <div className="flex space-x-4">
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] transition-colors duration-200">
                  <Facebook className="h-5 w-5" />
                </a>
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] transition-colors duration-200">
                  <Twitter className="h-5 w-5" />
                </a>
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] transition-colors duration-200">
                  <Instagram className="h-5 w-5" />
                </a>
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] transition-colors duration-200">
                  <Youtube className="h-5 w-5" />
                </a>
              </div>
            </div>

            {/* Quick Links */}
            <div className="space-y-4">
              <h4 className="text-lg font-semibold">Enlaces rápidos</h4>
              <ul className="space-y-2">
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Inicio</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Política</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Deportes</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Tecnología</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Economía</a></li>
              </ul>
            </div>

            {/* Categories */}
            <div className="space-y-4">
              <h4 className="text-lg font-semibold">Categorías</h4>
              <ul className="space-y-2">
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Noticias Nacionales</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Internacionales</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Cultura</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Entretenimiento</a></li>
                <li><a href="#" className="text-gray-300 hover:text-[#36b7ff] transition-colors duration-200">Opinión</a></li>
              </ul>
            </div>

            {/* Contact Info */}
            <div className="space-y-4">
              <h4 className="text-lg font-semibold">Contacto</h4>
              <div className="space-y-3">
                <div className="flex items-center space-x-3">
                  <Mail className="h-4 w-4 text-[#36b7ff]" />
                  <span className="text-gray-300">info@noticiasdm.com</span>
                </div>
                <div className="flex items-center space-x-3">
                  <Phone className="h-4 w-4 text-[#36b7ff]" />
                  <span className="text-gray-300">+1 (809) 123-4567</span>
                </div>
                <div className="flex items-center space-x-3">
                  <MapPin className="h-4 w-4 text-[#36b7ff]" />
                  <span className="text-gray-300">Santo Domingo, RD</span>
                </div>
              </div>
              
              {/* Writer Access Button */}
              <div className="pt-4">
                <button
                  onClick={() => setShowPasswordModal(true)}
                  className="flex items-center space-x-2 px-4 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8] transition-colors duration-200 font-medium"
                >
                  <PenTool className="h-4 w-4" />
                  <span>Redactar Noticia</span>
                </button>
              </div>
            </div>
          </div>

          {/* Bottom Section */}
          <div className="border-t border-gray-800 mt-8 pt-8">
            <div className="flex flex-col md:flex-row justify-between items-center">
              <p className="text-gray-400 text-sm">
                © {currentYear} NoticiasDM. Todos los derechos reservados.
              </p>
              <div className="flex space-x-6 mt-4 md:mt-0">
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] text-sm transition-colors duration-200">
                  Política de Privacidad
                </a>
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] text-sm transition-colors duration-200">
                  Términos de Uso
                </a>
                <a href="#" className="text-gray-400 hover:text-[#36b7ff] text-sm transition-colors duration-200">
                  Contacto
                </a>
              </div>
            </div>
          </div>
        </div>
      </footer>

      {/* Password Modal */}
      {showPasswordModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
          <div className={`rounded-lg p-6 w-full max-w-md ${
            darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-900'
          }`}>
            <div className="flex items-center justify-between mb-4">
              <h3 className="text-lg font-semibold flex items-center">
                <Lock className="h-5 w-5 mr-2 text-[#36b7ff]" />
                Acceso de Escritor
              </h3>
              <button
                onClick={() => {
                  setShowPasswordModal(false);
                  setPassword('');
                  setError('');
                }}
                className={`text-gray-500 hover:text-gray-700 ${darkMode ? 'hover:text-gray-300' : ''}`}
              >
                ×
              </button>
            </div>
            
            <form onSubmit={handlePasswordSubmit} className="space-y-4">
              <div>
                <label className={`block text-sm font-medium mb-2 ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}>
                  Contraseña de Escritor
                </label>
                <input
                  type="password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className={`w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#36b7ff] focus:border-transparent ${
                    darkMode 
                      ? 'bg-gray-700 border-gray-600 text-white' 
                      : 'bg-white border-gray-300 text-gray-900'
                  }`}
                  placeholder="Ingresa la contraseña"
                  required
                />
              </div>
              
              {error && (
                <p className="text-red-500 text-sm">{error}</p>
              )}
              
              <div className="flex space-x-3">
                <button
                  type="button"
                  onClick={() => {
                    setShowPasswordModal(false);
                    setPassword('');
                    setError('');
                  }}
                  className={`flex-1 px-4 py-2 border rounded-lg transition-colors duration-200 ${
                    darkMode 
                      ? 'border-gray-600 text-gray-300 hover:bg-gray-700' 
                      : 'border-gray-300 text-gray-700 hover:bg-gray-50'
                  }`}
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  className="flex-1 px-4 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8] transition-colors duration-200"
                >
                  Acceder
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </>
  );
};

export default Footer;
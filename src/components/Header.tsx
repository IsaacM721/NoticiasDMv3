import React, { useState } from 'react';

interface HeaderProps {
  onWriterModeToggle: () => void;
  onWritersDirectoryToggle: () => void;
  isWriterMode: boolean;
  darkMode: boolean;
  onDarkModeToggle: () => void;
  tags: any[];
  subtags: any[];
}

const Header: React.FC<HeaderProps> = ({ 
  onWriterModeToggle, 
  onWritersDirectoryToggle, 
  isWriterMode,
  darkMode,
  onDarkModeToggle,
  tags,
  subtags
}) => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');

  // Group subtags by category for better organization
  const groupedSubtags = subtags.reduce((acc: any, subtag: any) => {
    if (!acc[subtag.category_id]) {
      acc[subtag.category_id] = [];
    }
    acc[subtag.category_id].push(subtag);
    return acc;
  }, {});

  const categoryNames = {
    '1': 'Política',
    '2': 'Deportes', 
    '3': 'Tecnología',
    '4': 'Economía',
    '5': 'Cultura'
  };

  return (
    <header className={`shadow-lg sticky top-0 z-50 transition-colors duration-300 ${
      darkMode ? 'bg-gray-900 text-white' : 'bg-white text-gray-900'
    }`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center py-4">
          {/* Logo */}
          <div className="flex items-center">
            <h1 className="text-2xl md:text-3xl font-bold text-[#36b7ff]">
              NoticiasDM
            </h1>
          </div>

          {/* Desktop Navigation - Hidden, using hamburger for all */}
          <nav className="hidden">
            {/* Navigation items removed - using hamburger menu for all */}
          </nav>

          {/* Search and Actions */}
          <div className="flex items-center space-x-4">
            {/* Search Bar */}
            <div className={`hidden md:flex items-center rounded-full px-4 py-2 transition-colors duration-300 ${
              darkMode ? 'bg-gray-800' : 'bg-gray-100'
            }`}>
              <Search className={`h-4 w-4 mr-2 ${darkMode ? 'text-gray-400' : 'text-gray-500'}`} />
              <input
                type="text"
                placeholder="Buscar noticias..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className={`bg-transparent outline-none text-sm w-48 ${
                  darkMode ? 'text-white placeholder-gray-400' : 'text-gray-900 placeholder-gray-500'
                }`}
              />
            </div>

            {/* Dark Mode Toggle */}
            <button
              onClick={onDarkModeToggle}
              className={`p-2 rounded-full transition-all duration-200 ${
                darkMode 
                  ? 'bg-gray-800 text-yellow-400 hover:bg-gray-700' 
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              {darkMode ? <Sun className="h-4 w-4" /> : <Moon className="h-4 w-4" />}
            </button>

            {/* Writers Directory Button */}
            <button
              onClick={onWritersDirectoryToggle}
              className={`flex items-center px-4 py-2 rounded-full font-medium transition-all duration-200 ${
                darkMode 
                  ? 'bg-gray-800 text-gray-300 hover:bg-gray-700' 
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              <Users className="h-4 w-4 mr-2" />
              <span className="hidden sm:inline">Escritores</span>
            </button>

            {/* Writer Mode Toggle */}
            <button
              onClick={onWriterModeToggle}
              className={`flex items-center px-4 py-2 rounded-full font-medium transition-all duration-200 ${
                isWriterMode
                  ? 'bg-[#36b7ff] text-white hover:bg-[#2da5e8]'
                  : darkMode
                    ? 'bg-gray-800 text-gray-300 hover:bg-gray-700'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              {isWriterMode ? <User className="h-4 w-4 mr-2" /> : <PenTool className="h-4 w-4 mr-2" />}
              {isWriterMode ? 'Lector' : 'Escritor'}
            </button>

            {/* Hamburger Menu Toggle - Always visible */}
            <button
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              className={`p-2 rounded-md transition-colors duration-200 ${
                darkMode ? 'text-gray-300 hover:text-[#36b7ff]' : 'text-gray-700 hover:text-[#36b7ff]'
              }`}
            >
              {isMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            </button>
          </div>
        </div>

        {/* Mobile Search Bar */}
        <div className="md:hidden pb-4">
          <div className={`flex items-center rounded-full px-4 py-2 transition-colors duration-300 ${
            darkMode ? 'bg-gray-800' : 'bg-gray-100'
          }`}>
            <Search className={`h-4 w-4 mr-2 ${darkMode ? 'text-gray-400' : 'text-gray-500'}`} />
            <input
              type="text"
              placeholder="Buscar noticias..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className={`bg-transparent outline-none text-sm flex-1 ${
                darkMode ? 'text-white placeholder-gray-400' : 'text-gray-900 placeholder-gray-500'
              }`}
            />
          </div>
        </div>

        {/* Hamburger Navigation Menu */}
        {isMenuOpen && (
          <div className={`border-t py-4 transition-colors duration-300 ${
            darkMode ? 'border-gray-700' : 'border-gray-200'
          }`}>
            <nav className="space-y-6">
              {/* Tags Section */}
              <section>
                <h3 className={`text-lg font-semibold mb-3 ${darkMode ? 'text-white' : 'text-gray-900'}`}>
                  Etiquetas
                </h3>
                <div className="flex flex-wrap gap-2">
                  {tags.map((tag) => (
                    <a
                      key={tag.id}
                      href={`#tag-${tag.slug}`}
                      rel="tag"
                      className={`px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 ${
                        darkMode 
                          ? 'bg-gray-800 text-gray-300 hover:bg-[#36b7ff] hover:text-white' 
                          : 'bg-gray-100 text-gray-700 hover:bg-[#36b7ff] hover:text-white'
                      }`}
                      onClick={() => setIsMenuOpen(false)}
                    >
                      {tag.name}
                    </a>
                  ))}
                </div>
              </section>

              {/* Subtags by Category */}
              {Object.entries(groupedSubtags).map(([categoryId, categorySubtags]) => (
                <section key={categoryId}>
                  <h3 className={`text-lg font-semibold mb-3 ${darkMode ? 'text-white' : 'text-gray-900'}`}>
                    {categoryNames[categoryId as keyof typeof categoryNames] || 'Otros'}
                  </h3>
                  <div className="flex flex-wrap gap-2">
                    {(categorySubtags as any[]).sort((a, b) => a.name.localeCompare(b.name)).map((subtag) => (
                      <a
                        key={subtag.id}
                        href={`#subtag-${subtag.slug}`}
                        rel="tag"
                        className={`px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 ${
                          darkMode 
                            ? 'bg-gray-800 text-gray-300 hover:text-white' 
                            : 'bg-gray-100 text-gray-700 hover:text-white'
                        }`}
                        style={{
                          '--hover-bg': subtag.color
                        } as React.CSSProperties}
                        onMouseEnter={(e) => {
                          e.currentTarget.style.backgroundColor = subtag.color;
                        }}
                        onMouseLeave={(e) => {
                          e.currentTarget.style.backgroundColor = darkMode ? '#374151' : '#f3f4f6';
                        }}
                        onClick={() => setIsMenuOpen(false)}
                      >
                        {subtag.name}
                      </a>
                    ))}
                  </div>
                </section>
              ))}

              <div className={`pt-4 border-t ${darkMode ? 'border-gray-700' : 'border-gray-200'}`}>
                <button
                  onClick={() => {
                    onWritersDirectoryToggle();
                    setIsMenuOpen(false);
                  }}
                  className={`text-left font-medium transition-colors duration-200 ${
                    darkMode ? 'text-gray-300 hover:text-[#36b7ff]' : 'text-gray-700 hover:text-[#36b7ff]'
                  }`}
                >
                  Nuestros Escritores
                </button>
              </div>
            </nav>
          </div>
        )}
      </div>
    </header>
  );
};

export default Header;
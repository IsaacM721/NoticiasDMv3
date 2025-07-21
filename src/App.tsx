import React, { useState, useEffect } from 'react';
import Header from './components/Header';
import NewsGrid from './components/NewsGrid';
import WriterPanel from './components/WriterPanel';
import ArticleView from './components/ArticleView';
import WritersDirectory from './components/WritersDirectory';
import WriterProfile from './components/WriterProfile';
import Footer from './components/Footer';
import AdminPanel from './components/AdminPanel';
import { useSupabaseData } from './hooks/useSupabase';

function App() {
  const [isWriterMode, setIsWriterMode] = useState(false);
  const [showAdminPanel, setShowAdminPanel] = useState(false);
  const [showWritersDirectory, setShowWritersDirectory] = useState(false);
  const [selectedWriter, setSelectedWriter] = useState<any>(null);
  const [selectedArticle, setSelectedArticle] = useState<any>(null);
  const [darkMode, setDarkMode] = useState(false);

  // Use Supabase data
  const { articles, writers, categories, tags, subtags, loading, error, refetch } = useSupabaseData();

  // Load dark mode preference from localStorage
  useEffect(() => {
    const savedDarkMode = localStorage.getItem('darkMode');
    if (savedDarkMode) {
      setDarkMode(JSON.parse(savedDarkMode));
    }
  }, []);

  // Save dark mode preference to localStorage
  useEffect(() => {
    localStorage.setItem('darkMode', JSON.stringify(darkMode));
    if (darkMode) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  }, [darkMode]);

  const handleWriterModeToggle = () => {
    setIsWriterMode(!isWriterMode);
    setSelectedArticle(null);
    setShowWritersDirectory(false);
    setSelectedWriter(null);
    setShowAdminPanel(false);
  };

  const handleWritersDirectoryToggle = () => {
    setShowWritersDirectory(!showWritersDirectory);
    setIsWriterMode(false);
    setSelectedArticle(null);
    setSelectedWriter(null);
    setShowAdminPanel(false);
  };

  const handleArticleSelect = (article: any) => {
    setSelectedArticle(article);
    setShowWritersDirectory(false);
    setSelectedWriter(null);
    setShowAdminPanel(false);
  };

  const handleWriterSelect = (writer: any) => {
    setSelectedWriter(writer);
    setShowWritersDirectory(false);
    setShowAdminPanel(false);
  };

  const handleBackToGrid = () => {
    setSelectedArticle(null);
    setSelectedWriter(null);
    setShowWritersDirectory(false);
    setShowAdminPanel(false);
  };

  const handleBackToWritersDirectory = () => {
    setSelectedWriter(null);
    setShowWritersDirectory(true);
    setShowAdminPanel(false);
  };

  const handleArticleCreate = (newArticle: any) => {
    // In a real app, this would save to Supabase
    refetch();
    setIsWriterMode(false);
  };

  const handleArticleUpdate = (updatedArticle: any) => {
    // In a real app, this would update in Supabase
    refetch();
  };

  const handleDarkModeToggle = () => {
    setDarkMode(!darkMode);
  };

  const handleAdminAccess = () => {
    setShowAdminPanel(true);
    setIsWriterMode(false);
    setShowWritersDirectory(false);
    setSelectedArticle(null);
    setSelectedWriter(null);
  };

  if (loading) {
    return (
      <div className={`min-h-screen flex items-center justify-center ${
        darkMode ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-900'
      }`}>
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#36b7ff] mx-auto mb-4"></div>
          <p>Cargando NoticiasDM...</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className={`min-h-screen flex items-center justify-center ${
        darkMode ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-900'
      }`}>
        <div className="text-center">
          <p className="text-red-500 mb-4">Error: {error}</p>
          <button
            onClick={refetch}
            className="px-4 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8]"
          >
            Reintentar
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className={`min-h-screen transition-colors duration-300 ${
      darkMode ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-900'
    }`}>
      <Header 
        onWriterModeToggle={handleWriterModeToggle}
        onWritersDirectoryToggle={handleWritersDirectoryToggle}
        isWriterMode={isWriterMode}
        darkMode={darkMode}
        onDarkModeToggle={handleDarkModeToggle}
        tags={tags}
        subtags={subtags}
      />
      
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {showAdminPanel ? (
          <AdminPanel
            onClose={() => setShowAdminPanel(false)}
            darkMode={darkMode}
          />
        ) : isWriterMode ? (
          <WriterPanel 
            onArticleCreate={handleArticleCreate}
            onCancel={() => setIsWriterMode(false)}
            darkMode={darkMode}
            categories={categories}
            tags={tags}
            subtags={subtags}
          />
        ) : selectedWriter ? (
          <WriterProfile
            writer={selectedWriter}
            articles={articles}
            onBack={handleBackToWritersDirectory}
            onArticleSelect={handleArticleSelect}
            darkMode={darkMode}
          />
        ) : showWritersDirectory ? (
          <WritersDirectory
            writers={writers}
            onBack={handleBackToGrid}
            onWriterSelect={handleWriterSelect}
            darkMode={darkMode}
          />
        ) : selectedArticle ? (
          <ArticleView 
            article={selectedArticle}
            onBack={handleBackToGrid}
            relatedArticles={articles.filter(a => 
              a.id !== selectedArticle.id && 
              a.category.id === selectedArticle.category.id
            ).slice(0, 3)}
            darkMode={darkMode}
          />
        ) : (
          <NewsGrid 
            articles={articles}
            onArticleSelect={handleArticleSelect}
            darkMode={darkMode}
            categories={categories}
            tags={tags}
          />
        )}
      </main>

      <Footer 
        darkMode={darkMode} 
        onAdminAccess={handleAdminAccess}
      />
    </div>
  );
}

export default App;
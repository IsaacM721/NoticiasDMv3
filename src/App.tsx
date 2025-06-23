import React, { useState, useEffect } from 'react';
import Header from './components/Header';
import NewsGrid from './components/NewsGrid';
import WriterPanel from './components/WriterPanel';
import ArticleView from './components/ArticleView';
import WritersDirectory from './components/WritersDirectory';
import WriterProfile from './components/WriterProfile';
import Footer from './components/Footer';
import { Article, Writer } from './types';
import { articles as initialArticles, writers } from './data/mockData';

function App() {
  const [isWriterMode, setIsWriterMode] = useState(false);
  const [showWritersDirectory, setShowWritersDirectory] = useState(false);
  const [selectedWriter, setSelectedWriter] = useState<Writer | null>(null);
  const [articles, setArticles] = useState<Article[]>(initialArticles);
  const [selectedArticle, setSelectedArticle] = useState<Article | null>(null);
  const [darkMode, setDarkMode] = useState(false);

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
  };

  const handleWritersDirectoryToggle = () => {
    setShowWritersDirectory(!showWritersDirectory);
    setIsWriterMode(false);
    setSelectedArticle(null);
    setSelectedWriter(null);
  };

  const handleArticleSelect = (article: Article) => {
    setSelectedArticle(article);
    setShowWritersDirectory(false);
    setSelectedWriter(null);
  };

  const handleWriterSelect = (writer: Writer) => {
    setSelectedWriter(writer);
    setShowWritersDirectory(false);
  };

  const handleBackToGrid = () => {
    setSelectedArticle(null);
    setSelectedWriter(null);
    setShowWritersDirectory(false);
  };

  const handleBackToWritersDirectory = () => {
    setSelectedWriter(null);
    setShowWritersDirectory(true);
  };

  const handleArticleCreate = (newArticle: Article) => {
    setArticles([newArticle, ...articles]);
    setIsWriterMode(false);
  };

  const handleArticleUpdate = (updatedArticle: Article) => {
    setArticles(articles.map(article => 
      article.id === updatedArticle.id ? updatedArticle : article
    ));
  };

  const handleDarkModeToggle = () => {
    setDarkMode(!darkMode);
  };

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
      />
      
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {isWriterMode ? (
          <WriterPanel 
            onArticleCreate={handleArticleCreate}
            onCancel={() => setIsWriterMode(false)}
            darkMode={darkMode}
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
          />
        )}
      </main>

      <Footer darkMode={darkMode} />
    </div>
  );
}

export default App;
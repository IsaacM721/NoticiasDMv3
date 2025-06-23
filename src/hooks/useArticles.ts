import { useState, useEffect } from 'react';
import { Article } from '../types';

export const useArticles = (initialArticles: Article[] = []) => {
  const [articles, setArticles] = useState<Article[]>(initialArticles);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const addArticle = (article: Article) => {
    setArticles(prev => [article, ...prev]);
  };

  const updateArticle = (updatedArticle: Article) => {
    setArticles(prev => 
      prev.map(article => 
        article.id === updatedArticle.id ? updatedArticle : article
      )
    );
  };

  const deleteArticle = (articleId: string) => {
    setArticles(prev => prev.filter(article => article.id !== articleId));
  };

  const getArticleBySlug = (slug: string) => {
    return articles.find(article => article.slug === slug);
  };

  const getArticlesByCategory = (categoryId: string) => {
    return articles.filter(article => article.category.id === categoryId);
  };

  const getArticlesByTag = (tagId: string) => {
    return articles.filter(article => 
      article.tags.some(tag => tag.id === tagId)
    );
  };

  const searchArticles = (query: string) => {
    const lowercaseQuery = query.toLowerCase();
    return articles.filter(article =>
      article.title.toLowerCase().includes(lowercaseQuery) ||
      article.content.toLowerCase().includes(lowercaseQuery) ||
      article.excerpt.toLowerCase().includes(lowercaseQuery) ||
      article.tags.some(tag => tag.name.toLowerCase().includes(lowercaseQuery))
    );
  };

  return {
    articles,
    loading,
    error,
    addArticle,
    updateArticle,
    deleteArticle,
    getArticleBySlug,
    getArticlesByCategory,
    getArticlesByTag,
    searchArticles
  };
};
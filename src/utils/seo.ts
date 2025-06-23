import { Article, SEOData } from '../types';

export const generateSEOData = (article: Article): SEOData => {
  return {
    title: article.seoTitle || article.title,
    description: article.seoDescription || article.excerpt,
    keywords: [
      article.category.name,
      ...article.tags.map(tag => tag.name),
      'República Dominicana',
      'noticias',
      'NoticiasDM'
    ],
    ogImage: article.featuredImage,
    canonical: `${window.location.origin}/article/${article.slug}`
  };
};

export const updatePageSEO = (seoData: SEOData) => {
  // Update document title
  document.title = seoData.title;

  // Update meta description
  updateMetaTag('description', seoData.description);

  // Update meta keywords
  updateMetaTag('keywords', seoData.keywords.join(', '));

  // Update Open Graph tags
  updateMetaTag('og:title', seoData.title, 'property');
  updateMetaTag('og:description', seoData.description, 'property');
  updateMetaTag('og:type', 'article', 'property');
  
  if (seoData.ogImage) {
    updateMetaTag('og:image', seoData.ogImage, 'property');
  }

  // Update Twitter Card tags
  updateMetaTag('twitter:card', 'summary_large_image');
  updateMetaTag('twitter:title', seoData.title);
  updateMetaTag('twitter:description', seoData.description);
  
  if (seoData.ogImage) {
    updateMetaTag('twitter:image', seoData.ogImage);
  }

  // Update canonical URL
  if (seoData.canonical) {
    updateLinkTag('canonical', seoData.canonical);
  }
};

const updateMetaTag = (name: string, content: string, attribute: string = 'name') => {
  let element = document.querySelector(`meta[${attribute}="${name}"]`) as HTMLMetaElement;
  
  if (!element) {
    element = document.createElement('meta');
    element.setAttribute(attribute, name);
    document.head.appendChild(element);
  }
  
  element.content = content;
};

const updateLinkTag = (rel: string, href: string) => {
  let element = document.querySelector(`link[rel="${rel}"]`) as HTMLLinkElement;
  
  if (!element) {
    element = document.createElement('link');
    element.rel = rel;
    document.head.appendChild(element);
  }
  
  element.href = href;
};

export const generateStructuredData = (article: Article) => {
  const structuredData = {
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "headline": article.title,
    "description": article.excerpt,
    "image": article.featuredImage,
    "author": {
      "@type": "Person",
      "name": article.author
    },
    "publisher": {
      "@type": "Organization",
      "name": "NoticiasDM",
      "logo": {
        "@type": "ImageObject",
        "url": `${window.location.origin}/logo.png`
      }
    },
    "datePublished": article.publishedAt.toISOString(),
    "dateModified": article.updatedAt.toISOString(),
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": `${window.location.origin}/article/${article.slug}`
    },
    "articleSection": article.category.name,
    "keywords": article.tags.map(tag => tag.name).join(', ')
  };

  // Update or create structured data script tag
  let scriptTag = document.querySelector('script[type="application/ld+json"]');
  
  if (!scriptTag) {
    scriptTag = document.createElement('script');
    scriptTag.type = 'application/ld+json';
    document.head.appendChild(scriptTag);
  }
  
  scriptTag.textContent = JSON.stringify(structuredData);
};
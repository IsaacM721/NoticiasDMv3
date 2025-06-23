export interface Article {
  id: string;
  title: string;
  content: string;
  excerpt: string;
  author: string;
  publishedAt: Date;
  updatedAt: Date;
  featuredImage: string;
  tags: Tag[];
  subtags: Subtag[];
  category: Category;
  status: 'draft' | 'published';
  slug: string;
  seoTitle?: string;
  seoDescription?: string;
  readTime: number;
}

export interface Tag {
  id: string;
  name: string;
  slug: string;
  color: string;
}

export interface Subtag {
  id: string;
  name: string;
  slug: string;
  color: string;
  categoryId: string;
}

export interface Category {
  id: string;
  name: string;
  slug: string;
  color: string;
  description: string;
}

export interface Writer {
  id: string;
  name: string;
  email: string;
  bio: string;
  avatar: string;
  socialLinks: {
    twitter?: string;
    linkedin?: string;
    instagram?: string;
    website?: string;
  };
  specialties: string[];
  joinedAt: Date;
  articlesCount: number;
  verified: boolean;
}

export interface SEOData {
  title: string;
  description: string;
  keywords: string[];
  ogImage?: string;
  canonical?: string;
}
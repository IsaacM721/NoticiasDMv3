import { createClient } from '@supabase/supabase-js';

const supabaseUrl = import.meta.env.VITE_SUPABASE_URL;
const supabaseAnonKey = import.meta.env.VITE_SUPABASE_ANON_KEY;

if (!supabaseUrl || !supabaseAnonKey) {
  throw new Error('Missing Supabase environment variables');
}

export const supabase = createClient(supabaseUrl, supabaseAnonKey);

// Database types
export interface Category {
  id: string;
  name: string;
  slug: string;
  color: string;
  description?: string;
  created_at: string;
  updated_at: string;
}

export interface Tag {
  id: string;
  name: string;
  slug: string;
  color: string;
  created_at: string;
  updated_at: string;
}

export interface Subtag {
  id: string;
  name: string;
  slug: string;
  color: string;
  category_id: string;
  created_at: string;
  updated_at: string;
}

export interface Writer {
  id: string;
  name: string;
  email: string;
  bio?: string;
  avatar?: string;
  social_links: {
    twitter?: string;
    linkedin?: string;
    instagram?: string;
    website?: string;
  };
  specialties: string[];
  verified: boolean;
  active: boolean;
  created_at: string;
  updated_at: string;
}

export interface Article {
  id: string;
  title: string;
  content: string;
  excerpt?: string;
  slug: string;
  featured_image?: string;
  author_id?: string;
  category_id?: string;
  status: 'draft' | 'published';
  seo_title?: string;
  seo_description?: string;
  read_time: number;
  published_at?: string;
  created_at: string;
  updated_at: string;
  // Relations
  writer?: Writer;
  category?: Category;
  tags?: Tag[];
  subtags?: Subtag[];
}
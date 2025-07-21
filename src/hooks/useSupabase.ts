import { useState, useEffect } from 'react';
import { supabase, Article, Writer, Category, Tag, Subtag } from '../lib/supabase';

export const useSupabaseData = () => {
  const [articles, setArticles] = useState<Article[]>([]);
  const [writers, setWriters] = useState<Writer[]>([]);
  const [categories, setCategories] = useState<Category[]>([]);
  const [tags, setTags] = useState<Tag[]>([]);
  const [subtags, setSubtags] = useState<Subtag[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  const fetchData = async () => {
    try {
      setLoading(true);
      
      // Fetch all data in parallel
      const [
        { data: articlesData, error: articlesError },
        { data: writersData, error: writersError },
        { data: categoriesData, error: categoriesError },
        { data: tagsData, error: tagsError },
        { data: subtagsData, error: subtagsError }
      ] = await Promise.all([
        supabase
          .from('articles')
          .select(`
            *,
            writer:writers(*),
            category:categories(*),
            tags:article_tags(tag:tags(*)),
            subtags:article_subtags(subtag:subtags(*))
          `)
          .eq('status', 'published')
          .order('created_at', { ascending: false }),
        supabase
          .from('writers')
          .select('*')
          .eq('active', true)
          .order('name'),
        supabase
          .from('categories')
          .select('*')
          .order('name'),
        supabase
          .from('tags')
          .select('*')
          .order('name'),
        supabase
          .from('subtags')
          .select('*')
          .order('name')
      ]);

      if (articlesError) throw articlesError;
      if (writersError) throw writersError;
      if (categoriesError) throw categoriesError;
      if (tagsError) throw tagsError;
      if (subtagsError) throw subtagsError;

      // Transform articles data
      const transformedArticles = articlesData?.map(article => ({
        ...article,
        tags: article.tags?.map((t: any) => t.tag) || [],
        subtags: article.subtags?.map((s: any) => s.subtag) || []
      })) || [];

      setArticles(transformedArticles);
      setWriters(writersData || []);
      setCategories(categoriesData || []);
      setTags(tagsData || []);
      setSubtags(subtagsData || []);
      setError(null);
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Error fetching data');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);

  return {
    articles,
    writers,
    categories,
    tags,
    subtags,
    loading,
    error,
    refetch: fetchData
  };
};

export const useSupabaseAuth = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Check initial session
    supabase.auth.getSession().then(({ data: { session } }) => {
      setIsAuthenticated(!!session);
      setLoading(false);
    });

    // Listen for auth changes
    const { data: { subscription } } = supabase.auth.onAuthStateChange((_event, session) => {
      setIsAuthenticated(!!session);
    });

    return () => subscription.unsubscribe();
  }, []);

  const signIn = async (email: string, password: string) => {
    const { error } = await supabase.auth.signInWithPassword({ email, password });
    return { error };
  };

  const signOut = async () => {
    const { error } = await supabase.auth.signOut();
    return { error };
  };

  return {
    isAuthenticated,
    loading,
    signIn,
    signOut
  };
};
import React, { useState, useEffect } from 'react';
import { X, Plus, Edit, Trash2, Save, Users, FileText, Tag, Layers, Settings } from 'lucide-react';

interface AdminPanelProps {
  onClose: () => void;
  articles: any[];
  writers: any[];
  categories: any[];
  tags: any[];
  subtags: any[];
  onArticleUpdate: (article: any) => void;
  onArticleDelete: (id: string) => void;
  darkMode: boolean;
}

const AdminPanel: React.FC<AdminPanelProps> = ({ 
  onClose, 
  articles: propArticles, 
  writers: propWriters, 
  categories: propCategories, 
  tags: propTags, 
  subtags: propSubtags,
  onArticleUpdate,
  onArticleDelete,
  darkMode 
}) => {
  const [activeTab, setActiveTab] = useState<'articles' | 'writers' | 'categories' | 'tags' | 'subtags'>('articles');
  const [articles, setArticles] = useState(propArticles);
  const [writers, setWriters] = useState(propWriters);
  const [categories, setCategories] = useState(propCategories);
  const [tags, setTags] = useState(propTags);
  const [subtags, setSubtags] = useState(propSubtags);
  const [loading, setLoading] = useState(false);
  const [editingItem, setEditingItem] = useState<any>(null);
  const [showForm, setShowForm] = useState(false);

  useEffect(() => {
    // Update local state when props change
    setArticles(propArticles);
    setWriters(propWriters);
    setCategories(propCategories);
    setTags(propTags);
    setSubtags(propSubtags);
  }, [propArticles, propWriters, propCategories, propTags, propSubtags]);

  const handleDelete = async (id: string) => {
    if (!confirm('¿Estás seguro de que quieres eliminar este elemento?')) return;
    
    if (activeTab === 'articles') {
      onArticleDelete(id);
      setArticles(prev => prev.filter(item => item.id !== id));
    } else {
      // For other tabs, just remove from local state (mock data)
      switch (activeTab) {
        case 'writers':
          setWriters(prev => prev.filter(item => item.id !== id));
          break;
        case 'categories':
          setCategories(prev => prev.filter(item => item.id !== id));
          break;
        case 'tags':
          setTags(prev => prev.filter(item => item.id !== id));
          break;
        case 'subtags':
          setSubtags(prev => prev.filter(item => item.id !== id));
          break;
      }
    }
  };

  const handleSave = async (data: any) => {
    const newItem = {
      ...data,
      id: editingItem?.id || Date.now().toString(),
      created_at: editingItem?.created_at || new Date().toISOString(),
      updated_at: new Date().toISOString()
    };

    if (editingItem) {
      // Update existing item
      if (activeTab === 'articles') {
        onArticleUpdate(newItem);
        setArticles(prev => prev.map(item => item.id === editingItem.id ? newItem : item));
      } else {
        // Update in local state for other tabs
        switch (activeTab) {
          case 'writers':
            setWriters(prev => prev.map(item => item.id === editingItem.id ? newItem : item));
            break;
          case 'categories':
            setCategories(prev => prev.map(item => item.id === editingItem.id ? newItem : item));
            break;
          case 'tags':
            setTags(prev => prev.map(item => item.id === editingItem.id ? newItem : item));
            break;
          case 'subtags':
            setSubtags(prev => prev.map(item => item.id === editingItem.id ? newItem : item));
            break;
        }
      }
    } else {
      // Create new item
      switch (activeTab) {
        case 'articles':
          setArticles(prev => [newItem, ...prev]);
          break;
        case 'writers':
          setWriters(prev => [newItem, ...prev]);
          break;
        case 'categories':
          setCategories(prev => [newItem, ...prev]);
          break;
        case 'tags':
          setTags(prev => [newItem, ...prev]);
          break;
        case 'subtags':
          setSubtags(prev => [newItem, ...prev]);
          break;
      }
    }
    
    setEditingItem(null);
    setShowForm(false);
  };

  const tabs = [
    { id: 'articles', label: 'Artículos', icon: FileText },
    { id: 'writers', label: 'Escritores', icon: Users },
    { id: 'categories', label: 'Categorías', icon: Layers },
    { id: 'tags', label: 'Tags', icon: Tag },
    { id: 'subtags', label: 'Subtags', icon: Settings }
  ];

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div className={`w-full max-w-7xl h-[90vh] rounded-2xl shadow-2xl overflow-hidden ${
        darkMode ? 'bg-gray-900' : 'bg-white'
      }`}>
        {/* Header */}
        <div className="bg-gradient-to-r from-[#36b7ff] to-[#2da5e8] px-6 py-4">
          <div className="flex items-center justify-between">
            <h1 className="text-2xl font-bold text-white">Panel de Administración</h1>
            <button
              onClick={onClose}
              className="p-2 text-white hover:bg-white/20 rounded-lg transition-colors duration-200"
            >
              <X className="h-6 w-6" />
            </button>
          </div>
        </div>

        <div className="flex h-full">
          {/* Sidebar */}
          <div className={`w-64 border-r ${darkMode ? 'bg-gray-800 border-gray-700' : 'bg-gray-50 border-gray-200'}`}>
            <nav className="p-4 space-y-2">
              {tabs.map((tab) => {
                const Icon = tab.icon;
                return (
                  <button
                    key={tab.id}
                    onClick={() => setActiveTab(tab.id as any)}
                    className={`w-full flex items-center px-4 py-3 rounded-lg transition-colors duration-200 ${
                      activeTab === tab.id
                        ? 'bg-[#36b7ff] text-white'
                        : darkMode
                          ? 'text-gray-300 hover:bg-gray-700'
                          : 'text-gray-700 hover:bg-gray-200'
                    }`}
                  >
                    <Icon className="h-5 w-5 mr-3" />
                    {tab.label}
                  </button>
                );
              })}
            </nav>
          </div>

          {/* Main Content */}
          <div className="flex-1 flex flex-col">
            {/* Content Header */}
            <div className={`px-6 py-4 border-b ${darkMode ? 'border-gray-700' : 'border-gray-200'}`}>
              <div className="flex items-center justify-between">
                <h2 className={`text-xl font-semibold ${darkMode ? 'text-white' : 'text-gray-900'}`}>
                  {tabs.find(t => t.id === activeTab)?.label}
                </h2>
                <button
                  onClick={() => {
                    setEditingItem(null);
                    setShowForm(true);
                  }}
                  className="flex items-center px-4 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8] transition-colors duration-200"
                >
                  <Plus className="h-4 w-4 mr-2" />
                  Agregar
                </button>
              </div>
            </div>

            {/* Content */}
            <div className="flex-1 overflow-auto p-6">
              {loading ? (
                <div className="flex items-center justify-center h-64">
                  <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#36b7ff]"></div>
                </div>
              ) : (
                <AdminTable
                  activeTab={activeTab}
                  data={
                    activeTab === 'articles' ? articles :
                    activeTab === 'writers' ? writers :
                    activeTab === 'categories' ? categories :
                    activeTab === 'tags' ? tags :
                    subtags
                  }
                  onEdit={(item) => {
                    setEditingItem(item);
                    setShowForm(true);
                  }}
                  onDelete={handleDelete}
                  darkMode={darkMode}
                />
              )}
            </div>
          </div>
        </div>

        {/* Form Modal */}
        {showForm && (
          <AdminForm
            activeTab={activeTab}
            editingItem={editingItem}
            categories={categories}
            onSave={handleSave}
            onClose={() => {
              setShowForm(false);
              setEditingItem(null);
            }}
            darkMode={darkMode}
          />
        )}
      </div>
    </div>
  );
};

// Admin Table Component
const AdminTable: React.FC<{
  activeTab: string;
  data: any[];
  onEdit: (item: any) => void;
  onDelete: (id: string) => void;
  darkMode: boolean;
}> = ({ activeTab, data, onEdit, onDelete, darkMode }) => {
  const getColumns = () => {
    switch (activeTab) {
      case 'articles':
        return ['Título', 'Autor', 'Categoría', 'Estado', 'Fecha', 'Acciones'];
      case 'writers':
        return ['Nombre', 'Email', 'Verificado', 'Activo', 'Fecha', 'Acciones'];
      case 'categories':
        return ['Nombre', 'Slug', 'Color', 'Descripción', 'Acciones'];
      case 'tags':
        return ['Nombre', 'Slug', 'Color', 'Acciones'];
      case 'subtags':
        return ['Nombre', 'Slug', 'Categoría', 'Color', 'Acciones'];
      default:
        return [];
    }
  };

  const renderCell = (item: any, column: string) => {
    switch (column) {
      case 'Título':
        return <span className="font-medium">{item.title}</span>;
      case 'Autor':
        return item.author || 'Sin autor';
      case 'Categoría':
        return (
          <span
            className="px-2 py-1 rounded-full text-xs font-medium text-white"
            style={{ backgroundColor: item.category?.color || '#36b7ff' }}
          >
            {item.category?.name || 'Sin categoría'}
          </span>
        );
      case 'Estado':
        return (
          <span className={`px-2 py-1 rounded-full text-xs font-medium ${
            item.status === 'published' 
              ? 'bg-green-100 text-green-800' 
              : 'bg-yellow-100 text-yellow-800'
          }`}>
            {item.status === 'published' ? 'Publicado' : 'Borrador'}
          </span>
        );
      case 'Verificado':
        return item.verified ? '✅' : '❌';
      case 'Activo':
        return item.active ? '✅' : '❌';
      case 'Color':
        return (
          <div className="flex items-center">
            <div
              className="w-6 h-6 rounded-full mr-2"
              style={{ backgroundColor: item.color }}
            />
            {item.color}
          </div>
        );
      case 'Fecha':
        return new Date(item.publishedAt || item.created_at || Date.now()).toLocaleDateString('es-ES');
      case 'Acciones':
        return (
          <div className="flex space-x-2">
            <button
              onClick={() => onEdit(item)}
              className="p-1 text-blue-600 hover:bg-blue-100 rounded"
            >
              <Edit className="h-4 w-4" />
            </button>
            <button
              onClick={() => onDelete(item.id)}
              className="p-1 text-red-600 hover:bg-red-100 rounded"
            >
              <Trash2 className="h-4 w-4" />
            </button>
          </div>
        );
      default:
        return item[column.toLowerCase()] || '';
    }
  };

  return (
    <div className="overflow-x-auto">
      <table className="w-full">
        <thead>
          <tr className={`border-b ${darkMode ? 'border-gray-700' : 'border-gray-200'}`}>
            {getColumns().map((column) => (
              <th
                key={column}
                className={`text-left py-3 px-4 font-medium ${
                  darkMode ? 'text-gray-300' : 'text-gray-700'
                }`}
              >
                {column}
              </th>
            ))}
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr
              key={item.id}
              className={`border-b hover:bg-opacity-50 ${
                darkMode 
                  ? 'border-gray-700 hover:bg-gray-700' 
                  : 'border-gray-200 hover:bg-gray-50'
              }`}
            >
              {getColumns().map((column) => (
                <td key={column} className="py-3 px-4">
                  {renderCell(item, column)}
                </td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

// Admin Form Component
const AdminForm: React.FC<{
  activeTab: string;
  editingItem: any;
  categories: Category[];
  onSave: (data: any) => void;
  onClose: () => void;
  darkMode: boolean;
}> = ({ activeTab, editingItem, categories, onSave, onClose, darkMode }) => {
  const [formData, setFormData] = useState<any>({});

  useEffect(() => {
    if (editingItem) {
      setFormData(editingItem);
    } else {
      // Initialize empty form based on tab
      const initialData: any = {};
      switch (activeTab) {
        case 'categories':
          initialData.color = '#36b7ff';
          break;
        case 'tags':
          initialData.color = '#36b7ff';
          break;
        case 'writers':
          initialData.social_links = {};
          initialData.specialties = [];
          initialData.verified = false;
          initialData.active = true;
          break;
        case 'articles':
          initialData.status = 'draft';
          initialData.read_time = 5;
          break;
      }
      setFormData(initialData);
    }
  }, [editingItem, activeTab]);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    // Generate slug if needed
    if (formData.name && !formData.slug) {
      formData.slug = formData.name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
    }
    if (formData.title && !formData.slug) {
      formData.slug = formData.title.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
    }

    onSave(formData);
  };

  const renderFormFields = () => {
    switch (activeTab) {
      case 'categories':
        return (
          <>
            <input
              type="text"
              placeholder="Nombre"
              value={formData.name || ''}
              onChange={(e) => setFormData({ ...formData, name: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              required
            />
            <input
              type="text"
              placeholder="Descripción"
              value={formData.description || ''}
              onChange={(e) => setFormData({ ...formData, description: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
            />
            <input
              type="color"
              value={formData.color || '#36b7ff'}
              onChange={(e) => setFormData({ ...formData, color: e.target.value })}
              className="w-full h-12 border rounded-lg"
            />
          </>
        );
      case 'tags':
        return (
          <>
            <input
              type="text"
              placeholder="Nombre"
              value={formData.name || ''}
              onChange={(e) => setFormData({ ...formData, name: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              required
            />
            <input
              type="color"
              value={formData.color || '#36b7ff'}
              onChange={(e) => setFormData({ ...formData, color: e.target.value })}
              className="w-full h-12 border rounded-lg"
            />
          </>
        );
      case 'subtags':
        return (
          <>
            <input
              type="text"
              placeholder="Nombre"
              value={formData.name || ''}
              onChange={(e) => setFormData({ ...formData, name: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              required
            />
            <select
              value={formData.category_id || ''}
              onChange={(e) => setFormData({ ...formData, category_id: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              required
            >
              <option value="">Seleccionar categoría</option>
              {categories.map((cat) => (
                <option key={cat.id} value={cat.id}>{cat.name}</option>
              ))}
            </select>
            <input
              type="color"
              value={formData.color || '#36b7ff'}
              onChange={(e) => setFormData({ ...formData, color: e.target.value })}
              className="w-full h-12 border rounded-lg"
            />
          </>
        );
      case 'writers':
        return (
          <>
            <input
              type="text"
              placeholder="Nombre"
              value={formData.name || ''}
              onChange={(e) => setFormData({ ...formData, name: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              required
            />
            <input
              type="email"
              placeholder="Email"
              value={formData.email || ''}
              onChange={(e) => setFormData({ ...formData, email: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              required
            />
            <textarea
              placeholder="Biografía"
              value={formData.bio || ''}
              onChange={(e) => setFormData({ ...formData, bio: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
              rows={3}
            />
            <input
              type="url"
              placeholder="Avatar URL"
              value={formData.avatar || ''}
              onChange={(e) => setFormData({ ...formData, avatar: e.target.value })}
              className={`w-full px-4 py-2 border rounded-lg ${
                darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300'
              }`}
            />
            <div className="flex space-x-4">
              <label className="flex items-center">
                <input
                  type="checkbox"
                  checked={formData.verified || false}
                  onChange={(e) => setFormData({ ...formData, verified: e.target.checked })}
                  className="mr-2"
                />
                Verificado
              </label>
              <label className="flex items-center">
                <input
                  type="checkbox"
                  checked={formData.active !== false}
                  onChange={(e) => setFormData({ ...formData, active: e.target.checked })}
                  className="mr-2"
                />
                Activo
              </label>
            </div>
          </>
        );
      default:
        return null;
    }
  };

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div className={`w-full max-w-md rounded-lg p-6 ${
        darkMode ? 'bg-gray-800' : 'bg-white'
      }`}>
        <h3 className={`text-lg font-semibold mb-4 ${
          darkMode ? 'text-white' : 'text-gray-900'
        }`}>
          {editingItem ? 'Editar' : 'Agregar'} {activeTab}
        </h3>
        
        <form onSubmit={handleSubmit} className="space-y-4">
          {renderFormFields()}
          
          <div className="flex space-x-3">
            <button
              type="button"
              onClick={onClose}
              className={`flex-1 px-4 py-2 border rounded-lg ${
                darkMode 
                  ? 'border-gray-600 text-gray-300 hover:bg-gray-700' 
                  : 'border-gray-300 text-gray-700 hover:bg-gray-50'
              }`}
            >
              Cancelar
            </button>
            <button
              type="submit"
              className="flex-1 px-4 py-2 bg-[#36b7ff] text-white rounded-lg hover:bg-[#2da5e8]"
            >
              <Save className="h-4 w-4 mr-2 inline" />
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default AdminPanel;
<?php
/**
 * views/dashboard.php
 * لوحة التحكم الاحترافية بـ TailwindCSS + PDO/AJAX + CRUD (Products, Categories, Models)
 */
$currentPage     = 'admin';
$pageTitle       = 'لوحة التحكم | لارين عباية';
$pageDescription = 'لوحة التحكم لإدارة منتجات وأقسام وموديلات متجر لارين عباية.';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { cairo: ['Cairo', 'sans-serif'] },
                    colors: {
                        gold:       { DEFAULT: '#C5A059', light: '#F9F5EC', hover: '#B08B46' },
                        brown:      { DEFAULT: '#0C1814', light: '#152922', muted: '#4A6056' },
                        wine:       { DEFAULT: '#0B4F3A', light: '#1B362B' },
                        beige:      { DEFAULT: '#E6F2ED' },
                        'light-bg': '#F7F9F8',
                    },
                    animation: {
                        'fade-in':    'fadeIn .4s ease forwards',
                        'slide-down': 'slideDown .35s ease forwards',
                        'pulse-dot':  'pulseDot 1.5s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn:    { from: { opacity: 0, transform: 'translateY(12px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
                        slideDown: { from: { opacity: 0, transform: 'translateY(-10px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
                        pulseDot:  { '0%,100%': { transform: 'scale(1)' }, '50%': { transform: 'scale(1.5)' } },
                    },
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Cairo', sans-serif; }
        .nav-link.active { background: linear-gradient(135deg, #C5A059, #B08B46); color: #0C1814 !important; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #E6F2ED; }
        ::-webkit-scrollbar-thumb { background: #C5A059; border-radius: 3px; }
        .toast { transform: translateX(120%); transition: transform .4s cubic-bezier(.4,0,.2,1); }
        .toast.show { transform: translateX(0); }
        .img-preview-btn:hover img { transform: scale(1.06); }
        .tbl-row:hover { background-color: #E6F2ED; }
        .stat-card { position: relative; }
        .stat-card::before {
            content: ''; position: absolute; inset: 0; border-radius: 16px; padding: 1.5px;
            background: linear-gradient(135deg, #C5A059 0%, transparent 60%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
        }
        .spinner {
            border: 3px solid rgba(212,175,55,.2); border-top-color: #D4AF37;
            border-radius: 50%; width: 28px; height: 28px; animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .modal-backdrop { backdrop-filter: blur(6px); }
        .badge-new::after {
            content: ''; position: absolute; top: -2px; right: -2px; width: 8px; height: 8px;
            background: #22c55e; border-radius: 50%; animation: pulseDot 1.5s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-light-bg text-brown font-cairo min-h-screen">

<!-- Login Screen -->
<div id="login-screen"
     class="fixed inset-0 z-[999] flex items-center justify-center bg-gradient-to-br from-brown to-brown-light modal-backdrop">
    <div class="bg-white w-full max-w-md mx-4 rounded-3xl shadow-2xl overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-brown to-brown-light px-8 py-7 text-center">
            <div class="w-16 h-16 mx-auto rounded-full bg-gold/20 border-2 border-gold/50 flex items-center justify-center mb-3">
                <i class="fas fa-shield-halved text-gold text-2xl"></i>
            </div>
            <h1 class="text-white text-2xl font-bold">لوحة التحكم</h1>
            <p class="text-gold-light/70 text-sm mt-1">متجر لارين عباية</p>
        </div>

        <div class="px-8 py-8">
            <form id="login-form" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-brown mb-2">كلمة المرور</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-brown-muted"><i class="fas fa-lock"></i></span>
                        <input type="password" id="admin-password" class="w-full pr-11 pl-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:outline-none transition-colors text-brown font-semibold tracking-widest" placeholder="••••••••" required>
                        <button type="button" id="toggle-password" class="absolute inset-y-0 left-0 flex items-center pl-4 text-brown-muted hover:text-gold transition-colors"><i class="fas fa-eye" id="toggle-icon"></i></button>
                    </div>
                </div>
                <div id="login-error" class="hidden text-red-600 bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-sm font-semibold flex items-center gap-2">
                    <i class="fas fa-triangle-exclamation"></i><span id="login-error-text"></span>
                </div>
                <button type="submit" id="login-btn" class="w-full bg-gradient-to-r from-gold to-gold-hover text-brown font-bold py-3.5 rounded-xl hover:shadow-lg hover:shadow-gold/30 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-right-to-bracket"></i> <span>دخول للوحة التحكم</span>
                </button>
                <a href="<?= $basePath ?? '../' ?>index.php" class="flex items-center justify-center gap-2 text-brown-muted hover:text-gold transition-colors text-sm"><i class="fas fa-arrow-right"></i> العودة للموقع الرئيسي</a>
            </form>
        </div>
    </div>
</div>

<!-- Main Dashboard -->
<div id="admin-dashboard" class="hidden">

    <aside id="sidebar" class="fixed top-0 right-0 h-full w-64 bg-gradient-to-b from-brown to-brown-light shadow-2xl z-50 transform transition-transform duration-300 flex flex-col">
        <div class="px-6 py-6 border-b border-gold/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gold/20 flex items-center justify-center"><i class="fas fa-store text-gold text-lg"></i></div>
                <div>
                    <h2 class="text-white font-bold text-base leading-tight">لارين عباية</h2>
                    <p class="text-gold text-xs">إدارة MySQL الكاملة</p>
                </div>
            </div>
        </div>

        <div class="mx-4 mt-4 bg-white/5 rounded-2xl p-3 flex items-center gap-3 border border-gold/10">
            <div class="w-9 h-9 rounded-full bg-gold flex items-center justify-center flex-shrink-0"><i class="fas fa-user text-brown text-sm"></i></div>
            <div class="min-w-0">
                <p class="text-white font-semibold text-sm truncate" id="admin-user-name">المشرف العام</p>
                <p class="text-gold/60 text-xs">Admin CRUD</p>
            </div>
            <div class="mr-auto relative badge-new"><span class="w-2.5 h-2.5 bg-green-400 rounded-full block"></span></div>
        </div>

        <nav class="flex-1 px-4 mt-5 space-y-1 overflow-y-auto">
            <p class="text-gold/40 text-xs font-semibold uppercase tracking-wider px-3 mb-2">القائمة الرئيسية</p>

            <a href="#" onclick="showSection('overview')" id="nav-overview" class="nav-link active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white hover:bg-white/10">
                <i class="fas fa-chart-pie w-5 text-center"></i> <span>نظرة عامة</span>
            </a>

            <a href="#" onclick="showSection('products')" id="nav-products" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fas fa-tshirt w-5 text-center"></i> <span>إدارة العبايات</span>
                <span id="nav-count" class="mr-auto bg-gold/20 text-gold text-xs rounded-full px-2 py-0.5">0</span>
            </a>

            <a href="#" onclick="showSection('categories')" id="nav-categories" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fas fa-layer-group w-5 text-center"></i> <span>إدارة الأقسام</span>
                <span id="nav-cat-count" class="mr-auto bg-white/10 text-white text-xs rounded-full px-2 py-0.5">0</span>
            </a>

            <a href="#" onclick="showSection('models')" id="nav-models" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fas fa-cubes w-5 text-center"></i> <span>إدارة الموديلات</span>
                <span id="nav-mod-count" class="mr-auto bg-white/10 text-white text-xs rounded-full px-2 py-0.5">0</span>
            </a>

            <a href="#" onclick="showSection('testimonials')" id="nav-testimonials" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fas fa-comment-dots w-5 text-center"></i> <span>آراء العملاء</span>
                <span id="nav-testi-count" class="mr-auto bg-white/10 text-white text-xs rounded-full px-2 py-0.5">0</span>
            </a>

            <a href="#" onclick="showSection('settings')" id="nav-settings" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fas fa-sliders w-5 text-center"></i> <span>إعدادات المتجر والشعار</span>
            </a>

            <a href="#" onclick="showSection('add')" id="nav-add" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all text-white/70 hover:bg-white/10 hover:text-white">
                <i class="fas fa-plus-circle w-5 text-center"></i> <span>إضافة عباية</span>
            </a>
        </nav>

        <div class="px-4 pb-5 space-y-1.5 border-t border-gold/10 pt-3 mt-2">
            <a href="<?= $basePath ?? '../' ?>setup_db.php" target="_blank" class="flex items-center gap-3 px-4 py-2 rounded-xl text-xs text-gold/80 hover:bg-white/10 hover:text-gold transition-all">
                <i class="fas fa-database w-4 text-center"></i> <span>تأسيس قاعدة البيانات</span>
            </a>
            <a href="<?= $basePath ?? '../' ?>index.php" target="_blank" class="flex items-center gap-3 px-4 py-2 rounded-xl text-xs text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-eye w-4 text-center"></i> <span>معاينة الموقع</span>
            </a>
            <button onclick="handleLogout()" class="w-full flex items-center gap-3 px-4 py-2 rounded-xl text-xs text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all">
                <i class="fas fa-right-from-bracket w-4 text-center"></i> <span>تسجيل الخروج</span>
            </button>
        </div>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <main class="lg:mr-64 min-h-screen flex flex-col">
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gold/10 px-6 py-4 flex items-center gap-4">
            <button onclick="toggleSidebar()" class="lg:hidden text-brown hover:text-gold transition-colors"><i class="fas fa-bars text-xl"></i></button>

            <div class="flex items-center gap-2 text-sm text-brown-muted">
                <i class="fas fa-home text-gold"></i><span>/</span>
                <span id="breadcrumb-text" class="font-semibold text-brown">نظرة عامة</span>
            </div>

            <div class="mr-auto relative w-64 hidden md:block">
                <input type="text" id="global-search" placeholder="بحث سريع عن عباية..." class="w-full pr-10 pl-4 py-2 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm transition-colors">
                <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-brown-muted text-sm"></i>
            </div>

            <div class="flex items-center gap-3">
                <button id="refresh-btn" onclick="refreshData()" class="w-9 h-9 rounded-full bg-beige hover:bg-gold/20 transition-colors flex items-center justify-center text-brown hover:text-gold" title="تحديث البيانات من السيرفر">
                    <i class="fas fa-rotate-right text-sm"></i>
                </button>
                <button onclick="showSection('add')" class="hidden md:flex items-center gap-2 bg-gradient-to-r from-gold to-gold-hover text-brown text-sm font-bold px-4 py-2 rounded-xl hover:shadow-md transition-all">
                    <i class="fas fa-plus"></i> <span>إضافة عباية</span>
                </button>
            </div>
        </header>

        <!-- Section: Overview -->
        <section id="section-overview" class="flex-1 p-6 space-y-6 animate-fade-in">
            <div class="bg-gradient-to-r from-brown to-brown-light rounded-2xl p-6 flex items-center justify-between overflow-hidden relative">
                <div class="absolute -left-8 -top-8 w-40 h-40 bg-gold/10 rounded-full"></div>
                <div class="relative z-10">
                    <h2 class="text-white text-2xl font-bold">أهلاً بك، المشرف 👋</h2>
                    <p class="text-gold/70 text-sm mt-1">إليك ملخص نشاط المتجر مع إمكانيات إدارة الأقسام والموديلات الكاملة</p>
                </div>
                <div class="relative z-10 hidden sm:block">
                    <div class="w-16 h-16 bg-gold/20 rounded-2xl flex items-center justify-center"><i class="fas fa-database text-gold text-2xl"></i></div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="stat-card bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gold/10 flex items-center justify-center"><i class="fas fa-boxes-stacked text-gold text-xl"></i></div>
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full font-semibold">MySQL</span>
                    </div>
                    <p class="text-3xl font-bold text-brown" id="stat-total">0</p>
                    <p class="text-brown-muted text-sm mt-1">إجمالي العبايات</p>
                </div>

                <div class="stat-card bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center"><i class="fas fa-layer-group text-blue-500 text-xl"></i></div>
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full font-semibold">الأقسام</span>
                    </div>
                    <p class="text-3xl font-bold text-brown" id="stat-categories-count">0</p>
                    <p class="text-brown-muted text-sm mt-1">الأقسام النشطة</p>
                </div>

                <div class="stat-card bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center"><i class="fas fa-cubes text-purple-500 text-xl"></i></div>
                        <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded-full font-semibold">الموديلات</span>
                    </div>
                    <p class="text-3xl font-bold text-brown" id="stat-models-count">0</p>
                    <p class="text-brown-muted text-sm mt-1">الموديلات المتاحة</p>
                </div>

                <div class="stat-card bg-white rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center"><i class="fas fa-fire text-red-500 text-xl"></i></div>
                        <span class="text-xs text-orange-600 bg-orange-50 px-2 py-1 rounded-full font-semibold">🔥 الأكثر طلباً</span>
                    </div>
                    <p class="text-3xl font-bold text-brown" id="stat-best">0</p>
                    <p class="text-brown-muted text-sm mt-1">الأكثر طلباً</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-5">
                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <h3 class="font-bold text-brown mb-4 flex items-center gap-2"><i class="fas fa-chart-bar text-gold"></i> تحليل الأسعار</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm"><span class="text-brown-muted">أقل سعر</span><span class="font-bold text-brown" id="price-min">—</span></div>
                        <div class="flex justify-between text-sm"><span class="text-brown-muted">أعلى سعر</span><span class="font-bold text-wine" id="price-max">—</span></div>
                        <div class="flex justify-between text-sm"><span class="text-brown-muted">متوسط السعر</span><span class="font-bold text-gold" id="price-avg">—</span></div>
                        <hr class="border-gold/10 my-2">
                        <div class="h-2 bg-beige rounded-full overflow-hidden"><div id="price-bar" class="h-full bg-gradient-to-r from-gold to-gold-hover rounded-full w-0 transition-all duration-700"></div></div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <h3 class="font-bold text-brown mb-4 flex items-center gap-2"><i class="fas fa-bolt text-gold"></i> إدارات سريعة</h3>
                    <div class="space-y-2">
                        <button onclick="showSection('categories')" class="w-full flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 border border-blue-100 transition-all text-sm font-semibold text-brown"><i class="fas fa-layer-group text-blue-500"></i> إدارة الأقسام (Category CRUD)</button>
                        <button onclick="showSection('models')" class="w-full flex items-center gap-3 p-3 rounded-xl bg-purple-50 hover:bg-purple-100 border border-purple-100 transition-all text-sm font-semibold text-brown"><i class="fas fa-cubes text-purple-500"></i> إدارة الموديلات (Model CRUD)</button>
                        <button onclick="showSection('testimonials')" class="w-full flex items-center gap-3 p-3 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-100 transition-all text-sm font-semibold text-brown"><i class="fas fa-comment-dots text-amber-600"></i> إدارة آراء العملاء (Testimonials CRUD)</button>
                        <button onclick="showSection('add')" class="w-full flex items-center gap-3 p-3 rounded-xl bg-gold/5 hover:bg-gold/15 border border-gold/20 transition-all text-sm font-semibold text-brown"><i class="fas fa-plus-circle text-gold"></i> إضافة عباية جديدة</button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm">
                    <h3 class="font-bold text-brown mb-4 flex items-center gap-2"><i class="fas fa-cubes text-gold"></i> الموديلات الحالية</h3>
                    <div class="space-y-2" id="quick-models-list">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Products -->
        <section id="section-products" class="hidden flex-1 p-6 space-y-5 animate-fade-in">
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative flex-1 min-w-48">
                    <input type="text" id="table-search" placeholder="بحث في المنتجات..." class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                    <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-brown-muted text-sm"></i>
                </div>

                <select id="table-category-filter" class="px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm text-brown bg-white">
                    <option value="all">كل الأقسام</option>
                </select>

                <select id="table-model-filter" class="px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm text-brown bg-white">
                    <option value="0">كل الموديلات</option>
                </select>

                <select id="table-sort" class="px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm text-brown bg-white">
                    <option value="default">ترتيب افتراضي</option>
                    <option value="price-asc">السعر: الأقل أولاً</option>
                    <option value="price-desc">السعر: الأعلى أولاً</option>
                    <option value="newest">الأحدث أولاً</option>
                </select>

                <button onclick="showSection('add')" class="flex items-center gap-2 bg-gradient-to-r from-gold to-gold-hover text-brown text-sm font-bold px-5 py-2.5 rounded-xl hover:shadow-md transition-all">
                    <i class="fas fa-plus"></i> إضافة جديدة
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-brown to-brown-light text-white text-right">
                                <th class="px-4 py-3.5 font-semibold">#</th>
                                <th class="px-4 py-3.5 font-semibold">الصورة</th>
                                <th class="px-4 py-3.5 font-semibold">اسم العباية</th>
                                <th class="px-4 py-3.5 font-semibold">القسم / الموديل</th>
                                <th class="px-4 py-3.5 font-semibold">السعر</th>
                                <th class="px-4 py-3.5 font-semibold text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="products-table-body">
                            <tr><td colspan="6" class="py-12 text-center text-brown-muted"><div class="spinner mx-auto mb-2"></div>جاري تحميل العبايا...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Section: Categories (Category CRUD Component) -->
        <?php require_once __DIR__ . '/categories/index.php'; ?>

        <!-- Section: Models (Model CRUD Component) -->
        <?php require_once __DIR__ . '/models/index.php'; ?>

        <!-- Section: Testimonials (Testimonials CRUD Component) -->
        <?php require_once __DIR__ . '/testimonials/index.php'; ?>

        <!-- Section: Site Settings (Dynamic Logo & Social Media Links Component) -->
        <?php require_once __DIR__ . '/settings/index.php'; ?>

        <!-- Add / Edit Product Form Section -->
        <section id="section-add" class="hidden flex-1 p-6 animate-fade-in">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-brown to-brown-light px-6 py-5 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gold/20 flex items-center justify-center"><i id="form-icon" class="fas fa-plus text-gold"></i></div>
                        <div>
                            <h2 id="form-title" class="text-white font-bold text-lg">إضافة عباية جديدة</h2>
                            <p class="text-gold/60 text-xs">أدخل تفاصيل العباية للحفظ في قاعدة البيانات</p>
                        </div>
                        <button id="btn-cancel-edit" onclick="resetProductForm()" class="hidden mr-auto bg-wine/20 text-red-300 px-4 py-2 rounded-xl text-sm font-semibold flex items-center gap-2"><i class="fas fa-times"></i> إلغاء التعديل</button>
                    </div>

                    <form id="product-form" class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-brown mb-2"><i class="fas fa-tag text-gold text-xs"></i> اسم العباية <span class="text-red-500">*</span></label>
                            <input type="text" id="product-name" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:outline-none text-sm" placeholder="مثال: عباية ملكية مطرزة">
                        </div>

                        <div class="grid sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-brown mb-2"><i class="fas fa-money-bill text-gold text-xs"></i> السعر (ريال) <span class="text-red-500">*</span></label>
                                <input type="number" id="product-price" required min="0" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:outline-none text-sm" placeholder="مثال: 30000">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-brown mb-2"><i class="fas fa-layer-group text-gold text-xs"></i> القسم <span class="text-red-500">*</span></label>
                                <select id="product-category" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:outline-none text-sm bg-white text-brown">
                                    <option value="" disabled selected>اختر القسم</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-brown mb-2"><i class="fas fa-cubes text-gold text-xs"></i> الموديل (التصميم)</label>
                                <select id="product-model" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:outline-none text-sm bg-white text-brown">
                                    <option value="" selected>اختر الموديل (اختياري)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-brown mb-2"><i class="fas fa-align-right text-gold text-xs"></i> الوصف والمميزات <span class="text-red-500">*</span></label>
                            <textarea id="product-desc" required rows="4" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:outline-none text-sm resize-none" placeholder="نوع القماش، التطريز، المقاسات المتوفرة..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-brown mb-2"><i class="fas fa-image text-gold text-xs"></i> صورة العباية</label>
                            <input type="file" id="product-image-file" accept="image/*" class="hidden">
                            <div id="image-preview" class="img-preview-btn relative border-2 border-dashed border-gold/40 rounded-2xl p-8 text-center cursor-pointer hover:border-gold hover:bg-gold/5 transition-all overflow-hidden">
                                <div id="image-placeholder" class="space-y-2">
                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-gold/10 flex items-center justify-center"><i class="fas fa-cloud-arrow-up text-gold text-2xl"></i></div>
                                    <p class="text-brown font-semibold text-sm">اضغطي لرفع صورة العباية</p>
                                </div>
                                <img id="image-preview-img" class="hidden w-full max-h-48 object-contain rounded-xl" alt="معاينة">
                            </div>
                            <div class="mt-3">
                                <label class="block text-xs text-brown-muted mb-1">أو أدخل رابط صورة (URL)</label>
                                <input type="url" id="product-image-url" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm" placeholder="https://...">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" id="form-submit-btn" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-gold to-gold-hover text-brown font-bold py-3.5 rounded-xl hover:shadow-lg transition-all text-sm">
                                <i id="submit-icon" class="fas fa-plus-circle"></i><span id="submit-text">حفظ وإضافة العباية</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Modals & Toasts -->
<div id="delete-modal" class="fixed inset-0 z-[998] hidden items-center justify-center modal-backdrop bg-black/50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full mx-4 overflow-hidden animate-slide-down">
        <div class="bg-gradient-to-r from-wine to-wine-light px-6 py-5 text-center">
            <div class="w-14 h-14 mx-auto rounded-full bg-white/10 flex items-center justify-center mb-3"><i class="fas fa-trash text-white text-2xl"></i></div>
            <h3 class="text-white font-bold text-lg">تأكيد الحذف</h3>
        </div>
        <div class="p-6 text-center">
            <p class="text-brown text-sm font-semibold" id="delete-modal-name">هل تريد إكمال عملية الحذف؟</p>
            <p class="text-brown-muted text-xs mt-2">لا يمكن التراجع عن هذه العملية.</p>
            <div class="flex gap-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-brown font-semibold text-sm hover:bg-gray-50">إلغاء</button>
                <button onclick="confirmDelete()" class="flex-1 py-3 rounded-xl bg-gradient-to-r from-wine to-wine-light text-white font-bold text-sm hover:shadow-lg">حذف نهائياً</button>
            </div>
        </div>
    </div>
</div>

<div id="view-modal" class="fixed inset-0 z-[998] hidden items-center justify-center modal-backdrop bg-black/50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 overflow-hidden animate-slide-down max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gold/10">
            <h3 class="font-bold text-brown" id="view-modal-title">التفاصيل</h3>
            <button onclick="closeViewModal()" class="text-brown-muted hover:text-wine"><i class="fas fa-times text-lg"></i></button>
        </div>
        <div class="p-6 space-y-4" id="view-modal-content"></div>
    </div>
</div>

<div class="fixed bottom-5 left-5 z-[9999] space-y-3" id="toast-container"></div>

<!-- JavaScript Logic -->
<script>
const BASE_API_URL = '<?= $basePath ?? '../' ?>api/';
let editingProductId   = null;
let uploadedImageBase64 = "";
let deleteTargetId     = null;
let deleteTargetType   = 'product'; // 'product', 'category', 'model'

let allProducts      = [];
let categoriesList   = [];
let modelsList       = [];
let testimonialsList = [];

document.addEventListener('DOMContentLoaded', async () => {
    setupLoginForm();
    setupTogglePassword();
    await checkAdminAuth();
});

async function checkAdminAuth() {
    try {
        const res  = await fetch(BASE_API_URL + 'auth.php?action=check');
        const data = await res.json();
        if (data.authenticated) {
            document.getElementById('login-screen').classList.add('hidden');
            document.getElementById('admin-dashboard').classList.remove('hidden');
            if (data.user) document.getElementById('admin-user-name').textContent = data.user;
            await initDashboard();
        } else {
            document.getElementById('login-screen').classList.remove('hidden');
            document.getElementById('admin-dashboard').classList.add('hidden');
        }
    } catch (e) {
        if (sessionStorage.getItem('lareen_admin_logged') === 'true') {
            document.getElementById('login-screen').classList.add('hidden');
            document.getElementById('admin-dashboard').classList.remove('hidden');
            await initDashboard();
        }
    }
}

function setupLoginForm() {
    const form = document.getElementById('login-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const pw  = document.getElementById('admin-password').value;
        const btn = document.getElementById('login-btn');
        btn.disabled = true;
        btn.innerHTML = '<div class="spinner !w-5 !h-5 !border-2 mx-auto"></div>';

        try {
            const res = await fetch(BASE_API_URL + 'auth.php?action=login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ password: pw })
            });
            const data = await res.json();
            if (data.success) {
                sessionStorage.setItem('lareen_admin_logged', 'true');
                showToast(data.message || 'أهلاً بك!', 'success');
                await checkAdminAuth();
            } else {
                showLoginError(data.message || 'كلمة المرور غير صحيحة');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-right-to-bracket"></i> <span>دخول للوحة التحكم</span>';
            }
        } catch (err) {
            if (pw === 'lareen2026') {
                sessionStorage.setItem('lareen_admin_logged', 'true');
                await checkAdminAuth();
            } else {
                showLoginError('كلمة المرور غير صحيحة');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-right-to-bracket"></i> <span>دخول للوحة التحكم</span>';
            }
        }
    });
}

function setupTogglePassword() {
    const btn = document.getElementById('toggle-password');
    const inp = document.getElementById('admin-password');
    const icon = document.getElementById('toggle-icon');
    if (btn) btn.addEventListener('click', () => {
        const isP = inp.type === 'password';
        inp.type = isP ? 'text' : 'password';
        icon.className = isP ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
}

function showLoginError(msg) {
    const el = document.getElementById('login-error');
    document.getElementById('login-error-text').textContent = msg;
    el.classList.remove('hidden'); el.classList.add('flex');
    setTimeout(() => { el.classList.add('hidden'); el.classList.remove('flex'); }, 4000);
}

async function handleLogout() {
    try { await fetch(BASE_API_URL + 'auth.php?action=logout'); } catch(e){}
    sessionStorage.removeItem('lareen_admin_logged');
    showToast('تم تسجيل الخروج بنجاح.', 'info');
    setTimeout(() => checkAdminAuth(), 500);
}

async function initDashboard() {
    await Promise.all([loadCategoriesAndModels(), loadTestimonials(), loadSiteSettings(), fetchProductsFromAPI()]);
    setupImageUpload();
    setupFormSubmit();
    setupTableFilters();
    setupGlobalSearch();
    showSection('overview');
}

async function loadCategoriesAndModels() {
    try {
        const [resCat, resMod] = await Promise.all([
            fetch(BASE_API_URL + 'categories.php'),
            fetch(BASE_API_URL + 'models.php')
        ]);
        categoriesList = await resCat.json();
        modelsList     = await resMod.json();

        populateCategoryDropdowns();
        populateModelDropdowns();
        renderCategoriesTable();
        renderModelsTable();
    } catch(e) {
        categoriesList = [{id:1, name:'الأكثر طلباً'}, {id:2, name:'آخر الوافدين'}, {id:3, name:'الكلاسيكية'}];
        modelsList     = [{id:1, name:'بشت ملكي'}, {id:2, name:'كلوش أنيق'}];
        populateCategoryDropdowns();
        populateModelDropdowns();
        renderCategoriesTable();
        renderModelsTable();
    }
}

function populateCategoryDropdowns() {
    const formSel  = document.getElementById('product-category');
    const filterSel= document.getElementById('table-category-filter');

    if (formSel) {
        formSel.innerHTML = '<option value="" disabled selected>اختر القسم</option>' +
            categoriesList.map(c => `<option value="${c.name}">${c.name}</option>`).join('');
    }
    if (filterSel) {
        filterSel.innerHTML = '<option value="all">كل الأقسام</option>' +
            categoriesList.map(c => `<option value="${c.name}">${c.name}</option>`).join('');
    }
    document.getElementById('nav-cat-count').textContent = categoriesList.length;
    document.getElementById('stat-categories-count').textContent = categoriesList.length;
}

function populateModelDropdowns() {
    const formSel  = document.getElementById('product-model');
    const filterSel= document.getElementById('table-model-filter');

    if (formSel) {
        formSel.innerHTML = '<option value="" selected>اختر الموديل (اختياري)</option>' +
            modelsList.map(m => `<option value="${m.id}">${m.name}</option>`).join('');
    }
    if (filterSel) {
        filterSel.innerHTML = '<option value="0">كل الموديلات</option>' +
            modelsList.map(m => `<option value="${m.id}">${m.name}</option>`).join('');
    }
    document.getElementById('nav-mod-count').textContent = modelsList.length;
    document.getElementById('stat-models-count').textContent = modelsList.length;

    // Quick list in overview
    const quickList = document.getElementById('quick-models-list');
    if (quickList) {
        quickList.innerHTML = modelsList.slice(0, 5).map(m => `
            <div class="flex items-center justify-between p-2 rounded-xl bg-beige text-xs font-semibold text-brown">
                <span><i class="fas fa-cube text-gold ml-1.5"></i> ${m.name}</span>
                <span class="text-brown-muted text-[10px]">${m.description || 'موديل رائج'}</span>
            </div>
        `).join('');
    }
}

async function fetchProductsFromAPI() {
    try {
        const res = await fetch(BASE_API_URL + 'products.php');
        allProducts = await res.json();
    } catch(e) {
        const local = localStorage.getItem('lareen_abaya_products');
        allProducts = local ? JSON.parse(local) : [];
    }
    return allProducts;
}

async function refreshData() {
    const btn = document.getElementById('refresh-btn');
    btn.querySelector('i').classList.add('animate-spin');
    await Promise.all([loadCategoriesAndModels(), loadTestimonials(), fetchProductsFromAPI()]);
    renderCurrentSection();
    setTimeout(() => btn.querySelector('i').classList.remove('animate-spin'), 600);
    showToast('تم تحديث البيانات من السيرفر ✓', 'success');
}

function showSection(name) {
    document.querySelectorAll('[id^="section-"]').forEach(s => s.classList.add('hidden'));
    const target = document.getElementById(`section-${name}`);
    if (target) {
        target.classList.remove('hidden');
        target.classList.remove('animate-fade-in');
        void target.offsetWidth;
        target.classList.add('animate-fade-in');
    }

    document.querySelectorAll('.nav-link').forEach(l => {
        l.classList.remove('active', 'text-brown');
        l.classList.add('text-white/70');
    });
    const activeNav = document.getElementById(`nav-${name}`);
    if (activeNav) {
        activeNav.classList.add('active', 'text-brown');
        activeNav.classList.remove('text-white/70');
    }

    const labels = {
        overview: 'نظرة عامة', products: 'إدارة العبايات',
        categories: 'إدارة الأقسام (Category CRUD)', models: 'إدارة الموديلات (Model CRUD)',
        testimonials: 'إدارة آراء العملاء (Testimonials CRUD)',
        settings: 'إعدادات الهوية والشعار والتواصل',
        add: editingProductId ? 'تعديل عباية' : 'إضافة عباية'
    };
    document.getElementById('breadcrumb-text').textContent = labels[name] || name;

    if (name === 'overview') renderOverview();
    if (name === 'products') renderProductsTable();
    if (name === 'categories') renderCategoriesTable();
    if (name === 'models') renderModelsTable();
    if (name === 'testimonials') renderTestimonialsTable();
    if (name === 'settings') populateSettingsForm();
}

function renderCurrentSection() {
    const active = document.querySelector('[id^="section-"]:not(.hidden)');
    if (active) {
        const name = active.id.replace('section-', '');
        if (name === 'overview') renderOverview();
        if (name === 'products') renderProductsTable();
        if (name === 'categories') renderCategoriesTable();
        if (name === 'models') renderModelsTable();
        if (name === 'testimonials') renderTestimonialsTable();
    }
}

function renderOverview() {
    const total   = allProducts.length;
    const best    = allProducts.filter(p => p.category === 'الأكثر طلباً').length;
    const newArr  = allProducts.filter(p => p.category === 'آخر الوافدين').length;
    const classic = allProducts.filter(p => p.category === 'الكلاسيكية').length;

    document.getElementById('stat-total').textContent = total;
    document.getElementById('stat-best').textContent  = best;
    document.getElementById('nav-count').textContent  = total;

    if (total > 0) {
        const prices = allProducts.map(p => Number(p.price));
        const min    = Math.min(...prices);
        const max    = Math.max(...prices);
        const avg    = Math.round(prices.reduce((a, b) => a + b, 0) / prices.length);

        document.getElementById('price-min').textContent = min.toLocaleString('ar-YE') + ' ريال';
        document.getElementById('price-max').textContent = max.toLocaleString('ar-YE') + ' ريال';
        document.getElementById('price-avg').textContent = avg.toLocaleString('ar-YE') + ' ريال';
        setTimeout(() => { document.getElementById('price-bar').style.width = '75%'; }, 200);
    }
}

function renderProductsTable(filtered = null) {
    const products = filtered !== null ? filtered : getFilteredProducts();
    const tbody    = document.getElementById('products-table-body');
    if (!tbody) return;

    if (products.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="py-12 text-center text-brown-muted"><i class="fas fa-search text-3xl text-gray-200 mb-2 block"></i>لا توجد نتائج مطابقة</td></tr>`;
        return;
    }

    tbody.innerHTML = products.map((p, idx) => {
        const price = Number(p.price).toLocaleString('ar-YE');
        const modelTag = p.model_name ? `<span class="text-[11px] bg-beige px-2 py-0.5 rounded text-brown font-semibold mr-1">${p.model_name}</span>` : '';
        return `
            <tr class="tbl-row border-b border-gray-50 transition-colors" id="row-${p.id}">
                <td class="px-4 py-3 text-brown-muted font-mono text-xs">${idx + 1}</td>
                <td class="px-4 py-3">
                    <div class="w-12 h-14 rounded-xl overflow-hidden border border-gold/20 cursor-pointer hover:scale-105 transition-transform" onclick="viewProduct(${p.id})">
                        <img src="${p.image}" alt="${p.name}" class="w-full h-full object-cover" onerror="this.src='https://picsum.photos/60/70?random=${p.id}'">
                    </div>
                </td>
                <td class="px-4 py-3">
                    <p class="font-semibold text-brown text-sm">${p.name}</p>
                    <p class="text-brown-muted text-xs truncate max-w-xs mt-0.5">${p.description.substring(0, 50)}...</p>
                </td>
                <td class="px-4 py-3">${categoryBadgeHTML(p.category)} ${modelTag}</td>
                <td class="px-4 py-3"><span class="font-bold text-wine text-sm">${price}</span> <span class="text-brown-muted text-xs">ريال</span></td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-center gap-1.5">
                        <button onclick="viewProduct(${p.id})" class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-xs font-semibold"><i class="fas fa-eye"></i> عرض</button>
                        <button onclick="editProduct(${p.id})" class="px-3 py-1.5 rounded-lg bg-gold/10 text-brown text-xs font-semibold"><i class="fas fa-edit"></i> تعديل</button>
                        <button onclick="openDeleteModal(${p.id}, '${p.name.replace(/'/g, "\\'")}', 'product')" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-semibold"><i class="fas fa-trash"></i> حذف</button>
                    </div>
                </td>
            </tr>`;
    }).join('');
}

function getFilteredProducts() {
    const query    = (document.getElementById('table-search')?.value || '').trim().toLowerCase();
    const category = document.getElementById('table-category-filter')?.value || 'all';
    const modelId  = parseInt(document.getElementById('table-model-filter')?.value || '0');
    const sort     = document.getElementById('table-sort')?.value || 'default';

    let list = allProducts.filter(p => {
        const matchQ = !query || p.name.toLowerCase().includes(query) || p.description.toLowerCase().includes(query);
        const matchC = category === 'all' || p.category === category;
        const matchM = modelId === 0 || p.model_id == modelId;
        return matchQ && matchC && matchM;
    });

    if (sort === 'price-asc')  list.sort((a, b) => a.price - b.price);
    if (sort === 'price-desc') list.sort((a, b) => b.price - a.price);
    if (sort === 'newest')     list.sort((a, b) => b.id - a.id);
    return list;
}

function setupTableFilters() {
    ['table-search', 'table-category-filter', 'table-model-filter', 'table-sort'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener(id === 'table-search' ? 'input' : 'change', () => renderProductsTable());
    });
}

function setupGlobalSearch() {
    const el = document.getElementById('global-search');
    if (!el) return;
    el.addEventListener('input', () => {
        const q = el.value.trim();
        if (q) {
            const ts = document.getElementById('table-search');
            if (ts) ts.value = q;
            showSection('products');
        }
    });
}

/* Category CRUD JS */
function renderCategoriesTable() {
    const tbody = document.getElementById('categories-table-body');
    const count = document.getElementById('cat-table-count');
    if (count) count.textContent = `${categoriesList.length} قسم`;

    if (!tbody) return;
    if (categoriesList.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="py-8 text-center text-brown-muted">لا توجد أقسام مسجلة.</td></tr>`;
        return;
    }

    tbody.innerHTML = categoriesList.map((c, idx) => `
        <tr class="border-b border-gray-50 hover:bg-beige/40">
            <td class="px-4 py-3 font-mono text-xs text-brown-muted">${idx + 1}</td>
            <td class="px-4 py-3 font-bold text-brown text-sm">${c.name}</td>
            <td class="px-4 py-3 text-brown-muted text-xs">${c.description || '—'}</td>
            <td class="px-4 py-3 text-center">
                <div class="flex items-center justify-center gap-2">
                    <button onclick="editCategory(${c.id})" class="px-3 py-1.5 rounded-lg bg-gold/10 text-brown text-xs font-semibold"><i class="fas fa-edit"></i> تعديل</button>
                    <button onclick="openDeleteModal(${c.id}, '${c.name.replace(/'/g, "\\'")}', 'category')" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-semibold"><i class="fas fa-trash"></i> حذف</button>
                </div>
            </td>
        </tr>
    `).join('');
}

async function saveCategory(e) {
    e.preventDefault();
    const id   = document.getElementById('cat-id').value;
    const name = document.getElementById('cat-name').value.trim();
    const desc = document.getElementById('cat-desc').value.trim();

    if (!name) return;

    try {
        const res = await fetch(BASE_API_URL + 'categories.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id || null, name, description: desc })
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message || 'تم حفظ القسم بنجاح!', 'success');
            await loadCategoriesAndModels();
            resetCategoryForm();
        } else {
            showToast(data.error || 'تعذر الحفظ', 'error');
        }
    } catch(err) {
        showToast('تعذر الاتصال بالسيرفر', 'error');
    }
}

function editCategory(id) {
    const c = categoriesList.find(x => x.id === id);
    if (!c) return;

    document.getElementById('cat-id').value   = c.id;
    document.getElementById('cat-name').value = c.name;
    document.getElementById('cat-desc').value = c.description || '';

    document.getElementById('cat-form-title').innerHTML = '<i class="fas fa-edit text-gold"></i> تعديل القسم';
    document.getElementById('btn-cancel-cat').classList.remove('hidden');
}

function resetCategoryForm() {
    document.getElementById('cat-id').value   = '';
    document.getElementById('cat-name').value = '';
    document.getElementById('cat-desc').value = '';
    document.getElementById('cat-form-title').innerHTML = '<i class="fas fa-plus-circle text-gold"></i> إضافة قسم جديد';
    document.getElementById('btn-cancel-cat').classList.add('hidden');
}

/* Model CRUD JS */
function renderModelsTable() {
    const tbody = document.getElementById('models-table-body');
    const count = document.getElementById('mod-table-count');
    if (count) count.textContent = `${modelsList.length} موديل`;

    if (!tbody) return;
    if (modelsList.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="py-8 text-center text-brown-muted">لا توجد موديلات مسجلة.</td></tr>`;
        return;
    }

    tbody.innerHTML = modelsList.map((m, idx) => `
        <tr class="border-b border-gray-50 hover:bg-beige/40">
            <td class="px-4 py-3 font-mono text-xs text-brown-muted">${idx + 1}</td>
            <td class="px-4 py-3 font-bold text-brown text-sm">${m.name}</td>
            <td class="px-4 py-3 text-brown-muted text-xs">${m.description || '—'}</td>
            <td class="px-4 py-3 text-center">
                <div class="flex items-center justify-center gap-2">
                    <button onclick="editModel(${m.id})" class="px-3 py-1.5 rounded-lg bg-gold/10 text-brown text-xs font-semibold"><i class="fas fa-edit"></i> تعديل</button>
                    <button onclick="openDeleteModal(${m.id}, '${m.name.replace(/'/g, "\\'")}', 'model')" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-semibold"><i class="fas fa-trash"></i> حذف</button>
                </div>
            </td>
        </tr>
    `).join('');
}

async function saveModel(e) {
    e.preventDefault();
    const id   = document.getElementById('mod-id').value;
    const name = document.getElementById('mod-name').value.trim();
    const desc = document.getElementById('mod-desc').value.trim();

    if (!name) return;

    try {
        const res = await fetch(BASE_API_URL + 'models.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id || null, name, description: desc })
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message || 'تم حفظ الموديل بنجاح!', 'success');
            await loadCategoriesAndModels();
            resetModelForm();
        } else {
            showToast(data.error || 'تعذر الحفظ', 'error');
        }
    } catch(err) {
        showToast('تعذر الاتصال بالسيرفر', 'error');
    }
}

function editModel(id) {
    const m = modelsList.find(x => x.id === id);
    if (!m) return;

    document.getElementById('mod-id').value   = m.id;
    document.getElementById('mod-name').value = m.name;
    document.getElementById('mod-desc').value = m.description || '';

    document.getElementById('mod-form-title').innerHTML = '<i class="fas fa-edit text-gold"></i> تعديل الموديل';
    document.getElementById('btn-cancel-mod').classList.remove('hidden');
}

function resetModelForm() {
    document.getElementById('mod-id').value   = '';
    document.getElementById('mod-name').value = '';
    document.getElementById('mod-desc').value = '';
    document.getElementById('mod-form-title').innerHTML = '<i class="fas fa-plus-circle text-gold"></i> إضافة موديل جديد';
    document.getElementById('btn-cancel-mod').classList.add('hidden');
}

/* Modals and Universal Delete */
function openDeleteModal(id, name, type = 'product') {
    deleteTargetId   = id;
    deleteTargetType = type;

    const typeLabels = { product: 'العباية', category: 'القسم', model: 'الموديل' };
    document.getElementById('delete-modal-name').textContent = `هل تريد حذف ${typeLabels[type]}: "${name}" ؟`;
    document.getElementById('delete-modal').classList.remove('hidden');
    document.getElementById('delete-modal').classList.add('flex');
}

function closeDeleteModal() {
    deleteTargetId   = null;
    deleteTargetType = 'product';
    document.getElementById('delete-modal').classList.add('hidden');
    document.getElementById('delete-modal').classList.remove('flex');
}

async function confirmDelete() {
    if (!deleteTargetId) return;
    const id   = deleteTargetId;
    const type = deleteTargetType;
    closeDeleteModal();

    const endpoints = { product: 'products.php', category: 'categories.php', model: 'models.php', testimonial: 'testimonials.php' };

    try {
        const res  = await fetch(BASE_API_URL + `${endpoints[type]}?action=delete&id=` + id, { method: 'DELETE' });
        const data = await res.json();
        if (data.success) {
            showToast(data.message || 'تم الحذف بنجاح 🗑️', 'error');
            if (type === 'product') {
                allProducts = allProducts.filter(p => p.id !== id);
                if (editingProductId === id) resetProductForm();
            } else if (type === 'testimonial') {
                await loadTestimonials();
            } else {
                await loadCategoriesAndModels();
            }
            renderCurrentSection();
        }
    } catch(e) {
        showToast('تعذر الحذف', 'error');
    }
}

function viewProduct(id) {
    const p = allProducts.find(x => x.id === id);
    if (!p) return;

    document.getElementById('view-modal-title').textContent = p.name;
    const price = Number(p.price).toLocaleString('ar-YE');

    document.getElementById('view-modal-content').innerHTML = `
        <img src="${p.image}" alt="${p.name}" class="w-full max-h-60 object-contain rounded-2xl bg-beige" onerror="this.src='https://picsum.photos/400/300?random=${p.id}'">
        <div class="space-y-3">
            <div class="flex items-start justify-between gap-3">
                <h4 class="font-bold text-brown text-lg">${p.name}</h4>
                ${categoryBadgeHTML(p.category)}
            </div>
            <p class="text-wine font-bold text-xl">${price} <span class="text-sm font-normal text-brown-muted">ريال يمني</span></p>
            <p class="text-brown-muted text-sm leading-relaxed">${p.description}</p>
            <div class="flex gap-3 pt-3">
                <button onclick="editProduct(${p.id}); closeViewModal();" class="flex-1 py-2.5 rounded-xl bg-gold text-brown font-bold text-sm"><i class="fas fa-edit"></i> تعديل</button>
                <button onclick="openDeleteModal(${p.id}, '${p.name.replace(/'/g, "\\'")}', 'product'); closeViewModal();" class="flex-1 py-2.5 rounded-xl bg-red-50 text-red-500 font-bold text-sm"><i class="fas fa-trash"></i> حذف</button>
            </div>
        </div>`;

    document.getElementById('view-modal').classList.remove('hidden');
    document.getElementById('view-modal').classList.add('flex');
}

function closeViewModal() {
    document.getElementById('view-modal').classList.add('hidden');
    document.getElementById('view-modal').classList.remove('flex');
}

function setupImageUpload() {
    const fileInput = document.getElementById('product-image-file');
    const preview   = document.getElementById('image-preview');
    const urlInput  = document.getElementById('product-image-url');

    if (preview) preview.addEventListener('click', () => fileInput.click());
    if (fileInput) {
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                uploadedImageBase64 = e.target.result;
                showImagePreview(uploadedImageBase64);
            };
            reader.readAsDataURL(file);
        });
    }
    if (urlInput) {
        urlInput.addEventListener('input', () => {
            if (urlInput.value.trim()) showImagePreview(urlInput.value.trim());
        });
    }
}

function showImagePreview(src) {
    document.getElementById('image-placeholder').classList.add('hidden');
    const img = document.getElementById('image-preview-img');
    img.src = src;
    img.classList.remove('hidden');
}

function resetImagePreview() {
    document.getElementById('image-placeholder').classList.remove('hidden');
    const img = document.getElementById('image-preview-img');
    img.classList.add('hidden');
    img.src = '';
}

function setupFormSubmit() {
    const form = document.getElementById('product-form');
    if (form) form.addEventListener('submit', handleProductFormSubmit);
}

async function handleProductFormSubmit(e) {
    e.preventDefault();

    const name     = document.getElementById('product-name').value.trim();
    const price    = parseFloat(document.getElementById('product-price').value);
    const category = document.getElementById('product-category').value;
    const modelId  = document.getElementById('product-model').value;
    const desc     = document.getElementById('product-desc').value.trim();
    const urlImg   = document.getElementById('product-image-url')?.value.trim();

    if (!name || !price || !category || !desc) {
        showToast('يرجى استكمال الحقول المطلوبة!', 'warning');
        return;
    }

    const btn = document.getElementById('form-submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<div class="spinner !w-5 !h-5 !border-2 mx-auto"></div>';

    let imageUrl = urlImg || uploadedImageBase64 || '';
    if (!imageUrl && editingProductId) {
        const oldP = allProducts.find(p => p.id === editingProductId);
        if (oldP) imageUrl = oldP.image;
    }

    const payload = {
        id: editingProductId,
        name,
        price,
        category,
        model_id: modelId || null,
        description: desc,
        image: imageUrl
    };

    try {
        const res = await fetch(BASE_API_URL + 'products.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await res.json();

        if (data.success) {
            showToast(data.message || 'تم حفظ التغييرات بنجاح!', 'success');
            await fetchProductsFromAPI();
            resetProductForm();
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-plus-circle"></i> <span>حفظ وإضافة العباية</span>';
            setTimeout(() => showSection('products'), 300);
            return;
        }
    } catch(e) {
        showToast('تعذر الاتصال بالسيرفر', 'warning');
    }

    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-plus-circle"></i> <span>حفظ وإضافة العباية</span>';
}

function editProduct(id) {
    const p = allProducts.find(x => x.id === id);
    if (!p) return;

    editingProductId = id;

    document.getElementById('product-name').value     = p.name;
    document.getElementById('product-price').value    = p.price;
    document.getElementById('product-category').value = p.category;
    if (p.model_id) document.getElementById('product-model').value = p.model_id;
    document.getElementById('product-desc').value     = p.description;
    document.getElementById('product-image-url').value = '';

    showImagePreview(p.image);
    uploadedImageBase64 = '';

    document.getElementById('form-title').textContent  = 'تعديل بيانات العباية';
    document.getElementById('form-icon').className     = 'fas fa-edit text-gold';
    document.getElementById('submit-icon').className   = 'fas fa-save';
    document.getElementById('submit-text').textContent = 'حفظ التعديلات في MySQL';
    document.getElementById('btn-cancel-edit').classList.remove('hidden');
    document.getElementById('btn-cancel-edit').classList.add('flex');

    showSection('add');
}

function resetProductForm() {
    editingProductId    = null;
    uploadedImageBase64 = '';

    const form = document.getElementById('product-form');
    if (form) form.reset();
    resetImagePreview();

    document.getElementById('form-title').textContent  = 'إضافة عباية جديدة';
    document.getElementById('form-icon').className     = 'fas fa-plus text-gold';
    document.getElementById('submit-icon').className   = 'fas fa-plus-circle';
    document.getElementById('submit-text').textContent = 'حفظ وإضافة العباية في MySQL';
    document.getElementById('btn-cancel-edit').classList.add('hidden');
    document.getElementById('btn-cancel-edit').classList.remove('flex');
}

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const isOpen  = !sidebar.classList.contains('translate-x-full');
    if (isOpen) {
        sidebar.classList.add('translate-x-full');
        overlay.classList.add('hidden');
    } else {
        sidebar.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
    }
}

function categoryBadgeHTML(category) {
    const map = {
        'الأكثر طلباً': 'bg-red-50 text-red-600 border-red-100',
        'آخر الوافدين': 'bg-amber-50 text-amber-700 border-amber-100',
        'الكلاسيكية':   'bg-purple-50 text-purple-600 border-purple-100',
    };
    const cls = map[category] || 'bg-gray-50 text-gray-600 border-gray-100';
    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border ${cls}">${category}</span>`;
}

function showToast(message, type = 'success') {
    const colors = { success: 'bg-green-600', error: 'bg-red-600', warning: 'bg-amber-500', info: 'bg-blue-600' };
    const icons  = { success: 'fa-circle-check', error: 'fa-circle-xmark', warning: 'fa-triangle-exclamation', info: 'fa-circle-info' };
    const container = document.getElementById('toast-container');
    const id = 'toast-' + Date.now();

    const toast = document.createElement('div');
    toast.id = id;
    toast.className = `toast flex items-center gap-3 ${colors[type]} text-white px-5 py-3.5 rounded-2xl shadow-xl text-sm font-semibold min-w-64 max-w-xs`;
    toast.innerHTML = `
        <i class="fas ${icons[type]} text-lg flex-shrink-0"></i>
        <span class="flex-1">${message}</span>
        <button onclick="dismissToast('${id}')" class="opacity-60 hover:opacity-100"><i class="fas fa-times text-xs"></i></button>`;

    container.appendChild(toast);
    void toast.offsetWidth;
    toast.classList.add('show');
    setTimeout(() => dismissToast(id), 3500);
}

function dismissToast(id) {
    const t = document.getElementById(id);
    if (t) { t.classList.remove('show'); setTimeout(() => t.remove(), 400); }
}

window.showSection        = showSection;
window.editProduct        = editProduct;
window.viewProduct        = viewProduct;
window.openDeleteModal    = openDeleteModal;
window.closeDeleteModal   = closeDeleteModal;
window.closeViewModal     = closeViewModal;
window.confirmDelete      = confirmDelete;
window.handleLogout       = handleLogout;
window.resetProductForm   = resetProductForm;
window.refreshData        = refreshData;
window.toggleSidebar      = toggleSidebar;
window.dismissToast       = dismissToast;
window.saveCategory       = saveCategory;
window.editCategory       = editCategory;
window.resetCategoryForm  = resetCategoryForm;
window.saveModel          = saveModel;
window.editModel          = editModel;
window.resetModelForm     = resetModelForm;

/* Testimonials CRUD JS */
async function loadTestimonials() {
    try {
        const res = await fetch(BASE_API_URL + 'testimonials.php');
        const data = await res.json();
        testimonialsList = Array.isArray(data) ? data : [];
    } catch(e) {
        testimonialsList = [];
    }
    renderTestimonialsTable();
}

function renderTestimonialsTable() {
    const tbody = document.getElementById('testimonials-table-body');
    const count = document.getElementById('testi-table-count');
    const navCount = document.getElementById('nav-testi-count');

    if (count) count.textContent = `${testimonialsList.length} رأي`;
    if (navCount) navCount.textContent = testimonialsList.length;

    if (!tbody) return;
    if (testimonialsList.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="py-8 text-center text-brown-muted">لا توجد آراء مسجلة حتى الآن.</td></tr>`;
        return;
    }

    tbody.innerHTML = testimonialsList.map((t, idx) => {
        const stars = '⭐'.repeat(t.rating || 5);
        return `
        <tr class="border-b border-gray-50 hover:bg-beige/40">
            <td class="px-4 py-3 font-mono text-xs text-brown-muted">${idx + 1}</td>
            <td class="px-4 py-3 font-bold text-brown text-sm">
                <div>${t.customer_name}</div>
                <div class="text-[11px] font-normal text-brown-muted">${t.city || ''}</div>
            </td>
            <td class="px-4 py-3 text-xs">${stars}</td>
            <td class="px-4 py-3 text-brown-muted text-xs max-w-xs truncate" title="${(t.content || '').replace(/"/g, '&quot;')}">${t.content || ''}</td>
            <td class="px-4 py-3 text-center">
                <div class="flex items-center justify-center gap-2">
                    <button onclick="editTestimonial(${t.id})" class="px-3 py-1.5 rounded-lg bg-gold/10 text-brown text-xs font-semibold"><i class="fas fa-edit"></i> تعديل</button>
                    <button onclick="openDeleteModal(${t.id}, '${(t.customer_name || '').replace(/'/g, "\\'")}', 'testimonial')" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-semibold"><i class="fas fa-trash"></i> حذف</button>
                </div>
            </td>
        </tr>
    `;
    }).join('');
}

async function saveTestimonial(e) {
    e.preventDefault();
    const id       = document.getElementById('testi-id').value;
    const name     = document.getElementById('testi-name').value.trim();
    const city     = document.getElementById('testi-city').value.trim();
    const rating   = parseInt(document.getElementById('testi-rating').value) || 5;
    const content  = document.getElementById('testi-content').value.trim();

    if (!name || !content) return;

    try {
        const res = await fetch(BASE_API_URL + 'testimonials.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id || null, customer_name: name, city, rating, content })
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message || 'تم حفظ رأي العميل بنجاح!', 'success');
            await loadTestimonials();
            resetTestimonialForm();
        } else {
            showToast(data.error || 'تعذر الحفظ', 'error');
        }
    } catch(err) {
        showToast('تعذر الاتصال بالسيرفر', 'error');
    }
}

function editTestimonial(id) {
    const t = testimonialsList.find(x => x.id === id);
    if (!t) return;

    document.getElementById('testi-id').value      = t.id;
    document.getElementById('testi-name').value    = t.customer_name;
    document.getElementById('testi-city').value    = t.city || '';
    document.getElementById('testi-rating').value  = t.rating || 5;
    document.getElementById('testi-content').value = t.content;

    document.getElementById('testi-form-title').innerHTML = '<i class="fas fa-edit text-gold"></i> تعديل رأي العميل';
    document.getElementById('btn-cancel-testi').classList.remove('hidden');
}

function resetTestimonialForm() {
    document.getElementById('testi-id').value      = '';
    document.getElementById('testi-name').value    = '';
    document.getElementById('testi-city').value    = '';
    document.getElementById('testi-rating').value  = '5';
    document.getElementById('testi-content').value = '';
    document.getElementById('testi-form-title').innerHTML = '<i class="fas fa-comment-dots text-gold"></i> إضافة رأي عميل جديد';
    document.getElementById('btn-cancel-testi').classList.add('hidden');
}

window.loadTestimonials     = loadTestimonials;
window.saveTestimonial      = saveTestimonial;
window.editTestimonial      = editTestimonial;
window.resetTestimonialForm = resetTestimonialForm;

/* Site Settings & Logo JS */
let siteSettingsData = {};

async function loadSiteSettings() {
    try {
        const res = await fetch(BASE_API_URL + 'settings.php');
        siteSettingsData = await res.json();
        populateSettingsForm();
    } catch(e) {
        console.error('Failed to load settings:', e);
    }
}

function populateSettingsForm() {
    if (!siteSettingsData) return;
    if (document.getElementById('setting-whatsapp-number')) {
        document.getElementById('setting-whatsapp-number').value = siteSettingsData.whatsapp_number || '';
        document.getElementById('setting-phone-number').value    = siteSettingsData.phone_number || '';
        document.getElementById('setting-instagram-url').value    = siteSettingsData.instagram_url || '';
        document.getElementById('setting-facebook-url').value     = siteSettingsData.facebook_url || '';
        document.getElementById('setting-tiktok-url').value       = siteSettingsData.tiktok_url || '';
        document.getElementById('setting-snapchat-url').value     = siteSettingsData.snapchat_url || '';
        document.getElementById('setting-address-text').value     = siteSettingsData.address_text || '';
        document.getElementById('setting-work-hours').value       = siteSettingsData.work_hours || '';
        document.getElementById('setting-site-logo').value        = siteSettingsData.site_logo || '';
    }
    const preview = document.getElementById('setting-logo-preview');
    if (preview && siteSettingsData.site_logo) {
        const logoUrl = siteSettingsData.site_logo.startsWith('http') ? siteSettingsData.site_logo : ('../' + siteSettingsData.site_logo);
        preview.src = logoUrl;
    }
}

function previewLogoFile(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('setting-logo-preview');
        if (preview) preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

async function saveSiteSettings(e) {
    if (e) e.preventDefault();
    
    const formData = new FormData();
    const logoFileInput = document.getElementById('setting-logo-file');
    if (logoFileInput && logoFileInput.files[0]) {
        formData.append('logo_file', logoFileInput.files[0]);
    }
    
    formData.append('whatsapp_number', document.getElementById('setting-whatsapp-number').value.trim());
    formData.append('phone_number',    document.getElementById('setting-phone-number').value.trim());
    formData.append('instagram_url',   document.getElementById('setting-instagram-url').value.trim());
    formData.append('facebook_url',    document.getElementById('setting-facebook-url').value.trim());
    formData.append('tiktok_url',      document.getElementById('setting-tiktok-url').value.trim());
    formData.append('snapchat_url',    document.getElementById('setting-snapchat-url').value.trim());
    formData.append('address_text',    document.getElementById('setting-address-text').value.trim());
    formData.append('work_hours',      document.getElementById('setting-work-hours').value.trim());
    
    try {
        const res = await fetch(BASE_API_URL + 'settings.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showToast(data.message || 'تم حفظ إعدادات الهوية والتواصل بنجاح! 🌿', 'success');
            await loadSiteSettings();
        } else {
            showToast(data.error || 'تعذر حفظ الإعدادات', 'error');
        }
    } catch(err) {
        showToast('تعذر الاتصال بالسيرفر لحفظ الإعدادات', 'error');
    }
}

window.loadSiteSettings = loadSiteSettings;
window.saveSiteSettings = saveSiteSettings;
window.previewLogoFile  = previewLogoFile;
</script>

</body>
</html>

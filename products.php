<?php
$currentPage     = 'products';
$pageTitle       = 'تشكيلة العبايات | لارين عباية';
$pageDescription = 'تصفحي أحدث تشكيلات متجر لارين عباية، وقومي بفلترة العبايات بالأسعار والتصنيفات واطلبي مباشرة عبر الواتساب.';
require_once 'includes/header.php';
?>

    <!-- عنوان الصفحة -->
    <section class="section" style="padding-bottom: 20px;">
        <div class="section-header" style="margin-bottom: 20px;">
            <h1 class="section-title">تشكيلة العبايات</h1>
            <p class="section-desc">مجموعتنا الفاخرة المصممة خصيصاً لتناسب شتى الأذواق والمناسبات</p>
        </div>
    </section>

    <!-- شريط الفلترة والبحث -->
    <div class="filter-bar" id="products-filter-bar">
        <div class="search-box">
            <input type="text" id="search-input" class="search-input" placeholder="ابحثي عن عباية بالاسم أو الوصف...">
            <i class="fas fa-search search-icon"></i>
        </div>

        <div class="filters-group">
            <select id="category-filter" class="filter-select">
                <option value="all">جميع الأقسام</option>
                <option value="الأكثر طلباً">الأكثر طلباً</option>
                <option value="آخر الوافدين">آخر الوافدين</option>
                <option value="الكلاسيكية">الكلاسيكية</option>
            </select>

            <select id="price-filter" class="filter-select">
                <option value="default">ترتيب بحسب</option>
                <option value="newest">الأحدث أولاً</option>
                <option value="price-asc">السعر: من الأقل للأعلى</option>
                <option value="price-desc">السعر: من الأعلى للأقل</option>
            </select>
        </div>
    </div>

    <!-- شبكة المنتجات -->
    <section class="section" style="padding-top: 0; min-height: 400px;">
        <div class="products-grid" id="all-products-container">
            <div class="loading-spinner" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>جاري جلب أحدث تصاميم العبايات...</p>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>

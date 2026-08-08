<?php
/**
 * admin/views/categories/index.php
 * واجهة إدارة الأقسام (Category CRUD Component)
 */
?>
<section id="section-categories" class="hidden flex-1 p-6 space-y-6 animate-fade-in">
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Category Form -->
        <div class="bg-white rounded-2xl shadow-sm p-6 h-fit">
            <h3 class="font-bold text-brown text-base mb-4 flex items-center gap-2" id="cat-form-title">
                <i class="fas fa-plus-circle text-gold"></i> إضافة قسم جديد
            </h3>
            <form id="category-form" onsubmit="saveCategory(event)" class="space-y-4">
                <input type="hidden" id="cat-id">
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">اسم القسم <span class="text-red-500">*</span></label>
                    <input type="text" id="cat-name" required placeholder="مثال: عبايات سهرة" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">الوصف</label>
                    <textarea id="cat-desc" rows="3" placeholder="وصف مقتضب للقسم..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm resize-none"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-gold to-gold-hover text-brown font-bold py-2.5 rounded-xl text-sm hover:shadow-md transition-all">حفظ القسم</button>
                    <button type="button" id="btn-cancel-cat" onclick="resetCategoryForm()" class="hidden px-4 py-2.5 border border-wine text-wine rounded-xl text-sm font-semibold">إلغاء</button>
                </div>
            </form>
        </div>

        <!-- Category Table -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gold/10 flex items-center justify-between">
                <h3 class="font-bold text-brown text-base">الأقسام المتاحة في قاعدة البيانات</h3>
                <span class="text-xs text-brown-muted" id="cat-table-count">0 قسم</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-beige text-brown text-right">
                            <th class="px-4 py-3 font-semibold">#</th>
                            <th class="px-4 py-3 font-semibold">اسم القسم</th>
                            <th class="px-4 py-3 font-semibold">الوصف</th>
                            <th class="px-4 py-3 font-semibold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="categories-table-body">
                        <!-- Populated dynamically via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

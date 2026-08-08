<?php
/**
 * admin/views/models/index.php
 * واجهة إدارة الموديلات والتصاميم (Model CRUD Component)
 */
?>
<section id="section-models" class="hidden flex-1 p-6 space-y-6 animate-fade-in">
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Model Form -->
        <div class="bg-white rounded-2xl shadow-sm p-6 h-fit">
            <h3 class="font-bold text-brown text-base mb-4 flex items-center gap-2" id="mod-form-title">
                <i class="fas fa-plus-circle text-gold"></i> إضافة موديل جديد
            </h3>
            <form id="model-form" onsubmit="saveModel(event)" class="space-y-4">
                <input type="hidden" id="mod-id">
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">اسم الموديل/التصميم <span class="text-red-500">*</span></label>
                    <input type="text" id="mod-name" required placeholder="مثال: موديل نص كلوش" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">الوصف والتفاصيل</label>
                    <textarea id="mod-desc" rows="3" placeholder="وصف طبيعة هذا الموديل..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm resize-none"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-gold to-gold-hover text-brown font-bold py-2.5 rounded-xl text-sm hover:shadow-md transition-all">حفظ الموديل</button>
                    <button type="button" id="btn-cancel-mod" onclick="resetModelForm()" class="hidden px-4 py-2.5 border border-wine text-wine rounded-xl text-sm font-semibold">إلغاء</button>
                </div>
            </form>
        </div>

        <!-- Model Table -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gold/10 flex items-center justify-between">
                <h3 class="font-bold text-brown text-base">قائمة الموديلات الحالية</h3>
                <span class="text-xs text-brown-muted" id="mod-table-count">0 موديل</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-beige text-brown text-right">
                            <th class="px-4 py-3 font-semibold">#</th>
                            <th class="px-4 py-3 font-semibold">اسم الموديل</th>
                            <th class="px-4 py-3 font-semibold">الوصف</th>
                            <th class="px-4 py-3 font-semibold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="models-table-body">
                        <!-- Populated dynamically via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

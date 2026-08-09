<?php
/**
 * admin/views/testimonials/index.php
 * واجهة إدارة آراء العملاء (Testimonials CRUD Component)
 */
?>
<section id="section-testimonials" class="hidden flex-1 p-6 space-y-6 animate-fade-in">
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Testimonial Form -->
        <div class="bg-white rounded-2xl shadow-sm p-6 h-fit">
            <h3 class="font-bold text-brown text-base mb-4 flex items-center gap-2" id="testi-form-title">
                <i class="fas fa-comment-dots text-gold"></i> إضافة رأي عميل جديد
            </h3>
            <form id="testimonial-form" onsubmit="saveTestimonial(event)" class="space-y-4">
                <input type="hidden" id="testi-id">
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">اسم العميل <span class="text-red-500">*</span></label>
                    <input type="text" id="testi-name" required placeholder="مثال: أم خالد" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">المدينة / الملاحظة</label>
                    <input type="text" id="testi-city" placeholder="مثال: صنعاء — عميلة منذ 2022" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">التقييم بالنجوم</label>
                    <select id="testi-rating" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm bg-white text-brown">
                        <option value="5" selected>⭐⭐⭐⭐⭐ (5 نجوم)</option>
                        <option value="4">⭐⭐⭐⭐ (4 نجوم)</option>
                        <option value="3">⭐⭐⭐ (3 نجوم)</option>
                        <option value="2">⭐⭐ (نجمتان)</option>
                        <option value="1">⭐ (نجمة واحدة)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-brown mb-1">نص الرأي والتقييم <span class="text-red-500">*</span></label>
                    <textarea id="testi-content" required rows="4" placeholder="اكتبي نص رأي العميل هنا..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm resize-none"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-gold to-gold-hover text-brown font-bold py-2.5 rounded-xl text-sm hover:shadow-md transition-all">حفظ الرأي</button>
                    <button type="button" id="btn-cancel-testi" onclick="resetTestimonialForm()" class="hidden px-4 py-2.5 border border-wine text-wine rounded-xl text-sm font-semibold">إلغاء</button>
                </div>
            </form>
        </div>

        <!-- Testimonial Table -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gold/10 flex items-center justify-between">
                <h3 class="font-bold text-brown text-base">آراء العملاء في قاعدة البيانات</h3>
                <span class="text-xs text-brown-muted" id="testi-table-count">0 رأي</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-beige text-brown text-right">
                            <th class="px-4 py-3 font-semibold">#</th>
                            <th class="px-4 py-3 font-semibold">العميل</th>
                            <th class="px-4 py-3 font-semibold">التقييم</th>
                            <th class="px-4 py-3 font-semibold">نص الرأي</th>
                            <th class="px-4 py-3 font-semibold text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="testimonials-table-body">
                        <!-- Populated dynamically via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

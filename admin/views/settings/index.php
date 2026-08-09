<?php
/**
 * admin/views/settings/index.php
 * واجهة إعدادات المتجر والشعار وأيقونات التواصل الاجتماعي
 */
?>
<section id="section-settings" class="hidden flex-1 p-6 space-y-6 animate-fade-in">
    <div class="bg-white rounded-2xl shadow-sm p-6 space-y-6">
        <div class="flex items-center justify-between border-b border-gold/10 pb-4">
            <div>
                <h3 class="font-bold text-brown text-lg flex items-center gap-2">
                    <i class="fas fa-sliders text-gold"></i> إعدادات الهوية والشعار والتواصل الاجتماعي
                </h3>
                <p class="text-xs text-brown-muted mt-1">تحديد شعار المتجر، أرقام التواصل، وروبط الشبكات الاجتماعية الديناميكية</p>
            </div>
            <button onclick="saveSiteSettings(event)" class="bg-gradient-to-r from-gold to-gold-hover text-brown font-bold px-5 py-2.5 rounded-xl text-sm hover:shadow-md transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> حفظ جميع الإعدادات
            </button>
        </div>

        <form id="settings-form" onsubmit="saveSiteSettings(event)" class="space-y-8">
            <!-- 1. الشعار والهوية البصرية -->
            <div class="space-y-4">
                <h4 class="font-bold text-brown text-base flex items-center gap-2 border-r-4 border-gold pr-3">
                    <i class="fas fa-image text-gold"></i> شعار المتجر (Site Logo)
                </h4>
                
                <div class="grid md:grid-cols-3 gap-6 items-center bg-beige/30 p-4 rounded-2xl border border-gold/10">
                    <div class="text-center space-y-2">
                        <label class="block text-xs font-bold text-brown">الشعار الحالي / المعاينة</label>
                        <div class="w-40 h-24 mx-auto bg-white rounded-xl border border-gray-200 p-2 flex items-center justify-center overflow-hidden shadow-inner">
                            <img id="setting-logo-preview" src="../assets/images/logo.png" alt="شعار المتجر" class="max-h-full max-w-full object-contain" onerror="this.src='https://placehold.co/200x80/0b4f3a/c5a059?text=Lareen+Abaya'">
                        </div>
                    </div>
                    
                    <div class="md:col-span-2 space-y-3">
                        <label class="block text-sm font-semibold text-brown">رفع شعار جديد للمتجر</label>
                        <input type="file" id="setting-logo-file" accept="image/*" onchange="previewLogoFile(event)" class="block w-full text-xs text-brown file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gold/20 file:text-brown hover:file:bg-gold/30 cursor-pointer">
                        <p class="text-[11px] text-brown-muted">يُفضل استخدام صورة شفافة (PNG / SVG) بأبعاد متناسبة للجزء العلوي من الموقع.</p>
                        <input type="hidden" id="setting-site-logo" value="assets/images/logo.png">
                    </div>
                </div>
            </div>

            <!-- 2. روابط شبكات التواصل الاجتماعي -->
            <div class="space-y-4">
                <h4 class="font-bold text-brown text-base flex items-center gap-2 border-r-4 border-gold pr-3">
                    <i class="fas fa-share-nodes text-gold"></i> شبكات التواصل الاجتماعي الديناميكية
                </h4>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <!-- WhatsApp -->
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown flex items-center gap-1.5">
                            <i class="fab fa-whatsapp text-green-500 text-sm"></i> رقم الواتساب الموحد (مع الرمز الدولي)
                        </label>
                        <input type="text" id="setting-whatsapp-number" placeholder="مثال: 967773185534" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm dir-ltr text-right">
                    </div>

                    <!-- Phone Number -->
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown flex items-center gap-1.5">
                            <i class="fas fa-phone-alt text-gold text-sm"></i> رقم الاتصال المباشر
                        </label>
                        <input type="text" id="setting-phone-number" placeholder="مثال: 773185534" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm dir-ltr text-right">
                    </div>

                    <!-- Instagram -->
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown flex items-center gap-1.5">
                            <i class="fab fa-instagram text-pink-500 text-sm"></i> رابط حساب انستغرام (Instagram)
                        </label>
                        <input type="url" id="setting-instagram-url" placeholder="https://instagram.com/..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm dir-ltr text-right">
                    </div>

                    <!-- Facebook -->
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown flex items-center gap-1.5">
                            <i class="fab fa-facebook text-blue-600 text-sm"></i> رابط صفحة فيسبوك (Facebook)
                        </label>
                        <input type="url" id="setting-facebook-url" placeholder="https://facebook.com/..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm dir-ltr text-right">
                    </div>

                    <!-- TikTok -->
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown flex items-center gap-1.5">
                            <i class="fab fa-tiktok text-black text-sm"></i> رابط حساب تيك توك (TikTok)
                        </label>
                        <input type="url" id="setting-tiktok-url" placeholder="https://tiktok.com/@..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm dir-ltr text-right">
                    </div>

                    <!-- Snapchat -->
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown flex items-center gap-1.5">
                            <i class="fab fa-snapchat-ghost text-amber-500 text-sm"></i> رابط حساب سناب شات (Snapchat)
                        </label>
                        <input type="url" id="setting-snapchat-url" placeholder="https://snapchat.com/add/..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm dir-ltr text-right">
                    </div>
                </div>
            </div>

            <!-- 3. معلومات المحل والعنوان -->
            <div class="space-y-4">
                <h4 class="font-bold text-brown text-base flex items-center gap-2 border-r-4 border-gold pr-3">
                    <i class="fas fa-map-location-dot text-gold"></i> معلومات المحل والعنوان
                </h4>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown">عنوان المحل المباشر</label>
                        <input type="text" id="setting-address-text" placeholder="مثال: صنعاء - سوق شميلة..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-brown">أوقات وساعات العمل</label>
                        <input type="text" id="setting-work-hours" placeholder="مثال: السبت - الخميس: 9:00 صباحاً..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-gold focus:outline-none text-sm">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gold/10 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-gold to-gold-hover text-brown font-bold px-8 py-3 rounded-xl hover:shadow-lg transition-all flex items-center gap-2 text-sm">
                    <i class="fas fa-check-circle"></i> حفظ وتطبيق التغييرات
                </button>
            </div>
        </form>
    </div>
</section>

<?php
$currentPage     = 'contact';
$pageTitle       = 'اتصلي بنا | لارين عباية';
$pageDescription = 'تواصل معنا للاستفسار أو طلبات العبايات المخصصة. انسخي رقم الهاتف للتواصل المباشر، أو راسلينا عبر واتساب.';
require_once 'includes/header.php';
?>

    <!-- محتوى صفحة الاتصال -->
    <main class="section">
        <div class="section-header">
            <h1 class="section-title">تواصل معنا</h1>
            <p class="section-desc">يسعدنا الإجابة على استفساراتكِ واستقبال طلباتكِ وتفصيل عبايتكِ الخاصة</p>
        </div>

        <div class="contact-wrapper">
            <!-- كروت معلومات الاتصال -->
            <div class="contact-info-cards">
                <!-- كرت الاتصال الهاتفي -->
                <div class="contact-card fade-in-element delay-1">
                    <div class="contact-card-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="contact-card-body">
                        <h3>الاتصال الهاتفي المباشر</h3>
                        <p>تفضلي بالاتصال بنا مباشرة أو الاستفسار هاتفياً على رقم المحل الموحد.</p>
                        <div class="phone-action-group">
                            <span class="btn btn-secondary btn-small" style="background-color: var(--color-beige); color: var(--color-text-dark); border-color: var(--color-gray-border); font-family: monospace; letter-spacing: 1px; font-size: 1.1rem; padding: 6px 15px;">773185534</span>
                            <button onclick="copyPhoneNumber()" class="btn btn-primary btn-small btn-copy"><i class="fas fa-copy"></i> نسخ الرقم</button>
                        </div>
                    </div>
                </div>

                <!-- كرت الواتساب -->
                <div class="contact-card fade-in-element delay-2">
                    <div class="contact-card-icon" style="background-color: rgba(37, 211, 102, 0.1); color: var(--color-whatsapp);"><i class="fab fa-whatsapp"></i></div>
                    <div class="contact-card-body" style="width: 100%;">
                        <h3>المحادثة المباشرة عبر واتساب</h3>
                        <p>تواصل سريع ومباشر على مدار الساعة للطلبات والاستفسارات وخدمة تفصيل المقاسات الخاصة.</p>
                        <button onclick="openGeneralWhatsAppChat()" class="btn btn-whatsapp" style="width: auto; padding: 8px 20px;"><i class="fab fa-whatsapp"></i> تواصل عبر واتساب</button>
                    </div>
                </div>

                <!-- كرت التواصل الاجتماعي والموقع -->
                <div class="contact-card fade-in-element delay-3">
                    <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-card-body">
                        <h3>معرضنا في صنعاء</h3>
                        <p>صنعاء - سوق شميلة التجاري - شارع 2 - بجوار العلوي للعبايات.</p>
                        <p style="font-size: 0.85rem; margin-top: 5px;"><strong>سوشيال ميديا:</strong> تابعينا للمزيد من العروض المباشرة.</p>
                        <div class="social-links-row">
                            <a href="https://instagram.com" target="_blank" class="social-icon-btn social-instagram" aria-label="انستغرام"><i class="fab fa-instagram"></i></a>
                            <a href="https://facebook.com"  target="_blank" class="social-icon-btn social-facebook"  aria-label="فيسبوك"><i class="fab fa-facebook"></i></a>
                            <a href="https://tiktok.com"    target="_blank" class="social-icon-btn social-tiktok"    aria-label="تيك توك"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- نموذج تواصل بسيط -->
            <div class="contact-form-card fade-in-element delay-4">
                <h2>أرسلي لنا رسالة</h2>
                <form id="contact-us-form" onsubmit="handleContactSubmit(event)">
                    <div class="form-group">
                        <label for="contact-name" class="form-label">الاسم الكريم *</label>
                        <input type="text" id="contact-name" class="form-control" placeholder="اكتبي اسمكِ هنا" required>
                    </div>

                    <div class="form-group">
                        <label for="contact-email" class="form-label">البريد الإلكتروني (اختياري)</label>
                        <input type="email" id="contact-email" class="form-control" placeholder="name@domain.com">
                    </div>

                    <div class="form-group">
                        <label for="contact-message" class="form-label">تفاصيل الرسالة أو الطلب المخصص *</label>
                        <textarea id="contact-message" class="form-control" placeholder="اكتبي استفساركِ أو تفاصيل طلبكِ من قماش، مقاسات أو تصميم هنا..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px;"><i class="fas fa-paper-plane"></i> إرسال الرسالة</button>
                </form>
            </div>
        </div>
    </main>

<?php
$extraScripts = <<<JS
<script>
    function copyPhoneNumber() {
        navigator.clipboard.writeText("773185534").then(() => {
            alert("تم نسخ الرقم (773185534) بنجاح!");
        }).catch(err => console.error("خطأ في نسخ الرقم:", err));
    }
    function handleContactSubmit(e) {
        e.preventDefault();
        const name = document.getElementById('contact-name').value.trim();
        alert("شكراً لتواصلكِ يا " + name + "! سنقوم بالرد عليكِ في أقرب وقت ممكن.");
        document.getElementById('contact-us-form').reset();
    }
</script>
JS;
require_once 'includes/footer.php';
?>

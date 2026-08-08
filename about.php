<?php
$currentPage     = 'about';
$pageTitle       = 'عن المحل | لارين عباية';
$pageDescription = 'تعرفي على قصة لارين عباية، رؤيتنا في تقديم أرقى التصاميم، وتفضلي بزيارة معرضنا في سوق شميلة بصنعاء.';
require_once 'includes/header.php';
?>

    <!-- محتوى صفحة عن المحل -->
    <main class="section">
        <div class="about-container">

            <div class="section-header">
                <h1 class="section-title">من نحن وقصتنا</h1>
                <p class="section-desc">المسيرة المكللة بالنجاح في تقديم أفضل تصاميم العبايات بالعاصمة صنعاء</p>
            </div>

            <!-- شبكة المقدمة والصور -->
            <div class="about-intro-grid">
                <!-- معرض الصور المصغر للمحل -->
                <div class="about-shop-images">
                    <div class="about-img-item">
                        <img src="assets/images/shop-photo1.jpg" alt="داخل معرض لارين عباية" onerror="this.src='https://picsum.photos/400/400?random=200'">
                    </div>
                    <div class="about-img-item">
                        <img src="assets/images/shop-photo2.jpg" alt="عبايات معروضة في المحل" onerror="this.src='https://picsum.photos/400/400?random=300'">
                    </div>
                </div>

                <!-- نص القصة والتعريف -->
                <div class="about-text">
                    <h2>لارين عباية.. رمز التميز</h2>
                    <p>
                        تأسس متجر <strong>لارين عباية (Lareen Abaya)</strong> في قلب العاصمة صنعاء كعلامة تجارية متخصصة في تقديم أحدث صيحات الموضة العربية والخليجية لخطوط العبايات الفاخرة. رؤيتنا تقوم على دمج الحشمة والوقار بالتصاميم المبتكرة والمتميزة التي تلفت الأنظار، مع المحافظة على دقة التفاصيل اليدوية.
                    </p>
                    <p>
                        نحن لا نبيع مجرد عباءة، بل نقدم لكِ تجربة فريدة وثقة تدوم طويلاً، حيث نختار أرقى الأقمشة الكورية واليابانية المقاومة للتجعد والحرارة لضمان راحتكِ التامة في الاستخدام اليومي أو المناسبات الخاصة.
                    </p>

                    <!-- أبرز المميزات -->
                    <div class="about-highlights">
                        <div class="highlight-box">
                            <i class="fas fa-gem"></i>
                            <h4>أقمشة ملكية فاخرة</h4>
                            <p>حرير طبيعي، كريب ياباني، وشيفونات كورية مستوردة.</p>
                        </div>
                        <div class="highlight-box">
                            <i class="fas fa-magic"></i>
                            <h4>تطريز وتفصيل مخصص</h4>
                            <p>نهتم بالتفاصيل والتطريز اليدوي الدقيق الذي يلبي رغبتكِ.</p>
                        </div>
                        <div class="highlight-box">
                            <i class="fas fa-hand-holding-heart"></i>
                            <h4>خدمة زبائن مميزة</h4>
                            <p>تواصل سريع ودفع مرن وتجربة تسوق مريحة للغاية.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم الخريطة والعنوان بدقة -->
            <div class="map-section">
                <div class="section-header" style="margin-bottom: 30px;">
                    <h2 class="section-title">موقع المعرض</h2>
                    <p class="section-desc">يسعدنا ويشرفنا استقبالكم في صالة عرض لارين عباية بصنعاء</p>
                </div>

                <div class="map-card">
                    <div class="map-details">
                        <div class="map-address-info">
                            <h3><i class="fas fa-map-marked-alt" style="color: var(--color-gold);"></i> العنوان التفصيلي:</h3>
                            <p>اليمن، صنعاء - سوق شميلة التجاري - شارع 2 - بجوار العلوي للعبايات</p>
                        </div>
                        <div class="map-work-hours">
                            <p><strong><i class="fas fa-clock" style="color: var(--color-gold);"></i> ساعات العمل المعتادة:</strong> يومياً من 9:00 صباحاً حتى 9:30 مساءً (الجمعة عصراً فقط)</p>
                        </div>
                    </div>
                    <!-- خريطة سوق شميلة صنعاء -->
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3844.7570498801824!2d44.22557457497184!3d15.308253185012586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1603db0ebc02052f%3A0xe543e498c8c50555!2z2LPZiNmCINi02YXZitmE2Kk!5e0!3m2!1sar!2sye!4v1689728283471!5m2!1sar!2sye"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>
    </main>

<?php require_once 'includes/footer.php'; ?>

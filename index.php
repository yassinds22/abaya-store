<?php
$currentPage     = 'index';
$pageTitle       = 'لارين عباية | الفخامة والأناقة في عالم العبايات';
$pageDescription = 'لارين عباية (Lareen Abaya) - تشكيلة راقية وحصرية من العبايات الملكية، الكلاسيكية والحديثة في صنعاء، سوق شميلة.';
require_once 'includes/header.php';
?>

    <!-- البانر الرئيسي المتحرك (Hero Slider) -->
    <section class="hero-section" id="home-hero-slider">
        <div class="hero-slider">
            <!-- الشريحة الأولى -->
            <div class="slide active" style="background-image: url('assets/images/hero-banner.jpg');">
                <div class="hero-content">
                    <span class="hero-subtitle">تشكيلة جديدة وحصرية</span>
                    <h1>حيث تلتقي الفخامة بالأناقة الملكية</h1>
                    <p>عبايات مصممة خصيصاً لتناسب ذوقكِ الرفيع، تجمع بين الاحتشام، الراحة، وأحدث صيحات الموضة الخليجية الراقية.</p>
                    <div class="hero-buttons">
                        <a href="products.php" class="btn btn-primary">تسوقي الآن <i class="fas fa-shopping-bag"></i></a>
                        <a href="about.php" class="btn btn-secondary">اكتشفي المحل</a>
                    </div>
                </div>
            </div>
            <!-- الشريحة الثانية -->
            <div class="slide" style="background-image: url('assets/images/logo.png');">
                <div class="hero-content">
                    <span class="hero-subtitle">تطريز يدوي فاخر</span>
                    <h1>دقة بالتفاصيل وأرقى الأقمشة الكورية</h1>
                    <p>ننتقي خاماتنا بعناية فائقة لتشعري بالثقة والتميز في كل خطواتك. أسعارنا منافسة وجودتنا مضمونة.</p>
                    <div class="hero-buttons">
                        <a href="products.php" class="btn btn-primary">رؤية العبايات <i class="fas fa-arrow-left"></i></a>
                        <a href="https://wa.me/967773185534" id="hero-whatsapp-contact-link" onclick="openGeneralWhatsAppChat(); return false;" class="btn btn-whatsapp" title="تواصلي معنا الآن عبر الواتساب">
                            <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor" style="vertical-align: text-bottom; margin-left: 6px;"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                            <i class="fab fa-whatsapp"></i> تواصلي معنا الآن
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- نقاط تحكم السلايدر -->
        <div class="slider-controls" id="slider-dot-controls">
            <!-- سيتم توليدها تلقائياً بالـ JavaScript -->
        </div>
    </section>

    <!-- قسم أيقونات التواصل الاجتماعي الموسطة (أيقونات دائرية فقط) -->
    <section class="section social-bar-section" id="hero-social-bar-section">
        <div class="container" style="text-align: center;">
            <div class="social-bar-wrapper">
                <a href="https://wa.me/967773185534" id="hero-social-whatsapp" onclick="openGeneralWhatsAppChat(); return false;" class="social-bar-btn social-wa" title="واتساب" aria-label="واتساب">
                    <svg width="24" height="24" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                </a>
                <a href="https://instagram.com" id="hero-social-instagram" target="_blank" class="social-bar-btn social-insta" title="انستغرام" aria-label="انستغرام">
                    <svg width="24" height="24" viewBox="0 0 448 512" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.9-26.9 26.9-14.9 0-26.9-12-26.9-26.9s12-26.9 26.9-26.9c14.9 0 26.9 12 26.9 26.9zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                </a>
                <a href="https://facebook.com" id="hero-social-facebook" target="_blank" class="social-bar-btn social-fb" title="فيسبوك" aria-label="فيسبوك">
                    <svg width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                </a>
                <a href="https://tiktok.com" id="hero-social-tiktok" target="_blank" class="social-bar-btn social-tt" title="تيك توك" aria-label="تيك توك">
                    <svg width="24" height="24" viewBox="0 0 448 512" fill="currentColor"><path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0l88 0a121.18 121.18 0 0 0 1.86 22.17h.09A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14z"/></svg>
                </a>
                <a href="https://snapchat.com" id="hero-social-snapchat" target="_blank" class="social-bar-btn social-snap" title="سناب شات" aria-label="سناب شات">
                    <svg width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><path d="M256.4 32C167.7 32 112 94.1 112 151.4c0 25.8 10.2 52.6 24.8 68.1 5.3 5.6 5.7 8.8 1.7 15.1-3.4 5.3-10.3 16.1-13.7 21.5-4.2 6.7-10.2 8.5-17.6 5.1-18.3-8.4-35.8-17.2-55.4-16.2-11.7 .6-21.1 9-20.6 22.2 .6 16.4 15.6 25.2 30.3 31 18.1 7.1 39.2 9 56.8 17.5 9.1 4.4 13.2 11.3 9.5 21.3-5.7 15.3-24.1 62.6-25.5 66.2-3.6 9.1 .6 17.3 9.1 19.3 11.2 2.6 23.3 1.2 34.6-1.8 22.1-5.9 41.8-19.3 64-23.9 17-3.5 32 4.4 46.1 13.8 24.8 16.6 52.4 16.8 77.3 .2 13.7-9 28.1-17.1 44.7-13.7 22.3 4.6 42 18 64.1 23.9 11.3 3 23.4 4.4 34.6 1.8 8.5-2 12.7-10.2 9.1-19.3-1.4-3.6-19.8-50.9-25.5-66.2-3.7-10 .4-16.9 9.5-21.3 17.6-8.5 38.7-10.4 56.8-17.5 14.7-5.8 29.7-14.6 30.3-31 .5-13.2-8.9-21.6-20.6-22.2-19.6-1-37.1 7.8-55.4 16.2-7.4 3.4-13.4 1.6-17.6-5.1-3.4-5.4-10.3-16.2-13.7-21.5-4-6.3-3.6-9.5 1.7-15.1 14.6-15.5 24.8-42.3 24.8-68.1C400.8 94.1 345.1 32 256.4 32z"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- قسم آخر الوافدين -->
    <section class="section" id="latest-arrivals-section">
        <div class="section-header">
            <h2 class="section-title">آخر الوافدين</h2>
            <p class="section-desc">أحدث التصاميم والقصات المضافة حديثاً لمتجرنا لتكوني أول المتألقات</p>
        </div>

        <div class="products-grid" id="latest-arrivals-container">
            <div class="loading-spinner" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>جاري تحميل العبايات الفاخرة...</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 50px;">
            <a href="products.php" class="btn btn-primary" style="padding: 15px 40px;">مشاهدة كل المنتجات <i class="fas fa-arrow-left"></i></a>
        </div>
    </section>

    <!-- قسم الأكثر طلباً -->
    <section class="section section-bg-alt" id="best-sellers-section">
        <div class="section-header">
            <h2 class="section-title">الأكثر طلباً</h2>
            <p class="section-desc">مجموعة العبايات الأكثر مبيعاً ونالت إعجاب زبائننا المتميزين</p>
        </div>

        <div class="products-grid" id="best-sellers-container">
            <div class="loading-spinner" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>جاري تحميل المنتجات المفضلة...</p>
            </div>
        </div>
    </section>

    <!-- ===== قسم آراء العملاء ===== -->
    <section class="section testimonials-section" id="customers-reviews-section">
        <div class="section-header">
            <h2 class="section-title">قالوا عنّا العملاء</h2>
            <p class="section-desc">آراء حقيقية من زبائننا الكريمات اللواتي وثّقن تجربتهن معنا</p>
        </div>

        <!-- شريط الإحصاء -->
        <div class="testimonials-stats" id="testimonials-stats-bar">
            <div class="stat-item">
                <span class="stat-number" data-target="500">0</span><span class="stat-plus">+</span>
                <p class="stat-label">عميلة سعيدة</p>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-number" data-target="98">0</span><span class="stat-plus">%</span>
                <p class="stat-label">نسبة الرضا</p>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-number" data-target="4">0</span><span class="stat-plus">+</span>
                <p class="stat-label">سنوات خبرة</p>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-number" data-target="300">0</span><span class="stat-plus">+</span>
                <p class="stat-label">تصميم حصري</p>
            </div>
        </div>

        <!-- سلايدر الآراء -->
        <div class="testimonials-outer" id="testimonials-outer">
            <div class="testimonials-slider-wrapper" id="testimonials-slider-wrapper">
                <div class="testimonials-track" id="testimonials-track">

                <!-- رأي 1 -->
                <div class="testimonial-card" id="review-card-1">
                    <div class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "والله ما توقعت تكون الجودة بهالمستوى! العباية وصلتني بأسرع من المتوقع، الخامة ناعمة جداً والتطريز دقيق ورائع. رح أطلب أكثر من كيس إن شاء الله."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar" aria-label="أم خالد">أ</div>
                        <div class="testimonial-author-info">
                            <strong>أم خالد</strong>
                            <span>صنعاء — عميلة منذ 2022</span>
                        </div>
                    </div>
                </div>

                <!-- رأي 2 -->
                <div class="testimonial-card" id="review-card-2">
                    <div class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "أفضل محل عبايات جربته في صنعاء. الأسعار مناسبة والتصاميم عصرية. البائعات محترمات وصادقات في نصحك. العباية الخليجية اللي اشتريتها تحفة بكل معنى الكلمة."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar testimonial-avatar-2" aria-label="نور الهدى">ن</div>
                        <div class="testimonial-author-info">
                            <strong>نور الهدى</strong>
                            <span>ذمار — عميلة دائمة</span>
                        </div>
                    </div>
                </div>

                <!-- رأي 3 -->
                <div class="testimonial-card" id="review-card-3">
                    <div class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">
                        "طلبت عباية ملكية لحفل الزفاف وكانت مميزة جداً! الكل سألني عنها. التطريز اليدوي يختلف عن أي شيء شفته قبل. شكراً لارين عباية على هذا الإبداع."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar testimonial-avatar-3" aria-label="منى العمري">م</div>
                        <div class="testimonial-author-info">
                            <strong>منى العمري</strong>
                            <span>إب — عروس سعيدة 🌸</span>
                        </div>
                    </div>
                </div>

                <!-- رأي 4 -->
                <div class="testimonial-card" id="review-card-4">
                    <div class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "أول ما شفت صفحتهم على الإنستغرام قلت لازم أجرب، وفعلاً ما خيّبوا ظني. العباية الكورية الخامة جنة! وسعرها معقول مقارنة بجودتها الفائقة."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar testimonial-avatar-4" aria-label="هيفاء">ه</div>
                        <div class="testimonial-author-info">
                            <strong>هيفاء الشميري</strong>
                            <span>صنعاء — عميلة جديدة</span>
                        </div>
                    </div>
                </div>

                <!-- رأي 5 -->
                <div class="testimonial-card" id="review-card-5">
                    <div class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "تعاملت معهم أكثر من مرة ودايم أعود لهم. يعطون النصيحة الصادقة ويساعدونك تختارين المقاس المناسب. الشغل نظيف وما فيه خياطة زائدة أو ناقصة."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar testimonial-avatar-5" aria-label="أسماء">ع</div>
                        <div class="testimonial-author-info">
                            <strong>عائشة الحداد</strong>
                            <span>تعز — عميلة وفية</span>
                        </div>
                    </div>
                </div>

            </div><!-- /testimonials-track -->
        </div><!-- /testimonials-slider-wrapper -->

            <!-- أزرار السلايدر — خارج overflow:hidden -->
            <button class="testimonials-btn testimonials-prev" id="testimonials-prev-btn" aria-label="السابق">
                <i class="fas fa-chevron-right"></i>
            </button>
            <button class="testimonials-btn testimonials-next" id="testimonials-next-btn" aria-label="التالي">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div><!-- /testimonials-outer -->

        <!-- نقاط التنقل -->
        <div class="testimonials-dots" id="testimonials-dots-container" role="tablist" aria-label="آراء العملاء"></div>

    </section>
    <!-- ===== نهاية قسم الآراء ===== -->

    <!-- شريط التواصل السريع -->
    <div class="quick-contact-bar" id="home-quick-contact">
        <div class="quick-contact-text">
            <h3>هل تبحثين عن تصميم مخصص أو مقاس معين؟</h3>
            <p>يمكنكِ مراسلتنا فوراً عبر الواتساب أو تصفح حسابنا لمزيد من التفاصيل اليومية.</p>
        </div>
        <div class="quick-socials">
            <a href="#" onclick="openGeneralWhatsAppChat(); return false;" class="btn btn-whatsapp" style="width: auto; padding: 12px 25px;">
                <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i>
                <span>راسلنا الآن</span>
            </a>
        </div>
    </div>

<?php require_once 'includes/footer.php'; ?>

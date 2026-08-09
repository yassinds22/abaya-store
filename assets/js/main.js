/* main.js - الوظائف المشتركة والتهيئة العامة لموقع لارين عباية */

document.addEventListener('DOMContentLoaded', async () => {
    // 0. جلب وتطبيق الشعار والإعدادات الديناميكية
    await loadAndApplySiteSettings();

    // 1. تهيئة المنتجات في التخزين المحلي كخطوة أولى
    await getProducts();
    
    // 2. إعداد شريط القائمة المتنقل للجوال
    setupMobileMenu();
    
    // 3. تحديد الرابط النشط في القائمة الرئيسية
    highlightActiveNavLink();
    
    // 4. حقن زر الواتساب العائم في الصفحة
    injectWhatsAppFloatingButton();
    
    // 5. تهيئة المكونات بناءً على الصفحة الحالية
    initializePageSpecificLogic();
    
    // 6. إضافة تأثيرات الظهور التدريجي للعناصر
    applyScrollFadeEffects();

    // 7. تأثير تغيير الهيدر عند التمرير
    initHeaderScrollEffect();
});

/**
 * إعداد وفتح وإغلاق قائمة الجوال
 */
function setupMobileMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            // تغيير أيقونة الزر
            const icon = menuToggle.querySelector('i');
            if (icon) {
                if (navLinks.classList.contains('active')) {
                    icon.className = 'fas fa-times';
                } else {
                    icon.className = 'fas fa-bars';
                }
            }
        });
        
        // إغلاق القائمة عند النقر خارجها أو على رابط
        document.addEventListener('click', (e) => {
            if (!menuToggle.contains(e.target) && !navLinks.contains(e.target) && navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                const icon = menuToggle.querySelector('i');
                if (icon) icon.className = 'fas fa-bars';
            }
        });
    }
}

/**
 * تحديد الرابط النشط بالاعتماد على اسم الملف الحالي في شريط العنوان
 */
function highlightActiveNavLink() {
    const path = window.location.pathname;
    const page = path.split("/").pop();
    
    const navItems = document.querySelectorAll('.nav-links li');
    navItems.forEach(item => {
        item.classList.remove('active');
        const link = item.querySelector('a');
        if (link) {
            const href = link.getAttribute('href');
            if (page === href || (page === '' && href === 'index.php')) {
                item.classList.add('active');
            }
        }
    });
}

/**
 * حقن زر الواتساب العائم في أسفل الصفحة ديناميكياً
 */
function injectWhatsAppFloatingButton() {
    // التحقق من عدم وجوده مسبقاً
    if (document.getElementById('whatsapp-floating-btn')) return;
    
    const floatBtn = document.createElement('a');
    floatBtn.id = 'whatsapp-floating-btn';
    floatBtn.href = '#';
    floatBtn.className = 'whatsapp-float-btn';
    floatBtn.setAttribute('title', 'تواصل مباشر عبر الواتساب');
    floatBtn.setAttribute('aria-label', 'تواصل مباشر عبر الواتساب');
    floatBtn.innerHTML = `
        <svg width="28" height="28" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
        <i class="fab fa-whatsapp" style="font-size: 1.6rem; display: none;"></i>
    `;
    
    // إضافة الحدث عند النقر لتشغيل المحادثة المباشرة ديناميكياً
    floatBtn.addEventListener('click', (e) => {
        e.preventDefault();
        openGeneralWhatsAppChat();
    });
    
    document.body.appendChild(floatBtn);
}

/**
 * تشغيل المنطق البرمجي الخاص بكل صفحة
 */
function initializePageSpecificLogic() {
    const path = window.location.pathname;
    const page = path.split("/").pop();
    
    if (page === 'index.php' || page === '') {
        renderHomePageProducts();
        setupHeroSlider();
        loadAndRenderTestimonials();
    } else if (page === 'products.php') {
        initProductsPage();
    } else if (page === 'product-detail.php') {
        initProductDetailPage();
    }
}

/**
 * جلب وعرض آراء العملاء ديناميكياً من API أو التخزين المحلي
 */
async function loadAndRenderTestimonials() {
    const track = document.getElementById('testimonials-track');
    if (!track) return;

    let testimonials = [];
    try {
        const res = await fetch('api/testimonials.php');
        if (res.ok) {
            testimonials = await res.json();
        }
    } catch(e) {
        // التراجع في حال عدم توفر اتصال
    }

    if (!Array.isArray(testimonials) || testimonials.length === 0) {
        return; // الاحتفاظ بالحالة الافتراضية
    }

    track.innerHTML = testimonials.map((t, idx) => {
        const avatarLetter = t.avatar_letter || (t.customer_name ? t.customer_name.trim().charAt(0) : 'أ');
        const rating = parseInt(t.rating) || 5;
        let starsHTML = '';
        for (let i = 0; i < 5; i++) {
            if (i < rating) {
                starsHTML += '<i class="fas fa-star"></i>';
            } else {
                starsHTML += '<i class="far fa-star"></i>';
            }
        }

        return `
            <div class="testimonial-card" id="review-card-${t.id || (idx + 1)}">
                <div class="testimonial-quote-icon"><i class="fas fa-quote-right"></i></div>
                <div class="testimonial-stars">
                    ${starsHTML}
                </div>
                <p class="testimonial-text">
                    "${t.content}"
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar" aria-label="${t.customer_name}">${avatarLetter}</div>
                    <div class="testimonial-author-info">
                        <strong>${t.customer_name}</strong>
                        <span>${t.city || 'صنعاء — عميلة مميزة'}</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

/**
 * إعداد سلايدر البانر الترحيبي في الصفحة الرئيسية
 */
function setupHeroSlider() {
    const slides = document.querySelectorAll('.slide');
    const dotsContainer = document.querySelector('.slider-controls');
    
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    const slideInterval = 6000; // 6 ثواني لكل شريحة
    
    // إنشاء نقاط التحكم بناءً على عدد الشرائح
    if (dotsContainer) {
        dotsContainer.innerHTML = '';
        slides.forEach((_, idx) => {
            const dot = document.createElement('div');
            dot.className = `slider-dot ${idx === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToSlide(idx));
            dotsContainer.appendChild(dot);
        });
    }
    
    function goToSlide(idx) {
        slides[currentSlide].classList.remove('active');
        const dots = document.querySelectorAll('.slider-dot');
        if (dots.length > 0) dots[currentSlide].classList.remove('active');
        
        currentSlide = idx;
        
        slides[currentSlide].classList.add('active');
        if (dots.length > 0) dots[currentSlide].classList.add('active');
    }
    
    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        goToSlide(next);
    }
    
    // التشغيل التلقائي للسلايدر
    let timer = setInterval(nextSlide, slideInterval);
    
    // إعادة ضبط المؤقت عند استخدام النقاط يدوياً
    window.resetSliderTimer = function() {
        clearInterval(timer);
        timer = setInterval(nextSlide, slideInterval);
    };
}

/**
 * إضافة حركات الظهور والتلاشي عند التمرير
 */
function applyScrollFadeEffects() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };
    
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-element');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // مراقبة الأقسام والعناوين
    const fadeElements = document.querySelectorAll('.section-header, .products-grid, .about-intro-grid, .contact-wrapper, .map-card, .qr-card');
    fadeElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(15px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

/**
 * تأثير الهيدر عند التمرير — إضافة ظل أعمق عند التمرير للأسفل
 */
function initHeaderScrollEffect() {
    const header = document.querySelector('.main-header');
    if (!header) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }, { passive: true });
}

/**
 * جلب وتطبيق إعدادات الهوية وشبكات التواصل الاجتماعي ديناميكياً
 */
async function loadAndApplySiteSettings() {
    try {
        const res = await fetch('api/settings.php');
        if (!res.ok) return;
        const settings = await res.json();
        if (!settings) return;

        // 1. تحديث الشعار
        if (settings.site_logo) {
            const headerLogo = document.getElementById('site-header-logo');
            if (headerLogo) headerLogo.src = settings.site_logo;
        }

        // 2. تحديث رقم الواتساب الموحد وزر التواصل العائم ديناميكياً
        if (settings.whatsapp_number && typeof setWhatsAppNumber === 'function') {
            setWhatsAppNumber(settings.whatsapp_number);
        }

        const floatBtn = document.getElementById('whatsapp-floating-btn');
        if (floatBtn) {
            if (settings.whatsapp_number && settings.whatsapp_number.trim() !== '') {
                const cleanNum = settings.whatsapp_number.trim().replace(/[^0-9]/g, '');
                const msg = encodeURIComponent("السلام عليكم ورحمة الله وبركاته 🌸\nأود الاستفسار عن التشكيلات المتوفرة لديكم في متجر لارين عباية.");
                floatBtn.href = `https://wa.me/${cleanNum}?text=${msg}`;
            }
        }

        // 3. تحديث روابط التواصل في الهيدر العلوي (Top Bar)
        const topInsta = document.getElementById('top-instagram-link');
        if (topInsta && settings.instagram_url) topInsta.href = settings.instagram_url;

        const topFb = document.getElementById('top-facebook-link');
        if (topFb && settings.facebook_url) topFb.href = settings.facebook_url;

        const topAddress = document.getElementById('top-address-text');
        if (topAddress && settings.address_text) {
            topAddress.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${settings.address_text}`;
        }

        // 4. تحديث روابط التواصل بالفوتر (Footer)
        const footerInsta = document.getElementById('footer-instagram-link');
        if (footerInsta && settings.instagram_url) footerInsta.href = settings.instagram_url;

        const footerFb = document.getElementById('footer-facebook-link');
        if (footerFb && settings.facebook_url) footerFb.href = settings.facebook_url;

        const footerTiktok = document.getElementById('footer-tiktok-link');
        if (footerTiktok && settings.tiktok_url) footerTiktok.href = settings.tiktok_url;

        const footerSnap = document.getElementById('footer-snapchat-link');
        if (footerSnap && settings.snapchat_url) footerSnap.href = settings.snapchat_url;

        const footerAddr = document.getElementById('footer-address-text');
        if (footerAddr && settings.address_text) footerAddr.textContent = settings.address_text;

        const footerPhone = document.getElementById('footer-phone-text');
        if (footerPhone && settings.phone_number) footerPhone.textContent = settings.phone_number;

        const footerHours = document.getElementById('footer-hours-text');
        if (footerHours && settings.work_hours) footerHours.textContent = settings.work_hours;

        // 5. تحديث وإظهار/إخفاء روابط الشريط الأوسط في الصفحة الرئيسية (Centered Hero Social Bar)
        const heroInsta = document.getElementById('hero-social-instagram');
        if (heroInsta) {
            if (settings.instagram_url && settings.instagram_url.trim() !== '') {
                heroInsta.href = settings.instagram_url;
                heroInsta.style.display = 'inline-flex';
            } else {
                heroInsta.style.display = 'none';
            }
        }

        const heroFb = document.getElementById('hero-social-facebook');
        if (heroFb) {
            if (settings.facebook_url && settings.facebook_url.trim() !== '') {
                heroFb.href = settings.facebook_url;
                heroFb.style.display = 'inline-flex';
            } else {
                heroFb.style.display = 'none';
            }
        }

        const heroTiktok = document.getElementById('hero-social-tiktok');
        if (heroTiktok) {
            if (settings.tiktok_url && settings.tiktok_url.trim() !== '') {
                heroTiktok.href = settings.tiktok_url;
                heroTiktok.style.display = 'inline-flex';
            } else {
                heroTiktok.style.display = 'none';
            }
        }

        const heroSnap = document.getElementById('hero-social-snapchat');
        if (heroSnap) {
            if (settings.snapchat_url && settings.snapchat_url.trim() !== '') {
                heroSnap.href = settings.snapchat_url;
                heroSnap.style.display = 'inline-flex';
            } else {
                heroSnap.style.display = 'none';
            }
        }

        const heroWa = document.getElementById('hero-social-whatsapp');
        if (heroWa) {
            if (settings.whatsapp_number && settings.whatsapp_number.trim() !== '') {
                heroWa.style.display = 'inline-flex';
            } else {
                heroWa.style.display = 'none';
            }
        }

    } catch(e) {
        console.error('Failed to apply site settings:', e);
    }
}

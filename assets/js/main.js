/* main.js - الوظائف المشتركة والتهيئة العامة لموقع لارين عباية */

document.addEventListener('DOMContentLoaded', async () => {
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
    floatBtn.innerHTML = `
        <span>تواصلي معنا الآن 💬</span>
        <i class="fab fa-whatsapp" style="font-size: 1.4rem;"></i>
    `;
    
    // إضافة الحدث عند النقر
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
    } else if (page === 'products.php') {
        initProductsPage();
    } else if (page === 'product-detail.php') {
        initProductDetailPage();
    }
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

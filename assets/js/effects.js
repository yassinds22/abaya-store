/* effects.js - التأثيرات البصرية المتقدمة لموقع لارين عباية 🌸 */

(function () {
    'use strict';

    /* =====================================================
       1. SCROLL PROGRESS BAR — شريط التقدم الوردي
    ===================================================== */
    function initScrollProgressBar() {
        const bar = document.createElement('div');
        bar.id = 'scroll-progress-bar';
        bar.setAttribute('aria-hidden', 'true');
        bar.style.cssText = `
            position: fixed;
            top: 0;
            right: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #0B4F3A, #1B362B, #C5A059);
            z-index: 9999;
            transition: width 0.1s linear;
            border-radius: 0 0 3px 0;
            box-shadow: 0 0 8px rgba(11,79,58,0.5);
        `;
        document.body.appendChild(bar);

        window.addEventListener('scroll', () => {
            const scrollTop    = window.scrollY;
            const docHeight    = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled     = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            bar.style.width    = scrolled + '%';
        }, { passive: true });
    }

    /* =====================================================
       2. FLOATING ORBS — كرات وردية/بنفسجية متحركة
    ===================================================== */
    function initFloatingOrbs() {
        const heroSection = document.querySelector('.hero-section');
        if (!heroSection) return;

        const orbsData = [
            { size: 320, x: 10,  y: 15,  color: 'rgba(11,79,58,0.12)',   dur: 18 },
            { size: 200, x: 75,  y: 60,  color: 'rgba(27,54,43,0.10)',   dur: 22 },
            { size: 150, x: 50,  y: 80,  color: 'rgba(197,160,89,0.13)', dur: 15 },
            { size: 100, x: 20,  y: 70,  color: 'rgba(11,79,58,0.09)',   dur: 20 },
            { size: 250, x: 85,  y: 10,  color: 'rgba(27,54,43,0.08)',   dur: 25 },
        ];

        const orbContainer = document.createElement('div');
        orbContainer.id = 'floating-orbs-container';
        orbContainer.setAttribute('aria-hidden', 'true');
        orbContainer.style.cssText = `
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        `;

        orbsData.forEach((orb, i) => {
            const el = document.createElement('div');
            el.className = 'floating-orb';
            el.style.cssText = `
                position: absolute;
                width: ${orb.size}px;
                height: ${orb.size}px;
                background: radial-gradient(circle, ${orb.color} 0%, transparent 70%);
                border-radius: 50%;
                top: ${orb.y}%;
                left: ${orb.x}%;
                transform: translate(-50%, -50%);
                animation: orbFloat${i} ${orb.dur}s ease-in-out infinite;
                filter: blur(${orb.size > 200 ? 20 : 10}px);
            `;

            // إضافة keyframes فريدة لكل كرة
            const style = document.createElement('style');
            const xOffset = Math.random() * 30 - 15;
            const yOffset = Math.random() * 20 - 10;
            style.textContent = `
                @keyframes orbFloat${i} {
                    0%, 100% { transform: translate(-50%, -50%) translate(0px, 0px); }
                    33%      { transform: translate(-50%, -50%) translate(${xOffset}px, ${yOffset}px); }
                    66%      { transform: translate(-50%, -50%) translate(${-xOffset * 0.7}px, ${-yOffset * 1.2}px); }
                }
            `;
            document.head.appendChild(style);
            orbContainer.appendChild(el);
        });

        // إدراج الكرات داخل hero-slider
        const heroSlider = heroSection.querySelector('.hero-slider');
        if (heroSlider) heroSlider.prepend(orbContainer);
        else heroSection.prepend(orbContainer);
    }

    /* =====================================================
       3. FLOATING PETALS — بتلات وردية تتساقط
    ===================================================== */
    function initFloatingPetals() {
        const heroSection = document.querySelector('.hero-section');
        if (!heroSection) return;

        // رسومات SVG للبتلات (5 أشكال مختلفة)
        const petalShapes = [
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 30"><ellipse cx="10" cy="15" rx="6" ry="12" fill="currentColor" opacity="0.85" transform="rotate(20 10 15)"/></svg>`,
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2 C16 6, 20 10, 12 22 C4 10, 8 6, 12 2Z" fill="currentColor" opacity="0.8"/></svg>`,
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 28"><ellipse cx="9" cy="14" rx="5" ry="11" fill="currentColor" opacity="0.75"/></svg>`,
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><circle cx="11" cy="11" r="8" fill="currentColor" opacity="0.6"/></svg>`,
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><ellipse cx="8" cy="13" rx="5" ry="10" fill="currentColor" opacity="0.7" transform="rotate(-15 8 13)"/></svg>`,
        ];

        const colors = [
            '#8A9A86', '#C5A059', '#D9B464',
            '#A8BBB2', '#0B4F3A', '#8B6D31',
            '#B8C7BF', '#A3B4AC',
        ];

        const petalContainer = document.createElement('div');
        petalContainer.id = 'petals-container';
        petalContainer.setAttribute('aria-hidden', 'true');
        petalContainer.style.cssText = `
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 2;
        `;

        const heroSlider = heroSection.querySelector('.hero-slider');
        if (heroSlider) heroSlider.appendChild(petalContainer);
        else heroSection.appendChild(petalContainer);

        const PETAL_COUNT = 22;

        function createPetal() {
            const petal = document.createElement('div');
            petal.setAttribute('aria-hidden', 'true');

            const shape     = petalShapes[Math.floor(Math.random() * petalShapes.length)];
            const color     = colors[Math.floor(Math.random() * colors.length)];
            const size      = Math.random() * 18 + 10; // 10-28px
            const startX    = Math.random() * 100;     // 0-100%
            const duration  = Math.random() * 10 + 8;  // 8-18s
            const delay     = Math.random() * 12;
            const rotateEnd = Math.random() * 720 - 360;
            const swayAmt   = Math.random() * 80 + 30; // أفقي

            petal.style.cssText = `
                position: absolute;
                top: -40px;
                left: ${startX}%;
                width: ${size}px;
                height: ${size}px;
                color: ${color};
                animation: petalFall ${duration}s ${delay}s linear infinite;
                --sway: ${swayAmt}px;
                --rotate-end: ${rotateEnd}deg;
                filter: drop-shadow(0 2px 4px rgba(11,79,58,0.15));
                z-index: 2;
            `;
            petal.innerHTML = shape;

            petalContainer.appendChild(petal);
        }

        // إضافة keyframe للبتلات
        const petalStyle = document.createElement('style');
        petalStyle.textContent = `
            @keyframes petalFall {
                0% {
                    transform: translateY(-40px) translateX(0) rotate(0deg);
                    opacity: 0;
                }
                10% { opacity: 1; }
                80% { opacity: 0.8; }
                100% {
                    transform: translateY(calc(100vh + 50px))
                               translateX(var(--sway))
                               rotate(var(--rotate-end));
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(petalStyle);

        for (let i = 0; i < PETAL_COUNT; i++) {
            createPetal();
        }
    }

    /* =====================================================
       4. SCROLL REVEAL — ظهور تدريجي محسّن عند التمرير
    ===================================================== */
    function initScrollReveal() {
        const revealClasses = [
            { selector: '.section-header',       dir: 'up',   delay: 0   },
            { selector: '.product-card',          dir: 'up',   delay: 80  },
            { selector: '.contact-card',          dir: 'right',delay: 100 },
            { selector: '.highlight-box',         dir: 'up',   delay: 120 },
            { selector: '.about-text',            dir: 'left', delay: 0   },
            { selector: '.about-shop-images',     dir: 'right',delay: 0   },
            { selector: '.quick-contact-bar',     dir: 'up',   delay: 0   },
            { selector: '.footer-section',        dir: 'up',   delay: 80  },
            { selector: '.map-card',              dir: 'up',   delay: 0   },
            { selector: '.contact-form-card',     dir: 'left', delay: 0   },
        ];

        const styleEl = document.createElement('style');
        styleEl.textContent = `
            .sr-hidden {
                opacity: 0;
                transition: opacity 0.7s cubic-bezier(0.25,0.46,0.45,0.94),
                            transform 0.7s cubic-bezier(0.25,0.46,0.45,0.94);
            }
            .sr-hidden.sr-up    { transform: translateY(40px);  }
            .sr-hidden.sr-down  { transform: translateY(-40px); }
            .sr-hidden.sr-left  { transform: translateX(-40px); }
            .sr-hidden.sr-right { transform: translateX(40px);  }

            .sr-visible {
                opacity: 1 !important;
                transform: translate(0, 0) !important;
            }
        `;
        document.head.appendChild(styleEl);

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -60px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = parseInt(entry.target.dataset.srDelay || 0);
                    setTimeout(() => {
                        entry.target.classList.add('sr-visible');
                        entry.target.classList.remove('sr-hidden');
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        revealClasses.forEach(({ selector, dir, delay }) => {
            const elements = document.querySelectorAll(selector);
            elements.forEach((el, idx) => {
                // تجنب العناصر داخل overflow:hidden (testimonials slider)
                if (el.closest('.hero-section')) return;
                if (el.closest('.testimonials-slider-wrapper')) return;

                el.classList.add('sr-hidden', `sr-${dir}`);
                el.dataset.srDelay = delay * idx;
                observer.observe(el);
            });
        });
    }

    /* =====================================================
       5. HERO CONTENT ANIMATION — تحريك محتوى Hero
    ===================================================== */
    function initHeroContentAnimation() {
        const heroContent = document.querySelector('.slide.active .hero-content');
        if (!heroContent) return;

        // تحريك أطفال المحتوى بتتالي
        const children = heroContent.children;
        Array.from(children).forEach((child, i) => {
            child.style.cssText += `
                opacity: 0;
                transform: translateY(25px);
                transition: opacity 0.7s ease ${0.3 + i * 0.18}s,
                            transform 0.7s ease ${0.3 + i * 0.18}s;
            `;
            setTimeout(() => {
                child.style.opacity = '1';
                child.style.transform = 'translateY(0)';
            }, 100);
        });
    }

    /* =====================================================
       6. TESTIMONIALS SLIDER — سلايدر آراء العملاء
    ===================================================== */
    function initTestimonialsSlider() {
        const track         = document.getElementById('testimonials-track');
        const wrapper       = document.getElementById('testimonials-slider-wrapper');
        const prevBtn       = document.getElementById('testimonials-prev-btn');
        const nextBtn       = document.getElementById('testimonials-next-btn');
        const dotsContainer = document.getElementById('testimonials-dots-container');

        if (!track || !wrapper) return;

        const cards      = Array.from(track.children);
        const totalCards = cards.length;
        const GAP        = 24; // الفجوة بين البطاقات بالبكسل
        let currentIndex = 0;
        let autoTimer    = null;

        function getVisibleCount() {
            const w = window.innerWidth;
            if (w <= 680)  return 1;
            if (w <= 1024) return 2;
            return 3;
        }

        function maxIndex() {
            return Math.max(0, totalCards - getVisibleCount());
        }

        /* ضبط عرض كل بطاقة بدقة متناهية بناءً على عرض الإطار */
        function setCardWidths() {
            const vc        = getVisibleCount();
            const wrapperW  = wrapper.clientWidth || wrapper.getBoundingClientRect().width;
            if (!wrapperW) return;

            const totalGap  = GAP * (vc - 1);
            const cardWidth = Math.floor((wrapperW - totalGap) / vc);

            cards.forEach(card => {
                card.style.flex     = `0 0 ${cardWidth}px`;
                card.style.width    = `${cardWidth}px`;
                card.style.minWidth = `${cardWidth}px`;
                card.style.maxWidth = `${cardWidth}px`;
            });
        }

        function getStepDistance() {
            if (cards.length === 0) return 0;
            const w = cards[0].getBoundingClientRect().width || parseFloat(cards[0].style.width) || 300;
            return w + GAP;
        }

        function goTo(idx) {
            currentIndex = Math.max(0, Math.min(idx, maxIndex()));
            const shift = currentIndex * getStepDistance();
            track.style.transform = `translateX(-${shift}px)`;
            updateDots();
        }

        /* إنشاء نقاط التنقل */
        function buildDots() {
            if (!dotsContainer) return;
            dotsContainer.innerHTML = '';
            const count = maxIndex() + 1;
            for (let i = 0; i < count; i++) {
                const dot = document.createElement('button');
                dot.className = 'testimonials-dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('aria-label', `رأي ${i + 1}`);
                dot.addEventListener('click', () => { goTo(i); resetTimer(); });
                dotsContainer.appendChild(dot);
            }
        }

        function updateDots() {
            const dots = dotsContainer ? dotsContainer.querySelectorAll('.testimonials-dot') : [];
            dots.forEach((d, i) => d.classList.toggle('active', i === currentIndex));
        }

        function next() { goTo(currentIndex + 1 > maxIndex() ? 0 : currentIndex + 1); }
        function prev() { goTo(currentIndex - 1 < 0 ? maxIndex() : currentIndex - 1); }

        function startTimer() { autoTimer = setInterval(next, 5000); }
        function resetTimer()  { clearInterval(autoTimer); startTimer(); }

        /* ربط الأزرار */
        if (prevBtn) prevBtn.addEventListener('click', () => { prev(); resetTimer(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { next(); resetTimer(); });

        /* دعم السحب باللمس على الجوال */
        let touchStartX = 0;
        track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) {
                // في وضع LTR track: السحب لليسار (diff > 0) ينقل للبطاقة التالية
                diff > 0 ? next() : prev();
                resetTimer();
            }
        }, { passive: true });

        /* إعادة الحساب عند تغيير حجم الشاشة */
        window.addEventListener('resize', () => {
            setCardWidths();
            currentIndex = Math.min(currentIndex, maxIndex());
            buildDots();
            goTo(currentIndex);
        });

        /* تهيئة مبكرة ومتأخرة لضمان حساب العرض بعد تحميل الخطوط والصور */
        setCardWidths();
        buildDots();
        goTo(0);
        startTimer();

        setTimeout(() => {
            setCardWidths();
            goTo(currentIndex);
        }, 200);
    }

    /* =====================================================
       7. COUNTER ANIMATION — عداد الإحصاء
    ===================================================== */
    function initCounterAnimation() {
        const statsBar = document.getElementById('testimonials-stats-bar');
        if (!statsBar) return;

        const counterEls = statsBar.querySelectorAll('.stat-number[data-target]');
        if (counterEls.length === 0) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                counterEls.forEach(el => {
                    const target   = parseInt(el.dataset.target, 10);
                    const duration = 1800; // مللي ثانية
                    const start    = performance.now();

                    function update(now) {
                        const elapsed  = now - start;
                        const progress = Math.min(elapsed / duration, 1);
                        // easing: ease-out
                        const eased    = 1 - Math.pow(1 - progress, 3);
                        el.textContent = Math.round(eased * target);
                        if (progress < 1) requestAnimationFrame(update);
                    }

                    requestAnimationFrame(update);
                });

                observer.unobserve(entry.target);
            });
        }, { threshold: 0.4 });

        observer.observe(statsBar);
    }

    /* =====================================================
       تهيئة جميع التأثيرات عند تحميل الصفحة
    ===================================================== */
    document.addEventListener('DOMContentLoaded', () => {
        initScrollProgressBar();
        initFloatingOrbs();
        initFloatingPetals();
        initScrollReveal();
        initHeroContentAnimation();
        initTestimonialsSlider();
        initCounterAnimation();
    });

})();

/* products.js - إدارة جلب وعرض وتصفية المنتجات في لارين عباية */

// مفتاح التخزين المحلي للمنتجات
const PRODUCTS_STORAGE_KEY = "lareen_abaya_products";

// المنتجات الافتراضية الحقيقية (تم دمجها لتفادي مشاكل CORS عند تشغيل الموقع محلياً بدون خادم)
const DEFAULT_PRODUCTS = [
  {
    "id": 1,
    "name": "عباية لارين الكلاسيكية",
    "description": "عباية كلاسيكية راقية بتصميم مستقيم مريح وعملي، مصنوعة من قماش الكريب الكوري الأصيل الممتاز للاستخدام اليومي والدوام.",
    "price": 25000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0040.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 2,
    "name": "عباية الشيفون الراقية",
    "description": "عباية شيفون انسيابية ناعمة جداً ومزدوجة الطبقات لتضفي رونقاً متميزاً وأناقة لا مثيل لها في زياراتك الرسمية والمناسبات.",
    "price": 28000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0044.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 3,
    "name": "عباية البشت الملكي",
    "description": "تصميم البشت الخليجي الفاخر والواسع، مطعم بتطريزات قصب ذهبية دقيقة على طول الحواف والأكمام لإطلالة ملكية مهيبة.",
    "price": 35000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0056.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 4,
    "name": "عباية سوداء مطرزة",
    "description": "عباية كلاسيكية سوداء قاتمة من قماش الفرسان الفاخر، مزينة بتطريز أسود يدوي ناعم يعطي طابعاً راقياً وهادئاً.",
    "price": 32000,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0060.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 5,
    "name": "عباية الكريب الكورية",
    "description": "مصممة من قماش الكريب الكوري الناعم البارد، مقاومة للتجعد وتأتي مع أكمام مطاطية عملية توفر راحة تامة طوال اليوم.",
    "price": 29000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0066.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 6,
    "name": "عباية كاجوال ناعمة",
    "description": "تصميم شبابي عملي خفيف الوزن وألوان هادئة، مناسبة للجامعة والتنقلات السريعة ومصنوعة من خامات قطنية باردة.",
    "price": 22000,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0068.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 7,
    "name": "عباية السهرة المطرزة بالخرز",
    "description": "عباية سهرة فخمة جداً مشغولة يدوياً بالكامل بخرز لامع وخرز متناسق على الأكتاف والأكمام لتتألقي في ليلتك الخاصة.",
    "price": 45000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0072.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 8,
    "name": "عباية الكسرات الأنيقة",
    "description": "تتميز بكسرات بليسيه أنيقة وعصرية على الظهر والجوانب تعطي انسيابية وحركة متميزة مع تفاصيل ياقة مفرغة راقية.",
    "price": 31000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0073.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 9,
    "name": "عباية شتوية مخملية",
    "description": "عباية دافئة من قماش المخمل الفاخر المطعم بتطريزات صوف خفيفة، مثالية للأجواء الباردة والمناسبات الشتوية الراقية.",
    "price": 38000,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0075.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 10,
    "name": "عباية الأميرات الفاخرة",
    "description": "عباية بياقة ملكية مفتوحة وتطريزات فاخرة عريضة على أطراف الأكمام، مصممة خصيصاً للمناسبات الفخمة التي تتطلب تميزاً.",
    "price": 42000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0088.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 11,
    "name": "عباية الدانتيل الفرنسي",
    "description": "مطعمة بقطع الدانتيل الفرنسي الفاخر على الصدر والجوانب مع طرحة مطابقة مطرزة، تجمع بين الرقي والتفاصيل الناعمة.",
    "price": 33000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0089.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 12,
    "name": "عباية دبل كريب",
    "description": "مصنوعة من قماش الدبل كريب الياباني الثقيل والفاخر، تمنحك قواماً متسقاً وراحة فائقة طوال اليوم دون الحاجة للكي المستمر.",
    "price": 27000,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0092.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 13,
    "name": "عباية الحرير الملكي",
    "description": "مصنوعة من الحرير الكوري الفاخر اللامع بلمسة خفيفة ناعمة كالحرير، تعكس الذوق الرفيع وتتميز بقصة فضفاضة ومريحة.",
    "price": 40000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0112.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 14,
    "name": "عباية بشت مطرز ذهبي",
    "description": "عباية بشت خليجية واسعة مطرزة بخيوط القصب الذهبية اللامعة على الصدر وأسفل الأكمام لتمنحك حضوراً واثقاً ومميزاً.",
    "price": 39000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0113.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 15,
    "name": "عباية يومية عملية",
    "description": "أبسط وأروع الخيارات اليومية، خفيفة وباردة مع سحاب مخفي أمامي سهل الارتداء ومقاومة للأتربة لتوفر لكِ راحة قصوى.",
    "price": 18000,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0119.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 16,
    "name": "عباية كريب ملكي مقلم",
    "description": "عباية مميزة بتصميم مقلم طولي خفيف يعطي انطباعاً بالطول والرشاقة، مصنوعة من قماش الكريب الملكي الممتاز والبارد.",
    "price": 26000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0127.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 17,
    "name": "عباية الساتان اللامعة",
    "description": "عباية مصنوعة من قماش الساتان الحريري الفاخر بتصميم جذاب وأنيق، مثالية لحفلات الاستقبال والمناسبات المسائية العائلية.",
    "price": 36000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0128.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 18,
    "name": "عباية بشت واسعة",
    "description": "تصميم بشت تقليدي واسع جداً بدون أي تطريز إضافي، لمن يعشقون البساطة التامة والحشمة في قصة خليجية أصيلة وعريضة.",
    "price": 34000,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0133.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 19,
    "name": "عباية تطريز ناعم",
    "description": "مزينة بتطريزات ورود ناعمة على أطراف الطرحة والأكمام، تعطي مظهراً أنثوياً هادئاً وخياراً ممتازاً للمشاوير الصباحية.",
    "price": 30000,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0134.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 20,
    "name": "عباية شيفون طبقتين",
    "description": "تأتي بطبقتين من الشيفون الملكي الناعم المقاوم للتفتق لتعطي مظهراً انسيابياً جميلاً، خفيفة جداً ومريحة في فصل الصيف.",
    "price": 28500,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0145.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 21,
    "name": "عباية المناسبات الراقية",
    "description": "أفخم تشكيلة مناسبات على الإطلاق، مدعمة بخيوط حريرية فضية مطرزة يدوياً وتصميم عصري يسحر الألباب وجذّاب للغاية.",
    "price": 48000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0160.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 22,
    "name": "عباية كتان أنيقة",
    "description": "عباية مصنوعة من الكتان الطبيعي الفاخر المقاوم للتجعد، وتتميز بقصة عملية عصرية ممتازة للاستخدام في مشاوير العمل والدوام.",
    "price": 24500,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0161.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 23,
    "name": "عباية سوداء بتطريز أسود",
    "description": "تصميم غامض وساحر يعتمد على تطريز أسود لامع على قماش الكريب الأسود القاتم، لتمنحك فخامة هادئة وتألقاً ناعماً.",
    "price": 31500,
    "category": "الكلاسيكية",
    "image": "assets/Img/IMG-20260108-WA0163.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 24,
    "name": "عباية كم منفوخ",
    "description": "عباية بتصميم عصري جريء بأكمام منفوخة مزمومة من المعصم، تعطي طابعاً فريداً ومميزاً لعشاق التغيير والموضة الجديدة.",
    "price": 29500,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0164.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 25,
    "name": "عباية بشت تطريز أكمام",
    "description": "عباية بشت خليجية واسعة وجميلة مزينة بتطريزات هندسية ناعمة على الأكمام فقط، تجمع بين بساطة التصميم وفخامة التفاصيل.",
    "price": 37500,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0168.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 26,
    "name": "عباية كريب صالونا",
    "description": "مصنوعة من قماش صالونا الياباني الشهير بمقاومته الفائقة لظروف الطقس ولمعانه الخفيف، قصة مريحة بياقة مغلقة رائعة.",
    "price": 33500,
    "category": "آخر الوافدين",
    "image": "assets/Img/IMG-20260108-WA0169.jpg",
    "created_at": "2026-07-19"
  },
  {
    "id": 27,
    "name": "عباية الجاكار الفاخرة",
    "description": "عباية فاخرة جداً بنقوش جاكار بارزة وجميلة متداخلة مع نسيج القماش، تعطي طابعاً ملكياً فخماً ومناسبة جداً للمناسبات الكبرى.",
    "price": 41000,
    "category": "الأكثر طلباً",
    "image": "assets/Img/IMG-20260108-WA0170.jpg",
    "created_at": "2026-07-19"
  }
];

/**
 * جلب جميع المنتجات من LocalStorage أو من المصفوفة الافتراضية
 */
async function getProducts() {
    let localProducts = localStorage.getItem(PRODUCTS_STORAGE_KEY);
    
    if (localProducts) {
        const parsed = JSON.parse(localProducts);
        // تحديث التخزين إذا كانت المنتجات قديمة (أقل من 27 منتج أو تشير إلى صور مؤقتة قديمة أو مسارات بدون assets/)
        if (parsed.length < 27 || (parsed.length > 0 && parsed[0].image.includes('images/products/product1.jpg')) || (parsed.length > 0 && !parsed[0].image.startsWith('assets/'))) {
            localStorage.removeItem(PRODUCTS_STORAGE_KEY);
        } else {
            return parsed;
        }
    }
    
    // حفظ المنتجات الافتراضية المدمجة في التخزين المحلي
    localStorage.setItem(PRODUCTS_STORAGE_KEY, JSON.stringify(DEFAULT_PRODUCTS));
    return DEFAULT_PRODUCTS;
}

/**
 * حفظ المنتجات في LocalStorage
 * @param {Array} products - مصفوفة المنتجات
 */
function saveProductsToStorage(products) {
    localStorage.setItem(PRODUCTS_STORAGE_KEY, JSON.stringify(products));
}

/**
 * إنشاء كرت منتج HTML
 * @param {Object} product - بيانات المنتج
 */
function createProductCardHTML(product) {
    // تنسيق السعر بالفاصلة الآلاف
    const formattedPrice = Number(product.price).toLocaleString('ar-YE');
    
    // تحديد الوسم بناءً على القسم
    let badgeHTML = '';
    if (product.category === 'الأكثر طلباً') {
        badgeHTML = `<span class="product-badge">الأكثر مبيعاً 🔥</span>`;
    } else if (product.category === 'آخر الوافدين') {
        badgeHTML = `<span class="product-badge" style="background: linear-gradient(135deg, #b8860b, var(--color-gold)); color: var(--color-dark-brown);">جديد ✨</span>`;
    }

    return `
        <div class="product-card fade-in-element">
            ${badgeHTML}
            <a href="product-detail.html?id=${product.id}" style="display:block;">
                <div class="product-card-img-wrapper">
                    <img src="${product.image}" alt="${product.name}" class="product-card-img" onerror="this.src='https://picsum.photos/400/530?random=${product.id}'">
                </div>
            </a>
            <div class="product-card-info">
                <a href="product-detail.html?id=${product.id}">
                    <h3 class="product-card-title">${product.name}</h3>
                </a>
                <p class="product-card-desc">${product.description}</p>
                <div class="product-card-footer">
                    <div class="product-card-price">
                        <span class="price-amount">${formattedPrice}</span>
                        <span class="price-currency">ريال يمني</span>
                    </div>
                </div>
                <a href="product-detail.html?id=${product.id}" class="btn btn-primary">طلب العباية</a>
            </div>
        </div>
    `;
}


/**
 * عرض المنتجات في الصفحة الرئيسية (آخر الوافدين والأكثر طلباً)
 */
async function renderHomePageProducts() {
    const products = await getProducts();
    
    // 1. عرض آخر الوافدين (آخر 6 منتجات مضافة حسب التاريخ أو المعرف)
    const latestContainer = document.getElementById('latest-arrivals-container');
    if (latestContainer) {
        // ترتيب تنازلي حسب المعرف (الأحدث أولاً)
        const latestProducts = [...products]
            .sort((a, b) => b.id - a.id)
            .slice(0, 6);
            
        if (latestProducts.length === 0) {
            latestContainer.innerHTML = '<p class="no-products">لا توجد منتجات متوفرة حالياً.</p>';
        } else {
            latestContainer.innerHTML = latestProducts.map(p => createProductCardHTML(p)).join('');
        }
    }
    
    // 2. عرض الأكثر طلباً (المنتجات التي تنتمي لقسم الأكثر طلباً - بحد أقصى 4 منتجات)
    const bestSellersContainer = document.getElementById('best-sellers-container');
    if (bestSellersContainer) {
        const bestProducts = products
            .filter(p => p.category === 'الأكثر طلباً')
            .slice(0, 4);
            
        if (bestProducts.length === 0) {
            bestSellersContainer.innerHTML = '<p class="no-products">لا توجد منتجات في هذا القسم حالياً.</p>';
        } else {
            bestSellersContainer.innerHTML = bestProducts.map(p => createProductCardHTML(p)).join('');
        }
    }
}

/**
 * عرض المنتجات وتصفيتها في صفحة المنتجات الكلية
 */
async function initProductsPage() {
    const products = await getProducts();
    const productsContainer = document.getElementById('all-products-container');
    const searchInput = document.getElementById('search-input');
    const categoryFilter = document.getElementById('category-filter');
    const priceFilter = document.getElementById('price-filter');
    
    if (!productsContainer) return;
    
    function renderFilteredProducts() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        const selectedCategory = categoryFilter ? categoryFilter.value : 'all';
        const selectedSort = priceFilter ? priceFilter.value : 'default';
        
        // 1. التصفية
        let filtered = products.filter(product => {
            const matchesSearch = product.name.toLowerCase().includes(query) || 
                                  product.description.toLowerCase().includes(query);
            
            const matchesCategory = selectedCategory === 'all' || product.category === selectedCategory;
            
            return matchesSearch && matchesCategory;
        });
        
        // 2. الفرز
        if (selectedSort === 'price-asc') {
            filtered.sort((a, b) => a.price - b.price);
        } else if (selectedSort === 'price-desc') {
            filtered.sort((a, b) => b.price - a.price);
        } else if (selectedSort === 'newest') {
            filtered.sort((a, b) => b.id - a.id);
        }
        
        // 3. العرض
        if (filtered.length === 0) {
            productsContainer.innerHTML = `
                <div class="no-results-message" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                    <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 15px; color: var(--color-gray-border);"></i>
                    <p>عذراً، لم نجد أي عباية تطابق بحثكِ.</p>
                </div>
            `;
        } else {
            productsContainer.innerHTML = filtered.map(p => createProductCardHTML(p)).join('');
        }
    }
    
    // ربط الأحداث
    if (searchInput) searchInput.addEventListener('input', renderFilteredProducts);
    if (categoryFilter) categoryFilter.addEventListener('change', renderFilteredProducts);
    if (priceFilter) priceFilter.addEventListener('change', renderFilteredProducts);
    
    // العرض الأولي
    renderFilteredProducts();
}

/**
 * تهيئة صفحة تفاصيل المنتج المنفرد
 */
async function initProductDetailPage() {
    // الحصول على المعرف من الرابط
    const urlParams = new URLSearchParams(window.location.search);
    const productId = parseInt(urlParams.get('id'));
    
    if (!productId) {
        window.location.href = 'products.html';
        return;
    }
    
    const products = await getProducts();
    const product = products.find(p => p.id === productId);
    
    if (!product) {
        document.querySelector('.section').innerHTML = `
            <div style="text-align: center; padding: 100px 20px;">
                <h2 style="margin-bottom: 20px;">عذراً، هذا المنتج غير موجود.</h2>
                <a href="products.html" class="btn btn-primary">العودة لصفحة المنتجات</a>
            </div>
        `;
        return;
    }
    
    // تعبئة البيانات في الصفحة
    document.getElementById('product-title').innerText = product.name;
    document.getElementById('product-category').innerText = product.category;
    document.getElementById('product-desc').innerText = product.description;
    
    const formattedPrice = Number(product.price).toLocaleString('ar-YE');
    document.getElementById('product-price').innerHTML = `${formattedPrice} <span>ريال يمني</span>`;
    
    const mainImg = document.getElementById('product-main-img');
    mainImg.src = product.image;
    mainImg.alt = product.name;
    mainImg.onerror = function() {
        this.src = `https://picsum.photos/600/800?random=${product.id}`;
    };
    
    // تحديث الصور المصغرة
    const thumbContainer = document.getElementById('product-thumb-container');
    if (thumbContainer) {
        thumbContainer.innerHTML = `
            <div class="product-thumb active" onclick="changeDetailImage('${product.image}', this)">
                <img src="${product.image}" onerror="this.src='https://picsum.photos/100/130?random=${product.id}'" alt="Img 1">
            </div>
            <div class="product-thumb" onclick="changeDetailImage('https://picsum.photos/600/800?random=${product.id + 10}', this)">
                <img src="https://picsum.photos/100/130?random=${product.id + 10}" alt="Img 2">
            </div>
            <div class="product-thumb" onclick="changeDetailImage('https://picsum.photos/600/800?random=${product.id + 20}', this)">
                <img src="https://picsum.photos/100/130?random=${product.id + 20}" alt="Img 3">
            </div>
        `;
    }
    
    // التعامل مع خيارات الدفع والطلب
    let selectedPayment = "جيب (773185534)";
    const paymentOptions = document.querySelectorAll('.payment-option-card');
    
    paymentOptions.forEach(card => {
        card.addEventListener('click', function() {
            paymentOptions.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            selectedPayment = this.getAttribute('data-payment');
        });
    });
    
    const orderBtn = document.getElementById('btn-order-whatsapp');
    if (orderBtn) {
        orderBtn.addEventListener('click', function() {
            sendWhatsAppOrder(product.name, formattedPrice, selectedPayment);
        });
    }
}

/**
 * تغيير الصورة الكبيرة عند النقر على صورة مصغرة
 */
function changeDetailImage(src, element) {
    const mainImg = document.getElementById('product-main-img');
    if (mainImg) {
        mainImg.src = src;
    }
    const thumbs = document.querySelectorAll('.product-thumb');
    thumbs.forEach(t => t.classList.remove('active'));
    element.classList.add('active');
}

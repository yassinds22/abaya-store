/* admin.js - لوحة تحكم وإدارة المنتجات لمتجر لارين عباية */

const ADMIN_PASSWORD = "lareen2026";
let editingProductId = null;
let uploadedImageBase64 = "";

document.addEventListener('DOMContentLoaded', async () => {
    checkAdminAuth();
    
    // ربط نموذج تسجيل الدخول
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    // ربط زر تسجيل الخروج
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', handleLogout);
    }
    
    // تهيئة لوحة التحكم وإدارة الصور والمنتجات
    if (document.getElementById('admin-dashboard')) {
        setupImageUpload();
        await renderAdminProductsTable();
        
        const productForm = document.getElementById('product-form');
        if (productForm) {
            productForm.addEventListener('submit', handleProductFormSubmit);
        }
        
        const cancelEditBtn = document.getElementById('btn-cancel-edit');
        if (cancelEditBtn) {
            cancelEditBtn.addEventListener('click', resetProductForm);
        }
    }
});

/**
 * التحقق من تسجيل دخول المدير
 */
function checkAdminAuth() {
    const isLogged = sessionStorage.getItem('lareen_admin_logged') === 'true';
    const loginOverlay = document.getElementById('admin-login-overlay');
    const dashboard = document.getElementById('admin-dashboard');
    
    if (isLogged) {
        if (loginOverlay) loginOverlay.style.display = 'none';
        if (dashboard) dashboard.style.display = 'block';
    } else {
        if (loginOverlay) loginOverlay.style.display = 'flex';
        if (dashboard) dashboard.style.display = 'none';
    }
}

/**
 * معالجة تسجيل الدخول
 */
function handleLogin(e) {
    e.preventDefault();
    const passwordInput = document.getElementById('admin-password');
    const loginError = document.getElementById('login-error');
    
    if (passwordInput.value === ADMIN_PASSWORD) {
        sessionStorage.setItem('lareen_admin_logged', 'true');
        checkAdminAuth();
        if (loginError) loginError.style.display = 'none';
        passwordInput.value = '';
    } else {
        if (loginError) {
            loginError.innerText = "كلمة المرور غير صحيحة، يرجى المحاولة مرة أخرى.";
            loginError.style.display = 'block';
        }
    }
}

/**
 * معالجة تسجيل الخروج
 */
function handleLogout() {
    sessionStorage.removeItem('lareen_admin_logged');
    checkAdminAuth();
}

/**
 * إعداد ورفع الصور محلياً وتحويلها إلى Base64
 */
function setupImageUpload() {
    const fileInput = document.getElementById('product-image-file');
    const previewContainer = document.getElementById('image-preview');
    
    if (!fileInput || !previewContainer) return;
    
    // النقر على الحاوية يفتح حقل اختيار الملفات
    previewContainer.addEventListener('click', () => fileInput.click());
    
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadedImageBase64 = e.target.result;
                previewContainer.innerHTML = `<img src="${uploadedImageBase64}" alt="معاينة الصورة">`;
            };
            reader.readAsDataURL(file);
        }
    });
}

/**
 * عرض قائمة المنتجات في جدول لوحة التحكم
 */
async function renderAdminProductsTable() {
    const products = await getProducts();
    const tableBody = document.getElementById('admin-products-tbody');
    
    if (!tableBody) return;
    
    if (products.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; color: var(--color-text-muted); padding: 30px;">
                    لا توجد منتجات معروضة حالياً. أضيفي منتجاً جديداً الآن!
                </td>
            </tr>
        `;
        return;
    }
    
    tableBody.innerHTML = products.map((product, index) => {
        const formattedPrice = Number(product.price).toLocaleString('ar-YE');
        return `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <img src="${product.image}" class="admin-product-thumb" onerror="this.src='https://picsum.photos/50/60?random=${product.id}'">
                </td>
                <td style="font-weight: bold;">${product.name}</td>
                <td><span class="product-badge" style="background-color: var(--color-dark-brown); font-size: 0.75rem; color: var(--color-white); position: static;">${product.category}</span></td>
                <td style="color: var(--color-wine); font-weight: bold;">${formattedPrice} ريال</td>
                <td>
                    <div class="table-actions">
                        <button onclick="editProduct(${product.id})" class="btn-table-edit" style="cursor: pointer; border: none;"><i class="fas fa-edit"></i> تعديل</button>
                        <button onclick="deleteProduct(${product.id})" class="btn-table-delete" style="cursor: pointer; border: none;"><i class="fas fa-trash"></i> حذف</button>
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

/**
 * معالجة نموذج إضافة أو تعديل منتج
 */
async function handleProductFormSubmit(e) {
    e.preventDefault();
    
    const name = document.getElementById('product-name').value.trim();
    const price = parseInt(document.getElementById('product-price').value);
    const category = document.getElementById('product-category').value;
    const description = document.getElementById('product-desc').value.trim();
    
    if (!name || !price || !category || !description) {
        alert("يرجى ملء جميع الحقول المطلوبة!");
        return;
    }
    
    let products = await getProducts();
    
    // تحديد مسار الصورة
    let imageUrl = "https://picsum.photos/400/530?random=" + Math.floor(Math.random() * 1000);
    if (uploadedImageBase64) {
        imageUrl = uploadedImageBase64;
    } else if (editingProductId !== null) {
        // إذا كان تعديلاً ولم يتم رفع صورة جديدة، نحتفظ بالصورة القديمة
        const oldProduct = products.find(p => p.id === editingProductId);
        if (oldProduct) {
            imageUrl = oldProduct.image;
        }
    }
    
    if (editingProductId !== null) {
        // حالة تعديل منتج قائم
        products = products.map(product => {
            if (product.id === editingProductId) {
                return {
                    ...product,
                    name,
                    price,
                    category,
                    description,
                    image: imageUrl
                };
            }
            return product;
        });
        alert("تم تحديث المنتج بنجاح!");
    } else {
        // حالة إضافة منتج جديد
        //const mid=products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
        
           
            
        
        const newProduct = {
            id: products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1,
            name,
            price,
            category,
            description,
            image: imageUrl,
            created_at: new Date().toISOString().split('T')[0]
        };
        products.push(newProduct);
        alert("تم إضافة المنتج بنجاح!");
    }
    
    // حفظ في LocalStorage وإعادة عرض الجدول وإعادة ضبط النموذج
    saveProductsToStorage(products);
    await renderAdminProductsTable();
    resetProductForm();
    
    // إذا كنا في صفحة المنتجات أو الرئيسية، فستظهر التغييرات تلقائياً عند التحديث
}

/**
 * بدء تعديل منتج وجلب بياناته للنموذج
 */
async function editProduct(id) {
    const products = await getProducts();
    const product = products.find(p => p.id === id);
    
    if (!product) return;
    
    editingProductId = id;
    
    // ملء الحقول
    document.getElementById('product-name').value = product.name;
    document.getElementById('product-price').value = product.price;
    document.getElementById('product-category').value = product.category;
    document.getElementById('product-desc').value = product.description;
    
    // إظهار معاينة الصورة الحالية
    const previewContainer = document.getElementById('image-preview');
    if (previewContainer) {
        previewContainer.innerHTML = `<img src="${product.image}" alt="معاينة الصورة" onerror="this.src='https://picsum.photos/400/530?random=${product.id}'">`;
    }
    
    // تغيير نصوص النموذج والزر
    document.getElementById('form-submit-btn').innerHTML = '<i class="fas fa-save"></i> تحديث المنتج';
    document.getElementById('btn-cancel-edit').style.display = 'inline-flex';
    document.getElementById('admin-form-title').innerText = 'تعديل بيانات العباية';
    
    // التمرير لأعلى النموذج
    document.getElementById('admin-form-card').scrollIntoView({ behavior: 'smooth' });
}

/**
 * حذف منتج بعد التأكيد
 */
async function deleteProduct(id) {
    if (!confirm("هل أنت متأكد من رغبتك في حذف هذا المنتج نهائياً؟")) {
        return;
    }
    
    let products = await getProducts();
    products = products.filter(p => p.id !== id);
    
    saveProductsToStorage(products);
    await renderAdminProductsTable();
    
    // إعادة ضبط النموذج في حال تم النقر على حذف أثناء تعديل نفس المنتج
    if (editingProductId === id) {
        resetProductForm();
    }
    
    alert("تم حذف المنتج بنجاح!");
}

/**
 * إعادة ضبط النموذج وإلغاء وضع التعديل
 */
function resetProductForm() {
    editingProductId = null;
    uploadedImageBase64 = "";
    
    const form = document.getElementById('product-form');
    if (form) form.reset();
    
    const previewContainer = document.getElementById('image-preview');
    if (previewContainer) {
        previewContainer.innerHTML = `
            <i class="fas fa-cloud-upload-alt"></i>
            <span>اضغطي لرفع صورة العباية</span>
            <span style="font-size: 0.7rem; display: block; margin-top: 5px;">(أو سيتم استخدام صورة تلقائية)</span>
        `;
    }
    
    const submitBtn = document.getElementById('form-submit-btn');
    if (submitBtn) submitBtn.innerHTML = '<i class="fas fa-plus"></i> حفظ المنتج';
    
    const cancelBtn = document.getElementById('btn-cancel-edit');
    if (cancelBtn) cancelBtn.style.display = 'none';
    
    const formTitle = document.getElementById('admin-form-title');
    if (formTitle) formTitle.innerText = 'إضافة منتج جديد';
}

// جعل الوظائف متاحة في النافذة العامة ليتم الاتصال بها من زر الجدول
window.editProduct = editProduct;
window.deleteProduct = deleteProduct;

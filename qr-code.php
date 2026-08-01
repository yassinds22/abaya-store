<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رمز الاستجابة السريع QR | لارين عباية</title>
    <meta name="description" content="امسحي رمز الاستجابة السريعة (QR Code) لزيارة متجر لارين عباية مباشرة من هاتفك، أو قومي بتحميل الرمز لمشاركته.">
    <!-- مكتبة الأيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- ملفات التنسيق المخصصة -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- مكتبة توليد الـ QR Code من CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>

    <!-- شريط الإعلان العلوي -->
    <div class="top-bar" id="top-announcement-bar">
        <div class="top-bar-announce">
            <span>🌿</span>
            <p>تشكيلة جديدة مميزة كل خميس - تابعينا ليصلكِ كل جديد</p>
        </div>
        <div class="top-bar-info">
            <span><i class="fab fa-instagram"></i> 18K متابعة</span>
            <span><i class="fab fa-facebook"></i> 12K متابعة</span>
            <span><i class="fas fa-map-marker-alt"></i> صنعاء - شميلة</span>
        </div>
    </div>

    <!-- الهيدر الرئيسي الموحد -->
    <header class="main-header" id="main-navigation-header">
        <div class="logo-container">
            <a href="index.php">
                <img src="assets/images/logo.png" alt="شعار لارين عباية" class="logo" onerror="this.src='https://placehold.co/200x80/2c1810/d4af37?text=Lareen+Abaya'">
            </a>
        </div>
        
        <button class="menu-toggle" id="menu-mobile-btn" aria-label="قائمة التنقل">
            <i class="fas fa-bars"></i>
        </button>

        <nav class="nav-container">
            <ul class="nav-links" id="navigation-menu-links">
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="products.php">المنتجات</a></li>
                <li><a href="about.php">عن المحل</a></li>
                <li><a href="contact.php">اتصل بنا</a></li>
                <li class="active"><a href="qr-code.php">رمز QR</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="admin.php" class="admin-link-btn" id="go-to-admin-btn">
                <i class="fas fa-user-cog"></i>
                <span>لوحة التحكم</span>
            </a>
        </div>
    </header>

    <!-- محتوى صفحة QR Code -->
    <main class="section">
        <div class="qr-card">
            <h1 class="section-title" style="font-size: 1.8rem; margin-bottom: 10px;">رمز الاستجابة السريع (QR Code)</h1>
            <p class="section-desc" style="margin-top: 5px;">شاركي الكود مع صديقاتكِ أو قومي بطباعته ووضعه في المحل ليسهل زيارة المتجر</p>
            
            <!-- حاوية الـ QR Code مع الشعار المتراكب في المنتصف -->
            <div class="qr-container">
                <div id="qrcode"></div>
                <!-- شعار متراكب في المنتصف بشكل أنيق ومحمي بـ CorrectLevel High للـ QR -->
                <div class="qr-logo-overlay">
                    <img src="assets/images/logo.png" id="qr-logo-img" alt="شعار صغير" onerror="this.src='https://placehold.co/50x50/2c1810/d4af37?text=LA'">
                </div>
            </div>
            
            <p class="qr-instructions">✨ امسحي الكود بواسطة كاميرا هاتفكِ لزيارة متجرنا مباشرة ✨</p>
            
            <div style="display: flex; gap: 15px; justify-content: center; max-width: 300px; margin: 0 auto;">
                <button onclick="downloadQRCode()" class="btn btn-primary" style="flex-grow: 1; padding: 12px 20px;">
                    <i class="fas fa-download"></i>
                    <span>تحميل الكود PNG</span>
                </button>
            </div>
        </div>
    </main>

    <!-- الفوتر الرئيسي الموحد -->
    <footer class="main-footer" id="main-site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>لارين عباية (Lareen Abaya)</h3>
                <p class="footer-about-text">
                    علامة تجارية متخصصة في تصميم وبيع العبايات الخليجية والملكية الراقية. نتميز باستخدام أجود أنواع الأقمشة والتطريز اليدوي الدقيق الذي يمنحكِ حضوراً ملكياً في كل مناسبة.
                </p>
                <div class="social-links-row">
                    <a href="https://instagram.com" target="_blank" class="social-icon-btn social-instagram" aria-label="انستغرام لارين عباية"><i class="fab fa-instagram"></i></a>
                    <a href="https://facebook.com" target="_blank" class="social-icon-btn social-facebook" aria-label="فيسبوك لارين عباية"><i class="fab fa-facebook"></i></a>
                    <a href="https://tiktok.com" target="_blank" class="social-icon-btn social-tiktok" aria-label="تيك توك لارين عباية"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>روابط سريعة</h3>
                <ul class="footer-links">
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="products.php">المنتجات والعبايات</a></li>
                    <li><a href="about.php">عن المحل وقصتنا</a></li>
                    <li><a href="contact.php">تواصل معنا</a></li>
                    <li><a href="qr-code.php">رمز الـ QR الخاص بنا</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>معلومات التواصل</h3>
                <ul class="footer-contact-list">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>صنعاء - سوق شميلة - شارع 2 - جوار العلوي للعبايات</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>773185534</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>السبت - الخميس: 9:00 صباحاً - 9:30 مساءً<br>الجمعة: 4:00 عصراً - 9:30 مساءً</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>جميع الحقوق محفوظة &copy; 2026 لمتجر <span>لارين عباية</span>.</p>
            <p>صنع بكل حب في صنعاء 🌸</p>
        </div>
    </footer>

    <!-- منطق توليد وتنزيل الـ QR المخصص -->
    <script>
        // الحصول على الرابط الحالي للموقع أو الافتراضي
        const siteUrl = window.location.origin + window.location.pathname.replace('qr-code.html', 'index.html');
        
        // توليد رمز الاستجابة السريعة باللون الذهبي
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: siteUrl,
            width: 256,
            height: 256,
            colorDark : "#D4AF37", // لون النقاط الذهبي للمحل
            colorLight : "#FFFFFF", // خلفية بيضاء
            correctLevel : QRCode.CorrectLevel.H // مستوى تصحيح عالي لإتاحة وضع الشعار في المنتصف
        });

        // تنزيل كملف PNG مدمج مع الشعار
        function downloadQRCode() {
            // البحث عن عنصر canvas الناتج عن مكتبة QRCode
            const qrCanvas = document.querySelector("#qrcode canvas");
            
            if (!qrCanvas) {
                alert("جاري تحميل رمز الـ QR، يرجى الانتظار ثانية ثم المحاولة مجدداً.");
                return;
            }
            
            // إنشاء canvas مؤقت للدمج
            const tempCanvas = document.createElement("canvas");
            tempCanvas.width = qrCanvas.width;
            tempCanvas.height = qrCanvas.height;
            const ctx = tempCanvas.getContext("2d");
            
            // رسم الـ QR Code الأصلي
            ctx.drawImage(qrCanvas, 0, 0);
            
            // جلب صورة الشعار ورسمها في المنتصف
            const logoImg = document.getElementById("qr-logo-img");
            
            // إذا كانت الصورة محملة نقوم برسمها في منتصف الكود
            const drawLogoAndDownload = () => {
                const logoSize = tempCanvas.width * 0.22; // الشعار يمثل 22% من حجم الكود
                const x = (tempCanvas.width - logoSize) / 2;
                const y = (tempCanvas.height - logoSize) / 2;
                
                // رسم دائرة خلفية بيضاء للشعار
                ctx.beginPath();
                ctx.arc(tempCanvas.width / 2, tempCanvas.height / 2, (logoSize / 2) + 4, 0, 2 * Math.PI);
                ctx.fillStyle = "#FFFFFF";
                ctx.fill();
                ctx.lineWidth = 2;
                ctx.strokeStyle = "#D4AF37";
                ctx.stroke();
                
                // رسم الشعار نفسه
                ctx.drawImage(logoImg, x, y, logoSize, logoSize);
                
                // بدء التنزيل الفعلي
                const dataUrl = tempCanvas.toDataURL("image/png");
                const link = document.createElement("a");
                link.download = "Lareen-Abaya-QR.png";
                link.href = dataUrl;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };

            // التحقق مما إذا كان الشعار مكتملاً أو به خطأ
            if (logoImg.complete && logoImg.naturalWidth !== 0) {
                drawLogoAndDownload();
            } else {
                // إذا لم يكتمل رسمه ننتظر تحميله أو نكتفي برسم QR فقط
                logoImg.onload = drawLogoAndDownload;
                logoImg.onerror = () => {
                    // إذا حدث خطأ، نقوم بالتنزيل بدون شعار
                    const dataUrl = qrCanvas.toDataURL("image/png");
                    const link = document.createElement("a");
                    link.download = "Lareen-Abaya-QR.png";
                    link.href = dataUrl;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                };
            }
        }
    </script>
    <script src="assets/js/whatsapp.js"></script>
    <script src="assets/js/products.js"></script>
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

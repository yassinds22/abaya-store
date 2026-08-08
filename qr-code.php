<?php
$currentPage     = 'qr-code';
$pageTitle       = 'رمز الاستجابة السريع QR | لارين عباية';
$pageDescription = 'امسحي رمز الاستجابة السريعة (QR Code) لزيارة متجر لارين عباية مباشرة من هاتفك، أو قومي بتحميل الرمز لمشاركته.';
// تحميل مكتبة QR في الـ head
$extraHead = '<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>';
require_once 'includes/header.php';
?>

    <!-- محتوى صفحة QR Code -->
    <main class="section">
        <div class="qr-card">
            <h1 class="section-title" style="font-size: 1.8rem; margin-bottom: 10px;">رمز الاستجابة السريع (QR Code)</h1>
            <p class="section-desc" style="margin-top: 5px;">شاركي الكود مع صديقاتكِ أو قومي بطباعته ووضعه في المحل ليسهل زيارة المتجر</p>

            <!-- حاوية الـ QR Code مع الشعار المتراكب -->
            <div class="qr-container">
                <div id="qrcode"></div>
                <div class="qr-logo-overlay">
                    <img src="assets/images/logo.png" id="qr-logo-img" alt="شعار صغير"
                         onerror="this.src='https://placehold.co/50x50/2c1810/d4af37?text=LA'">
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

<?php
$extraScripts = <<<JS
<script>
    const siteUrl = window.location.origin + window.location.pathname.replace('qr-code.php', 'index.php');

    const qrcode = new QRCode(document.getElementById("qrcode"), {
        text: siteUrl,
        width: 256,
        height: 256,
        colorDark : "#D4AF37",
        colorLight : "#FFFFFF",
        correctLevel : QRCode.CorrectLevel.H
    });

    function downloadQRCode() {
        const qrCanvas = document.querySelector("#qrcode canvas");
        if (!qrCanvas) {
            alert("جاري تحميل رمز الـ QR، يرجى الانتظار ثانية ثم المحاولة مجدداً.");
            return;
        }
        const tempCanvas = document.createElement("canvas");
        tempCanvas.width  = qrCanvas.width;
        tempCanvas.height = qrCanvas.height;
        const ctx = tempCanvas.getContext("2d");
        ctx.drawImage(qrCanvas, 0, 0);

        const logoImg = document.getElementById("qr-logo-img");
        const drawLogoAndDownload = () => {
            const logoSize = tempCanvas.width * 0.22;
            const x = (tempCanvas.width  - logoSize) / 2;
            const y = (tempCanvas.height - logoSize) / 2;
            ctx.beginPath();
            ctx.arc(tempCanvas.width / 2, tempCanvas.height / 2, (logoSize / 2) + 4, 0, 2 * Math.PI);
            ctx.fillStyle = "#FFFFFF";
            ctx.fill();
            ctx.lineWidth = 2;
            ctx.strokeStyle = "#D4AF37";
            ctx.stroke();
            ctx.drawImage(logoImg, x, y, logoSize, logoSize);
            const dataUrl = tempCanvas.toDataURL("image/png");
            const link = document.createElement("a");
            link.download = "Lareen-Abaya-QR.png";
            link.href = dataUrl;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        if (logoImg.complete && logoImg.naturalWidth !== 0) {
            drawLogoAndDownload();
        } else {
            logoImg.onload  = drawLogoAndDownload;
            logoImg.onerror = () => {
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
JS;
require_once 'includes/footer.php';
?>

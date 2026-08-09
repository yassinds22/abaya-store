let WHATSAPP_NUMBER = "967773185534";

/**
 * تحديث رقم الواتساب الموحد ديناميكياً من الإعدادات
 */
function setWhatsAppNumber(number) {
    if (number && number.trim()) {
        WHATSAPP_NUMBER = number.trim().replace(/[^0-9]/g, '');
    }
}

/**
 * إرسال طلب شراء عباية عبر الواتساب برسالة منسقة
 * @param {string} productName - اسم العباية
 * @param {number|string} price - سعر العباية
 * @param {string} paymentMethod - طريقة الدفع المختارة
 */paymentMethod
function sendWhatsAppOrder(productName, price,  = "غير محدد بعد") {
    // تنسيق الرسالة باللغة العربية مع إيموجي لطيفة
    const message = `السلام عليكم 🌸
أرغب بطلب: ${productName}
السعر: ${price} ريال يمني
طريقة الدفع: ${paymentMethod}
شكراً لكم!`;

    // ترميز الرسالة لتناسب رابط الويب
    const encodedText = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodedText}`;
    
    // فتح الرابط في تبويب جديد
    window.open(whatsappUrl, '_blank');
}

/**
 * فتح دردشة مباشرة عامة للاستفسار
 */
function openGeneralWhatsAppChat() {
    const message = `السلام عليكم ورحمة الله وبركاته 🌸
أود الاستفسار عن التشكيلات المتوفرة لديكم في متجر لارين عباية.`;
    const encodedText = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodedText}`;
    window.open(whatsappUrl, '_blank');
}

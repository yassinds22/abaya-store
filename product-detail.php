<?php
$currentPage     = 'product-detail';
$pageTitle       = 'تفاصيل العباية | لارين عباية';
$pageDescription = 'تصفحي صور وتفاصيل هذه العباية الفاخرة، اختاري طريقة الدفع المفضلة، واطلبيها مباشرة عبر الواتساب.';
require_once 'includes/header.php';
?>

    <!-- حاوية تفاصيل المنتج -->
    <main class="section">
        <div class="product-detail-container" id="product-detail-layout">
            <!-- عمود معرض الصور -->
            <div class="product-gallery">
                <div class="product-main-img-wrapper">
                    <img src="" alt="صورة المنتج الرئيسية" id="product-main-img" class="product-main-img">
                </div>
                <div class="product-thumbs" id="product-thumb-container">
                    <!-- سيتم إضافتها عبر JS -->
                </div>
            </div>

            <!-- عمود البيانات التفصيلية -->
            <div class="product-info-panel">
                <span class="product-category-tag" id="product-category">القسم</span>
                <h1 class="product-title-large" id="product-title">اسم العباية</h1>
                <div class="product-price-large" id="product-price">0 <span>ريال يمني</span></div>

                <p class="product-description-text" id="product-desc">
                    وصف تفصيلي للعباية ونوع القماش والتفريعات...
                </p>

                <!-- قسم الخيارات وإرسال الطلب -->
                <div class="order-actions-section">
                    <!-- اختيار طريقة الدفع المبدئية -->
                    <div class="payment-method-selector">
                        <label>طريقة الدفع المقترحة للطلب:</label>
                        <div class="payment-options-grid">
                            <div class="payment-option-card selected" data-payment="جيب (773185534)">
                                <i class="fas fa-wallet"></i>
                                <span>💳 جيب</span>
                            </div>
                            <div class="payment-option-card" data-payment="جوال (773185534)">
                                <i class="fas fa-mobile-alt"></i>
                                <span>📱 جوال</span>
                            </div>
                            <div class="payment-option-card" data-payment="محفظتي (773185534)">
                                <i class="fas fa-university"></i>
                                <span>🏦 محفظتي</span>
                            </div>
                        </div>
                    </div>

                    <!-- زر الطلب عبر الواتساب -->
                    <button class="btn btn-whatsapp" id="btn-order-whatsapp" style="font-size: 1.1rem; padding: 15px;">
                        <i class="fab fa-whatsapp" style="font-size: 1.5rem;"></i>
                        <span>اطلب الآن عبر واتساب</span>
                    </button>
                </div>

                <!-- تفاصيل الدفع والإرشادات -->
                <div class="payment-details-box">
                    <h3 class="payment-details-title"><i class="fas fa-info-circle" style="color: var(--color-gold);"></i> تفاصيل حسابات الدفع المتوفرة:</h3>

                    <div class="payment-cards">
                        <div class="payment-card-item card-jeeb">
                            <div class="payment-card-logo"><i class="fas fa-wallet"></i></div>
                            <div class="payment-card-name">جيب (Jeeb)</div>
                            <div class="payment-card-number">773185534</div>
                        </div>
                        <div class="payment-card-item card-jawal">
                            <div class="payment-card-logo"><i class="fas fa-mobile-alt"></i></div>
                            <div class="payment-card-name">جوال (Jawal)</div>
                            <div class="payment-card-number">773185534</div>
                        </div>
                        <div class="payment-card-item card-mahfazati">
                            <div class="payment-card-logo"><i class="fas fa-university"></i></div>
                            <div class="payment-card-name">محفظتي (M-Wallet)</div>
                            <div class="payment-card-number">773185534</div>
                        </div>
                    </div>

                    <div class="payment-instructions">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>بعد التحويل، يرجى إرسال صورة إيصال التحويل عبر الواتساب لتأكيد طلبك وتجهيزه للشحن أو الاستلام فوراً.</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require_once 'includes/footer.php'; ?>

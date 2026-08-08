<?php
/**
 * views/form.php
 * -----------------------------------------------
 * نموذج إضافة وتعديل المنتج
 * يُضمَّن داخل dashboard.php كجزء مستقل
 * -----------------------------------------------
 */
?>

<div class="admin-card" id="admin-form-card">
    <h2 id="admin-form-title">إضافة منتج جديد</h2>
    <form id="product-form">

        <div class="form-group">
            <label for="product-name" class="form-label">اسم العباية *</label>
            <input type="text" id="product-name" class="form-control" placeholder="مثال: عباية ملكية مطرزة" required>
        </div>

        <div class="form-group">
            <label for="product-price" class="form-label">السعر (ريال يمني) *</label>
            <input type="number" id="product-price" class="form-control" placeholder="مثال: 30000" min="0" required>
        </div>

        <div class="form-group">
            <label for="product-category" class="form-label">القسم *</label>
            <select id="product-category" class="form-control" style="background-color: var(--color-white);" required>
                <option value="" disabled selected>اختر القسم المناسب</option>
                <option value="آخر الوافدين">آخر الوافدين</option>
                <option value="الأكثر طلباً">الأكثر طلباً</option>
                <option value="الكلاسيكية">الكلاسيكية</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product-desc" class="form-label">الوصف الكامل والمميزات *</label>
            <textarea id="product-desc" class="form-control" placeholder="تفاصيل حول نوع القماش، نوع التطريز، المقاسات المتوفرة..." required></textarea>
        </div>

        <!-- رفع الصورة كـ Base64 -->
        <div class="form-group">
            <label class="form-label">صورة العباية *</label>
            <input type="file" id="product-image-file" accept="image/*" style="display: none;">
            <div class="image-upload-preview" id="image-preview">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>اضغطي لرفع صورة العباية</span>
                <span style="font-size: 0.7rem; display: block; margin-top: 5px;">(أو سيتم استخدام صورة تلقائية)</span>
            </div>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" id="form-submit-btn" class="btn btn-primary" style="flex-grow: 1;"><i class="fas fa-plus"></i> حفظ المنتج</button>
            <button type="button" id="btn-cancel-edit" class="btn btn-secondary" style="border-color: var(--color-wine); color: var(--color-wine); display: none;"><i class="fas fa-times"></i> إلغاء التعديل</button>
        </div>

    </form>
</div>

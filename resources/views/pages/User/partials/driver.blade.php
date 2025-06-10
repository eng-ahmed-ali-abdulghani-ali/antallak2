@extends('pages.User.partials.create')
@section('type_User', 'إضافة مندوب توصيل')

@section('role-fields')

  <div class="row g-3">

    {{-- بيانات شخصية --}}
    <div class="col-12">
    <div class="card shadow-sm rounded-4 border-primary">
      <div class="card-header bg-primary text-white rounded-top-4">
      <h5 class="card-title mb-0">البيانات الشخصية</h5>
      </div>
      <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6 form-floating">
        <input type="text" name="name" class="form-control" id="name" placeholder="الاسم" required>
        <label for="name">الاسم</label>
        </div>

        <div class="col-md-6 form-floating">
        <input type="text" name="phone" class="form-control" id="phone" placeholder="رقم الجوال" required>
        <label for="phone">رقم الجوال</label>
        </div>
        <div class="col-md-6 form-floating position-relative">
        <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required
          minlength="8" title="يجب أن تحتوي كلمة المرور على الأقل على 8 أحرف، حرف كبير، حرف صغير، رقم، ورمز خاص">
        <label for="password">كلمة المرور</label>
        <button type="button" class="btn btn-link position-absolute end-0 top-0 mt-3 me-2 toggle-password"
          aria-label="إظهار/إخفاء كلمة المرور">
        </button>
        <div class="form-text">يجب أن تحتوي على 8 أحرف على الأقل، حرف كبير، حرف صغير، رقم، ورمز خاص</div>
        </div>
        <div class="col-md-6 form-floating">
        <select name="nationality" id="nationality" class="form-control">
          <option value="">اختر الجنسية</option>
          @foreach ($nationalities as $nationality)
        <option value="{{ $nationality }}">{{ $nationality }}</option>
      @endforeach
        </select>
        <label for="nationality">الجنسية</label>
        </div>
        <div class="col-md-6 form-floating">
        <input type="date" name="birth_date" class="form-control" id="birth_date" placeholder="تاريخ الميلاد">
        <label for="birth_date">تاريخ الميلاد</label>
        </div>

        <div class="col-md-6 form-floating">
        <input type="text" name="iqama_number" class="form-control" id="iqama" placeholder="رقم الإقامة">
        <label for="iqama">رقم الإقامة</label>
        </div>
      </div>
      </div>
    </div>
    </div>

    {{-- بيانات الرخصة والمركبة --}}
    <div class="col-12">
    <div class="card shadow-sm rounded-4 border-info">
      <div class="card-header bg-success text-white rounded-top-4">
      <h5 class="card-title mb-0">معلومات الرخصة والمركبة</h5>
      </div>
      <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6 form-floating">
        <input type="date" name="license_expiry" class="form-control" id="license_expiry"
          placeholder="تاريخ انتهاء الرخصة">
        <label for="license_expiry">تاريخ انتهاء الرخصة</label>
        </div>

        <div class="col-md-6 form-floating">
        <select name="vehicle_type" class="form-select" id="vehicle_type" required>
          <option value="" disabled selected>اختر نوع المركبة</option>
          <option value="car">عربية</option>
          <option value="motorcycle">موتوسيكل</option>
        </select>
        <label for="vehicle_type">نوع المركبة</label>
        </div>

        <div class="col-md-6 form-floating">
        <input type="text" name="brand" class="form-control" id="brand" placeholder="اسم البراند">
        <label for="brand">اسم البراند</label>
        </div>

        <div class="col-md-6 form-floating">
        <input type="text" name="model_year" class="form-control" id="model_year" placeholder="سنة الصنع">
        <label for="model_year">سنة الصنع</label>
        </div>

        <div class="col-md-6 form-floating">
        <input type="text" name="plate_number" class="form-control" id="plate_number" placeholder="رقم اللوحة">
        <label for="plate_number">رقم اللوحة</label>
        </div>

        <div class="col-md-6 form-floating">
        <select name="vehicle_type" class="form-select" id="vehicle_type" required>
          <option value="" disabled selected> اختر اسم القائد المشرف </option>
          <option value="">احمد</option>
          <option value="motorcycle">خالد</option>
        </select>
        <label for="vehicle_type"> القائد المشرف</label>
        </div>

      </div>
      </div>
    </div>
    </div>

    {{-- المستندات والصور --}}
    <div class="col-12">
    <div class="card shadow-sm rounded-4 border-warning">
      <div class="card-header bg-danger text-dark rounded-top-4">
      <h5 class="card-title mb-0">المرفقات والصور</h5>
      </div>
      <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
        <label class="form-label">صورة الإقامة من أبشر</label>
        <input type="file" name="iqama_image" class="form-control" accept="image/*">
        <small class="text-muted">يجب أن تكون الصورة واضحة ومقروءة</small>
        </div>

        <div class="col-md-6">
        <label class="form-label">صورة الرخصة من أبشر</label>
        <input type="file" name="license_image" class="form-control" accept="image/*">
        <small class="text-muted">يجب أن تكون الصورة واضحة ومقروءة</small>
        </div>

        <div class="col-md-6">
        <label class="form-label">صورة رخصة المركبة</label>
        <input type="file" name="vehicle_license_image" class="form-control" accept="image/*">
        <small class="text-muted">يجب أن تكون الصورة واضحة ومقروءة</small>
        </div>

        <div class="col-md-6">
        <label class="form-label">صورة سيلفي للمندوب</label>
        <input type="file" name="selfie_image" class="form-control" accept="image/*">
        <small class="text-muted">يجب أن تكون الصورة واضحة للوجه</small>
        </div>

        <div class="col-md-6">
        <label class="form-label">صورة المركبة من الأمام</label>
        <input type="file" name="vehicle_front_image" class="form-control" accept="image/*">
        <small class="text-muted">يجب أن تكون الصورة واضحة للوحة الأمامية</small>
        </div>

        <div class="col-md-6">
        <label class="form-label">صورة المركبة من الخلف</label>
        <input type="file" name="vehicle_back_image" class="form-control" accept="image/*">
        <small class="text-muted">يجب أن تكون الصورة واضحة للوحة الخلفية</small>
        </div>
      </div>
      </div>
    </div>
    </div>

    {{-- أزرار الحفظ والإلغاء --}}


  </div>
@endsection
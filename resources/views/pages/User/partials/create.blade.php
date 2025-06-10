@extends('layouts.app')

@section('title', 'إضافة مستخدم جديد')

@section('content')
  <div class="container py-4">
    <div class="card shadow-sm rounded-3">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">
      <i class="fas fa-user-plus me-2"></i>
      @yield('type_User')
      </h4>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" id="userForm" novalidate>
      @csrf

      <!-- رسائل التحذير والأخطاء -->
      @if($errors->any())
      <div class="alert alert-danger mb-4">
        <ul class="mb-0">
        @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
        </ul>
      </div>
    @endif

      <!-- حقول الدور المحدد -->
      <div class="row g-3">
        @yield('role-fields')
      </div>

      <!-- أزرار الحفظ والإلغاء -->
      <div class="d-flex justify-content-end mt-4">
        <button type="button" class="btn btn-outline-secondary me-2 px-4 rounded-pill" onclick="history.back()">
        <i class="fas fa-times me-1"></i> إلغاء
        </button>
        <button type="submit" class="btn btn-primary px-4 rounded-pill">
        <i class="fas fa-save me-1"></i> حفظ البيانات
        </button>
      </div>
      </form>
    </div>
    </div>
  </div>

  @section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // التحقق من الصحة عند الإرسال
    const form = document.getElementById('userForm');

    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
      }

      form.classList.add('was-validated');
    }, false);

    // إضافة علامة النجمة للحقول المطلوبة
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
      const label = form.querySelector(`label[for="${field.id}"]`);
      if (label && !label.innerHTML.includes('*')) {
      label.innerHTML += ' <span class="text-danger">*</span>';
      }
    });
    });
    </script>
  @endsection

@endsection
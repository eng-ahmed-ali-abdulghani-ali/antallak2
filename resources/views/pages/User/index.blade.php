@extends('layouts.app')

@section('title')
  كل المستخدمين
@endsection

@section('content')
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>المستخدمين</h2>
    <a class="btn btn-success" style="transition: background-color 0.3s ease;" data-bs-toggle="modal"
      data-bs-target="#chooseRoleModal">
      إضافة مستخدم جديد
    </a>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
      <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>الصورة</th>
        <th>الإجراءات</th>
      </tr>
      </thead>
      <tbody>
      @forelse ($users as $user)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td style="font-weight: bold">{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
        @if($user->image_url)
      <img src="{{ $user->image_url }}" alt="User Image" style="width: 60px; height: 40px; object-fit: cover;">
      @else
      <span class="text-muted">لا توجد صورة</span>
      @endif
        </td>
        <td>
        <a class="btn btn-sm btn-primary me-2" href="{{ route('user.edit', $user->id) }}">
        <i class="fa fa-edit"></i>
        </a>
        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
        id="delete-form-{{ $user->id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeletion({{ $user->id }})">
        <i class="fa fa-trash"></i>
        </button>
        </form>
        </td>
      </tr>
    @empty
      <tr>
      <td colspan="5">لا يوجد مستخدمين حاليا</td>
      </tr>
    @endforelse
      </tbody>
    </table>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
    <i class="fa fa-arrow-left direction-aware-icon"></i>
    رجوع
    </a>
  </div>

  {{-- Choose Role Modal --}}
  <div class="modal fade" id="chooseRoleModal" tabindex="-1" aria-labelledby="chooseRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-success text-white">
      <h5 class="modal-title" id="chooseRoleModalLabel">اختر دور المستخدم</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
      <p class="mb-4">من فضلك اختر نوع المستخدم الذي تريد إضافته:</p>

      <div class="d-grid gap-2">
        <button class="btn btn-outline-danger" onclick="redirectToCreateUser('leader')">مسؤول</button>
        <button class="btn btn-outline-primary" onclick="redirectToCreateUser('admin')">قائد</button>
        <button class="btn btn-outline-success" onclick="redirectToCreateUser('driver')">سائق</button>
        <button class="btn btn-outline-secondary" onclick="redirectToCreateUser('user')">مستخدم</button>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDeletion(id) {
    Swal.fire({
      title: 'هل أنت متأكد؟',
      text: 'سيتم حذف المستخدم بشكل نهائي!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'نعم، احذفه!'
    }).then((result) => {
      if (result.isConfirmed) {
      document.getElementById('delete-form-' + id).submit();
      }
    });
    }

    function redirectToCreateUser(role) {
    const url = `/users/create?role=${role}`;
    window.location.href = url;
    }
  </script>
@endpush
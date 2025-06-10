{{-- resources/views/users/create.blade.php --}}
@extends('layouts.app')

@section('title', 'إضافة مستخدم')

@section('content')
  <div class="container">
    <h2 class="mb-4">@yield('type_User')</h2>

    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- عناصر مشتركة مثل الاسم والبريد وكلمة المرور --}}


    {{-- باقي الحقول العامة... --}}

    {{-- هنا هيتم إدراج حقول الدور المحدد --}}
    @yield('role-fields')


@endsection
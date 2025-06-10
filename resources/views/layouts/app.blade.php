<!DOCTYPE html>
<html lang="ar " dir="rtl">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - Admin Dashboard</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('dashboard/layoutstyle.css') }}">


</head>

<body>

  {{-- Header --}}
  <div class="header">
    <button id="toggleSidebar" class="toggle-btn"><i class="fas fa-bars"></i></button>
    <h5 class="mb-0">@yield('title')</h5>
    <div class="localization-switcher">
      <a href="{{ url('/lang/en') }}" class="language-option">
        <img src="https://alsaifco-ksa.com/Dashboard/assets/Front/assets/img/usa.png" class="language-flag" alt="EN">
        <span class="language-label">EN</span>
      </a>
      <div class="language-separator"></div>
      <a href="{{ url('/lang/ar') }}" class="language-option">
        <img src="https://alsaifco-ksa.com/Dashboard/assets/Front/assets/img/ksa.png" class="language-flag" alt="AR">
        <span class="language-label">ع</span>
      </a>
    </div>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
      class="btn btn-outline-danger btn-sm">
      {{ __('messages.logout') }} <i class="fas fa-sign-out-alt ms-1"></i>
    </a>
    <form id="logout-form" action="" method="POST" style="display: none;">@csrf</form>
  </div>
  {{-- Sidebar --}}
  <div class="sidebar" id="sidebar">

    <a href="#"><i class="fa-solid fa-users me-2"></i> المستخدمين</a>
    <a href="{{ url('/category') }}"><i class="fa-solid fa-list me-2"></i>
      الفئات </a>
    <a href="#"><i class="fa-brands fa-product-hunt me-2"></i> Packages</a>
    <a href="#"><i class="fa-solid fa-circle-question me-2"></i> Questions</a>
    <a href="#"><i class="fa-solid fa-money-check-dollar me-2"></i> Subscriptions</a>
    <a href="#"><i class="fa-solid fa-atom me-2"></i> Promo Codes</a>
    <a href="#"><i class="fa-solid fa-star me-2"></i> Question Notes</a>
    <a href="#"><i class="fa-solid fa-gears me-2"></i> Settings</a>
    <a href="#"><i class="fa-solid fa-calendar-days me-2"></i> Exam Dates</a>
    <a href="#"><i class="fa-solid fa-address-card me-2"></i> About Us</a>

  </div>

  {{-- Main Content --}}
  <div id="mainContent">
    @yield('content')
  </div>

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>

    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      mainContent.classList.toggle('shifted');
    });
  </script>

  @stack('scripts')
</body>

</html>
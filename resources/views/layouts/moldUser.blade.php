<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== BOXICONS ===============-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!--=============== CSS ===============-->
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/logo/logo1.png') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/side.css') }}" />
    @stack('style-alt')
    @vite(['resources/css/styles-user.css', 'resources/js/styles-user.js'])
    <title>Hanoitourist</title>
</head>
<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container" id="nav_header">
            <a href="{{ route('homepage') }}" class="nav__logo"><img src="{{ asset('frontend/assets/images/logo/logo2.png') }}" alt="" width="250px" height="250px"/></a>

            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('homepage') }}" class="nav__link {{ request()->is('/') ? ' active-link' : '' }}">
                            <i class="bx bx-home-alt"></i>
                            <span>Trang Chủ</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('tourDuLich') }}" class="nav__link {{ request()->is('tourDuLich') || request()->is('tourDuLich/*')  ? ' active-link' : '' }}">
                            <i class="bx bx-building-house"></i>
                            <span>Tour Du Lịch</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('tintuc') }}" class="nav__link {{ request()->is('tintuc') || request()->is('tintuc/*')  ? ' active-link' : '' }}">
                            <i class="bx bx-award"></i>
                            <span>Tin Tức</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('aboutus') }}" class="nav__link {{ request()->is('aboutus') ? ' active-link' : '' }}">
                            <i class="bx bx-phone"></i>
                            <span>Về Chúng Tôi</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- theme -->
            <i class="bx bx-moon change-theme" id="theme-button"></i>
            <button href="" class="button nav__button" id="datTour">ĐẶT NGAY</button>
    
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            @if (Auth::check())
                <div style="position: relative;">
                    <a href="#" class="profile" id="profile-link">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('frontend/assets/images/avatars/default.png') }}" alt="Avatar" class="avatar" />
                    </a>
                    <ul class="dropdown-menu" id="profile-dropdown" style="top: -133px;">
                        <li id="lich_su_dat_tour">
                            <a href="{{ route('lichSuDatTour') }}" class="dropdown-item d-flex align-items-center">
                                <i class='bx bx-book-alt'></i>
                                <span>{{ __('Lịch Sử Đặt Tour') }}</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li id="thong_tin_ca_nhan">
                            <a href="{{ route('thong_tin_ca_nhan_user') }}" class="dropdown-item d-flex align-items-center">
                                <i class='bx bx-book-alt'></i>
                                <span>{{ __('Thông Tin Cá Nhân') }}</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li id="dang_xuat">
                            <form method="POST" action="{{ route('logoutUser') }}">
                                @csrf
                                <a href="{{ route('logoutUser') }}" class="dropdown-item d-flex align-items-center" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class='bx bx-log-out'></i>
                                    <span>{{ __('Đăng Xuất') }}</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        @yield('content')
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div style="margin-right: 50px;">
                <a href="{{ route('homepage') }}" class="footer__logo">
                    <img src="{{ asset('frontend/assets/images/logo/logo2.png') }}" alt="" width="200px" height="200px"/>
                </a>
                <p class="footer__description">
                    Địa chỉ: Số 18, Phố Lý Thường Kiệt, Phường Phan Chu Trinh,<br/>
                    Quận Hoàn Kiếm, Thành phố Hà Nội, Việt Nam
                </p>
            </div>

            <div class="footer__content">
                <div>
                    <h3 class="footer__title">Du Lịch Nước Ngoài</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Dubai</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Hàn Quốc</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Trung Quốc</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Du Lịch Trong Nước</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Hà Giang</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Đà Nẵng</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Phú Quốc</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Hỗ Trợ</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Câu Hỏi Thường Gặp</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Trung Tâm Hỗ Trợ</a>
                        </li>
                        <li>
                            <a href="{{ route('aboutus') }}" class="footer__link">Về Chúng Tôi</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Theo Dõi Chúng Tôi</h3>

                    <ul class="footer__social">
                        <a href="#" class="footer__social-link">
                            <i class="bx bxl-facebook-circle"></i>
                        </a>
                        <a href="#" class="footer__social-link">
                            <i class='bx bxl-whatsapp'></i>
                        </a>
                        <a href="#" class="footer__social-link">
                            <i class='bx bxl-youtube'></i>
                        </a>
                        <a href="#" class="footer__social-link">
                            <i class='bx bxl-tiktok'></i>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        
        <br><div style="font-family: Arial, sans-serif; color:#00000018">_____________________________________________________________________________________________________________________________________________________________________________________________________________________________________</div>
        <h5 style="font-family: Arial, sans-serif; color:#0000002d; text-align:center; margin-top:20px;">Copyrights © 2024 by TMC.</h5>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="bx bx-chevrons-up"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="{{ asset('frontend/assets/libraries/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('frontend/assets/libraries/swiper-bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/side.js') }}"></script>
    @stack('script-alt')
</body>
</html>
<script>
    document.getElementById('datTour').addEventListener('click', function() {
        @if(Auth::check())
            // Nếu đã đăng nhập, submit form
            window.location.href = "{{ route('tourDuLich') }}";
        @else
            // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
            window.location.href = "{{ route('login') }}";
        @endif
    });
</script>

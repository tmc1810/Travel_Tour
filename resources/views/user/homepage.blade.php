@extends('layouts.moldUser')

@section('content')
@include('includes.alert')

<!--==================== HOME ====================-->
<section>
<!--========== ISLANDS 1 ==========-->
    <div class="carousel">
        <div class="carousel-inner" id="carouselInner">
            <div class="carousel-item active">
            <img src="{{ asset('frontend/assets/images/banner/banner_1.png') }}" alt="Image 1">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('frontend/assets/images/banner/banner_2.png') }}" alt="Image 2">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('frontend/assets/images/banner/banner_3.png') }}" alt="Image 3">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('frontend/assets/images/banner/banner_4.png') }}" alt="Image 4">
            </div>
        </div>
    
        <!-- Nút điều hướng -->
        <button class="carousel-control-prev" id="prevBtn"><</button>
        <button class="carousel-control-next" id="nextBtn">></button>
    
        <!-- Chỉ báo (dots) -->
        <div class="carousel-indicators">
            <button class="active" data-slide-to="0"></button>
            <button data-slide-to="1"></button>
            <button data-slide-to="2"></button>
            <button data-slide-to="3"></button>
        </div>
    </div>
</section>

<!--==================== POPULAR ====================-->
<section class="section" id="popular">
    <div class="container">
        <span class="section__subtitle" style="text-align: center">Tour Du Lịch</span>
        <h2 class="section__title" style="text-align: center">Sự Lựa Chọn Tốt Nhất</h2>

        <div class="popular__container swiper">
            <div class="swiper-wrapper">
                @foreach($tours as $tour)
                    <article class="popular__card swiper-slide">
                        <a href="{{ route('showTourDuLich', $tour->slug) }}">
                            <img
                                src="{{ $tour->hinhAnhTours->isNotEmpty() ? asset('storage/' . $tour->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}"
                                alt="" class="popular__img" style="height: 200px; width: 300px;"/>
                            <div class="popular__data"><center>
                                <h2 class="popular__price">
                                    {{ number_format($tour->gia) }}<span> VNĐ</span>
                                </h2>
                                <h3 class="popular__title">
                                    {{ $tour->ten_tour }}
                                </h3>
                                
                                <p class="popular__description">
                                    <i class='bx bxs-notepad'></i> {{ $tour->thoigian_tour }} &nbsp &nbsp
                                    <i class='bx bx-map-pin'></i> {{ $tour->noi_khoi_hanh }}
                                </p></center>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="swiper-button-next">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="swiper-button-prev">
                <i class="bx bx-chevron-left"></i>
            </div>
        </div>
    </div>
</section>

<!--==================== VALUE ====================-->
<section class="value section" id="value">
    <div class="value__container container grid">
        <div class="value__images">
            <div class="value__orbe"></div>

            <div class="value__img">
                <img src="{{ asset('frontend/assets/images/team.jpg') }}" alt="" />
            </div>
        </div>

        <div class="value__content">
            <div class="value__data">
                <span class="section__subtitle">Vì sao chọn Hanoitourist?</span>
                <h2 class="section__title">
                    Kinh Nghiệm Của Chúng Tôi
                </h2>
                <p class="value__description">
                    Chúng tôi luôn sẵn sàng phục vụ bằng cách cung cấp dịch vụ tốt nhất cho bạn. Chúng tôi có những lựa chọn đúng đắn để đi du lịch vòng quanh thế giới.
                </p>
            </div>

            <div class="value__accordion">
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i class='bx bxs-donate-heart value-accordion-icon'></i>
                        <h3 class="value__accordion-title">
                            Sản phẩm & Dịch vụ
                        </h3>
                        <div class="value__accordion-arrow">
                            Đa dạng - Chất lượng - An toàn
                        </div>
                    </header>
                </div>
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i class='bx bxs-coupon value-accordion-icon'></i>
                        <h3 class="value__accordion-title">
                            Giá tour siêu tốt
                        </h3>
                        <div class="value__accordion-arrow">
                            Tối ưu - Tiện lợi - Chất lượng
                        </div>
                    </header>
                </div>
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i class='bx bxs-badge-dollar value-accordion-icon'></i>
                        <h3 class="value__accordion-title">
                            Thanh toán & Hỗ trợ
                        </h3>
                        <div class="value__accordion-arrow">
                            Linh hoạt - Tận tâm - Chu đáo
                        </div>
                    </header>
                </div>
                <div class="value__accordion-item">
                    <header class="value__accordion-header">
                        <i
                            class="bx bxs-check-square value-accordion-icon"
                        ></i>
                        <h3 class="value__accordion-title">
                            Đảm bảo an toàn
                        </h3>
                        <div class="value__accordion-arrow">
                            Bảo mật - Tin cậy - Lương tâm
                        </div>
                    </header>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trang Tin Tức -->
<section class="blog section" id="blog">
    <div class="blog__container container">
        <span class="section__subtitle" style="text-align: center">Tin Tức</span>
        <h2 class="section__title" style="text-align: center">Tin Nổi Bật</h2>

        <div class="blog__content grid">
            @foreach($trangTinTucs as $trangTinTuc)
                <article class="blog__card">
                    <div class="blog__image">
                        <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" 
                            alt="{{ $trangTinTuc->tieu_de }}" 
                            style="width: 100%; height: 250px;"
                            class="blog__img">  
                        <a href="{{ route('showTinTuc', $trangTinTuc->slug) }}" class="blog__button">
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>

                    <div class="blog__data">
                        <h2 class="blog__title">
                            {{ $trangTinTuc->tieu_de }}
                        </h2>
                        <p class="blog__description">
                            {{ $trangTinTuc->noidung_rutgon}}
                        </p>

                        <div class="blog__footer">
                            <div class="blog__reaction">
                                {{ date('d \T\h\á\n\g m Y', strtotime($trangTinTuc->created_at)) }}
                            </div>
                            <div class="blog__reaction">
                                <i class="bx bx-show"></i>
                                <span>{{ $trangTinTuc->doc }}</span>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
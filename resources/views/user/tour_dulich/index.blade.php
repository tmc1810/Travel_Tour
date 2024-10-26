@extends('layouts.moldUser')

@section('content')
 <!--==================== HOME ====================-->
 <section>
  <div class="swiper-container gallery-top">
    <div class="swiper-wrapper">
      <section class="islands swiper-slide">
        <img src="{{ asset('frontend/assets/images/banner/banner_travel_tour.jpg') }}" alt="" class="islands__bg" />

        <div class="bg__overlay">
          <div class="islands__container container">
              <div class="islands__data" style="z-index: 99; position: relative">
              <h2 class="islands__subtitle">HANOITOURIST</h2>
              <h1 class="islands__subtitleunderline">______________</h1>
              <h1 class="islands__title">CÁC TOUR DU LỊCH</h1>
              </div>
          </div>
      </div>
      </section>
    </div>
  </div>
</section>

<!--==================== POPULAR ====================-->
<section class="section" id="popular" style="margin-right: 300px;">
  <div class="container" >
    <span class="section__subtitle" style="margin-left: 630px;">Tất Cả</span>
    <h2 class="section__title" style="margin-left: 550px;">
      Tour Du Lịch
    </h2>
    <div class="container" style="display: flex;">
      <!-- Filter Section -->
      <aside class="filter__sidebar">
        <form action="{{ route('tim-kiem-tour') }}" method="GET">
            <h3 class="filter__title">Bộ Lọc Tìm Kiếm</h3><br>
    
            <!-- Loại Hình Du Lịch (Checkbox) -->
            <div class="filter__group">
                <label>Loại Hình Du Lịch</label>
                @foreach($loaiTours as $loaiTour)
                    <label style="display:flex;">
                        <input type="checkbox" name="loai_tour[]" value="{{ $loaiTour->id }}" style="width:30px;">&nbsp
                        <span>{{ $loaiTour->ten_loaitour }}</span>
                    </label>
                @endforeach
            </div>
    
            <!-- Tour Du Lịch (Search by Name) -->
            <div class="filter__group">
                <label for="location">Tên Tour Du Lịch</label>
                <input type="text" name="ten_tour" placeholder="Nhập Tên Tour">
            </div>
    
            <!-- Price Filter -->
            <div class="filter__group">
                <label for="price">Giá (VNĐ)</label>
                <input type="text" name="min_price" placeholder="Giá Tối Thiểu">
                <input type="text" name="max_price" placeholder="Giá Tối Đa">
            </div>
    
            <!-- Duration Filter -->
            <div class="filter__group">
                <label for="duration">Thời Gian Tour</label>
                <input type="text" name="thoigian_tour" placeholder="Số ngày: 3N2D">
            </div>
    
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" id="timKiemTourDuLich">Tìm Kiếm</button>
          </form>
      </aside>
    
      <!-- Tour Cards Section -->
      <div class="popular__all">
          @foreach($tours as $tour)
              <article class="popular__card">
                  <a href="{{ route('showTourDuLich', $tour->slug) }}">
                      <img
                          src="{{ $tour->hinhAnhTours->isNotEmpty() ? asset('storage/' . $tour->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}"
                          alt="" class="popular__img" style="height: 200px;width: 300px;"/>
                      <div class="popular__data">
                        <center>
                          <h2 class="popular__price">
                              {{ number_format($tour->gia) }}<span> VNĐ</span>
                          </h2>
                          <h3 class="popular__title">
                              {{ $tour->ten_tour }}
                          </h3>
                          
                          <p class="popular__description">
                              <i class='bx bxs-notepad'></i> {{ $tour->thoigian_tour }} &nbsp &nbsp
                              <i class='bx bx-map-pin'></i> {{ $tour->noi_khoi_hanh }}
                          </p>
                        </center>
                      </div>  
                  </a>
              </article>
          @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
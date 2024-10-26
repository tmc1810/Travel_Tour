@extends('layouts.moldUser')

@section('content')

 <!--==================== HOME ====================-->
 <section>
  <div class="swiper-container gallery-top">
    <div class="swiper-wrapper">
      <section class="islands swiper-slide">
        <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" alt="" class="islands__bg" />
      </section>
    </div>
  </div>
</section>

      <!-- blog -->
      <section class="blog section" id="blog">
        <div class="blog__container container">
          <div class="content__container">
            <div class="blog__detail">
              {!! $trangTinTuc->mo_ta !!}
              <div class="blog__footer" style="margin-top: 2rem;">
                <div class="blog__reaction">{{ date('d \T\h\á\n\g m Y', strtotime($trangTinTuc->created_at)) }}</div>
                <div class="blog__reaction">
                  <i class="bx bx-show"></i>
                  <span>{{ $trangTinTuc->doc }}</span>
                </div>
              </div>
            </div>
            <div class="package-travel">
              <h3 style="margin-bottom: 1rem">Chuyến Đi Phổ Biến</h3>
              @foreach($tours as $tour)
                <article class="popular__card" style="margin-bottom: 1rem">
                  <a href="{{ route('showTourDuLich', $tour->slug) }}">
                    <img
                      src="{{ $tour->hinhAnhTours->isNotEmpty() ? asset('storage/' . $tour->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}"
                      alt="" class="popular__img" style="height: 200px; width: 300px;"/>
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

      <section class="blog" id="blog">
        <div class="blog__container container">
          <span class="section__subtitle" style="text-align: center"
            >Tin Tức Liên Quan</span
          >
          <h2 class="section__title" style="text-align: center">
            Tìm Những Nơi Tốt Nhất
          </h2>

          <div class="blog__content grid">
            @foreach($relatedBlogs as $relatedBlog)
            <article class="blog__card">
              <div class="blog__image">
                <img src="{{ asset('storage/' . $relatedBlog->hinh_anh) }}" 
                  alt="{{ $relatedBlog->tieu_de }}" 
                  style="width: 100%; height: 250px;" class="blog__img"> 
                <a href="{{ route('showTinTuc', $relatedBlog->slug) }}" class="blog__button">
                  <i class="bx bx-right-arrow-alt"></i>
                </a>
              </div>

              <div class="blog__data">
                <h2 class="blog__title">{{ $relatedBlog->tieu_de }}</h2>
                <p class="blog__description">
                  {{ $relatedBlog->noidung_rutgon }}
                </p>

                <div class="blog__footer">
                  <div class="blog__reaction">{{ date('d \T\h\á\n\g m Y', strtotime($relatedBlog->created_at)) }}</div>
                  <div class="blog__reaction">
                    <i class="bx bx-show"></i>
                    <span>{{ $relatedBlog->doc }}</span>
                </div>
                </div>
              </div>
            </article>
            @endforeach
          </div>
        </div>
      </section>
@endsection

@push('style-alt')
<style>
  blockquote {
    border-left: 8px solid #b4b4b4;
    padding-left: 1rem;
  }
  .blog__detail ul li {
    list-style: initial;
  }
</style>
@endpush
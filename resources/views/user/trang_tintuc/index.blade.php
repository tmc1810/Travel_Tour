@extends('layouts.moldUser')

@section('content')
<!--==================== HOME ====================-->
<section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            <section class="islands swiper-slide">
              <img src="{{ asset('frontend/assets/images/banner/banner_blog.jpg') }}" alt="" class="islands__bg"/>

              <div class="bg__overlay" style="margin-top: -180px;">
                <div class="islands__container container">
                  <div class="islands__data" style="z-index: 99; position: relative">
                    <h2 class="islands__subtitle">HANOITOURIST</h2>
                    <h1 class="islands__subtitleunderline">______________</h1>
                    <h1 class="islands__title">TIN TỨC</h1>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
      <div class="theloai_box">
        <label style="font-weight: 700;">Thể Loại</label>
        @foreach($theLoais as $theLoai)
            <input type="checkbox" name="the_loai" value="{{ $theLoai->id }}" 
                   style="width:30px;" onchange="locTimKiem()">
            &nbsp<span>{{ $theLoai->ten_the_loai }}</span>
        @endforeach
    </div>
    
    <!-- Tin Tức -->
    <section class="blog section" id="blog">
        <div class="blog__container container">
            <span class="section__subtitle" style="text-align: center">Tất Cả</span>
            <h2 class="section__title" style="text-align: center">Tin Tức</h2>
    
            <div class="blog__content grid" id="newsContent">
                @foreach($trangTinTucs as $trangTinTuc)
                    <article class="blog__card">
                        <div class="blog__image">
                            <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" 
                                 alt="{{ $trangTinTuc->tieu_de }}" 
                                 style="width: 100%; height: 250px;" class="blog__img">  
                            <a href="{{ route('showTinTuc',$trangTinTuc->slug) }}" class="blog__button">
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                        <div class="blog__data">
                            <h2 class="blog__title">{{ $trangTinTuc->tieu_de }}</h2>
                            <p class="blog__description">{{ $trangTinTuc->noidung_rutgon }}</p>
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
<script>
  function locTimKiem() {
      var selectedCategories = [];
      document.querySelectorAll('input[name="the_loai"]:checked').forEach((checkbox) => {
          selectedCategories.push(checkbox.value);
      });
  
      // Gửi yêu cầu AJAX đến server để lọc dữ liệu
      fetch('/tim-kiem-tin-tuc', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ categories: selectedCategories })
      })
      .then(response => response.json())
      .then(data => {
          // Cập nhật nội dung tin tức
          let newsContent = document.getElementById('newsContent');
          newsContent.innerHTML = ''; // Xóa nội dung cũ
          data.forEach(tinTuc => {
              newsContent.innerHTML += `
                  <article class="blog__card">
                      <div class="blog__image">
                          <img src="/storage/${tinTuc.hinh_anh}" alt="${tinTuc.tieu_de}" style="width: 100%; height: 250px;" class="blog__img">  
                          <a href="" class="blog__button">
                              <i class="bx bx-right-arrow-alt"></i>
                          </a>
                      </div>
                      <div class="blog__data">
                          <h2 class="blog__title">${tinTuc.tieu_de}</h2>
                          <p class="blog__description">${tinTuc.noidung_rutgon}</p>
                          <div class="blog__footer">
                              <div class="blog__reaction">${tinTuc.ngay_tao}</div>
                              <div class="blog__reaction">
                                  <i class="bx bx-show"></i>
                                  <span>${tinTuc.doc}</span>
                              </div>
                          </div>
                      </div>
                  </article>
              `;
          });
      });
  }
</script>
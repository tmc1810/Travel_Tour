@extends('layouts.moldUser')

@section('content')
 <!--==================== HOME ====================-->
 <section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
          @foreach($tour->hinhAnhTours as $hinhAnhTour)
            <section class="islands swiper-slide">
              <img src="{{ asset('storage/' . $hinhAnhTour->url_anh) }}" alt="{{ $hinhAnhTour->ten_anh }}" class="islands__bg" />

              <div class="islands__container container">
                <div class="islands__data">
                  <h1 class="islands__title">Khám Phá</h1>
                </div>
              </div>
            </section>
          @endforeach
          </div>
        </div>

        <!--========== CONTROLS ==========-->
        <div class="controls gallery-thumbs">
          <div class="controls__container swiper-wrapper">
           @foreach($tour->hinhAnhTours as $hinhAnhTour)
            <img
              src="{{ asset('storage/' . $hinhAnhTour->url_anh) }}"
              alt=""
              class="controls__img swiper-slide"
            />
           @endforeach
          </div>
        </div>
      </section>

      <section class="blog section" id="blog">
        <div class="blog__container container">
          <div class="content__container">
            <div class="blog__detail">
                {!! $tour->mo_ta !!}
            </div>
            <div class="package-travel">
              <h3>Đặt Phòng Ngay</h3>
              <div class="card">
                  <form action="{{ route('datTour') }}" method="post" id="datTourForm">
                      @csrf 
                      <input type="hidden" name="id_tour" value="{{ $tour->id }}">
          
                      <input type="text" name="ho_ten" placeholder="Tên Của Bạn" value="{{ Auth::user()->ho_ten ?? '' }}"  requied/>
                      <input type="text" name="email" placeholder="Email Của Bạn" value="{{ Auth::user()->email ?? '' }}" requied/>
                      <input type="text" name="so_dien_thoai" placeholder="Số Điện Thoại" value="{{ Auth::user()->so_dien_thoai ?? '' }}" requied/>
                      <input type="text" name="so_nguoi" placeholder="Số Lượng Người Đi" />
                      <input placeholder="Chọn Ngày Đi" class="textbox-n" type="text" name="ngay_di" onfocus="(this.type='date')" id="ngay_di" />
          
                      <button type="button" class="button button-booking" id="submitBtn">Gửi</button>
                  </form>
              </div>
          </div>
          </div>
        </div>
      </section>

      <section class="section" id="popular">
        <div class="container">
          <span class="section__subtitle" style="text-align: center"
            >Các Tour Du Lịch</span
          >
          <h2 class="section__title" style="text-align: center">
            Tour Du Lịch Khác Dành Cho Bạn
          </h2>

          <div class="popular__all">
            @foreach($tours as $tour)
            <article class="popular__card">
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
      </section>

    @if(session()->has('success'))
      <div id="alert" class="alert">
        {{ session()->get('success') }}
        <i class='bx bx-x alert-close' id="close"></i>
      </div>
    @endif
@endsection

@push('style-alt')
<style>
  .alert {
    position:absolute;
    top: 120px;
    left:0;
    right:0;
    background-color: var(--second-color);
    color: white;
    padding: 1rem;
    width: 70%;
    z-index: 99;
    margin: auto;
    border-radius: .25rem;
    text-align: center;
  }

  .alert-close {
    font-size: 1.5rem;
    color: #090909;
    position: absolute;
    top: .25rem;
    right: .5rem;
    cursor: pointer;
  }
  blockquote {
    border-left: 8px solid #b4b4b4;
    padding-left: 1rem;
  }
  .blog__detail ul li {
    list-style: initial;
  }
</style>
@endpush

@push('script-alt')
<script>
  let galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 0,
    slidesPerView: 0,
  });

  let galleryTop = new Swiper('.gallery-top', {
    effect: 'fade',
    loop: true,

    thumbs: {
      swiper: galleryThumbs,
    },
  });

  const close = document.getElementById('close');
  const alert = document.getElementById('alert');
  if(close) {
    close.addEventListener('click', function() {
      alert.style.display = 'none';
    })
  }

  document.getElementById('submitBtn').addEventListener('click', function() {
      @if(Auth::check())
          // Nếu đã đăng nhập, submit form
          document.getElementById('datTourForm').submit();
      @else
          // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
          window.location.href = "{{ route('login') }}";
      @endif
  });
</script>
@endpush
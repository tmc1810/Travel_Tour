@extends('layouts.moldUser')

@vite(['resources/css/aboutus.css', 'resources/js/aboutus.js'])

@section('content')
<!--==================== HOME ====================-->
<section>
    <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
            <!--========== ISLANDS 1 ==========-->
            <section class="islands swiper-slide">
                <img src="{{ asset('frontend/assets/images/banner/banner_aboutus.jpg') }}" alt="" class="islands__bg" />
                <div class="bg__overlay">
                    <div class="islands__container container">
                        <div class="islands__data" style="z-index: 99; position: relative">
                            <h2 class="islands__subtitle">HANOITOURIST</h2>
                            <h1 class="islands__subtitleunderline">______________</h1>
                            <h1 class="islands__title">VỀ CHÚNG TÔI</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<!--==================== CONTACT ====================-->
<section class="contact section" id="contact">
    <div class="contact__container container">
        <div class="contact__data">
          <span class="section__subtitle">Về chúng tôi</span>
          <h2 class="section__title">Giới thiệu công ty Lữ hành Hanoitourist</h2>
          <p class="contact__description">Công ty Lữ hành Hanoitourist là đơn vị trực thuộc Tổng Công ty Du lịch Hà Nội - doanh nghiệp nhà nước có vị thế hàng đầu trong các lĩnh vực: kinh doanh lữ hành quốc tế, khách sạn, nhà hàng, vận chuyển, xuất khẩu lao động…</p>
          <p class="contact__description">Tiền thân là Công ty Du lịch Hà Nội được thành lập từ ngày 25/3/1963, đến ngày 12/7/2004, UBND Thành phố Hà Nội ra Quyết định thành lập Tổng công ty Du lịch Hà Nội, thí điểm hoạt động theo mô hình Công ty mẹ - công ty con, trên cơ sở tập hợp một số doanh nghiệp kinh doanh du lịch trên địa bàn thành phố với mục tiêu tập trung xây dựng một Tổng công ty du lịch lớn, có thương hiệu mạnh, hoạt động đa ngành nghề, đa sở hữu, có sức cạnh tranh cao và hội nhập kinh tế quốc tế hiệu quả, phù hợp với yêu cầu phát triển ngành du lịch và nền kinh tế Thủ đô.</p>
          <p class="contact__description">Qua hơn 60 năm xây dựng và phát triển, Công ty Lữ hành Hanoitourist, đại diện duy nhất cho thương hiệu Hanoitourist trong lĩnh vực lữ hành, nhiều năm liên tục đạt danh hiệu “Top Ten lữ hành quốc tế” của Tổng cục Du lịch, Hiệp hội Du lịch Việt Nam và Hiệp hội Lữ hành Việt Nam; hạng A1 “Top Five” trong số các Công ty lữ hành có đóng góp doanh thu lớn nhất cho hãng Hàng không Quốc gia Việt Nam (Vietnamairlines); Giải thưởng "Most Potential Partner - Đối tác triển vọng nhất" của Tổng cục Du lịch Hàn Quốc tại Việt Nam và nhiều giải thưởng nghề nghiệp uy tín khác.</p>
          <p class="contact__description">Bằng sự nỗ lực không ngừng và sự lắng nghe ý kiến từ phía khách hàng, Hanoitourist phấn đấu trở thành thương hiệu lữ hành hàng đầu, có uy tín lớn ở Việt Nam và khu vực; xây dựng hệ thống sản phẩm dịch vụ đẳng cấp, góp phần nâng tầm trải nghiệm của du khách và thương hiệu Du lịch Việt Nam trên trường quốc tế.</p>
          <p class="contact__description">Chúng tôi tin tưởng, với vị thế hàng đầu và đội ngũ nhân sự chuyên nghiệp đã phục vụ hàng nghìn đoàn khách trong và ngoài nước đến hầu hết những địa danh nổi tiếng khắp Việt Nam và thế giới, Hanoitourist sẽ làm hài lòng các Quý khách hàng.</p>
          <p class="contact__description">Hãy để Hanoitourist thỏa mãn ước mơ du lịch - khám phá năm châu bốn biển của Quý khách.</p>
        </div>

        <span class="section__subtitle">Hãy liên hệ với chúng tôi</span>  
    </div>

        <div class="contact__container container grid">
            <div class="contact__images">
                <div class="contact">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7448.515768307514!2d105.855372!3d21.022365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abecf5c5a0a9%3A0x663f15b4628b3028!2zQ8O0bmcgdHkgTOG7ryBow6BuaCBIYW5vaXRvdXJpc3Q!5e0!3m2!1svi!2sus!4v1729341598681!5m2!1svi!2sus" width="500" height="500"></iframe>
                </div>
            </div>

            <div class="contact__content" style="margin-top:150px;">
                <div class="contact__card">
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxs-phone-call"></i>
                            <div>
                                <h3 class="contact__card-title">HOTLINE</h3>
                                <p class="contact__card-description">19004518</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class='bx bxs-envelope'></i>
                            <div>
                                <h3 class="contact__card-title">Email</h3>
                                <p class="contact__card-description">info@hanoitourist.vn</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxs-comment"></i>
                            <div>
                                <h3 class="contact__card-title">GÓP Ý</h3>
                                <button class="button contact__card-button" id="showFormButton" style="width: 100px;">Gửi BÂY GIỜ</button>
                            </div>
                        </div>
                    </div>
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxs-phone-call"></i>
                            <div>
                                <h3 class="contact__card-title">HỖ TRỢ</h3>
                                <p class="contact__card-description">096.593.4518</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Popup -->
    @include('user.guiGopY')
</section>
@endsection

<div id="contactForm" class="hidden">
    <div class="form__container">
        <form style="max-width: 100%;" id="guiGopYform" action="{{ route('guiGopY') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Gửi Góp Ý</h3>  
            <br>
            <label for="ho_ten">Họ và Tên:</label>
            <input type="text" id="ho_ten" name="ho_ten" required>
            <br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <br>
            <label for="so_dien_thoai">Số Điện Thoại:</label>
            <input type="text" id="so_dien_thoai" name="so_dien_thoai" required>
            <br>
            <label for="noidung_gopy">Nội Dung:</label>
            <textarea id="noidung_gopy" name="noidung_gopy" style="width: 500px; height: 300px; font-size:20px;" required></textarea>
            <br>
            <button type="submit" class="button contact__card-button" style="background:hsl(228, 66%, 53%); color: #ffff;">Gửi</button>
        </form>
    </div>
</div>
@vite(['resources/css/styleHD-admin.css'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- Nút Xem -->
<button type="button" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#hoaDonModal-{{ $hoaDonDatTour->id }}">
    <i class='bx bx-mask'></i>
</button>

<!-- Modal Xem Hoá Đơn -->
<div class="modal fade" id="hoaDonModal-{{ $hoaDonDatTour->id }}" tabindex="-1" aria-labelledby="hoaDonModalLabel-{{ $hoaDonDatTour->id }}" aria-hidden="true">
    <div class="modal-dialog" id="hoaDon">
        <div class="modal-content" id="ModalContent">
            <button id="export-button-{{ $hoaDonDatTour->id }}" class="btn btn-primary export">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAilJREFUaEPtme1xwjAMhqVNYJOySZmEMgnpJLAJbKLy+qScCiFx8UeSnv2nPdtx3keSZUcwrbzxyvVTA5jbg1EeEJENER2I6IOI8H9KOzLzV8oC/tlJABV/zfVCXScbRAzAiYg+MwNguSwQMQBSQLwtmQxRE+Co++jRHkkQ1QCYmUUEmxfJIBtEVQCozg1RHSA3xCwAOSFmA8gFMStADojZAVIhFgEwBoH0O3aQLgbgFcRiAN69jjQAuR+d71ovx3PNA80DiXHUQqiF0EJD6Ka68BdlFl9qsTFMsX7rGyrJXNy8p/Eie+BxURFBvQjVi42N+S8v/ZxEZQNz0CB6z8w9rIj48d5vxQC0XnQmom8UqkyAf6GIoJ4UoJzACzPv9O4ToO9lGwN5Kt+UBIDVAXBj5q164axiMQZREHR4ANgx80VE8CzmjbbSABAAi0JQKIA5scTMnXoBFsdcwAAWVrdqX/CGNkD9asUA/FtexDvKJxAHL3QKcHJ7JISXzoEXb0MpuxiAhcyQxVy890Ur17dVsb5kaWH1dHGcGwD7AOJgXcsyfQZSIyC0uqoeuGeerYXEwA7EWNi8OoaSIkLI9wEC/RY6Vra3NFs2jU5ljpzjRUIop8CptRrAf7iNWr6e8naJ8XDKjy0cUxcq9RNTDDDS6z4VAKcljvjUXydjBPs5k9bH5EkP6K0R4u3mWAME5wZOcf9tMWiAKIC/mq7m/AZQ09pD71q9B34Aq6KBQEddMAMAAAAASUVORK5CYII="/>
            </button>
            <div class="bill-container" id="bill-container-{{ $hoaDonDatTour->id }}">
                <div class="info">
                    <p><strong>Mã HD:</strong> {{ $hoaDonDatTour->id }} | <strong>Ngày in:</strong> {{ $hoaDonDatTour->updated_at }}</p>
                </div>
                <div class="header">
                    <div class="logo">
                        <img src="{{ asset('frontend/assets/images/logo/logo2.png') }}" alt="Hanoitourist Logo">
                        <p class="logo_title">Cảm ơn quý khách đã đặt tour tại Hanoitourist! Chúng tôi sẽ gửi thông tin đặt tour cho quý khách qua email.</p>
                    </div>
                </div><br>
            
                <div class="section">
                    <h2>THÔNG TIN KHÁCH HÀNG &nbsp &nbsp _________________</h2>
                    <div class="container" id="thongTinKhachHang">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><strong>Mã Khách Hàng:</strong> {{ $hoaDonDatTour->datTour->id_khachhang }}</li>
                                    <li><strong>Số điện thoại:</strong> {{ $hoaDonDatTour->datTour->so_dien_thoai }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul style="margin-left: 60px;">
                                    <li><strong>Họ tên:</strong> {{ $hoaDonDatTour->datTour->ho_ten }}</li>
                                    <li><strong>Email:</strong> {{ $hoaDonDatTour->datTour->email }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <h2>THÔNG TIN TOUR &nbsp &nbsp ________________________</h2>
                    <div class="container" id="thongTinTour">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><strong>Mã Tour:</strong> {{ $hoaDonDatTour->datTour->id_tour }}</li>
                                    <li><strong>Nơi khởi hành:</strong> {{ $hoaDonDatTour->datTour->tour->noi_khoi_hanh }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul style="margin-left: 55px;">
                                    <li><strong>Thời gian tour:</strong> {{ $hoaDonDatTour->datTour->tour->thoigian_tour }}</li>
                                    <li><strong>Ngày khởi hành:</strong> {{ \Carbon\Carbon::parse($hoaDonDatTour->datTour->ngay_di)->format('d/m/Y') }}</li>
                                </ul>
                            </div>
                        </div>
                        <p style="margin-left: 30px; margin-top: -5px;"><strong>Tên Tour:</strong> {{ $hoaDonDatTour->datTour->tour->ten_tour }}</p>
                    </div><br>
                    
                    <h2>THÔNG TIN THANH TOÁN &nbsp &nbsp __________________</h2>
                    <div class="container" id="thongTinTour">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><strong>Mã Đặt Tour:</strong> {{ $hoaDonDatTour->datTour->id}}</li>
                                    <li><strong>Giá trị thanh toán:</strong> <span class="unpaid">{{ number_format($hoaDonDatTour->datTour->tour->gia) }} VND</span></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul style="margin-left: 55px;">
                                    <li><strong>Số lượng người đi:</strong> {{ $hoaDonDatTour->datTour->so_nguoi }}</li>
                                    <li><strong>Trạng thái:</strong> <span class="unpaid">{{ $hoaDonDatTour->trang_thai }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <p style="margin-left: 30px; margin-top: -5px;"><strong>Phương thức thanh toán:</strong> {{ $hoaDonDatTour->phuong_thuc_thanh_toan }}</p>
                        <p class="note">* Lưu ý thời gian thanh toán trong vòng 24h sau khi đặt tour hoàn tất</p>
                    </div>            
                </div>
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="qr-code">
                                <img src="{{ asset('frontend/assets/images/icon/qr_code.png') }}" alt="QR Code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="signature">
                                <p class="date">Hà Nội, <span>Ngày 18 tháng 10 năm 2024</span></p>
                                <p><strong>Người Phụ Trách</strong></p>
                                <p class="name">{{ mb_strtoupper(last(explode(' ', $hoaDonDatTour->datTour->nguoiDung->ho_ten)), 'UTF-8') }}</p>
                                <p class="fullname">{{ $hoaDonDatTour->datTour->nguoiDung->ho_ten }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('export-button-{{ $hoaDonDatTour->id }}').addEventListener('click', function() {
        const id = "{{ $hoaDonDatTour->id }}"; // Lấy ID từ biến PHP
        const element = document.getElementById('bill-container-' + id); // Lấy bill-container dựa trên ID
       
        html2canvas(element).then((canvas) => {
            // Tạo một liên kết để tải xuống hình ảnh
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = `hoa_don_${id}.png`; // Tên tệp chỉ với ID
            link.click(); // Kích hoạt tải xuống
        });
    });
</script>
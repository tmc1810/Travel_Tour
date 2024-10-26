<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@vite('resources/js/datTour-admin.js')

<button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#confirmDatTourModal" data-dattour-id="{{ $datTour->id }}">
    <i class='bx bx-check-double' style='color:#ffffff' ></i>
</button>

<!-- Modal xác nhận đặt tour -->
<div class="modal fade" id="confirmDatTourModal" tabindex="-1" aria-labelledby="confirmDatTourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDatTourLabel">Xác nhận đặt tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xác nhận đặt tour này không?
            </div>
            <div class="modal-footer">
                <form id="confirmDatTourForm" method="POST" action="{{ route('xac_nhan_dat_tour', $datTour->id) }}">
                    @csrf
                    @method('PATCH') <!-- Đây là phương thức PATCH -->
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>



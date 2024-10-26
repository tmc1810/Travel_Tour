<form action="{{ route('huyDatTour', $datTour->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đặt tour này?');" style="padding: 5px;">
    @csrf
    <button type="submit" class="btn btn-danger" 
        @if ($datTour->trang_thai_dattour === 'Đã Xác Nhận') disabled @endif>
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAY1JREFUWEftmOFxwjAMhaVJ2k5SuglM0jJJ2QQ6CXSSV14vyam2FBPX4UKL/3CJbenLsyzZqCys6cJ45LaBABxF5HGiqicReVFV/hZbqBAAOl4bCw/Jc9G4GXA4Q310zwQ7qSrfZc0FArAXkdUUjxVjd6q6SedlQACoynuFg5opXMofSnlAbyLy2lm3Uj//QrXIzlZV6W9oJaBhAgALOlWNyM7fAmKQ1wb6oY+VROl6haauUTT+DlRS8v8oBGAVpX8mV1XdeWrNopDJ5tkuAcAsz2yf9RGwOVBXdFn1+2aTXg/T92WloTmQ85V8tT3Xv/Q04BbPWYACKBsyLswsS2a9BvUthLkGUBoz38uXVvCRj2hXOsxu8nZ3CDVLDDkwzDmf5hwVKtUciAlRRHjE7dsQM05MPaWH++ZASWBmAWwcbrxsPQtQBzVWHsbKij15tgvqUlW/n4euqVC6i2p9XzIvC3zvGsQrtK3mlxiuHZOlhegqTSiWhdpbRgmQ93uqk93vb/vvmNJnt+hfnEJf11Z1NLuOmTIAAAAASUVORK5CYII=" style="background-color:black"/>
    </button>
</form>

    <option value="">Chọn công việc cần xử lý</option>
    @foreach($danhMucLois as $danhMucLoi)
        <option value="{{$danhMucLoi['id']}}">{{$danhMucLoi['loai']}} - @if($danhMucLoi['ma_yeu_cau']) ({{$danhMucLoi['ma_yeu_cau']}}) @endif {{$danhMucLoi['ten_dm_loi']}}
        </option>
    @endforeach

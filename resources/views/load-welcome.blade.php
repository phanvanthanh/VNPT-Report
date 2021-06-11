@extends('layouts.template.ajaxIndex')

@section('content')
<table id="datatable-buttons" class="table table-bordered datatable-buttons table-hover" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center d-none">ID</th>
            <th class="text-center">Tên lỗi</th>
            <th class="text-center">Dịch vụ</th>
            <th class="text-center" style="white-space:nowrap;">Tài liệu hướng dẫn</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0; ?>
        @foreach($danhMucLois as $danhMucLoi)
        <?php $stt++; ?>
        <tr>
            <td class="text-center">{{$stt}}</td>
            <td class="d-none id">{{$danhMucLoi['id']}}</td>
            <td class="name">{{$danhMucLoi['ten_dm_loi']}}</td>
            <td>{{$danhMucLoi['ten_loai_danh_muc']}}</td>
            <td class="text-center">
                <!-- <button type="button" data="{{$danhMucLoi['id']}}" class="btn btn-success waves-effect waves-light btnChiTiet" ><i class="dripicons-document-detail"></i>Chi tiết</button> -->
                <a href="/chi-tiet-dm-loi/{{ $danhMucLoi['id'] }}" class="btnChiTietDmLoi" target="_blank"> <span class="badge badge-success"><i class="fa fa-floppy-o"></i> Xem hướng dẫn</span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        

    });



</script>
@endsection
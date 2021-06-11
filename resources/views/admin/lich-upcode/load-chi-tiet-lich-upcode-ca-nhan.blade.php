@extends('layouts.template.ajaxIndex')

@section('content')
<table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center d-none">ID</th>
            <th class="text-center">Tên lỗi/ module/ chức năng</th>
            <th class="text-center">Ghi chú</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0; ?>
        @foreach($chiTietUpcodes as $chiTietUpcode)
        <?php $stt++; ?>
        <tr>
            <td>{{$stt}}</td>
            <td class="d-none id">{{$chiTietUpcode['id']}}</td>
            <td>{{$chiTietUpcode['ten_dm_loi']}}</td>
            <td>{{$chiTietUpcode['ghi_chu']}}</td>
            <td class="text-center">
                @if($chiTietUpcode['tinh_trang']==0)
                    <span class="badge badge-warning">Chưa hoàn thành</span>
                @endif
                @if($chiTietUpcode['tinh_trang']==1)
                    <span class="badge badge-success">Hoàn thành</span>   
                @endif
                @if($chiTietUpcode['tinh_trang']==2)
                    <span class="badge badge-danger">Lỗi phát sinh (Lỗi cũ)</span>
                @endif
                @if($chiTietUpcode['tinh_trang']==3)
                    <span class="badge badge-danger">Lỗi phát sinh (Lỗi mới)</span>
                @endif

            </td>
            <td class="text-center">
                <span class="badge badge-primary btnSua" data="{{$chiTietUpcode['id']}}" style="cursor: pointer;"><i class="dripicons-document-edit"></i></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('#datatable-buttons').dataTable( {
          "searching": false,
          "paging":false,
          "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });


        function loadChiTietUpcodeCaNhan(_token, idLichUpcode){
            var xhr1;   
            var url="{{ route('loadChiTietUpcodeCaNhan') }}";
            if(xhr1 && xhr1.readyState != 4){
                xhr1.abort(); //huy lenh ajax truoc do
            }
            xhr1 = $.ajax({
                url:url,
                type:'POST',
                dataType:'json',
                cache: false,
                data:{
                    "_token":_token,
                    "id_lich_upcode": idLichUpcode
                },
                error:function(){
                },
                success:function(data){
                    $('.tblChiTietUpcodeCaNhan').empty();
                    jQuery('.tblChiTietUpcodeCaNhan').html(data.html);
                },
            });
        }


        // nút này là lấy dữ liệu lên (nút cập nhật mới lưu lại dữ liệu)
        jQuery('.btnSua').on('click',function(){
            var _token=jQuery('form[name="frmChiTietUpcodeCaNhan"]').find("input[name='_token']").val();
            var id=jQuery(this).attr('data');

            var xhr1;   
            var url="{{ route('loadChiTietUpcodeCaNhanById') }}";
            if(xhr1 && xhr1.readyState != 4){
                xhr1.abort(); //huy lenh ajax truoc do
            }
            xhr1 = $.ajax({
                url:url,
                type:'POST',
                dataType:'json',
                cache: false,
                data:{
                    "_token":_token,
                    "id":id,
                },
                error:function(){
                },
                success:function(data){                    
                    if(data.error==0){ 
                        jQuery('#id_chi_tiet_lich_upcode').val(data.id);
                        jQuery('#id_lich_upcode').val(data.id_lich_upcode);
                        jQuery('#id_dm_loi').val(data.id_dm_loi);
                        jQuery('#tinh_trang').val(data.tinh_trang);
                        jQuery('#ghi_chu').val(data.ghi_chu);
                    }
                    else{
                        $.toast({
                            heading: 'Lỗi!',
                            text: data.error,
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                    }
                }
            });
        });
    });




</script>
@endsection
@extends('layouts.template.ajaxIndex')
@section('content')
<form id="frm_ds_user_xu_ly" name="frm_ds_user_xu_ly">
    {{ csrf_field() }}
</form>
<table class="table table-hover table-bordered" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Họ tên người xử lý</th>
            <th class="text-center">Loại xử lý</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center xoa-user-xu-ly">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $stt=0;
        ?>
        @foreach($dsUserXuLys as $userXuLy)
            <?php $stt++; ?>
            <tr>
                <td class="text-center">{{$stt}}</td>
                <td class="name">{{$userXuLy['name']}}</td>
                <td class="text-center">
                    @if($userXuLy['trang_thai']==1)
                        <span class="text-danger">Xử lý chính</span>
                    @else
                        <span class="text-warning">Phối hợp xử lý</span>
                    @endif
                </td>
                <td>
                    @if($userXuLy['xu_ly']==1)
                        <span class="text-success">Đã xử lý</span>
                    @else
                        <span class="text-danger">Chưa xử lý</span>
                    @endif
                </td>
                <td class="text-center xoa-user-xu-ly">
                    <button type="button" data="{{$userXuLy['id']}}" class="btn btn-danger waves-effect waves-light js-xoa-user-xu-ly" ><i class="dripicons-document-delete"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>







    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
       

       function loadDsUserXuLyCongViecV2(_token, idCongViec, xoa){                
            var xhr1;   
            var url="{{ route('loadDsUserXuLyCongViecV2') }}";
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
                    'id':idCongViec
                },
                error:function(){
                },
                success:function(data){
                    $('.tb-ds-user-xu-ly').empty();
                    jQuery('.tb-ds-user-xu-ly').html(data.html);
                    if(xoa==1){
                        jQuery('.xoa-user-xu-ly').css("display","block");
                    }else{
                        jQuery('.xoa-user-xu-ly').css("display","none");
                    }
                },
            });
        }


       function xoaUserXuLyCongViecV2(id, _token){
            var xhr1;   
            var idCongViec=jQuery('#id_cong_viec').val();
            var url="{{ route('xoaUserXuLyCongViecV2') }}";
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
                        $.toast({
                            heading: 'Chúc mừng!',
                            text: 'Bạn đã xóa dữ liệu thành công.',
                            position: 'top-right',
                            loaderBg: '#5ba035',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 1
                        });
                        loadDsUserXuLyCongViecV2(_token, idCongViec, 1);
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
        }
        

        jQuery('.js-xoa-user-xu-ly').on('click',function(){
            var _token=jQuery('form[name="frm_ds_user_xu_ly"]').find("input[name='_token']").val();
            var id=jQuery(this).attr('data');
            swal({
                title: 'Bạn thật sự muốn xóa dữ liệu?',
                text: "Xóa mất sẽ không thể khôi phục lại được!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Tiếp tục xóa!',
                cancelButtonText: 'Không xóa!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
                xoaUserXuLyCongViecV2(id, _token)                
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Đã hủy!',
                        'Hành động đã bị hủy :)',
                        'error'
                    )
                }
            })   
        });
    });



</script>
@endsection
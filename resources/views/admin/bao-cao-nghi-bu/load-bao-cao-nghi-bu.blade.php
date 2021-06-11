@extends('layouts.template.ajaxIndex')

@section('content')
<table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center d-none">ID</th>
            <th class="text-center">Yêu cầu bởi</th>
            
            <th class="text-center">Nội dung</th>
            <th class="text-center">TG</th>
            <th class="text-center">Lý do</th>

            <th class="text-center">Duyệt bởi</th>
            <th class="text-center">Duyệt</th>

            <th class="text-center">Tình trạng</th>
            <th class="text-center">Sửa</th>
            <th class="text-center">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0; ?>
        @foreach($baoCaoNghiBus as $nghiBu)
        <?php $stt++; ?>
        <tr>
            <td class="text-center">{{$stt}}</td>
            <td class="d-none id">{{$nghiBu['id']}}</td>
            <td class="name">{{$nghiBu['name']}}</td>
            <td><?php echo $nghiBu['noi_dung_nghi_bu']; ?></td>
            <td>{{$nghiBu['thoi_gian_yeu_cau_nghi_bu']}} giờ</td>
            <td>
                @if($nghiBu['id_lich_upcode'])
                    <span>Nghỉ bù lịch upcode: {{$nghiBu['ten_lich_upcode']}}</span> <br>
                    Từ: &nbsp;&nbsp;<span style="color:green">{{$nghiBu['thoi_gian_bat_dau']}}</span> 
                    <br>Đến: <span style="color:green">{{$nghiBu['thoi_gian_ket_thuc']}}</span>
                @endif
                @if($nghiBu['id_lich_upcode']==null)
                    Lý do khác
                @endif
                
            </td>
            <td>{{$nghiBu['ten_nguoi_duyet']}}</td>
            <td class="text-info">{{$nghiBu['thoi_gian_duoc_duyet_nghi_bu']}}</td>
            <td class="text-center">
                @if($nghiBu['state']==0)
                    <span class="badge badge-danger">Chưa duyệt</span>
                @endif
                @if($nghiBu['state']==1)
                    <span class="badge badge-primary">Đã duyệt</span>
                @endif
                @if($nghiBu['state']==2)
                    <span class="badge badge-success">Đã nghỉ</span>
                @endif
            </td>
            <td class="text-center">
                <button type="button" data="{{$nghiBu['id']}}" class="btn btn-gradient waves-effect waves-light btnSua" ><i class="dripicons-document-edit"></i></button>
            </td>
            <td class="text-center">
                <button type="button" data="{{$nghiBu['id']}}" class="btn btn-danger waves-effect waves-light btnXoa" ><i class="dripicons-document-delete"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        function load(_token){
            var xhr1;   
            var url="{{ route('loadBaoCaoNghiBu') }}";
            if(xhr1 && xhr1.readyState != 4){
                xhr1.abort(); //huy lenh ajax truoc do
            }
            xhr1 = $.ajax({
                url:url,
                type:'POST',
                dataType:'json',
                cache: false,
                data:{
                    "_token":_token
                },
                error:function(){
                },
                success:function(data){
                    $('.tblDanhSachBaoCaoNghiBu').empty();
                    jQuery('.tblDanhSachBaoCaoNghiBu').html(data.html);
                },
            });
        }


        function del(id, _token){
            var xhr1;   
            var url="{{ route('xoaBaoCaoNghiBu') }}";
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
                        load(_token);
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


        jQuery('.btnXoa').on('click',function(){
            var _token=jQuery('form[name="frmBaoCaoNghiBu"]').find("input[name='_token']").val();
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
                del(id, _token)
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


        // nút này là lấy dữ liệu lên (nút cập nhật mới lưu lại dữ liệu)
        jQuery('.btnSua').on('click',function(){
            var _token=jQuery('form[name="frmBaoCaoNghiBu"]').find("input[name='_token']").val();
            var id=jQuery(this).attr('data');

            var xhr1;   
            var url="{{ route('getBaoCaoNghiBuById') }}";
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
                        jQuery('.add-form').removeClass('d-none');
                        jQuery.each( data, function( key, value){
                            jQuery('#'+key).val(value);
                            // kiểm tra nếu là comobox
                            if(key.length>2 && key.trim().substring(0, 2)=='id'){
                                // nếu không chạy thì vô form xóa bỏ dòng <optgroup label=""> vì chạy tới chỗ này nó dừng
                                $("#"+key+" > option").each(function() {
                                    var dl=jQuery(this).attr('value').trim();
                                    if(this.value==value){
                                      jQuery('#select2-'+key+'-container').text(this.text);
                                    }
                                });
                            }
                        });
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
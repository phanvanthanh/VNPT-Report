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
            <th class="text-center">TG Duyệt</th>

            <th class="text-center">Tình trạng</th>
            <th class="text-center">Duyệt</th>
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
            <td>{{$nghiBu['noi_dung_nghi_bu']}}</td>
            <td><span style="color: red;">{{$nghiBu['thoi_gian_yeu_cau_nghi_bu']}} giờ</span></td>
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
            <td class="text-info"><i>{{$nghiBu['ten_nguoi_duyet']}}</i></td>
            <td class="name"><b style="color: green">{{$nghiBu['thoi_gian_duoc_duyet_nghi_bu']}} Giờ</b></td>
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
                <button type="button" data="{{$nghiBu['id']}}" class="btn btn-gradient waves-effect waves-light btnDuyet" ><i class="dripicons-document-delete"></i></button>
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
            var url="{{ route('loadDuyetBaoCaoNghiBu') }}";
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


        function duyet(id, thoiGian, _token){
            if(thoiGian==''){
                $.toast({
                    heading: 'Lỗi!',
                    text: 'Vui lòng nhập thời gian vào!',
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 1
                });
                return false;
            }
            var xhr1;   
            var url="{{ route('duyetBaoCaoNghiBuById') }}";
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
                    "thoi_gian_duoc_duyet_nghi_bu":thoiGian,
                },
                error:function(){
                },
                success:function(data){
                    if(data.error==0){                            
                        $.toast({
                            heading: 'Chúc mừng!',
                            text: 'Bạn đã duyệt dữ liệu thành công.',
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


        jQuery('.btnDuyet').on('click',function(){
            var _token=jQuery('form[name="frmBaoCaoNghiBu"]').find("input[name='_token']").val();
            var id=jQuery(this).attr('data');
            swal({
                title: 'Nhập thời gian được duyệt (Đơn vị tính = giờ)',
                input: 'number',
                showCancelButton: true,
                confirmButtonText: 'Duyệt',
                showLoaderOnConfirm: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                preConfirm: function (thoiGian) {
                    return new Promise(function (resolve, reject) {
                        if(thoiGian!=''){
                            duyet(id, thoiGian, _token);
                            resolve();
                        }else{
                            $.toast({
                                heading: 'Lỗi!',
                                text: 'Vui lòng nhập thời gian vào',
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 1
                            });
                            reject('Vui lòng nhập thời gian!')
                            return false;
                        }
                    })
                },
                allowOutsideClick: false
            }).then(function (thoiGian) {
                swal({
                    type: 'success',
                    title: 'Duyệt thành công!',
                    html: 'Thời gian là: ' + thoiGian + ' Giờ'
                });
            })  
        });

        
    });



</script>
@endsection
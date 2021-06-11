@extends('layouts.template.ajaxIndex')

@section('content')
<table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons dsBangPhanCong" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center d-none">ID</th>
            <th class="text-center">Dịch vụ</th>
            <th class="text-center">Chuyên viên</th>
            <th class="text-center">Từ ngày</th>
            <th class="text-center">Đến ngày</th>
            <th class="text-center">Tạo bởi</th>
            <th class="text-center" style="white-space:nowrap;">Chi tiết</th>
            <th class="text-center">Sửa</th>
            <th class="text-center">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0; ?>
        @foreach($dsPhanCong as $phanCong)
        <?php $stt++; ?>
        <tr>
            <td class="text-center">{{$stt}}</td>
            <td class="d-none id">{{$phanCong['id']}}</td>
            <td>{{$phanCong['ten_loai_danh_muc']}}</td>
            <td class="name">{{$phanCong['name']}}</td>
            <td>{{$phanCong['tu_ngay']}}</td>
            <td>{{$phanCong['den_ngay']}}</td>
            <td>{{$phanCong['nguoi_phan_cong']}}</td>
            <td class="text-center"> 
                <span class="badge badge-success btnXemChiTiet" data-toggle="modal" data-target=".bs-example-modal-lg" data="{{$phanCong['id']}}">Xem chi tiết</span>
            </td>
            <td class="text-center">
                <button type="button" data="{{$phanCong['id']}}" class="btn btn-gradient waves-effect waves-light btnSuaBangPhanCong" ><i class="dripicons-document-edit"></i></button>
            </td>
            <td class="text-center">
                <button type="button" data="{{$phanCong['id']}}" class="btn btn-danger waves-effect waves-light btnXoaBangPhanCong" ><i class="dripicons-document-delete"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        function loadBangPhanCong(_token){
                
            var xhr1;   
            var url="{{ route('loadBangPhanCong') }}";
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
                    $('.dsBangPhanCong').empty();
                    jQuery('.dsBangPhanCong').html(data.html);
                },
            });
        }

        function xoaBangPhanCong(id, _token){

            var xhr1;   
            var url="{{ route('xoaBangPhanCong') }}";
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
                        loadBangPhanCong(_token);
                    }
                    else{
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Bạn không thể xóa dữ liệu này, xin vui lòng kiểm tra lại.',
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

        function themChiTietBangPhanCong(idPhanCong, idDmDonViYeuCau, tuNgay, denNgay, ghiChu, state, _token){
            if(idDmDonViYeuCau=='' || tuNgay==''){
                $.toast({
                    heading: 'Lỗi!',
                    text: 'Các thông tin không thể để trống.',
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 1
                });
                return false;
            }
            var xhr1;   
            var url="{{ route('themChiTietBangPhanCong') }}";
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
                    "id_phan_cong":idPhanCong,
                    "id_dm_don_vi_yeu_cau":idDmDonViYeuCau,
                    "tu_ngay":tuNgay,
                    "den_ngay":denNgay,
                    "ghi_chu":ghiChu,
                    "state":state,
                },
                error:function(){
                },
                success:function(data){
                    if(data.error==0){                            
                        $.toast({
                            heading: 'Chúc mừng!',
                            text: 'Bạn đã lưu dữ liệu thành công.',
                            position: 'top-right',
                            loaderBg: '#5ba035',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 1
                        });
                        loadChiTietBangPhanCong(idPhanCong,_token);
                    }
                    else{
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Bạn không thể thêm thông tin, xin vui lòng kiểm tra lại.',
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                    }
                },
            });
        }

        function loadChiTietBangPhanCong(idPhanCong,_token){
                
            var xhr1;   
            var url="{{ route('loadChiTietBangPhanCong') }}";
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
                    "id_phan_cong":idPhanCong,
                },
                error:function(){
                },
                success:function(data){
                    $('#tblChiTietBangPhanCong tbody').html('');
                    var tr='';
                    var stt=0;
                    jQuery.each( data, function( key, value){
                        stt++;
                        if(value.tu_ngay==null){
                            value.tu_ngay='';
                        }
                        if(value.den_ngay==null){
                            value.den_ngay='';
                        }
                        tr+='<tr>'
                            +'<td>'+stt+'</td>'
                            +'<td class="d-none">'+value.id+'</td>'
                            +'<td style="color:blue;">'+value.ten_don_vi+'</td>'
                            +'<td>'+value.tu_ngay+'</td>'
                            +'<td>'+value.den_ngay+'</td>'
                            +'<td class="d-none">'+value.ghi_chu+'</td>'
                            +'<td class="text-center"><button type="button" data="'+value.id+'" class="btn btn-danger waves-effect waves-light btnXoaChiTietBangPhanCong" ><i class="dripicons-document-delete"></i></button></td>'
                        +'</tr>';
                    });
                    jQuery('#tblChiTietBangPhanCong tbody').append(tr);
                    jQuery('.btnXoaChiTietBangPhanCong').on('click',function(){
                        var id=jQuery(this).attr('data').trim();
                        xoaChiTietBangPhanCong(id, _token);
                    });
                },
            });
        }

        function xoaChiTietBangPhanCong(id, _token){

            var xhr1;   
            var url="{{ route('xoaChiTietBangPhanCong') }}";
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
                        loadChiTietBangPhanCong(jQuery('#id').val(),_token);
                    }
                    else{
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Bạn không thể xóa dữ liệu này, xin vui lòng kiểm tra lại.',
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


        jQuery('.btnXoaBangPhanCong').on('click',function(){
            var _token=jQuery('form[name="frmChiTietBangPhanCong"]').find("input[name='_token']").val();
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
                xoaBangPhanCong(id, _token)
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


        jQuery('.btnSuaBangPhanCong').on('click',function(){
            var _token=jQuery('form[name="frmChiTietBangPhanCong"]').find("input[name='_token']").val();
            var id=jQuery(this).attr('data');

            var xhr1;   
            var url="{{ route('getBangPhanCongById') }}";
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
        
        jQuery('.btnXemChiTiet').on('click',function(){
            var id=jQuery(this).attr('data').trim();
            jQuery('#id').val(id);
            var _token=jQuery('form[name="frmChiTietBangPhanCong"]').find("input[name='_token']").val();
            loadChiTietBangPhanCong(id,_token);
        });


        jQuery('.btnThemChiTietBangPhanCong').on('click',function(){
            var _token=jQuery('form[name="frmChiTietBangPhanCong"]').find("input[name='_token']").val();
            var idPhanCong=jQuery('#id').val();
            var idDmDonViYeuCau=jQuery('#id_dm_don_vi_yeu_cau').val();
            var tuNgay=jQuery('#chi_tiet_tu_ngay').val();
            var denNgay=jQuery('#chi_tiet_den_ngay').val();

            themChiTietBangPhanCong(idPhanCong, idDmDonViYeuCau, tuNgay, denNgay, '', 1, _token);
        });







        $.fn.dataTable.ext.errMode = 'none';

        var groupColumn = 2;
        var table = $('.dsBangPhanCong').DataTable({
            "columnDefs": [
                { "visible": false, "targets": groupColumn }
            ],
            "order": [[ groupColumn, 'asc' ]],
            "displayLength": 25,
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
     
                api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="9">'+group+'</td></tr>'
                        );
     
                        last = group;
                    }
                } );
            }
        } );
     
        // Order by the grouping
        $('.dsBangPhanCong tbody').on( 'click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                table.order( [ groupColumn, 'desc' ] ).draw();
            }
            else {
                table.order( [ groupColumn, 'asc' ] ).draw();
            }
        } );
    });



</script>
@endsection
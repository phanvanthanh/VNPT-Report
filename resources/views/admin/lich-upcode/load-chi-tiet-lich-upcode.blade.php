@extends('layouts.template.ajaxIndex')

@section('content')
<table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center d-none">ID</th>
            <th class="text-center">Tên nhân viên</th>
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
            <td>{{$chiTietUpcode['name']}}</td>
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
                <span class="badge badge-danger btnXoa" data="{{$chiTietUpcode['id']}}" style="cursor: pointer;"><i class="dripicons-document-delete"></i></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';

        var groupColumn = 2;
        var table = $('.datatable-buttons').DataTable({
            "searching": false,
            "paging": false,
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
        $('.datatable-buttons tbody').on( 'click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                table.order( [ groupColumn, 'desc' ] ).draw();
            }
            else {
                table.order( [ groupColumn, 'asc' ] ).draw();
            }
        } );


        function loadChiTietUpcode(_token, idLichUpcode){
            var xhr1;   
            var url="{{ route('loadChiTietUpcode') }}";
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
                    "id":idLichUpcode,
                },
                error:function(){
                },
                success:function(data){
                    $('.tblChiTietUpcode').empty();
                    jQuery('.tblChiTietUpcode').html(data.html);
                },
            });
        }

        function del(id, _token){
            var xhr1;   
            var url="{{ route('xoaChiTietUpcode') }}";
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
                        var idLichUpcode=jQuery('#id_lich_upcode').val();
                        $.toast({
                            heading: 'Chúc mừng!',
                            text: 'Bạn đã xóa dữ liệu thành công.',
                            position: 'top-right',
                            loaderBg: '#5ba035',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 1
                        });
                        loadChiTietUpcode(_token, idLichUpcode);
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


        jQuery('.btnXoa').on('click',function(){
            var _token=jQuery('form[name="frmChiTietUpcode"]').find("input[name='_token']").val();
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
    });


</script>
@endsection
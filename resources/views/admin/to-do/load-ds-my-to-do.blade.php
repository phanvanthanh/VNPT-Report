@extends('layouts.template.ajaxIndex')
@section('content')
<form class="form-horizontal" role="form" name="frm_load_ds_my_to_do" id="frm_load_ds_my_to_do">
        {{ csrf_field() }}
</form>
<div class="col-xs-12 col-lg-6">
    <section>
        <div class="card-box">
            <div class="row">
                <div class="col-md-8"><h4>Công việc cá nhân</h4></div>
                <div class="col-md-4 text-right"><button type="button" class="btn btn-success waves-effect waves-light btn-them-moi" data-toggle="modal" data-target=".bs-to-do-modal-lg"><i class="dripicons-plus"></i></button></div>
            </div>
        </div>
        
        <ul class="list-group list-group-sortable">
            @foreach($toDos as $toDo)
                <li class='list-group-item @if($toDo->trang_thai==1) new @endif' data="{{$toDo->id}}">
                    <div class="row">
                        <div class="col-md-10 @if($toDo->trang_thai==1) gach-chu @endif">
                            <i class="mdi mdi-arrow-all"></i> 
                            <input type="checkbox" class="cb cb-{{$toDo->id}}" data="{{$toDo->id}}" @if($toDo->trang_thai==1) checked="checked" @endif> 
                            {{$toDo->noi_dung}}
                        </div>
                        <div class="col-md-2 text-right">
                            <i class="mdi mdi-border-color text-primary btn-sua" data-toggle="modal" data-target=".bs-to-do-modal-lg" style="cursor: pointer;"></i> 
                            &nbsp;&nbsp;
                            <i class="mdi mdi-delete text-danger js-delete-to-do" data="{{$toDo->id}}"  style="cursor: pointer;"></i>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
</div>
<div class="col-xs-12 col-lg-6">
    <section>
        <div class="card-box">
        <h4>Liên kết công việc chính</h4>
    </div>
        <ul class="list-group list-group-sortable2">
            @foreach($dsCongViecs as $dsCongViec)
                <li class="list-group-item">
                    <i class="mdi mdi-arrow-all"></i> 
                    {{$dsCongViec->loai_cong_viec}} - 
                        <?php $link=''; ?>
                    @if($dsCongViec->loai_cong_viec=='Chờ XL')
                        <?php $link=route('xuLyCongViecV2'); ?>
                    @elseif($dsCongViec->loai_cong_viec=='Chờ PC')
                        <?php $link=route('lanhDaoGiaoCongViecV2'); ?>
                    @elseif($dsCongViec->loai_cong_viec=='Chờ HT')
                        <?php $link=route('lanhDaoHoTroXuLy'); ?>
                    @else
                        <?php $link=route('lanhDaoDuyetCongViec'); ?>
                    @endif
                    <b><a href="{{$link}}" style="color: black;">{{$dsCongViec->ten_cong_viec}}</a></b> 
                    <span class="text-danger">
                        @if($dsCongViec->han_xu_ly_cong_viec)
                            ({{$dsCongViec->han_xu_ly_cong_viec}})
                            @endif
                    </span> 
                </li>
            @endforeach
            @if(count($dsCongViecs)==0)
                <li class="list-group-item">
                    <i class="mdi mdi-arrow-all"></i> 
                        <i>Bạn chưa có công việc nào</i>
                    <span class="text-danger">
                    </span> 
                </li>
            @endif
        </ul>
    </section>
</div>





    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('.btn-them-moi').on('click',function(){
                jQuery('#id').val('');
                jQuery('#loai_luu').val('THEMMOI');
                jQuery('#han_xu_ly_ngay').val("<?php echo date('Y-m-d'); ?>");
            });


        jQuery('.list-group-sortable').sortable({
            placeholderClass: 'list-group-item'
        });
        jQuery('.list-group-sortable').sortable().bind('sortupdate', function() {
            console.log('update');
            var _token=jQuery('form[name="frm_load_ds_my_to_do"]').find("input[name='_token']").val();
            var stt=0;
            var dsId='';
            jQuery(".cb").each(function() {
                stt++;
                var id=jQuery(this).attr('data');
                dsId+=id+';';
            });
            capNhatThuTuToDo(_token,dsId);
            
        });

        jQuery('.list-group-sortable2').sortable({
            placeholderClass: 'list-group-item'
        });
        jQuery('.list-group-sortable2').sortable().bind('sortupdate', function() {
            console.log('update 2');
        });
        function load(_token){
                
            var xhr1;   
            var url="{{ route('loadDsMyToDo') }}";
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
                    jQuery('.js-ds-to-do').empty();
                    jQuery('.js-ds-to-do').html(data.html);
                },
            });
        }
        function getToDoById(_token,id){                
            var xhr1;   
            var url="{{ route('getToDoById') }}";
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
                    "id":id
                },
                error:function(){
                },
                success:function(data){
                    if(data.error==0){
                        jQuery('#noi_dung').val(data.data.noi_dung);
                        var hanXuLy=data.data.han_xu_ly;
                        if(hanXuLy!='' && hanXuLy!=null){
                            var arrHanXuLy=hanXuLy.split(" ");
                            jQuery('#han_xu_ly_ngay').val(arrHanXuLy[0]);
                            jQuery('#han_xu_ly_gio').val(arrHanXuLy[1]);
                        }else{
                            jQuery('#han_xu_ly_ngay').val('');
                            jQuery('#han_xu_ly_gio').val('17:00:00');
                        }
                        
                        jQuery('#noi_dung').val(data.data.noi_dung);
                    }
                    
                },
            });
        }
        function capNhatTrangThaiToDo(_token,id,trangThai){                
            var xhr1;   
            var url="{{ route('capNhatTrangThaiToDo') }}";
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
                    'trang_thai':trangThai
                },
                error:function(){
                },
                success:function(data){
                    if(data.error==0){
                        load(_token);
                    }
                    
                },
            });
        }

        function capNhatThuTuToDo(_token,dsId){                
            var xhr1;   
            var url="{{ route('capNhatThuTuToDo') }}";
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
                    "ds_id":dsId
                },
                error:function(){
                },
                success:function(data){
                    
                },
            });
        }


        function deleteToDo(id, _token){
            var xhr1;   
            var url="{{ route('deleteToDo') }}";
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
                        load(_token)
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

        jQuery('.js-delete-to-do').on('click',function(){
            var _token=jQuery('form[name="frm_load_ds_my_to_do"]').find("input[name='_token']").val();
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
                deleteToDo(id, _token)
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

        
        jQuery('.btn-sua').on('click',function(){
            var id=jQuery(this).closest(".list-group-item").attr('data');
            jQuery('#id').val(id);
            jQuery('#loai_luu').val('CAPNHAT');
            var _token=jQuery('form[name="frm_load_ds_my_to_do"]').find("input[name='_token']").val();
            getToDoById(_token,id);
        });
        jQuery('.cb').on('click',function(){
            var id=jQuery(this).attr('data');
            var _token=jQuery('form[name="frm_load_ds_my_to_do"]').find("input[name='_token']").val();
            if(jQuery(this).is(':checked')==true){
                capNhatTrangThaiToDo(_token,id,1);
            }else{
                capNhatTrangThaiToDo(_token,id,0);
            }
            
        });

        
        
        
    });



</script>
@endsection
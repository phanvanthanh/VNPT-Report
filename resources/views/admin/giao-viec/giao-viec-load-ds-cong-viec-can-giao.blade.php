@extends('layouts.template.ajaxIndex')
@section('content')
<form id="frm_cay_xu_ly" name="frm_cay_xu_ly">
    {{ csrf_field() }}
</form>
<table class="table table-hover table-bordered" cellspacing="0" width="100%">'
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Mã CV</th>
            <th class="text-center">Tên công việc</th>
            <th class="text-center">Tài liệu</th>
            <th class="text-center">Kênh tiếp nhận</th>
            <th class="text-center">Thông tin chung</th>
            <th class="text-center">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $stt=0;
        ?>
        @foreach($dsCongViecs as $congViec)
            <?php $stt++; ?>
            <tr style="cursor: pointer;" data="{{$congViec->id}}" class="js-xem-cay-xu-ly <?php if($stt==1){echo 'active';} ?>">
                <td class="text-center active">{{$stt}}</td>
                <td class="text-center">{{$congViec->ma_cong_viec}}</td>
                <td class="name">
                    {{$congViec->ten_cong_viec}} <br>
                    <span style="color: black; font-size: 13px;">{{$congViec->ngay_gio_xu_ly}}</span>
                </td>
                <td class="ds-tai-lieu">
                <?php
                    $taiLieus=explode(';', $congViec->tai_lieu_cong_viec);                    
                    $stt2=0;
                    foreach ($taiLieus as $key => $taiLieu) {
                        $stt2++;
                        if($stt2<count($taiLieus)){
                            $checkDinhdang=explode('.', $taiLieu);
                            $viTri=count($checkDinhdang)-1;
                            if($checkDinhdang[$viTri]=='pdf' || $checkDinhdang[$viTri]=='jpg' || $checkDinhdang[$viTri]=='png'){
                                echo '<i class="dripicons-preview"></i>';
                            }else{
                                echo '<i class="dripicons-download"></i>';
                            }
                        ?>
                            <a target="_blank" href="/admin/dowload-tai-lieu-cong-viec-v2/{{$congViec->id}}/{{$stt2}}">File số {{$stt2}}</a><br>
                        <?php
                        }
                    }
                ?>
                </td>
                <td>
                    @if($congViec->id_loai_xu_ly==1)
                        Lãnh đạo
                    @elseif($congViec->id_loai_xu_ly==2)
                        Nhân viên
                    @else
                        Mobile
                    @endif
                </td>
                <td>
                    {{$congViec->ten_don_vi}} <br>
                    {{$congViec->ten_nguoi_xu_ly}} <br>                    
                    {{$congViec->di_dong}}
                </td>
                <td class="text-center">
                    <button type="button" data="{{$congViec->id}}"  data-toggle="modal" data-target=".bs-giao-viec-modal-lg" class="btn btn-gradient waves-effect waves-light js-giao-viec" data-toggle="tooltip" title="Giao việc, phân công công việc"><i class="dripicons-direction"></i></button>
                    <button type="button" data="{{$congViec->id}}" data-toggle="modal" data-target=".bs-chi-tiet-cong-viec-modal-lg" class="btn btn-gradient waves-effect waves-light js-xem-chi-tiet-cong-viec" data-toggle="tooltip" title="Xem chi tiết công việc"><i class="dripicons-dots-3"></i></button>
                    <button type="button" data="{{$congViec->id}}" class="btn btn-danger waves-effect waves-light btn-xoa-cong-viec" data-toggle="tooltip" title="Xóa công việc"><i class="dripicons-document-delete"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



<div class="modal fade bs-chi-tiet-cong-viec-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalChiTietCongViec" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-fullscreen">
        <form class="form-horizontal" role="form" name="frm_cap_nhat_cong_viec" id="frm_cap_nhat_cong_viec">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">XEM CHI TIẾT CÔNG VIỆC</h5>
            </div>
            <div class="modal-body bg-gray">

                <div class="row">
                    <div class="col-md-6 bg-gray">
                        <div class="row card-box">
                            <div class="col-xs-12 col-md-6">
                                <label for="ma_cong_viec">Mã công việc <span class="text-danger">*</span></label>
                                <input class="form-control ten-cong-viec" type="Text" name="ma_cong_viec" id="ma_cong_viec" value="" disabled="disabled">

                                <label for="ten_cong_viec">Tên công việc <span class="text-danger">*</span></label>
                                <input class="form-control ten-cong-viec" disabled="disabled" type="Text" name="ten_cong_viec" id="ten_cong_viec" value="">
                                <input type="hidden" name="id_loai_xu_ly" id="id_loai_xu_ly" value="1">
                                <input type="hidden" name="id" id="id">


                                <label for="noi_dung_cong_viec">Nội dung công việc <span class="text-danger"></span></label>
                                <textarea rows="5" class="form-control noi-dung-cong-viec" disabled="disabled" name="noi_dung_cong_viec" id="noi_dung_cong_viec"></textarea>
                                
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <input class="form-control ma-cong-viec" type="hidden" name="ma_cong_viec" id="ma_cong_viec" value="">

                                <div class="form-group">
                                    <label for="id_muc_do_cong_viec">Mức độ<span class="text-danger"></span></label>
                                    <select class="form-control select2 muc-do" disabled="disabled" name="id_muc_do_cong_viec" id="id_muc_do_cong_viec" style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 100%;">
                                       @foreach($mucDos as $mucDo)
                                        <option value="{{$mucDo['id']}}">{{$mucDo['ten_muc_do']}}</option>
                                        @endforeach                                
                                    </select>                            
                                </div>
                                <label for="ghi_chu_cong_viec">Ghi chú<span class="text-danger"></span></label>
                                <input class="form-control ghi-chu-cong-viec" disabled="disabled" type="Text" name="ghi_chu_cong_viec" id="ghi_chu_cong_viec" value="">


                                <div class="tai_lieu_cong_viec"></div>
                                <input class="form-control tai-lieu-cong-viec d-none" type="file" disabled="disabled" name="tai_lieu_cong_viec[]" id="tai_lieu_cong_viec" multiple style='border-radius: 2px; font-size: 10px;outline: none !important;font-family: "Roboto", sans-serif;line-height: 1.0;'>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover table-bordered datatable-buttons tb-ds-user-xu-ly" cellspacing="0" width="100%">'
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Họ tên người xử lý</th>
                                            <th class="text-center">Chính/phụ</th>
                                            <th class="text-center xoa-user-xu-ly">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="col-lg-12 jq-cay-xu-ly-cong-viec">
                            <div class="text-center">
                                <h5>QUÁ TRÌNH XỬ LÝ</h5>
                            </div>
                        </div>
                    </div> 
                </div>                        
            </div>
            

        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade bs-giao-viec-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalGiaoViec" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg center-giao-viec">
        <form class="form-horizontal" role="form" name="frm_giao_viec" id="frm_giao_viec">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">GIAO VIỆC CHO NHÂN VIÊN</h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="han_xu_ly_cong_viec_ngay">Ngài hoàn thành<span class="text-danger">*</span></label>
                        <br>
                        <input class="han-xu-ly-cong-viec-ngay" type="Date" name="han_xu_ly_cong_viec_ngay" id="han_xu_ly_cong_viec_ngay" value="<?php echo date("Y-m-d"); ?>" style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 50%;">
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 40%;" type="time" class="han-xu-ly-cong-viec-gio" name="han_xu_ly_cong_viec_gio" id="han_xu_ly_cong_viec_gio" value="17:00:00">
                        <input type="hidden" name="han_xu_ly_cong_viec" id="han_xu_ly_cong_viec" value="">
                        <input type="hidden" name="id_cong_viec" id="id_cong_viec" value="">
                        <label for=""><b>Cán bộ xử lý chính</b><span class="text-danger"></span></label>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="id_muc_do_cong_viec">Mức độ<span class="text-danger"></span></label>
                            <select class="form-control select2 muc-do" name="id_muc_do_cong_viec" id="id_muc_do_cong_viec" style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 100%;">
                               @foreach($mucDos as $mucDo)
                                <option value="{{$mucDo['id']}}">{{$mucDo['ten_muc_do']}}</option>
                                @endforeach                                
                            </select>                            
                        </div>
                        <label for=""><b>Cán bộ hỗ trợ</b><span class="text-danger"></span></label>
                    </div>
                </div>
                <div class="row scrollbar">
                    <div class="col-xs-12 col-md-6">
                        <ul id="tree1">
                            <?php 
                            $shareDonVi='';
                            foreach ($donVis as $key => $donVi) {
                                if($donVi['id']==$idDonVi){
                                    $shareDonVi.=$donVi['id'].';';
                                ?>
                                    <li data="{{$donVi['id']}}"><a href="#">{{ $donVi['ten_don_vi'] }}</a>
                                    <?php $shareDonVi.=\Helper::exportTree($donVis,$idDonVi); ?>
                                    </li>
                                <?php
                                }
                            }
                            ?>                                           
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <ul id="tree2">
                            <?php 
                            $shareDonVi='';
                            foreach ($donVis as $key => $donVi) {
                                if($donVi['id']==$idDonVi){
                                    $shareDonVi.=$donVi['id'].';';
                                ?>
                                    <li data="{{$donVi['id']}}"><a href="#">{{ $donVi['ten_don_vi'] }}</a>
                                    <?php $shareDonVi.=\Helper::exportTree($donVis,$idDonVi); ?>
                                    </li>
                                <?php
                                }
                            }
                            ?>                                           
                        </ul>
                    </div>
                </div>


                <!-- <table class="table table-hover table-bordered datatable-buttons tb-ds-user-xu-ly" cellspacing="0" width="100%">'
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Họ tên người xử lý</th>
                            <th class="text-center">Chính/phụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-giao-viec"><i class="dripicons-alarm"></i> Giao việc</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            

        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var _token=jQuery('form[name="frm_cay_xu_ly"]').find("input[name='_token']").val();
        <?php
            if(count($dsCongViecs)>0){
                echo 'loadCayXuLyCongViecV2(_token, '.$dsCongViecs[0]->id.');';
            }
        ?>

        function loadDsCongViecCanGiaoV2(_token){                
            var xhr1;   
            var url="{{ route('loadDsCongViecCanGiaoV2') }}";
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
                    jQuery('.jq-cay-xu-ly-cong-viec').html('<div class="card-box text-center"><h5>QUÁ TRÌNH XỬ LÝ</h5></div>');
                    $('.tb-ds-cong-viec').empty();
                    jQuery('.tb-ds-cong-viec').html(data.html);
                },
            });
        }
       
        function loadCayXuLyCongViecV2(_token, idCongViec){                
            var xhr1;   
            var url="{{ route('loadCayXuLyCongViecV2') }}";
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
                    $('.jq-cay-xu-ly-cong-viec').empty();
                    jQuery('.jq-cay-xu-ly-cong-viec').html(data.html);
                },
            });
        }

        $('.js-xem-cay-xu-ly').on('click',function(){
            jQuery('.js-xem-cay-xu-ly').removeClass('active');
            jQuery(this).addClass('active');
            var idCongViec=jQuery(this).attr('data');
            var _token=jQuery('form[name="frm_cay_xu_ly"]').find("input[name='_token']").val();
            loadCayXuLyCongViecV2(_token, idCongViec);
        });



        function xoaCongViecV2(id, _token){
            var xhr1;   
            var url="{{ route('xoaCongViecV2') }}";
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
                        loadDsCongViecCanGiaoV2(_token);
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

        jQuery('.btn-xoa-cong-viec').on('click',function(){
            var _token=jQuery('form[name="frm_cay_xu_ly"]').find("input[name='_token']").val();
            var idCongViec=jQuery(this).attr('data');
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
                xoaCongViecV2(idCongViec, _token)                
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



        function loadDsUserXuLyCongViec2V2(_token, idCongViec){                
            var xhr1;   
            var url="{{ route('loadDsUserXuLyCongViec2V2') }}";
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
                    if(data.error==0){ 
                        jQuery('.checkbox').prop('checked',false);
                        jQuery('.radio').prop('checked',false);
                        jQuery.each( data.data, function( key, value){
                            if(value.trang_thai==1){
                                var tenClassRadio='radio-'+value.id_user_thuc_hien;
                                jQuery('.'+tenClassRadio).prop('checked',true);
                            }else{
                                
                                var tenClassCheckbox='checkbox-'+value.id_user_thuc_hien;
                                jQuery('.'+tenClassCheckbox).prop('checked',true);
                            }
                        });
                    }
                },
            });
        }

        function xoaUserXuLyCongViec2V2(idCongViec, idUserThucHien, trangThai, _token){
            var xhr1;   
            var url="{{ route('xoaUserXuLyCongViec2V2') }}";
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
                    "id_cong_viec":idCongViec,
                    "id_user_thuc_hien":idUserThucHien,
                    "trang_thai":trangThai
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
                        loadDsUserXuLyCongViec2V2(_token, idCongViec);
                    }
                }
            });
        }


        

        /*
            Xóa = 1 hiển thị cột xóa
            Xóa = 0 không hiển thị cột xóa
        */
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
        jQuery('.js-xem-chi-tiet-cong-viec').on('click',function(){
            var _token=jQuery('form[name="frm_cay_xu_ly"]').find("input[name='_token']").val();
            var idCongViec=jQuery(this).attr('data');
            loadDsUserXuLyCongViecV2(_token, idCongViec, 0);
            

            var xhr1;   
            var url="{{ route('getChiTietCongViecV2') }}";
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
                    "id":idCongViec,
                },
                error:function(){
                },
                success:function(data){         

                    if(data.error==0){ 
                        jQuery.each( data, function( key, value){
                            jQuery('.'+key).text(value);
                            
                            if(key=='tai_lieu_cong_viec'){
                                
                                var dsTaiLieus=value.split(';');
                                var htmlTaiLieu='';
                                jQuery.each( dsTaiLieus, function( key2, value2){
                                    var stt2=key2+1;
                                    htmlTaiLieu+='<a href="#">File số '+stt2+'</a>, ';
                                });
                                jQuery('.'+key).html(htmlTaiLieu);

                            }
                        });
                        jQuery('#han_xu_ly_cong_viec').val(data.han_xu_ly_cong_viec);
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

        jQuery('.js-giao-viec').on('click',function(){
            var _token=jQuery('form[name="frm_giao_viec"]').find("input[name='_token']").val();
            var idCongViec=jQuery(this).attr('data');
            jQuery('#id_cong_viec').val(idCongViec);
            loadDsUserXuLyCongViec2V2(_token, idCongViec);
        });


        jQuery('.btn-giao-viec').on('click',function(){
            var hanXuLyCongViecNgay=jQuery('#han_xu_ly_cong_viec_ngay').val();
            var hanXuLyCongViecGio=jQuery('#han_xu_ly_cong_viec_gio').val();
            var hanXuLyCongViec=hanXuLyCongViecNgay+' '+hanXuLyCongViecGio;
            jQuery('#han_xu_ly_cong_viec').val(hanXuLyCongViec);
            if(hanXuLyCongViec==''){
                $.toast({
                    heading: 'Lỗi!',
                    text: 'Vui lòng kiểm tra lại dữ liệu.',
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 1
                });
                return false;
            }
            var form = $("form#frm_giao_viec");
            var formData = new FormData(form[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('themGiaoViecXuLyV2') }}",
                data: formData,
                contentType: false,
                processData: false,
                error:function(){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Vui lòng kiểm tra lại dữ liệu.',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
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
                        jQuery('.fade').removeClass('show').removeClass('modal-backdrop');
                        loadDsCongViecCanGiaoV2(_token);
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
                },
            });
        });



        /*Cái này xử dụng nút thêm đã đóng phía trên*/
        /*jQuery('.js-them-user-xu-ly').on('click',function(){
            var idUserThucHien=jQuery('#id_user_thuc_hien').val();
            var trangThai=jQuery('#trang_thai').val();
            var idCongViec=jQuery('#id_cong_viec').val();
            if(idUserThucHien=='' || trangThai=='' || idCongViec==''){
                $.toast({
                    heading: 'Lỗi!',
                    text: 'Vui lòng kiểm tra lại dữ liệu.',
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 1
                });
                return false;
            }
            var form = $("form#frm_giao_viec");
            var formData = new FormData(form[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('themUserXuLyV2') }}",
                data: formData,
                contentType: false,
                processData: false,
                error:function(){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Vui lòng kiểm tra lại dữ liệu.',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
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
                },
            });
        });*/


        function themUserXuLyV2(_token, idCongViec, idUserThucHien, trangThai){
            if(idCongViec=='' || idCongViec==''){
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
            var url="{{ route('themUserXuLyV2') }}";
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
                    "id_cong_viec":idCongViec,
                    "id_user_thuc_hien":idUserThucHien,
                    "trang_thai":trangThai
                },
                error:function(){
                },
                success:function(data){
                    if(data.error==0){                            
                        $.toast({
                            heading: 'Chúc mừng!',
                            text: 'Bạn đã cập nhật dữ liệu thành công.',
                            position: 'top-right',
                            loaderBg: '#5ba035',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 1
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
                        loadDsUserXuLyCongViec2V2(_token, idCongViec);
                    }
                }
            });
        }

















            // tree1
            $.fn.extend({
                treed: function (o) {
                  
                  var openedClass = 'mdi mdi-plus-circle';
                  var closedClass = 'mdi mdi-minus-circle';
                  
                  if (typeof o != 'undefined'){
                    if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                    }
                  };
                  
                    //initialize each of the top levels
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this); //li with children ul
                        // kiểm tra nếu là user thì không cần in dấu + -
                        var idDonVi=jQuery(this).attr('data').trim();
                        if(!jQuery.isNumeric(idDonVi)){
                            branch.prepend("&nbsp;&nbsp;");
                        }else{
                            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                        }

                        
                        branch.addClass('branch');
                        branch.css('cursor','pointer');
                    });

                    tree.find('li').each(function () {
                        var branch = $(this); //li with children ul
                        var idDonVi=jQuery(this).attr('data').trim();
                        if(!jQuery.isNumeric(idDonVi)){
                            var arr=idDonVi.split(':');
                            branch.prepend("<input type='radio' data='"+idDonVi+"' name='radio' class='radio radio-"+arr[1]+"'>");
                        }else{
                            idDonVi='';
                        }
                        
                        branch.on('click', function (e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        branch.children().children().toggle();
                    });
                    //fire event from the dynamically added icon
                  tree.find('.branch .indicator').each(function(){
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                  });
                    //fire event to open branch if the li contains an anchor instead of text
                    tree.find('.branch>a').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                    //fire event to open branch if the li contains a button instead of text
                    tree.find('.branch>button').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });


                }
            });


            //Initialization of treeviews

            $('#tree1').treed();
            $('li.tree-show').css('display','block');
            jQuery('.radio').on('click',function(){
                var data=jQuery(this).attr('data');
                var id=data.split(":");
                var idUserThucHien=id[1];
                var idCongViec=jQuery('#id_cong_viec').val();
                var _token=jQuery('form[name="frm_giao_viec"]').find("input[name='_token']").val();
                if(jQuery(this).prop('checked')==true){
                    themUserXuLyV2(_token, idCongViec, idUserThucHien, 1);
                }else{
                    xoaUserXuLyCongViec2V2(idCongViec, idUserThucHien, 1, _token);
                }

            });





            // tree 2
            $.fn.extend({
                treed2: function (o) {
                  
                  var openedClass = 'mdi mdi-plus-circle';
                  var closedClass = 'mdi mdi-minus-circle';
                  
                  if (typeof o != 'undefined'){
                    if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                    }
                  };
                  
                    //initialize each of the top levels
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this); //li with children ul
                        // kiểm tra nếu là user thì không cần in dấu + -
                        var idDonVi=jQuery(this).attr('data').trim();
                        if(!jQuery.isNumeric(idDonVi)){
                            branch.prepend("&nbsp;&nbsp;");
                        }else{
                            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                        }

                        
                        branch.addClass('branch');
                        branch.css('cursor','pointer');
                    });

                    tree.find('li').each(function () {
                        var branch = $(this); //li with children ul
                        var idDonVi=jQuery(this).attr('data').trim();

                        if(!jQuery.isNumeric(idDonVi)){
                            var arr=idDonVi.split(':');
                            branch.prepend("<input type='checkbox' data='"+idDonVi+"' name='checkbox' class='checkbox checkbox-"+arr[1]+"'>");
                        }else{
                            idDonVi='';
                        }
                        
                        branch.on('click', function (e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        branch.children().children().toggle();
                    });
                    //fire event from the dynamically added icon
                  tree.find('.branch .indicator').each(function(){
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                  });
                    //fire event to open branch if the li contains an anchor instead of text
                    tree.find('.branch>a').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                    //fire event to open branch if the li contains a button instead of text
                    tree.find('.branch>button').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });


                }
            });


            //Initialization of treeviews

            $('#tree2').treed2();
            $('li.tree-show').css('display','block');
            jQuery('.checkbox').on('click',function(){
                var data=jQuery(this).attr('data');
                var id=data.split(":");
                var idUserThucHien=id[1];
                var idCongViec=jQuery('#id_cong_viec').val();
                var _token=jQuery('form[name="frm_giao_viec"]').find("input[name='_token']").val();
                if(jQuery(this).prop('checked')==true){
                    themUserXuLyV2(_token, idCongViec, idUserThucHien, 0);
                }else{
                    xoaUserXuLyCongViec2V2(idCongViec, idUserThucHien, 0, _token);
                }
                
                
            });
        
        
    });



</script>
@endsection
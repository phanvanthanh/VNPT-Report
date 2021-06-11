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
                    {{$congViec->ten_cong_viec}}<br>
                    <span style="color: black; font-size: 13px;">{{$congViec->han_xu_ly_cong_viec}}</span>
                    @if($congViec->han_xu_ly_cong_viec)<br>
                        <?php

                            $tyLe=\Helper::tyLePhanTram($congViec->ngay_gio_tao, $congViec->han_xu_ly_cong_viec, date('Y-m-d H:i:s'));
                            if($tyLe>50 && $tyLe<=90){
                                $classTyLe='warning';
                            }elseif($tyLe>90){
                                $classTyLe='danger';
                            }else{
                                $classTyLe='success';
                            }
                        ?>
                        <div class="progress mb-0">
                            <div class="progress-bar progress-bar-striped bg-{{$classTyLe}}" role="progressbar" aria-valuenow="{{$tyLe}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tyLe}}%"><?php echo number_format($tyLe, 0) ?>%</div>
                        </div>
                    @endif
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
                
                <td class="text-center">
                    <button type="button" data="{{$congViec->id}}"  data-toggle="modal" data-target=".bs-xu-ly-yeu-cau-ho-tro-modal-lg" class="btn btn-gradient waves-effect waves-light js-xu-ly-yeu-cau-ho-tro"  data-toggle="tooltip" title="Phản hồi yêu cầu hỗ trợ"><i class="dripicons-reply-all"></i></button> 
                    <button type="button" data="{{$congViec->id}}" data-toggle="modal" data-target=".bs-chi-tiet-cong-viec-modal-lg" class="btn btn-gradient waves-effect waves-light js-xem-chi-tiet-cong-viec"  data-toggle="tooltip" title="Xem chi tiết công việc"><i class="dripicons-dots-3"></i></button>
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

                                <label for="han_xu_ly_cong_viec">Hạn xử lý<span class="text-danger"></span></label>
                                <input class="form-control han-xu-ly-cong-viec" disabled="disabled" type="Text" name="han_xu_ly_cong_viec" id="han_xu_ly_cong_viec">

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

<div class="modal fade bs-xu-ly-yeu-cau-ho-tro-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalXuLyYeuCauHoTro" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg center">
        <form class="form-horizontal" role="form" name="frm_phan_hoi_yeu_cau" id="frm_phan_hoi_yeu_cau">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">XỬ LÝ YÊU CẦU HỖ TRỢ</h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <input type="hidden" name="id_cong_viec" class="id-cong-viec">
                        <label for="noi_dung_xu_ly">Nội dung các công việc đã xử lý <span class="text-danger"></span></label>
                        <textarea rows="5" class="form-control noi-dung-xu-ly" name="noi_dung_xu_ly" id="noi_dung_xu_ly"></textarea>

                        <div class="form-group">
                            <label for="file_xu_ly">Tài liệu<span class="text-danger"></span></label>
                            <input class="form-control file-xu-ly" type="file" name="file_xu_ly[]" multiple style='border-radius: 2px; font-size: 10px;outline: none !important;font-family: "Roboto", sans-serif;line-height: 1.0;'>                           
                        </div>   
                        <label for="han_xu_ly_cong_viec">Điều chỉnh hạn xử lý<span class="text-danger"></span></label><br>
                        <input class="han-xu-ly-cong-viec-ngay" type="Date" name="han_xu_ly_cong_viec_ngay" id="han_xu_ly_cong_viec_ngay" value="" style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 50%;">
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 40%;" type="time" class="han-xu-ly-cong-viec-gio" name="han_xu_ly_cong_viec_gio" id="han_xu_ly_cong_viec_gio" value="">
                        <input class="han-xu-ly-cong-viec" type="hidden" name="han_xu_ly_cong_viec">                     
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-tra-loi-yeu-cau"><i class="dripicons-alarm"></i> Phản hồi yêu cầu</button>
                <button type="button" class="btn btn-primary btn-duyet-hoan-thanh-cong-viec"><i class="dripicons-alarm"></i> Duyệt hoàn thành công việc</button>
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

        function loadDsCongViecCanLanhDaoHoTroV2(_token){                
            var xhr1;   
            var url="{{ route('loadDsCongViecCanLanhDaoHoTroV2') }}";
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

        jQuery('.js-xu-ly-yeu-cau-ho-tro').on('click',function(){
            var _token=jQuery('form[name="frm_phan_hoi_yeu_cau"]').find("input[name='_token']").val();
            var idCongViec=jQuery(this).attr('data');
            jQuery('.id-cong-viec').val(idCongViec);
        });


        jQuery('.btn-tra-loi-yeu-cau').on('click',function(){
            var noiDungXuLy=jQuery('#noi_dung_xu_ly').val();
            var hanXuLyCongViecNgay=jQuery('#han_xu_ly_cong_viec_ngay').val();
            var hanXuLyCongViecGio=jQuery('#han_xu_ly_cong_viec_gio').val();
            jQuery('#han_xu_ly_cong_viec').val(hanXuLyCongViecNgay+' '+hanXuLyCongViecGio);
            if(noiDungXuLy==''){
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
            var form = $("form#frm_phan_hoi_yeu_cau");
            var formData = new FormData(form[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('phanHoiYeuCauHoTroV2') }}",
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
                        loadDsCongViecCanLanhDaoHoTroV2(_token);
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

        
        jQuery('.btn-duyet-hoan-thanh-cong-viec').on('click',function(){
            var noiDungXuLy=jQuery('#noi_dung_xu_ly').val();
            var hanXuLyCongViecNgay=jQuery('#han_xu_ly_cong_viec_ngay').val();
            var hanXuLyCongViecGio=jQuery('#han_xu_ly_cong_viec_gio').val();
            jQuery('#han_xu_ly_cong_viec').val(hanXuLyCongViecNgay+' '+hanXuLyCongViecGio);
            var form = $("form#frm_phan_hoi_yeu_cau");
            var formData = new FormData(form[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('duyetHoanTatCongViecV2') }}",
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
                        loadDsCongViecCanLanhDaoHoTroV2(_token);
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

        
        
    });



</script>
@endsection
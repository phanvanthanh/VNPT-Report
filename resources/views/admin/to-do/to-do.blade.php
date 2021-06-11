@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<!-- <div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>TO DO</h5></div>
                <div class="col-lg-6 float-right text-right"></div>
            </div>
                
        </div>
    </div>
        
</div> -->
<div class="row">
    <div class="col-xs-12 col-lg-12">
        &nbsp;
    </div>
</div>
<div class="row js-ds-to-do">
</div>

<div class="modal fade bs-to-do-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalToDo" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg center">
        <form class="form-horizontal" role="form" name="frm_to_do" id="frm_to_do">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">THÊM/CẬP NHẬT TO DO</h5>
                <input type="hidden" name="han_xu_ly" id="han_xu_ly" value="">
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="loai_luu" id="loai_luu" value="THEMMOI">
            </div>
            <div class="modal-body bg-gray">

                <div class="row card-box">
                    <div class="col-xs-12 col-md-12">
                        <label for="noi_dung">Nội dung công việc <span class="text-danger"></span></label>
                        <textarea rows="5" class="form-control noi-dung" name="noi_dung" id="noi_dung" value=""></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="han_xu_ly_ngay">Hạn xử lý ngày<span class="text-danger">*</span></label>
                        <br>
                        <input class="han-xu-ly-ngay" type="Date" name="han_xu_ly_ngay" id="han_xu_ly_ngay" value="" style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 100%;">
                    </div>
                    <div class="col-xs-12 col-md-6">
                         <label for="han_xu_ly_gio">Giờ<span class="text-danger">*</span></label>
                        <br>
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px; width: 100%" type="time" class="han-xu-ly-gio" name="han_xu_ly_gio" id="han_xu_ly_gio" value="17:00:00">
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-luu-lai" data-dismiss="modal"><i class="mdi mdi-content-save-all"></i> Lưu lại</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            

        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div>







    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            

            

            









            var _token=jQuery('form[name="frm_to_do"]').find("input[name='_token']").val();
            load(_token);

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

            $('.btn-luu-lai').on('click',function(){
                var hanXuLyNgay=jQuery('#han_xu_ly_ngay').val();
                var hanXuLyGio=jQuery('#han_xu_ly_gio').val();
                if(hanXuLyNgay && hanXuLyGio){
                    jQuery('#han_xu_ly').val(hanXuLyNgay+' '+hanXuLyGio);
                }
                
                var noiDung=jQuery('#noi_dung').val();
                var loaiLuu=jQuery('#loai_luu').val();
                if(noiDung==''){
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
                var urlSend='';
                if(loaiLuu=='CAPNHAT'){
                    urlSend="{{ route('updateToDo') }}";
                }else{
                    urlSend="{{ route('themToDo') }}";
                }
                var form = $("form#frm_to_do");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: urlSend,
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
                            load(_token);
                            jQuery('.bs-to-do-modal-lg').modal('toggle');
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


            $('.btnCapNhat').on('click',function(){
                var thoiGian=jQuery('#thoi_gian_yeu_cau_nghi_bu').val();
                var noiDung=jQuery('#noi_dung_nghi_bu').val();
                if(thoiGian=='' || noiDung==''){
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
                
                var form = $("form#frmBaoCaoNghiBu");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaBaoCaoNghiBu') }}",
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
                    },
                });
            });


        });







    // tree
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
                        branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                        branch.addClass('branch');
                        branch.css('cursor','pointer');
                    });

                    tree.find('li').each(function () {
                        var branch = $(this); //li with children ul
                         var idDonVi=jQuery(this).attr('data').trim();
                        branch.prepend("<input type='checkbox' checked='checked' data='"+idDonVi+"' class='checkbox'>");
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
            //$('li.tree-show').css('display','block');
            $('.checkbox').on('click',function(){

                var shareDonVi=jQuery('#ds_don_vi_duoc_chia_se').val();
                if($(this).prop('checked')==true){
                    $(this).parent().find('input[type="checkbox"]').each(function () {
                        $(this).prop('checked', true);
                        var idDonViShare=$(this).parent('li').attr('data')+';';
                        shareDonVi+=idDonViShare;
                        console.log(shareDonVi);
                        $('#ds_don_vi_duoc_chia_se').val(shareDonVi);
                    });    
                }else{
                    $(this).parent().find('input[type="checkbox"]').each(function () {
                        $(this).prop('checked', false);
                        var idDonViShare=$(this).parent('li').attr('data')+';';
                        shareDonVi=shareDonVi.replace(idDonViShare,'');
                        console.log(shareDonVi);
                        $('#ds_don_vi_duoc_chia_se').val(shareDonVi);

                    });
                }
                
            });





    /*// tree
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
                        branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                        branch.addClass('branch');
                        branch.css('cursor','pointer');
                    });

                    tree.find('li').each(function () {
                        var branch = $(this); //li with children ul
                        var idDonVi=jQuery(this).attr('data').trim();
                        branch.prepend("<input type='radio' name='radio' data='"+idDonVi+"' class='radio'>");
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
                var idDonVi=jQuery(this).attr('data').trim();
                jQuery('#ds_don_vi_duoc_chia_se').val(idDonVi);
            });*/



    </script>
@endsection

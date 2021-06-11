@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>GỬI YÊU CẦU XIN PHÉP NGHỈ BÙ</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row add-form d-none">    
    <div class="col-lg-12">
        <div class="card-box">
            <p class="text-muted font-14 m-b-20">
            </p>

            <form id="frmBaoCaoNghiBu" name="frmBaoCaoNghiBu">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <label for="noi_dung_nghi_bu">Nội dung <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="noi_dung_nghi_bu" id="noi_dung_nghi_bu" value="">
                        <input type="hidden" name="id" id="id" value="">

                        <!-- Tree -->
                        <div class="form-group d-none">
                            <label for="tree1">Báo cáo đến đơn vị: <span class="text-danger"></span></label>

                            <ul id="tree1">
                                <?php 
                                $shareDonVi='';
                                foreach ($donVis as $key => $donVi) {
                                    if($donVi['id']==$idDonViGoc){
                                        $shareDonVi.=$donVi['id'].';';
                                    ?>
                                        <li data="{{$donVi['id']}}"><a href="#">{{ $donVi['ten_don_vi'] }}</a>
                                        <?php $shareDonVi.=\Helper::exportTree($donVis,$idDonViGoc); ?>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>                                           
                            </ul>
                            <input type="hidden" name="ds_don_vi_duoc_chia_se" id="ds_don_vi_duoc_chia_se" value="{{$shareDonVi}}">
                            <input type="hidden" name="ds_tai_khoan_duoc_chia_se" id="ds_tai_khoan_duoc_chia_se" value="">
                            <!-- end tree -->
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <label for="thoi_gian_yeu_cau_nghi_bu">Thời gian (8 giờ = 1 ngày) <span class="text-danger">*</span></label>
                        <input class="form-control" type="Number" name="thoi_gian_yeu_cau_nghi_bu" id="thoi_gian_yeu_cau_nghi_bu" value="" required>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <label for="id_lich_upcode">Lý do upcode<span class="text-danger"></span></label>
                            <select class="form-control select2" name="id_lich_upcode" id="id_lich_upcode">
                                <option value="">Chọn lịch upcode</option>                                
                                @foreach($lichUpcodes as $lichUpcode)
                                <option value="{{$lichUpcode['id']}}">{{$lichUpcode['ten_lich_upcode']}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        
                    </div>
                    
                    <div class="col-xs-12 col-md-3">
                        <label for="btnTao" style="color: white;"> Xem<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button>

                        <button type="button" class="btn btn-gradient waves-effect waves-light btnCapNhat"><i class="dripicons-document-edit"></i>Cập nhật</button>
                    </div>
                    
                        
                </div>
            </form>
            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="card-box table-responsive tblDanhSachBaoCaoNghiBu">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Người yêu cầu</th>
                        
                        <th class="text-center">Nội dung</th>
                        <th class="text-center">Yêu cầu</th>
                        <th class="text-center">Lý do</th>

                        <th class="text-center">Người duyệt</th>
                        <th class="text-center">Duyệt (Giờ)</th>

                        <th class="text-center">Tình trạng</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>







    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var _token=jQuery('form[name="frmBaoCaoNghiBu"]').find("input[name='_token']").val();
            load(_token);

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

            $('.btnThemMoi').on('click',function(){
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
                    url: "{{ route('themBaoCaoNghiBu') }}",
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

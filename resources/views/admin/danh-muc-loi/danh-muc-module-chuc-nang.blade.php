@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>DANH MỤC MODULE / CHỨC NĂNG</h5></div>
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

            <form id="frmDmModuleChucNang" name="frmDmModuleChucNang">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <label for="ten_dm_loi">Tên module chức năng <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="ten_dm_loi" id="ten_dm_loi" value="">
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group">
                            <br>
                            <label for="tree1">Chia sẽ lỗi với các đơn vị sau<span class="text-danger"></span></label>
                            <!-- Tree -->
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

                            <input type="hidden" name="ds_don_vi_duoc_chia_se" id="ds-don-vi-duoc-chia-se" value="{{$shareDonVi}}">
                            <input type="hidden" name="ds_tai_khoan_duoc_chia_se" id="ds-tai-khoan-duoc-chia-se" value="">
                            <!-- end tree -->
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="id_lich_upcode">Liên kết chức năng<span class="text-danger"></span></label>
                            <input class="form-control" type="Text" name="link_video_loi" id="link_video_loi" value="">
                        </div>
                        <div class="form-group">
                            <label for="id_loai_danh_muc">Loại dịch vụ hỗ trợ<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_loai_danh_muc" id="id_loai_danh_muc" required  value="{{ old('id_loai_danh_muc') }}">
                              <option value="">Chọn loại danh mục</option>
                              @foreach($loaiDanhMucs as $loaiDanhMuc)
                                <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                              @endforeach
                                
                            </select>
                        </div>

                        
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="id_loai_danh_muc">Loại Module/Chức năng<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="loai" id="loai" required  value="{{ old('id_loai_danh_muc') }}">
                              <option value="">Chọn loại</option>
                              <option value="MODULE">Module</option>
                              <option value="CHỨC NĂNG">Chức năng</option>
                                
                            </select>
                        </div>

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
        <div class="card-box table-responsive tblDmModuleChucNang">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên chức năng</th>
                        <th class="text-center">Liên kết</th>
                        <th class="text-center">Loại</th>
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
            var _token=jQuery('form[name="frmDmModuleChucNang"]').find("input[name='_token']").val();
            load(_token);

            function load(_token){
                
                var xhr1;   
                var url="{{ route('loadDanhMucModuleChucNang') }}";
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
                        $('.tblDmModuleChucNang').empty();
                        jQuery('.tblDmModuleChucNang').html(data.html);
                    },
                });
            }

            $('.btnThemMoi').on('click',function(){
                jQuery('#id').val('');
                var tenDmLoi=jQuery('#ten_dm_loi').val();
                if(tenDmLoi==''){
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
                var form = $("form#frmDmModuleChucNang");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('themDanhMucModuleChucNang') }}",
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
                var tenDmLoi=jQuery('#ten_dm_loi').val();
                if(tenDmLoi==''){
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
                
                var form = $("form#frmDmModuleChucNang");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaDanhMucModuleChucNang') }}",
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
                    branch.prepend("<input type='checkbox' checked='checked' class='checkbox'>");
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
            var shareDonVi=jQuery('#ds-don-vi-duoc-chia-se').val();
            if($(this).prop('checked')==true){
                $(this).parent().find('input[type="checkbox"]').each(function () {
                    $(this).prop('checked', true);
                    var idDonViShare=$(this).parent('li').attr('data')+';';
                    shareDonVi+=idDonViShare;
                    jQuery('#ds-don-vi-duoc-chia-se').val(shareDonVi);
                });    
            }else{
                $(this).parent().find('input[type="checkbox"]').each(function () {
                    $(this).prop('checked', false);
                    var idDonViShare=$(this).parent('li').attr('data')+';';
                    shareDonVi=shareDonVi.replace(idDonViShare,'');
                    jQuery('#ds-don-vi-duoc-chia-se').val(shareDonVi);

                });
            }
            
        });

    </script>
@endsection

@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>DM LIÊN KẾT QUẢN TRỊ</h5></div>
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

            <form id="frmDmLinkQuanTri" name="frmDmLinkQuanTri">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="ten_link">Tên chức năng <span class="text-danger">*</span></label>
                            <input class="form-control" type="Text" name="ten_link" id="ten_link" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Liên kết <span class="text-danger">*</span></label>
                            <input class="form-control" type="Text" name="link" id="link" value="" required>
                            <input type="hidden" name="id" id="id" value="">
                        </div>

                        <div class="form-group">
                            <label for="id_loai_danh_muc">Dịch vụ<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_loai_danh_muc" id="id_loai_danh_muc" required  value="{{ old('id_loai_danh_muc') }}">
                              <option value="">Chọn loại danh mục</option>
                              @foreach($loaiDanhMucs as $loaiDanhMuc)
                                <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                              @endforeach
                            </select>
                        </div>
                        

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
                    <div class="col-xs-12 col-md-6">
                        
                        <label for="mo_ta">Mô tả <span class="text-danger"></span></label>
                        <textarea name="mo_ta" id="mo_ta" class="form-control" style="height: 190px;"></textarea>

                        
                    </div>
                    
                    <div class="col-xs-12 col-md-2">
                        <label for="btnTao" style="color: white;"> Xem<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button>
                        <br>
                        <label for="btnTao" style="color: white;"> Xem<span class="text-danger"></span></label><br>
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
        <div class="card-box table-responsive tblDanhSachLinkQuanTri">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên liên kết</th>
                        
                        <th class="text-center">Liên kết</th>
                        <th class="text-center">Mô tả</th>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center">Tạo bởi</th>

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
        
            var _token=jQuery('form[name="frmDmLinkQuanTri"]').find("input[name='_token']").val();
            load(_token);

            function load(_token){
                
                var xhr1;   
                var url="{{ route('loadDmLinkQuanTri') }}";
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
                        $('.tblDanhSachLinkQuanTri').empty();
                        jQuery('.tblDanhSachLinkQuanTri').html(data.html);
                    },
                });
            }

            $('.btnThemMoi').on('click',function(){
                var form = $("form#frmDmLinkQuanTri");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('themDmLinkQuanTri') }}",
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
                var form = $("form#frmDmLinkQuanTri");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaDmLinkQuanTri') }}",
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




    </script>
@endsection

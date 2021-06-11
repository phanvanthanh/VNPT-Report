@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>LOẠI DỊCH VỤ</h5></div>
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

            <form id="frmLoaiDanhMuc" name="frmLoaiDanhMuc">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <label for="ten_loai_danh_muc">Tên loại <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="ten_loai_danh_muc" id="ten_loai_danh_muc" value="">
                        <input type="hidden" name="id" id="id" value="">
                    </div>

                    
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="state">Trạng thái<span class="text-danger"></span></label>
                            <select class="form-control select2" name="state" id="state">
                                <option value="">Chọn trạng thái</option>
                                <optgroup label="">
                                    <option value="1">Mở</option>
                                    <option value="0">Đóng</option>
                                </optgroup>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-md-4">
                        <label for="btnTao" style="color: white;"> Thêm mới<span class="text-danger"></span></label><br>
                        
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
        <div class="card-box table-responsive tblLoaiDanhMuc">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên loại dịch vụ</th>
                        <th class="text-center">Người tạo</th>
                        <th class="text-center">Trạng thái</th>
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
            var _token=jQuery('form[name="frmLoaiDanhMuc"]').find("input[name='_token']").val();
            load(_token);
            function load(_token){
                
                var xhr1;   
                var url="{{ route('loadLoaiDanhMuc') }}";
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
                        $('.tblLoaiDanhMuc').empty();
                        jQuery('.tblLoaiDanhMuc').html(data.html);
                    },
                });
            }

            function create(tenLoaiDanhMuc, state=1, _token){
                if(tenLoaiDanhMuc==''){
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
                var url="{{ route('themLoaiDanhMuc') }}";
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
                        "ten_loai_danh_muc":tenLoaiDanhMuc,
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
                            load(_token);
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
            jQuery('.btnThemMoi').on('click', function(){
                var _token=jQuery('form[name="frmLoaiDanhMuc"]').find("input[name='_token']").val();
                var tenLoaiDanhMuc=jQuery('#ten_loai_danh_muc').val();
                var state=jQuery('#state').val();
                if(state==''){state=1;}
                create(tenLoaiDanhMuc, state, _token);
            });


            $('.btnCapNhat').on('click',function(){
                var tenLoaiDanhMuc=jQuery('#ten_loai_danh_muc').val();
                if(tenLoaiDanhMuc==''){
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
                
                var form = $("form#frmLoaiDanhMuc");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaLoaiDanhMuc') }}",
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



    </script>
@endsection

@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>DANH MỤC KHÁCH HÀNG</h5></div>
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

            <form id="frmCanBo" name="frmCanBo">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <label for="ten_can_bo">Tên cán bộ <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="ten_can_bo" id="ten_can_bo" value="">
                        <input type="hidden" name="id" id="id" value="">

                        <label for="di_dong">Số điện thoại <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="di_dong" id="di_dong" value="">
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <label for="id_dm_don_vi_yeu_cau">Đơn vị<span class="text-danger"></span></label>
                            <select class="form-control select2" name="id_dm_don_vi_yeu_cau" id="id_dm_don_vi_yeu_cau">
                                <option value="">Chọn đơn vị</option>
                                @foreach($dmDonViYeuCaus as $donVi)
                                <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                                @endforeach
                                
                            </select>

                            <label for="dia_chi">Địa chỉ <span class="text-danger">*</span></label>
                            <input class="form-control" type="Text" name="dia_chi" id="dia_chi" value="">
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <label for="id_chuc_vu">Chức vụ<span class="text-danger"></span></label>
                            <select class="form-control select2" name="id_chuc_vu" id="id_chuc_vu">
                                <option value="">Chọn chức vụ</option>
                                @foreach($dmChucVus as $dmChucVu)
                                <option value="{{$dmChucVu['id']}}">{{$dmChucVu['ten_chuc_vu']}}</option>
                                @endforeach
                            </select>

                            <label for="state">Trạng thái<span class="text-danger"></span></label>
                            <select class="form-control select2" name="state" id="state">
                                <option value="">Chọn trạng thái</option>   
                                <option value="1">Mở</option>
                                <option value="0">Đóng</option>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-md-3">
                        <label for="btnTao" style="color: white;"> Thêm mới<span class="text-danger"></span></label><br>
                        
                        <button type="button" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button> 
                        <label for="btnCapNhat" style="color: white;"> Cập nhật<span class="text-danger"></span></label><br><br>
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
        <div class="card-box table-responsive tblCanBo">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên cán bộ</th>
                        <th class="text-center">Số ĐT</th>
                        <th class="text-center">Chức vụ</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">Đơn vị</th>
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
            var _token=jQuery('form[name="frmCanBo"]').find("input[name='_token']").val();
            load(_token);
            function load(_token){
                
                var xhr1;   
                var url="{{ route('loadCanBo') }}";
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
                        $('.tblCanBo').empty();
                        jQuery('.tblCanBo').html(data.html);
                    },
                });
            }

            function create(tenCanBo, idDmDonViYeuCau, diDong, idChucVu, diaChi, state=1, _token){
                if(tenCanBo=='' || idDmDonViYeuCau=='' || diDong=='' || idChucVu=='' ){
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
                var url="{{ route('themCanBo') }}";
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
                        "ten_can_bo":tenCanBo,
                        "id_dm_don_vi_yeu_cau":idDmDonViYeuCau,
                        "di_dong":diDong,
                        "id_chuc_vu":idChucVu,
                        "dia_chi":diaChi,
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
                var _token=jQuery('form[name="frmCanBo"]').find("input[name='_token']").val();
                var tenCanBo=jQuery('#ten_can_bo').val();
                var idDmDonViYeuCau=jQuery('#id_dm_don_vi_yeu_cau').val();
                var diDong=jQuery('#di_dong').val();
                var idChucVu=jQuery('#id_chuc_vu').val();
                var diaChi=jQuery('#dia_chi').val();
                var state=jQuery('#state').val();
                if(state==''){state=1;}
                create(tenCanBo, idDmDonViYeuCau, diDong, idChucVu, diaChi, state, _token);
            });


            $('.btnCapNhat').on('click',function(){
                var tenCanBo=jQuery('#ten_can_bo').val();
                var idChucVu=jQuery('#id_chuc_vu').val();
                var idDonVi=jQuery('#id_dm_don_vi_yeu_cau').val();
                if(idChucVu=='' || tenCanBo=='' || idDonVi==''){
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
                
                var form = $("form#frmCanBo");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaCanBo') }}",
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

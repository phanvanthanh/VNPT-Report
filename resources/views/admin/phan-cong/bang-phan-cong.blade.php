@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>QUẢN LÝ KẾ HOẠCH</h5></div>
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

            <form id="bangPhanCong" name="bangPhanCong" role="form" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="">
            
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="id_user">Chuyên viên hỗ trợ<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_user" required id="id_user">
                                <option value="">Chọn chuyên viên</option>
                                @foreach($dsUsers as $user)
                                  <option value="{{$user['id']}}">{{$user['name']}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_loai_danh_muc">Chọn loại dịch vụ hỗ trợ<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_loai_danh_muc" required  id="id_loai_danh_muc">
                                <option value="">Chọn loại danh mục</option>
                                @foreach($loaiDanhMucs as $loaiDanhMuc)
                                  <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <label for="tu_ngay">Thời gian từ:<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="tu_ngay" id="tu_ngay" value="<?php echo date("Y-m-d"); ?>"> 
                        <label for="den_ngay">Đến<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="den_ngay" id="den_ngay" value="">
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="ghi_chu">Ghi chú <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="ghi_chu" id="ghi_chu" value="">
                    </div>
                    
                    <div class="col-xs-12 col-md-2">
                        <label for="btnTao" style="color: white;"> Xem<span class="text-danger"></span></label><br>
                        
                        <button type="button" class="btn btn-success waves-effect waves-light btnTaoBanPhanCong"><i class="mdi mdi-library-plus"></i>Thêm mới</button>
                        
                        <br>                        
                        <label for="xuatLichUpcodeWord" style="color: white;">xem<span class="text-danger"></span></label><br>
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
        <div class="card-box table-responsive dsBangPhanCong">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center">Chuyên viên</th>
                        <th class="text-center">Từ ngày</th>
                        <th class="text-center">Đến ngày</th>
                        <th class="text-center">Tạo bởi</th>
                        <th class="text-center" style="white-space:nowrap;">Chi tiết</th>
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

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" role="form" method="POST" name="frmChiTietBangPhanCong" action="{{ route('loadChiTietBangPhanCong') }}">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">THÔNG TIN CHI TIẾT BẢNG PHÂN CÔNG</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label for="id_dm_don_vi_yeu_cau">Chọn đơn vị hỗ trợ<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_dm_don_vi_yeu_cau" required id="id_dm_don_vi_yeu_cau">
                                <option value="">Chọn đơn vị hỗ trợ</option>
                                <optgroup label="">
                                    @foreach($dmDonViYeuCaus as $dmDonViYeuCau)
                                      <option value="{{$dmDonViYeuCau['id']}}">{{$dmDonViYeuCau['ten_don_vi']}}</option>
                                    @endforeach
                                </optgroup>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <label for="chi_tiet_tu_ngay">Từ ngày:<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="chi_tiet_tu_ngay" id="chi_tiet_tu_ngay" value="<?php echo date("Y-m-d"); ?>"> 
                        
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <label for="chi-tiet-den_ngay">Đến<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="chi_tiet_den_ngay" id="chi_tiet_den_ngay" value="">
                    </div>
                    
                    <div class="col-xs-12 col-md-2">
                        <label for="btnThemChiTietBangPhanCong" style="color: white;">Thêm mới<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-success waves-effect waves-light btnThemChiTietBangPhanCong"><i class="mdi mdi-library-plus"></i>Thêm mới</button>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <table id="tblChiTietBangPhanCong" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center d-none">ID</th>
                                    <th class="text-center">Đơn vị hỗ trợ</th>
                                    <th class="text-center">Từ ngày</th>
                                    <th class="text-center">Đến ngày</th>
                                    <th class="text-center d-none">Ghi chú</th>
                                    <th class="text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

        </div>
        </form>
    </div>
</div>







    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var _token=jQuery('form[name="bangPhanCong"]').find("input[name='_token']").val();
            loadBangPhanCong(_token);
            function loadBangPhanCong(_token){
                
                var xhr1;   
                var url="{{ route('loadBangPhanCong') }}";
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
                        $('.dsBangPhanCong').empty();
                        jQuery('.dsBangPhanCong').html(data.html);
                    },
                });
            }

            function taoBangPhanCong(idUser, idLoaiDanhMuc, tuNgay, denNgay, ghiChu, state, _token){
                if(idUser=='' || idLoaiDanhMuc==''){
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
                var url="{{ route('taoBangPhanCong') }}";
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
                        "id_user_phan_cong":idUser,
                        "id_user":idUser,                        
                        "id_loai_danh_muc":idLoaiDanhMuc,                        
                        "tu_ngay":tuNgay,
                        "den_ngay":denNgay,
                        "ghi_chu":ghiChu,
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
                            loadBangPhanCong(_token);
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
            jQuery('.btnTaoBanPhanCong').on('click', function(){
                var _token=jQuery('form[name="bangPhanCong"]').find("input[name='_token']").val();
                var idUser=jQuery('#id_user').val();
                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                var ghiChu=jQuery('#ghi_chu').val();
                var state=1;
                taoBangPhanCong(idUser, idLoaiDanhMuc, tuNgay, denNgay, ghiChu, state, _token);
            });


            $('.btnCapNhat').on('click',function(){
                var idUser=jQuery('#id_user').val();
                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var tuNgay=jQuery('#tu_ngay').val();
                if(idUser=='' || idLoaiDanhMuc=='' || tuNgay==''){
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
                
                var form = $("form#bangPhanCong");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaBangPhanCong') }}",
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
                            loadBangPhanCong(_token)
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

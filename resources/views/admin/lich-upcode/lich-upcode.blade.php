@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>LỊCH UPCODE</h5></div>
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

            <form id="lichUpcode" name="lichUpcode">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-7 ke_hoach">
                        <label for="id_loai_danh_muc">Tên kế hoạch <span class="text-danger">*</span></label>
                        <input class="form-control" type="Text" name="ten_lich_upcode" id="ten_lich_upcode" value="">
                        
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="id_loai_danh_muc">Dịch vụ<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="id_loai_danh_muc" id="id_loai_danh_muc" required  value="{{ old('id_loai_danh_muc') }}">
                                      <option value="">Chọn loại danh mục</option>
                                      @foreach($loaiDanhMucs as $loaiDanhMuc)
                                        <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="state">Trạng thái<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="state" id="state" required  value="{{ old('state') }}">
                                      <option value="0">Chưa hoàn thành</option>
                                      <option value="1">Đã hoàn thành</option>
                                    </select>
                                </div>

                                <div class="form-group d-none">
                                    <label for="so_luong_nhan_su_tham_gia">SL nhân sự <span class="text-danger">*</span></label>
                                    <input class="form-control" type="Number" name="so_luong_nhan_su_tham_gia" id="so_luong_nhan_su_tham_gia" value="1">
                                </div>
                            </div>
                            
                        </div>
                        

                        <input type="hidden" name="id" id="id" value="">
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <label for="thoi_gian_bat_dau_du_kien">Thời gian dự kiến từ:<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="thoi_gian_bat_dau_du_kien_ngay" id="thoi_gian_bat_dau_du_kien_ngay" value="<?php echo date("Y-m-d"); ?>"> 
                        <label for="thoi_gian_ket_thuc_du_kien_ngay">Đến<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="thoi_gian_ket_thuc_du_kien_ngay" id="thoi_gian_ket_thuc_du_kien_ngay" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-xs-12 col-md-1">
                        <label for="thoi_gian_bat_dau_du_kien_gio" style="color: white;"> Giờ<span class="text-danger"></span></label>
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px;" type="time" name="thoi_gian_bat_dau_du_kien_gio" id="thoi_gian_bat_dau_du_kien_gio">
                        <label for="thoi_gian_ket_thuc_du_kien_gio" style="color: white;"> Giờ<span class="text-danger"></span></label>
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px;" type="time" name="thoi_gian_ket_thuc_du_kien_gio" id="thoi_gian_ket_thuc_du_kien_gio">
                    </div>
                    <div class="col-xs-12 col-md-2 tgtt_ngay d-none">
                        <label for="thoi_gian_bat_dau_ngay">Thời gian test upcode:<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="thoi_gian_bat_dau_ngay" id="thoi_gian_bat_dau_ngay" value="<?php echo date("Y-m-d"); ?>">
                        <label for="thoi_gian_ket_thuc_ngay">Đến<span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="thoi_gian_ket_thuc_ngay" id="thoi_gian_ket_thuc_ngay" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-xs-12 col-md-1 tgtt_gio d-none">
                        <label for="thoi_gian_bat_dau_gio" style="color: white;"> Giờ<span class="text-danger"></span></label>
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px;" type="time" name="thoi_gian_bat_dau_gio" id="thoi_gian_bat_dau_gio">
                        <label for="thoi_gian_ket_thuc_gio" style="color: white;"> Giờ<span class="text-danger"></span></label>
                        <input style="width: auto;border: 1px solid #dadada; border-radius: 4px;height: 30px;font-size: 15px;" type="time" name="thoi_gian_ket_thuc_gio" id="thoi_gian_ket_thuc_gio">
                    </div>
                    <div class="col-xs-12 col-md-1">
                        <label for="btnTao" style="color: white;"> Xem<span class="text-danger"></span></label><br>
                        
                        <button type="button" class="btn btn-success waves-effect waves-light btnTaoLichUpcode"><i class="mdi mdi-library-plus"></i>Thêm mới</button>
                        
                        <br>                        
                        <label for="xuatLichUpcodeWord" style="color: white;">xem<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-gradient waves-effect waves-light btnSuaLichUpcode"><i class="dripicons-document-edit"></i>Cập nhật</button>
                    </div>
                </div>
            </form>
            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        
        <div class="card-box table-responsive dsLichUpcode">
            <table id="datatable-buttons3" class="table table-hover table-bordered datatable-buttons3 dsLichUpcode" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên kế hoạch</th>
                        <th class="text-center">Thời gian dự kiến</th>
                        <th class="text-center">Thời gian test upcode</th>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center d-none">Nhân sự</th>
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
        <form class="form-horizontal" role="form" name="frmChiTietUpcode" id="frmChiTietUpcode" action="{{ route('themChiTietUpcode') }}">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">THÔNG TIN CHI TIẾT LỊCH BIỂU</h5>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <!-- <hr style="width: 100%;"> -->
                            <label for="id_users">Nhân sự <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control select2" name="id_users" id="id_users" required>
                                    <option value="">Chọn nhân sự tham gia</option>
                                    @foreach($dsUsers as $dsUser)
                                      <option value="{{$dsUser['id']}}">{{$dsUser['name']}}</option>
                                    @endforeach                                    
                                </select>

                                <input type="hidden" name="id_lich_upcode" id="id_lich_upcode" value="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="id_dm_loi">Lỗi/Module/Chức năng <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control select2" name="id_dm_loi" id="id_dm_loi" required>
                                                                       
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="id_loai_danh_muc">Ghi chú <span class="text-danger"></span></label>
                            <input class="form-control" type="Text" name="ghi_chu" id="ghi_chu" value="">
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <label for="btnLuu" style="color: white;"> Nút lưu<span class="text-danger"></span></label>
                            <button type="button" class="btn btn-success waves-effect waves-light btnLuu"><i class="mdi mdi-library-plus"></i>Lưu</button>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="tblChiTietUpcode">
                                <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center d-none">ID</th>
                                            <th class="text-center">Tên nhân viên</th>
                                            <th class="text-center">Tên lỗi/ module/ chức năng</th>
                                            <th class="text-center">Ghi chú</th>
                                            <th class="text-center">Trạng thái</th>
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
            

        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            function getLichUpcodeById(id, _token){
                var xhr1;   
                var url="{{ route('getLichUpcodeById') }}";
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
                            jQuery('#id').val(data.id);
                            jQuery('#ten_lich_upcode').val(data.ten_lich_upcode);
                            jQuery('#so_luong_nhan_su_tham_gia').val(data.so_luong_nhan_su_tham_gia);

                            var thoiGianBatDau=data.thoi_gian_bat_dau.split(' ');
                            var thoiGianBatDauNgay=thoiGianBatDau[0].trim();
                            var thoiGianBatDauGio=thoiGianBatDau[1].trim();

                            var thoiGianKetThuc=data.thoi_gian_ket_thuc.split(' ');
                            var thoiGianKetThucNgay=thoiGianKetThuc[0].trim();
                            var thoiGianKetThucGio=thoiGianKetThuc[1].trim();

                            if(thoiGianBatDauGio=='00:00:00'){
                                thoiGianBatDauGio='';
                            }
                            if(thoiGianKetThucGio=='00:00:00'){
                                thoiGianKetThucGio='';
                            }

                            jQuery('#thoi_gian_bat_dau_ngay').val(thoiGianBatDauNgay);
                            jQuery('#thoi_gian_bat_dau_gio').val(thoiGianBatDauGio);
                            jQuery('#thoi_gian_ket_thuc_ngay').val(thoiGianKetThucNgay);
                            jQuery('#thoi_gian_ket_thuc_gio').val(thoiGianKetThucGio);


                            var thoiGianBatDauDuKien=data.thoi_gian_bat_dau_du_kien.split(' ');
                            var thoiGianBatDauDuKienNgay=thoiGianBatDauDuKien[0].trim();
                            var thoiGianBatDauDuKienGio=thoiGianBatDauDuKien[1].trim();

                            var thoiGianKetThucDuKien=data.thoi_gian_ket_thuc_du_kien.split(' ');
                            var thoiGianKetThucDuKienNgay=thoiGianKetThucDuKien[0].trim();
                            var thoiGianKetThucDuKienGio=thoiGianKetThucDuKien[1].trim();

                            if(thoiGianBatDauDuKienGio=='00:00:00'){
                                thoiGianBatDauDuKienGio='';
                            }
                            if(thoiGianKetThucDuKienGio=='00:00:00'){
                                thoiGianKetThucDuKienGio='';
                            }

                            $('#id_loai_danh_muc').val(data.id_loai_danh_muc);
                            $("#id_loai_danh_muc > option").each(function() {
                                if(this.value==data.id_loai_danh_muc){
                                  jQuery('#select2-id_loai_danh_muc-container').text(this.text);
                                }
                            });

                            $('#state').val(data.state);

                            $("#state > option").each(function() {
                                if(this.value==data.state){
                                  jQuery('#select2-state-container').text(this.text);
                                }
                            });

                            jQuery('#thoi_gian_bat_dau_du_kien_ngay').val(thoiGianBatDauDuKienNgay);
                            jQuery('#thoi_gian_bat_dau_du_kien_gio').val(thoiGianBatDauDuKienGio);
                            jQuery('#thoi_gian_ket_thuc_du_kien_ngay').val(thoiGianKetThucDuKienNgay);
                            jQuery('#thoi_gian_ket_thuc_du_kien_gio').val(thoiGianKetThucDuKienGio);
                            jQuery('.add-form').removeClass('d-none');

                            if(data.state==1){
                                jQuery('.ke_hoach').removeClass('col-md-7').addClass('col-md-4');
                                jQuery('.tgtt_ngay').removeClass('d-none');
                                jQuery('.tgtt_gio').removeClass('d-none');
                            }else{
                                jQuery('.ke_hoach').removeClass('col-md-4').addClass('col-md-7');
                                jQuery('.tgtt_ngay').addClass('d-none');
                                jQuery('.tgtt_gio').addClass('d-none');
                            }
                        }else{
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
            }

            function loadDanhMucLoi(idLichUpcode, _token){
                var xhr1;   
                var url="{{ route('loadDanhMucLoi') }}";
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
                        "id_lich_upcode":idLichUpcode,
                    },
                    error:function(){
                    },
                    success:function(data){
                        $('#id_dm_loi').empty();
                            jQuery('#id_dm_loi').html(data.html);
                            
                    },
                });
            }

            function loadChiTietUpcode(_token, idLichUpcode){
                
                var xhr1;   
                var url="{{ route('loadChiTietUpcode') }}";
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
                        "id":idLichUpcode,
                    },
                    error:function(){
                    },
                    success:function(data){
                        $('.tblChiTietUpcode').empty();
                        jQuery('.tblChiTietUpcode').html(data.html);
                    },
                });
            }

            function loadLichUpcode(_token){
                
                var xhr1;   
                var url="{{ route('loadLichUpcode') }}";
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
                        if(data.error!=1){
                            jQuery('.dsLichUpcode').html('');
                            var tb='<table id="datatable-buttons3" class="table table-hover table-bordered datatable-buttons3 dsLichUpcode" cellspacing="0" width="100%">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th class="text-center">STT</th>'
                                        +'<th class="text-center d-none">ID</th>'
                                        +'<th class="text-center">Tên kế hoạch</th>'
                                        +'<th class="text-center">Thời gian dự kiến</th>'
                                        +'<th class="text-center">Thời gian test upcode</th>'
                                        +'<th class="text-center">Dịch vụ</th>'
                                        +'<th class="text-center d-none">Nhân sự</th>'
                                        +'<th class="text-center">Tạo bởi</th>'
                                        +'<th class="text-center" style="white-space:nowrap;">Chi tiết</th>'
                                        +'<th class="text-center">Sửa</th>'
                                        +'<th class="text-center">Xóa</th>'
                                    +'</tr>'
                                +'</thead>'
                            +'<tbody>'; 
                            var stt=0;
                            jQuery.each( data, function( key, value){
                                stt++;
                                var thoiGianBatDau=value.thoi_gian_bat_dau.trim().split(' ');
                                var thoiGianKetThuc=value.thoi_gian_ket_thuc.trim().split(' ');
                                var trangThai='danger';
                                /*if(thoiGianBatDau[1]!='00:00:00' || thoiGianKetThuc[1]!='00:00:00' && thoiGianBatDau[1]!=thoiGianKetThuc[1]){
                                    trangThai='success';
                                }*/
                                if(value.state==1){
                                    trangThai='success';
                                }
                                tb+='<tr>'
                                    +'<td class="text-center">'+stt+'</td>'
                                    +'<td class="text-center d-none">'+value.id+'</td>'
                                    +'<td class="name">'+value.ten_lich_upcode+'</td>'
                                    +'<td class="">Từ: '+value.thoi_gian_bat_dau_du_kien+' <br><span style="white-space:nowrap;">Đến '+value.thoi_gian_ket_thuc_du_kien+'</span></td>'
                                    +'<td class="">Từ: '+value.thoi_gian_bat_dau+'<br><span style="white-space:nowrap;">Đến '+value.thoi_gian_ket_thuc+'</span></td>'
                                    +'<td class="text-center">'+value.ten_loai_danh_muc+'</td>'
                                    +'<td class="text-center d-none">'+value.so_luong_nhan_su_tham_gia+'</td>'
                                    +'<td class="text-center">'+value.name+'</td>'
                                    +'<td class="text-center"><span type="span" class="badge badge-'+trangThai+' waves-effect waves-light btnXemChiTiet" data-toggle="modal" data-target=".bs-example-modal-lg" data="'+value.id+'">Chi tiết</span></td>'
                                    +'<td class="text-center">'
                                        +'<button type="button" data="'+value.id+'" class="btn btn-gradient waves-effect waves-light suaLichUpcode" ><i class="dripicons-document-edit"></i></button>'
                                    +'</td>'
                                    +'<td class="text-center">'
                                        +'<button type="button" data="'+value.id+'" class="btn btn-danger sa-warning delete btnXoaLichUpcode" ><i class="dripicons-document-delete"></i></button>'
                                    +'</td>'
                                +'</tr>';

                            });
                            tb+='</tbody></table>';
                            jQuery('.dsLichUpcode').html(tb);
                            jQuery('.suaLichUpcode').on('click',function(){
                                var id=jQuery(this).attr('data').trim();
                                getLichUpcodeById(id,_token);
                            });
                            jQuery('.btnXemChiTiet').on('click',function(){
                                var id=jQuery(this).attr('data').trim();
                                jQuery('#id').val(id);
                                jQuery('#id_lich_upcode').val(id);
                                loadChiTietUpcode(_token, id);
                                loadDanhMucLoi(id,_token);
                            });
                            jQuery('.btnXoaLichUpcode').on('click', function(){
                                var id=jQuery(this).attr('data').trim();
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
                                    xoaLichUpcode(id, _token)
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
                            var dtTable = jQuery('#datatable-buttons3').DataTable({
                                lengthChange: true,
                            });

                            dtTable.buttons().container().appendTo('#datatable-buttons3_wrapper .col-md-6:eq(0)');
                            jQuery('#datatable-buttons3_filter').addClass('text-right');
                        }

                        
                    },
                });
            }

            

            function taoLichUpcode(tenLichUpcode, thoiGianBatDauDuKien, thoiGianKetThucDuKien, thoiGianBatDau, thoiGianKetThuc, soLuongNhanSu, state, idLoaiDanhMuc, _token){
                if(tenLichUpcode=='' || idLoaiDanhMuc==''){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Bạn phải nhập đầy đủ thông tin!',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
                }
                var xhr1;   
                var url="{{ route('taoLichUpcode') }}";
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
                        "ten_lich_upcode":tenLichUpcode,
                        "id_loai_danh_muc":idLoaiDanhMuc,
                        "thoi_gian_bat_dau_du_kien":thoiGianBatDauDuKien,
                        "thoi_gian_ket_thuc_du_kien":thoiGianKetThucDuKien,
                        "thoi_gian_bat_dau":thoiGianBatDau,
                        "thoi_gian_ket_thuc":thoiGianKetThuc,
                        "so_luong_nhan_su_tham_gia":soLuongNhanSu,
                        "state":state,
                    },
                    error:function(){
                    },
                    success:function(data){
                        if(data.error==0){                            
                            $.toast({
                                heading: 'Chúc mừng!',
                                text: 'Bạn đã tạo lịch thành công.',
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 1
                            });
                            loadLichUpcode(_token);
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

            function suaLichUpcode(id, tenLichUpcode, thoiGianBatDauDuKien, thoiGianKetThucDuKien, thoiGianBatDau, thoiGianKetThuc, soLuongNhanSu, state, idLoaiDanhMuc, _token){
                var xhr1;   
                var url="{{ route('suaLichUpcode') }}";
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
                        "ten_lich_upcode":tenLichUpcode,
                        "id_loai_danh_muc":idLoaiDanhMuc,
                        "thoi_gian_bat_dau_du_kien":thoiGianBatDauDuKien,
                        "thoi_gian_ket_thuc_du_kien":thoiGianKetThucDuKien,
                        "thoi_gian_bat_dau":thoiGianBatDau,
                        "thoi_gian_ket_thuc":thoiGianKetThuc,
                        "so_luong_nhan_su_tham_gia":soLuongNhanSu,
                        "state":state,
                    },
                    error:function(){
                    },
                    success:function(data){
                        if(data.error==0){                            
                            $.toast({
                                heading: 'Chúc mừng!',
                                text: 'Bạn đã sửa lịch thành công.',
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 1
                            });
                            loadLichUpcode(_token);
                            $('#thoi_gian_bat_dau_ngay').val('');
                            $('#thoi_gian_ket_thuc_ngay').val('');
                            $('#thoi_gian_bat_dau_gio').val('');
                            $('#thoi_gian_ket_thuc_gio').val('');
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
            }

            function xoaLichUpcode(id, _token){

                var xhr1;   
                var url="{{ route('xoaLichUpcode') }}";
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
                                text: 'Bạn đã xóa lịch thành công.',
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 1
                            });
                            loadLichUpcode(_token);
                        }
                        else{
                            $.toast({
                                heading: 'Lỗi!',
                                text: 'Bạn không thể xóa LỊCH này, xin vui lòng kiểm tra lại.',
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

            $('.btnLuu').on('click',function(){
                var idUser=jQuery('#id_users').val();
                var idDmLoi=jQuery('#id_dm_loi').val();
                if(idUser=='' || idDmLoi==''){
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
                var form = $("form#frmChiTietUpcode");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('themChiTietUpcode') }}",
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
                            var idLichUpcode=jQuery('#id_lich_upcode').val();

                            loadChiTietUpcode(_token, idLichUpcode)
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



            // load lịch upcode trước
            var _token=jQuery('form[name="lichUpcode"]').find("input[name='_token']").val();
            loadLichUpcode(_token);


            jQuery('.btnTaoLichUpcode').on('click', function(){
                var _token=jQuery('form[name="lichUpcode"]').find("input[name='_token']").val();
                var tenLichUpcode=jQuery('#ten_lich_upcode').val();
                var soLuongNhanSu=jQuery('#so_luong_nhan_su_tham_gia').val();
                var thoiGianBatDauDuKien=jQuery('#thoi_gian_bat_dau_du_kien_ngay').val()+' '+jQuery('#thoi_gian_bat_dau_du_kien_gio').val();
                var thoiGianKetThucDuKien=jQuery('#thoi_gian_ket_thuc_du_kien_ngay').val()+' '+jQuery('#thoi_gian_ket_thuc_du_kien_gio').val();
                var thoiGianBatDau=jQuery('#thoi_gian_bat_dau_ngay').val()+' '+jQuery('#thoi_gian_bat_dau_gio').val();
                var thoiGianKetThuc=jQuery('#thoi_gian_ket_thuc_ngay').val()+' '+jQuery('#thoi_gian_ket_thuc_gio').val();
                var state=jQuery('#state').val();
                if(state==1){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Bạn chưa cấu hình chi tiết lịch upcode này nên không thể chọn trạng thái ĐÃ HOÀN THÀNH!',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
                }

                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();

                taoLichUpcode(tenLichUpcode, thoiGianBatDauDuKien, thoiGianKetThucDuKien, thoiGianBatDau, thoiGianKetThuc, soLuongNhanSu, state, idLoaiDanhMuc, _token);
            });


            
            jQuery('.btnSuaLichUpcode').on('click', function(){
                var _token=jQuery('form[name="lichUpcode"]').find("input[name='_token']").val();
                var id=jQuery('#id').val();
                var tenLichUpcode=jQuery('#ten_lich_upcode').val();
                var soLuongNhanSu=jQuery('#so_luong_nhan_su_tham_gia').val();
                var thoiGianBatDauDuKien=jQuery('#thoi_gian_bat_dau_du_kien_ngay').val()+' '+jQuery('#thoi_gian_bat_dau_du_kien_gio').val();
                var thoiGianKetThucDuKien=jQuery('#thoi_gian_ket_thuc_du_kien_ngay').val()+' '+jQuery('#thoi_gian_ket_thuc_du_kien_gio').val();
                var thoiGianBatDau=jQuery('#thoi_gian_bat_dau_ngay').val()+' '+jQuery('#thoi_gian_bat_dau_gio').val();
                var thoiGianKetThuc=jQuery('#thoi_gian_ket_thuc_ngay').val()+' '+jQuery('#thoi_gian_ket_thuc_gio').val();
                var state=jQuery('#state').val();
                if((state==1 && thoiGianBatDau==thoiGianKetThuc) || (state==1 && jQuery('#thoi_gian_bat_dau_gio').val()=='') || (state==1 && jQuery('#thoi_gian_ket_thuc_gio').val()=='')){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Phải cập nhật thời gian test code đối với các lịch có trạng thái đã hoàn thành',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
                }

                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                
                suaLichUpcode(id, tenLichUpcode, thoiGianBatDauDuKien, thoiGianKetThucDuKien, thoiGianBatDau, thoiGianKetThuc, soLuongNhanSu, state, idLoaiDanhMuc, _token);
            });

            jQuery('#state').on('change', function(){
                var state=jQuery(this).val();
                if(state==1){
                    jQuery('.ke_hoach').removeClass('col-md-7').addClass('col-md-4');
                    jQuery('.tgtt_ngay').removeClass('d-none');
                    jQuery('.tgtt_gio').removeClass('d-none');
                }else{
                    jQuery('.ke_hoach').removeClass('col-md-4').addClass('col-md-7');
                    jQuery('.tgtt_ngay').addClass('d-none');
                    jQuery('.tgtt_gio').addClass('d-none');
                }
            });
            

            
        });



    </script>
@endsection

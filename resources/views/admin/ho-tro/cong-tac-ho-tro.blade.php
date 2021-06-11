@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>CẬP NHẬT CÔNG VIỆC ĐÃ HỖ TRỢ (TUẦN)</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row add-form">    
    <div class="col-lg-12">
        <div class="card-box">
            <p class="text-muted font-14 m-b-20">
            </p>

            <form role="form" name="formCongTacHoTro" id="formCongTacHoTro">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-md-3">
                        <label for="tu_ngay">Từ ngày<span class="text-danger">*</span></label>
                        <input class="form-control d-none" type="date" name="tu_ngay" id="tu_ngay" value="<?php echo date("Y-m-d"); ?>">
                        <input class="form-control d-none" type="date" id="ngayHoTro" value="<?php echo date("Y-m-d"); ?>">

                        <div class="form-group">
                            <select class="form-control select2" name="tuan" id="tuan">
                                <?php
                                for ($i=1; $i < 55; $i++) { 
                                        ?><option value="{{$i}}" <?php if($i==$tuan){ echo 'selected="selected"'; } ?>>Tuần {{$i}}</option><?php
                                    }
                                ?> 
                                
                            </select>
                        </div>
                        <!-- <select class="form-control" name="tuan" id="tuan">
                            <?php
                                for ($i=1; $i < 55; $i++) { 
                                    ?><option value="{{$i}}" <?php if($i==$tuan){ echo 'selected="selected"'; } ?>>Tuần {{$i}}</option><?php
                                }
                            ?>                            
                        </select> -->
                    </div>
                    <div class="col-md-3">
                        <label for="den_ngay">Đến ngày<span class="text-danger">*</span></label>
                        <input class="form-control d-none" type="date" name="den_ngay" id="den_ngay" value="<?php echo date("Y-m-d"); ?>">
                        <div class="form-group">
                            <select class="form-control select2" name="nam" id="nam">
                                <?php
                                    for ($i=1992; $i < 2050; $i++) { 
                                        ?><option value="{{$i}}" <?php if($i==$nam){ echo 'selected="selected"'; } ?>>Năm {{$i}}</option><?php
                                    }
                                ?>                            
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="id_loai_danh_muc">Loại dịch vụ hỗ trợ 
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <select class="form-control select2" name="id_loai_danh_muc" id="id_loai_danh_muc">
                                <option value="">------Chọn danh mục------</option>
                                @foreach($loaiDanhMucs as $key => $dm)
                                <option value="{{ $dm['id'] }}">{{ $dm['ten_loai_danh_muc'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="btnXem" style="color: white;">Xem báo cáo<span class="text-danger"></span></label><br>
                            <button type="button" class="btn btn-success waves-effect waves-light btnXem"><i class="mdi mdi-library-plus"></i>Xem</button> 
                            <a href="#" class="btn btn-success waves-effect waves-light baoCaoCongTacHoTroTuanWord d-none"><i class="fa fa-floppy-o"></i> Xuất Báo cáo</a>
                        </div>
                    </div>
                </div>
            </form>

            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card-box table-responsive dmLoi">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center d-none">STT</th>
                        <th class="text-center">Tên danh mục</th>
                        <th class="text-center d-none">Ngày</th>
                        <th class="text-center">ĐV</th>
                        <th class="text-center">Thêm</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card-box table-responsive dmHoTro">
            <table id="datatable-buttons2" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center d-none">STT</th>
                        <th class="text-center">Tên danh mục</th>
                        <th class="text-center">Đơn vị</th>
                        <th class="text-center d-none">Ngày</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center" >Xóa</th>
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
            var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
            getTuan(<?php echo $tuan; ?>, <?php echo $nam; ?>, token);
            console.log(jQuery('#ngayHoTro').val());
            
            function loadDanhMucLoi(idLoaiDanhMuc, token){
                var xhr1;   
                var url="{{ route('getDanhMucLoiTheoLoaiDanhMuc') }}";
                if(xhr1 && xhr1.readyState != 4){
                    xhr1.abort(); //huy lenh ajax truoc do
                }
                xhr1 = $.ajax({
                    url:url,
                    type:'POST',
                    dataType:'json',
                    cache: false,
                    data:{
                        "_token":token,
                        "id_loai_danh_muc":idLoaiDanhMuc,
                    },
                    error:function(){
                    },
                    success:function(data){
                        

                        var table='<table id="datatable-buttons" class="table table-striped table-bordered datatable-buttons" cellspacing="0" width="100%">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th class="text-center d-none">STT</th>'
                                        +'<th class="text-center">Tên danh mục</th>'
                                        +'<th class="text-center d-none">Ngày</th>'
                                        +'<th class="text-center">Đơn vị</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>';
                                
                        jQuery.each( data, function( key, value){
                            table+='<tr style="cursor:pointer;" >'
                                +'<td class="d-none idDanhMucLoi">'+value.id+'</td>'
                                +'<td class="name tenDanhMucLoi themThongTinHoTro">'+value.ten_dm_loi+'</td>'
                                +'<td class="d-none"><input class="form-control ngayHoTro" type="date" name="ngayHoTro" value="<?php echo date("Y-m-d"); ?>" style="width: 150px"></td>'
                                +'<td>'
                                    +'<div class="form-group">'
                                        +'<select class="form-control select2 idDonViYeuCau" id="idDonViYeuCau" name="idDonViYeuCau">'
                                            +'@foreach($dmDonViYeuCaus as $dmDonViYeuCau)'
                                                +'<option value="<?php echo $dmDonViYeuCau['id']; ?>"><?php echo $dmDonViYeuCau['ten_don_vi']; ?></option>'
                                            +'@endforeach'
                                        +'</select>'
                                    +'</div>'
                                +'</td>'                                
                            +'</tr>';
                        });
                        table+='</tbody>'
                            +'</table>';
                        
                        jQuery('.dmLoi').html(table);
                        var dtTable = jQuery('#datatable-buttons').DataTable({
                            lengthChange: true,
                        });

                        dtTable.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
                        jQuery('#datatable-buttons_filter').addClass('text-right');

                        // bấm vào thẻ tr bên tay trái
                        jQuery('.themThongTinHoTro').on('click',function(){
                            var idDanhMucLoi=jQuery(this).parent('tr').find('.idDanhMucLoi').text().trim();
                            //var ngayHoTro=jQuery(this).parent('tr').find('.ngayHoTro').val();
                            var ngayHoTro=jQuery('#ngayHoTro').val();
                            var idDonViYeuCau=jQuery(this).parent('tr').find('.idDonViYeuCau').val();
                            themThongTinHoTro(idDanhMucLoi, ngayHoTro, idDonViYeuCau, token);
                        });
                        
                    },

                });
            }

            function getTuan(tuan, nam, token){
                var xhr1;   
                var url="{{ route('getTuan') }}";
                if(xhr1 && xhr1.readyState != 4){
                    xhr1.abort(); //huy lenh ajax truoc do
                }
                xhr1 = $.ajax({
                    url:url,
                    type:'POST',
                    dataType:'json',
                    cache: false,
                    data:{
                        "_token":token,
                        "tuan":tuan,
                        "nam":nam,
                    },
                    error:function(){
                    },
                    success:function(data){
                       jQuery('#tu_ngay').val(data.ret[2]);
                       jQuery('#den_ngay').val(data.ret[8]);
                       jQuery('#ngayHoTro').val(data.ret[6]);
                    },

                });
            }

            function getCongTacHoTro(tu_ngay, den_ngay, idLoaiDanhMuc, token){
                var xhr1;   
                var url="{{ route('getCongTacHoTro') }}";
                if(xhr1 && xhr1.readyState != 4){
                    xhr1.abort(); //huy lenh ajax truoc do
                }
                xhr1 = $.ajax({
                    url:url,
                    type:'POST',
                    dataType:'json',
                    cache: false,
                    data:{
                        "_token":token,
                        "id_loai_danh_muc":idLoaiDanhMuc,
                        "tu_ngay":tu_ngay,
                        "den_ngay":den_ngay,
                    },
                    error:function(){
                    },
                    success:function(data){
                        var table='<table id="datatable-buttons2" class="table table-striped table-bordered datatable-buttons2" cellspacing="0" width="100%">'
                            +'<thead>'
                                +'<tr>'
                                    +'<th class="text-center d-none">STT</th>'
                                    +'<th class="text-center">Tên danh mục</th>'
                                    +'<th class="text-center">Đơn vị</th>'
                                    +'<th class="text-center d-none">Ngày</th>'
                                    +'<th class="text-center">SL</th>'
                                    +'<th class="text-center">Xóa</th>'
                                +'</tr>'
                            +'</thead>'
                            +'<tbody>';
                        jQuery.each( data, function( key, value){
                            var date = new Date(value.ngay_ho_tro);
                            var ngayHoTro=date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
                            table+='<tr style="cursor:pointer;">'
                                +'<td class="d-none">'+value.id+'</td>'
                                +'<td class="name">'+value.ten_dm_loi+'</td>'
                                +'<td>'+value.ten_don_vi+'</td>'
                                +'<td style="white-space:nowrap;" class="d-none">'+ngayHoTro+'</td>'
                                +'<td>'+value.so_lan_ho_tro+'</td>'  
                                +'<td>'
                                    +'<button type="button" data="'+value.id+'" class="btn btn-danger sa-warning btnXoaThongTinHoTro" ><i class="dripicons-document-delete"></i></button>'
                                +'</td>' 
                            +'</tr>';
                        });

                        table+='</tbody>'
                            +'</table>';
                        
                        jQuery('.dmHoTro').html(table);


                        jQuery('.btnXoaThongTinHoTro').on('click',function(){                                
                            var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                            var idCongTacHoTro=jQuery(this).attr('data').trim();
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
                                xoaThongTinHoTro(idCongTacHoTro, token)
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



                        var dtTable = jQuery('#datatable-buttons2').DataTable({
                            lengthChange: true,
                        });

                        dtTable.buttons().container().appendTo('#datatable-buttons2_wrapper .col-md-6:eq(0)');
                        jQuery('#datatable-buttons2_filter').addClass('text-right');
                    },

                });
            }



            function themThongTinHoTro(idDanhMucLoi, ngayHoTro, idDonViYeuCau, _token){
                var xhr1;   
                var url="{{ route('themThongTinHoTro') }}";
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
                        "id_dm_loi":idDanhMucLoi,
                        "ngay_ho_tro":ngayHoTro,
                        "id_dm_don_vi_yeu_cau":idDonViYeuCau,
                    },
                    error:function(){
                    },
                    success:function(data){
                        

                        if(data.error==0){                            
                            $.toast({
                                heading: 'Chúc mừng!',
                                text: 'Bạn đã thêm dữ liệu thành công.',
                                position: 'top-right',
                                loaderBg: '#5ba035',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 1
                            });
                            var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                            var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                            var tuNgay=jQuery('#tu_ngay').val();
                            var denNgay=jQuery('#den_ngay').val();
                            if(tuNgay && denNgay && idLoaiDanhMuc && token){
                                getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                            }
                        }
                        else{
                            $.toast({
                                heading: 'Lỗi!',
                                text: 'Bạn không thể xóa dữ liệu này, xin vui lòng kiểm tra lại.',
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


            function xoaThongTinHoTro(idCongTacHoTro, _token){
                var xhr1;   
                var url="{{ route('xoaThongTinHoTro') }}";
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
                        "id":idCongTacHoTro,
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
                            var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                            var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                            var tuNgay=jQuery('#tu_ngay').val();
                            var denNgay=jQuery('#den_ngay').val();
                            if(tuNgay && denNgay && idLoaiDanhMuc && token){
                                getCongTacHoTro(tu_ngay, den_ngay, idLoaiDanhMuc, token);
                            }
                        }
                        else{
                            $.toast({
                                heading: 'Lỗi!',
                                text: 'Bạn không thể xóa dữ liệu này, xin vui lòng kiểm tra lại.',
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

            jQuery('#tuan').on('change',function(){
                var token=$('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuan=jQuery('#tuan').val();
                var nam=jQuery('#nam').val()
                getTuan(tuan, nam, token);

                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                if(tuNgay && denNgay && idLoaiDanhMuc && token){
                    getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                    jQuery('.baoCaoCongTacHoTroTuanWord').removeClass('d-none');
                }
            });

            jQuery('#nam').on('change',function(){
                var token=$('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuan=jQuery('#tuan').val();
                var nam=jQuery('#nam').val()
                getTuan(tuan, nam, token);

                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                if(tuNgay && denNgay && idLoaiDanhMuc && token){
                    getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                    jQuery('.baoCaoCongTacHoTroTuanWord').removeClass('d-none');
                }
            });

            jQuery('#id_loai_danh_muc').on('change',function(){
                var idLoaiDanhMuc=jQuery(this).val();
                var token=$('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                loadDanhMucLoi(idLoaiDanhMuc, token);

                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                if(tuNgay && denNgay && idLoaiDanhMuc && token){
                    getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                    jQuery('.baoCaoCongTacHoTroTuanWord').removeClass('d-none');
                }
                else{
                    jQuery('.baoCaoCongTacHoTroTuanWord').addClass('d-none');
                }
            });

            jQuery('#tu_ngay').on('change',function(){
                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                if(tuNgay && denNgay && idLoaiDanhMuc && token){
                    getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                    jQuery('.baoCaoCongTacHoTroTuanWord').removeClass('d-none');
                }
                else{
                    jQuery('.baoCaoCongTacHoTroTuanWord').addClass('d-none');
                }
            });
            jQuery('#den_ngay').on('change',function(){
                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                if(tuNgay && denNgay && idLoaiDanhMuc && token){
                    getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                    jQuery('.baoCaoCongTacHoTroTuanWord').removeClass('d-none');
                }
                else{
                    jQuery('.baoCaoCongTacHoTroTuanWord').addClass('d-none');
                }
            });

            jQuery('.btnXem').on('click',function(){
                var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                var token=jQuery('form[name="formCongTacHoTro"]').find("input[name='_token']").val();
                var tuNgay=jQuery('#tu_ngay').val();
                var denNgay=jQuery('#den_ngay').val();
                if(tuNgay && denNgay && idLoaiDanhMuc && token){
                    getCongTacHoTro(tuNgay, denNgay, idLoaiDanhMuc, token);
                    jQuery('.baoCaoCongTacHoTroTuanWord').removeClass('d-none');
                }
                else{
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Xin vui lòng kiểm tra lại. <br> Bạn đã nhập thông tin chưa đúng.',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    jQuery('.baoCaoCongTacHoTroTuanWord').addClass('d-none');
                }
            }); 


            jQuery('.baoCaoCongTacHoTroTuanWord').on('click',function(){
                var nam=jQuery('#nam').val();
                var tuan=jQuery('#tuan').val();
                var dv=jQuery('#id_loai_danh_muc').val();
                var href='/admin/bao-cao-cong-tac-ho-tro-tuan-word&nam='+nam+'&tuan='+tuan+'&dv='+dv;
                window.open(href, '_blank');
            });


        });

    </script>
@endsection

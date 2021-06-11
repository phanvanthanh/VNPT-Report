@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>THÊM CÔNG VIỆC</h5></div>
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

            <form id="frm_lanh_dao_tao_cong_viec" name="frm_lanh_dao_tao_cong_viec"  enctype="multipart/form-data">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        


                        <label for="ten_cong_viec">Tên công việc <span class="text-danger">*</span></label>
                        <input class="form-control ten-cong-viec" type="Text" name="ten_cong_viec" id="ten_cong_viec" value="">
                        <input type="hidden" name="id_loai_xu_ly" id="id_loai_xu_ly" value="1">


                        <label for="noi_dung_cong_viec">Nội dung công việc <span class="text-danger"></span></label>
                        <textarea rows="5" class="form-control noi-dung-cong-viec" name="noi_dung_cong_viec" id="noi_dung_cong_viec"></textarea>
                        <div class="form-group d-none">
                            <label for="id_loai_danh_muc">Dịch vụ<span class="text-danger"></span></label>
                            <select class="form-control select2 muc-do" name="id_loai_danh_muc" id="id_loai_danh_muc">
                                @foreach($loaiDanhMucs as $loaiDanhMuc)
                                <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                                @endforeach
                                
                            </select>                            
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-md-4 giz-upload">
                        <input class="form-control ma-cong-viec" type="hidden" name="ma_cong_viec" id="ma_cong_viec" value="">

                        <label for="tai_lieu_cong_viec">Tài liệu đính kèm <span class="text-danger"></span></label>
                        <input class="form-control tai-lieu-cong-viec" type="file" name="tai_lieu_cong_viec[]" id="tai_lieu_cong_viec" multiple>
                        <span class="element-to-paste-filename"></span>

                        <div class="form-group">
                            <label for="id_muc_do_cong_viec">Mức độ<span class="text-danger"></span></label>
                            <select class="form-control select2 muc-do" name="id_muc_do_cong_viec" id="id_muc_do_cong_viec">
                                @foreach($mucDos as $mucDo)
                                <option value="{{$mucDo['id']}}">{{$mucDo['ten_muc_do']}}</option>
                                @endforeach
                                
                            </select>                            
                        </div>
                        
                        <label for="ghi_chu_cong_viec">Ghi chú<span class="text-danger"></span></label>
                        <input class="form-control ghi-chu-cong-viec" type="Text" name="ghi_chu_cong_viec" id="ghi_chu_cong_viec" value="">

                        
                    </div>
                    
                    <div class="col-xs-12 col-md-3">
                        <label for="btnTao" style="color: white;"> Thêm mới<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button>
                    </div>
                    
                        
                </div>
            </form>
            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>






    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var _token=jQuery('form[name="frm_lanh_dao_tao_cong_viec"]').find("input[name='_token']").val();
            
            


            $('.btnThemMoi').on('click',function(){
                var tenCongViec=jQuery('#ten_cong_viec').val();
                if(tenCongViec==''){
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
                var form = $("form#frm_lanh_dao_tao_cong_viec");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('taoCongViecV2') }}",
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
                            window.location.href = "/admin/lanh-dao-giao-cong-viec-v2";
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

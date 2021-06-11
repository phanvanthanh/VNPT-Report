@extends('layouts.template.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>ỨNG DỤNG TIẾP NHẬN - GIAO VIỆC NHANH</h5></div>
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

            <form id="frmDmLoi" name="frmDmLoi">
                {{ csrf_field() }}
            
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <label for="id_loai_danh_muc">Dịch vụ<span class="text-danger"></span></label>
                        <select class="form-control select2" name="id_loai_danh_muc" id="id_loai_danh_muc">
                            <option value="">Chọn dịch vụ</option>
                            <optgroup label="">
                                @foreach($loaiDanhMucs as $loaiDanhMuc)
                                    <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                                @endforeach
                            </optgroup>
                            
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <div class="form-group">
                            

                            <label for="ten_dm_loi">Nhập lỗi cần tìm<span class="text-danger">*</span></label>
                            <input class="form-control" type="Text" name="ten_dm_loi" id="ten_dm_loi" value="">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-md-3">
                        <label for="btnTao" style="color: white;"> Tìm kiếm<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-success waves-effect waves-light btnTimKiem"><i class="fa fa-search"></i>Tìm kiếm</button> 

                        <a href="/export-loai-danh-muc-to-excel/12/11" class="btn btn-success waves-effect waves-light"><i class="fa fa-search"></i>Xuất excel</a> 
                    </div>
                </div>
            </form>
            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row d-none">
    <div class="col-lg-12 col-xs-12">
        <div class="card-box table-responsive tblDmLoi">
            <table id="datatable-buttons" class="table table-striped table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên lỗi</th>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center" style="white-space:nowrap;">Tài liệu hướng dẫn</th>
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
            var _token=jQuery('form[name="frmDmLoi"]').find("input[name='_token']").val();
            load(null, null,_token);
            function load(tenDmLoi=null, idDichVu=null,_token){
                
                var xhr1;   
                var url="{{ route('loadDmLoiPublic') }}";
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
                        "ten_dm_loi":tenDmLoi,
                        "id_loai_danh_muc":idDichVu,
                    },
                    error:function(){
                    },
                    success:function(data){
                        $('.tblDmLoi').empty();
                        jQuery('.tblDmLoi').html(data.html);
                    },
                });
            }

            
            jQuery('.btnTimKiem').on('click', function(){
                var _token=jQuery('form[name="frmDmLoi"]').find("input[name='_token']").val();
                var tenDmLoi=jQuery('#ten_dm_loi').val();
                var idDichVu=jQuery('#id_loai_danh_muc').val();
                console.log(tenDmLoi);
                console.log(idDichVu);
                load(tenDmLoi, idDichVu,_token);
            });



            
        });



    </script>
@endsection
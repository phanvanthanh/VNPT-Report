@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<form id="frm_lanh_dao_giao_cong_viec" name="frm_lanh_dao_giao_cong_viec"  enctype="multipart/form-data">
                {{ csrf_field() }}
</form>                
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>GIAO CÔNG VIỆC</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row add-form">    
    <div class="col-lg-12">
        <div class="card-box table-responsive tb-ds-cong-viec">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Mã công việc</th>
                        <th class="text-center">Tên công việc</th>
                        <th class="text-center">Tài liệu</th>
                        <th class="text-center">Hạn xử lý</th>
                        <!-- <th class="text-center">Tình trạng</th> -->
                        <th class="text-center">Xử lý</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
    <!-- <div class="col-lg-4 jq-cay-xu-ly-cong-viec">
        <div class="card-box text-center">
            <h5>QUÁ TRÌNH XỬ LÝ</h5>
        </div>
    </div> -->
</div>






    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var _token=jQuery('form[name="frm_lanh_dao_giao_cong_viec"]').find("input[name='_token']").val();
            loadDsCongViecCanGiaoV2(_token);


            function loadDsCongViecCanGiaoV2(_token){                
                var xhr1;   
                var url="{{ route('loadDsCongViecCanGiaoV2') }}";
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
                        jQuery('.jq-cay-xu-ly-cong-viec').html('<div class="card-box text-center"><h5>QUÁ TRÌNH XỬ LÝ</h5></div>');
                        $('.tb-ds-cong-viec').empty();
                        jQuery('.tb-ds-cong-viec').html(data.html);
                    },
                });
            }

            
            

        });







   


    </script>
@endsection

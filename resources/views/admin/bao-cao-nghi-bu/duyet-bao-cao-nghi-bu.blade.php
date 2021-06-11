@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>DUYỆT BÁO CÁO NGHỈ BÙ</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row d-none">    
    <div class="col-lg-12">
        <div class="card-box">
            <p class="text-muted font-14 m-b-20">
            </p>

            <form id="frmBaoCaoNghiBu" name="frmBaoCaoNghiBu">
                {{ csrf_field() }}
            </form>
            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="card-box table-responsive tblDanhSachBaoCaoNghiBu">
            <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Người yêu cầu</th>
                        
                        <th class="text-center">Nội dung</th>
                        <th class="text-center">Yêu cầu</th>
                        <th class="text-center">Lý do</th>

                        <th class="text-center">Người duyệt</th>
                        <th class="text-center">Duyệt (Giờ)</th>

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
            var _token=jQuery('form[name="frmBaoCaoNghiBu"]').find("input[name='_token']").val();
            load(_token);

            function load(_token){
                
                var xhr1;   
                var url="{{ route('loadDuyetBaoCaoNghiBu') }}";
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
                        $('.tblDanhSachBaoCaoNghiBu').empty();
                        jQuery('.tblDanhSachBaoCaoNghiBu').html(data.html);
                    },
                });
            }
        });

    </script>
@endsection

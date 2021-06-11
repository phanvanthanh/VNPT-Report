@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>CẬP NHẬT ĐƠN VỊ CHO NHÂN VIÊN</h5></div>
                <div class="col-lg-6 float-right text-right">
                    <form id="frmPhanDonViChoUser" name="frmPhanDonViChoUser">
                        {{ csrf_field() }}
                    </form>
                    <button type="button" class="btn btn-gradient waves-effect waves-light btnCapNhat"><i class="dripicons-document-edit"></i>Cập nhật</button>
                    <input type="hidden" name="idUsers" id="idUsers">
                    <input type="hidden" name="idDonVi" id="idDonVi">
                </div>

            </div>
                
        </div>
    </div>
        
</div>
<div class="row">    
    <div class="col-sm-12 col-lg-6">
        <div class="card-box table-responsive tblUsers">
            <table class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"><input type="checkbox" name=""></th>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên nhân viên</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card-box table-responsive tblDonVi">
            
        </div>
    </div>

    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        
    </div>
</div>







    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var _token=jQuery('form[name="frmPhanDonViChoUser"]').find("input[name='_token']").val();
            loadUser(_token);
            loadDonVi(_token);
            function loadUser(_token){
                jQuery('#idUsers').val('');
                var xhr1;   
                var url="{{ route('loadUserChuaPhanDonVi') }}";
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
                        $('.tblUsers').empty();
                        jQuery('.tblUsers').html(data.html);
                    },
                });
            }

            function loadDonVi(_token){
                jQuery('#idDonVi').val('');
                var xhr1;   
                var url="{{ route('loadDmDonViCanPhan') }}";
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
                        $('.tblDonVi').empty();
                        jQuery('.tblDonVi').html(data.html);
                    },
                });
            }

            function capNhatPhanDonViChoCanBo(idUsers, idDonVi, _token){
                if(idUsers=='' || idDonVi==''){
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
                var url="{{ route('capNhatPhanDonViChoCanBo') }}";
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
                        "id_users":idUsers,
                        "id_don_vi":idDonVi,
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
                            loadUser(_token);
                            loadDonVi(_token);
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
            jQuery('.btnCapNhat').on('click', function(){
                var _token=jQuery('form[name="frmPhanDonViChoUser"]').find("input[name='_token']").val();
                var idUsers=jQuery('#idUsers').val();
                var idDonVi=jQuery('#idDonVi').val();
                capNhatPhanDonViChoCanBo(idUsers, idDonVi, _token);
            });







            
        });



    </script>
@endsection

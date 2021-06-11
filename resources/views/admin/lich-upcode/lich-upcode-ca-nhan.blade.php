@extends('layouts.template.index')

@section('content')
<?php    
    $idDonViGoc=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>LỊCH THAM GIA UPCODE</h5></div>
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

            <form id="frmLichUpcodeCaNhan" name="frmLichUpcodeCaNhan">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <label for="tuan">Tuần <span class="text-danger">*</span></label>
                        <input class="form-control" type="Number" name="tuan" id="tuan" value="{{$tuan}}">
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <label for="nam">Năm <span class="text-danger">*</span></label>
                        <input class="form-control" type="Number" name="nam" id="nam" value="{{$nam}}">
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <label for="btnXemLich" style="color: white;"> Xem<span class="text-danger"></span></label><br>
                        <button type="button" class="btn btn-success waves-effect waves-light btnXemLich"><i class="mdi mdi-library-plus"></i>Xem lịch</button>
                    </div>
                </div>
            </form>
            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="card-box table-responsive tblLichUpcodeCaNhan">
            <table id="datatable-buttons3" class="table table-bordered datatable-buttons3" cellspacing="0" width="100%">'
                <thead>
                    <tr>
                        <th class="text-center" style="width: 150px;">Thứ (Ngày)</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Nội dung chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <b>Thứ 2</b> <br>
                        </td>
                        <td class="text-center d-none"></td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>







    <!--Wysiwig js-->
    

    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            load();
            function load(){                
                var tuan=jQuery('#tuan').val();
                var nam=jQuery('#nam').val();
                if(tuan=='' || nam==''){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Vui lòng kiểm tra lại dữ liệu nhập.',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
                }
                var form = $("form#frmLichUpcodeCaNhan");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('loadLichUpcodeCaNhan') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    error:function(){
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Vui lòng kiểm tra lại dữ liệu nhập.',
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                        return false;
                    },
                    success:function(data){
                        $('.tblLichUpcodeCaNhan').empty();
                        jQuery('.tblLichUpcodeCaNhan').html(data.html);
                    },
                });
            }


            jQuery('.btnXemLich').on('click',function(){
                load();
            });
        });

    </script>
@endsection

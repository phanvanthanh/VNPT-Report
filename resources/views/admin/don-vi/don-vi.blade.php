@extends('layouts.template.index')

@section('content')
<?php    
    $donVis2=array();
    $roleId=Auth::user()->role_id;
    $idDonVi=Auth::user()->id_don_vi;
    if($roleId==1){
        $donVis2=\Helper::tableListDonVi($donVis,null);
    }
    else{
        $donVis2=\Helper::tableListDonViById($donVis,$idDonVi);
    }
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>QUẢN LÝ ĐƠN VỊ</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row d-none add-form">    
    <div class="col-lg-12">
        <div class="card-box">
            <p class="text-muted font-14 m-b-20">
            </p>

            <form role="form" method="POST" name="themDonVi" id="themDonVi" action="{{ route('themDonVi') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="ten_don_vi">Tên đơn vị<span class="text-danger">*</span></label>
                            <input type="text" name="ten_don_vi" parsley-trigger="change" required
                                   placeholder="Nhập tên đơn vị" class="form-control" id="ten_don_vi">
                            @if ($errors->has('ten_don_vi'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('ten_don_vi') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                             <label for="di_dong">Chọn đơn vị cha<span class="text-danger"></span></label>
                            <select class="form-control select2" name="parent">
                                <option>Chọn đơn vị cha</option>
                                <optgroup label="">
                                    @foreach($donVis2 as $donVi)
                                      <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                                    @endforeach
                                </optgroup>
                                
                            </select>
                        </div>

                        
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="dia_chi">Địa chỉ<span class="text-danger"></span></label>
                            <input type="text" name="dia_chi" parsley-trigger="change"
                                   placeholder="Nhập địa chỉ" class="form-control" id="dia_chi">
                            @if ($errors->has('dia_chi'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('dia_chi') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email đơn vị<span class="text-danger"></span></label>
                            <input id="email" type="email" placeholder="Nhập email"
                                   class="form-control" name="email">
                            @if ($errors->has('email'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        

                        
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="co_dinh">Điện thoại cố định<span class="text-danger"></span></label>
                            <input type="text" name="co_dinh" parsley-trigger="change" 
                                   placeholder="Nhập số điện thoại" class="form-control" id="co_dinh">
                            @if ($errors->has('co_dinh'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('co_dinh') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fax">Số FAX<span class="text-danger"></span></label>
                            <input type="text" name="fax" parsley-trigger="change"
                                   placeholder="Nhập số điện thoại" class="form-control" id="fax">
                            @if ($errors->has('fax'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('fax') }}
                                </div>
                            @endif
                        </div>

                        

                        
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="di_dong">Điện thoại di động<span class="text-danger"></span></label>
                            <input type="text" name="di_dong" parsley-trigger="change" 
                                   placeholder="Nhập số điện thoại" class="form-control" id="di_dong">
                            @if ($errors->has('di_dong'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('di_dong') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group m-b-0">
                            
                            <label for="btnThemMoi" style="color: white;"> Thêm mới<span class="text-danger"></span></label><br>
                            <button type="submit" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button> 
                            <button type="reset" class="btn btn-light waves-effect waves-light btnReset" id="btnReset"><i class="dripicons-document-edit"></i>Reset</button>
                        </div>
                    </div>
                </div>
                        

            </form>
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="d-none text-center">ID</th>
                        <th class="text-center">Tên đơn vị</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">Điện thoại cố định</th>
                        <th class="text-center">Điện thoại</th>
                        <th class="text-center">Số FAX</th>
                        <th class="text-center">Trạng Thái</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>


                <tbody>
                <?php                     
                    
                    foreach ($donVis2 as $key => $donVi2) {
                    ?>
                        <tr>
                            <td class="d-none"><?php echo $key; ?><span class="id"><?php echo $donVi2['id']; ?></span></td>
                            <td class="name">
                                <?php 
                                    $pre='';
                                    for ($i=0; $i < $donVi2['level']; $i++) { 
                                        $pre.='<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;';
                                    }
                                    echo $pre.$donVi2['ten_don_vi']; 
                                ?>                                    
                            </td>
                            <td><?php echo $donVi2['dia_chi']; ?></td>
                            <td><?php echo $donVi2['co_dinh']; ?></td>
                            <td><?php echo $donVi2['di_dong']; ?></td>
                            <td><?php echo $donVi2['fax']; ?></td>
                            <td class="text-center">

                            <?php
                                $state='<span class="badge badge-success">Hoạt động</span>';
                                if($donVi2['state']==0){
                                    $state='<span class="badge badge-danger">Đóng</span>';
                                }
                                echo $state;
                            ?>
                            </td>
                            <td class="text-center">
                              <button type="button" class="btn btn-outline-primary suaDonVi" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="dripicons-document-edit"></i></button>
                            </td>
                            <td class="text-center">
                              <form method="POST" action="/admin/xoa-don-vi/<?php echo $donVi2['id']; ?>" accept-charset="UTF-8" class="delete-<?php echo $donVi2['id']; ?> frmDelete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="button" data="delete-<?php echo $donVi2['id']; ?>" class="btn btn-danger sa-warning btnDelete" ><i class="dripicons-document-delete"></i></button>
                              </form>
                            </td>
                        </tr> 
                    <?php
                    }
                ?>
                
                </tbody>
            </table>
        </div>
    </div>
</div>



    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('suaDonVi') }}">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myLargeModalLabel">CHỈNH SỬA THÔNG TIN ĐƠN VỊ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="ten_don_vi">Tên đơn vị<span class="text-danger">*</span></label>
                                <input type="hidden" name="id" id="_id" value="">
                                <input type="text" name="ten_don_vi" parsley-trigger="change" required
                                       placeholder="Nhập tên đơn vị" class="form-control" id="_ten_don_vi">
                                @if ($errors->has('ten_don_vi'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('ten_don_vi') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                 <label for="_parent">Chọn đơn vị cha<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="parent" id="_parent">
                                    <option value="">Chọn đơn vị cha</option>
                                    @foreach($donVis2 as $donVi)
                                      <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dia_chi">Địa chỉ<span class="text-danger"></span></label>
                                <input type="text" name="dia_chi" parsley-trigger="change"
                                       placeholder="Nhập địa chỉ" class="form-control" id="_dia_chi">
                                @if ($errors->has('dia_chi'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('dia_chi') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email đơn vị<span class="text-danger"></span></label>
                                <input id="_email" type="email" placeholder="Nhập email"
                                       class="form-control" name="email">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="co_dinh">Điện thoại cố định<span class="text-danger"></span></label>
                                <input type="text" name="co_dinh" parsley-trigger="change" 
                                       placeholder="Nhập số điện thoại" class="form-control" id="_co_dinh">
                                @if ($errors->has('co_dinh'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('co_dinh') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="fax">Số FAX<span class="text-danger"></span></label>
                                <input type="text" name="fax" parsley-trigger="change"
                                       placeholder="Nhập số điện thoại" class="form-control" id="_fax">
                                @if ($errors->has('fax'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('fax') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="di_dong">Điện thoại di động<span class="text-danger"></span></label>
                                <input type="text" name="di_dong" parsley-trigger="change" 
                                       placeholder="Nhập số điện thoại" class="form-control" id="_di_dong">
                                @if ($errors->has('di_dong'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('di_dong') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                 <label for="state">Trạng thái<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="state" id="_state">
                                    <option>Chọn trạng thái</option>
                                    <optgroup label="">
                                        <option value="0">Đóng</option>
                                        <option value="1">Mở</option>
                                    </optgroup>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                            

                            
                    
                </div>
                <div class="modal-footer">
                    <div class="form-group text-right m-b-0">
                        <button type="submit" class="btn btn-primary waves-light waves-effect w-md">Lưu Lại</button>
                        <button type="button" class="btn btn-light waves-effect w-md"  data-dismiss="modal" aria-hidden="true">Hủy</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->





    <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.suaDonVi').on('click',function(){
                jQuery('#id').val();
                var id=jQuery(this).closest('tr').find('.id').text().trim();
                var xhr1;   
                var url="{{ route('getThongTinDonVi') }}";
                var _token=jQuery('form[name="themDonVi"]').find("input[name='_token']").val();
                
                if(xhr1 && xhr1.readyState != 4){
                    xhr1.abort(); //huy lenh ajax truoc do
                }

                xhr1 = jQuery.ajax({
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
                            jQuery('#_id').val(data.id);
                                jQuery('#_ten_don_vi').val(data.ten_don_vi);
                                jQuery('#_di_dong').val(data.di_dong);
                                jQuery('#_email').val(data.email);
                                jQuery('#_dia_chi').val(data.dia_chi);
                                jQuery('#_co_dinh').val(data.co_dinh);
                                jQuery('#_fax').val(data.fax);


                                jQuery('#_parent').val(data.parent);                                
                                //jQuery('#select2-_parent-container').text(data.parent_name);
                                $("#_parent > option").each(function() {
                                    console.log(this.value);
                                    if(this.value==data.parent){
                                      jQuery('#select2-_parent-container').text(this.text);
                                    }
                                });
                                

                                jQuery('#_state').val(data.state);
                                var state='Mở';
                                if(data.state==0){
                                    state='Đóng';
                                }
                                jQuery('#select2-_state-container').text(state);
                        }
                    },

                });
                
            });


            jQuery('.btnDelete').on('click',function(){
                var data=jQuery(this).attr('data');
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
                    jQuery('.'+data).submit()
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
            
        });

    </script>
@endsection

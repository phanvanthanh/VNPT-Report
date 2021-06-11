@extends('layouts.template.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>QUẢN LÝ NHÓM QUYỀN NGƯỜI DÙNG</h5></div>
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

            <form class="form-horizontal" role="form" method="POST" id="taoNhomQuyen" name="taoNhomQuyen" action="{{ route('taoNhomQuyen') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="role_name">Tên nhóm quyền<span class="text-danger">*</span></label>
                            <input type="text" name="role_name" parsley-trigger="change" required
                                   placeholder="Nhập họ và tên" class="form-control" id="role_name">
                            @if ($errors->has('role_name'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('role_name') }}
                                </div>
                            @endif
                        </div> 
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <div class="form-group">
                            <label for="id_don_vi">Chọn đơn vị<span class="text-danger"></span></label>
                            <select class="form-control select2" name="id_don_vi" id="id_don_vi" required>
                                <option value="">Chọn đơn vị</option>
                                <optgroup label="">
                                    @foreach($donVis as $donVi)
                                      <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                                    @endforeach
                                </optgroup>
                                
                            </select>
                        </div> 
                    </div>
                    <div class="col-sm-12 col-md-3">
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
                        <th class="none text-center">STT</th>
                        <th class="text-center">Tên Nhóm</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>


                <tbody>
                <?php $stt=0;?>
                @foreach($roles as $role)
                <?php $stt++; ?>
                    <tr>
                        <td class="stt"><span class="d-none id"><?php echo $role->id; ?></span><?php echo $stt; ?></td>
                        <td class="role_name name"><?php echo $role->role_name; ?></td>
                        <td class="text-center">
                            <?php
                              $state='<span class="badge badge-success">Kích hoạt</span>';
                              if($role->state==0){
                                  $state='<span class="badge badge-danger">Đóng</span>';
                              }
                              echo $state;
                            ?>
                            <span class="d-none state"><?php echo $role->state; ?></span>
                            </td>
                        <td class="text-center">
                          <button type="button" class="btn btn-gradient waves-effect waves-light suaNhomQuyen" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="dripicons-document-edit"></i></button>
                        </td>
                        <td class="text-center">
                          {!! Form::open(array('route'=>array('xoaNhomQuyen',$role->id),'method'=>'DELETE','class'=>'frmDelete frmDelete'.$role->id)) !!}
                            <button type="button" class="btn btn-danger btnDelete" data="{{$role->id}}"><i class="dripicons-document-delete"></i></button>
                          {!! Form::close() !!}
                        </td>
                    </tr> 
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>



                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('suaNhomQuyen') }}">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h5 class="modal-title" id="myLargeModalLabel">SỬA NHÓM QUYỀN</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="_id" value="{{ old('id') }}" required>
                                            <label for="_role_name">Tên nhóm quyền<span class="text-danger">*</span></label>
                                            <input type="text" name="role_name" parsley-trigger="change" required
                                                   placeholder="Nhập họ và tên" class="form-control" id="_role_name">
                                            @if ($errors->has('role_name'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ $errors->first('role_name') }}
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


                jQuery('.suaNhomQuyen').on('click',function(){
                    // get thông tin nhóm quyền gắng lên  
                    jQuery('#id').val();
                    var id=jQuery(this).closest('tr').find('.id').text().trim();
                    var xhr1;   
                    var url="{{ route('getThongTinNhomQuyen') }}";
                    var _token=jQuery('form[name="taoNhomQuyen"]').find("input[name='_token']").val();
                    console.log(_token);
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
                                jQuery('#_role_name').val(data.role_name);                                

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
                    var id=jQuery(this).attr('data');
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
                        jQuery('.frmDelete'+id).submit()
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

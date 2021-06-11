@extends('layouts.template.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>TÀI KHOẢN NGƯỜI DÙNG</h5></div>
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
                <form role="form" method="POST" name="taoNhanVien" id="taoNhanVien" action="{{ route('taoNhanVien') }}" class=" d-none add-form">
                    {{ csrf_field() }}
                    <div class="row">  
                    
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="name">Họ Và Tên<span class="text-danger">*</span></label>
                                <input type="text" name="name" parsley-trigger="change" required
                                       placeholder="Nhập họ và tên" class="form-control" id="name">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="di_dong">Điện thoại di động<span class="text-danger">*</span></label>
                                <input type="text" name="di_dong" parsley-trigger="change" required
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
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="email">Email address<span class="text-danger">*</span></label>
                                <input type="text" name="email" parsley-trigger="change" required
                                       placeholder="Nhập email" class="form-control" id="email">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="di_dong">Chọn nhóm quyền<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="role_id" required>
                                    <option value="">Chọn nhóm quyền</option>
                                    <optgroup label="">
                                        @foreach($roles as $role)
                                          <option value="{{$role['id']}}">{{$role['role_name']}}</option>
                                        @endforeach
                                    </optgroup>                        
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="pass1">Password<span class="text-danger">*</span></label>
                                <input id="pass1" type="password" placeholder="Nhập mật khẩu" required
                                       class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="id_don_vi">Chọn đơn vị<span class="text-danger"></span></label>
                                <select class="form-control select2" name="id_don_vi" id="id_don_vi">
                                    <option>Chọn đơn vị</option>
                                    <optgroup label="">
                                        @foreach($donVis as $donVi)
                                          <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                                        @endforeach
                                    </optgroup>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <label for="id_chuc_danh">Chức danh<span class="text-danger"></span></label>

                            <select class="form-control select2" name="id_chuc_danh" id="id_chuc_danh">
                                @foreach($chucDanhs as $chucDanh)
                                  <option value="{{$chucDanh['id']}}">{{$chucDanh['ten_chuc_danh']}}</option>
                                @endforeach
                            </select>
                            <div class="form-group m-b-0  text-right">
                                <label for="btnThemMoi" style="color: white;"> Thêm mới<span class="text-danger"></span></label><br>
                                <button type="submit" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button>
                                <br><br>    
                                
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="d-none text-center">ID</th>
                        <th class="text-center">Tên nhân viên</th>
                        <th class="text-center">Tên đăng nhập</th>
                        <th class="text-center">Di động</th>
                        <th class="text-center">Nhóm quyền</th>
                        <th class="text-center">Đơn vị</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>


                <tbody>
                <?php $stt=0; ?>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center"><?php $stt++; echo $stt; ?></td>
                        <td class="id d-none"><?php echo $user['id']; ?></td>
                        <td class="name"><?php echo $user['name']; ?></td>
                        <td class="email"><?php echo $user['email']; ?></td>
                        <td class="di_dong"><?php echo $user['di_dong']; ?></td>
                        <td class="role_name"><?php echo $user['role_name']; ?></td>
                        <td class="ten_don_vi"><?php echo $user['ten_don_vi']; ?></td>
                        <td class="text-center">
                        <?php
                            $state='<span class="badge badge-success">Mở</span>';
                            if($user['state']==0){
                                $state='<span class="badge badge-danger">Đóng</span>';
                            }
                            echo $state;
                        ?>
                        </td>
                        <td class="text-center">
                          <button type="button" class="btn btn-gradient waves-effect waves-light suaNhanVien" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="dripicons-document-edit"></i></button>
                        </td>
                        <td class="text-center">
                            <?php $class="frmDelete frmDelete-".$user['id']; ?>
                          {!! Form::open(array('route'=>array('xoaNhanVien',$user['id']),'method'=>'DELETE','class'=>$class)) !!}
                            <button type="button" class="btn btn-danger btnDelete" data="{{$user['id']}}"><i class="dripicons-document-delete"></i></button>
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
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('suaNhanVien') }}">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h5 class="modal-title" id="myLargeModalLabel">SỬA THÔNG TIN NGƯỜI DÙNG</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id" value="{{ old('id') }}" required>
                                                    <label for="_name">Họ Và Tên<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" parsley-trigger="change" required
                                                           placeholder="Nhập họ và tên" class="form-control" id="_name">
                                                    @if ($errors->has('name'))
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="_email">Email address<span class="text-danger">*</span></label>
                                                    <input type="text" name="email" parsley-trigger="change" required
                                                           placeholder="Nhập email" class="form-control" id="_email">
                                                    @if ($errors->has('email'))
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="_password">Password</label>
                                                    <input id="_password" type="password" placeholder="Nhập mật khẩu"
                                                           class="form-control" name="password">
                                                    @if ($errors->has('password'))
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                     <label for="_state">Trạng thái<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="state" id="_state">
                                                        <option value="">Chọn trạng thái</option>
                                                        <optgroup label="">
                                                            <option value="0">Đóng</option>
                                                            <option value="1">Mở</option>
                                                        </optgroup>
                                                        
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="_di_dong">Điện thoại di động<span class="text-danger">*</span></label>
                                                    <input type="text" name="di_dong" parsley-trigger="change" required
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
                                                     <label for="di_dong">Chọn nhóm quyền<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="role_id" id="_role_id" required>
                                                        <option value="">Chọn nhóm quyền</option>
                                                        <optgroup label="">
                                                            @foreach($roles as $role)
                                                              <option value="{{$role['id']}}">{{$role['role_name']}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="_id_don_vi">Chọn đơn vị<span class="text-danger"></span></label>
                                                    <select class="form-control select2" name="id_don_vi" id="_id_don_vi">
                                                        <option>Chọn đơn vị</option>
                                                        <optgroup label="">
                                                            @foreach($donVis as $donVi)
                                                              <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                                                            @endforeach
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
                jQuery('.suaNhanVien').on('click',function(){
                    jQuery('#id').val();
                    var id=jQuery(this).closest('tr').find('.id').text().trim();
                    console.log(id);
                    var xhr1;   
                    var url="{{ route('getThongTinNhanVien') }}";
                    var _token=jQuery('form[name="taoNhanVien"]').find("input[name='_token']").val();
                    
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
                            console.log('click');
                        },
                        success:function(data){
                            console.log(data);
                            if(data.error==0){
                                jQuery('#id').val(data.id);
                                jQuery('#_name').val(data.name);
                                jQuery('#_di_dong').val(data.di_dong);
                                jQuery('#_email').val(data.email);
                                jQuery('#_role_id').val(data.role_id);
                                jQuery('#_id_don_vi').val(data.id_don_vi);
                                jQuery('#select2-_role_id-container').text(data.role_name);
                                jQuery('#select2-_id_don_vi-container').text(data.ten_don_vi);

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

                    var tenClass='frmDelete-'+jQuery(this).attr('data');
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
                        jQuery('.'+tenClass).submit()
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

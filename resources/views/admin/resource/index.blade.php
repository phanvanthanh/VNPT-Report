@extends('layouts.template.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>QUẢN LÝ TÀI NGUYÊN</h5></div>
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

            <form class="form-horizontal" role="form" method="POST" action="{{ route('resource.store') }}">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-sm-12 col-md-8">
                    <input type="hidden" name="id" value="" id="id" required>
                    <div class="form-group">
                        <label for="ten_hien_thi">Tên hiển thị<span class="text-danger">*</span></label>
                        <input type="text" name="ten_hien_thi" parsley-trigger="change" required
                               placeholder="Nhập họ và tên" class="form-control" id="ten_hien_thi" value="{{ old('ten_hien_thi') }}">
                        @if ($errors->has('ten_hien_thi'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $errors->first('ten_hien_thi') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="show_menu" type="checkbox" name="show_menu" value="">
                        <label for="show_menu">Hiển thị menu</label>
                        @if ($errors->has('show_menu'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $errors->first('show_menu') }}
                            </div>
                        @endif
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                    <div class="form-group m-b-0">
                      <label for="btnThemMoi" style="color: white;"> Lưu lại<span class="text-danger"></span></label><br>
                      <a href="/admin/resource/create" class="btn btn-danger waves-light waves-effect w-md">
                            Dò các chức năng
                      </a>
                      <button type="submit" class="btn btn-primary waves-light waves-effect w-md">Lưu Lại</button>
                      <button type="reset" class="btn btn-light waves-effect w-md">Hủy</button>
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
                      <th class="text-center">STT</th>
                      <th class="text-center d-none">ID</th>
                      <th class="text-center">Tên hiển thị</th>
                      <th class="text-center d-none">resource</th>
                      <th class="text-center ">method</th>
                      <th class="text-center d-none">action</th>
                      <th class="text-center d-none">parameter</th>
                      <th class="text-center d-none">Parameter value</th>
                      <th class="text-center">status</th>
                      <th class="text-center d-none">parent</th>
                      <th class="text-center">uri</th>
                      <th class="text-center">Hiển thị trên menu</th>
                      <th class="text-center">Sửa</th>
                      <!-- <th class="text-center">Xóa</th> -->
                    </tr>
                </thead>


                <tbody>
                  <?php $stt=0; ?>
                @foreach($resources as $resource)
                  <tr>
                    <td class="text-center"><?php $stt++; echo $stt; ?></td>
                    <td class="id d-none">{{$resource->id}}</td>
                    <td class="ten_hien_thi name">{{$resource->ten_hien_thi}}</td>
                    <td class="resource d-none">{{$resource->resource}}</td>
                    <td class="method">{{$resource->method}}</td>
                    <td class="action d-none">{{$resource->action}}</td>
                    <td class="parameter d-none">{{$resource->parameter}}</td>
                    <td class="parameter_value d-none">{{$resource->parameter_value}}</td>
                    <td class="status">{{$resource->status}}</td>
                    <td class="parent d-none">{{$resource->parent_id}}</td>
                    <td class="uri">{{$resource->uri}}</td>
                    <td class="text-center">
                    <?php
                      $state='<span class="badge badge-success">Hiển thị menu</span>';
                      if($resource->show_menu==0){
                          $state='<span class="badge badge-danger">Ko hiển thị</span>';
                      }
                      echo $state;
                    ?>
                    <span class="d-none show_menu"><?php echo $resource->show_menu; ?></span>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-gradient waves-effect waves-light suaResource"><i class="dripicons-document-edit"></i></button>
                    </td>
                    <!-- <td class="text-center">
                      <button type="button" class="btn btn-danger xoaResource"><i class="dripicons-document-delete"></i></button>
                    </td> -->
                  </tr> 
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>




        <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
              jQuery('.suaResource').on('click',function(){
                jQuery('.add-form').removeClass('d-none');
                var id=jQuery(this).closest('tr').find('.id').text().trim();
                var ten_hien_thi=jQuery(this).closest('tr').find('.ten_hien_thi').text().trim();
                var show_menu=jQuery(this).closest('tr').find('.show_menu').text().trim();
                jQuery('#id').val(id);
                jQuery('#ten_hien_thi').val(ten_hien_thi);
                if(show_menu==1){
                  jQuery('#show_menu').prop('value','1');  
                  jQuery('#show_menu').prop('checked',true);  
                }
                else
                {
                  jQuery('#show_menu').prop('value',0);  
                  jQuery('#show_menu').prop('checked',false);  
                }
              });
              jQuery('#show_menu').on('change',function(){
                if(jQuery(this).prop('checked')==false){
                  jQuery(this).prop('value',0);
                }
                else{
                  jQuery(this).prop('value',1);
                }
              });

              jQuery('.xoaResource').on('click',function(){
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
                        swal('Chức năng đang được cập nhật.<br>Vui lòng thử lại sau!').catch(swal.noop)
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

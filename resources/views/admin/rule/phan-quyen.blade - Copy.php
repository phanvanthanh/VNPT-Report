@extends('layouts.template.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>PHÂN QUYỀN NGƯỜI DÙNG</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>                
        </div>
    </div>
        
</div>
<form class="form-horizontal" role="form" method="POST" name="frmPhanQuyen" action="{{ route('phanQuyen') }}">
                        {{ csrf_field() }}
<div class="row add-form">    
    <div class="col-lg-12">
        <div class="card-box">
            <p class="text-muted font-14 m-b-20">
            </p>
            <div class="row">
                <div class="col-sm-12 col-md-9">
                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <label for="role_id" class="control-label">Tên nhóm quyền</label>

                        <div class="form-group">                                
                            <select class="form-control select2" name="role_id" id="role_id" value="{{ old('id') }}" required autofocus width="100%">
                                <option value="">Chọn nhóm quyền</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('role_id'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('role_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group m-b-0">
                        <label for="btnThemMoi" style="color: white;"> Lưu lại<span class="text-danger"></span></label><br>
                        <button type="submit" class="btn btn-primary waves-light waves-effect w-md">Lưu Lại</button>
                        <button type="reset" class="btn btn-light waves-effect w-md">Hủy</button>
                    </div>
                </div>
            </div>
                    

                    

            
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box table-responsive">
            <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Danh mục chức năng</li>
                            <?php 
                                foreach ($adminResources as $key => $item) {
                                    if($item->parent_id==1){
                                        echo '
                                            <li>
                                                <a href="#"> <input type="checkbox" class="resource" name="resource_id[]" id="resource_id_{{ $res->id }}" value="{{ $res->id }}"> '.$item->icon.' <span> '.$item->ten_hien_thi.' </span> <span class="menu-arrow"></span></a>';
                                                    \Helper::rightMenu($adminResources,$item->id);
                                        echo '</li>';
                                    }
                                }
                            ?>
                            
                        </ul>

                    </div>
            <table id="_datatable-buttons" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"><input type="checkbox" name="checkAll" id="checkAll"></th>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên quyền</th>
                        <th class="text-center">Hiển thị menu</th>
                    </tr>
                </thead>


                <tbody>
                    
                <!-- <?php
                    $resourceObj=\Helper::treeQuyenObj($resource,1);
                ?>
                @foreach($resourceObj as $key => $res)
                    @if($res->show_menu==1)
                    <tr>
                        <td  class="text-center">
                            <input type="checkbox" class="resource" name="resource_id[]" id="resource_id_{{ $res->id }}" value="{{ $res->id }}">
                        </td>
                        <td  class="text-center">{{$key++}}</td>
                        <td class="name">@for($i=0; $i<$res->level; $i++)
                                {{'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'}}
                            @endfor{{ $res->ten_hien_thi }}</td>
                        <td class="show_menu text-center">
                        <?php
                          $state='<span class="badge badge-success">Hiển thị menu</span>';
                          if($res->show_menu==0){
                              $state='<span class="badge badge-danger">Ko hiển thị</span>';
                          }
                          echo $state;
                        ?>
                        </td>
                    </tr>
                    @endif
                @endforeach -->
                
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>



                        

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery('#role_id').on('change',function(){
            jQuery(".resource").prop('checked',false);
            var xhr1;   
            var url="{{ route('danhSachQuyen') }}";
            var _token=$('form[name="frmPhanQuyen"]').find("input[name='_token']").val();
            var role_id=$('#role_id').val();
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
                    "role_id":role_id,
                },
                error:function(){
                },
                success:function(data){
                    jQuery.each( data, function( key, value){
                        var resource_id='#resource_id_'+value.resource_id;
                        jQuery(resource_id).prop('checked', true);
                    });
                },

            });
        });
        fChecked=function(checked){
            
            if(checked){
                jQuery('.resource').prop('checked',true);
            }
            else{
                jQuery('.resource').prop('checked',false);
            }
        }
        jQuery('#checkAll').on('click', function(){
            var checked=jQuery('#checkAll').is(':checked');
            fChecked(checked);
        });
        
    });

</script>
@endsection

@extends('layouts.template.ajaxIndex')

@section('content')
<?php
    $idUser=Auth::user()->id;
    $nameOfUser=Auth::user()->name;
?>
<table id="datatable-buttons3" class="table table-bordered datatable-buttons3" cellspacing="0" width="100%" style="margin-top: 0px;">
    <thead>
        <tr>
            <th class="text-center" style="width: 150px;">Thứ (Ngày)</th>
            <th class="text-center">Nội dung chi tiết</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b class="text-info">Thứ 2</b> <br>
                ({{$ret['Thứ 2']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu2s as $ctThu2s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu2s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");
                        $ngay=date_format($date,"d-m-Y"); // ngày là ngày bắt đầu dự kiến

                        $date=date_create($ctThu2s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu2s[0]['thoi_gian_ket_thuc_du_kien']);
                        

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu2s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu2s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu2s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu2s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu2s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian:  <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu2s[0]['name']}}</i>

                    </div>

                    <!-- Nếu muốn hiển thị ra chi tiết luôn thì mở ra form này là được  -->
                    <!-- 
                        <table style="width: 100%;"  class="text-left">
                            <tr class="chi-tiet-lich-upcode" id-lich-upcode="{{$ctThu2s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                                <td><b style="color: green;">{{$stt}}. {{$ctThu2s[0]['ten_lich_upcode']}} </b> <b style="color: red;"> {{$batDau}} - {{$ketThuc}}</b></td>
                                <td style="width: 15%; color: green;" class="text-center"><b>Ghi chú</b></td>
                                <td style="width: 15%; color: green;" class="text-center"><b>Tình trạng</b></td>
                            </tr>
                            <?php $stt2=0; ?>
                            @foreach($ctThu2s as $ctThu2) 
                                <?php $stt2++; ?>                   
                                <tr class="chi-tiet-lich-upcode" id-lich-upcode="{{$ctThu2s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                                    <td class="name">{{$stt2}}. {{$ctThu2['ten_dm_loi']}}</td>
                                    <td>{{$ctThu2['ghi_chu']}}</td>
                                    <td class="text-center">
                                        @if($ctThu2['tinh_trang']==0)
                                            <span class="badge badge-warning">Chưa hoàn thành</span>
                                        @endif
                                        @if($ctThu2['tinh_trang']==1)
                                            <span class="badge badge-success">Hoàn thành</span>   
                                        @endif
                                        @if($ctThu2['tinh_trang']==2)
                                            <span class="badge badge-danger">Lỗi phát sinh (Lỗi cũ)</span>
                                        @endif
                                        @if($ctThu2['tinh_trang']==3)
                                            <span class="badge badge-danger">Lỗi phát sinh (Lỗi mới)</span>
                                        @endif
                                    </td>
                                </tr>      
                            @endforeach              
                        </table> 
                    -->
                    @endforeach
                </div>
            </td>
        </tr>


        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b class="text-info">Thứ 3</b> <br>
                ({{$ret['Thứ 3']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu3s as $ctThu3s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu3s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");

                        $date=date_create($ctThu3s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu3s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ngay=date_format($date,"d-m-Y");

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu3s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu3s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu3s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }


                        
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu3s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu3s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian: <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu3s[0]['name']}}</i>

                    </div>                
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b  class="text-info">Thứ 4</b> <br>
                ({{$ret['Thứ 4']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu4s as $ctThu4s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu4s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");

                        $date=date_create($ctThu4s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu4s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ngay=date_format($date,"d-m-Y");

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu4s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu4s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu4s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }


                        
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu4s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu4s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian: <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu4s[0]['name']}}</i>

                    </div>                
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b class="text-info">Thứ 5</b> <br>
                ({{$ret['Thứ 5']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu5s as $ctThu5s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu5s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");

                        $date=date_create($ctThu5s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu5s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ngay=date_format($date,"d-m-Y");

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu5s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu5s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu5s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }


                        
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu5s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu5s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian: <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu5s[0]['name']}}</i>

                    </div>                
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b class="text-info">Thứ 6</b> <br>
                ({{$ret['Thứ 6']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu6s as $ctThu6s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu6s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");

                        $date=date_create($ctThu6s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu6s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ngay=date_format($date,"d-m-Y");

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu6s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu6s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu6s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }


                        
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu6s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu6s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian: <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu6s[0]['name']}}</i>

                    </div>                
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b>Thứ 7</b> <br>
                ({{$ret['Thứ 7']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu7s as $ctThu7s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu7s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");

                        $date=date_create($ctThu7s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu7s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ngay=date_format($date,"d-m-Y");

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu7s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu7s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu7s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }


                        
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu7s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu7s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian: <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu7s[0]['name']}}</i>

                    </div>                
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td class="text-center" style="vertical-align: middle;">
                <b>Chủ nhật</b> <br>
                ({{$ret['Thứ 8']}})
            </td>
            <td class="text-left">
                <div class="row">
                    <?php $stt=0; ?>
                    @foreach($ctUpcodeThu8s as $ctThu8s)
                    <?php
                        $stt++;
                        $date=date_create($ctThu8s[0]['thoi_gian_bat_dau_du_kien']);
                        $batDau=date_format($date,"H:i:s");

                        $date=date_create($ctThu8s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ketThuc=date_format($date,"H:i:s");

                        $date=date_create($ctThu8s[0]['thoi_gian_ket_thuc_du_kien']);
                        $ngay=date_format($date,"d-m-Y");

                        // bắt đầu và kết thúc thực tế
                        $date=date_create($ctThu8s[0]['thoi_gian_bat_dau']);
                        $batDauThucTe=date_format($date,"H:i:s");

                        $date=date_create($ctThu8s[0]['thoi_gian_ket_thuc']);
                        $ketThucThucTe=date_format($date,"H:i:s");
                        $ngayThucTe=date_format($date,"d-m-Y"); // ngày thực tế là ngày kết thúc thực tế
                        
                        $thoiGianThucTe='<b style="color: red;">'.$batDau.' - '.$ketThuc.' (Ngày: '.$ngay.') (Chưa hoàn thành) </b><br>';
                        if($ctThu8s[0]['state']==1){
                            $thoiGianThucTe=$batDauThucTe.' - '.$ketThucThucTe.' (Ngày: '.$ngayThucTe.') <b style="color: blue;">(Đã hoàn thành) </b><br>';
                        }


                        
                    ?>
                    <div class="chi-tiet-lich-upcode col-sm-12 col-md-6" id-lich-upcode="{{$ctThu8s[0]['id_lich_upcode']}}" style="cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-lg">
                        <b style="color: green;">
                            {{$ctThu8s[0]['ten_lich_upcode']}} 
                        </b> 
                        <br>
                        Thời gian: <?php echo $thoiGianThucTe; ?>
                        Tạo bởi: <i>{{$ctThu8s[0]['name']}}</i>

                    </div>                
                    @endforeach
                </div>
            </td>
        </tr>
        
    </tbody>
</table>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" role="form" name="frmChiTietUpcodeCaNhan" id="frmChiTietUpcodeCaNhan">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">CẬP NHẬT CHI TIẾT UPCODE</h5>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            
                            <label for="id_dm_loi">Lỗi/Module/Chức năng <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control select2" name="id_dm_loi" id="id_dm_loi" required>
                                    <option value="">Chọn công việc cần xử lý</option>
                                    @foreach($danhMucLois as $danhMucLoi)
                                        <option value="{{$danhMucLoi['id']}}">{{$danhMucLoi['loai']}} - @if($danhMucLoi['ma_yeu_cau']) ({{$danhMucLoi['ma_yeu_cau']}}) @endif {{$danhMucLoi['ten_dm_loi']}}
                                        </option>
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="tinh_trang">Tình trạng: <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control select2" name="tinh_trang" id="tinh_trang" required>
                                    <option value="0">Chưa hoàn thành</option>                                   
                                    <option value="1">Hoàn thành</option>
                                    <option value="2">Lỗi phát sinh (Lỗi cũ)</option>
                                    <option value="3">Lỗi phát sinh (Lỗi mới)</option>
                                </select>
                            </div>


                            <div class="form-group d-none">
                                <select class="form-control select2" name="id_users" id="id_users" required>
                                    <option value="{{$idUser}}">{{$nameOfUser}}</option>                                
                                </select>

                                <input type="hidden" name="id_lich_upcode" id="id_lich_upcode" value="">
                                <input type="hidden" name="id_chi_tiet_lich_upcode" id="id_chi_tiet_lich_upcode" value="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="id_loai_danh_muc">Ghi chú <span class="text-danger"></span></label>
                            <input class="form-control" type="Text" name="ghi_chu" id="ghi_chu" value="">
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <br>
                            <button type="button" class="btn btn-success waves-effect waves-light btnLuu"><i class="mdi mdi-library-plus"></i></button>
                            <button type="button" class="btn btn-primary waves-effect waves-light btnCapNhat"><i class="dripicons-document-edit"></i></button>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="tblChiTietUpcodeCaNhan">
                                <table id="datatable-buttons" class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">'
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center d-none">ID</th>
                                            <th class="text-center">Tên lỗi/ module/ chức năng</th>
                                            <th class="text-center">Ghi chú</th>
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                
            </div>
            

        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
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
        function loadChiTietUpcodeCaNhan(_token, idLichUpcode){
            var xhr1;   
            var url="{{ route('loadChiTietUpcodeCaNhan') }}";
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
                    "id_lich_upcode": idLichUpcode
                },
                error:function(){
                },
                success:function(data){
                    $('.tblChiTietUpcodeCaNhan').empty();
                    jQuery('.tblChiTietUpcodeCaNhan').html(data.html);
                },
            });
        }

        jQuery('.chi-tiet-lich-upcode').on('click',function(){
            var _token=jQuery('form[name="frmChiTietUpcodeCaNhan"]').find("input[name='_token']").val();
            var idLichUpcode=jQuery(this).attr('id-lich-upcode');
            jQuery('#id_lich_upcode').val(idLichUpcode);
            loadChiTietUpcodeCaNhan(_token, idLichUpcode);
        });


        $('.btnLuu').on('click',function(){
                jQuery('#id_chi_tiet_lich_upcode').val('');
                var idDmLoi=jQuery('#id_dm_loi').val();
                var tinhTrang=jQuery('#tinh_trang').val();
                var idUser=jQuery('#id_users').val();
                if(idUser=='' || tinhTrang=='' || idDmLoi==''){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Vui lòng kiểm tra lại dữ liệu.',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
                }
                var form = $("form#frmChiTietUpcodeCaNhan");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('themChiTietUpcodeCaNhan') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    error:function(){
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Vui lòng kiểm tra lại dữ liệu.',
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                        return false;
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
                            var _token=jQuery('form[name="frmChiTietUpcodeCaNhan"]').find("input[name='_token']").val();
                            var idLichUpcode=jQuery('#id_lich_upcode').val();
                            loadChiTietUpcodeCaNhan(_token, idLichUpcode);

                        }
                        else{
                            $.toast({
                                heading: 'Lỗi!',
                                text: data.error,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 1
                            });
                        }
                    },
                });
        });

        $('.btnCapNhat').on('click',function(){
                var idDmLoi=jQuery('#id_dm_loi').val();
                var tinhTrang=jQuery('#tinh_trang').val();
                var idUser=jQuery('#id_users').val();
                if(idUser=='' || tinhTrang=='' || idDmLoi==''){
                    $.toast({
                        heading: 'Lỗi!',
                        text: 'Vui lòng kiểm tra lại dữ liệu.',
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 1
                    });
                    return false;
                }
                var form = $("form#frmChiTietUpcodeCaNhan");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('suaChiTietUpcodeCaNhanById') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    error:function(){
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Vui lòng kiểm tra lại dữ liệu.',
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                        return false;
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
                            var _token=jQuery('form[name="frmChiTietUpcodeCaNhan"]').find("input[name='_token']").val();
                            var idLichUpcode=jQuery('#id_lich_upcode').val();
                            
                            loadChiTietUpcodeCaNhan(_token, idLichUpcode);
                        }
                        else{
                            $.toast({
                                heading: 'Lỗi!',
                                text: data.error,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 1
                            });
                        }
                    },
                });
        });

        
        $.fn.dataTable.ext.errMode = 'none';
        $('#datatable-buttons').dataTable( {
          "searching": false,
          "paging":false,
        });

    });



</script>
@endsection
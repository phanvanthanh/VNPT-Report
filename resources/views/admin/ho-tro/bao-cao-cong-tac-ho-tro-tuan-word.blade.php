@extends('layouts.template.index')
@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-6"><h5>BÁO CÁO CÔNG TÁC HỖ TRỢ (THEO TUẦN)</h5></div>
                    <div class="col-lg-6 float-right text-right"><a href="#" class="btn btn-success waves-effect waves-light  w-md btnXuatBaoCaoCongTacHoTroTuanWord"><i class="fa fa-floppy-o"></i> Xuất URD Word</a></div>
                </div>
                    
            </div>
        </div>
            
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box page-content" style="color: black; ">
                <div style="text-align:center; font-size: 17px;">
                    <p style="line-height: 25px;"><b>
                        KẾ HOẠCH TUẦN {{$tuan}}_{{$nam}} VNPT.  TVH  <br>
                    (Từ ngày {{$baoCaoTuNgay}} đến {{$baoCaoDenNgay}}) <br>
                    
                    </b></p>
                </div>
                <div style="text-align:left; font-size: 17px;">
                    <p style="line-height: 25px;">
                        <b>
                        3. Triển khai phần mềm <br>
                        * {{$tenLoaiDanhMuc}}
                        </b> <br>
                        @foreach($data as $d)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;– {{$d->ten_dm_loi}} <br>
                        @endforeach
                    </p>

                    <p style="line-height: 25px;">
                        <b>
                        4. Kế hoạch tuần tiếp theo <br>
                        * {{$tenLoaiDanhMuc}}
                        </b> <br>
                        @foreach($data_2 as $d)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;– {{$d->ten_dm_loi}} <br>
                        @endforeach
                    </p>
                </div>

            </div>
        </div>
    </div>



<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        //$('li.tree-show').css('display','block');
        $('.btnXuatBaoCaoCongTacHoTroTuanWord').on('click',function(){
            $(".page-content").wordExport('BaoCaoTuan');            
        });
    });

</script>
@endsection

@extends('layouts.template.ajaxIndex')
@section('content')
<div class="">
    <div class="timeline">
        <?php 
            $arrTrangThaiXuLy=array(
                '0'=>'Chưa xem',
                '1'=>'Đã xem',
                '2'=>'Đã xử lý'
            ); 
            $stt=0; $soLuongDsXuLy=count($dsXuLys)-1; ?>
            @if($dsXuLys[0]->id_loai_xu_ly!=6 && $dsXuLys[0]->id_loai_xu_ly!=8 && $dsXuLys[0]->id_loai_xu_ly!=9)

                <article class="first timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                <h7 class="text-success">
                                <?php echo '<b>'.date('d-m-Y H:i:s').'</b>'; ?>
                                </h7><br>
                                <small>
                                    <b>Xử lý:</b>  {{$dsXuLys[0]->ten_buoc_ke}}<br> 
                                    <b>Trạng thái: </b>
                                    <?php 
                                        $trangThaiXuLy=$dsXuLys[0]->trang_thai_xu_ly;
                                        echo $arrTrangThaiXuLy[$trangThaiXuLy];
                                    ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </article>

            @else
                <article class="first timeline-item alt">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                <h7 class="text-success">                                    
                                    <b>Kết thúc quy trình</b> 
                                    <?php
                                        $checkHanXuLy=\Helper::checkHanXuLy($dsXuLys[0]->ngay_gio_xu_ly, $dsXuLys[0]->han_xu_ly_cong_viec);
                                        echo $checkHanXuLy['is_dung_han'];
                                    ?> 
                                </h7><br>
                            </div>
                        </div>
                    </div>
                </article>
            @endif

        @foreach($dsXuLys as $xuLy)
            @if($xuLy->id_loai_xu_ly!=7)
                @if($stt%2!=0)

                    <article class="timeline-item alt">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="timeline-box">
                                    <span class="arrow-alt"></span>
                                    <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                    <h7 class="text-success">
                                        <?php
                                            $date = new DateTime($xuLy->ngay_gio_xu_ly);
                                            echo '<b>'.$date->format('d-m-Y H:i:s').'</b>';
                                        ?>
                                    </h7>
                                    <small>
                                        <b>Thực hiện: </b><a href="#">{{$xuLy->name}}</a><br>
                                        <b>Xử lý:</b> {{$xuLy->ten_loai_xu_ly}} <br> 
                                        <b>Nội dung:</b> {{$xuLy->noi_dung_xu_ly}} <br>
                                        <b>Tài liệu: </b><br>
                                        <?php
                                            if($xuLy->file_xu_ly!=''){
                                                $taiLieus=explode(';', $xuLy->file_xu_ly);
                                                $stt2=0;
                                                foreach ($taiLieus as $key => $taiLieu) {
                                                    $stt2++;
                                                    if($stt2<count($taiLieus)){
                                                        $checkDinhdang=explode('.', $taiLieu);
                                                        $viTri=count($checkDinhdang)-1;
                                                        if($checkDinhdang[$viTri]=='pdf' || $checkDinhdang[$viTri]=='jpg' || $checkDinhdang[$viTri]=='png'){
                                                            echo '<i class="dripicons-preview"></i>';
                                                        }else{
                                                            echo '<i class="dripicons-download"></i>';
                                                        }
                                                    ?>
                                                        <a target="_blank" href="/admin/dowload-tai-lieu-cong-viec-v2/{{$xuLy->id_cong_viec}}/{{$stt2}}">File số {{$stt2}}</a><br>
                                                    <?php
                                                    }
                                                }
                                            }
                                                
                                        ?>
                                        <b>Trạng thái: </b>
                                        <?php
                                            if($stt<$soLuongDsXuLy){
                                                $trangThaiXuLy=$dsXuLys[$stt+1]->trang_thai_xu_ly;
                                                echo $arrTrangThaiXuLy[$trangThaiXuLy];
                                            }elseif($stt==$soLuongDsXuLy){
                                                echo 'Đã xử lý';
                                            }
                                        ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </article>
                @else
                    <article class="timeline-item">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="timeline-box">
                                    <span class="arrow"></span>
                                    <span class="timeline-icon bg-success"><i class="mdi mdi-adjust"></i></span>
                                    <h7 class="text-success">
                                        <?php
                                            $date = new DateTime($xuLy->ngay_gio_xu_ly);
                                            echo '<b>'.$date->format('d-m-Y H:i:s').'</b>';
                                        ?>
                                    </h7>
                                    <small><b>Thực hiện: </b><a href="#">{{$xuLy->name}}</a><br>
                                        <b>Xử lý:</b> {{$xuLy->ten_loai_xu_ly}} <br> 
                                        <b>Nội dung:</b> {{$xuLy->noi_dung_xu_ly}} <br>
                                        <b>Tài liệu: </b><br>
                                        <?php
                                            if($xuLy->file_xu_ly!=''){
                                                $taiLieus=explode(';', $xuLy->file_xu_ly);
                                                $stt2=0;
                                                foreach ($taiLieus as $key => $taiLieu) {
                                                    $stt2++;
                                                    if($stt2<count($taiLieus)){
                                                        $checkDinhdang=explode('.', $taiLieu);
                                                        $viTri=count($checkDinhdang)-1;
                                                        if($checkDinhdang[$viTri]=='pdf' || $checkDinhdang[$viTri]=='jpg' || $checkDinhdang[$viTri]=='png'){
                                                            echo '<i class="dripicons-preview"></i>';
                                                        }else{
                                                            echo '<i class="dripicons-download"></i>';
                                                        }
                                                    ?>
                                                        <a target="_blank" href="/admin/dowload-tai-lieu-cong-viec-v2/{{$xuLy->id_cong_viec}}/{{$stt2}}">File số {{$stt2}}</a><br>
                                                    <?php
                                                    }
                                                }
                                            }
                                        ?>
                                        <b>Trạng thái: </b>
                                        <?php
                                            if($stt<$soLuongDsXuLy){
                                                $trangThaiXuLy=$dsXuLys[$stt+1]->trang_thai_xu_ly;
                                                echo $arrTrangThaiXuLy[$trangThaiXuLy];
                                            }elseif($stt==$soLuongDsXuLy){
                                                echo 'Đã xử lý';
                                            }
                                        ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </article>
                @endif
                <?php $stt++; ?>
            @endif

        @endforeach

    </div>
    <!-- end timeline -->
</div>









    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        
        
    });



</script>
@endsection
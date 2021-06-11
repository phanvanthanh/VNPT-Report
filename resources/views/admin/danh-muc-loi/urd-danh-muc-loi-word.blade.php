@extends('layouts.template.index')
@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
    if($danhMucLoi){
?>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-6"><h5>CHI TIẾT DANH MỤC LỖI</h5></div>
                    <div class="col-lg-6 float-right text-right"><a href="#" class="btn btn-success waves-effect waves-light  w-md btnXuatUrdDanhMucLoiWord"><i class="fa fa-floppy-o"></i> Xuất URD Word</a></div>
                </div>
                    
            </div>
        </div>
            
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="https://cntt.vnpt.vn/servicedesk/customer/portal/124/<?php echo $danhMucLoi['ma_yeu_cau']; ?>"><b style="color: black;">Liên kết IT360:</b> <?php echo $danhMucLoi['ma_yeu_cau']; ?></a>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card-box page-content" style="color: black; margin-top: 2px;">
                        <div style="text-align:center; font-size: 26px;">
                            <img  src="{{ asset('storage/app/public/img/img-system/urd-logo-vnpt.png') }}"> <br><br><br>
                            <p><b>
                                HỆ THỐNG PHẦN MỀM <br>
                                <?php echo $danhMucLoi['ten_loai_danh_muc']; ?> <br><br><br><br><br>



                                ĐẶC TẢ YÊU CẦU NGƯỜI SỬ DỤNG <br><br><br><br><br>



                                Mã dự án :PM2_<?php echo $danhMucLoi['ten_loai_danh_muc']; ?>  <br>
                                Mã tài liệu :PM2_<?php echo $danhMucLoi['ten_loai_danh_muc']; ?> _URD <br>
                                Phiên bản : 1.0 <br>
                                MODULE: <?php echo $danhMucLoi['ten_dm_loi']; ?>  <br><br><br><br><br><br>

                            </b></p>
                        </div>
                        <?php echo $danhMucLoi['mo_ta']; ?>
                        <?php echo $danhMucLoi['yeu_cau']; ?>

                    </div>
                </div>
                <div class="col-md-4 card-box" style="margin-top: 2px;">
                    <b style="color: black;">TÀI LIỆU HƯỚNG DẪN XỬ LÝ LỖI</b><br><br>
                    @if($danhMucLoi['cach_khac_phuc']!='')
                        <?php echo $danhMucLoi['cach_khac_phuc']; ?>
                    @endif
                </div>
            </div>
                    
        </div>
    </div>
<?php }else{ ?>
    <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <span><img src="assets/images/logo_dark.png" alt="" height="18"></span>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="account-content text-center">
                                        <h1 class="text-error">THÔNG BÁO</h1>
                                        <h4 class="text-uppercase text-danger mt-3">KHÔNG TÌM THẤY DANH MỤC</h4>
                                        <p class="text-muted mt-3">Xin lỗi hệ thống không tim thấy danh mục mà bạn đã yêu cầu. <br>
                                            Anh chị vui lòng kiểm tra lại danh mục của mình nhé!
                                        </p>

                                        <a class="btn btn-md btn-block btn-gradient waves-effect waves-light mt-3" href="/admin/danh-muc-loi"> Trở về</a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
<?php } ?>



<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        //$('li.tree-show').css('display','block');
        $('.btnXuatUrdDanhMucLoiWord').on('click',function(){
            $(".page-content").wordExport('URD');            
        });
    });

</script>
@endsection

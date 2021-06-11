@extends('layouts.template.index')

@section('content')
<?php    
    $idDonVi=Auth::user()->id_don_vi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>DANH MỤC LỖI</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row @if (!$errors->any()) d-none @endif add-form">    
    <div class="col-lg-12">
            <form role="form" method="POST" name="themDanhMucLoi" id="themDanhMucLoi" action="{{ route('themDanhMucLoi') }} " enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                      <div class="card-box">
                        <div class="form-group mo_ta">
                            <label for="mo_ta">Mô tả<span class="text-danger"></span></label>
                            <div class="summernote">



                              <h1 style="text-indent: -6px; text-align: center;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>LỊCH SỬ THAY ĐỔI</b></font></span>&nbsp;</h1>


                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">
                               <tbody><tr>
                                <td width="43" style="width:32.05pt;border:solid windowtext 1.0pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><b><font face="Times New Roman">ID<o:p></o:p></font></b></p>
                                </td>
                                <td width="90" style="width:67.85pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><b><font face="Times New Roman">Phiên bản<o:p></o:p></font></b></p>
                                </td>
                                <td width="138" style="width:103.5pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><b><font face="Times New Roman">Người thực hiện<o:p></o:p></font></b></p>
                                </td>
                                <td width="150" style="width:112.5pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><b><font face="Times New Roman">Người phê duyệt<o:p></o:p></font></b></p>
                                </td>
                                <td width="126" style="width:94.5pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><b><font face="Times New Roman">Ngày hiệu lực<o:p></o:p></font></b></p>
                                </td>
                                <td width="176" style="width:131.7pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><b><font face="Times New Roman">Nội dung thay đổi<o:p></o:p></font></b></p>
                                </td>
                               </tr>
                               <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes;height:23.35pt">
                                <td width="43" style="width:32.05pt;border:solid windowtext 1.0pt;border-top:
                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt;height:23.35pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">1<o:p></o:p></font></span></p>
                                </td>
                                <td width="90" style="width:67.85pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">V1.0<o:p></o:p></font></span></p>
                                </td>
                                <td width="138" style="width:103.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>
                                </td>
                                <td width="150" style="width:112.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>
                                </td>
                                <td width="126" style="width:94.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">
                                <p class="MsoNormal" align="center" style="margin-left:9.0pt;text-align:center;
                                text-indent:-4.5pt"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>
                                </td>
                                <td width="176" style="width:131.7pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:23.35pt">
                                <p class="MsoNormal"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><font face="Times New Roman">&nbsp;Chỉnh sửa chức năng<o:p></o:p></font></span></p>
                                <p class="MsoNormal"><span style="font-size:11.0pt;mso-bidi-font-size:12.0pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></span></p>
                                </td>
                               </tr>
                              </tbody></table>

                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>1. Chức năng cụ thể</b></font></span>&nbsp;</h1>
                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" style="border: none;" width="700">
                               <tbody><tr>
                                <td width="51" valign="top" style="width:38.0pt;border:solid windowtext 1.0pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">STT<o:p></o:p></font></b></p>
                                </td>
                                <td width="117" valign="top" style="width:87.75pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mã chức năng<o:p></o:p></font></b></p>
                                </td>
                                <td width="273" valign="top" style="width:204.65pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tên chức năng<o:p></o:p></font></b></p>
                                </td>
                                <td width="153" valign="top" style="width:114.5pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Đối tượng liên quan<o:p></o:p></font></b></p>
                                </td>
                                <td width="74" valign="top" style="width:55.75pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mức độ ưu tiên<o:p></o:p></font></b></p>
                                </td>
                               </tr>
                               <tr>
                                <td width="51" valign="top" style="width:38.0pt;border:solid windowtext 1.0pt;
                                border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">1<o:p></o:p></font></p>
                                </td>
                                <td width="117" valign="top" style="width:87.75pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:
                                6.0pt;margin-left:0in"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>
                                </td>
                                <td width="273" valign="top" style="width:204.65pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                                </td>
                                <td width="153" valign="top" style="width:114.5pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:
                                6.0pt;margin-left:0in"><font face="Times New Roman">Nhân&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; viên<span lang="FR"><o:p></o:p></span></font></p>
                                </td>
                                <td width="74" valign="top" style="width:55.75pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:
                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><font face="Times New Roman">Trung bình<o:p></o:p></font></p>
                                </td>
                               </tr>
                              </tbody></table>
                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>2. Đối tượng người dùng của hệ thống</b></font></span>&nbsp;</h1>


                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">
                               <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:21.75pt">
                                <td width="45" rowspan="2" valign="top" style="width:33.75pt;border:solid windowtext 1.0pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">TT<o:p></o:p></font></b></p>
                                </td>
                                <td width="130" rowspan="2" valign="top" style="width:97.65pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tên đối tượng<o:p></o:p></font></b></p>
                                </td>
                                <td width="154" rowspan="2" valign="top" style="width:115.55pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Mô tả<o:p></o:p></font></b></p>
                                </td>
                                <td width="239" colspan="2" valign="top" style="width:179.4pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Tương tác với hệ&nbsp; thống<o:p></o:p></font></b></p>
                                </td>
                                <td width="123" rowspan="2" valign="top" style="width:92.25pt;border:solid windowtext 1.0pt;
                                border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.75pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Lợi ích mong đợi<o:p></o:p></font></b></p>
                                </td>
                               </tr>
                               <tr style="mso-yfti-irow:1;height:21.1pt">
                                <td width="128" valign="top" style="width:95.95pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.1pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Vào<o:p></o:p></font></b></p>
                                </td>
                                <td width="111" valign="top" style="width:83.45pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:21.1pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><b><font face="Times New Roman">Ra<o:p></o:p></font></b></p>
                                </td>
                               </tr>
                               <tr>
                                <td width="45" valign="top" style="width:33.75pt;border:solid windowtext 1.0pt;
                                border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">1<o:p></o:p></font></p>
                                </td>
                                <td width="130" valign="top" style="width:97.65pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" align="center" style="margin-top:6.0pt;margin-right:0in;
                                margin-bottom:6.0pt;margin-left:9.0pt;text-align:center;text-indent:-4.5pt"><font face="Times New Roman">Nhân
                                viên<o:p></o:p></font></p>
                                </td>
                                <td width="154" valign="top" style="width:115.55pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal"><br></p>
                                </td>
                                <td width="128" valign="top" style="width:95.95pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:
                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>
                                </td>
                                <td width="111" valign="top" style="width:83.45pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:
                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>
                                </td>
                                <td width="123" valign="top" style="width:92.25pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="margin-top:6.0pt;margin-right:0in;margin-bottom:
                                6.0pt;margin-left:9.0pt;text-indent:-4.5pt"><o:p><font face="Times New Roman">&nbsp;</font></o:p></p>
                                </td>
                               </tr>
                              </tbody></table>

                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>3. Quy trình nghiệp vu</b></font></span>&nbsp;</h1>

                              <table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" width="700" style="border: none;">
                               <tbody><tr>
                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">STT<o:p></o:p></font></b></p>
                                </td>
                                <td width="81" style="width:61.0pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">Mã bước<o:p></o:p></font></b></p>
                                </td>
                                <td width="162" style="width:121.5pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="line-height:150%"><b><span style="font-size:13.0pt;line-height:150%"><font face="Times New Roman">Tên bước<o:p></o:p></font></span></b></p>
                                </td>
                                <td width="378" style="width:283.5pt;border:solid windowtext 1.0pt;border-left:
                                none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="line-height:150%"><b><font face="Times New Roman">Mô tả<o:p></o:p></font></b></p>
                                </td>
                               </tr>
                               <tr>
                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:
                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">1<o:p></o:p></font></p>
                                </td>
                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:
                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.01<o:p></o:p></font></p>
                                </td>
                                <td width="162" valign="top" style="width:121.5pt;border-top:none;border-left:
                                none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                <p class="MsoNormal"><br></p></td><td width="378" style="width:283.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                                </td>
                               </tr>
                               <tr style="mso-yfti-irow:2;height:20.7pt">
                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:
                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">2<o:p></o:p></font></p>
                                </td>
                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:
                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.02<o:p></o:p></font></p>
                                </td>
                                <td width="162" style="width:121.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><br></p>
                                </td>
                                <td width="378" style="width:283.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><br></p>
                                </td>
                               </tr>
                               <tr style="mso-yfti-irow:3;mso-yfti-lastrow:yes;height:20.7pt">
                                <td width="45" style="width:33.5pt;border:solid windowtext 1.0pt;border-top:
                                none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
                                padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">3<o:p></o:p></font></p>
                                </td>
                                <td width="81" style="width:61.0pt;border-top:none;border-left:none;border-bottom:
                                solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
                                solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
                                solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><font face="Times New Roman">B.03<o:p></o:p></font></p>
                                </td>
                                <td width="162" style="width:121.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                <p class="MsoNormal" style="line-height:150%"><br></p></td><td width="378" style="width:283.5pt;border-top:none;border-left:none;
                                border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                                mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
                                mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:20.7pt">
                                </td>
                               </tr>
                              </tbody></table>
                              <h1 style="text-indent: -6px; text-align: left;"><span style="font-size: 16pt;"><font face="Times New Roman"><b>4. Yêu cầu</b></font></span>&nbsp;</h1>

                            </div>
                            <textarea class="d-none" name="mo_ta" placeholder="Nhập yêu cầu" id="mo_ta"></textarea>
                        </div>
                        <div class="form-group cach_khac_phuc">
                            <label for="cach_khac_phuc">Hướng dẫn xử lý<span class="text-danger"></span></label>
                            <div class="summernote">
                                <table class="table table-bordered"><tbody><tr><td width="100px" style="text-align: center;"><b>Tên bước</b></td><td style="text-align: center;"><b>Cách xử lý</b></td></tr><tr><td>Bước 1:&nbsp;</td><td><br></td></tr><tr><td>Bước 2:&nbsp;</td><td><br></td></tr><tr><td>Bước 3:&nbsp;</td><td><br></td></tr><tr><td>Bước 4:&nbsp;</td><td><br></td></tr></tbody></table>
                            </div>
                            <textarea class="d-none" name="cach_khac_phuc" placeholder="Nhập yêu cầu" id="cach_khac_phuc"></textarea>
                        </div>
                        <div class="form-group yeu_cau">
                            <label for="yeu_cau">Yêu cầu<span class="text-danger"></span></label>
                            <div class="summernote">
                               
                            </div>
                            <textarea class="d-none" name="yeu_cau" placeholder="Nhập yêu cầu" id="yeu_cau"></textarea>
                        </div>
                      </div>  
                    </div>

                    <div class="col-sm-12 col-md-4">
                      <div class="card-box">

                        <div class="form-group">
                            <label for="ten_dm_loi">Tên danh mục lỗi<span class="text-danger">*</span></label>
                            <input type="text" name="ten_dm_loi" parsley-trigger="change" required
                                   placeholder="Nhập tên danh mục" class="form-control" id="ten_dm_loi" value="{{ old('ten_dm_loi') }}">

                            @if ($errors->has('ten_dm_loi'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('ten_dm_loi') }}
                                </div>
                            @endif


                            <input type="hidden" name="id" id="id" value="">
                        </div>

                        <div class="form-group d-none">
                            <label for="link_video_loi">Link video lỗi<span class="text-danger"></span></label>
                            <input type="text" name="link_video_loi" parsley-trigger="change"
                                   placeholder="Nhập Link video lỗi" class="form-control" id="link_video_loi"  value="{{ old('link_video_loi') }}">
                            @if ($errors->has('link_video_loi'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('link_video_loi') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="id_huong_xu_ly">Hướng xử lý<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_huong_xu_ly" id="id_huong_xu_ly" required  value="{{ old('id_huong_xu_ly') }}">
                              <option value="">Chọn hướng xử lý</option>
                              @foreach($huongXuLys as $huongXuLy)
                                <option value="{{$huongXuLy['id']}}">{{$huongXuLy['ten_huong_xu_ly']}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_yeu_cau">Mã liên thông IT360<span class="text-danger"></span></label>
                            <input type="text" name="ma_yeu_cau" parsley-trigger="change"
                                   placeholder="Nhập mã IT360" class="form-control" id="ma_yeu_cau"  value="{{ old('ma_yeu_cau') }}">
                            @if ($errors->has('ma_yeu_cau'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('ma_yeu_cau') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group d-none">
                            <label for="mo_ta">Hình ảnh lỗi<span class="text-danger"></span></label>
                            <input type="file" class="filestyle" data-btnClass="btn-primary" name="hinh_anh[]"  value="{{ old('hinh_anh[]') }}" multiple>
                        </div>
                        <div class="form-group d-none">
                            <label for="mo_ta">File lỗi<span class="text-danger"></span></label>
                            <input type="file"  value="{{ old('file[]') }}" class="filestyle" data-btnClass="btn-primary" name="file[]" multiple>
                        </div>

                        <div class="form-group d-none">
                            <label for="link_video_cach_khac_phuc">Link video cách khắc phục<span class="text-danger"></span></label>
                            <input type="text" name="link_video_cach_khac_phuc" parsley-trigger="change"
                                   placeholder="Nhập Link video cách khắc phục" class="form-control" id="link_video_cach_khac_phuc"  value="{{ old('link_video_cach_khac_phuc') }}">
                            @if ($errors->has('link_video_cach_khac_phuc'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ $errors->first('link_video_cach_khac_phuc') }}
                                </div>
                            @endif
                        </div>


                        
                        <div class="form-group">
                            <label for="id_loai_danh_muc">Loại dịch vụ hỗ trợ<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="id_loai_danh_muc" id="id_loai_danh_muc" required  value="{{ old('id_loai_danh_muc') }}">
                              <option value="">Chọn loại danh mục</option>
                              @foreach($loaiDanhMucs as $loaiDanhMuc)
                                <option value="{{$loaiDanhMuc['id']}}">{{$loaiDanhMuc['ten_loai_danh_muc']}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tree1">Chia sẽ lỗi với các đơn vị sau<span class="text-danger"></span></label>
                            <!-- Tree -->
                            <ul id="tree1">
                                <?php 
                                $shareDonVi='';
                                foreach ($donVis as $key => $donVi) {
                                    if($donVi['id']==$idDonVi){
                                        $shareDonVi.=$donVi['id'].';';
                                    ?>
                                        <li data="{{$donVi['id']}}"><a href="#">{{ $donVi['ten_don_vi'] }}</a>
                                        <?php $shareDonVi.=\Helper::exportTree($donVis,$idDonVi); ?>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>                                           
                            </ul>

                            <input type="hidden" name="ds_don_vi_duoc_chia_se" id="ds-don-vi-duoc-chia-se" value="{{$shareDonVi}}">
                            <input type="hidden" name="ds_tai_khoan_duoc_chia_se" id="ds-tai-khoan-duoc-chia-se" value="">
                            <!-- end tree -->
                        </div>

                        <div class="form-group text-right m-b-0">                            
                            <button type="submit" class="btn btn-success waves-effect waves-light btnThemMoi"><i class="mdi mdi-library-plus"></i>Thêm mới</button>
                            
                            <button type="button" class="btn btn-gradient waves-effect waves-light btnCapNhat"><i class="dripicons-document-edit"></i>Cập nhật</button>
                        </div>
                      </div>
                    </div>
                </div>
                
                        
                

                        

            </form>
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-hover table-bordered table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên danh mục</th>
                        <th class="text-center">Mã IT360</th>
                        <th class="text-center">Tên dịch vụ</th>
                        <th class="text-center">Hướng xử lý</th>
                        <th class="text-center">Tạo bởi</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Xuất URD</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>


                <tbody>
                <?php $stt=0; ?>
                @foreach($danhMucLoi1 as $key => $dm)
                <?php $stt++; ?>
                    <tr>
                        <td class="text-center">{{ $stt }}</td>
                        <td class="text-center d-none"><span class="id d-none">{{ $dm['id'] }}</span></td>
                        <td class="ten-dm-loi name">{{ $dm['ten_dm_loi'] }}</td>
                        <td class="ma_yeu_cau text-center">{{ $dm['ma_yeu_cau'] }}</td>
                        <td class="ten-loai-danh-muc">{{ $dm['ten_loai_danh_muc'] }}</td>
                        <td class="ten-huong-xu-ly">{{ $dm['ten_huong_xu_ly'] }}</td>
                        <td class="tao-boi">Tôi</td>
                        <td class="state text-center">@if($dm['state']==1)<span class="badge badge-success">&nbsp;&nbsp;Mở&nbsp;&nbsp;</span>@else <span class="badge badge-danger">Đóng</span> @endif</td>
                        <td class="text-center">
                            <a href="/admin/urd-danh-muc-loi-word/{{ $dm['id'] }}" class="btn btn-success waves-effect waves-light urdDanhMucLoiWord" target="_blank"><i class="fa fa-floppy-o"></i></a>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-gradient waves-effect waves-light suaDanhMucLoi" data="{{ $dm['id'] }}" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="dripicons-document-edit"></i></button>
                        </td>
                        <td class="text-center">
                            <form method="POST" action="/admin/xoa-danh-muc-loi/{{ $dm['id'] }}" accept-charset="UTF-8" class="delete-{{ $dm['id'] }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="button" data="delete-{{ $dm['id'] }}" class="btn btn-danger btnDelete" ><i class="dripicons-document-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @foreach($danhMucLoi2 as $key => $dm)
                <?php $stt++; ?>
                    <tr>
                        <td class="text-center">{{ $stt }}</td>
                        <td class="text-center d-none"><span class="id d-none">{{ $dm['id'] }}</span></td>
                        <td class="ten-dm-loi name">{{ $dm['ten_dm_loi'] }}</td>
                        <td class="ma_yeu_cau text-center">{{ $dm['ma_yeu_cau'] }}</td>
                        <td class="ten-loai-danh-muc">{{ $dm['ten_loai_danh_muc'] }}</td>
                        <td class="ten-huong-xu-ly">{{ $dm['ten_huong_xu_ly'] }}</td>
                        <td class="tao-boi">{{ $dm['name'] }}</td>
                        <td class="state text-center">@if($dm['state']==1)<span class="badge badge-success">&nbsp;&nbsp;Mở&nbsp;&nbsp;</span>@else <span class="badge badge-danger">Đóng</span> @endif</td>
                        <td class="text-center">
                            <a href="/admin/urd-danh-muc-loi-word/{{ $dm['id'] }}" class="btn btn-success waves-effect waves-light urdDanhMucLoiWord" target="_blank"><i class="fa fa-floppy-o"></i></a>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-gradient waves-effect waves-light suaDanhMucLoi" data="{{ $dm['id'] }}" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="dripicons-document-edit"></i></button>
                        </td>
                        <td class="text-center">
                            <form method="POST" action="/admin/xoa-danh-muc-loi/{{ $dm['id'] }}" accept-charset="UTF-8" class="delete-{{ $dm['id'] }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="button" data="delete-{{ $dm['id'] }}" class="btn btn-danger btnDelete" ><i class="dripicons-document-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>






        <!--Wysiwig js-->
        

        <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                
                function getDanhMucLoiById(id,_token){
                
                  var xhr1;   
                  var url="{{ route('getDanhMucLoiById') }}";
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
                          "id":id,
                      },
                      error:function(){
                      },
                      success:function(data){
                        if(data.error==0){
                          jQuery('.add-form').removeClass('d-none');
                          jQuery('#id').val(data.id);
                          jQuery('#ds_don_vi_duoc_chia_se').val(data.ds_don_vi_duoc_chia_se);
                          jQuery('#ds_tai_khoan_duoc_chia_se').val(data.ds_tai_khoan_duoc_chia_se);
                          
                          jQuery('#link_video_cach_khac_phuc').val(data.link_video_cach_khac_phuc);
                          jQuery('#link_video_loi').val(data.link_video_loi);
                          jQuery('#ma_yeu_cau').val(data.ma_yeu_cau);
                          jQuery('#ten_dm_loi').val(data.ten_dm_loi);

                          jQuery('.yeu_cau').find('.note-editable').html(data.yeu_cau);
                          jQuery('.mo_ta').find('.note-editable').html(data.mo_ta);
                          jQuery('.cach_khac_phuc').find('.note-editable').html(data.cach_khac_phuc);

                          jQuery('#id_huong_xu_ly').val(data.id_huong_xu_ly);
                          jQuery('#id_loai_danh_muc').val(data.id_loai_danh_muc);

                          $("#id_huong_xu_ly > option").each(function() {
                            if(this.value==data.id_huong_xu_ly){
                              jQuery('#select2-id_huong_xu_ly-container').text(this.text);
                            }
                          });

                          $("#id_loai_danh_muc > option").each(function() {
                            if(this.value==data.id_loai_danh_muc){
                              jQuery('#select2-id_loai_danh_muc-container').text(this.text);
                            }
                          });
                        }else{
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
                }

                function suaDanhMucLoi(id,dsDonViDuocChiaSe, dsTaiKhoanDuocChiaSe, linkVideoCachKhacPhuc, linkVideoLoi, maYeuCau, tenDmLoi, yeuCau, moTa, cachKhacPhuc, idHuongXuLy, idLoaiDanhMuc, file, hinhAnh,_token){
                
                  var xhr1;   
                  var url="{{ route('suaDanhMucLoi') }}";
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
                          "id":id,
                          "ds_don_vi_duoc_chia_se":dsDonViDuocChiaSe,
                          "ds_tai_khoan_duoc_chia_se":dsTaiKhoanDuocChiaSe,
                          "link_video_cach_khac_phuc":linkVideoCachKhacPhuc,
                          "link_video_loi":linkVideoLoi,
                          "ma_yeu_cau":maYeuCau,
                          "ten_dm_loi":tenDmLoi,
                          "yeu_cau":yeuCau,
                          "mo_ta":moTa,
                          "cach_khac_phuc":cachKhacPhuc,
                          "id_huong_xu_ly":idHuongXuLy,
                          "id_loai_danh_muc":idLoaiDanhMuc,
                          "file":file,
                          "hinh_anh":hinhAnh,
                      },
                      error:function(){
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
                            location.reload();
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
                }

                jQuery('.suaDanhMucLoi').on('click',function(){
                  var _token=jQuery('form[name="themDanhMucLoi"]').find("input[name='_token']").val();
                  var id=jQuery(this).attr('data').trim();
                  getDanhMucLoiById(id,_token);
                });

                jQuery('.btnCapNhat').on('click',function(){
                  var _token=jQuery('form[name="themDanhMucLoi"]').find("input[name='_token']").val();
                  var id=jQuery('#id').val();
                  var dsDonViDuocChiaSe=jQuery('#ds_don_vi_duoc_chia_se').val();
                  var dsTaiKhoanDuocChiaSe=jQuery('#ds_tai_khoan_duoc_chia_se').val();
                  
                  var linkVideoCachKhacPhuc=jQuery('#link_video_cach_khac_phuc').val();
                  var linkVideoLoi=jQuery('#link_video_loi').val();
                  var maYeuCau=jQuery('#ma_yeu_cau').val();
                  var tenDmLoi=jQuery('#ten_dm_loi').val();

                  var yeuCau=jQuery('.yeu_cau').find('.note-editable').html();
                  var moTa=jQuery('.mo_ta').find('.note-editable').html();
                  var cachKhacPhuc=jQuery('.cach_khac_phuc').find('.note-editable').html();

                  var idHuongXuLy=jQuery('#id_huong_xu_ly').val();
                  var idLoaiDanhMuc=jQuery('#id_loai_danh_muc').val();
                  var file=jQuery('#file').val();
                  var hinhAnh=jQuery('#hinh_anh').val();
                    if(jQuery('#id_huong_xu_ly').val()==1 && cachKhacPhuc=='') // nếu chọn hướng xử lý là cho đơn vị tự xử lý thì phải nhập cách khắc phục vào
                    {   
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Phải nhập hướng dẫn xử lý cho những danh mục thuộc nhóm đơn vị tự xử lý.',
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                        return false;
                    }
                  suaDanhMucLoi(id,dsDonViDuocChiaSe, dsTaiKhoanDuocChiaSe, linkVideoCachKhacPhuc, linkVideoLoi, maYeuCau, tenDmLoi, yeuCau, moTa, cachKhacPhuc, idHuongXuLy, idLoaiDanhMuc, file, hinhAnh,_token);
                  
                });


                jQuery('.btnDelete').on('click',function(){
                    var data=jQuery(this).attr('data');
                    swal('Chức năng đang được cập nhật.<br>Vui lòng thử lại sau!').catch(swal.noop)
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

                jQuery('.btnThemMoi').on('click',function(){
                    var moTa=jQuery('.mo_ta').find('.note-editable').html();
                    jQuery('#mo_ta').val(moTa);

                    var yeuCau=jQuery('.yeu_cau').find('.note-editable').html();
                    jQuery('#yeu_cau').val(yeuCau);

                    var cachKhachPhuc=jQuery('.cach_khac_phuc').find('.note-editable').html();
                    jQuery('#cach_khac_phuc').val(cachKhachPhuc);
                    console.log('Cách khắc phục')
                    if(jQuery('#id_huong_xu_ly').val()==1 && cachKhachPhuc=='') // nếu chọn hướng xử lý là cho đơn vị tự xử lý thì phải nhập cách khắc phục vào
                    {   
                        $.toast({
                            heading: 'Lỗi!',
                            text: 'Phải nhập hướng dẫn xử lý cho những danh mục thuộc nhóm đơn vị tự xử lý.',
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 1
                        });
                        return false;
                    }

                });

                $('.mo_ta > .summernote').summernote({
                    height: 415,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });

                



                
            });











    // tree
    $.fn.extend({
                treed: function (o) {
                  
                  var openedClass = 'mdi mdi-plus-circle';
                  var closedClass = 'mdi mdi-minus-circle';
                  
                  if (typeof o != 'undefined'){
                    if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                    }
                  };
                  
                    //initialize each of the top levels
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this); //li with children ul
                        branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                        branch.addClass('branch');
                        branch.css('cursor','pointer');
                    });

                    tree.find('li').each(function () {
                        var branch = $(this); //li with children ul
                        branch.prepend("<input type='checkbox' checked='checked' class='checkbox'>");
                        branch.on('click', function (e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        branch.children().children().toggle();
                    });
                    //fire event from the dynamically added icon
                  tree.find('.branch .indicator').each(function(){
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                  });
                    //fire event to open branch if the li contains an anchor instead of text
                    tree.find('.branch>a').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                    //fire event to open branch if the li contains a button instead of text
                    tree.find('.branch>button').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });


                }
            });


            //Initialization of treeviews

            $('#tree1').treed();
            //$('li.tree-show').css('display','block');
            $('.checkbox').on('click',function(){
                var shareDonVi=jQuery('#ds-don-vi-duoc-chia-se').val();
                if($(this).prop('checked')==true){
                    $(this).parent().find('input[type="checkbox"]').each(function () {
                        $(this).prop('checked', true);
                        var idDonViShare=$(this).parent('li').attr('data')+';';
                        shareDonVi+=idDonViShare;
                        jQuery('#ds-don-vi-duoc-chia-se').val(shareDonVi);
                    });    
                }else{
                    $(this).parent().find('input[type="checkbox"]').each(function () {
                        $(this).prop('checked', false);
                        var idDonViShare=$(this).parent('li').attr('data')+';';
                        shareDonVi=shareDonVi.replace(idDonViShare,'');
                        jQuery('#ds-don-vi-duoc-chia-se').val(shareDonVi);

                    });
                }
                
            });

        </script>
@endsection

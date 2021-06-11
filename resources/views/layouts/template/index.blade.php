<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ứng dụng Tiếp nhận - Giao việc nhanh</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/template/default/assets/images/favicon.ico') }}">

        <link href="{{ asset('public/template/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css">

        <!-- X Edittable -->
        <link href="{{ asset('public/template/plugins/bootstrap-xeditable/css/bootstrap-editable.css') }}" rel="stylesheet" />

        <link href="{{ asset('public/template/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <!--  -->
        <link href="{{ asset('public/template/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />

        <!-- App css -->
        <link href="{{ asset('public/template/default/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/js/modernizr.min.js') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('public/template/plugins/jquery-toastr/jquery.toast.min.css') }}" rel="stylesheet" />

        <style type="text/css">
            .tree, .tree ul {
                margin:0;
                padding:0;
                list-style:none
            }
            .tree ul {
                margin-left:1em;
                position:relative
            }
            .tree ul ul {
                margin-left:.5em
            }
            .tree ul:before {
                content:"";
                display:block;
                width:0;
                position:absolute;
                top:0;
                bottom:0;
                left:0;
                border-left:1px solid
            }
            .tree li {
                margin:0;
                padding:0 1em;
                line-height:2em;
                color:#369;
                font-weight:700;
                position:relative
            }
            .tree ul li:before {
                content:"";
                display:block;
                width:10px;
                height:0;
                border-top:1px solid;
                margin-top:-1px;
                position:absolute;
                top:1em;
                left:0
            }
            .tree ul li:last-child:before {
                background:white;
                height:auto;
                top:1em;
                bottom:0
            }
            .indicator {
                margin-right:5px;
            }
            .tree li a {
                text-decoration: none;
                color:#369;
            }
            .tree li button, .tree li button:active, .tree li button:focus {
                text-decoration: none;
                color:#369;
                border:none;
                background:transparent;
                margin:0px 0px 0px 0px;
                padding:0px 0px 0px 0px;
                outline: 0;
            }
            .name {
                color:blue;
            }
            .tree li.name {
                color: #797979;
            }

            table.dataTable thead tr{
                background: linear-gradient(to top, #5d6dc3, #3c86d8);
                color: white;
            }
            table.datatable-buttons thead tr{
                background: linear-gradient(to top, #5d6dc3, #3c86d8);
                color: white;
            }

            table thead tr th{
                white-space:nowrap;
            }
            table thead tr{
                background: linear-gradient(to top, #5d6dc3, #3c86d8);
                color: white;
            }

            table.dataTable thead tr th{
                white-space:nowrap;
            }
            table.datatable-buttons thead tr th{
                white-space:nowrap;
            }

            tr.group,
            tr.group:hover {
                background-color: #ddd !important;
            }

            /*Cập nhật ngày 22-08-2019*/

            .add-form{
                margin-top: 0px;
                margin-bottom: 2px;
            }

            .content div:first-child{
                margin-bottom: 1px;
            }

            div#sidebar-menu > ul > li > a{
                font-size: 13px;
            }

            /*div.topbar div.topbar-left{
                background: linear-gradient(88deg, #13b4ca, #18cabe);
            }
            div.topbar nav.navbar-custom{
                background: linear-gradient(88deg, #13b4ca, #18cabe);
            }
            table.dataTable thead tr{
                background: linear-gradient(88deg, #13b4ca, #18cabe);
            }*/



            
            
        </style>

    </head>


    <body style="font-family: Bookman; font-size: 13px;">
    <?php
        $userId = Auth::id();
        $user=array();
        $thoiGianNghiBuConLai=array();
        if($userId){
            $user=\DB::select('select id, name, di_dong, email, hinh_anh from users where id='.$userId);
            $adminResources=\DB::select('
                select
                    adre.id, adre.parent_id, adre.ten_hien_thi, adre.uri, adre.icon
                from users as u
                left join admin_rule as adru on u.role_id=adru.role_id
                left join admin_resource as adre on adru.resource_id=adre.id
                where u.id="'.$userId.'" and adre.show_menu=1
                order by adre.order
            ');

            $thoiGianNghiBuConLai=\DB::select('select sum(thoi_gian_duoc_duyet_nghi_bu) as thoi_gian_duoc_duyet_nghi_bu from bao_cao_nghi_bu where id_users='.$userId.' and state=1 group by id_users');
        }
        
    ?>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="/" class="logo">
                        <span>
                            <img class="img-circle" src="{{ asset('public/template/default/assets/images/logo-vnpt.png') }}" alt="" height="68" >
                        </span>
                        <i>
                            <img src="{{ asset('public/template/default/assets/images/logo-vnpt-sm.png') }}" alt="" height="68">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">
                        <li class="dropdown notification-list hide-phone">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                               <i class="mdi mdi-earth"></i> Tiếng việt  <i class="mdi mdi-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    Tiếng anh (Đang cập nhật)
                                </a>


                            </div>
                        </li>
                        <?php if(count($thoiGianNghiBuConLai)>0){ ?>
                        <li class="dropdown notification-list hide-phone">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-timer"></i> Thời gian nghỉ bù còn lại 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="badge badge-danger badge-pill noti-icon-badge">
                                    {{$thoiGianNghiBuConLai[0]->thoi_gian_duoc_duyet_nghi_bu}} (giờ)
                                </span>
                            </a>
                        </li>
                        <?php } ?>
                        

                        <!-- <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="fi-bell noti-icon"></i>
                                <span class="badge badge-danger badge-pill noti-icon-badge">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <div class="dropdown-item noti-title">                                    
                                    <h6 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Xóa tất cả</small></a> </span>Thông báo</h6>
                                </div>

                                <div class="slimscroll" style="">
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                        <p class="notify-details">Không có tin nhắn nào<small class="text-muted"></small></p>
                                    </a>
                                </div>

                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    Xem hết tất cả tin <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li> -->

                        <!-- <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="fi-speech-bubble noti-icon"></i>
                                <span class="badge badge-light badge-pill noti-icon-badge">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <div class="dropdown-item noti-title">
                                    <h6 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Xóa tất cả</small></a> </span>Chat</h6>
                                </div>

                                <div class="slimscroll" style="max-height: 190px;">
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon"><img src="{{ asset('public/template/default/assets/images/users/avatar-2.jpg') }}" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Hệ thống</p>
                                        <p class="text-muted font-13 mb-0 user-msg">Bạn chưa nhận một tin nhắn nào!</p>
                                    </a>

                                    
                                </div>

                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li> -->

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user log" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('public/template/default/assets/images/users') }}<?php if($user){echo  $user[0]->hinh_anh;} else{echo '/user.png';} ?>" alt="user" class="rounded-circle"> <span class="ml-1"><?php if($user){echo 'Xin chào! '.$user[0]->name;} else{echo 'Đăng nhập';} ?> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <?php if($user){ ?>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                             
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-head"></i> <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-cog"></i> <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-help"></i> <span>Support</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-lock"></i> <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="dropdown-item notify-item">
                                    <i class="fi-power"></i> <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            

                            </div>
                            <?php } ?>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Tìm kiếm..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Danh mục chức năng</li>
                            <?php if(!$user){ ?>
                            <li>
                                <a href="/login">
                                    <i class="fi-air-play"></i><span class="badge badge-danger badge-pill pull-right">0</span> <span> Đăng nhập </span>
                                </a>
                            </li>
                            <?php } 
                            else{
                                foreach ($adminResources as $key => $item) {
                                    if($item->parent_id==1){
                                        echo '
                                            <li>
                                                <a class="go-to" href="/'.$item->uri.'">'.$item->icon.' <span> '.$item->ten_hien_thi.' </span> <span class="menu-arrow"></span></a>';
                                                    \Helper::rightMenu($adminResources,$item->id);
                                        echo '</li>';
                                    }
                                }
                            }
                            ?>
                            
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    @yield('content')
                </div> <!-- content -->

                <footer class="footer text-right">
                    © TRUNG TÂM CÔNG NGHỆ THÔNG TIN - VNPT TRÀ VINH
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/waves.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('public/template/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/counterup/jquery.counterup.min.js') }}"></script>
        <!-- Chart JS -->
        <script src="{{ asset('public/template/plugins/chart.js/chart.bundle.js') }}"></script>
        <!-- init dashboard -->
        <script src="{{ asset('public/template/default/assets/pages/jquery.dashboard.init.js') }}"></script>



        <script src="{{ asset('public/template/plugins/switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
        <script src="{{ asset('public/template/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
        <!-- <script src="{{ asset('public/template/plugins/autocomplete/jquery.mockjax.js') }}"></script> -->
        <script src="{{ asset('public/template/plugins/autocomplete/jquery.autocomplete.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/autocomplete/countries.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.autocomplete.init.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.form-advanced.init.js') }}"></script> <!-- -->


        <script src="{{ asset('public/template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.form-advanced.init.js') }}"></script>


        <!-- Sweet Alert Js  -->
        <script src="{{ asset('public/template/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.sweet-alert.init.js') }}"></script>

        <script src="{{ asset('public/template/plugins/jquery-toastr/jquery.toast.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.toastr.js') }}" type="text/javascript"></script>

        <!-- App js -->
        <script src="{{ asset('public/template/plugins/tinymce/tinymce.min.js') }}"></script>

        <!-- Xeditable -->
        <script src="{{ asset('public/template/plugins/moment/moment.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/template/plugins/bootstrap-xeditable/js/bootstrap-editable.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.xeditable.init.js') }}" type="text/javascript"></script>

        <!-- Xuất file word -->
        <script src="{{ asset('public/template/default/assets/js/export-word/FileSaver.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/template/default/assets/js/export-word/jquery.wordexport.js') }}" type="text/javascript"></script>

        <!--  -->
        <script src="{{ asset('public/template/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!--  -->
        <!-- App js -->
        <script src="{{ asset('public/template/default/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/jquery.app.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/sortable-html5/jquery.sortable.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                //jQuery('#datatable').DataTable();
                //Buttons examples
                var table = jQuery('#datatable-buttons').DataTable({
                    lengthChange: true,
                    /*buttons: ['copy', 'excel', 'pdf']*/
                });

                table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
                
                jQuery('.d-add-form').on('click',function(){
                    if(jQuery('.add-form').hasClass('d-none')){
                        jQuery('.add-form').removeClass('d-none');
                    }
                    else{
                        jQuery('.add-form').addClass('d-none');   
                    }
                });

                jQuery('#datatable-buttons_filter').addClass('text-right');
                jQuery('.log').on('click',function(){
                    var log=<?php if($user){echo '1';}else{echo '0';}?>;
                    if(log==0){
                        window.location.href = "/login";
                    }
                });

                


                /*Go to*/
                jQuery('.go-to').on('click',function(){
                    var href=jQuery(this).prop('href');
                    // khi đưa lên server đổi link này
                    if(href!='http://vnpt-report.abc:8080/#' && href!='http://vnpt-report.abc:8080/#'){
                        window.location.href = href;
                    }                    
                });

                /*Table 2*/
                var table2 = jQuery('#datatable-buttons2').DataTable({
                    lengthChange: true,
                });
                table2.buttons().container().appendTo('#datatable-buttons2_wrapper .col-md-6:eq(0)');
                jQuery('#datatable-buttons2_filter').addClass('text-right');

                
                $('.summernote').summernote({
                    height: 150,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
                
                $('input[type=file]').change(function (e) {
                    var html='';
                    $.each( e.target.files, function( key, value ) {
                        var name=value.name;
                        var arr=name.split(".");
                        if(arr[arr.length-1]=='xls' || arr[arr.length-1]=='xlsx'){
                            html+='<i style="color:green;" class="mdi mdi-file-excel"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='doc' || arr[arr.length-1]=='docx'){
                            html+='<i style="color:blue;" class="mdi mdi-file-word"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='ppt' || arr[arr.length-1]=='pptx'){
                            html+='<i style="color:red;" class="mdi mdi-file-powerpoint"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='pdf'){
                            html+='<i style="color:red;" class="mdi mdi-file-pdf-box"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='php' || arr[arr.length-1]=='prc' || arr[arr.length-1]=='html' || arr[arr.length-1]=='js' || arr[arr.length-1]=='java' || arr[arr.length-1]=='css' || arr[arr.length-1]=='asp' || arr[arr.length-1]=='aspx' || arr[arr.length-1]=='sql' || arr[arr.length-1]=='pbix'){
                            html+='<i style="color:grey;" class="mdi mdi-code-not-equal-variant"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='txt'){
                            html+='<i  style="color:grey;" class="mdi mdi-note-text"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='zip' || arr[arr.length-1]=='rar'){
                            html+='<i style="color:grey;" class="mdi mdi-zip-box"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='png' || arr[arr.length-1]=='jpg' || arr[arr.length-1]=='jpeg'){
                            html+='<i grey class="mdi mdi-file-image"></i> '+name+'<br>';
                        }else{
                            html+='<i grey class="mdi mdi-file"></i> '+name+'<br>';
                        }
                    });
                    $(this).parents('.giz-upload').find('.element-to-paste-filename').html(html);
                });


            });
        </script>
       




    </body>
</html>
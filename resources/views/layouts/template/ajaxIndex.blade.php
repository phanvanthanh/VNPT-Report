<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
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

        <link href="{{ asset('public/template/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('public/template/default/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/js/modernizr.min.js') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('public/template/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />

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

        </style>

    </head>


    <body>
        @yield('content')
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

        <script src="{{ asset('public/template/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.sweet-alert.init.js') }}"></script>

        <!-- Xuất file word -->
        <script src="{{ asset('public/template/default/assets/js/export-word/FileSaver.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/template/default/assets/js/export-word/jquery.wordexport.js') }}" type="text/javascript"></script>

        <!--  -->
        <script src="{{ asset('public/template/plugins/summernote/summernote-bs4.min.js') }}"></script>

        <script src="{{ asset('public/template/plugins/jquery-toastr/jquery.toast.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/template/default/assets/pages/jquery.toastr.js') }}" type="text/javascript"></script>
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
                jQuery('#datatable-buttons_filter').addClass('text-right');

                /*Go to*/
                jQuery('.go-to').on('click',function(){
                    var href=jQuery(this).prop('href');
                    // khi đưa lên server đổi link này
                    if(href!='http://vnpt-report.abc/#' && href!='http://vnpt-report.abc/#'){
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
                    height: 250,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });


                
                


            });
        </script>
       




    </body>
</html>
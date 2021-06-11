@extends('layouts.template.login')

@section('content')
<!-- HOME -->
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
                                        <h3 class="text-uppercase text-center font-bold mt-4">ĐĂNG NHẬP</h3>
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <label for="emailaddress">Tên đăng nhập:</label>
                                                    <input class="form-control" type="text" id="email" name="email" required=""placeholder="Nhập tên đăng nhập" value="{{ old('email')}}" style="height: 36px;">
                                                    @if ($errors->has('email'))
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="password">Mật khẩu</label>
                                                    <input class="form-control" type="password" required="" id="password" placeholder="Nhập mật khẩu" name="password" style="height: 36px;">
                                                    @if ($errors->has('password'))
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">

                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">
                                                            Ghi nhớ lần đăng nhập sau
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-block btn-gradient waves-effect waves-light" type="submit" style="height: 36px; font-size: 15px; line-height: 1.5;">Đăng Nhập</button>
                                                </div>
                                            </div>

                                        </form>

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
        <!-- END HOME -->
        <script src="{{ asset('public/template/default/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/jquery.app.js') }}"></script>
        
 
    <script type="text/javascript">
 
        jQuery(document).ready(function() {
            $('#email').on('keypress',function(e) {
                if(e.which == 13) {
                    jQuery('#password').focus();
                    return false;
                }
            });
        });
    </script>
@endsection
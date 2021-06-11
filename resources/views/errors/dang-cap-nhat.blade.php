@extends('layouts.template.index')

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
                                    </div>
                                    <div class="account-content text-center">
                                        <h1 class="text-error">THÔNG BÁO</h1>
                                        <h4 class="text-uppercase text-danger mt-3">Chức Năng Đang Cập Nhật</h4>
                                        <p class="text-muted mt-3">It's looking like you may have taken a wrong turn. Don't worry... it
                                            happens to the best of us. Here's a
                                            little tip that might help you get back on track.</p>

                                        <a class="btn btn-md btn-block btn-gradient waves-effect waves-light mt-3" href="/"> Return Home</a>
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
        @endsection
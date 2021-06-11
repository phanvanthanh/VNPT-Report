@extends('layouts.template.index')

@section('content')
<div class="row">
                            <div class="col-lg-12">

                                <div class="card-box">
                                    <h5 class="header-title m-t-0">Đăng ký</h5>
                                    <p class="text-muted font-14 m-b-20">
                                        Vui lòng nhập đầy đủ thông tin sau
                                    </p>

                                    <form  role="form" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name">Họ Và Tên<span class="text-danger">*</span></label>
                                            <input type="text" name="name" parsley-trigger="change" required
                                                   placeholder="Enter user name" class="form-control" id="name">
                                            @if ($errors->has('name'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address<span class="text-danger">*</span></label>
                                            <input type="email" name="email" parsley-trigger="change" required
                                                   placeholder="Enter email" class="form-control" id="email">
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="pass1">Password<span class="text-danger">*</span></label>
                                            <input id="pass1" type="password" placeholder="Password" required
                                                   class="form-control" name="password">
                                            @if ($errors->has('password'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                            <input data-parsley-equalto="#pass1" type="password" required
                                                   placeholder="Password" class="form-control" id="passWord2">
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-purple">
                                                <input id="checkbox6a" type="checkbox">
                                                <label for="checkbox6a">
                                                    Ghi nhớ tôi
                                                </label>
                                            </div>

                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-gradient waves-effect waves-light" type="submit">
                                                Đăng ký
                                            </button>
                                            <button type="reset" class="btn btn-light waves-effect m-l-5">
                                                Hủy
                                            </button>
                                        </div>

                                    </form>
                                </div> <!-- end card-box -->
                            </div>
                            <!-- end col -->

                        </div>
@endsection

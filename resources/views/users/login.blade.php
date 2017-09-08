@extends('app')
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登陆</div>
                    <div class="panel-body">
                        @if(Session::has('user_login_failed'))
                            <div class="alert alert-danger" role="alert" style="text-align: center">
                                {{session('user_login_failed')}}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="/user/login">
                            {{ csrf_field() }}
                            <div class="alert-danger">
                                @if($errors->any())
                                    <ul class="list-group">
                                        @foreach($errors->all() as $error)
                                            <li class="list-group-item list-group-item-danger">
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">邮箱</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        立即登录
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
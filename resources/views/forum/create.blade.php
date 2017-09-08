@extends('app')

@section('content')
    @include('editor::head')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-9" role="main">
                <form class="form-horizontal" method="POST" action="/discussions">
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
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">标题</label>
                        <div class="col-md-8">
                            <input id="title" type="text" class="form-control" name="title"
                                   value="{{old('title')}}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                            <label for="body" class="col-md-4 control-label">内容</label>
                            <div class="col-md-8">
                                <div class="editor">
                                    <textarea name="body" id="myEditor" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif

                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                发表帖子
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop

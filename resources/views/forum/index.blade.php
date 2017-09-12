@extends('app')
@section('title')
    laravelCode
@stop
@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success navbar" role="alert" style="text-align: center">
            {{session('status')}}
        </div>
    @endif
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron bg-success">
            <div class="container">
                <h2>欢迎来到laravelCode
                    <a class="btn btn-lg btn-primary pull-right" href="/discussions/create" role="button">发布新帖</a>
                </h2>
            </div>
        </div>


    <div class="container">
        <div class="col-md-9" role="main">
            @foreach($discussions as $discussion)
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" style="width: 64px" alt="64*64" src="{{$discussion->user->avatar}}" alt="">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="/discussions/{{$discussion->id}}">{{$discussion->title}}</a>
                            <div class="media-conversation-meta">
                                <span class="media-conversation-replies">
                                <a href="/discussion/154#reply">{{ count($discussion->comments) }}</a>
                                回复
                                </span>
                            </div>
                        </h4>
                        {{$discussion->user->name}}
                    </div>
                </div>
            @endforeach
        </div>
            <div class="col-md-9 col-md-offset-6">
                {{ $discussions->links() }}
            </div>
        </div>

    </div>
@stop


@section('script')
    <script type="text/javascript">
        @if(Session::has('status'))
            setTimeout(function(){
                $('.alert').hide();
            },2000);
        @endif
    </script>
@stop

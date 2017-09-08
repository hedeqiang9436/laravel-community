@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" style="width: 64px" alt="64*64" src="{{$discussion->user->avatar}}" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$discussion->title}}</h4>
                    {{$discussion->user->name}}
                    @if(Auth::check() && Auth::user()->id==$discussion->user_id)
                        <a class="btn btn-lg btn-primary pull-right" href="/discussions/{{$discussion->id}}/edit" role="button">修改帖子</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-9" role="main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{$discussion->title}}</h2>
                <p class="blog-post-meta">{{$discussion->created_at}} <a href="#">{{$discussion->user->name}}</a></p>
                {!! $html !!}
            </div>
            <hr>
            @foreach($discussion->comments as $comment)
                <div class="media"  >
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" style="width: 64px" alt="64*64" src="{{$comment->user->avatar}}" alt="">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->user->name}}</h4>
                        {{$comment->body}}
                    </div>
                </div>
             @endforeach

            {{--<div class="media" v-for="comment in comments">--}}
                {{--<div class="media-left">--}}
                    {{--<a href="#">--}}
                        {{--<img class="media-object img-circle" style="width: 64px" alt="64*64" src="@{{comment.avatar}}" alt="">--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="media-body">--}}
                    {{--<h4 class="media-heading">@{{comment.name}}</h4>--}}
                    {{--@{{comment.body}}--}}
                {{--</div>--}}
            {{--</div>--}}

            <hr>
            @if(Auth::check())
            <form class="form-horizontal" method="POST"  action="/comments">
                {{ csrf_field() }}
                <input type="hidden" name="discussion_id" value="{{$discussion->id}}">
                <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <textarea name="body"  id="body" class="form-control" cols="30" rows="3"></textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3 pull-right">
                        <button type="submit" class="btn btn-danger btn-block">
                            发表评论
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>

    {{--<script>--}}
        {{--Vue.http.headers.common['X-CSRF-TOKEN']=document.querySelector('#token').getAttribute('value');--}}
        {{--new Vue({--}}
            {{--el:'#post',--}}
            {{--data:{--}}
                {{--comments:[],--}}
                {{--newComment:{--}}
                    {{--name:'{{Auth::user()->name}}',--}}
                    {{--avatar:'{{Auth::user()->avatar}}',--}}
                    {{--body:''--}}
                {{--},--}}
                {{--newPost:{--}}
                    {{--discussion_id:'{{$discussion->id}}',--}}
                    {{--user_id:'{{Auth::user()->id}}',--}}
                    {{--body:''--}}
                {{--},--}}
            {{--},--}}
            {{--methods:{--}}
                {{--onsubmitForm:function(e){--}}
                    {{--e.preventDefault();--}}
                    {{--var comment=this.newComment;--}}
                    {{--var post=this.newPost;--}}
                    {{--post.body=comment.body;--}}
                    {{--this.$http.post('/comments',post,function(){--}}
                        {{--this.comments.push(comment);--}}
                    {{--})--}}
                    {{--this.newComment={--}}
                        {{--name:'{{Auth::user()->name}}',--}}
                        {{--avatar:'{{Auth::user()->avatar}}',--}}
                        {{--body:''--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}
@stop
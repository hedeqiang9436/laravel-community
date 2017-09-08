<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="/css/jquery.Jcrop.css" rel="stylesheet">


    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.color.js"></script>
    <script src="/js/jquery.Jcrop.js"></script>
    {{--<script src="/js/vue.js"></script>--}}
    {{--<script src="/js/vue-resource.min.js"></script>--}}
    {{--<meta id="token" name="token" value="{{csrf_token()}}">--}}
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index">LaravelCode</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/index">首页</a></li>
                {{--<li><a href="#about">About</a></li>--}}
                {{--<li><a href="#contact">Contact</a></li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"> {{Auth::user()->name}}</a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="/user/avatar"> <i class="fa fa-user"></i> 更换头像</a></li>
                        <li><a href="#"> <i class="fa fa-cog"></i> 更换密码</a></li>
                        <li><a href="#"> <i class="fa fa-heart"></i> 特别感谢</a></li>
                        <li role="separator" class="divider"></li>
                        <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
                    </ul>
                    <li><img class="img-circle" width="50" src="{{Auth::user()->avatar}}"></li>
                @else
                    <li><a href="/user/login">登陆</a></li>
                    <li><a href="/user/register">注册</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
    @yield('content')

    @yield('script')
</body>
</html>
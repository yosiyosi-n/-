<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | 基礎学習ターム 確認テスト</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/authapp.css') }}">
    @yield('css')
</head>
<body>

    <header>
        <div class="header-inner">
            <h2>FashionablyLate</h2>
            <nav class="header-nav">
                @if(Route::is('login'))
                    <a href="{{ route('register') }}" class="btn-header-action">register</a>
                @elseif(Route::is('register'))
                    <a href="{{ route('login') }}" class="btn-header-action">login</a>
                @endif
            </nav>
        </div>
    </header>

    <main class="content">
        @yield('content')
    </main>

</body>
</html>

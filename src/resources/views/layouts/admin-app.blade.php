<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | 基礎学習ターム 確認テスト</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin-app.css') }}">
    @yield('css')
</head>
<body>

    <!-- 💡 wrapperの余分な箱を削除し、ヘッダーとコンテンツを直列に配置します -->
    <header class="auth-header">
        <div class="header-inner">
            <h2>FashionablyLate</h2>
            <nav class="header-nav">
                <form action="/logout" method="POST" class="nav-logout-form">
                    @csrf
                    <button type="submit" class="btn-header-action">logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="content">
        @yield('content')
    </main>

</body>
</html>

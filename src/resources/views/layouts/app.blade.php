<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- 💡各ページごとのタイトルがここに入ります -->
    <title>@yield('title') | 基礎学習ターム 確認テスト</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 0 auto; padding: 0 10px; }
        header { background-color: #333; color: #fff; padding: 15px; margin-bottom: 20px; text-align: center; }
        header h2 { margin: 0; font-size: 18px; }
        footer { margin-top: 40px; padding: 15px; border-top: 1px solid #ccc; text-align: center; color: #777; font-size: 12px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .confirm-group { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .value { margin-top: 5px; white-space: pre-wrap; }
        .btn-group { display: flex; gap: 10px; }
        button, .btn { padding: 10px 20px; cursor: pointer; display: inline-block; background-color: #eee; border: 1px solid #ccc; text-decoration: none; color: #000; }
        button[type="submit"] { background-color: #007bff; color: #fff; border: none; }
    </style>
</head>
<body>

    <!-- 💡【共通ヘッダー】 -->
    <header>
        <h2>Practice Project - お問い合わせデモ</h2>
    </header>

    <main class="content">
        <!-- 💡各ページのメインコンテンツがここに入れ替わりで挿入されます -->
        @yield('content')
    </main>

    <!-- 💡【共通フッター】 -->
    <footer>
        <p>&copy; {{ date('Y') }} inquiry app.</p>
    </footer>

</body>
</html>

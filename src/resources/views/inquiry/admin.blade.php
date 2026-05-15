@extends('layouts.app')

@section('title', '管理画面')

@section('content')
    <div class="admin-container">
        <h1>PG04: 管理画面</h1>

        <!-- 💡 PG05・PG06: 検索および検索リセットフォームの追加 -->
        <div class="search-box" style="background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border: 1px solid #ddd;">
            <!-- 仕様書の「パス /search」に合わせてPOST（またはGET）で送信します -->
            <form action="/search" method="POST" class="search-form">
                @csrf
                <div class="form-group" style="display: inline-block; margin-right: 10px;">
                    <label for="search-name" style="font-weight: bold;">お名前:</label>
                    <!-- 💡 検索キーワードが消えないように request('name') を保持します -->
                    <input type="text" name="name" id="search-name" value="{{ request('name') }}" style="width: 150px; padding: 5px;">
                </div>

                <div class="form-group" style="display: inline-block; margin-right: 10px;">
                    <label for="search-email" style="font-weight: bold;">メールアドレス:</label>
                    <input type="text" name="email" id="search-email" value="{{ request('email') }}" style="width: 180px; padding: 5px;">
                </div>

                <!-- 💡 検索実行ボタン（PG05） -->
                <button type="submit" class="btn btn-search" style="background-color: #007bff; color: #fff; border: none; padding: 6px 12px;">検索</button>
                
                <!-- 💡 検索リセットボタン（PG06: パス /reset へのボタン） -->
                <a href="/reset" class="btn btn-reset" style="background-color: #6c757d; color: #fff; text-decoration: none; padding: 6px 12px; margin-left: 5px; font-size: 14px; display: inline-block;">リセット</a>
            </form>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #eee; border-bottom: 2px solid #ccc;">
                    <th style="padding: 10px; text-align: left;">ID</th>
                    <th style="padding: 10px; text-align: left;">お名前</th>
                    <th style="padding: 10px; text-align: left;">メールアドレス</th>
                    <th style="padding: 10px; text-align: left;">件名</th>
                    <th style="padding: 10px; text-align: left;">送信日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $inquiry)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">{{ $inquiry->id }}</td>
                        <td style="padding: 10px;">{{ $inquiry->name }}</td>
                        <td style="padding: 10px;">{{ $inquiry->email }}</td>
                        <td style="padding: 10px;">{{ $inquiry->title }}</td>
                        <td style="padding: 10px;">{{ $inquiry->created_at->format('Y/m/d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

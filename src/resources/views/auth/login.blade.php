@extends('layouts.app')

@section('title', 'ログイン')

<!-- 💡 ログイン画面専用のCSSを指定 -->
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="auth-container">
        <h1>ログイン</h1>

        <form action="/login" method="POST" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">ログイン</button>
        </form>
    </div>
@endsection

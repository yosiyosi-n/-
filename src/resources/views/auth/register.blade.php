@extends('layouts.app')

@section('title', 'ユーザー登録')

<!-- 💡 ユーザー登録画面専用のCSSを指定 -->
@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="auth-container">
        <h1>ユーザー登録</h1>

        <form action="/register" method="POST" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

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

            <div class="form-group">
                <label for="password-confirmation">パスワード（確認用）</label>
                <input type="password" name="password_confirmation" id="password-confirmation">
            </div>

            <button type="submit" class="btn-submit">登録する</button>
        </form>
    </div>
@endsection

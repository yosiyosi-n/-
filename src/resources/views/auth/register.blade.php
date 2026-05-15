@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')
    <div class="auth-container">
        <h1>ユーザー登録</h1>

        <form action="/register" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirmation">パスワード（確認用）</label>
                <input type="password" name="password_confirmation" id="password-confirmation">
            </div>

            <button type="submit">登録する</button>
        </form>
    </div>
@endsection

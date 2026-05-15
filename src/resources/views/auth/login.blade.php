@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="auth-container">
        <h1>ログイン</h1>

        <form action="/login" method="POST">
            @csrf

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

            <button type="submit">ログイン</button>
        </form>
    </div>
@endsection

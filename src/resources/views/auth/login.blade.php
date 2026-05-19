@extends('layouts.auth-app')

@section('title', 'ログイン')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="auth-container">
        <h1>Login</h1>
        <div class="auth-container-border">
            <form action="{{ route('login') }}" method="POST" class="auth-form">
                @csrf
                <div class="auth-border">
                    <!-- 1. メールアドレス -->
                    <div class="auth-group">
                        <label for="email" class="auth-label">メールアドレス</label>
                        <div class="auth-input-area">
                            <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                            @error('email') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 2. パスワード -->
                    <div class="auth-group">
                        <label for="password" class="auth-label">パスワード</label>
                        <div class="auth-input-area">
                            <input type="password" name="password" id="password" placeholder="例: coachtech1106">
                            @error('password') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- ボタン配置 -->
                <div class="auth-btn-row">
                    <button type="submit" class="btn btn-submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
@endsection

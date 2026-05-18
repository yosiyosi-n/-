@extends('layouts.authapp')

@section('title', 'ユーザー登録')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="auth-container">
        <h1>Register</h1>
        <div class="auth-container-border">
            <form action="{{ route('register') }}" method="POST" class="auth-form">
                @csrf
                <div class="auth-border">
                    <!-- 1. お名前 -->
                    <div class="auth-group">
                        <label for="name" class="auth-label">お名前</label>
                        <div class="auth-input-area">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
                            @error('name') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 2. メールアドレス -->
                    <div class="auth-group">
                        <label for="email" class="auth-label">メールアドレス</label>
                        <div class="auth-input-area">
                            <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                            @error('email') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 3. パスワード -->
                    <div class="auth-group">
                        <label for="password" class="auth-label">パスワード</label>
                        <div class="auth-input-area">
                            <input type="password" name="password" id="password" placeholder="例: coachtech1106">
                            @error('password') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <input type="hidden" name="password_confirmation" value="1">
                </div>

                <!-- ボタン配置 -->
                <div class="auth-btn-row">
                    <button type="submit" class="btn btn-submit">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection

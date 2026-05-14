@extends('layouts.app')

@section('title', 'お問い合わせ入力')

@section('content')
    <h1>お問い合わせ 入力</h1>

    <form action="{{ route('inquiry.confirm') }}" method="POST">
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
            <label for="title">件名</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">お問い合わせ内容</label>
            <textarea name="content" id="content" rows="5">{{ old('content') }}</textarea>
            @error('content')
                <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">確認画面へ</button>
    </form>
@endsection

@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('content')
    <h1>お問い合わせ 内容確認</h1>

    <form action="{{ route('inquiry.thanks') }}" method="POST">
        @csrf

        <input type="hidden" name="name" value="{{ $inputs['name'] }}">
        <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        <input type="hidden" name="title" value="{{ $inputs['title'] }}">
        <input type="hidden" name="content" value="{{ $inputs['content'] }}">

        <div class="confirm-group">
            <div class="label">お名前</div>
            <div class="value">{{ $inputs['name'] }}</div>
        </div>

        <div class="confirm-group">
            <div class="label">メールアドレス</div>
            <div class="value">{{ $inputs['email'] }}</div>
        </div>

        <div class="confirm-group">
            <div class="label">件名</div>
            <div class="value">{{ $inputs['title'] }}</div>
        </div>

        <div class="confirm-group">
            <div class="label">お問い合わせ内容</div>
            <div class="value">{{ $inputs['content'] }}</div>
        </div>

        <div class="btn-group">
            <button type="button" onclick="history.back()">修正する</button>
            <button type="submit">送信する</button>
        </div>
    </form>
@endsection

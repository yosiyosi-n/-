@extends('layouts.app')

@section('title', 'お問い合わせ完了')

@section('content')
    <div style="text-align: center; margin: 40px 0;">
        <h1>送信完了</h1>
        <p>お問い合わせありがとうございました。</p>
        <br>
        <a href="{{ route('inquiry.index') }}" class="btn">入力画面に戻る</a>
    </div>
@endsection

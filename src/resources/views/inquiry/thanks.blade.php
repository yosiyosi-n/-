@extends('layouts.app')

@section('title', '送信完了')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks-container">
        <h1>お問い合わせありがとうございました</h1>
        <p>内容を送信いたしました。</p>
        <div class="btn-group">
            <a href="/" class="btn btn-back">トップページへ戻る</a>
        </div>
    </div>
@endsection

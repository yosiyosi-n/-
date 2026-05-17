@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="confirm-container">
        <h1>Confirm</h1>

        <form action="{{ route('inquiry.thanks') }}" method="POST" class="confirm-form" id="inquiry-confirm-form">
            @csrf

            <div class="confirm-border">
                <div class="confirm-group">
                    <div class="confirm-label">お名前</div>
                    <div class="confirm-value">{{ $inputs['first_name'] }} {{ $inputs['last_name'] }}</div>
                    <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
                    <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
                </div>

                <div class="confirm-group">
                    <div class="confirm-label">性別</div>
                    <div class="confirm-value">@if($inputs['gender'] == '1')男性@elseif($inputs['gender'] == '2')女性@elseその他@endif</div>
                    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                </div>

                <div class="confirm-group">
                    <div class="confirm-label">メールアドレス</div>
                    <div class="confirm-value">{{ $inputs['email'] }}</div>
                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </div>

                <!-- 💡 電話番号エリア：AIボット対策・加工処理を適用 -->
                <div class="confirm-group">
                    <div class="confirm-label">電話番号</div>
                    <!-- 💡 ソースコード上は空っぽに見せかけ、data属性という隠し引き出しの中にバラバラに番号を隠します -->
                    <div class="confirm-value" id="secure-telephone-display" 
                         data-tel1="{{ $inputs['telephone_one'] }}" 
                         data-tel2="{{ $inputs['telephone_two'] }}" 
                         data-tel3="{{ $inputs['telephone_three'] }}"></div>
                    <input type="hidden" name="telephone_one" value="{{ $inputs['telephone_one'] }}">
                    <input type="hidden" name="telephone_two" value="{{ $inputs['telephone_two'] }}">
                    <input type="hidden" name="telephone_three" value="{{ $inputs['telephone_three'] }}">
                </div>

                <div class="confirm-group">
                    <div class="confirm-label">住所</div>
                    <div class="confirm-value">{{ $inputs['address'] }}</div>
                    <input type="hidden" name="address" value="{{ $inputs['address'] }}">
                </div>

                <div class="confirm-group">
                    <div class="confirm-label">建物名</div>
                    <div class="confirm-value">{{ $inputs['building_name'] ?? 'ー' }}</div>
                    <input type="hidden" name="building_name" value="{{ $inputs['building_name'] }}">
                </div>

                <div class="confirm-group">
                    <div class="confirm-label">お問い合わせの種類</div>
                    <div class="confirm-value">@if($inputs['inquiry_type'] == '1')商品のお届けについて@elseif($inputs['inquiry_type'] == '2')商品の交換について@elseif($inputs['inquiry_type'] == '3')商品トラブル@elseif($inputs['inquiry_type'] == '4')ショップへのお問い合わせ@elseその他@endif</div>
                    <input type="hidden" name="inquiry_type" value="{{ $inputs['inquiry_type'] }}">
                </div>

                <div class="confirm-group confirm-group-top">
                    <div class="confirm-label">お問い合わせの内容</div>
                    <div class="confirm-value">{!! nl2br(e($inputs['content'])) !!}</div>
                    <input type="hidden" name="content" value="{{ $inputs['content'] }}">
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-submit">送信</button>
                <button type="button" class="btn btn-back" onclick="history.back();">修正</button>
            </div>
        </form>
    </div>

        <!-- 💡 AIボット対策：画面表示の瞬間にバラバラの電話番号を【ハイフンなし】で結合する安全なJavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const displayElement = document.getElementById("secure-telephone-display");
            if (displayElement) {
                // 隠し引き出しから番号を取り出します
                const tel1 = displayElement.getAttribute("data-tel1");
                const tel2 = displayElement.getAttribute("data-tel2");
                const tel3 = displayElement.getAttribute("data-tel3");
                // 💡 変更：ハイフンを挟まず、数字をそのままストレートに結合して出力します
                displayElement.textContent = tel1 + tel2 + tel3;
            }
        });
    </script>
@endsection


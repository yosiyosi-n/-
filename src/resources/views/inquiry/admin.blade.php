@extends('layouts.app')

@section('title', '管理画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="admin-container">
        <div class="admin-header-actions">
            <h1>PG04: 管理画面</h1>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">ログアウト</button>
            </form>
        </div>

        <div class="search-box">
            <form action="/search" method="POST" class="search-form">
                @csrf
                <div class="search-form-group">
                    <label for="search-name">お名前:</label>
                    <input type="text" name="name" id="search-name" value="{{ request('name') }}" class="search-input">
                </div>

                <div class="search-form-group">
                    <label for="search-email">メールアドレス:</label>
                    <input type="text" name="email" id="search-email" value="{{ request('email') }}" class="search-input search-input-email">
                </div>

                <button type="submit" class="btn btn-search">検索</button>
                <a href="/reset" class="btn btn-reset">リセット</a>
            </form>
        </div>

        <div class="export-box">
            <a href="/export" class="btn btn-export">CSVエクスポート</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>お名前</th>
                    <th>メールアドレス</th>
                    <th>件名</th>
                    <th>送信日時 / 操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $inquiry)
                    <tr>
                        <td>{{ $inquiry->id }}</td>
                        <td>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</td>
                        <td>{{ $inquiry->email }}</td>
                        <td>
                            @if($inquiry->inquiry_type == '1') 商品のお届けについて
                            @elseif($inquiry->inquiry_type == '2') 商品の交換について
                            @elseif($inquiry->inquiry_type == '3') 商品トラブル
                            @elseif($inquiry->inquiry_type == '4') ショップへのお問い合わせ
                            @else その他
                            @endif
                        </td>
                        <td class="admin-table-flex-td">
                            <span>{{ $inquiry->created_at->format('Y/m/d H:i') }}</span>
                            <form action="/delete" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                <input type="hidden" name="id" value="{{ $inquiry->id }}">
                                <button type="submit" class="btn btn-delete">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

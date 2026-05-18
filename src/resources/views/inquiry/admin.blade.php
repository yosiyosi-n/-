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
                <a href="/reset" class="btn btn-reset">リセットする</a>
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
                    <!-- 💡 変更：テーブル仕様書に完全準拠させるため「お問い合わせの種類」に変更します -->
                    <th>お問い合わせの種類</th>
                    <th>送信日時 / 操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>
                            @if($contact->categry_id == '1') 商品のお届けについて
                            @elseif($contact->categry_id == '2') 商品の交換について
                            @elseif($contact->categry_id == '3') 商品トラブル
                            @elseif($contact->categry_id == '4') ショップへのお問い合わせ
                            @else その他
                            @endif
                        </td>
                        <td class="admin-table-flex-td">
                            <span>{{ $contact->created_at ? $contact->created_at->format('Y/m/d H:i') : 'ー' }}</span>
                            <form action="/delete" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <button type="submit" class="btn btn-delete">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $contacts->links() }}
        </div>
    </div>
@endsection

@extends('layouts.admin-app')

@section('title', '管理画面')

@section('css')
    <!-- 分解した2つの個別CSSファイルを同じセクション内で確実に直列読み込みさせます -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('content')
    <div class="admin-container">
        <h1>Admin</h1>

        <div class="search-box">
            <form action="/admin" method="GET" class="search-form">
                @csrf
                <!-- 1. 検索キーワード欄 -->
                <div class="search-form-group search-input-keyword">
                    <label for="search-keyword"></label>
                    <input type="text" name="keyword" id="search-keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力" class="search-input">
                </div>

                <!-- 2. 性別セレクトボックス -->
                <div class="search-form-group">
                    <label for="search-gender"></label>
                    <select name="gender" id="search-gender" class="search-select">
                        <option value="" {{ request('gender') == '' || !request()->has('gender') ? 'selected' : '' }} hidden>性別</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>

                <!-- 3. お問い合わせの種類セレクトボックス -->
                <div class="search-form-group">
                    <label for="search-inquiry-type"></label>
                    <select name="inquiry_type" id="search-inquiry-type" class="search-select">
                        <option value="" {{ request('inquiry_type') == '' || !request()->has('inquiry_type') ? 'selected' : '' }} hidden>お問い合わせの種類</option>
                        <option value="1" {{ request('inquiry_type') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="2" {{ request('inquiry_type') == '2' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="3" {{ request('inquiry_type') == '3' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="4" {{ request('inquiry_type') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="5" {{ request('inquiry_type') == '5' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>

                <!-- 4. 生年月日ボックス -->
                <div class="search-form-group">
                    <label for="search-birth"></label>
                    <input type="date" name="birth_date" id="search-birth" value="{{ request('birth_date') }}" placeholder="年/月/日" onchange="this.setAttribute('value', this.value)" class="search-input search-input-date">
                </div>

                <div class="search-btn-actions">
                    <button type="submit" class="btn btn-search">検索</button>
                    <a href="/admin" class="btn btn-reset">リセットする</a>
                </div>
            </form>
        </div>

        <div class="export-box">
            <a href="/export?{{ http_build_query(request()->query()) }}" class="btn btn-export">CSVエクスポート</a>
            <!-- 💡 変更：CSSの優先度勝負に200%勝つために、独自の専用クラス名『custom-classic-pagination』を直接付与します -->
            <div class="custom-classic-pagination">
                {{ $contacts->appends(request()->query())->links() }}
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td>
                            @if($contact->gender == '1') 男性
                            @elseif($contact->gender == '2') 女性
                            @elseif($contact->gender == '3') その他
                            @else 不明
                            @endif
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>
                            @if($contact->categry_id == '1') 商品のお届けについて
                            @elseif($contact->categry_id == '2') 商品の交換について
                            @elseif($contact->categry_id == '3') 商品トラブル
                            @elseif($contact->categry_id == '4') ショップへのお問い合わせ
                            @else その他
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-detail" onclick="openModal('modal-{{ $contact->id }}')">詳細</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 外部の modal/modal-window ファイルを一括読み込み -->
    @foreach ($contacts as $contact)
        @include('modal.modal-window')
    @endforeach

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('is-active');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('is-active');
            document.body.style.overflow = '';
        }
    </script>
@endsection

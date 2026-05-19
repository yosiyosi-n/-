<div id="modal-{{ $contact->id }}" class="modal-overlay" onclick="closeModal('modal-{{ $contact->id }}')">
    <div class="modal-window" onclick="event.stopPropagation()">
        <!-- 閉じる用の「×」ボタン -->
        <button type="button" class="modal-close-btn" onclick="closeModal('modal-{{ $contact->id }}')">×</button>
        
        <table class="modal-table">
            <!-- 1. お名前 -->
            <tr>
                <th>お名前</th>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
            </tr>
            <!-- 2. 性別 -->
            <tr>
                <th>性別</th>
                <td>
                    @if($contact->gender == '1') 男性 @elseif($contact->gender == '2') 女性 @else その他 @endif
                </td>
            </tr>
            <!-- 3. メールアドレス -->
            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact->email }}</td>
            </tr>
            <!-- 4. 電話番号（枠線なし・Georgiaフォント専用クラスを付与） -->
            <tr>
                <th>電話番号</th>
                <td class="modal-tel-text">{{ $contact->tel }}</td>
            </tr>
            <!-- 5. 住所 -->
            <tr>
                <th>住所</th>
                <td>{{ $contact->address }}</td>
            </tr>
            <!-- 6. 建物名 -->
            <tr>
                <th>建物名</th>
                <td>{{ $contact->building ?? 'ー' }}</td>
            </tr>
            <!-- 7. お問い合わせの種類 -->
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    @if($contact->categry_id == '1') 商品のお届けについて
                    @elseif($contact->categry_id == '2') 商品の交換について
                    @elseif($contact->categry_id == '3') 商品トラブル
                    @elseif($contact->categry_id == '4') ショップへのお問い合わせ
                    @else その他 @endif
                </td>
            </tr>
            <!-- 8. お問い合わせの内容 -->
            <tr>
                <th>お問い合わせの内容</th>
                <td><div class="modal-detail-text">{{ $contact->detail }}</div></td>
            </tr>
        </table>

        <!-- 削除フォームの完全移植 -->
        <div class="modal-action-row">
            <form action="/delete" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                <input type="hidden" name="id" value="{{ $contact->id }}">
                <button type="submit" class="btn btn-delete">削除</button>
            </form>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('title', 'お問い合わせ入力')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="form-container">
        <h1>Contact</h1>

        <form action="{{ route('inquiry.confirm') }}" method="POST" class="inquiry-form">
            @csrf

            <!-- 1. お名前 -->
            <div class="form-group">
                <label class="form-label">お名前 <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <div class="form-flex">
                        <input type="text" name="first_name" id="first-name" value="{{ old('first_name') }}" placeholder="例: 山田" class="form-flex-item">
                        <input type="text" name="last_name" id="last-name" value="{{ old('last_name') }}" placeholder="例: 太郎" class="form-flex-item">
                    </div>
                    @error('first_name') <div class="error-message">{{ $message }}</div> @enderror
                    @error('last_name') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 2. 性別 -->
            <div class="form-group">
                <label class="form-label">性別 <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <div class="form-radio-group">
                        <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                    </div>
                    @error('gender') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 3. メールアドレス -->
            <div class="form-group">
                <label for="email" class="form-label">メールアドレス <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 4. 電話番号 -->
            <div class="form-group">
                <label class="form-label">電話番号 <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <div class="form-tel-group">
                        <input type="text" name="telephone_one" id="telephone-one" value="{{ old('telephone_one') }}" placeholder="090" class="form-tel-input">
                        <span>-</span>
                        <input type="text" name="telephone_two" id="telephone-two" value="{{ old('telephone_two') }}" placeholder="1234" class="form-tel-input">
                        <span>-</span>
                        <input type="text" name="telephone_three" id="telephone-three" value="{{ old('telephone_three') }}" placeholder="5678" class="form-tel-input">
                    </div>
                    @error('telephone_one') <div class="error-message">{{ $message }}</div> @enderror
                    @error('telephone_two') <div class="error-message">{{ $message }}</div> @enderror
                    @error('telephone_three') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 5. 住所 -->
            <div class="form-group">
                <label for="address" class="form-label">住所 <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 6. 建物名 -->
            <div class="form-group">
                <label for="building-name" class="form-label">建物名</label>
                <div class="form-input-area">
                    <input type="text" name="building_name" id="building-name" value="{{ old('building_name') }}" placeholder="例: 千駄ヶ谷マンション101">
                </div>
            </div>

            <!-- 7. お問い合わせの種類 -->
            <div class="form-group">
                <label for="inquiry-type" class="form-label">お問い合わせの種類 <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <div class="select-wrapper">
                        <select name="inquiry_type" id="inquiry-type">
                            <option value="" disabled {{ old('inquiry_type') === null ? 'selected' : '' }}>選択してください</option>
                            <option value="1" {{ old('inquiry_type') == '1' ? 'selected' : '' }}>1. 商品のお届けについて</option>
                            <option value="2" {{ old('inquiry_type') == '2' ? 'selected' : '' }}>2. 商品の交換について</option>
                            <option value="3" {{ old('inquiry_type') == '3' ? 'selected' : '' }}>3. 商品トラブル</option>
                            <option value="4" {{ old('inquiry_type') == '4' ? 'selected' : '' }}>4. ショップへのお問い合わせ</option>
                            <option value="5" {{ old('inquiry_type') == '5' ? 'selected' : '' }}>5. その他</option>
                        </select>
                    </div>
                    @error('inquiry_type') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 8. お問い合わせの内容 -->
            <div class="form-group form-group-top">
                <label for="content" class="form-label">お問い合わせの内容 <span class="error-message">※</span></label>
                <div class="form-input-area">
                    <textarea name="content" id="content" rows="5" placeholder="例: お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
                    @error('content') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- 9. ボタン配置 -->
            <div class="form-btn-row">
                <button type="submit" class="btn btn-submit">確認画面へ</button>
            </div>
        </form>
    </div>
@endsection

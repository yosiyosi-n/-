# お問い合わせ管理システム (inquiry)

基礎学習タームの確認テスト用「お問い合わせフォーム ＆ 管理システム」です。

## 👥 画面定義一覧
- **PG01:** お問い合わせフォーム入力ページ (`/`)
- **PG02:** お問い合わせフォーム確認ページ (`/confirm`)
- **PG03:** サンクスページ (`/thanks`)
- **PG04:** 管理画面 (`/admin`)
- **PG05:** 検索 (`/search`) -> `/admin` (GET) 一本化仕様
- **PG06:** 検索リセット (`/reset`) -> `/admin` 遷移仕様
- **PG07:** お問い合わせフォーム削除 (`/delete`)
- **PG08:** ユーザ登録 (`/register`)
- **PG09:** ログイン (`/login`)
- **PG10:** ログアウト (`/logout`)
- **PG11:** CSVエクスポート (`/export`) -> 検索条件完全連動仕様

---

## 🚀 環境構築手順 (Docker環境版)

手元のPC（ローカル環境）にクローンしたのち、以下の手順で実行してください。

### 1. リポジトリのクローンと移動
```bash
git clone git@github.com:yosiyosi-n/-.git inquiry
cd inquiry
```

### 2. Dockerコンテナの起動
※事前に Docker Desktop アプリを起動しておいてください。
```bash
docker-compose up -d
```

### 3. PHPコンテナの内部に入る
各種コマンドを実行するため、アプリが動いているサーバー（コンテナ）の中に入ります。
```bash
docker-compose exec php bash
```

---
💡 **これ以降のコマンド（手順4〜7）は、コンテナの内部（bash#）で実行してください。**
---

### 4. ライブラリのインストール
```bash
composer install
npm install && npm run build
```

### 5. 環境設定ファイルの準備 ＆ 設定変更
```bash
cp .env.example .env
```
💡 **【重要】コピーした `.env` ファイルを開き、データベース接続設定を Docker環境（`docker-compose.yml`）に合わせて必ず以下のように修正してください。**
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=root
```
修正・保存したら、コンテナ内でアプリケーションキーを生成します。
```bash
php artisan key:generate
```

### 6. マイグレーションとシーダーの実行
```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

### 7. ルートキャッシュのクリア ＆ コンテナからの脱出
```bash
php artisan route:clear
exit
```

---

コンテナから脱出（exit）したら構築完了です！
ブラウザで `http://localhost` にアクセスして動作確認を行ってください。

---

## 📊 データベース設計 (ER図)
プロジェクトのルート直下にある `inquiry.drawio.png` を参照してください。
![データベースER図](inquiry.drawio.png)

# 図書館管理システム

Laravelの学習目的で作成した、図書館管理システムです📚
Dockerを使ってローカル環境で起動できます🐳

## 🔧 必要なもの

- Git
- Docker
- Docker Compose

※ 本リポジトリは社内 GitHub Organization で管理しています。
　参照・clone を行うには、GitHub アカウントが必要です。
　未参加の場合は、管理者へ招待を依頼してください。

## 🚀 起動方法

※ 以下のコマンドは、Windows の場合は PowerShell、
Mac の場合は ターミナルで実行してください。

### 1️⃣ リポジトリを取得

```bash
git clone ＜後でリポジトリURLを記載＞
cd ＜後でフォルダ名を記載＞
```

### 2️⃣ Dockerで起動

```bash
docker compose up
```

初回起動時は、Docker イメージの取得などで
少し時間がかかる場合がありますが、正常な挙動です。
ログが流れ続けていれば、起動処理が進んでいます。

## 🌐 アクセス方法

起動後、ブラウザで以下のURLにアクセスしてください。
※ ポート番号は docker-compose.yml の設定によって異なる場合があります。

http://localhost:＜ポート番号＞

## 🛑 停止方法

起動中のコンテナを停止する場合は、以下のコマンドを実行してください。

```bash
docker compose down
```

以上で、Docker を使った起動は完了です。
不明点があれば、README を随時更新していきます。

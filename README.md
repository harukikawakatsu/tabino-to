# タビノート
<img width="1130" alt="" src="https://private-user-images.githubusercontent.com/155617039/358819268-42896b0b-43da-4fb7-9e87-629c24aebbf7.jpg?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MjM4NzY0MjksIm5iZiI6MTcyMzg3NjEyOSwicGF0aCI6Ii8xNTU2MTcwMzkvMzU4ODE5MjY4LTQyODk2YjBiLTQzZGEtNGZiNy05ZTg3LTYyOWMyNGFlYmJmNy5qcGc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQwODE3JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MDgxN1QwNjI4NDlaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT03OGMwMmE0OGE3MzFlOWYxYzhmMzUzYTE5YzEzNzVkNzExZjg2YTU4NTE0NTE2YzZkNDA1NzVjMWFkMjc3MzA4JlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZhY3Rvcl9pZD0wJmtleV9pZD0wJnJlcG9faWQ9MCJ9.KyHImKPBhozAaXrFjwhvGCd3xqLmMO8pyKAI_Og0AWU">

## サービスの概要

風景写真に特化した画像投稿型SNSアプリです。大きな特徴として、投稿画像に付随して撮影場所の位置情報をGoogle mapにより表示してくれます。

## サービスを開発した背景

作成背景には私の趣味である旅行が関係しています。四国旅行で撮影した風景写真をSNSに投稿しようとした際、風景画像には必要不可欠な、位置情報を分かりやすく表示する機能がないことに気が付きました。そこで、風景写真に特化した、日本の風景好きが集うSNSアプリを作成しようと思い開発に取り掛かりました。

## サービスのURL
[サービスのURL](https://tabino-to-075c0457e04b.herokuapp.com/)

## 主な機能の説明

- **ログイン機能**
- **画像投稿機能**
- **投稿画像に対するコメント機能**
- **投稿画像に対するいいね機能**
- **投稿画像のジャンル分け機能**
- **位置情報マップの生成機能**


## 使用技術

- **PHP(laravel)**：
- **HTML,CSS,JavaScript**
- **その他**：Google maps API, AWS(cloud9)
- **github**

## 今後の展望

- **検索機能の追加**：ユーザーが簡単に自分の見たい画像を調べることが出来るようにする。
- **非同期技術の導入**：いいね機能の非同期化によって動作を軽くする。
- **UIの改善**：ユーザーが使いやすいUIを追求する。

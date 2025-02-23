# タビノート
<img width="1130" alt="" src="https://private-user-images.githubusercontent.com/155617039/358819268-42896b0b-43da-4fb7-9e87-629c24aebbf7.jpg?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MjcxNTkwNjksIm5iZiI6MTcyNzE1ODc2OSwicGF0aCI6Ii8xNTU2MTcwMzkvMzU4ODE5MjY4LTQyODk2YjBiLTQzZGEtNGZiNy05ZTg3LTYyOWMyNGFlYmJmNy5qcGc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQwOTI0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MDkyNFQwNjE5MjlaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT1iNDMyMDI2MWFlMTc5Nzg3ZDQwMjAzNGRkNzY4ZDNjODBjZGE4NjA0MTE1YjZkM2Q1NTVkNWFmMjFmMWMyNzY5JlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.vAakqVbSfO8tPxfwQAlnSoy-WUme4SyY9wSj5jvtykQ">

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

## アプリの実際の画像
<div style="display: flex; justify-content: space-between;">
<img width="500" alt="" src="https://private-user-images.githubusercontent.com/155617039/358829205-aa734c22-c0cd-42bd-8844-cc2a7d1a101f.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MjcxNTkxMzgsIm5iZiI6MTcyNzE1ODgzOCwicGF0aCI6Ii8xNTU2MTcwMzkvMzU4ODI5MjA1LWFhNzM0YzIyLWMwY2QtNDJiZC04ODQ0LWNjMmE3ZDFhMTAxZi5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQwOTI0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MDkyNFQwNjIwMzhaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT1kMDRhNjc3OWRhMGVjMjRlNzYzYWMxMWZkYjMwY2E0OWJmYzI1MGExOGQ5MTQ3MzYwMzFlYmY4ZTFhMmJlZmJmJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.8cDyjRv6SpFerwvp2u7h9qy0YWE3T4XbBfIe4vBUCb0">

<img width="500" alt="" src="https://private-user-images.githubusercontent.com/155617039/358829207-2f1d4eb8-baa2-4042-8524-d52c10af8bbd.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MjcxNTkyNDAsIm5iZiI6MTcyNzE1ODk0MCwicGF0aCI6Ii8xNTU2MTcwMzkvMzU4ODI5MjA3LTJmMWQ0ZWI4LWJhYTItNDA0Mi04NTI0LWQ1MmMxMGFmOGJiZC5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjQwOTI0JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI0MDkyNFQwNjIyMjBaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT00ZDY4ZTQwZDYzZmQ3ZjQ0NzJlNmI1ZDkwNjA3Y2M1MjMyYTAxNGNlZGUwNWIyMTY1ZTljZDFjYjg2MGQ1M2IyJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.K1-JFzTZBiJ0yy9FqYPoC_Z73bZNJTQ1S-Ad55qPcSI">


</div>
## 使用技術

- **PHP(laravel)**：
- **HTML,CSS,JavaScript**
- **その他**：Google maps API, AWS(cloud9)
- **github**

## 今後の展望

- **検索機能の追加**：ユーザーが簡単に自分の見たい画像を調べることが出来るようにする。
- **非同期技術の導入**：いいね機能の非同期化によって動作を軽くする。
- **UIの改善**：ユーザーが使いやすいUIを追求する。

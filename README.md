# Realtime Chat

プログラミイング教室『Newmonz』の題材にも使用している、リアルタイム通信が可能なチャットツールです。Slackのような使いやすさが特徴です。

It is a chat tool that enables real-time communication and is also used as the subject of the "Newmonz" programming class.
It is designed to be as easy to use as Slack.

## デモ：Demo

デモサイトでは24時間ごとにデータベースがリセットされます。投稿内容が残ることはないので、気軽に試してくみてください。

The demo site resets the database every 24 hours. Please feel free to try it out, as no submissions will be left behind.

- 会員登録・ログイン：Sign Up / Sign In
- チャンネルの作成・変数・削除：CRUD a channel
- チャットの投稿・編集・削除：CRUD a chat

[https://newmonz-chat.herokuapp.com/](https://newmonz-chat.herokuapp.com/)

本来はチャンネルの作成者（＝管理者）だけがチャンネルの編集・削除を行える想定ですが、デモのためすべてのメンバーがすべてのチャンネルを編集・削除できます。

チャットの編集・削除も同様です。

Originally, only the channel creator (i.e., administrator) is supposed to be able to edit and delete channels, but for demonstration purposes, all members can do thees actions
For the same reason, anyone can edit or delete chats.

## 動作要件：Requirements

- PHP 7.4+
- Laravel 8.0+
- MySQL, MariaDB or PostgreSQL

## 使用ツール・パッケージ：Tools & Packages

- Laravel Breeze
- TailwindCSS
- InertiaJS
- Vue3
- Laravel Echo
- slack-notification-channel

## 利用方法：Usage

```php
git clone 
cd 
composer update

mv.env.example .env
php artisan key:generate
```

### .env

```php

DB_DATABASE=[任意の値：arbitary value]
DB_USERNAME=[任意の値：arbitary value]
DB_PASSWORD=[任意の値：arbitary value]

BROADCAST_DRIVER=pusher

PUSHER_APP_ID=[任意の値：arbitary value]
PUSHER_APP_KEY=[任意の値：arbitary value]
PUSHER_APP_SECRET=[任意の値：arbitary value]
PUSHER_APP_CLUSTER=[任意の値：arbitary value]

SLACK_URL=[任意の値：arbitary value]
```

### Pusher

リアルタイム通信を行うためにはPusher公式サイトで会員登録をし、APIキーを取得する必要があります。

[https://pusher.com/](https://pusher.com/)

### Slack

Slack通知を行うためにはSlack Appを作成してWebhookURLを取得する必要があります。

[https://api.slack.com/apps](https://api.slack.com/apps)

```php
php artisan migrate --seed
php artisan serve
```

## 機能：Functions

- 会員登録
- ログイン・ログアウト
- チャンネルの作成
- チャンネルの編集・削除（チャンネル作成者のみ）
- チャンネル毎のチャット投稿：Chat postings per channel.
- チャットの編集・削除（チャット投稿者のみ）
- 双方向通信によるリアルタイムチャット
- 未読チェック機能
- Slack通知で管理者に報告

## 特徴：Features

- SPA（Single page application）
- 他クライアントの投稿と同じチャンネルを開いている場合、チャットを再読み込み
- 他クライアントからの投稿でチャンネル未読マーク付与
- 入力行数によって伸縮するテキストエリア
- 下から順に最新の投稿となるよう逆ソートとスクロール設定
- 逆順無限スクロールによるLoad more
- チャット編集後のスクロール位置の維持
- Markdown対応（GitHub flavor）
- レスポンシブレイアウト：Responsive Layout

- Textarea that expands or contracts depending on the number of lines.
- Reverse sorting and scrolling settings so that the most recent posts are from bottom to top
- Load more function by infinite scroll in reverse order
- Preserve scroll position after editing a post

## 外部サービス

- Pusher - [https://pusher.com/](https://pusher.com/)
- Slack API - [https://api.slack.com/apps](https://api.slack.com/apps)
- Gravatar - [https://gravatar.com/](https://gravatar.com/)
- Font Awesome - [https://fontawesome.com/](https://fontawesome.com/)

## ライセンス：**License**

リアルタイムチャットアプリは、MITライセンスのもとで提供されるオープンソースソフトウェアです。

The Realtime Chat App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
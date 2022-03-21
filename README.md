# Realtime Chat

プログラミング教室『Newmonz』の題材にも使用している、リアルタイム通信が可能なチャットツールです。Slackのような使いやすさが特徴です。

It is a chat tool that enables real-time communication and is also used as the subject of the "Newmonz" programming class.
It is designed to be as easy to use as Slack.

## デモ：Demo

デモサイトでは24時間ごとにデータベースがリセットされます。投稿内容が残ることはないので、気軽に試してくみてください。

The demo site resets the database every 24 hours. Please feel free to try it out, as no submissions will be left behind.

- 会員登録・ログイン：Sign Up / Sign In
- チャンネルの作成・編集・削除：CRUD a channel
- チャットの投稿・編集・削除：CRUD a chat

[https://newmonz-chat.herokuapp.com/](https://newmonz-chat.herokuapp.com/)

### スクリーンショット：Screenshot

![https://res.cloudinary.com/heart1jp/image/upload/v1647767045/Newmonz/PHP/practical/realtime-chat/screenshot.png](https://res.cloudinary.com/heart1jp/image/upload/v1647767045/Newmonz/PHP/practical/realtime-chat/screenshot.png)

### 備考：Notes

本来はチャンネルの作成者（＝管理者）だけがチャンネルの編集・削除を行える想定ですが、デモのためすべてのメンバーがすべてのチャンネルを編集・削除できます。

チャットの編集・削除も同様です。

Originally, only the channel creator (i.e., administrator) is supposed to be able to edit and delete channels, but for demonstration purposes, all members can do thees actions.  
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

### command

```php
git clone git@github.com:heartone/realtime-chat.git
cd realtime-chat
composer update
npm install && npm run dev

mv .env.example .env
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

To use real-time communication, you need to register as a member at the official Pusher website and obtain an API key.

[https://pusher.com/](https://pusher.com/)

### Slack

Slack通知を行うためにはSlack Appを作成してWebhookURLを取得する必要があります。

To use Slack notifications, you must create a Slack App and obtain a WebhookURL.

[https://api.slack.com/apps](https://api.slack.com/apps)

### command

```php
php artisan migrate --seed
php artisan serve
```

## 機能：Functions

- SPA（Single page application）
- 認証：Authentication
- チャンネル毎のチャット投稿：Chat postings per channel.
- 双方向通信によるリアルタイムチャット：Realtime chat by interactive communication
- 未読チェック機能：Unread check function
- Slack通知で管理者に報告：Notification via Slack
- Markdown対応（GitHub flavor）
- レスポンシブレイアウト：Responsive layout

## 特徴：Features

#### 双方向通信：Interactive Communication

![https://res.cloudinary.com/heart1jp/image/upload/v1647767523/Newmonz/PHP/practical/realtime-chat/interactive-communication.gif](https://res.cloudinary.com/heart1jp/image/upload/v1647767523/Newmonz/PHP/practical/realtime-chat/interactive-communication.gif)

#### リアルタイム未読チェック：Real-time unread check 

![https://res.cloudinary.com/heart1jp/image/upload/v1647767968/Newmonz/PHP/practical/realtime-chat/unread-check.gif](https://res.cloudinary.com/heart1jp/image/upload/v1647767968/Newmonz/PHP/practical/realtime-chat/unread-check.gif)

#### 逆順無限スクロールによる追加読み込み：Infinite scrolling in reverse order

![https://res.cloudinary.com/heart1jp/image/upload/v1647768653/Newmonz/PHP/practical/realtime-chat/infinite-scrolling.gif](https://res.cloudinary.com/heart1jp/image/upload/v1647768653/Newmonz/PHP/practical/realtime-chat/infinite-scrolling.gif)

#### 伸縮するテキストエリア：Elastice textarea

![https://res.cloudinary.com/heart1jp/image/upload/v1647769164/Newmonz/PHP/practical/realtime-chat/elastic-textarea.gif](https://res.cloudinary.com/heart1jp/image/upload/v1647769164/Newmonz/PHP/practical/realtime-chat/elastic-textarea.gif)

#### スクロール位置の維持：Preserve scroll position 

![https://res.cloudinary.com/heart1jp/image/upload/v1647768939/Newmonz/PHP/practical/realtime-chat/preserve-scroll.gif](https://res.cloudinary.com/heart1jp/image/upload/v1647768939/Newmonz/PHP/practical/realtime-chat/preserve-scroll.gif)

## 外部サービス：External Services

- Pusher - [https://pusher.com/](https://pusher.com/)
- Slack API - [https://api.slack.com/apps](https://api.slack.com/apps)
- Gravatar - [https://gravatar.com/](https://gravatar.com/)
- Font Awesome - [https://fontawesome.com/](https://fontawesome.com/)

## ライセンス：**License**

リアルタイムチャットアプリは、MITライセンスのもとで提供されるオープンソースソフトウェアです。

The Realtime Chat App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
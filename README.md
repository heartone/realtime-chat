# Realtime Chat

リアルタイム通信が可能なチャットツールです。Slackのような使い勝手の良さを目指しました。

It is a chat tool that enables real-time communication. We aimed for Slack-like ease of use.

## 動作要件：Requirements

- PHP 7.4+
- Laravel 8.0+
- MySQL, MariaDB or PostgreSQL

## 使用技術：Technology

- Laravel Breeze
- TailwindCSS
- InertiaJS
- Vue3
- Laravel Echo

## 利用方法：Usage

```php
git clone 
cd 
composer update

mv.env.example .env
php artisan key:generate
```

### .env

DB_*設定

PUSHER_*設定

```php
php artisan migrate --seed
php artisan serve
```

## 機能：Functions

- SPA（Single page application）
- チャンネル毎のチャット投稿：Chat postings per channel.
- Markdown対応（GitHub flavor）
- レスポンシブレイアウト：Responsive Layout

## 特徴：Features

- 入力行数によって伸縮するテキストエリア
- 下から順に最新の投稿となるよう逆ソートとスクロール設定
- 逆順無限スクロールによるLoad more
- チャット編集後のスクロール位置の維持

- Text area that expands or contracts depending on the number of input lines.
- Reverse sorting and scrolling settings so that the most recent posts are from bottom to top
- Load more function by infinite scroll in reverse order
- Preserve scroll position after editing a post

## ライセンス：**License**

Realtime Chat Appは、[MITライセンス](https://opensource.org/licenses/MIT)のもとで提供されるオープンソースソフトウェアです。

The Realtime Chat App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
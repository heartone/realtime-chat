<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chat;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ラウンジ
        Chat::create(['channel_id' => 1, 'user_id' => 1, 'content' => "### Realtime Chatへようこそ😊\n このアプリは**双方向通信**に対応しているので、複数人のチャットがリアルタイムで反映されます。\nお友だちと一緒に楽しんだり、ブラウザを２つ立ち上げて試したりしてみてください。"]);
        Chat::create(['channel_id' => 1, 'user_id' => 1, 'content' => "投稿内容は毎日初期化されるので、気軽に試してくださいね。"]);
        // テスト投稿
        Chat::create(['channel_id' => 2, 'user_id' => 1, 'content' => "**テスト投稿**です。  `Hello world!`"]);
        // 自己紹介
        Chat::create(['channel_id' => 3, 'user_id' => 1, 'content' => "管理人の山田です。よろしくお願いします。なにか困ったことがあれば遠慮なくご相談ください😃"]);
        Chat::create(['channel_id' => 3, 'user_id' => 2, 'content' => "こんにちは、スズキです！お邪魔します！\n皆さんよろしくお願いしますね！"]);
        Chat::create(['channel_id' => 3, 'user_id' => 3, 'content' => "吉田です。特技はけん玉です。  世界大会で２位まで行きました。"]);
        Chat::create(['channel_id' => 3, 'user_id' => 2, 'content' => "吉田さん、２位ってすごいですね！！"]);
        // イベント
        $date = today()->addDays(12)->toDateString();
        Chat::create(['channel_id' => 4, 'user_id' => 1, 'content' => "### 懇親会開催のお知らせ\n ここの参加者みんなで飲み会をやりましょう！参加できる方はメッセージ下さい。\n - 日時：" . $date . " 19時〜22時\n- 場所：新宿\n - 会費：4,000円"]);
        Chat::create(['channel_id' => 4, 'user_id' => 2, 'content' => "は〜い、参加しま〜す！"]);
        Chat::create(['channel_id' => 4, 'user_id' => 3, 'content' => "よろしくお願いします！"]);
        Chat::create(['channel_id' => 4, 'user_id' => 4, 'content' => "はい、参加します。楽しみにしてます😊。"]);
        // 告知
        Chat::create(['channel_id' => 5, 'user_id' => 1, 'content' => "告知したいことがあればここを自由に使ってください。"]);

       
    }
}

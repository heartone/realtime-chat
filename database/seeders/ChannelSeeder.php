<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create(['user_id' => 1, 'name' => '☕ 01-ラウンジ', 'description' => '談話室です。気軽に談笑してください。']);
        Channel::create(['user_id' => 1, 'name' => '✅ 02-テスト投稿用', 'description' => '気軽にテスト投稿を試してください。']);
        Channel::create(['user_id' => 1, 'name' => '😃 03-自己紹介']);
        Channel::create(['user_id' => 1, 'name' => '📅 04-イベント']);
        Channel::create(['user_id' => 1, 'name' => '📢 05-告知']);
        
        

    }
}

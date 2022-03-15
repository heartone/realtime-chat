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
        Channel::create(['user_id' => 1, 'name' => 'ラウンジ']);
        Channel::create(['user_id' => 1, 'name' => '自己紹介']);
        Channel::create(['user_id' => 1, 'name' => 'イベント']);
        Channel::create(['user_id' => 1, 'name' => '告知']);
        
    }
}

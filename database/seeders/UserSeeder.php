<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auth = User::create(['name' => '山田太郎', 'email' => 'yamada@example.com', 'password' => bcrypt('himitudayo')]);
        User::create(['name' => '鈴木花子', 'email' => 'suzuki@example.com', 'password' => bcrypt('himitudayo')]);
        User::create(['name' => '吉田芳雄', 'email' => 'yoshida@example.com', 'password' => bcrypt('himitudayo')]);
        User::create(['name' => '田中敏子', 'email' => 'tanaka@example.com', 'password' => bcrypt('himitudayo')]);
        $auth->role = 'admin';
        $auth->save();
    }
}

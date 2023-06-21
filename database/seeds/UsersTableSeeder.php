<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'アトラス太郎',
            'mail' => 'atlas1@gmail.com',
            'password' => bcrypt('atlas1'), //bcryptでパスワードの暗号化処理をする
        ]);
    }
}

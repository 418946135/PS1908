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
        \App\User::create([
            'name' => 'eagle1',
            'email' =>  '492617424@qq.com',
            'password'  =>  password_hash('test', PASSWORD_DEFAULT),
            'avatar' => '',
        ]);
        \App\User::create([
            'name' => 'eagle2',
            'email' =>  '492617426@qq.com',
            'password'  =>  password_hash('test', PASSWORD_DEFAULT),
            'avatar' => '',
        ]);
        \App\User::create([
            'name' => 'eagle3',
            'email' =>  '492617423@qq.com',
            'password'  =>  password_hash('test', PASSWORD_DEFAULT),
            'avatar' => '',
        ]);
        \App\User::create([
            'name' => 'eagle4',
            'email' =>  '492617421@qq.com',
            'password'  =>  password_hash('test', PASSWORD_DEFAULT),
            'avatar' => '',
        ]);
        \App\User::create([
            'name' => 'eagle5',
            'email' =>  '492617420@qq.com',
            'password'  =>  password_hash('test', PASSWORD_DEFAULT),
            'avatar' => '',
        ]);
        \App\User::create([
            'name' => 'eagle6',
            'email' =>  '492617422@qq.com',
            'password'  =>  password_hash('test', PASSWORD_DEFAULT),
            'avatar' => '',
        ]);
    }
}

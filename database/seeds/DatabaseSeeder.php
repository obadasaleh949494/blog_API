<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new \App\User;

        $user->name= 'omar';
        $user->email = 'omar@gmail.com';
        $user->password = bcrypt('123');
        $user->api_token = 'asd';
        $user->save();

        $token = Str::random(60);

        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();


        // $this->call(UsersTableSeeder::class);
    }
}

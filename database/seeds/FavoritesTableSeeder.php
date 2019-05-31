<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favorites')->delete();

        $users = \App\User::pluck('id')->all();

        $namberOfUsers = count($users);
        foreach (\App\Question::all() as $question) {
            for ($i = 0; $i < rand(0, $namberOfUsers); $i++) {
                $user = $users[$i];

                $question->favorites()->attach($user);

            }

        }
    }
}

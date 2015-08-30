<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create()->each(function ($user) {
            $sub = factory(App\Sub::class)->make();
            $sub->owner()->associate($user);
            $sub->save();

            $post = factory(App\Post::class)->make();
            $post->user()->associate($user);
            $post->sub()->associate($sub);
            $post->save();
        });
    }
}

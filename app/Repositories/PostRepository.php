<?php

namespace App\Repositories;

use App\Post;
use App\Sub;
use App\User;

class PostRepository extends Repository
{
    public function findBySlugThroughSubName($subName, $slug)
    {
        $sub = Sub::where('name', $subName)->firstOrFail();
        $post = Post::where('slug', $slug)->where('sub_id', $sub->id)->firstOrFail();

        return $post;
    }

    public function store($request, Sub $sub, User $user)
    {
        $post = Post::create($request->all());
        $post->sub()->associate($sub);
        $post->user()->associate($user);
        $post->save();

        return $post;
    }
}
